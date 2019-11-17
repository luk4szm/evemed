<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/whole-service.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/visits/scripts.php';

if (!isset($_SESSION['loggedUser'])) {
	$_SESSION['prevURL'] = $_SERVER['REQUEST_URI'];
	header('Location: /login.php');
	exit();
}

if (!empty($get_key)) {
   //service - adding new visit
	require_once $_SERVER['DOCUMENT_ROOT'] . '/visits/formService/new.php';
	if ($get_key[0] == 'new' && isset($_POST['formStep'])) VisitNewAdd();
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/inc/head.php'; ?>
   <title>Wizyty - <?= SiteName() ?></title>
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

                  <hr>

                  <table width="100%">
                     <tr>
                        <td colspan="2">
                           <a href="/visits.php?new" class="menu">Dodaj nową wizytę</a>
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
					case 'list_future':
						include $_SERVER['DOCUMENT_ROOT'] . '/visits/list_future.php';
						break;
					case 'list_past':
						include $_SERVER['DOCUMENT_ROOT'] . '/visits/list_past.php';
						break;
					case 'list_cancel':
						include $_SERVER['DOCUMENT_ROOT'] . '/visits/list_cancel.php';
						break;
					case 'new':
						include $_SERVER['DOCUMENT_ROOT'] . '/visits/new.php';
						break;
				}
			} else {
				include $_SERVER['DOCUMENT_ROOT'] . '/visits/list_future.php';
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