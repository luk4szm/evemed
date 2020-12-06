<?php

function UsersList()
{

	$sql = "
		SELECT e.id, u.login, e.first_name, e.last_name,
		       CONCAT(e.first_name, ' ', e.last_name) AS full_name
		FROM users AS u
		JOIN employees AS e ON e.id = u.id
	";
	$res = MysqliQuery($sql);

	if (mysqli_num_rows($res)) {
		while ($user = mysqli_fetch_assoc($res)) {
			$users[$user['id']] = $user;
		}
	} else {
		$users = null;
	}

	return $users;

}