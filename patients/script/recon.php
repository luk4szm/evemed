<?php

function PatientRecon($ID)
{

	$table_structure = TableStructure('patients');
	$users = UsersList();

	//basic data
	$sql = "
		SELECT c.ID, c.first_name, c.last_name,
		       CONCAT(c.first_name, ' ', c.last_name) AS full_name,
		       c.PESEL, c.gender, c.date_of_birth,
		       c.street, c.postal_code, c.city, 
				 c.allergy, c.chronic_disease, c.drugs,
		       c.entry_add
		FROM patients AS c
		WHERE c.ID = '$ID'
	";
	$pat = ResponseDetail(MysqliQuery($sql));


	//visits
	$sql = "
		SELECT v.ID, v.statusID, v.visit_date, v.recommend, v.add_user, v.entry_add, v.complete,
		       GROUP_CONCAT(p.name_short) AS procedures,
				 SUM(vp.price) AS price
		FROM visits AS v
		LEFT JOIN visits_procedures AS vp ON vp.visID = v.ID
		LEFT JOIN procedures AS p ON p.ID = vp.procID 
	   WHERE v.patID = '$ID'
		GROUP BY v.ID
		ORDER BY v.visit_date ASC 
	";
	$res = MysqliQuery($sql);
	if (mysqli_num_rows($res)) {
		while ($vis = mysqli_fetch_assoc($res)) {
			$vis['add_user'] = $users[$vis['add_user']];
			$pat['result']['visits'][] = $vis;
		}
		$pat['result']['visits_count'] = count($pat['result']['visits']);
	} else {
		$pat['result']['visits_count'] = 0;
	}
	$pat['result']['visits_future_count'] = 0;
	$pat['result']['visits_canc_count'] = 0;
	$pat['result']['visits_past_count'] = 0;

	//visits - future & past & canc
	if ($pat['result']['visits_count']) {
		foreach ($pat['result']['visits'] AS $visit) {
			switch ($visit['statusID']) {
				case 1:
					$pat['result']['visits_future'][] = $visit;
					break;
				case 2:
					$pat['result']['visits_canc'][] = $visit;
					break;
				case 3:
					$pat['result']['visits_past'][] = $visit;
					break;
			}
		}
		if (isset($pat['result']['visits_future'])) {
			$pat['result']['visits_future_count'] = count($pat['result']['visits_future']);
		}
		if (isset($pat['result']['visits_canc'])) {
			$pat['result']['visits_canc_count'] = count($pat['result']['visits_canc']);
			array_multisort(
				array_column($pat['result']['visits_canc'], 'visit_date'), SORT_DESC,
				$pat['result']['visits_canc']
			);
		}
		if (isset($pat['result']['visits_past'])) {
			$pat['result']['visits_past_count'] = count($pat['result']['visits_past']);
			array_multisort(
				array_column($pat['result']['visits_past'], 'visit_date'), SORT_DESC,
				$pat['result']['visits_past']
			);
		}
	}


	//notes
	$tmp = NotesList("patID = '$ID'");
	if ($pat['result']['notes_count'] = $tmp['list_count']) {
		foreach ($tmp['result'] AS $note) {
			$note['add_user'] = $users[$note['add_user']];
			$pat['result']['notes'][] = $note;
		}
	}


	//change history
	$sql = "
		SELECT ID, field, data_before, data_after, user, entry_add
		FROM patients_changehistory
		WHERE patID = '$ID'
		ORDER BY entry_add ASC
   ";
	$res = MysqliQuery($sql);
	if (mysqli_num_rows($res)) {
		while ($hist = mysqli_fetch_assoc($res)) {
			$hist['column_index'] = array_search($hist['field'], array_column($table_structure, 'field'));
			if ($hist['column_index'] !== false) {
				$hist['name'] = $table_structure[$hist['column_index']]['name'];
			} else {
				$hist['name'] = '<span class="f500 red">nie odnaleziono</span>';
			}
			unset($hist['column_index']);
			$hist['user'] = $users[$hist['user']];
			$pat['result']['change_history'][] = $hist;
		}
		$pat['result']['change_history_count'] = count($pat['result']['change_history']);
	} else {
		$pat['result']['change_history_count'] = 0;
	}


	//check profile complete
	if (
		empty($pat['result']['first_name']) ||
		empty($pat['result']['last_name']) ||
		empty($pat['result']['date_of_birth']) ||
		empty($pat['result']['PESEL']) ||
		empty($pat['result']['street']) ||
		empty($pat['result']['street']) ||
		empty($pat['result']['city'])
	) {
		$pat['result']['profile_complete'] = false;
	} else {
		$pat['result']['profile_complete'] = true;
	}

	//return array
	if ($pat['code'] === 200) {

		$pat['result']['gender'] = $pat['result']['gender'] == 'm' ? 'male' : 'female';
		$pat['result']['age'] = PersonAge($pat['result']['date_of_birth']);
		$pat['result']['full_address'] = FormatAddress($pat['result']);

	}

	return $pat;

}