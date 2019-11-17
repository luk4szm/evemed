<?php

function PatientList($where = null, $order = null)
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
		SELECT c.ID, c.first_name, c.last_name, c.PESEL, c.gender,
		       CONCAT(c.first_name, ' ', c.last_name) AS full_name,
		       c.street, c.postal_code, c.city, 
				 c.date_of_birth,
				 c.allergy, c.chronic_disease, c.drugs,
		       (CASE 
					  WHEN viscou > 0 THEN viscou
					  ELSE 0
				  END) AS visits_count
		FROM patients AS c
	   LEFT JOIN (SELECT patID, COUNT(*) AS viscou FROM visits GROUP BY patID) AS v ON v.patID = c.ID
		" . $where . "
		" . $order
	;

	return ResponseList(MysqliQuery($sql));

}