<?php

function Modal_EditVisitDrug($drug)
{
	?>

   <div class="modal fade" id="DrugEditModal<?= $drug['id'] ?>" tabindex="-1" role="dialog"
        aria-labelledby="ModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">

            <div class="modal-header">
               <h5 class="modal-title" id="ModalLongTitle">Edytuj przepisany lek</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>

            <form class="was-validated" method="post">

               <input type="hidden" name="id" value="<?= $drug['id'] ?>">

               <div class="modal-body text-center">

                  <div class="form-group row ">
                     <label for="name" class="col-sm-3 col-form-label">Nazwa leku:</label>
                     <div class="col-sm-9">
                        <input type="text" class="form-control" id="name" name="name"
                               maxlength="200" value="<?= $drug['name'] ?>" required>
                     </div>
                  </div>

                  <div class="form-group row ">
                     <label for="dose" class="col-sm-3 col-form-label">Dawka:</label>
                     <div class="col-sm-9">
                        <input type="text" class="form-control" id="dose" name="dose"
                               maxlength="200" value="<?= $drug['dose'] ?>" required>
                     </div>
                  </div>

                  <div class="form-group row ">
                     <label for="quantity" class="col-sm-3 col-form-label">Ilość:</label>
                     <div class="col-sm-9">
                        <input type="text" class="form-control" id="quantity" name="quantity"
                               maxlength="200" value="<?= $drug['quantity'] ?>" required>
                     </div>
                  </div>

                  <div class="form-group row ">
                     <label for="dosage" class="col-sm-3 col-form-label">Dawkowanie:</label>
                     <div class="col-sm-9">
                        <input type="text" class="form-control" id="dosage" name="dosage"
                               maxlength="200" value="<?= $drug['dosage'] ?>" required>
                     </div>
                  </div>

                  <div class="form-group row ">
                     <label for="refund" class="col-sm-3 col-form-label">Refundacja:</label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" id="refund" name="refund"
                               maxlength="200" value="<?= $drug['refund'] ?>" required>
                     </div>
                  </div>

               </div>

               <div class="modal-footer justify-content-center">
                  <button type="submit" name="modalForm" value="EditVisitDrug" class="btn btn-outline-success">
                     Zapisz zmiany
                  </button>
                  &emsp;
                  <button type="submit" name="modalForm" value="DeleteVisitDrug" class="btn btn-outline-danger">
                     Usuń lek z listy
                  </button>
               </div>

            </form>

         </div>
      </div>
   </div>

	<?php

}