<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/whole-service.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/employees/scripts.php';

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
   <title>Kadra - <?= SiteName() ?></title>
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/inc/menu.php'; ?>

<div class="container">

	<?php include $_SERVER['DOCUMENT_ROOT'] . '/inc/glob-vars.php'; ?>

   <div class="row justify-content-center">
      <div class="col-md-3">

         <div class="sticky-top" style="top: 70px">
            <div class="card">
               <div class="card-header">
                  Kadra
               </div>
               <div class="card-body">

                  <table width="100%">
                     <tr>
                        <td colspan="2">
                           <a href="/employees.php" class="menu">Lista pracowników</a>
                        </td>
                     </tr>
                     <tr>
                        <td colspan="2">
                           <a href="/employees.php?list=dismissed" class="menu">Lista byłych pracowników</a>
                        </td>
                     </tr>
                  </table>

                  <div class="row justify-content-center" style="margin-top: 15px">
                     <a class="btn btn-outline-info navbar-btn" href="/employees.php?new" role="button"
                        style="border-radius: 25px;">Dodaj nowego pracownika</a>
                  </div>

               </div>
            </div>
         </div>

      </div>
      <div class="col-md-9">

			<?php
			if (!empty($get_key)) {
				switch ($get_key[0]) {
					case 'list':
						include $_SERVER['DOCUMENT_ROOT'] . '/employees/list.php';
						break;
					case 'new':
						include $_SERVER['DOCUMENT_ROOT'] . '/employees/new.php';
						break;
				}
			} else {
				include $_SERVER['DOCUMENT_ROOT'] . '/employees/list.php';
			}
			?>

      </div>
   </div>
</div>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/inc/foot.php';
include $_SERVER['DOCUMENT_ROOT'] . '/inc/notify.php';
?>

</body>
</html>