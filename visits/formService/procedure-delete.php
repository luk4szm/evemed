<?php

function VisitDeleteProcedure()
{

	$form = $_POST;

	//edit entry in database
	$sql = "
		DELETE FROM visits_procedures
		WHERE id = '{$form['proc_id']}'
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