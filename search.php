<?php
session_start();
require_once __DIR__ . '/inc/whole-service.php';

if (!isset($_SESSION['loggedUser'])) {
	$_SESSION['prevURL'] = $_SERVER['REQUEST_URI'];
	header('Location: /login.php');
	exit();
}

$query = FormFilter($_GET['query']);
?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<?php include __DIR__ . '/inc/head.php'; ?>
   <title>Wyszukiwarka - <?= SITE_NAME ?></title>
</head>
<body>

<?php
include __DIR__ . '/inc/menu.php';
include __DIR__ . '/inc/glob-vars.php';
?>

<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-6">

			<?php
			require_once __DIR__ . '/inc/patients/scripts.php';
			$patients = PatientList("first_name LIKE '%$query%' OR last_name LIKE '%$query%'");
			$k = 0;
			?>

         <div class="card">
            <div class="card-header">
					<?= Breadcrump(array('Pacjenci')) ?>
            </div>
            <div class="card-body">

					<?php
					if (substr($patients['code'], 0, 1) == 2) {
						if ($patients['list_count'] > 0) {
							?>

                     <table class="table table-hover table-condensed">
                        <tr>
                           <th>#</th>
                           <th>Pacjent</th>
                           <th>Data urodzenia</th>
                           <th>Miasto</th>
                           <th class="min-width"></th>
                        </tr>

								<?php
								for ($i = 0; $i < $patients['list_count']; $i++) {
									$pat = $patients['result'][$i];
									?>

                           <tr class="table-sm" style="cursor: pointer;"
                               onclick="window.location='/patient.php?id=<?= $pat['id'] ?>'">
                              <td>
											<?= ++$k ?>
                              </td>
                              <td class="f500">
											<?= $pat['full_name'] ?>
                              </td>
                              <td>
											<?= DateConvert($pat['date_of_birth']) ?>
                              </td>
                              <td>
											<?= $pat['city'] ?>
                              </td>
                              <td>
                                 <i class="fas fa-angle-right fa-fw" aria-hidden="true"></i>
                              </td>
                           </tr>

								<?php } ?>

                     </table>

							<?php
						} else {
							ShowSimpleInfo('Nie znaleziono pacjentów pasujących do kryteriów wyszukiwania.');
						}
					} else {
						ShowSimpleInfo($patients['txt']);
					}
					?>

               <div class="row justify-content-center mt-3">
                  <a class="btn btn-outline-info navbar-btn rounded-pill"
                     href="/patients.php?new" role="button">Dodaj nowego pacjenta</a>
               </div>
            </div>
            <div class="card-footer text-muted text-right">
               Wyświetlono wyników: <span class="f500"><?= $k ?></span>
            </div>
         </div>
      </div>
      <div class="col-md-6">

			<?php
			require_once __DIR__ . '/inc/procedures/scripts.php';
			$procedures = ProcedureList("name_short LIKE '%$query%' OR name_full LIKE '%$query%' OR description LIKE '%$query%'");
			$k = 0;
			?>

         <div class="card">
            <div class="card-header">
					<?= Breadcrump(array('Zabiegi')) ?>
            </div>
            <div class="card-body">

					<?php
					if (substr($procedures['code'], 0, 1) == 2) {
						if ($procedures['list_count'] > 0) {
							?>

                     <table class="table table-hover table-condensed">

                        <tr>
                           <th>#</th>
                           <th>Skrót</th>
                           <th>Pełna nazwa</th>
                           <th colspan="2">Cena nominalna</th>
                        </tr>

								<?php
								for ($i = 0; $i < $procedures['list_count']; $i++) {
									$proc = $procedures['result'][$i];
									?>
                           <tr class="table-sm" style="cursor: pointer;"
                               onclick="window.location='/procedure.php?id=<?= $proc['id'] ?>'">
                              <td>
											<?= ++$k ?>
                              </td>
                              <td class="f500">
											<?= $proc['name_short'] ?>
                              </td>
                              <td>
											<?= $proc['name_full'] ?>
                              </td>
                              <td class="f500">
											<?= FormatPrice($proc['price']) ?>
                              </td>
                              <td class="min-width">
                                 <i class="fas fa-angle-right fa-fw" aria-hidden="true"></i>
                              </td>
                           </tr>
								<?php } ?>

                     </table>

							<?php
						} else {
							ShowSimpleInfo('Nie znaleziono zabiegów pasujących do kryteriów wyszukiwania');
						}
					} else {
						ShowSimpleInfo($procedures['txt']);
					}
					?>

               <div class="row justify-content-center mt-3">
                  <a class="btn btn-outline-info navbar-btn rounded-pill"
                     href="/procedures.php?new" role="button">Dodaj nowy zabieg</a>
               </div>
            </div>
            <div class="card-footer text-muted text-right">
               Wyświetlono wyników: <span class="f500"><?= $k ?></span>
            </div>
         </div>
      </div>
   </div>
</div>

<?php
include __DIR__ . '/inc/foot.php';
include __DIR__ . '/inc/notify.php';
?>

</body>
</html>