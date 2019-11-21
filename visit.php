<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/whole-service.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/visits/scripts.php';

if (!isset($_SESSION['loggedUser'])) {
	$_SESSION['prevURL'] = $_SERVER['REQUEST_URI'];
	header('Location: /login.php');
	exit();
}

//TODO editing visit data

if (!empty($get_key)) {
	//service - add procedure to visit
	require_once $_SERVER['DOCUMENT_ROOT'] . '/visits/formService/procedure-add.php';
	if (isset($_POST['modalForm']) && $_POST['modalForm'] == 'AddProcedureToVisit') VisitAddProcedure();

	//service - edit procedure
	require_once $_SERVER['DOCUMENT_ROOT'] . '/visits/formService/procedure-edit.php';
	if (isset($_POST['modalForm']) && $_POST['modalForm'] == 'EditVisitProcedure') VisitEditProcedure();

	//service - delete procedure
	require_once $_SERVER['DOCUMENT_ROOT'] . '/visits/formService/procedure-delete.php';
	if (isset($_POST['modalForm']) && $_POST['modalForm'] == 'DeleteVisitProcedure') VisitDeleteProcedure();

	//service - add drug to visit
	require_once $_SERVER['DOCUMENT_ROOT'] . '/visits/formService/drug-add.php';
	if (isset($_POST['modalForm']) && $_POST['modalForm'] == 'AddDrugToVisit') VisitAddDrug();

	//service - edit procedure
	require_once $_SERVER['DOCUMENT_ROOT'] . '/visits/formService/drug-edit.php';
	if (isset($_POST['modalForm']) && $_POST['modalForm'] == 'EditVisitDrug') VisitEditDrug();

	//service - edit procedure
	require_once $_SERVER['DOCUMENT_ROOT'] . '/visits/formService/drug-delete.php';
	if (isset($_POST['modalForm']) && $_POST['modalForm'] == 'DeleteVisitDrug') VisitDeleteDrug();

	//service - chande date of visit
	require_once $_SERVER['DOCUMENT_ROOT'] . '/visits/formService/visit-change-date.php';
	if (isset($_POST['modalForm']) && $_POST['modalForm'] == 'VisitChangeDate') VisitChangeDate();

	//service - confirm visit
	require_once $_SERVER['DOCUMENT_ROOT'] . '/visits/formService/visit-confirm.php';
	if (isset($_POST['modalForm']) && $_POST['modalForm'] == 'VisitConfirm') VisitConfirm();

	//service - cancel visit
	require_once $_SERVER['DOCUMENT_ROOT'] . '/visits/formService/visit-cancel.php';
	if (isset($_POST['modalForm']) && $_POST['modalForm'] == 'VisitCancel') VisitCancel();

	//service - note whole list
	require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/notes/service-list.php';
}

if (!empty($get_key)) {
	$searchID = $_GET[$get_key[0]];
	$recon = VisitRecon($searchID);
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
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/inc/head.php'; ?>
   <title><?= $title . SiteName() ?></title>
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/inc/menu.php'; ?>

<div class="container">

	<?php include $_SERVER['DOCUMENT_ROOT'] . '/inc/glob-vars.php'; ?>

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
                              <a href="/visit.php?id=<?= $vis['ID'] ?>" class="menu">Karta wizyty</a>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <a href="/visit.php?procedures=<?= $vis['ID'] ?>" class="menu">Zabiegi</a>
                           </td>
                           <td class="text-right">
                              <span class="badge badge-light badge-menu"><?= $vis['procedures_count'] ?></span>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <a href="/visit.php?drugs=<?= $vis['ID'] ?>" class="menu">Przepisane leki</a>
                           </td>
                           <td class="text-right">
                              <span class="badge badge-light badge-menu"><?= $vis['drugs_count'] ?></span>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <a href="/visit.php?notes=<?= $vis['ID'] ?>" class="menu">Notatki</a>
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
				<?php
				echo '<pre>';
				print_r($vis);
				echo '</pre>';
				?>
         </div>
         <div class="col-md-9">

				<?php
				CheckSameTimeVisits($vis);
				if (!empty($get_key)) {
					switch ($get_key[0]) {
						case 'id':
							include $_SERVER['DOCUMENT_ROOT'] . '/visits/detail.php';
							include $_SERVER['DOCUMENT_ROOT'] . '/visits/status_change.php';
							include $_SERVER['DOCUMENT_ROOT'] . '/visits/procedures.php';
							include $_SERVER['DOCUMENT_ROOT'] . '/visits/drugs.php';
							include $_SERVER['DOCUMENT_ROOT'] . '/visits/notes.php';
							break;
						case 'procedures':
							include $_SERVER['DOCUMENT_ROOT'] . '/visits/procedures.php';
							break;
						case 'drugs':
							include $_SERVER['DOCUMENT_ROOT'] . '/visits/drugs.php';
							break;
						case 'notes':
							include $_SERVER['DOCUMENT_ROOT'] . '/visits/notes.php';
							break;
					}
				} else {
					include $_SERVER['DOCUMENT_ROOT'] . '/visits/detail.php';
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