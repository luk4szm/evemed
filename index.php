<?php
session_start();
require_once __DIR__ . '/inc/whole-service.php';

if (!isset($_SESSION['loggedUser'])) {
	$_SESSION['prevURL'] = $_SERVER['REQUEST_URI'];
	header('Location: /login.php');
	exit();
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<?php include __DIR__ . '/inc/head.php'; ?>
   <title><?= SiteName() ?></title>
</head>
<body>
<?php include __DIR__ . '/inc/menu.php'; ?>

<div class="container">

	<?php include __DIR__ . '/inc/glob-vars.php'; ?>

   <div class="row justify-content-center">
      <div class="col-md-8">

      </div>
   </div>
</div>

<?php
include __DIR__ . '/inc/foot.php';
include __DIR__ . '/inc/notify.php';
?>

</body>
</html>