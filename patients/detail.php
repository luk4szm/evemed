<?php
global $pat; #just for turn off notification
?>

<div class="card">
   <div class="card-header">
		<?= Breadcrump(
			array(
				'Pacjenci',
				$pat['full_name'],
				'Szczegóły',
			)
		) ?>
   </div>
   <div class="card-body" style="padding-bottom: 0">

      <?php
      if (!$pat['profile_complete']) {
         ShowInfoLabel('Profil pacjenta niekompletny!<br>Uzupełnij niezbędne dane.', 'red');
		}
      ?>

      <div class="media" style="padding-bottom: 15px">

         <div class="align-self-center" style="width: 150px; margin-right: 15px;">

            <img class="mx-auto d-block" src="/img/gender/<?= $pat['gender'] ?>.png"
                 title="<?= $pat['gender'] ?>" alt="<?= $pat['gender'] ?>" width="130px"/>

         </div>

         <div class="border-left h-100 media-body align-self-center">
            <div class="w-100 d-inline-block" style="margin: 0; padding: 0 20px">

               <table class="table table-condensed">

                  <tr class="table-sm">
                     <td width="200px">Imię i nazwisko:</td>
                     <td class="f500" style="font-size: 16px">
								<?= $pat['full_name'] ?>
                     </td>
                  </tr>

                  <tr class="table-sm">
                     <td>Data urodzenia:</td>
                     <td>
								<?php
								if ($pat['date_of_birth']) {
									echo DateConvert($pat['date_of_birth']) . ' (wiek: ' . $pat['age'] . ' lat)';
								} else {
									echo FormatIsNull($pat['date_of_birth'], 'nie podano', 'f500 red');
								}
								?>
                     </td>
                  </tr>

                  <tr class="table-sm">
                     <td>PESEL:</td>
                     <td>
								<?= FormatIsNull($pat['PESEL'], 'nie podano', 'f500 red')?>
                     </td>
                  </tr>

                  <tr class="table-sm">
                     <td>Adres zamieszkania:</td>
                     <td>
								<?= FormatIsNull($pat['full_address'], 'nie podano', 'f500 red') ?>
                     </td>
                  </tr>

                  <tr class="table-sm">
                     <td>Alergie:</td>
                     <td>
								<?= FormatIsNull(FormatListFromLine($pat['allergy'])) ?>
                     </td>
                  </tr>

                  <tr class="table-sm">
                     <td>Choroby przewlekłe:</td>
                     <td>
								<?= FormatIsNull(FormatListFromLine($pat['chronic_disease'])) ?>
                     </td>
                  </tr>

                  <tr class="table-sm">
                     <td>Przyjmowane leki:</td>
                     <td>
								<?= FormatIsNull(FormatListFromLine($pat['drugs'])) ?>
                     </td>
                  </tr>

               </table>

            </div>
         </div>


      </div>

   </div>
   <div class="card-footer text-muted text-right">
      Wprowadzono do systemu: <span class="f500"><?= DateConvert($pat['entry_add']) ?></span>
   </div>
</div>
