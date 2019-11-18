<?php

function ItemNoteDelete()
{

	$form = $_POST;

	//delete entry from database
	$sql = "
		DELETE FROM notes
		WHERE ID = '{$form['ID']}'
	";
	$edit = MysqliQuery($sql);

	//notify maker
	if ($edit) {
		NotifyMake(
			'success',
			'Usunięto notatkę'
		);
	}

	header('Location: ' . $_SERVER['REQUEST_URI']);
	exit();

}