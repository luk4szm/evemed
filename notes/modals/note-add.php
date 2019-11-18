<?php
function Modal_AddNoteToItem($item_type, $ID)
{
	?>

   <div class="modal fade" id="NoteAddModal" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle"
        aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">

            <div class="modal-header">
               <h5 class="modal-title" id="ModalLongTitle">Dodaj notatkę</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>

            <form class="was-validated" method="post">

               <input type="hidden" name="<?= $item_type ?>" value="<?= $ID ?>">

               <div class="modal-body text-center">
                  <div class="form-row justify-content-center">
                     <div class="form-group col-md-10">
                        <label for="recommend">Treść notatki:</label>
                        <textarea class="form-control" id="txt" name="txt" rows="5"
                                  maxlength="1000" required></textarea>
                     </div>
                  </div>
               </div>

               <div class="modal-footer justify-content-center">
                  <button type="submit" name="modalForm" value="AddItemNote"
                          class="btn btn-outline-success">
                     Dodaj notatkę
                  </button>
               </div>

            </form>

         </div>
      </div>
   </div>

	<?php
}