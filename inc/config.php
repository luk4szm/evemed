<?php

mb_internal_encoding("UTF-8");

if ($_SERVER['SERVER_ADDR'] == '127.0.0.1') {
	$dbName = 'evemed';
} else {
	$dbName = 'vitro_evemed';
}

$get_key = array_keys($_GET);

$now = date("Y-m-d H:i:s");
$today = date("Y-m-d");
$actYear = date("Y");

function SiteTag()
{
	return 'evemed';
}

function SiteName()
{
	return 'EveMed Cosmetics';
}

function SiteVersion()
{
	return 'desktop';
}