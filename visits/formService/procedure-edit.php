<?php

function VisitEditProcedure()
{

	$form = $_POST;

	foreach ($form AS $name => $input) {
		if (!is_array($form[$name])) {
			$form[$name] = (!empty($form[$name])) ? FormFilter($input, 'into_database') : '';
		}
	}
	$form['price'] = FormFilter($form['price'], 'price');

	//edit entry in database
	$sql = "
		UPDATE visits_procedures
		SET price = '{$form['price']}'
		WHERE id = '{$form['proc_id']}'
	";
	$edit = MysqliQuery($sql);

	//notify maker
	if ($edit) {
		NotifyMake(
			'success',
			'Edytowano zabieg'
		);
	}

	header('Location: ' . $_SERVER['REQUEST_URI']);
	exit();

}