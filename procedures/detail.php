<?php
global $proc; #just for turn off notification
?>

<div class="card">
   <div class="card-header">
		<?= Breadcrump(
			array(
				'Zabiegi',
				$proc['name_short'],
				'Szczegóły',
			)
		) ?>
   </div>
   <div class="card-body" style="padding-bottom: 0">

      <div class="media" style="padding-bottom: 15px">

         <div class="align-self-center" style="width: 150px; margin-right: 15px;">

            <img class="mx-auto d-block" src="/img/syringe.png" title="Zabieg" alt="Zabieg"/>

         </div>

         <div class="border-left h-100 media-body align-self-center">
            <div class="w-100 d-inline-block" style="margin: 0; padding: 0 20px">

               <table class="table table-condensed">

                  <tr class="table-sm">
                     <td width="200px">Nazwa skrócona:</td>
                     <td class="f500" style="font-size: 16px">
								<?= $proc['name_short'] ?>
                     </td>
                  </tr>

                  <tr class="table-sm">
                     <td>Pełna nazwa:</td>
                     <td>
								<?= $proc['name_full'] ?>
                     </td>
                  </tr>

                  <tr class="table-sm">
                     <td>Opis zabiegu:</td>
                     <td>
								<?= FormatIsNull($proc['description'], 'nie podano') ?>
                     </td>
                  </tr>

                  <tr class="table-sm">
                     <td>Cena nominalna:</td>
                     <td class="f500">
								<?= FormatPrice($proc['price']) ?>
                     </td>
                  </tr>

                  <tr class="table-sm">
                     <td>Wykonano zabiegów:</td>
                     <td class="f500">
								<?= $proc['visit_past_occurr_count'] ?>
                     </td>
                  </tr>

						<?php if ($proc['visit_past_occurr_count']) { ?>
                     <tr class="table-sm">
                        <td>Łączny przychód:</td>
                        <td class="f500">
									<?= FormatPrice($proc['visit_past_occurr_sum_price']) ?>
                           <small>
                              (średnio: <?= FormatPrice($proc['visit_past_occurr_sum_price'] / $proc['visit_past_occurr_count']) ?>
                              )
                           </small>
                        </td>
                     </tr>
						<?php } ?>

               </table>

            </div>
         </div>


      </div>

   </div>
   <div class="card-footer text-muted text-right">
      Wprowadzono do systemu: <span class="f500"><?= DateConvert($proc['entry_add']) ?></span>
   </div>
</div>
