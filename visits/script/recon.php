<?php

function VisitRecon($id)
{

	$table_structure = TableStructure('visits');
	$users = UsersList();

	//basic data
	$sql = "
		SELECT v.id, v.visit_date,
		       v.examination, v.recommend,
		       v.complete, v.status_id,
		       v.pat_id,
		       v.conf_date, v.conf_user, v.conf_note,
		       v.canc_date, v.canc_user, v.canc_note,
		       v.add_user, v.entry_add
		FROM visits AS v
		WHERE v.id = '$id'
	";
	$vis = ResponseDetail(MysqliQuery($sql));


	//patient
	$sql = "
		SELECT c.id, c.first_name, c.last_name,
		       CONCAT(c.first_name, ' ', c.last_name) AS full_name,
		       c.PESEL, c.gender, c.date_of_birth,
		       c.street, c.postal_code, c.city, 
				 c.allergy, c.chronic_disease, c.drugs,
		       c.entry_add
		FROM patients AS c
		WHERE c.id = '{$vis['result']['pat_id']}'
	";
	$vis['result']['patient'] = mysqli_fetch_assoc(MysqliQuery($sql));
	$vis['result']['patient']['age'] = PersonAge($vis['result']['patient']['date_of_birth']);


	//add_user
	$vis['result']['add_user'] = $users[$vis['result']['add_user']];

	//conf_user
	if (!empty($vis['result']['conf_user'])) {
		$vis['result']['conf_user'] = $users[$vis['result']['conf_user']];
	}

	//canc_user
	if (!empty($vis['result']['canc_user'])) {
		$vis['result']['canc_user'] = $users[$vis['result']['canc_user']];
	}


	//visit procedures
	$sql = "
		SELECT vp.id, vp.price,
				 p.id AS proc_id, p.name_short, p.name_full
		FROM visits_procedures AS vp
		JOIN procedures AS p ON p.id = vp.proc_id
		WHERE vp.vis_id = '$id'
	";
	$res = MysqliQuery($sql);
	if ($vis['result']['procedures_count'] = mysqli_num_rows($res)) {
		$vis['result']['procedures_price'] = 0;
		while ($proc = mysqli_fetch_assoc($res)) {
			$vis['result']['procedures'][] = $proc;
			$vis['result']['procedures_price'] += $proc['price'];
		}
	} else {
		$vis['result']['procedures_price'] = 0;
	}


	//visit drugs
	$sql = "
		SELECT v.id, v.name, v.dose, v.quantity, v.dosage, v.refund
		FROM visits_drugs AS v
		WHERE v.vis_id = '$id'
	";
	$res = MysqliQuery($sql);
	if ($vis['result']['drugs_count'] = mysqli_num_rows($res)) {
		while ($drug = mysqli_fetch_assoc($res)) {
			$vis['result']['drugs'][] = $drug;
		}
	}


	//notes
	$tmp = NotesList("vis_id = '$id'");
	if ($vis['result']['notes_count'] = $tmp['list_count']) {
		foreach ($tmp['result'] AS $note) {
			$note['add_user'] = $users[$note['add_user']];
			$vis['result']['notes'][] = $note;
		}
	}

	//change history
	$sql = "
		SELECT id, field, data_before, data_after, user, entry_add
		FROM visits_changehistory
		WHERE vis_id = '$id'
		ORDER BY entry_add ASC
   ";
	$res = MysqliQuery($sql);
	if ($vis['result']['change_history_count'] = mysqli_num_rows($res)) {
		while ($hist = mysqli_fetch_assoc($res)) {
			$hist['column_index'] = array_search($hist['field'], array_column($table_structure, 'field'));
			if ($hist['column_index'] !== false) {
				$hist['name'] = $table_structure[$hist['column_index']]['name'];
			} else {
				$hist['name'] = '<span class="f500 red">nie odnaleziono</span>';
			}
			unset($hist['column_index']);
			$hist['user'] = $users[$hist['user']];
			$vis['result']['change_history'][] = $hist;
		}
	}


	return $vis;

}