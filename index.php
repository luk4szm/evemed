<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/whole-service.php';

if (!isset($_SESSION['loggedUser'])) {
	$_SESSION['prevURL'] = $_SERVER['REQUEST_URI'];
	header('Location: /login.php');
	exit();
}

?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/inc/head.php'; ?>
   <title><?= SiteName() ?></title>
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/inc/menu.php'; ?>

<div class="container">

	<?php include $_SERVER['DOCUMENT_ROOT'] . '/inc/glob-vars.php'; ?>

   <div class="row justify-content-center">
      <div class="col-md-8">


      </div>
   </div>
</div>

<?php

include $_SERVER['DOCUMENT_ROOT'] . '/inc/foot.php';
include $_SERVER['DOCUMENT_ROOT'] . '/inc/notify.php';

?>

</body>
</html>