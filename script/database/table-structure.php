<?php

function TableStructure($table)
{

	$structure = array();
	$sql = "SHOW FULL COLUMNS FROM " . $table;
	$res = MysqliQuery($sql);
	$i = 0;
	while ($col = mysqli_fetch_assoc($res)) {
		if (!empty($col['Comment'])) {
			$structure[$i]['field'] = $col['Field'];
			$structure[$i]['name'] = $col['Comment'];
			$i++;
		}
	}

	return $structure;

}