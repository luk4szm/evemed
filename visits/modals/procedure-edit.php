<?php

function Modal_EditVisitProcedure($proc)
{

	require_once $_SERVER['DOCUMENT_ROOT'] . '/procedures/script/list.php';
	$procedures = ProcedureList();

	?>

   <div class="modal fade" id="ProcedureEditModal<?= $proc['ID'] ?>" tabindex="-1" role="dialog"
        aria-labelledby="ModalCenterTitle"
        aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">

            <div class="modal-header">
               <h5 class="modal-title" id="ModalLongTitle">Edytuj zabieg</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>

            <form class="was-validated" method="post">

               <input type="hidden" name="procID" value="<?= $proc['ID'] ?>">

               <div class="modal-body text-center">

                  <div class="form-row justify-content-center">
                     <div class="form-group col-md-10">
                        <label for="name_short">Zabieg:</label>
                        <input type="text" class="form-control f500" id="name_short" name="name_short"
                               style="text-align: center" value="<?= $proc['name_short'] ?>" disabled>
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
                                  style="text-align: right" value="<?= $proc['price'] ?>">
                        </div>
                        <div>
                           Nominalna cena zabiegu:<br>
                           <span class="f500"><?= FormatPrice($procedures['result'][$proc['procID']]['price']) ?></span>
                        </div>
                     </div>
                  </div>

               </div>

               <div class="modal-footer justify-content-center">
                  <button type="submit" name="modalForm" value="EditVisitProcedure" class="btn btn-outline-success">
                     Zapisz zmiany
                  </button>
                  &emsp;
                  <button type="submit" name="modalForm" value="DeleteVisitProcedure" class="btn btn-outline-danger">
                     Usuń zabieg z listy
                  </button>
               </div>

            </form>

         </div>
      </div>
   </div>

	<?php

}