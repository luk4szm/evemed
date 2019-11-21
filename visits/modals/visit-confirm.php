<?php

function Modal_VisitConfirm($vis)
{

	?>

   <div class="modal fade" id="VisitConfirmModal" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle"
        aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">

            <div class="modal-header">
               <h5 class="modal-title" id="ModalLongTitle">Potwierdź wykonanie wizyty</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>

            <form class="was-validated" method="post">

               <input type="hidden" name="visID" value="<?= $vis['ID'] ?>">

               <div class="modal-body text-center">

                  <div class="form-row justify-content-center">
                     <div class="form-group col-md-6">
                        <label for="visit_date">Data wizyty:</label>
                        <input type="datetime-local" class="form-control" id="visit_date" name="visit_date" step="900"
                               value="<?= FormValue($vis['visit_date'], 'datetime') ?>" required>
                     </div>
                  </div>

                  <div class="form-row justify-content-center">
                     <div class="form-group col-md-10">
                        <label for="examination">Badanie <small>(opcjonalnie)</small>:</label>
                        <textarea class="form-control" id="examination" name="examination" rows="3"
                                  maxlength="1000"></textarea>

                     </div>
                  </div>

                  <div class="form-row justify-content-center">
                     <div class="form-group col-md-10">
                        <label for="recommend">Zalecenia <small>(opcjonalnie)</small>:</label>
                        <textarea class="form-control" id="recommend" name="recommend" rows="3"
                                  maxlength="1000"></textarea>

                     </div>
                  </div>

                  <div class="form-row justify-content-center">
                     <div class="form-group col-md-10">
                        <label for="conf_note">Uwagi dot. wizyty <small>(opcjonalnie)</small>:</label>
                        <textarea class="form-control" id="conf_note" name="conf_note" rows="2"
                                  maxlength="1000"></textarea>

                     </div>
                  </div>

               </div>

               <div class="modal-footer justify-content-center">
                  <button type="submit" name="modalForm" value="VisitConfirm" class="btn btn-outline-success">
                     Potwierdź
                  </button>
               </div>

            </form>

         </div>
      </div>
   </div>

	<?php

}
