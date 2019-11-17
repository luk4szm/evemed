<?php

function ResponseDetail($result)
{

	if (mysqli_num_rows($result) == 1) {

		$response['code'] = 200;
		$response['txt'] = 'Zapytanie poprawne.';
		$response['result'] = mysqli_fetch_assoc($result);

	} elseif (mysqli_num_rows($result) > 1) {

		$response['code'] = 300;
		$response['txt'] = 'Zbyt wiele pasujących wyników.';

	} else {

		$response['code'] = 404;
		$response['txt'] = 'Nie znaleziono.';

	}

	return $response;

}