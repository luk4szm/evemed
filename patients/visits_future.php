<?php
global $pat; #just for turn off notification
?>

<div class="card">
   <div class="card-header">
		<?= Breadcrump(
			array(
				'Pacjenci',
				$pat['full_name'],
				'Wizyty zaplanowane',
			)
		) ?>
   </div>
   <div class="card-body">

		<?php
		if ($pat['visits_future_count'] > 0) {
			?>

         <table class="table table-condensed table-hover">

            <tr>
               <th>#</th>
               <th>Data wizyty</th>
               <th>Zabiegi</th>
               <th>Cena</th>
               <th>Dodano</th>
               <th class="min-width"></th>
            </tr>

				<?php
				$k = 0;
				for ($i = 0; $i < $pat['visits_future_count']; $i++) {
					$vis = $pat['visits_future'][$i];
					?>
               <tr class="table-sm" style="cursor: pointer;"
                   onclick="window.location='/visit.php?id=<?= $vis['id'] ?>'">
                  <td class="min-width">
							<?= ++$k ?>
                  </td>
                  <td>
							<?= DateConvert($vis['visit_date'], true) ?>
                  </td>
                  <td>
							<?= FormatListFromLine($vis['procedures']) ?>
                  </td>
                  <td class="f500">
							<?= FormatPrice($vis['price']) ?>
                  </td>
                  <td class="min-width" style="line-height: normal">
							<?= $vis['add_user']['full_name'] ?><br>
                     <small><?= DateConvert($vis['entry_add']) ?></small>
                  </td>
                  <td>
                     <i class="fas fa-angle-right fa-fw" aria-hidden="true"></i>
                  </td>
               </tr>
				<?php } ?>

         </table>

			<?php
		} else {
			ShowSimpleInfo('Brak zaplanowanych wizyt pacjenta.');
		}
		?>

   </div>
</div>