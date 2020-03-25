<?php

function EmployeeList($where = null, $order = null)
{

	if ($where) {
		$where = 'WHERE ' . $where;
	} else {
		$where = 'WHERE 1 = 1';
	}

	if ($order) {
		$order = 'ORDER BY ' . $order;
	} else {
		$order = 'ORDER BY last_name ASC, first_name ASC';
	}

	$sql = "
		SELECT e.ID, e.first_name, e.last_name,
		       u.login, 
		       CONCAT(e.first_name, ' ', e.last_name) AS full_name,
		       u.active, u.admin, u.login_err,
		       e.hired, e.email, e.mobile_nr,
		       e.add_user, e.entry_add
		FROM employees AS e
	   JOIN users AS u ON u.ID = e.ID
		" . $where . "
		" . $order;

	return ResponseList(MysqliQuery($sql));

}