<?php

function PersonAge ($dateOfBirth) {

	$diff = date_diff(date_create($dateOfBirth), date_create(TODAY));

	return $diff->y;

}