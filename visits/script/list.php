<?php

function VisitList($where = null, $order = null, $limit = null)
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

	if ($limit) {
		$limit = 'LIMIT ' . $limit;
	} else {
		$limit = null;
	}

	$sql = "
		SELECT v.id, v.visit_date, v.complete, v.status_id,
		       p.id AS pat_id, p.first_name, p.last_name, CONCAT(p.first_name, ' ', p.last_name) AS pat_full_name,
		       GROUP_CONCAT(proc.name_short) AS procedures,
		       SUM(pr.price) AS price
		FROM visits AS v
		LEFT JOIN visits_procedures AS pr ON pr.vis_id = v.id
		JOIN patients AS p ON p.id = v.pat_id
		LEFT JOIN procedures AS proc ON proc.id = pr.proc_id 
		" . $where . "
		GROUP BY v.id
		HAVING COUNT(*) > 0
		" . $order . "
	   " . $limit;

	return ResponseList(MysqliQuery($sql));

}