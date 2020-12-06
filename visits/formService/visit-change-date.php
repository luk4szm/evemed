<?php

function VisitChangeDate()
{

	$form = $_POST;

	foreach ($form AS $name => $input) {
		if (!is_array($form[$name])) {
			$form[$name] = (!empty($form[$name])) ? FormFilter($input, 'into_database') : '';
		}
	}

	//update entry
	$sql = "
		UPDATE visits
		SET visit_date = '{$form['visit_date']}'
		WHERE id = '{$form['vis_id']}'	 
		";
	$ins = MysqliQuery($sql);

	//notify maker
	if ($ins) {
		NotifyMake(
			'success',
			'Zmieniono termin wizyty'
		);
	}

	header('Location: ' . $_SERVER['REQUEST_URI']);
	exit();

}