<?php

function VisitConfirm()
{

	$form = $_POST;

	foreach ($form AS $name => $input) {
		if (!is_array($form[$name])) {
			$form[$name] = (!empty($form[$name])) ? FormFilter($input, 'into_database') : '';
		}
	}

	$set['conf_note'] = empty($form['conf_note']) ? "conf_note = NULL" : "conf_note = '{$form['conf_note']}'";
	$set['examination'] = empty($form['examination']) ? "examination = NULL" : "examination = '{$form['examination']}'";
	$set['recommend'] = empty($form['recommend']) ? "recommend = NULL" : "recommend = '{$form['recommend']}'";

	//update entry
	$sql = "
		UPDATE visits
		SET visit_date = '{$form['visit_date']}',
		    conf_user = '{$_SESSION['loggedUser']['ID']}',
		    conf_date = now(),
		    complete = 1,
		    statusID = 3,
			 " . $set['examination'] . ",
			 " . $set['recommend'] . ",
			 " . $set['conf_note'] . "
		WHERE ID = '{$form['visID']}'	 
		";
	$ins = MysqliQuery($sql);

	//notify maker
	if ($ins) {
		NotifyMake(
			'success',
			'Potwierdzono wizytę'
		);
	}

	header('Location: ' . $_SERVER['REQUEST_URI']);
	exit();

}