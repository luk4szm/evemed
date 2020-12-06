<?php
session_start();
require_once __DIR__ . '/inc/whole-service.php';
require_once __DIR__ . '/inc/visits/scripts.php';

if (!isset($_SESSION['loggedUser'])) {
	$_SESSION['prevURL'] = $_SERVER['REQUEST_URI'];
	header('Location: /login.php');
	exit();
}

if (!empty($get_key)) {
   //service - adding new visit
	require_once __DIR__ . '/visits/formService/new.php';
	if ($get_key[0] == 'new' && isset($_POST['formStep'])) VisitNewAdd();
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<?php include __DIR__ . '/inc/head.php'; ?>
   <title>Wizyty - <?= SITE_NAME ?></title>
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
                  Wizyty
               </div>
               <div class="card-body">

                  <table width="100%">
                     <tr>
                        <td colspan="2">
                           <a href="/visits.php?list_future" class="menu">Lista wizyt zaplanowanych</a>
                        </td>
                     </tr>
                     <tr>
                        <td colspan="2">
                           <a href="/visits.php?list_past" class="menu">Lista wizyt odbyłych</a>
                        </td>
                     </tr>
                     <tr>
                        <td colspan="2">
                           <a href="/visits.php?list_cancel" class="menu">Lista wizyt anulowanych</a>
                        </td>
                     </tr>
                  </table>

                  <div class="row justify-content-center" style="margin-top: 15px">
                     <a class="btn btn-outline-info navbar-btn" href="/visits.php?new" role="button"
                        style="border-radius: 25px;">Zarejestruj nową wizytę</a>
                  </div>

               </div>
            </div>
         </div>

      </div>
      <div class="col-md-9">

			<?php
			if (!empty($get_key)) {
				switch ($get_key[0]) {
					case 'list_future':
						include __DIR__ . '/visits/list_future.php';
						break;
					case 'list_past':
						include __DIR__ . '/visits/list_past.php';
						break;
					case 'list_cancel':
						include __DIR__ . '/visits/list_cancel.php';
						break;
					case 'new':
						include __DIR__ . '/visits/new.php';
						break;
				}
			} else {
				include __DIR__ . '/visits/list_future.php';
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