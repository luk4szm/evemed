<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/whole-service.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/procedures/scripts.php';

if (!isset($_SESSION['loggedUser'])) {
	$_SESSION['prevURL'] = $_SERVER['REQUEST_URI'];
	header('Location: /login.php');
	exit();
}

if (!empty($get_key)) {
   //service - adding new procedure
	require_once $_SERVER['DOCUMENT_ROOT'] . '/procedures/formService/new.php';
	if ($get_key[0] == 'new' && isset($_POST['formStep'])) ProcedureNewAdd();
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/inc/head.php'; ?>
   <title>Zabiegi - <?= SiteName() ?></title>
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

                  <hr>

                  <table width="100%">
                     <tr>
                        <td colspan="2">
                           <a href="/procedures.php?new" class="menu">Dodaj nowy zabieg</a>
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
						include $_SERVER['DOCUMENT_ROOT'] . '/procedures/list.php';
						break;
					case 'withdrawn':
						include $_SERVER['DOCUMENT_ROOT'] . '/procedures/withdrawn.php';
						break;
					case 'new':
						include $_SERVER['DOCUMENT_ROOT'] . '/procedures/new.php';
						break;
				}
			} else {
				include $_SERVER['DOCUMENT_ROOT'] . '/procedures/list.php';
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