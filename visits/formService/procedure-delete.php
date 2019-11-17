<?php

function VisitDeleteProcedure()
{

	$form = $_POST;

	foreach ($form AS $name => $input) {
		if (!is_array($form[$name])) {
			$form[$name] = (!empty($form[$name])) ? FormFilter($input, 'into_database') : '';
		}
	}

	//edit entry in database
	$sql = "
		DELETE FROM visits_procedures
		WHERE ID = '{$form['procID']}'
	";
	$del = MysqliQuery($sql);

	//notify maker
	if ($del) {
		NotifyMake(
			'success',
			'Usunięto zabieg'
		);
	}

	header('Location: ' . $_SERVER['REQUEST_URI']);
	exit();

}