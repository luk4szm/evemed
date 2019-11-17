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

	$searchID = $_GET[$get_key[0]];
	$recon = ProcedureRecon($searchID);
	if ($recon['code'] === 200) {
		$proc = $recon['result'];
		$title = $proc['name_short'] . ' - ';
	} else {
		$title = null;
	}

} else {

	$recon['txt'] = 'Nieprawidłowe zapytanie.';
	$title = null;

}

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

	<?php if (isset($proc)) { ?>

      <div class="row justify-content-center">
         <div class="col-md-3">

            <div class="sticky-top" style="top: 70px">
               <div class="card">
                  <div class="card-header">
							<?= $proc['name_short'] ?>
                  </div>
                  <div class="card-body">

                     <table width="100%">
                        <tr>
                           <td colspan="2">
                              <a href="/procedure.php?id=<?= $proc['ID'] ?>" class="menu">Karta zabiegu</a>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <a href="/procedure.php?notes=<?= $proc['ID'] ?>" class="menu">Notatki</a>
                           </td>
                           <td class="text-right">
                              <span class="badge badge-light badge-menu">0</span>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <a href="/procedure.php?change_history=<?= $proc['ID'] ?>" class="menu">Historia zmian</a>
                           </td>
                           <td class="text-right">
                              <span class="badge badge-light badge-menu"><?= $proc['change_history_count'] ?></span>
                           </td>
                        </tr>
                     </table>

                     <hr>

							<?php if ($proc['status'] == 1) { ?>
                        <a href="/procedure.php?edit=<?= $proc['ID'] ?>" class="menu">Edycja danych</a><br>
							<?php } ?>
                     <a href="/procedures.php" class="menu">Wróc do listy</a><br>

                  </div>
               </div>

					<?php
					echo '<pre>';
					print_r($proc);
					echo '</pre>';
					?>

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

		<?php
	} else {
		ShowInfoLabel($recon['txt'], 'red', 0);
	}
	?>

</div>

<?php

include $_SERVER['DOCUMENT_ROOT'] . '/inc/foot.php';
include $_SERVER['DOCUMENT_ROOT'] . '/inc/notify.php';

?>

</body>
</html>