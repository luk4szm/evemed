<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/whole-service.php';
?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/inc/head.php'; ?>
   <title><?= SiteName() ?></title>
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/inc/menu.php'; ?>

<div class="container-fluid">

   <div class="d-flex justify-content-between">

      <div>

			<?php
			echo '<pre>';
			print_r($_SESSION);
			echo '</pre>';
			?>

      </div>

      <div>

			<?php
			echo '<pre>';
			print_r($_COOKIE);
			echo '</pre>';

			?>

      </div>

      <div>

			<?php
			echo '<pre>';
			print_r($_SERVER);
			echo '</pre>';
			?>

      </div>

   </div>

</div>

<?php

unset($_SESSION['procNew']);
include $_SERVER['DOCUMENT_ROOT'] . '/inc/foot.php';
include $_SERVER['DOCUMENT_ROOT'] . '/inc/notify.php';

?>

</body>
</html>