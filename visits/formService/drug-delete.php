<?php

function VisitDeleteDrug()
{

	$form = $_POST;

	//edit entry in database
	$sql = "
		DELETE FROM visits_drugs
		WHERE ID = '{$form['ID']}'
	";
	$del = MysqliQuery($sql);

	//notify maker
	if ($del) {
		NotifyMake(
			'success',
			'Usunięto lek'
		);
	}

	header('Location: ' . $_SERVER['REQUEST_URI']);
	exit();

}