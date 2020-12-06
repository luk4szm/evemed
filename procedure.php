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
   //service - edit patient info
	require_once __DIR__ . '/procedures/formService/edit.php';
	if ($get_key[0] == 'edit' && isset($_POST['formStep']) && $_POST['formStep'] == 'editProcedureData') ProcedureEdit();

	//service - edit patient info
	require_once __DIR__ . '/procedures/formService/turn-off-on.php';
	if ($get_key[0] == 'id' && isset($_POST['modalForm']) && $_POST['modalForm'] == 'ProcedureTurnOff') ProcedureTurnOff();
	if ($get_key[0] == 'id' && isset($_POST['modalForm']) && $_POST['modalForm'] == 'ProcedureTurnOn') ProcedureTurnOn();

	//service - note whole list
	require_once __DIR__ . '/inc/notes/service-list.php';
}

if (!empty($get_key)) {
	$searchid = $_GET[$get_key[0]];
	$recon = ProcedureRecon($searchid);
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
	<?php include __DIR__ . '/inc/head.php'; ?>
   <title><?= $title . SITE_NAME ?></title>
</head>
<body>

<?php
include __DIR__ . '/inc/menu.php';
include __DIR__ . '/inc/glob-vars.php';

if (isset($proc)) {
	ItemInfoHead($proc);
}
?>

<div class="container">

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
                              <a href="/procedure.php?id=<?= $proc['id'] ?>" class="menu">Karta zabiegu</a>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <a href="/procedure.php?notes=<?= $proc['id'] ?>" class="menu">Notatki</a>
                           </td>
                           <td class="text-right">
                              <span class="badge badge-light badge-menu"><?= $proc['notes_count'] ?></span>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <a href="/procedure.php?change_history=<?= $proc['id'] ?>" class="menu">Historia zmian</a>
                           </td>
                           <td class="text-right">
                              <span class="badge badge-light badge-menu"><?= $proc['change_history_count'] ?></span>
                           </td>
                        </tr>
                     </table>

                     <hr>

							<?php if ($proc['status'] == 1) { ?>
                        <a href="/procedure.php?edit=<?= $proc['id'] ?>" class="menu">Edycja danych</a><br>
							<?php } ?>
                     <a href="<?= $_SESSION['prev_url']; ?>" class="menu">Wróc do poprz. karty</a>

                  </div>
               </div>
            </div>

         </div>
         <div class="col-md-9">

				<?php
				if (!empty($get_key)) {
					switch ($get_key[0]) {
						case 'id':
							include __DIR__ . '/procedures/detail.php';
							include __DIR__ . '/procedures/visit-future-occurr.php';
							include __DIR__ . '/procedures/visit-past-occurr.php';
							include __DIR__ . '/procedures/status_change.php';
							break;
						case 'edit':
							include __DIR__ . '/procedures/edit.php';
							break;
						case 'notes':
							include __DIR__ . '/procedures/notes.php';
							break;
						case 'change_history':
							include __DIR__ . '/procedures/change-history.php';
							break;
					}
				} else {
					include __DIR__ . '/procedures/detail.php';
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
if (isset($proc)) {
	ItemInfoFoot();
}

include __DIR__ . '/inc/foot.php';
include __DIR__ . '/inc/notify.php';
?>

</body>
</html>