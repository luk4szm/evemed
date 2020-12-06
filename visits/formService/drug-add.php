<?php

function VisitAddDrug()
{

	$form = $_POST;

	foreach ($form AS $name => $input) {
		if (!is_array($form[$name])) {
			$form[$name] = (!empty($form[$name])) ? FormFilter($input, 'into_database') : '';
		}
	}

	//add to database
	$sql = "
		INSERT INTO visits_drugs
		SET vis_id = '{$form['vis_id']}',
			 name = '{$form['name']}',
			 dose = '{$form['dose']}',
			 quantity = '{$form['quantity']}',
			 dosage = '{$form['dosage']}',
			 refund = '{$form['refund']}',
			 add_user = '{$_SESSION['loggedUser']['id']}'
		";
	$ins = MysqliQuery($sql);

	//notify maker
	if ($ins) {
		NotifyMake(
			'success',
			'Dodano lek'
		);
	}

	header('Location: ' . $_SERVER['REQUEST_URI']);
	exit();

}