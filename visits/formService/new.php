<?php

function VisitNewAdd()
{

	$form = $_POST;
	$formStep = $form['formStep'];

	//del - delete all of stored data from form
	if ($formStep == 'del') {

		unset($_SESSION['visNew']);
		unset($_SESSION['visNewWarnings']);
		unset($_SESSION['visNewErrors']);

		header('Location: ' . $_SERVER['REQUEST_URI']);
		exit();

	}

	//step1 - start of adding new patient form
	if ($formStep == 1) {

		$_SESSION['visNew']['formStep'] = 1;

		header('Location: ' . $_SERVER['REQUEST_URI']);
		exit();

	}

	//middle steps
	if ($formStep > 1) {

		unset($_SESSION['visNew']);

		foreach ($form AS $name => $input) {
			if (!is_array($form[$name])) {
				$form[$name] = (!empty($form[$name])) ? FormFilter($input) : '';
			}
		}


		$_SESSION['visNew'] = $form;

		header('Location: ' . $_SERVER['REQUEST_URI']);
		exit();

	}

	//final step - addind new patient to database
	if ($formStep == 'finish') {

		$form = $_SESSION['visNew'];

		foreach ($form AS $name => $input) {
			if (!is_array($form[$name])) {
				$form[$name] = (!empty($form[$name])) ? FormFilter($input, 'into_database') : '';
			}
		}

		//add to database
		$sql = "
			INSERT INTO visits
			SET pat_id = '{$form['pat_id']}',
			    visit_date = '{$form['visit_date']}',
				 add_user = '{$_SESSION['loggedUser']['id']}'
		";
		$ins = MysqliQuery($sql);

		//notify maker
		if ($ins) {
			NotifyMake(
				'success',
				'Pomyślnie dodano nową wizytę'
			);
		}

		//get id of new visit
		$sql = "
			SELECT id FROM visits
			WHERE add_user = '{$_SESSION['loggedUser']['id']}'
			ORDER BY id DESC LIMIT 1
		";
		$vis = mysqli_fetch_assoc(MysqliQuery($sql));

		unset($_SESSION['visNew']);
		unset($_SESSION['visNewWarnings']);
		unset($_SESSION['visNewErrors']);
		header('Location: /visit.php?id=' . $vis['id']);
		exit();

	}

}