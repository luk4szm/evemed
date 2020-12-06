<?php

function PatientEdit()
{

	$form = $_POST;

	//get old entry version
	$sql = " SELECT * FROM patients WHERE id = '{$form['id']}' ";
	$old_entry = mysqli_fetch_assoc(MysqliQuery($sql));

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
	$set['gender'] = ($form['gender'] == 'f') ? "gender = 'f'" : "gender = 'm'";
	$set['allergy'] = empty($form['allergy']) ? "allergy = NULL" : "allergy = '{$form['allergy']}'";
	$set['chronic_disease'] = empty($form['chronic_disease']) ? "chronic_disease = NULL" : "chronic_disease = '{$form['chronic_disease']}'";
	$set['drugs'] = empty($form['drugs']) ? "drugs = NULL" : "drugs = '{$form['drugs']}'";

	//edit entry
	$sql = "
		UPDATE patients
		SET first_name = '{$form['first_name']}',
			 last_name = '{$form['last_name']}',
			 " . $set['date_of_birth'] . ",
			 " . $set['PESEL'] . ",
			 " . $set['gender'] . ",
			 " . $set['street'] . ",
			 " . $set['postal_code'] . ",
			 " . $set['city'] . ",
			 " . $set['allergy'] . ",
			 " . $set['chronic_disease'] . ",
			 " . $set['drugs'] . "
		WHERE id = '{$form['id']}'	
		";
	$ins = MysqliQuery($sql);

	//notify maker
	if ($ins) {
		NotifyMake(
			'success',
			'Pomyślnie edytowano dane pacjenta'
		);
	}

	//get new entry version
	$sql = " SELECT * FROM patients WHERE id = {$form['id']}";
	$new_entry = mysqli_fetch_assoc(MysqliQuery($sql));

	//diffrence in entrys
	$diff = array_diff_assoc($old_entry, $new_entry);
	$i = 0;
	foreach ($diff AS $key => $value) {
		//save change in history
		$sql = "
			INSERT INTO patients_changehistory
			SET pat_id = '{$form['id']}',
				 field = '$key',
				 data_before = '{$old_entry[$key]}',
				 data_after = '{$new_entry[$key]}',
				 user = '{$_SESSION['loggedUser']['id']}'
		";
		$ins = MysqliQuery($sql);
		if ($ins) $i++;
	}

	//notify maker
	if ($i > 0) {
		if ($ins) {
			NotifyMake(
				'success',
				'Zmienionych wpisów: [' . $i . ']'
			);
		}
	}


	header('Location: /patient.php?id=' . $form['id']);
	exit();

}