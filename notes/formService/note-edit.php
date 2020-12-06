<?php

function ItemNoteEdit()
{

	$form = $_POST;

	foreach ($form AS $name => $input) {
		if (!is_array($form[$name])) {
			$form[$name] = (!empty($form[$name])) ? FormFilter($input, 'into_database') : '';
		}
	}

	//edit entry in database
	$sql = "
		UPDATE notes
		SET txt = '{$form['txt']}'
		WHERE id = '{$form['id']}'
	";
	$edit = MysqliQuery($sql);

	//notify maker
	if ($edit) {
		NotifyMake(
			'success',
			'Edytowano notatkę'
		);
	}

	header('Location: ' . $_SERVER['REQUEST_URI']);
	exit();

}