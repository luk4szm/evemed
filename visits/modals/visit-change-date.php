<?php

function Modal_VisitChangeDate($vis)
{

	?>

   <div class="modal fade" id="VisitChangeDateModal" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle"
        aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">

            <div class="modal-header">
               <h5 class="modal-title" id="ModalLongTitle">Zmień datę wizyty</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>

            <form class="was-validated" method="post">

               <input type="hidden" name="vis_id" value="<?= $vis['id'] ?>">

               <div class="modal-body text-center">

                  <div class="form-row justify-content-center">
                     <div class="form-group col-md-6">
                        <label for="visit_date">Nowa data wizyty:</label>
                        <input type="datetime-local" class="form-control" id="visit_date" name="visit_date" step="900"
                               value="<?= FormValue($vis['visit_date'], 'datetime') ?>" required>
                     </div>
                  </div>

               </div>

               <div class="modal-footer justify-content-center">
                  <button type="submit" name="modalForm" value="VisitChangeDate" class="btn btn-outline-success">
                     Zmień datę wizyty
                  </button>
               </div>

            </form>

         </div>
      </div>
   </div>

	<?php

}
