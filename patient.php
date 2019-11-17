<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/whole-service.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/patients/scripts.php';

if (!isset($_SESSION['loggedUser'])) {
	$_SESSION['prevURL'] = $_SERVER['REQUEST_URI'];
	header('Location: /login.php');
	exit();
}

if (!empty($get_key)) {

	//service - edit patient info
	require_once $_SERVER['DOCUMENT_ROOT'] . '/patients/formService/edit.php';
	if ($get_key[0] == 'edit' && isset($_POST['formStep']) && $_POST['formStep'] == 'editPatientData') PatientEdit();

}

if (!empty($get_key)) {

	$searchID = $_GET[$get_key[0]];
	$recon = PatientRecon($searchID);
	if ($recon['code'] === 200) {
		$pat = $recon['result'];
		$title = $pat['full_name'] . ' - ';
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

	<?php if (isset($pat)) { ?>

      <div class="row justify-content-center">
         <div class="col-md-3">

            <div class="sticky-top" style="top: 70px">
               <div class="card">
                  <div class="card-header">
							<?= $pat['full_name'] ?>
                  </div>
                  <div class="card-body">

                     <table width="100%">
                        <tr>
                           <td colspan="2">
                              <a href="/patient.php?id=<?= $pat['ID'] ?>" class="menu">Karta pacjenta</a>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <a class="menu">Wizyty</a>
                           </td>
                           <td class="text-right">
                              <span class="badge badge-light badge-menu"><?= $pat['visits_count'] ?></span>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <a href="/patient.php?visits_future=<?= $pat['ID'] ?>" class="menu">&nbsp;- planowane</a>
                           </td>
                           <td class="text-right">
                              <span class="badge badge-light badge-menu"><?= $pat['visits_future_count'] ?></span>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <a href="/patient.php?visits_past=<?= $pat['ID'] ?>" class="menu">&nbsp;- minione</a>
                           </td>
                           <td class="text-right">
                              <span class="badge badge-light badge-menu"><?= $pat['visits_past_count'] ?></span>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <a href="/patient.php?visits_cancel=<?= $pat['ID'] ?>" class="menu">&nbsp;- anulowane</a>
                           </td>
                           <td class="text-right">
                              <span class="badge badge-light badge-menu"><?= $pat['visits_canc_count'] ?></span>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <a href="/patient.php?notes=<?= $pat['ID'] ?>" class="menu">Notatki</a>
                           </td>
                           <td class="text-right">
                              <span class="badge badge-light badge-menu">0</span>
                           </td>
                        </tr>
                        <?php if ($pat['change_history_count']) { ?>
                        <tr>
                           <td>
                              <a href="/patient.php?change_history=<?= $pat['ID'] ?>" class="menu">Historia zmian</a>
                           </td>
                           <td class="text-right">
                              <span class="badge badge-light badge-menu"><?= $pat['change_history_count'] ?></span>
                           </td>
                        </tr>
                        <?php } ?>
                     </table>

                     <hr>

                     <a href="/patient.php?edit=<?= $pat['ID'] ?>" class="menu">Edycja danych</a><br>
                     <a href="/patients.php" class="menu">Wróc do listy</a><br>

                  </div>
               </div>

               <?php
                  echo '<pre>';
                  print_r($pat);
                  echo '</pre>';
               ?>

            </div>

         </div>
         <div class="col-md-9">

				<?php
				if (!empty($get_key)) {
					switch ($get_key[0]) {
						case 'id':
							include $_SERVER['DOCUMENT_ROOT'] . '/patients/detail.php';
							include $_SERVER['DOCUMENT_ROOT'] . '/patients/visits_and_notes.php';
							break;
						case 'edit':
							include $_SERVER['DOCUMENT_ROOT'] . '/patients/edit.php';
							break;
						case 'visits_future':
							include $_SERVER['DOCUMENT_ROOT'] . '/patients/visits_future.php';
							break;
						case 'visits_past':
							include $_SERVER['DOCUMENT_ROOT'] . '/patients/visits_past.php';
							break;
						case 'visits_cancel':
							include $_SERVER['DOCUMENT_ROOT'] . '/patients/visits_cancel.php';
							break;
						case 'notes':
							include $_SERVER['DOCUMENT_ROOT'] . '/patients/notes.php';
							break;
						case 'change_history':
							include $_SERVER['DOCUMENT_ROOT'] . '/patients/change-history.php';
							break;
					}
				} else {
					include $_SERVER['DOCUMENT_ROOT'] . '/patients/detail.php';
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