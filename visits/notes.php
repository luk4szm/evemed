<?php
global $vis; #just for turn off notification
$k = 0;
?>

   <div class="card">
      <div class="card-header">
			<?= Breadcrump(
				array(
					'Wizyty',
					$vis['patient']['full_name'],
					DateConvert($vis['visit_date'], true),
					'Notatki',
				)
			) ?>
      </div>
      <div class="card-body">
			<?php
			if ($vis['notes_count'] > 0) {
				?>
            <table class="table table-condensed">

               <tr>
                  <th width="5%"></th>
                  <th class="text-center" width="25%">Dodano</th>
                  <th class="text-center">Treść notatki</th>
                  <th style="width: 40px"></th>
               </tr>

					<?php
					for ($i = 0; $i < $vis['notes_count']; $i++) {
						$note = $vis['notes'][$i];
						?>
                  <tr class="table-sm">
                     <td>
                        #<?= ++$k ?>
                     </td>
                     <td class="text-center" nowrap>
								<?= DateConvert($note['entry_add']) ?><br>
								<?= $note['add_user']['full_name'] ?>
                     </td>
                     <td class="text-center">
								<?= $note['txt'] ?>
                     </td>
                     <td class="text-center" style="padding: 0">
								<?php
								if ($note['add_user']['ID'] === $_SESSION['loggedUser']['ID']) {
									?>
                           <div class="d-flex justify-content-around">
                              <a href="" data-toggle="modal" data-target="#CommentEditModal<?= $note['ID'] ?>">
                                 <img title="edytuj" alt="edytuj" class="on-hover" src="/img/octicon/pencil.svg">
                              </a>
                              <a href="" data-toggle="modal" data-target="#CommentDelModal<?= $note['ID'] ?>">
                                 <img title="usuń" alt="usuń" class="on-hover" src="/img/octicon/trashcan.svg">
                              </a>
                           </div>
									<?php
								}
								?>
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
            <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#ProcedureAddModal"
                    style="border-radius: 25px;">
               Dodaj notatkę
            </button>
         </div>
      </div>
   </div>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/visits/modals/procedure-add.php';
Modal_AddProcedureToVisit($vis);

require_once $_SERVER['DOCUMENT_ROOT'] . '/visits/modals/procedure-edit.php';
for ($i = 0; $i < $vis['procedures_count']; $i++) {
	$proc = $vis['procedures'][$i];
	Modal_EditVisitProcedure($proc);
}
