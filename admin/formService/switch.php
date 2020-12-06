<?php

function SwitchParam($param)
{
	if ($_GET[$param] == 'on') {
		$_SESSION[$param] = true;
	}

	if ($_GET[$param] == 'off') {
		$_SESSION[$param] = false;
	}
}