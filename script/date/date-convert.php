<?php

function DateConvert($datetime, $without_sec = null)
{

	if ($datetime) {

		$datetime = str_replace('T', ' ', $datetime);
		$datetime = explode(" ", $datetime);

		//data w formacie [RRRR-MM-DD]
		$datetime['date'] = $datetime[0];

		$data = explode("-", $datetime['date']);
		$data = $data[2] . '.' . $data[1] . '.' . $data[0];
		if (!empty($datetime[1])) {
			if ($without_sec) {
				$data .= ' ' . substr($datetime[1], 0, 5);
			} else {
				$data .= ' ' . $datetime[1];
			}
		}

	} else {

		$data = null;
	}

	return $data;

}


function OnlyDate($datetime)
{

	if ($datetime) {

		$datetime = explode(" ", $datetime);
		return $datetime[0];

	} else {

		return null;

	}

}

