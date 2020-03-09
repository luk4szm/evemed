<?php
$employees = EmployeeList();
$k = 0;
?>

<div class="card">
   <div class="card-header">
		<?= Breadcrump(
			array(
				'Kadra',
				'Lista',
			)
		) ?>
   </div>
   <div class="card-body">

		<?php
		if (substr($employees['code'], 0, 1) == 2) {
			if ($employees['list_count'] > 0) {
				?>

            <table class="table table-hover table-condensed">

               <tr>
                  <th>#</th>
                  <th>Pracownik</th>
                  <th>Miasto</th>
                  <th class="min-width"></th>
               </tr>

					<?php
					for ($i = 0; $i < $employees['list_count']; $i++) {
						$pat = $employees['result'][$i];
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
			ShowSimpleInfo($employees['txt']);
		}
		?>

   </div>
   <div class="card-footer text-muted text-right">
      Wyświetlono wyników: <span class="f500"><?= $k ?></span>
   </div>
</div>