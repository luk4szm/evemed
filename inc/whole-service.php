<?php

if (empty($_SESSION['notify'])) $_SESSION['notify'] = array();

//configuration
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/config.php';

//basic
require_once $_SERVER['DOCUMENT_ROOT'] . '/script/basic/is_admin.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/script/basic/breadcrumb.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/script/basic/progress_bar.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/script/basic/response-list.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/script/basic/response-detail.php';

//date
require_once $_SERVER['DOCUMENT_ROOT'] . '/script/date/date-convert.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/script/date/person-age.php';

//format result
require_once $_SERVER['DOCUMENT_ROOT'] . '/script/format/address.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/script/format/nr_tel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/script/format/is_null.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/script/format/list_from_line.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/script/format/price.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/script/format/visit_status.php';

//database
require_once $_SERVER['DOCUMENT_ROOT'] . '/script/database/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/script/database/table-structure.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/script/database/users-list.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/script/database/pdo-connect.php';

//notes
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/notes/scripts.php';

//userInfo
require_once $_SERVER['DOCUMENT_ROOT'] . '/script/user/userIP.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/script/user/userBrowser.php';

//form scripts
require_once $_SERVER['DOCUMENT_ROOT'] . '/script/form/hash.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/script/form/filter.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/script/form/value.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/script/form/clean_button.php';

//alerts & notification
require_once $_SERVER['DOCUMENT_ROOT'] . '/script/alert/alerts.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/script/notif/notifyMaker.php';

if (isset($_SERVER['HTTP_REFERER'])) {
	if (!strstr($_SERVER['HTTP_REFERER'], basename($_SERVER['PHP_SELF']))) {
		$_SESSION['prev_url'] = $_SERVER['HTTP_REFERER'];
	}
}