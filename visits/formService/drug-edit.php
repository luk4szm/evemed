<?php

function VisitEditDrug()
{

	$form = $_POST;

	foreach ($form AS $name => $input) {
		if (!is_array($form[$name])) {
			$form[$name] = (!empty($form[$name])) ? FormFilter($input, 'into_database') : '';
		}
	}

	//edit entry in database
	$sql = "
		UPDATE visits_drugs
		SET name = '{$form['name']}',
		    dose = '{$form['dose']}',
		    quantity = '{$form['quantity']}',
		    dosage = '{$form['dosage']}',
		    refund = '{$form['refund']}'
		WHERE id = '{$form['id']}'
	";
	$edit = MysqliQuery($sql);

	//notify maker
	if ($edit) {
		NotifyMake(
			'success',
			'Edytowano przepisany lek'
		);
	}

	header('Location: ' . $_SERVER['REQUEST_URI']);
	exit();

}