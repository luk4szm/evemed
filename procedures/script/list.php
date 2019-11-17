<?php

function ProcedureList($where = null, $order = null)
{

	if ($where) {
		$where = 'WHERE ' . $where;
	} else {
		$where = 'WHERE 1 = 1';
	}

	if ($order) {
		$order = 'ORDER BY ' . $order;
	} else {
		$order = 'ORDER BY p.name_short ASC';
	}

	$sql = "
		SELECT p.ID, p.name_short, p.name_full, p.description, p.price
		FROM procedures AS p  
		" . $where . "
		" . $order
	;

	return ResponseList(MysqliQuery($sql));

}