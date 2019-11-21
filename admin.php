<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/whole-service.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/script/employee-list.php';

if (!isset($_SESSION['loggedUser'])) {
	if (IsSiteAdmin() === false) {
		$_SESSION['prevURL'] = $_SERVER['REQUEST_URI'];
		header('Location: /login.php');
		exit();
	}
}

$title = 'Panel administratora';
?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/inc/head.php'; ?>
   <title><?= $title . ' - ' . SiteName() ?></title>
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
						Organizacja
               </div>
               <div class="card-body">

                  <table width="100%">
                     <tr>
                        <td colspan="2">
                           <a href="/admin.php?employees" class="menu">Pracownicy</a>
                        </td>
                     </tr>
                  </table>

               </div>
            </div>
         </div>

         <div class="sticky-top" style="top: 70px">
            <div class="card">
               <div class="card-header">
						<?= $title ?>
               </div>
               <div class="card-body">

                  <table width="100%">
                     <tr>
                        <td colspan="2">
                           <a href="/admin.php?use-of-db" class="menu">Użycie indexów</a>
                        </td>
                     </tr>
                  </table>

               </div>
            </div>
         </div>

      </div>
      <div class="col-md-9">

			<?php
			if (!empty($get_key)) {
				switch ($get_key[0]) {
					case 'employees':
						include $_SERVER['DOCUMENT_ROOT'] . '/admin/employees.php';
						break;
					case 'use-of-db':
						include $_SERVER['DOCUMENT_ROOT'] . '/admin/use-of-db-index.php';
						break;
				}
			} else {
				include $_SERVER['DOCUMENT_ROOT'] . '/procedures/detail.php';
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