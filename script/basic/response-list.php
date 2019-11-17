<?php

function ResponseList($result)
{

	if (mysqli_num_rows($result)) {
		$response['code'] = 200;
		$response['list_count'] = mysqli_num_rows($result);
		$response['txt'] = 'Zapytanie poprawne. Zwrócono wyników: ' . $response['list_count'];
		while ($item = mysqli_fetch_assoc($result)) {
			$list[] = $item;
		}
	} else {
		$response['code'] = 204;
		$response['list_count'] = 0;
		$response['txt'] = 'Zapytanie poprawne. Zwrócono wyników: ' . $response['list_count'];
	}

	$response['result'] = (!empty($list)) ? $list : null;

	return $response;

}