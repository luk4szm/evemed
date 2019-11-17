<?php

function FormatPrice($price, $desc = NULL)
{

	$desc = ($desc) ? 'style="cursor: help" title="' . $desc . ' "' : '';

	return '<span ' . $desc . '>' . number_format($price, 2, ",", " ") . ' PLN</span>';

}
