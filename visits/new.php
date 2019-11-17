<?php

$step = (!isset($_SESSION['visNew'])) ? 1 : $_SESSION['visNew']['formStep'];

if (isset($_SESSION['visNew'])) {
	$form = $_SESSION['visNew'];
	if (isset($_SESSION['visNewErrors'])) {
		$form['error'] = $_SESSION['visNewErrors'];
	}
} else {
	$form = null;
}

$disable_next_step = false;

?>

<div class="card">
   <div class="card-header">
		<?= Breadcrump(
			array(
				'Wizyty',
				'Nowa wizyta',
			)
		) ?>
   </div>
   <div class="card-body">

		<?php ProgressBar($step, 2); ?>

      <form class="was-validated" method="post">

			<?php
			if (isset($_SESSION['visNew'])) {
				//fill form knows data
				foreach ($form AS $name => $value) {
					if ($name != 'error' || $name != 'warning') {
						echo '<input type="hidden" name="' . $name . '" value="' . $value . '">';
					}
				}
			}

			if (isset($form['visit_date'])) {

				$search_date = substr($form['visit_date'], 0, 10);
				$day_visits = VisitList("LEFT(v.visit_date, 10) = '$search_date' AND v.statusID = 1");
				$hour_visits = VisitList("v.visit_date = '{$form['visit_date']}' AND v.statusID = 1");

				if ($day_visits['code'] == 200) {
					if ($hour_visits['code'] == 200) {
						$txt = 'W tym terminie masz już zaplanowaną wizytę!<br />';
						foreach ($hour_visits['result'] AS $vis) {
							$txt .= DateConvert($vis['visit_date'], true);
							$txt .= ' - ' . $vis['pat_full_name'] . '<br>';
						}
						ShowInfoLabel($txt, 'red');
						$disable_next_step = 'disabled';
					}

					?>

               <div class="card">
                  <div class="card-body text-center"
                       style="background: rgba(1, 1, 1, 0.03); padding: 10px; line-height: 1.54; font-size: 15px">
                     <span class="f500">Pozostałe wizyty tego dnia:</span><br>
							<?php foreach ($day_visits['result'] AS $vis) { ?>
								<?= DateConvert($vis['visit_date'], true) ?> - <?= $vis['pat_full_name'] ?><br/>
							<?php } ?>
                  </div>
               </div>

					<?php

				}

			}

			if (isset($_SESSION['visNew']) && $step > 1) {

				require_once $_SERVER['DOCUMENT_ROOT'] . '/patients/script/recon.php';
				$pat = PatientRecon($form['patID']);

				?>
            <div class="row justify-content-center">
               <div class="col-md-10">
                  <table class="table table-condensed" style="margin-bottom: 20px;">
                     <tr class="table-sm">
                        <td width="30%">Pacjent:</td>
                        <td class="f500"><?= $pat['result']['full_name'] ?></td>
                     </tr>
                     <tr class="table-sm">
                        <td>Data wizyty:</td>
                        <td><?= DateConvert($form['visit_date']) ?></td>
                     </tr>
                  </table>
               </div>
            </div>
			<?php } ?>

			<?php if ($step == 1) { ?>

            <div class="form-row justify-content-center">
               <div class="form-group col-md-6">
                  <label for="patID">Pacjent:</label>
                  <select class="selectpicker form-control" name="patID" id="patID"
                          title="Wybierz obiekt" data-live-search="true" required>
							<?php
							require_once $_SERVER['DOCUMENT_ROOT'] . '/patients/script/list.php';
							$patients = PatientList();

							if ($patients['list_count'] > 0) {
								foreach ($patients['result'] AS $pat) {
									$selected = ($pat['ID'] == $form['patID']) ? 'selected' : '';
									echo '<option value="' . $pat['ID'] . '" ' . $selected . '>' . $pat['full_name'] . '</option>';
								}
							}
							?>
                  </select>
               </div>

               <div class="form-group col-md-4">
                  <label for="visit_date">Data wizyty:</label>
                  <input type="datetime-local" class="form-control" id="visit_date" name="visit_date" step="900"
                         value="<?= FormValue($form['visit_date']) ?>" required>
               </div>
            </div>

            <div class="form-row justify-content-center">
               <button type="submit" class="btn btn-outline-info" name="formStep" value="<?= $step + 1 ?>">
                  Dalej
               </button>
            </div>

			<?php } ?>

			<?php if ($step == 2) { ?>
            <div class="form-group text-center">
               <p>Czy wszystkie dane się zgadzają?
            </div>

            <div class="form-row justify-content-center">
               <button type="submit" class="btn btn-outline-danger" name="formStep" value="<?= $step - 1 ?>">
                  Nie, popraw dane
               </button>
               &emsp;
               <button type="submit" class="btn btn-outline-success" name="formStep"
                       value="finish" <?= $disable_next_step ?>>
                  Tak, dodaj wizytę do bazy
               </button>
            </div>
			<?php } ?>

      </form>

   </div>
</div>