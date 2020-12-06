<?php

function NotesList($where = null, $order = null)
{

	if ($where) {
		$where = 'WHERE ' . $where;
	} else {
		$where = 'WHERE 1 = 1';
	}

	if ($order) {
		$order = 'ORDER BY ' . $order;
	} else {
		$order = 'ORDER BY entry_add ASC';
	}

	$sql = "
		SELECT n.id, n.txt, 
				 n.add_user, n.entry_add
		FROM notes AS n
		" . $where . "
		GROUP BY n.id
		HAVING COUNT(*) > 0
		" . $order;

	return ResponseList(MysqliQuery($sql));

}