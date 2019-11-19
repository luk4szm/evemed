<?php
function Modal_ProcedureTurnOff($proc)
{
	?>

   <div class="modal fade" id="ProcedureTurnOffModal" tabindex="-1" role="dialog"
        aria-labelledby="ModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">

            <div class="modal-header">
               <h5 class="modal-title" id="ModalLongTitle">Wycofaj zabieg</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>

            <form class="was-validated" method="post">

               <input type="hidden" name="procID" value="<?= $proc['ID'] ?>">

               <div class="modal-body text-center">

                  <div class="form-row justify-content-center">
                     <div class="form-group col-md-10 text-center">
                        <p>Czy na pewno chcesz wycofać poniższy zabieg z listy aktualnie wykonywanych?
                        <p class="f500"><?= nl2br($proc['name_full']) ?>
                     </div>
                  </div>

               </div>

               <div class="modal-footer justify-content-center">
                  <button type="submit" name="modalForm" value="ProcedureTurnOff" class="btn btn-outline-danger">
                     Wycofaj zabieg
                  </button>
               </div>

            </form>

         </div>
      </div>
   </div>

	<?php
}
