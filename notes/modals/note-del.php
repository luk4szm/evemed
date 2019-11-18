<?php
function Modal_DeleteItemNote($note)
{
	?>

   <div class="modal fade" id="NoteDeleteModal<?= $note['ID'] ?>" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle"
        aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">

            <div class="modal-header">
               <h5 class="modal-title" id="ModalLongTitle">Usuń notatkę</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>

            <form class="was-validated" method="post">

               <input type="hidden" name="ID" value="<?= $note['ID'] ?>">

               <div class="modal-body text-center">
                  <div class="form-row justify-content-center">
                     <div class="form-group col-md-10 text-center">
                        <p>Treść notatki:
                        <p class="f500"><?= nl2br($note['txt']) ?>
                     </div>
                  </div>
               </div>

               <div class="modal-footer justify-content-center">
                  <button type="submit" name="modalForm" value="DeleteItemNote"
                          class="btn btn-outline-danger">
                     Usuń notatkę
                  </button>
               </div>

            </form>

         </div>
      </div>
   </div>

	<?php
}