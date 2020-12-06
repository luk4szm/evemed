<?php

function FormatVisitStatus($id)
{
	$sql = "
		SELECT id, name
	   FROM visits_status
		WHERE id = '$id'
	";

	$status = mysqli_fetch_assoc(MysqliQuery($sql));

	switch ($status['id']) {
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