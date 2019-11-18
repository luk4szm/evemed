<?php

function ProcedureRecon($ID)
{

	$table_structure = TableStructure('procedures');
	$users = UsersList();

	//basic data
	$sql = "
		SELECT p.ID, p.status, p.name_short, p.name_full,
		       p.description, p.price,
		       p.add_user, p.entry_add
		FROM procedures AS p
		WHERE p.ID = '$ID'
	";
	$proc = ResponseDetail(MysqliQuery($sql));


	//add user
	$proc['result']['add_user'] = $users[$proc['result']['add_user']];


	//in pasts visits occurrence
	$sql = "
		SELECT vp.ID, vp.visID, vp.price,
		       v.visit_date, v.statusID,
		       CONCAT(p.first_name, ' ', p.last_name) AS pat_full_name
		FROM visits_procedures AS vp
		JOIN visits AS v ON v.ID = vp.visID
		JOIN patients AS p ON p.ID = v.patID
		WHERE procID = '$ID'
        AND v.statusID = 3
      ORDER BY v.visit_date DESC
	";
	$res = MysqliQuery($sql);
	if (mysqli_num_rows($res)) {
		$tmp['sum'] = 0;
		while ($vis = mysqli_fetch_assoc($res)) {
			$proc['result']['visit_past_occurr'][] = $vis;
			$tmp['sum'] += $vis['price'];
		}
		$proc['result']['visit_past_occurr_count'] = count($proc['result']['visit_past_occurr']);
		$proc['result']['visit_past_occurr_sum_price'] = $tmp['sum'];
	} else {
		$proc['result']['visit_past_occurr_count'] = 0;
		$proc['result']['visit_past_occurr_sum_price'] = 0;
	}

	//in future visits occurrence
	$sql = "
		SELECT vp.ID, vp.visID, vp.price,
		       v.visit_date, v.statusID,
		       CONCAT(p.first_name, ' ', p.last_name) AS pat_full_name
		FROM visits_procedures AS vp
		JOIN visits AS v ON v.ID = vp.visID
		JOIN patients AS p ON p.ID = v.patID
		WHERE procID = '$ID'
        AND v.statusID = 1
      ORDER BY v.visit_date DESC
	";
	$res = MysqliQuery($sql);
	if (mysqli_num_rows($res)) {
		$tmp['sum'] = 0;
		while ($vis = mysqli_fetch_assoc($res)) {
			$proc['result']['visit_future_occurr'][] = $vis;
			$tmp['sum'] += $vis['price'];
		}
		$proc['result']['visit_future_occurr_count'] = count($proc['result']['visit_future_occurr']);
		$proc['result']['visit_future_occurr_sum_price'] = $tmp['sum'];
	} else {
		$proc['result']['visit_future_occurr_count'] = 0;
		$proc['result']['visit_future_occurr_sum_price'] = 0;
	}


	//notes
	$tmp = NotesList("procID = '$ID'");
	if ($proc['result']['notes_count'] = $tmp['list_count']) {
		foreach ($tmp['result'] AS $note) {
			$note['add_user'] = $users[$note['add_user']];
			$proc['result']['notes'][] = $note;
		}
	}
	

	//change history
	$sql = "
		SELECT ID, field, data_before, data_after, user, entry_add
		FROM procedures_changehistory
		WHERE procID = '$ID'
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
			$proc['result']['change_history'][] = $hist;
		}
		$proc['result']['change_history_count'] = count($proc['result']['change_history']);
	} else {
		$proc['result']['change_history_count'] = 0;
	}


	return $proc;

}