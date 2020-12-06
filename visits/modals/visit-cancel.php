<?php

function Modal_VisitCancel($vis)
{

	?>

   <div class="modal fade" id="VisitCancelModal" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle"
        aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">

            <div class="modal-header">
               <h5 class="modal-title" id="ModalLongTitle">Anulowanie wizyty</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>

            <form class="was-validated" method="post">

               <input type="hidden" name="vis_id" value="<?= $vis['id'] ?>">

               <div class="modal-body text-center">

                  <div class="form-row justify-content-center">
                     <div class="form-group col-md-10">
                        <label for="canc_note">Powód / uwagi <small>(opcjonalnie)</small>:</label>
                        <textarea class="form-control" id="canc_note" name="canc_note" rows="3"
                                  maxlength="1000"><?= FormValue($vis['canc_note']) ?></textarea>

                     </div>
                  </div>

               </div>

               <div class="modal-footer justify-content-center">
                  <button type="submit" name="modalForm" value="VisitCancel" class="btn btn-outline-danger">
                     Anuluj wizytę
                  </button>
               </div>

            </form>

         </div>
      </div>
   </div>

	<?php

}
