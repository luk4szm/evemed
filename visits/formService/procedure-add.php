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
		SET visID = '{$form['visID']}',
			 procID = '{$form['procID']}',
			 price = '{$form['price']}',
			 add_user = '{$_SESSION['loggedUser']['ID']}'
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