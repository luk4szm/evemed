<?php

mb_internal_encoding("UTF-8");

define('SITE_TAG', 'evemed');
define('SITE_NAME', 'EveMed Cosmetics');

if ($_SERVER['SERVER_ADDR'] == '127.0.0.1') {
	define('DBNAME', 'evemed');
} else {
	define('DBNAME', 'vitro_evemed');
}

define('NOW', date("Y-m-d H:i:s"));
define('TODAY', date("Y-m-d"));
define('ACT_YEAR', date("Y"));

$get_key = array_keys($_GET);