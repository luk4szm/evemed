<?php
global $pat; #just for turn off notification
?>

<div class="card">
   <div class="card-header">
		<?= Breadcrump(
			array(
				'Pacjenci',
				$pat['full_name'],
				'Historia zmian',
			)
		) ?>
   </div>
   <div class="card-body">

		<?php
		if (isset($pat['change_history'])) {
			?>

         <table class="table table-condensed">

            <tr>
               <th>#</th>
               <th>Komórka</th>
               <th>Przed zmianą</th>
               <th>Po zmianie</th>
               <th>Adnotacja</th>
            </tr>

				<?php
				$k = 0;
				for ($i = 0; $i < count($pat['change_history']); $i++) {
					$hist = $pat['change_history'][$i];
					?>
               <tr class="table-sm">
                  <td>
							<?= ++$k ?>
                  </td>
                  <td class="f500">
							<?= $hist['name'] ?>
                  </td>
                  <td>
							<?= FormatIsNull(FormatListFromLine($hist['data_before']), 'puste') ?>
                  </td>
                  <td>
                     <?= FormatIsNull(FormatListFromLine($hist['data_after']), 'puste') ?>
                  </td>
                  <td style="line-height: normal">
							<?= $hist['user']['full_name'] ?><br>
                     <small><?= DateConvert($hist['entry_add']) ?></small>
                  </td>
               </tr>
				<?php } ?>

         </table>

			<?php
		} else {
			ShowSimpleInfo('Brak historii zmian karty pacjenta.');
		}
		?>

   </div>
</div>