<?php

function ProcedureNewAdd()
{

	$form = $_POST;
	$formStep = $form['formStep'];

	//del - delete all of stored data from form
	if ($formStep == 'del') {

		unset($_SESSION['procNew']);
		unset($_SESSION['procNewWarnings']);
		unset($_SESSION['procNewErrors']);

		header('Location: ' . $_SERVER['REQUEST_URI']);
		exit();

	}

	//step1 - start of adding new patient form
	if ($formStep == 1) {

		$_SESSION['procNew']['formStep'] = 1;

		header('Location: ' . $_SERVER['REQUEST_URI']);
		exit();

	}

	//middle steps
	if ($formStep > 1) {

		unset($_SESSION['procNew']);

		foreach ($form AS $name => $input) {
			if (!is_array($form[$name])) {
				$form[$name] = (!empty($form[$name])) ? FormFilter($input) : '';
			}
		}

		//check for duplicates
		$sql = "
			SELECT id, name_short, name_full 
         FROM procedures
			WHERE name_short LIKE '{$form['name_short']}'
 		      OR name_full LIKE '{$form['name_full']}'
		";
		$res = MysqliQuery($sql);
		if (mysqli_num_rows($res)) {
			$_SESSION['procNewWarnings'][] = 'Znaleziono duplikaty!<br>Sprawdź czy zabieg nie istnieje już w bazie.';
		}


		$_SESSION['procNew'] = $form;

		header('Location: ' . $_SERVER['REQUEST_URI']);
		exit();

	}

	//final step - addind new patient to database
	if ($formStep == 'finish') {

		$form = $_SESSION['procNew'];

		foreach ($form AS $name => $input) {
			if (!is_array($form[$name])) {
				$form[$name] = (!empty($form[$name])) ? FormFilter($input, 'into_database') : '';
			}
		}
		$form['price'] = FormFilter($form['price'], 'price');

		$set['description'] = empty($form['description']) ? "description = NULL" : "description = '{$form['description']}'";

		//add to database
		$sql = "
			INSERT INTO procedures
			SET name_short = '{$form['name_short']}',
			    name_full = '{$form['name_full']}',
			    price = '{$form['price']}',
			    " . $set['description'] . ",
				add_user = '{$_SESSION['loggedUser']['id']}'
		";
		$ins = MysqliQuery($sql);

		//notify maker
		if ($ins) {
			NotifyMake(
				'success',
				'Pomyślnie dodano nowy zabieg'
			);
		}

		//get id of new procedure
		$sql = "
			SELECT id FROM procedures
			WHERE add_user = '{$_SESSION['loggedUser']['id']}'
			ORDER BY id DESC LIMIT 1
		";
		$proc = mysqli_fetch_assoc(MysqliQuery($sql));

		unset($_SESSION['procNew']);
		unset($_SESSION['procNewWarnings']);
		unset($_SESSION['procNewErrors']);
		header('Location: /procedure.php?id=' . $proc['id']);
		exit();

	}

}