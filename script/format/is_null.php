<?php

function FormatIsNull($item, $feedback = null, $class = null)
{

	$feedback = empty($feedback) ? 'bd.' : $feedback;
	$class = empty($class) ? 'f300 gray' : $class;

	if (empty($item)) {
		return '<span class="' . $class . '">' . $feedback . '</span>';
	} else {
		return nl2br($item);
	}

}