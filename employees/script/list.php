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
		       CONCAT(e.first_name, ' ', e.last_name) AS full_name,
		       e.hired, e.email, e.mobile_nr
		FROM employees AS e
	   " . $where . "
		" . $order;

	return ResponseList(MysqliQuery($sql));

}