<?php
session_start();
require_once __DIR__ . '/inc/whole-service.php';
require_once __DIR__ . '/inc/patients/scripts.php';

if (!isset($_SESSION['loggedUser'])) {
	$_SESSION['prevURL'] = $_SERVER['REQUEST_URI'];
	header('Location: /login.php');
	exit();
}

if (!empty($get_key)) {
	//service - edit patient info
	require_once __DIR__ . '/patients/formService/edit.php';
	if ($get_key[0] == 'edit' && isset($_POST['formStep']) && $_POST['formStep'] == 'editPatientData') PatientEdit();

	//service - note whole list
	require_once __DIR__ . '/inc/notes/service-list.php';
}

if (!empty($get_key)) {
	$searchid = $_GET[$get_key[0]];
	$recon = PatientRecon($searchid);
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
	<?php include __DIR__ . '/inc/head.php'; ?>
   <title><?= $title . SITE_NAME ?></title>
</head>
<body>

<?php
include __DIR__ . '/inc/menu.php';
include __DIR__ . '/inc/glob-vars.php';

if (isset($pat)) {
	ItemInfoHead($pat);
}
?>

<div class="container">

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
                              <a href="/patient.php?id=<?= $pat['id'] ?>" class="menu">Karta pacjenta</a>
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
                              <a href="/patient.php?visits_future=<?= $pat['id'] ?>" class="menu">&nbsp;- planowane</a>
                           </td>
                           <td class="text-right">
                              <span class="badge badge-light badge-menu"><?= $pat['visits_future_count'] ?></span>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <a href="/patient.php?visits_past=<?= $pat['id'] ?>" class="menu">&nbsp;- minione</a>
                           </td>
                           <td class="text-right">
                              <span class="badge badge-light badge-menu"><?= $pat['visits_past_count'] ?></span>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <a href="/patient.php?visits_cancel=<?= $pat['id'] ?>" class="menu">&nbsp;- anulowane</a>
                           </td>
                           <td class="text-right">
                              <span class="badge badge-light badge-menu"><?= $pat['visits_canc_count'] ?></span>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <a href="/patient.php?notes=<?= $pat['id'] ?>" class="menu">Notatki</a>
                           </td>
                           <td class="text-right">
                              <span class="badge badge-light badge-menu"><?= $pat['notes_count'] ?></span>
                           </td>
                        </tr>
								<?php if ($pat['change_history_count']) { ?>
                           <tr>
                              <td>
                                 <a href="/patient.php?change_history=<?= $pat['id'] ?>" class="menu">Historia zmian</a>
                              </td>
                              <td class="text-right">
                                 <span class="badge badge-light badge-menu"><?= $pat['change_history_count'] ?></span>
                              </td>
                           </tr>
								<?php } ?>
                     </table>

                     <hr>

                     <a href="/patient.php?edit=<?= $pat['id'] ?>" class="menu">Edycja danych</a><br>
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
							include __DIR__ . '/patients/detail.php';
							include __DIR__ . '/patients/visits_and_notes.php';
							break;
						case 'edit':
							include __DIR__ . '/patients/edit.php';
							break;
						case 'visits_future':
							include __DIR__ . '/patients/visits_future.php';
							break;
						case 'visits_past':
							include __DIR__ . '/patients/visits_past.php';
							break;
						case 'visits_cancel':
							include __DIR__ . '/patients/visits_cancel.php';
							break;
						case 'notes':
							include __DIR__ . '/patients/notes.php';
							break;
						case 'change_history':
							include __DIR__ . '/patients/change-history.php';
							break;
					}
				} else {
					include __DIR__ . '/patients/detail.php';
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
if (isset($pat)) {
	ItemInfoFoot();
}

include __DIR__ . '/inc/foot.php';
include __DIR__ . '/inc/notify.php';
?>

</body>
</html>