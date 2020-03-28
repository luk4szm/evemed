<?php

if ($_SERVER['SERVER_ADDR'] == '127.0.0.1') {
	return [
		'host' => 'localhost',
		'user' => 'root',
		'password' => '',
		'database' => 'evemed'
	];
} else {
	return [
		'host' => 'sql5.progreso.pl',
		'user' => 'vitro_evemed',
		'password' => 'rQD!GdYQyXy8VRk',
		'database' => 'vitro_evemed'
	];
}