<?php
global $proc; #just for turn off notification
?>

   <div class="card">
      <div class="card-body">
         <div class="d-flex justify-content-center" style="padding: 0 20px">

				<?php if ($proc['status'] == 1) { ?>

               <div class="text-center w-100" style="margin: 0 5px;">
                  <button type="button" class="btn btn-outline-danger" data-toggle="modal"
                          data-target="#ProcedureTurnOffModal" style="border-radius: 25px;">
                     Wycofaj zabieg z listy wykonywanych
                  </button>
               </div>

				<?php } ?>

            <?php if ($proc['status'] == 0) { ?>

               <div class="text-center w-100" style="margin: 0 5px;">
                  <button type="button" class="btn btn-outline-success" data-toggle="modal"
                          data-target="#ProcedureTurnOnModal" style="border-radius: 25px;">
                     Przywróć zabieg z listy wykonywanych
                  </button>
               </div>

				<?php } ?>

         </div>
      </div>
   </div>

<?php

require_once __MDIR__ . '/procedures/modals/procedure-turnOff.php';
Modal_ProcedureTurnOff($proc);
require_once __MDIR__ . '/procedures/modals/procedure-turnOn.php';
Modal_ProcedureTurnOn($proc);