<?php
session_start();
require_once __DIR__ . '/inc/whole-service.php';

if (!isset($_SESSION['loggedUser'])) {
	$_SESSION['prevURL'] = $_SERVER['REQUEST_URI'];
	header('Location: /login.php');
	exit();
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<?php include __DIR__ . '/inc/head.php'; ?>
   <title><?= SITE_NAME ?></title>
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
			require_once __DIR__ . '/inc/visits/scripts.php';
			$visits = VisitList("v.visit_date < '" . date('Y-m-d H:i:s') . "' AND v.status_id = 1", null);
			$k = 0;
			?>
         <div class="card">
            <div class="card-header">
					<?= Breadcrump(
						array(
							'Wizyty',
							'Minione, nieodbyłe',
						)
					) ?>
            </div>
            <div class="card-body">

					<?php
					if (substr($visits['code'], 0, 1) == 2) {
						if ($visits['list_count'] > 0) {
							?>

                     <table class="table table-hover table-condensed">
                        <tr>
                           <th>#</th>
                           <th>Pacjent</th>
                           <th>Data wizyty</th>
                           <th class="min-width"></th>
                        </tr>
								<?php
								for ($i = 0; $i < $visits['list_count']; $i++) {
									$vis = $visits['result'][$i];
									?>
                           <tr class="table-sm" style="cursor: pointer;"
                               onclick="window.location='/visit.php?id=<?= $vis['id'] ?>'">
                              <td>
											<?= ++$k ?>
                              </td>
                              <td class="f500">
											<?= $vis['pat_full_name'] ?>
                              </td>
                              <td>
											<?= DateConvert($vis['visit_date'], true) ?>
                              </td>
                              <td>
                                 <i class="fas fa-angle-right fa-fw" aria-hidden="true"></i>
                              </td>
                           </tr>
								<?php } ?>
                     </table>

							<?php
						} else {
							ShowSimpleInfo('Brak zaplanowanych wizyt');
						}
					} else {
						ShowSimpleInfo($visits['txt']);
					}
					?>

            </div>
            <div class="card-footer text-muted text-right">
               Wyświetlono wyników: <span class="f500"><?= $k ?></span>
            </div>
         </div>

			<?php
			require_once __DIR__ . '/inc/visits/scripts.php';
			$visits = VisitList("v.visit_date > '" . date('Y-m-d H:i:s') . "' AND v.status_id = 1", null, 5);
			$k = 0;
			?>
         <div class="card">
            <div class="card-header">
					<?= Breadcrump(
						array(
							'Wizyty',
							'Nadchodzące',
						)
					) ?>
            </div>
            <div class="card-body">

					<?php
					if (substr($visits['code'], 0, 1) == 2) {
						if ($visits['list_count'] > 0) {
							?>

                     <table class="table table-hover table-condensed">
                        <tr>
                           <th>#</th>
                           <th>Pacjent</th>
                           <th>Data wizyty</th>
                           <th class="min-width"></th>
                        </tr>
								<?php
								for ($i = 0; $i < $visits['list_count']; $i++) {
									$vis = $visits['result'][$i];
									?>
                           <tr class="table-sm" style="cursor: pointer;"
                               onclick="window.location='/visit.php?id=<?= $vis['id'] ?>'">
                              <td>
											<?= ++$k ?>
                              </td>
                              <td class="f500">
											<?= $vis['pat_full_name'] ?>
                              </td>
                              <td>
											<?= DateConvert($vis['visit_date'], true) ?>
                              </td>
                              <td>
                                 <i class="fas fa-angle-right fa-fw" aria-hidden="true"></i>
                              </td>
                           </tr>
								<?php } ?>
                     </table>

							<?php
						} else {
							ShowSimpleInfo('Brak zaplanowanych wizyt');
						}
					} else {
						ShowSimpleInfo($visits['txt']);
					}
					?>

               <div class="row justify-content-center mt-3">
                  <a class="btn btn-outline-info navbar-btn rounded-pill"
                     href="/visits.php?new" role="button">Zarejestruj nową wizytę</a>
               </div>

            </div>
            <div class="card-footer text-muted text-right">
               Wyświetlono wyników: <span class="f500"><?= $k ?></span>
            </div>
         </div>
      </div>

      <div class="col-md-6">
			<?php
			require_once __DIR__ . '/inc/patients/scripts.php';
			$patients = PatientList(null, 'entry_add DESC', 5);
			$k = 0;
			?>
         <div class="card">
            <div class="card-header">
					<?= Breadcrump(
						array(
							'Pacjenci',
							'Nowi',
						)
					) ?>
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
							ShowSimpleInfo('Brak pacjentów');
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

   </div>
</div>

<?php
include __DIR__ . '/inc/foot.php';
include __DIR__ . '/inc/notify.php';
?>

</body>
</html>