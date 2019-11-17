<?php

function Breadcrump($input)
{

	if (is_array($input)) {
		$label = '';
		foreach ($input AS $item) {
			if ($item !== end($input)) $label .= '<li class="breadcrumb-item active">' . $item . '</li>';
			if ($item === end($input)) $label .= '<li class="breadcrumb-item">' . $item . '</li>';
		}
	} else {
		$label = '<li class="breadcrumb-item" style="font-style: italic">błąd zdefiniowanej listwy</li>';
	}

	$breadcrump = '
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			' . $label . '
		</ol>
	</nav>
	';

	return $breadcrump;

}