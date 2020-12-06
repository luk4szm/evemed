<?php
global $vis; #just for turn off notification
$k = 0;
?>

   <div class="card">
      <div class="card-header">
			<?= Breadcrump(
				array(
					'Wizyty',
					$vis['patient']['full_name'],
					DateConvert($vis['visit_date'], true),
					'Przepisane leki',
				)
			) ?>
      </div>
      <div class="card-body">
			<?php
			if ($vis['visit_date'] <= date('Y-m-d H:i:s', strtotime('+ 60 minutes'))) {
				if ($vis['drugs_count'] > 0) {
					?>
               <table class="table table-condensed <?= $vis['status_id'] == 1 ? 'table-hover' : '' ?>">

                  <tr>
                     <th>#</th>
                     <th>Nazwa</th>
                     <th>Dawka</th>
                     <th>Ilość</th>
                     <th>Jak dawkować</th>
                     <th>Refundacja</th>
                  </tr>

						<?php
						for ($i = 0; $i < $vis['drugs_count']; $i++) {
							$drug = $vis['drugs'][$i];
							$tr_class =
								($vis['status_id'] == 1) ?
									'style="cursor: pointer;" data-toggle="modal" data-target="#DrugEditModal' . $drug['id'] . '"' :
									null;
							?>
                     <tr class="table-sm" <?= $tr_class ?>>
                        <td>
									<?= ++$k ?>
                        </td>
                        <td class="f500">
									<?= $drug['name'] ?>
                        </td>
                        <td>
									<?= $drug['dose'] ?>
                        </td>
                        <td>
									<?= $drug['quantity'] ?>
                        </td>
                        <td>
									<?= $drug['dosage'] ?>
                        </td>
                        <td>
									<?= $drug['refund'] ?>
                        </td>
                     </tr>
						<?php } ?>

               </table>
					<?php
				} else {
					ShowSimpleInfo('Nie przepisano żadnych leków');
				}
				if ($vis['status_id'] == 1) { ?>
               <div class="row justify-content-center" style="margin-top: 15px">
                  <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#DrugAddModal"
                          style="border-radius: 25px;">
                     Dodaj lek
                  </button>
               </div>
					<?php
				}
			} else {
				ShowSimpleInfo('Leki można dopisać po rozpoczęciu wizyty');
			}
			?>
      </div>
   </div>

<?php
if ($vis['status_id'] == 1) {
	require_once __MDIR__ . '/visits/modals/drug-add.php';
	Modal_AddDrugToVisit($vis);

	require_once __MDIR__ . '/visits/modals/drug-edit.php';
	for ($i = 0; $i < $vis['drugs_count']; $i++) {
		$drug = $vis['drugs'][$i];
		Modal_EditVisitDrug($drug);
	}
}
