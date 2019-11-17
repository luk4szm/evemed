<?php

function Modal_VisitNew($pat)
{

	?>

   <div class="modal fade" id="VisitNewModal" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle"
        aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">

            <div class="modal-header">
               <h5 class="modal-title" id="ModalLongTitle">Nowa wizyta</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>

            <form class="was-validated" method="post" action="/visits.php?new">

               <input type="hidden" name="patID" value="<?= $pat['ID'] ?>">

               <div class="modal-body text-center">

                  <div class="form-row justify-content-center">
                     <div class="form-group col-md-6">
                        <label for="visit_date">Data wizyty:</label>
                        <input type="datetime-local" class="form-control" id="visit_date" name="visit_date" step="900" required>
                     </div>
                  </div>

               </div>

               <div class="modal-footer justify-content-center">
                  <button type="submit" name="formStep" value="2" class="btn btn-outline-success">
                     Dodaj wizytę
                  </button>
               </div>

            </form>

         </div>
      </div>
   </div>

	<?php

}
