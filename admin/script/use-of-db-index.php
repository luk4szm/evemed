<?php

function UseOfDbIndex()
{
	$intTypes = array(
		'tinyint' => pow(2, 7) - 1,
		'smallint' => pow(2, 15) - 1,
		'mediumint' => pow(2, 23) - 1,
		'int' => pow(2, 31) - 1,
		'bigint' => pow(2, 63) - 1,
	);

	$sql = "SHOW TABLES FROM " . DBNAME;
	$res = MysqliQuery($sql);

	$dbTab = array();
	while ($obj = mysqli_fetch_assoc($res)) {
		$tabName = $obj['Tables_in_' . DBNAME];

		$sql = "SHOW FIELDS
           FROM " . DBNAME . '.' . $tabName . "
           WHERE Field = 'id'";
		$tab = mysqli_fetch_assoc(MysqliQuery($sql));
		$tab['Type'] = explode('(', $tab['Type']);
		$tab['name'] = $tabName;
		$tab['colType'] = $tab['Type'][0];
		$tab['colLeng'] = substr($tab['Type'][1], 0, -1);

		$sql = "SELECT MAX(id) AS quant
           	  FROM " . DBNAME . '.' . $tabName;
		$qua = mysqli_fetch_assoc(MysqliQuery($sql));
		$tab['quant'] = $qua['quant'];
		$tab['usage'] = number_format(100 * $qua['quant'] / $intTypes[$tab['colType']], 2, ".", " ");

		array_push($dbTab, $tab);
	}

	array_multisort(
		array_column($dbTab, 'usage'), SORT_DESC,
		array_column($dbTab, 'quant'), SORT_DESC,
		$dbTab
	);

	return $dbTab;
}

function DbIndexOvercrowded($max_value)
{
	$dbTab = UseOfDbIndex();

	foreach ($dbTab AS $db) {
		if ($db['usage'] >= $max_value) $dbOvercrowded[] = $db;
	}

	if (isset($dbOvercrowded)) {
		return $dbOvercrowded;
	} else {
		return null;
	}
}