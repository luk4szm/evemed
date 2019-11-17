<?php
global $proc; #just for turn off notification
$k = 0;
?>

<div class="card">
   <div class="card-header">
		<?= Breadcrump(
			array(
				'Procedury',
				$proc['name_short'],
				'W zaplanowanych wizytach',
			)
		) ?>
   </div>
   <div class="card-body">

		<?php
		if ($proc['visit_future_occurr_count'] > 0) {
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
				for ($i = 0; $i < $proc['visit_future_occurr_count']; $i++) {
					$vis = $proc['visit_future_occurr'][$i];
					?>
               <tr class="table-sm" style="cursor: pointer;"
                   onclick="window.location='/visit.php?id=<?= $vis['visID'] ?>'">
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
			ShowSimpleInfo('Zabieg nie jest planowany w najbliższym czasie');
		}
		?>

   </div>
   <div class="card-footer text-muted text-right">
      Wyświetlono wyników: <span class="f500"><?= $k ?></span>
   </div>
</div>