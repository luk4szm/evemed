<?php

function FormatAddress($item)
{

	$res = '';

	if (!empty($item['street'])) $res .= $item['street'] . '<br>';
	if (!empty($item['postal_code'])) $res .= $item['postal_code'] . ' ';
	if (!empty($item['city'])) $res .= $item['city'];


	return $res;

}