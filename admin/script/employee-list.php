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
		SELECT c.ID, c.first_name, c.last_name,
		       u.login, 
		       CONCAT(c.first_name, ' ', c.last_name) AS full_name,
		       u.active, u.admin, u.login_err,
		       c.hired, c.email, c.mobile_nr,
		       c.add_user, c.entry_add
		FROM employees AS c
	   JOIN users AS u ON u.ID = c.ID
		" . $where . "
		" . $order
	;

	return ResponseList(MysqliQuery($sql));

}