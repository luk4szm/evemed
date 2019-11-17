<?php
global $vis; #just for turn off notification
?>

<div class="card">
   <div class="card-header">
		<?= Breadcrump(
			array(
				'Wizyty',
				$vis['patient']['full_name'],
				DateConvert($vis['visit_date'], true),
				'Szczegóły',
			)
		) ?>
   </div>
   <div class="card-body" style="padding-bottom: 0">

      <div class="media" style="padding-bottom: 15px">

         <div class="align-self-center" style="width: 150px; margin-right: 15px;">
            <img class="mx-auto d-block" src="/img/visit.png" title="Wizyta" alt="Wizyta" width="130px"/>
         </div>

         <div class="border-left h-100 media-body align-self-center">
            <div class="w-100 d-inline-block" style="margin: 0; padding: 0 20px">

               <table class="table table-condensed">

                  <tr class="table-sm">
                     <td width="200px">Pacjent:</td>
                     <td style="font-size: 16px">
                        <a href="/patient.php?id=<?= $vis['patient']['ID'] ?>" class="black">
                           <span class="f500"><?= $vis['patient']['full_name'] ?></span>
									<?= ' (' . $vis['patient']['age'] . ' lat)' ?>
                        </a>
                     </td>
                     <td class="min-width">
                        <i class="fas fa-angle-right fa-fw" aria-hidden="true"></i>
                     </td>
                  </tr>

                  <tr class="table-sm">
                     <td>Status:</td>
                     <td colspan="2">
								<?= FormatVisitStatus($vis['statusID']) ?>
                     </td>
                  </tr>

                  <?php if ($vis['canc_note']) { ?>
                  <tr class="table-sm">
                     <td>Uwagi:</td>
                     <td colspan="2">
								<?= $vis['canc_note'] ?>
                     </td>
                  </tr>
                  <?php } ?>

                  <?php if ($vis['conf_note']) { ?>
                  <tr class="table-sm">
                     <td>Uwagi:</td>
                     <td colspan="2">
								<?= $vis['conf_note'] ?>
                     </td>
                  </tr>
                  <?php } ?>

                  <?php if (empty($vis['canc_date'])) { ?>
                  <tr class="table-sm">
                     <td>Zalecenia:</td>
                     <td colspan="2">
								<?= FormatIsNull($vis['recommend'], 'nie uzupełniono') ?>
                     </td>
                  </tr>
                  <?php } ?>

                  <tr class="table-sm">
                     <td>Data wizyty:</td>
                     <td colspan="2">
								<?= DateConvert($vis['visit_date'], true) ?>
                     </td>
                  </tr>

                  <tr class="table-sm">
                     <td>Cena za wizytę:</td>
                     <td colspan="2" class="f500">
								<?= FormatPrice($vis['procedures_price']) ?>
                     </td>
                  </tr>

               </table>

            </div>
         </div>


      </div>

   </div>
   <div class="card-footer text-muted text-right">
      Wprowadzono do systemu: <span class="f500"><?= DateConvert($vis['entry_add']) ?></span>
   </div>
</div>
