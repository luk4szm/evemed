<?php

function FormatVisitStatus($ID)
{

	$sql = "
		SELECT ID, name
	   FROM visits_status
		WHERE ID = '$ID'
	";

	$status = mysqli_fetch_assoc(MysqliQuery($sql));

	switch ($status['ID']) {
		case 1:
			$color = 'blue';
			break;
		case 2:
			$color = 'red';
			break;
		case 3:
			$color = 'green';
			break;
		default:
			return null;
	}

	return '<span class="f500 ' . $color . '">' . $status['name'] . '</span>';

}