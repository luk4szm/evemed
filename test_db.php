<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/whole-service.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/visits/scripts.php';

$id = 0;

$query = $db->prepare('SELECT * FROM employees WHERE ID >= :ID');
echo '<pre>';
var_dump($query);
echo '</pre>';

$query->bindValue(':ID', $id, PDO::PARAM_INT);
$query->execute();

$users = $query->fetchAll(PDO::FETCH_ASSOC);
echo '<pre>';
var_dump($users);
echo '</pre>';

foreach ($users AS $user) {
	var_dump($user);
}


$query = $db->query('SELECT * FROM employees WHERE ID >= 0');
echo '<pre>';
var_dump($query);
echo '</pre>';
$users = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($users AS $user) {
	var_dump($user);
}
