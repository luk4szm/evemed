<?php

function TableStructure($table)
{

	$structure = array();
	$i = 0;

	$table_columns = PDO_Query('SHOW FULL COLUMNS FROM ' . $table);
	foreach ($table_columns AS $col) {
		if (!empty($col['Comment'])) {
			$structure[$i]['field'] = $col['Field'];
			$structure[$i]['name'] = $col['Comment'];
			$structure[$i]['type'] = $col['Type'];
			$i++;
		}
	}

	return $structure;

}