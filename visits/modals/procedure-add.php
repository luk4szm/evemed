<?php

function Modal_AddProcedureToVisit($vis)
{
	require_once __MDIR__ . '/procedures/script/list.php';

	if ($vis['procedures_count'] > 0) {
		foreach ($vis['procedures'] AS $pr) {
			$proc_exist[] = $pr['proc_id'];
		}
		$where_add = 'AND p.id NOT IN (' . implode(", ", $proc_exist) . ')';
	} else {
		$where_add = null;
	}

	$procedures = ProcedureList('p.status = 1 ' . $where_add);
	?>

   <div class="modal fade" id="ProcedureAddModal" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle"
        aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">

            <div class="modal-header">
               <h5 class="modal-title" id="ModalLongTitle">Dodaj wykonywany zabieg</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>

            <form class="was-validated" method="post">
               <input type="hidden" name="vis_id" value="<?= $vis['id'] ?>">

               <div class="modal-body text-center">

                  <div class="form-row justify-content-center">
                     <div class="form-group col-md-11">
                        <label for="proc_id">Zabieg:</label>
                        <select class="form-control selectpicker" id="proc_id" name="proc_id"
                                data-live-search="true" title="Wybierz zabieg" required>
									<?php
									foreach ($procedures['result'] AS $proc) {
										echo '<option value="' . $proc['id'] . '">';
										echo $proc['name_short'] . ' [' . FormatPrice($proc['price']) . ']';
										echo '</option>';
									}
									?>
                        </select>
                     </div>
                  </div>

                  <div class="form-row justify-content-center">
                     <div class="form-group col-md-6">
                        <label for="price">Cena zabiegu:</label>
                        <div class="input-group mb-3">
                           <div class="input-group-prepend">
                              <span class="input-group-text">PLN</span>
                           </div>
                           <input type="text" class="form-control" id="price" name="price"
                                  style="text-align: right;">
                        </div>
                     </div>
                  </div>

               </div>

               <div class="modal-footer justify-content-center">
                  <button type="submit" name="modalForm" value="AddProcedureToVisit" class="btn btn-outline-success">
                     Dodaj zabieg
                  </button>
               </div>

            </form>

         </div>
      </div>
   </div>

	<?php
}