<?php

define('__MDIR__', $_SERVER['DOCUMENT_ROOT']);

if (empty($_SESSION['notify'])) $_SESSION['notify'] = array();

//configuration
require_once __MDIR__ . '/inc/config.php';

//basic
require_once __MDIR__ . '/script/basic/is_admin.php';
require_once __MDIR__ . '/script/basic/is_logged.php';

require_once __MDIR__ . '/script/basic/breadcrumb.php';
require_once __MDIR__ . '/script/basic/progress_bar.php';
require_once __MDIR__ . '/script/basic/response-list.php';
require_once __MDIR__ . '/script/basic/response-detail.php';
require_once __MDIR__ . '/script/basic/item_info.php';

//date
require_once __MDIR__ . '/script/date/date-convert.php';
require_once __MDIR__ . '/script/date/person-age.php';

//format result
require_once __MDIR__ . '/script/format/address.php';
require_once __MDIR__ . '/script/format/nr_tel.php';
require_once __MDIR__ . '/script/format/is_null.php';
require_once __MDIR__ . '/script/format/list_from_line.php';
require_once __MDIR__ . '/script/format/price.php';
require_once __MDIR__ . '/script/format/visit_status.php';

//database
require_once __MDIR__ . '/script/database/connect.php';
require_once __MDIR__ . '/script/database/table-structure.php';
require_once __MDIR__ . '/script/database/users-list.php';
require_once __MDIR__ . '/script/database/pdo-connect.php';

//notes
require_once __MDIR__ . '/inc/notes/scripts.php';

//userInfo
require_once __MDIR__ . '/script/user/userIP.php';
require_once __MDIR__ . '/script/user/userBrowser.php';

//form scripts
require_once __MDIR__ . '/script/form/hash.php';
require_once __MDIR__ . '/script/form/filter.php';
require_once __MDIR__ . '/script/form/value.php';
require_once __MDIR__ . '/script/form/clean_button.php';

//alerts & notification
require_once __MDIR__ . '/script/alert/alerts.php';
require_once __MDIR__ . '/script/notif/notifyMaker.php';

//link to previous card
if (isset($_SERVER['HTTP_REFERER'])) {
	if (!strstr($_SERVER['HTTP_REFERER'], basename($_SERVER['PHP_SELF']))) {
		$_SESSION['prev_url'] = $_SERVER['HTTP_REFERER'];
	}
}