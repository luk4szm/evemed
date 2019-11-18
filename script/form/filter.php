<?php

function FormFilter($input, $mode = null)
{

	$spec_chars = array(
		array(
			'in' => '&#13;&#10;',
			'out' => "\n",
		),
		array(
			'in' => '&#38;',
			'out' => '&',
		),
//		array(
//			'in' => '&#39;',
//			'out' => '\'',
//		),
//		array(
//			'in' => '&#34;',
//			'out' => '"',
//		),
		array(
			'in' => '&#60;',
			'out' => '<',
		),
		array(
			'in' => '&#62;',
			'out' => '>',
		),
	);

	switch ($mode) {
		case 'login':
			return preg_replace('/[^a-zA-Z^]/', '', $input);
		case 'into_database':
			$var = filter_var($input, FILTER_SANITIZE_SPECIAL_CHARS);
			foreach ($spec_chars AS $char) {
				$var = str_replace($char['in'], $char['out'], $var);
			}
			return trim($var);
		case 'price':
			$price = preg_replace('/[^0-9,.^-]/', '', $input);
			return $price = str_replace(',', '.', $price);
		default:
			return trim(str_replace('&#13;&#10;', "\n", filter_var($input, FILTER_SANITIZE_SPECIAL_CHARS)));
	}

}