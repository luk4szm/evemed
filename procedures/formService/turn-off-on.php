<?php

function ProcedureTurnOff()
{

	$form = $_POST;

	//edit entry
	$sql = "
		UPDATE procedures
		SET status = 0
		WHERE ID = '{$form['procID']}'	
		";
	$ins = MysqliQuery($sql);

	//notify maker
	if ($ins) {
		NotifyMake(
			'success',
			'Wycofano zabieg'
		);
	}

	//save change in history
	$sql = "
		INSERT INTO procedures_changehistory
		SET procID = '{$form['procID']}',
			 field = 'status',
			 data_before = 'aktywny',
			 data_after = 'wycofany',
			 user = '{$_SESSION['loggedUser']['ID']}'
	";
	MysqliQuery($sql);


	header('Location: ' . $_SERVER['REQUEST_URI']);
	exit();

}

function ProcedureTurnOn()
{

	$form = $_POST;

	//edit entry
	$sql = "
		UPDATE procedures
		SET status = 1
		WHERE ID = '{$form['procID']}'	
		";
	$ins = MysqliQuery($sql);

	//notify maker
	if ($ins) {
		NotifyMake(
			'success',
			'Przywrócono zabieg'
		);
	}

	//save change in history
	$sql = "
		INSERT INTO procedures_changehistory
		SET procID = '{$form['procID']}',
			 field = 'status',
			 data_before = 'wycofany',
			 data_after = 'aktywny',
			 user = '{$_SESSION['loggedUser']['ID']}'
	";
	MysqliQuery($sql);


	header('Location: ' . $_SERVER['REQUEST_URI']);
	exit();

}