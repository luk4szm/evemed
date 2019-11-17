<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/whole-service.php';

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
   <title><?= $title . SiteName() ?></title>
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
						<?= $title ?>
               </div>
               <div class="card-body">

                  <table width="100%">
                     <tr>
                        <td colspan="2">
                           <a href="/admin.php?basic" class="menu">Ustawienia ogólne</a>
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
					case 'id':
						include $_SERVER['DOCUMENT_ROOT'] . '/procedures/detail.php';
						include $_SERVER['DOCUMENT_ROOT'] . '/procedures/visit-future-occurr.php';
						include $_SERVER['DOCUMENT_ROOT'] . '/procedures/visit-past-occurr.php';
						break;
					case 'edit':
						include $_SERVER['DOCUMENT_ROOT'] . '/procedures/edit.php';
						break;
					case 'notes':
						include $_SERVER['DOCUMENT_ROOT'] . '/procedures/notes.php';
						break;
					case 'change_history':
						include $_SERVER['DOCUMENT_ROOT'] . '/procedures/change-history.php';
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