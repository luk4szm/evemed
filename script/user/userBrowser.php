<?php

function UserBrowser()
{

	$arr_browsers = ["Firefox", "Chrome", "Safari", "Opera", "MSIE", "Trident", "Edge"];

	$agent = $_SERVER['HTTP_USER_AGENT'];

	$user_browser = '';
	foreach ($arr_browsers as $browser) {
		if (strpos($agent, $browser) !== false) {
			$user_browser = $browser;
			break;
		}
	}

	if ($user_browser == 'MSIE') $user_browser = 'Internet Explorer';

	return $user_browser;

}