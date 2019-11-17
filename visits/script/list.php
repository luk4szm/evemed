<?php

function VisitList($where = null, $order = null)
{

	if ($where) {
		$where = 'WHERE ' . $where;
	} else {
		$where = 'WHERE 1 = 1';
	}

	if ($order) {
		$order = 'ORDER BY ' . $order;
	} else {
		$order = 'ORDER BY visit_date ASC';
	}

	$sql = "
		SELECT v.ID, v.visit_date, v.complete, v.statusID,
		       p.ID AS patID, p.first_name, p.last_name, CONCAT(p.first_name, ' ', p.last_name) AS pat_full_name,
		       GROUP_CONCAT(proc.name_short) AS procedures,
		       SUM(pr.price) AS price
		FROM visits AS v
		LEFT JOIN visits_procedures AS pr ON pr.visID = v.ID
		JOIN patients AS p ON p.ID = v.patID
		LEFT JOIN procedures AS proc ON proc.ID = pr.procID 
		" . $where . "
		GROUP BY v.ID
		HAVING COUNT(*) > 0
		" . $order;

	return ResponseList(MysqliQuery($sql));

}