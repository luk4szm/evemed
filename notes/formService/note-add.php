<?php

function NewNoteAdd()
{

	$form = $_POST;

	foreach ($form AS $name => $input) {
		if (!is_array($form[$name])) {
			$form[$name] = (!empty($form[$name])) ? FormFilter($input, 'into_database') : '';
		}
	}

	$element_id = array_key_first($form) . " = '{$form[array_key_first($form)]}'";

	//add to database
	$sql = "
		INSERT INTO notes
		SET " . $element_id . ",
			 txt = '{$form['txt']}',
			 add_user = '{$_SESSION['loggedUser']['ID']}'
		";
	$ins = MysqliQuery($sql);

	//notify maker
	if ($ins) {
		NotifyMake(
			'success',
			'Dodano notatkę'
		);
	}

	header('Location: ' . $_SERVER['REQUEST_URI']);
	exit();

}