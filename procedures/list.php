<?php
$k = 0;
$procedures = ProcedureList('p.status = 1');
?>

<div class="card">
   <div class="card-header">
		<?= Breadcrump(
			array(
				'Zabiegi',
				'Lista',
			)
		) ?>
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
                      onclick="window.location='/procedure.php?id=<?= $proc['ID'] ?>'">
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
				ShowSimpleInfo('Lista jest pusta.');
			}
		} else {
			ShowSimpleInfo($procedures['txt']);
		}
		?>

   </div>
   <div class="card-footer text-muted text-right">
      Wyświetlono wyników: <span class="f500"><?= $k ?></span>
   </div>
</div>