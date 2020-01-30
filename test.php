<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/whole-service.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/visits/scripts.php';

$table = TableStructure('patients');
var_dump($table);