<?php

function VisitCancel()
{

	$form = $_POST;

	foreach ($form AS $name => $input) {
		if (!is_array($form[$name])) {
			$form[$name] = (!empty($form[$name])) ? FormFilter($input, 'into_database') : '';
		}
	}

	$set['canc_note'] = empty($form['canc_note']) ? "canc_note = NULL" : "canc_note = '{$form['canc_note']}'";

	//update entry
	$sql = "
		UPDATE visits
		SET canc_user = '{$_SESSION['loggedUser']['id']}',
		    canc_date = now(),
		    status_id = 2,
			 " . $set['canc_note'] . "
		WHERE id = '{$form['vis_id']}'	 
		";
	$ins = MysqliQuery($sql);

	//notify maker
	if ($ins) {
		NotifyMake(
			'success',
			'Anulowano wizytę'
		);
	}

	header('Location: ' . $_SERVER['REQUEST_URI']);
	exit();

}