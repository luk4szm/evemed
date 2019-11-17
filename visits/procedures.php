<?php
global $vis; #just for turn off notification
$k = 0;

if ($vis['statusID'] == 1) {
	$table_class = 'table-hover';
} else {
	$table_class = null;
}

?>

   <div class="card">
      <div class="card-header">
			<?= Breadcrump(
				array(
					'Wizyty',
					$vis['patient']['full_name'],
					DateConvert($vis['visit_date'], true),
					'Zabiegi',
				)
			) ?>
      </div>
      <div class="card-body">
			<?php
			if ($vis['procedures_count'] > 0) {
				?>
            <table class="table table-condensed <?= $table_class ?>">

               <tr>
                  <th>#</th>
                  <th>Nazwa skrócona</th>
                  <th>Nazwa pełna</th>
                  <th>Cena</th>
               </tr>

					<?php
					$price_sum = 0;
					for ($i = 0; $i < $vis['procedures_count']; $i++) {
						$proc = $vis['procedures'][$i];
						$price_sum += $proc['price'];
						$tr_class =
							($vis['statusID'] == 1) ?
								'style="cursor: pointer;" data-toggle="modal" data-target="#ProcedureEditModal' . $proc['ID'] . '"' :
								null;

						?>
                  <tr class="table-sm" <?= $tr_class ?>>
                     <td>
								<?= ++$k ?>
                     </td>
                     <td class="f500">
                        <a class="black" href="/procedure.php?id=<?= $proc['procID'] ?>">
                           <?= $proc['name_short'] ?>
                        </a>
                     </td>
                     <td>
								<?= $proc['name_full'] ?>
                     </td>
                     <td class="f500">
								<?= FormatPrice($proc['price']) ?>
                     </td>
                  </tr>
					<?php } ?>

               <tr class="table-sm">
                  <td class="no-hover" colspan="2"></td>
                  <td class="no-hover f500 text-right">
                     RAZEM:
                  </td>
                  <td class="no-hover f500">
							<?= FormatPrice($price_sum) ?>
                  </td>
               </tr>

            </table>
				<?php
			} else {
				ShowSimpleInfo('Lista zabiegów jest pusta');
			}
			?>
			<?php if ($vis['statusID'] == 1) { ?>
            <div class="row justify-content-center" style="margin-top: 15px">
               <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#ProcedureAddModal"
                       style="border-radius: 25px;">
                  Dodaj zabieg do listy
               </button>
            </div>
			<?php } ?>
      </div>
   </div>

<?php
if ($vis['statusID'] == 1) {

	require_once $_SERVER['DOCUMENT_ROOT'] . '/visits/modals/procedure-add.php';
	Modal_AddProcedureToVisit($vis);

	require_once $_SERVER['DOCUMENT_ROOT'] . '/visits/modals/procedure-edit.php';
	for ($i = 0; $i < $vis['procedures_count']; $i++) {
		$proc = $vis['procedures'][$i];
		Modal_EditVisitProcedure($proc);
	}

}
