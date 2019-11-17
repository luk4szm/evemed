<?php

$step = (!isset($_SESSION['patNew'])) ? 1 : $_SESSION['patNew']['formStep'];

if (isset($_SESSION['patNew'])) {
	$form = $_SESSION['patNew'];
} else {
	$form = null;
}

if (isset($_SESSION['patNewErrors'])) {
	$form['error'] = $_SESSION['patNewErrors'];
	unset($_SESSION['patNewErrors']);
	$nextStepDisabled = 'disabled';
} else {
	$nextStepDisabled = null;
}

if (isset($_SESSION['patNewWarnings'])) {
	$form['warning'] = $_SESSION['patNewWarnings'];
	unset($_SESSION['patNewWarnings']);
}

?>

<div class="card">
   <div class="card-header">
		<?= Breadcrump(
			array(
				'Pacjenci',
				'Nowy pacjent',
			)
		) ?>
   </div>
   <div class="card-body">

		<?php

		ProgressBar($step, 2);

		if (isset($form['error'])) {
			foreach ($form['error'] AS $error) {
				ShowAlert('danger', $error, null, 15);
			}
		}

		if (isset($form['warning'])) {
			foreach ($form['warning'] AS $warn) {
				ShowAlert('warning', $warn, null, 15);
			}
		}

		?>

      <form class="was-validated" method="post">

			<?php
			if (isset($_SESSION['patNew'])) {
				//fill form knows data
				foreach ($form AS $name => $value) {
					if ($name != 'error' && $name != 'warning') {
						echo '<input type="hidden" name="' . $name . '" value="' . $value . '">';
					}
				}
			}
			?>

			<?php if (isset($_SESSION['patNew']) && $step > 1) { ?>
            <div class="row justify-content-center">
               <div class="col-md-10">
                  <table class="table table-condensed" style="margin-bottom: 20px;">
                     <tr class="table-sm">
                        <td width="30%">Imię i nazwisko:</td>
                        <td class="f500"><?= $form['first_name'] . ' ' . $form['last_name'] ?></td>
                     </tr>
                     <tr class="table-sm">
                        <td>Data urodzenia:</td>
                        <td><?= FormatIsNull(DateConvert($form['date_of_birth']), 'nie podano', 'f500 red') ?></td>
                     </tr>
                     <tr class="table-sm">
                        <td>PESEL:</td>
                        <td><?= FormatIsNull($form['PESEL'], 'nie podano', 'f500 red') ?></td>
                     </tr>
                     <tr class="table-sm">
                        <td>Adres zamieszkania:</td>
                        <td><?= FormatIsNull(FormatAddress($form), 'nie podano', 'f500 red') ?></td>
                     </tr>
                     <tr class="table-sm">
                        <td>Alergie:</td>
                        <td><?= FormatIsNull($form['allergy'], 'brak') ?></td>
                     </tr>
                     <tr class="table-sm">
                        <td>Choroby przewlekłe:</td>
                        <td><?= FormatIsNull($form['chronic_disease'], 'brak') ?></td>
                     </tr>
                     <tr class="table-sm">
                        <td>Przyjmowane leki:</td>
                        <td><?= FormatIsNull($form['drugs'], 'brak') ?></td>
                     </tr>
                  </table>
               </div>
            </div>
			<?php } ?>

			<?php if ($step == 1) { ?>

            <div class="form-row">
               <div class="form-group col-md-5">
                  <label for="first_name">Imię:</label>
                  <input type="text" class="form-control" id="first_name" name="first_name"
                         value="<?= FormValue($form['first_name']) ?>" maxlength="20" required>
               </div>
               <div class="form-group col-md-7">
                  <label for="last_name">Nazwisko:</label>
                  <input type="text" class="form-control" id="last_name" name="last_name"
                         value="<?= FormValue($form['last_name']) ?>" maxlength="40" required>
               </div>
            </div>

            <div class="form-row">
               <div class="form-group col-md-4">
                  <label for="date_of_birth">Data urodzenia:</label>
                  <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                         value="<?= FormValue($form['date_of_birth']) ?>" max="<?= $today ?>">
               </div>
               <div class="form-group col-md-5">
                  <label for="PESEL">PESEL:</label>
                  <input type="text" class="form-control" id="PESEL" name="PESEL"
                         pattern="^\d{11}$" value="<?= FormValue($form['PESEL']) ?>" maxlength="11">
               </div>
               <div class="form-group col-md-3">
                  <label for="gender">Płeć:</label>
                  <select class="selectpicker form-control" name="gender" id="gender" title="> wybierz <" required>
                     <option value="f" <?php if ($form['gender'] == 'f') echo 'selected'; ?>>kobieta</option>
                     <option value="m" <?php if ($form['gender'] == 'm') echo 'selected'; ?>>mężczyzna</option>
                  </select>
               </div>
            </div>

            <div class="form-row">
               <div class="form-group col-md-6">
                  <label for="street">Adres zamieszkania:</label>
                  <input type="text" class="form-control" id="street" name="street"
                         value="<?= FormValue($form['street']) ?>" maxlength="100">
               </div>
               <div class="form-group col-md-2">
                  <label for="postal_code">Kod pocztowy:</label>
                  <input type="text" class="form-control" id="postal_code" name="postal_code"
                         value="<?= FormValue($form['postal_code']) ?>" maxlength="6">
               </div>
               <div class="form-group col-md-4">
                  <label for="city">Miasto:</label>
                  <input type="text" class="form-control" id="city" name="city"
                         value="<?= FormValue($form['city']) ?>" maxlength="40">
               </div>
            </div>

            <hr>

            <div class="form-group">
               <label for="allergy">Alergie:</label>
               <input type="text" class="form-control" id="allergy"
                      value="<?= FormValue($form['allergy']) ?>" name="allergy">
               <small>Wprowadź kolejne wartości rozdzielając poszczególne znakiem przecinka. Gdy brak pozostaw puste
                  pole.
               </small>
            </div>

            <div class="form-group">
               <label for="chronic_disease">Choroby przewlekłe:</label>
               <input type="text" class="form-control" id="allergy"
                      value="<?= FormValue($form['chronic_disease']) ?>" name="chronic_disease">
               <small>Wprowadź kolejne wartości rozdzielając poszczególne znakiem przecinka. Gdy brak pozostaw puste
                  pole.
               </small>
            </div>

            <div class="form-group">
               <label for="drugs">Przyjmowane leki:</label>
               <input type="text" class="form-control" id="allergy"
                      value="<?= FormValue($form['drugs']) ?>" name="drugs">
               <small>Wprowadź kolejne wartości rozdzielając poszczególne znakiem przecinka. Gdy brak pozostaw puste
                  pole.
               </small>
            </div>

            <div class="form-row justify-content-center">
					<?= CleanButton($form); ?>
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
                       value="finish" <?= $nextStepDisabled ?>>
                  Tak, dodaj pacjenta do bazy
               </button>
            </div>
			<?php } ?>

      </form>

   </div>
</div>