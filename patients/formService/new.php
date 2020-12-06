<?php

function PatientNewAdd()
{

	$form = $_POST;
	$formStep = $form['formStep'];

	//del - delete all of stored data from form
	if ($formStep == 'del') {

		unset($_SESSION['patNew']);
		unset($_SESSION['patNewWarnings']);
		unset($_SESSION['patNewErrors']);

		header('Location: ' . $_SERVER['REQUEST_URI']);
		exit();

	}

	//step1 - start of adding new patient form
	if ($formStep == 1) {

		$_SESSION['patNew']['formStep'] = 1;

		header('Location: ' . $_SERVER['REQUEST_URI']);
		exit();

	}

	//middle steps
	if ($formStep > 1) {

		unset($_SESSION['patNew']);

		foreach ($form AS $name => $input) {
			if (!is_array($form[$name])) {
				$form[$name] = (!empty($form[$name])) ? FormFilter($input) : '';
			}
		}

		//check for duplicates
		$sql = "
			SELECT id, first_name, last_name, 
			       CONCAT(first_name, ' ', last_name) AS full_name
         FROM patients
			WHERE first_name LIKE '{$form['first_name']}'
 		     AND last_name LIKE '{$form['last_name']}'
		";
		$res = MysqliQuery($sql);
		if (mysqli_num_rows($res)) {
			$_SESSION['patNewWarnings'][] = 'Znaleziono duplikaty!<br>Sprawdź czy pacjent nie istnieje już w bazie.';
		}


		$_SESSION['patNew'] = $form;

		header('Location: ' . $_SERVER['REQUEST_URI']);
		exit();

	}

	//final step - addind new patient to database
	if ($formStep == 'finish') {

		$form = $_SESSION['patNew'];

		foreach ($form AS $name => $input) {
			if (!is_array($form[$name])) {
				$form[$name] = (!empty($form[$name])) ? FormFilter($input, 'into_database') : '';
			}
		}

		$set['date_of_birth'] = empty($form['date_of_birth']) ? "date_of_birth = NULL" : "date_of_birth = '{$form['date_of_birth']}'";
		$set['PESEL'] = empty($form['PESEL']) ? "PESEL = NULL" : "PESEL = '{$form['PESEL']}'";
		$set['street'] = empty($form['street']) ? "street = NULL" : "street = '{$form['street']}'";
		$set['postal_code'] = empty($form['postal_code']) ? "postal_code = NULL" : "postal_code = '{$form['postal_code']}'";
		$set['city'] = empty($form['city']) ? "city = NULL" : "city = '{$form['city']}'";
		$set['allergy'] = empty($form['allergy']) ? "allergy = NULL" : "allergy = '{$form['allergy']}'";
		$set['chronic_disease'] = empty($form['chronic_disease']) ? "chronic_disease = NULL" : "chronic_disease = '{$form['chronic_disease']}'";
		$set['drugs'] = empty($form['drugs']) ? "drugs = NULL" : "drugs = '{$form['drugs']}'";

		//add to database
		$sql = "
			INSERT INTO patients
			SET first_name = '{$form['first_name']}',
			    last_name = '{$form['last_name']}',
			    " . $set['date_of_birth'] . ",
			    " . $set['PESEL'] . ",
			    gender = '{$form['gender']}',
			    " . $set['street'] . ",
			    " . $set['postal_code'] . ",
			    " . $set['city'] . ",
			    " . $set['allergy'] . ",
			    " . $set['chronic_disease'] . ",
			    " . $set['drugs'] . ",
				add_user = '{$_SESSION['loggedUser']['id']}'
		";
		$ins = MysqliQuery($sql);

		//notify maker
		if ($ins) {
			NotifyMake(
				'success',
				'Pomyślnie dodano nowego pacjenta do bazy'
			);
		}

		//get id of new patient
		$sql = "
			SELECT id FROM patients
			WHERE add_user = '{$_SESSION['loggedUser']['id']}'
			ORDER BY id DESC LIMIT 1
		";
		$pat = mysqli_fetch_assoc(MysqliQuery($sql));

		unset($_SESSION['patNew']);
		unset($_SESSION['patNewWarnings']);
		unset($_SESSION['patNewErrors']);
		header('Location: /patient.php?id=' . $pat['id']);
		exit();

	}

}