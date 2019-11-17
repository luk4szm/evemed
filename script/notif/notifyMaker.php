<?php

function NotifyMake($type, $message, $icon = null)
{

	$iconPush = ($icon) ? "'icon' => 'fa fa-$icon'" : '';

	$notify = array(
		'message' => $message,
		'type' => $type,
		$iconPush
	);


	$_SESSION['notify'][] = $notify;

}