<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/whole-service.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/patients/scripts.php';

if (!isset($_SESSION['loggedUser'])) {
	$_SESSION['prevURL'] = $_SERVER['REQUEST_URI'];
	header('Location: /login.php');
	exit();
}

if (!empty($get_key)) {
   //service - adding new patient
	require_once $_SERVER['DOCUMENT_ROOT'] . '/patients/formService/new.php';
	if ($get_key[0] == 'new' && isset($_POST['formStep'])) PatientNewAdd();
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/inc/head.php'; ?>
   <title>Pacjenci - <?= SiteName() ?></title>
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
                  Pacjenci
               </div>
               <div class="card-body">

                  <table width="100%">
                     <tr>
                        <td colspan="2">
                           <a href="/patients.php" class="menu">Lista pacjentów</a>
                        </td>
                     </tr>
                  </table>

                  <hr>

                  <table width="100%">
                     <tr>
                        <td colspan="2">
                           <a href="/patients.php?new" class="menu">Dodaj nowego pacjenta</a>
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
					case 'list':
						include $_SERVER['DOCUMENT_ROOT'] . '/patients/list.php';
						break;
					case 'new':
						include $_SERVER['DOCUMENT_ROOT'] . '/patients/new.php';
						break;
				}
			} else {
				include $_SERVER['DOCUMENT_ROOT'] . '/patients/list.php';
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