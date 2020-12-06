<?php

function FormatListFromLine($input)
{
	if (!empty($input)) {
		$pos = strpos($input, ',');

		if (is_numeric($pos) && $pos > 0) {
			$list = explode(',', $input);

			$output = '<ul style="margin: 0 15px">';
			foreach ($list AS $item) {
				$output .= '<li>' . trim($item) . '</li>';
			}
			$output .= '</ul>';

			return $output;
		} else {
			return $input;
		}
	} else {
		return '<span class="gray">brak</span>';
	}
}