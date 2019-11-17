<?php
$patients = PatientList();
$k = 0;
?>

<div class="card">
   <div class="card-header">
		<?= Breadcrump(
			array(
				'Pacjenci',
				'Lista',
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
                  <th class="text-center">Wizyt</th>
                  <th class="min-width"></th>
               </tr>

					<?php
					for ($i = 0; $i < $patients['list_count']; $i++) {
						$pat = $patients['result'][$i];
						?>
                  <tr class="table-sm" style="cursor: pointer;"
                      onclick="window.location='/patient.php?id=<?= $pat['ID'] ?>'">
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
                     <td class="text-center">
								<?= $pat['visits_count'] ?>
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

   </div>
   <div class="card-footer text-muted text-right">
      Wyświetlono wyników: <span class="f500"><?= $k ?></span>
   </div>
</div>