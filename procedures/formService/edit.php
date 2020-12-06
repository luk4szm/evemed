<?php

function ProcedureEdit()
{

	$form = $_POST;

	//get old entry version
	$sql = " SELECT * FROM procedures WHERE id = '{$form['id']}' ";
	$old_entry = mysqli_fetch_assoc(MysqliQuery($sql));

	foreach ($form AS $name => $input) {
		if (!is_array($form[$name])) {
			$form[$name] = (!empty($form[$name])) ? FormFilter($input, 'into_database') : '';
		}
	}
	$form['price'] = FormFilter($form['price'], 'price');

	$set['description'] = empty($form['description']) ? "description = NULL" : "description = '{$form['description']}'";

	//edit entry
	$sql = "
		UPDATE procedures
		SET name_short = '{$form['name_short']}',
			 name_full = '{$form['name_full']}',
			 price = '{$form['price']}',
			 " . $set['description'] . "
		WHERE id = '{$form['id']}'	
		";
	$ins = MysqliQuery($sql);

	//notify maker
	if ($ins) {
		NotifyMake(
			'success',
			'Pomyślnie edytowano dane zabiegu'
		);
	}

	//get new entry version
	$sql = " SELECT * FROM procedures WHERE id = {$form['id']}";
	$new_entry = mysqli_fetch_assoc(MysqliQuery($sql));

	//diffrence in entrys
	$diff = array_diff_assoc($old_entry, $new_entry);
	$i = 0;
	foreach ($diff AS $key => $value) {
		//save change in history
		$sql = "
			INSERT INTO procedures_changehistory
			SET proc_id = '{$form['id']}',
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


	header('Location: /procedure.php?id=' . $form['id']);
	exit();

}