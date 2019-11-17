<?php

mb_internal_encoding("UTF-8");


$dbName = 'evemed';


$get_key = array_keys($_GET);

$now = date("Y-m-d H:i:s");
$today = date("Y-m-d");
$actYear = substr($today, 0, 4);

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