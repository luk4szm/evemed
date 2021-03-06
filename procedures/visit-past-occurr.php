<?php
global $proc; #just for turn off notification
$k = 0;
?>

<div class="card">
   <div class="card-header">
		<?= Breadcrump(
			array(
				'Zabiegi',
				$proc['name_short'],
				'W minionych wizytach',
			)
		) ?>
   </div>
   <div class="card-body">

		<?php
		if ($proc['visit_past_occurr_count'] > 0) {
			?>

         <table class="table table-hover table-condensed">

            <tr>
               <th>#</th>
               <th>Pacjent</th>
               <th>Data wizyty</th>
               <th>Cena</th>
               <th class="min-width"></th>
            </tr>

				<?php
				for ($i = 0; $i < $proc['visit_past_occurr_count']; $i++) {
					$vis = $proc['visit_past_occurr'][$i];
					?>
               <tr class="table-sm" style="cursor: pointer;"
                   onclick="window.location='/visit.php?id=<?= $vis['vis_id'] ?>'">
                  <td>
							<?= ++$k ?>
                  </td>
                  <td class="f500">
							<?= $vis['pat_full_name'] ?>
                  </td>
                  <td>
							<?= DateConvert($vis['visit_date'], true) ?>
                  </td>
                  <td class="f500">
							<?= FormatPrice($vis['price']) ?>
                  </td>
                  <td>
                     <i class="fas fa-angle-right fa-fw" aria-hidden="true"></i>
                  </td>
               </tr>
				<?php } ?>

         </table>

			<?php
		} else {
			ShowSimpleInfo('Zabieg nie był wykonywany');
		}
		?>

   </div>
   <div class="card-footer text-muted text-right">
      Wyświetlono wyników: <span class="f500"><?= $k ?></span>
   </div>
</div>