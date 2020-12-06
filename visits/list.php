<?php
$visits = VisitList();
$k = 0;
?>

<div class="card">
   <div class="card-header">
		<?= Breadcrump(
			array(
				'Wizyty',
				'Lista',
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
                  <th>Status</th>
                  <th>Cena</th>
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
								<?= FormatVisitStatus($vis['status_id']) ?>
                     </td>
                     <td class="f500">
								<?= FormatPrice($vis['price']) ?>
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
				ShowSimpleInfo('Lista jest pusta');
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