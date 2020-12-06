<?php
session_start();
require_once __DIR__ . '/inc/whole-service.php';
require_once __DIR__ . '/inc/procedures/scripts.php';

if (!isset($_SESSION['loggedUser'])) {
	$_SESSION['prevURL'] = $_SERVER['REQUEST_URI'];
	header('Location: /login.php');
	exit();
}

if (!empty($get_key)) {
   //service - adding new procedure
	require_once __DIR__ . '/procedures/formService/new.php';
	if ($get_key[0] == 'new' && isset($_POST['formStep'])) ProcedureNewAdd();
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<?php include __DIR__ . '/inc/head.php'; ?>
   <title>Zabiegi - <?= SITE_NAME ?></title>
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
                  Zabiegi
               </div>
               <div class="card-body">

                  <table width="100%">
                     <tr>
                        <td colspan="2">
                           <a href="/procedures.php?list" class="menu">Lista zabiegów</a>
                        </td>
                     </tr>
                     <tr>
                        <td colspan="2">
                           <a href="/procedures.php?withdrawn" class="menu">Zabiegi wycofane</a>
                        </td>
                     </tr>
                  </table>

                  <div class="row justify-content-center" style="margin-top: 15px">
                     <a class="btn btn-outline-info navbar-btn" href="/procedures.php?new" role="button"
                        style="border-radius: 25px;">Dodaj nowy zabieg</a>
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
						include __DIR__ . '/procedures/list.php';
						break;
					case 'withdrawn':
						include __DIR__ . '/procedures/withdrawn.php';
						break;
					case 'new':
						include __DIR__ . '/procedures/new.php';
						break;
				}
			} else {
				include __DIR__ . '/procedures/list.php';
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