<?php
session_start();
require_once __DIR__ . '/inc/whole-service.php';
require_once __DIR__ . '/employees/script/list.php';

$conn = PDO();
function EmpRecon($id)
{

	global $conn;

	$query = $conn->prepare("
		SELECT *
		FROM employees
		WHERE id = :id
	");
	$query->bindValue('id', $id, PDO::PARAM_INT);
	$query->execute();
	unset($pdo);

	return $query->fetchAll();

}

$user = EmpRecon(1);

echo '<pre>';
var_dump($user);
echo '</pre>';


