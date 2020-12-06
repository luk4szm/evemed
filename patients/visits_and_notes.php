<?php
global $pat; #just for turn off notification
?>

   <div class="row justify-content-center">
      <div class="col-md-6">

         <div class="card">
            <div class="card-header">
					<?= Breadcrump(
						array(
							'Wizyty zaplanowane',
						)
					) ?>
            </div>
            <div class="card-body">

					<?php if (isset($pat['visits_future'])) { ?>

                  <table class="table table-condensed table-hover">

                     <tr>
                        <th>#</th>
                        <th>Data wizyty</th>
                        <th>Cena</th>
                        <th class="min-width"></th>
                     </tr>

							<?php
							$k = 0;
							for ($i = 0; $i < $pat['visits_future_count']; $i++) {
								$vis = $pat['visits_future'][$i];
								?>
                        <tr class="table-sm" style="cursor: pointer;"
                            onclick="window.location='/visit.php?id=<?= $vis['id'] ?>'">
                           <td class="min-width">
										<?= ++$k ?>
                           </td>
                           <td>
										<?= DateConvert($vis['visit_date'], true) ?>
                           </td>
                           <td class="f500">
										<?= FormatPrice($vis['price']) ?>
                           </td>
                           <td>
                              <i class="fas fa-angle-right fa-fw" aria-hidden="true"></i>
                           </td>
                        </tr>
							<?php } ?>

                  </table>

						<?php
					} else {
						ShowSimpleInfo('Brak zaplanowanych wizyt');
					}
					?>

					<?php if ($pat['visits_past_count'] > 0) { ?>
                  <div class="row justify-content-center" style="margin-top: 15px">
                     <a href="/patient.php?visits_past=<?= $pat['id'] ?>" style="font-size: 14px">[zobacz minione
                        wizyty (<?= $pat['visits_past_count'] ?>)]</a>
                  </div>
					<?php } ?>

               <div class="row justify-content-center" style="margin-top: 15px">
                  <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#VisitNewModal"
                          style="border-radius: 25px;">
                     Dodaj wizytę
                  </button>
               </div>

            </div>
         </div>

      </div>
      <div class="col-md-6">

         <div class="card">
            <div class="card-header">
					<?= Breadcrump(
						array(
							'Notatki',
						)
					) ?>
            </div>
            <div class="card-body">

					<?php
					if ($pat['notes_count'] > 0) {
						?>
                  <table class="table table-condensed">

                     <tr>
                        <th width="5%">#</th>
                        <th class="text-center">Treść notatki</th>
                     </tr>

							<?php
                     $k = 0;
							for ($i = 0; $i < $pat['notes_count']; $i++) {
								$note = $pat['notes'][$i];
								?>
                        <tr class="table-sm">
                           <td>
                              <?= ++$k ?>
                           </td>
                           <td class="text-center">
										<?= nl2br($note['txt']) ?>
                           </td>
                        </tr>
							<?php } ?>

                  </table>
						<?php
					} else {
						ShowSimpleInfo('Brak notatek');
					}
					?>

               <div class="row justify-content-center" style="margin-top: 15px">
                  <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#NoteAddModal"
                          style="border-radius: 25px;">
                     Dodaj notatkę
                  </button>
               </div>

            </div>
         </div>

      </div>
   </div>

<?php
require_once __MDIR__ . '/patients/modals/visit-new.php';
Modal_VisitNew($pat);

require_once __MDIR__ . '/notes/modals/note-add.php';
Modal_AddNoteToItem('pat_id', $pat['id']);