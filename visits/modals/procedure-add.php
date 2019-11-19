<?php

function Modal_AddProcedureToVisit($vis)
{

	require_once $_SERVER['DOCUMENT_ROOT'] . '/procedures/script/list.php';
	$procedures = ProcedureList('status = 1');

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

               <input type="hidden" name="visID" value="<?= $vis['ID'] ?>">

               <div class="modal-body text-center">

                  <div class="form-row justify-content-center">
                     <div class="form-group col-md-11">
                        <label for="procID">Zabieg:</label>
                        <select class="form-control selectpicker" id="procID" name="procID"
                                data-live-search="true" title="Wybierz zabieg" required>
									<?php

									foreach ($procedures['result'] AS $proc) {
										echo '<option value="' . $proc['ID'] . '">';
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