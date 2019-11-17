<?php
global $vis; #just for turn off notification
if ($vis['statusID'] == 1) { ?>

   <div class="card">
      <div class="card-body">
         <div class="d-flex justify-content-center" style="padding: 0 20px">

				<?php if ($vis['visit_date'] < $now) { ?>
               <div class="text-center w-100" style="margin: 0 5px;">
                  <button type="button" class="btn btn-outline-success" data-toggle="modal"
                          data-target="#VisitConfirmModal" style="border-radius: 25px;">
                     Wizyta się już odbyła
                  </button>
               </div>
				<?php } ?>

            <div class="text-center w-100" style="margin: 0 5px;">
               <button type="button" class="btn btn-outline-info" data-toggle="modal"
                       data-target="#VisitChangeDateModal" style="border-radius: 25px;">
                  Zmień termin wizyty
               </button>
            </div>

            <div class="text-center w-100" style="margin: 0 5px;">
               <button type="button" class="btn btn-outline-danger" data-toggle="modal"
                       data-target="#VisitCancelModal" style="border-radius: 25px;">
                  Anulowano wizytę
               </button>
            </div>

         </div>
      </div>
   </div>

<?php }

require_once $_SERVER['DOCUMENT_ROOT'] . '/visits/modals/visit-confirm.php';
Modal_VisitConfirm($vis);
require_once $_SERVER['DOCUMENT_ROOT'] . '/visits/modals/visit-change-date.php';
Modal_VisitChangeDate($vis);
require_once $_SERVER['DOCUMENT_ROOT'] . '/visits/modals/visit-cancel.php';
Modal_VisitCancel($vis);