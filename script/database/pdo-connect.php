<?php

function PDO()
{

$conf = require_once 'db_config.php';

try {
	$conn = new PDO(
		"mysql:host={$conf['host']}; dbname={$conf['database']}; charset=utf8",
		$conf['user'],
		$conf['password'],
		[
			PDO::ATTR_EMULATE_PREPARES => false,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		]
	);
} catch (PDOException $error) {
	echo $error->getMessage();
	exit($error);
}

return $conn;

}