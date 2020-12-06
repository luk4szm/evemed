<?php

function PatientList($where = null, $order = null, $limit = null)
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

	if ($limit) {
		$limit = 'LIMIT ' . $limit;
	} else {
		$limit = null;
	}

	$sql = "
		SELECT c.id, c.first_name, c.last_name, c.PESEL, c.gender,
		       CONCAT(c.first_name, ' ', c.last_name) AS full_name,
		       CONCAT(c.last_name, ' ', c.first_name) AS full_name_reverse,
		       c.street, c.postal_code, c.city, 
				 c.date_of_birth,
				 c.allergy, c.chronic_disease, c.drugs,
		       (CASE 
					  WHEN viscou > 0 THEN viscou
					  ELSE 0
				  END) AS visits_count
		FROM patients AS c
	   LEFT JOIN (SELECT pat_id, COUNT(*) AS viscou FROM visits GROUP BY pat_id) AS v ON v.pat_id = c.id
		" . $where . "
		" . $order . "
		" . $limit;

	return ResponseList(MysqliQuery($sql));

}