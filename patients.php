<?php
session_start();
require_once __DIR__ . '/inc/whole-service.php';
require_once __DIR__ . '/inc/patients/scripts.php';

if (!isset($_SESSION['loggedUser'])) {
	$_SESSION['prevURL'] = $_SERVER['REQUEST_URI'];
	header('Location: /login.php');
	exit();
}

if (!empty($get_key)) {
   //service - adding new patient
	require_once __DIR__ . '/patients/formService/new.php';
	if ($get_key[0] == 'new' && isset($_POST['formStep'])) PatientNewAdd();
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<?php include __DIR__ . '/inc/head.php'; ?>
   <title>Pacjenci - <?= SITE_NAME ?></title>
</head>
<body>

<?php
include __DIR__ . '/inc/menu.php';
include __DIR__ . '/inc/glob-vars.php';
?>

<div class="container">
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

                  <div class="row justify-content-center" style="margin-top: 15px">
                     <a class="btn btn-outline-info navbar-btn" href="/patients.php?new" role="button"
                        style="border-radius: 25px;">Dodaj nowego pacjenta</a>
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
						include __DIR__ . '/patients/list.php';
						break;
					case 'new':
						include __DIR__ . '/patients/new.php';
						break;
				}
			} else {
				include __DIR__ . '/patients/list.php';
			}
			?>

      </div>
   </div>
</div>

<?php

include __DIR__ . '/inc/foot.php';
include __DIR__ . '/inc/notify.php';

?>

</body>
</html>