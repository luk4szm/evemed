<?php
function Modal_ProcedureTurnOn($proc)
{
	?>

   <div class="modal fade" id="ProcedureTurnOnModal" tabindex="-1" role="dialog"
        aria-labelledby="ModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">

            <div class="modal-header">
               <h5 class="modal-title" id="ModalLongTitle">Przywróć zabieg</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>

            <form class="was-validated" method="post">

               <input type="hidden" name="proc_id" value="<?= $proc['id'] ?>">

               <div class="modal-body text-center">

                  <div class="form-row justify-content-center">
                     <div class="form-group col-md-10 text-center">
                        <p>Czy na pewno chcesz przywrócić poniższy zabieg do listy aktualnie wykonywanych?
                        <p class="f500"><?= nl2br($proc['name_full']) ?>
                     </div>
                  </div>

               </div>

               <div class="modal-footer justify-content-center">
                  <button type="submit" name="modalForm" value="ProcedureTurnOn" class="btn btn-outline-success">
                     Przywróć zabieg
                  </button>
               </div>

            </form>

         </div>
      </div>
   </div>

	<?php
}
