<?php

function ItemNoteDelete()
{

	$form = $_POST;

	//delete entry from database
	$sql = "
		DELETE FROM notes
		WHERE id = '{$form['id']}'
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