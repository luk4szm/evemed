<?php

function FormValue($value, $mode = null)
{
	if (!empty($value)) {
		switch ($mode) {
			case 'datetime':
				return str_replace(' ',  'T', $value);
				break;
			default:
		return $value;
		}
	} else {
		return null;
	}
}