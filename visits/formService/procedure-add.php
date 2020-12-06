<?php

function VisitAddProcedure()
{

	$form = $_POST;

	foreach ($form AS $name => $input) {
		if (!is_array($form[$name])) {
			$form[$name] = (!empty($form[$name])) ? FormFilter($input, 'into_database') : '';
		}
	}
	$form['price'] = FormFilter($form['price'], 'price');

	//add to database
	$sql = "
		INSERT INTO visits_procedures
		SET vis_id = '{$form['vis_id']}',
			 proc_id = '{$form['proc_id']}',
			 price = '{$form['price']}',
			 add_user = '{$_SESSION['loggedUser']['id']}'
		";
	$ins = MysqliQuery($sql);

	//notify maker
	if ($ins) {
		NotifyMake(
			'success',
			'Dodano zabieg'
		);
	}

	header('Location: ' . $_SERVER['REQUEST_URI']);
	exit();

}