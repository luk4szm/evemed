<?php

function PersonAge ($dateOfBirth) {

	global $today;

	$diff = date_diff(date_create($dateOfBirth), date_create($today));

	return $diff->y;

}