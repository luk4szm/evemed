<?php

function FormatPrice($price, $desc = NULL)
{
	if (!$price) {
		$price = 0;
	} else {
		$price = str_replace(',', '.', $price);
	}
	$desc = ($desc) ? 'style="cursor: help" title="' . $desc . ' "' : '';

	return '<span ' . $desc . '>' . number_format($price, 2, ",", " ") . ' PLN</span>';
}
