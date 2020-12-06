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
	//service - add procedure to visit
	require_once __DIR__ . '/visits/formService/procedure-add.php';
	if (isset($_POST['modalForm']) && $_POST['modalForm'] == 'AddProcedureToVisit') VisitAddProcedure();

	//service - edit procedure
	require_once __DIR__ . '/visits/formService/procedure-edit.php';
	if (isset($_POST['modalForm']) && $_POST['modalForm'] == 'EditVisitProcedure') VisitEditProcedure();

	//service - delete procedure
	require_once __DIR__ . '/visits/formService/procedure-delete.php';
	if (isset($_POST['modalForm']) && $_POST['modalForm'] == 'DeleteVisitProcedure') VisitDeleteProcedure();

	//service - add drug to visit
	require_once __DIR__ . '/visits/formService/drug-add.php';
	if (isset($_POST['modalForm']) && $_POST['modalForm'] == 'AddDrugToVisit') VisitAddDrug();

	//service - edit procedure
	require_once __DIR__ . '/visits/formService/drug-edit.php';
	if (isset($_POST['modalForm']) && $_POST['modalForm'] == 'EditVisitDrug') VisitEditDrug();

	//service - edit procedure
	require_once __DIR__ . '/visits/formService/drug-delete.php';
	if (isset($_POST['modalForm']) && $_POST['modalForm'] == 'DeleteVisitDrug') VisitDeleteDrug();

	//service - chande date of visit
	require_once __DIR__ . '/visits/formService/visit-change-date.php';
	if (isset($_POST['modalForm']) && $_POST['modalForm'] == 'VisitChangeDate') VisitChangeDate();

	//service - confirm visit
	require_once __DIR__ . '/visits/formService/visit-confirm.php';
	if (isset($_POST['modalForm']) && $_POST['modalForm'] == 'VisitConfirm') VisitConfirm();

	//service - cancel visit
	require_once __DIR__ . '/visits/formService/visit-cancel.php';
	if (isset($_POST['modalForm']) && $_POST['modalForm'] == 'VisitCancel') VisitCancel();

	//service - note whole list
	require_once __DIR__ . '/inc/notes/service-list.php';
}

if (!empty($get_key)) {
	$searchid = $_GET[$get_key[0]];
	$recon = VisitRecon($searchid);
	if ($recon['code'] === 200) {
		$vis = $recon['result'];
		$title = 'Wizyta ' . DateConvert($vis['visit_date'], true) . ' - ';
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

if (isset($vis)) {
	ItemInfoHead($vis);
}
?>

<div class="container">

	<?php if (isset($vis)) { ?>

      <div class="row justify-content-center">
         <div class="col-md-3">

            <div class="sticky-top" style="top: 70px">
               <div class="card">
                  <div class="card-header">
                     Wizyta
                  </div>
                  <div class="card-body">

                     <table width="100%">
                        <tr>
                           <td colspan="2">
                              <a href="/visit.php?id=<?= $vis['id'] ?>" class="menu">Karta wizyty</a>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <a href="/visit.php?procedures=<?= $vis['id'] ?>" class="menu">Zabiegi</a>
                           </td>
                           <td class="text-right">
                              <span class="badge badge-light badge-menu"><?= $vis['procedures_count'] ?></span>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <a href="/visit.php?drugs=<?= $vis['id'] ?>" class="menu">Przepisane leki</a>
                           </td>
                           <td class="text-right">
                              <span class="badge badge-light badge-menu"><?= $vis['drugs_count'] ?></span>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <a href="/visit.php?notes=<?= $vis['id'] ?>" class="menu">Notatki</a>
                           </td>
                           <td class="text-right">
                              <span class="badge badge-light badge-menu"><?= $vis['notes_count'] ?></span>
                           </td>
                        </tr>
                     </table>

                     <hr>
                     <a href="<?= $_SESSION['prev_url']; ?>" class="menu">Wróc do poprz. karty</a>

                  </div>
               </div>
            </div>
         </div>

         <div class="col-md-9">

				<?php
				CheckSameTimeVisits($vis);
				if (!empty($get_key)) {
					switch ($get_key[0]) {
						case 'id':
							include __DIR__ . '/visits/detail.php';
							include __DIR__ . '/visits/status_change.php';
							include __DIR__ . '/visits/procedures.php';
							include __DIR__ . '/visits/drugs.php';
							include __DIR__ . '/visits/notes.php';
							break;
						case 'procedures':
							include __DIR__ . '/visits/procedures.php';
							break;
						case 'drugs':
							include __DIR__ . '/visits/drugs.php';
							break;
						case 'notes':
							include __DIR__ . '/visits/notes.php';
							break;
					}
				} else {
					include __DIR__ . '/visits/detail.php';
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
if (isset($vis)) {
	ItemInfoFoot();
}

include __DIR__ . '/inc/foot.php';
include __DIR__ . '/inc/notify.php';
?>

</body>
</html>