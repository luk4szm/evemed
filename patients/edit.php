<?php
global $pat; #just for turn off notification
?>

<div class="card">
   <div class="card-header">
		<?= Breadcrump(
			array(
				'Pacjenci',
				$pat['full_name'],
				'Edycja',
			)
		) ?>
   </div>
   <div class="card-body">

      <form class="was-validated" method="post">

         <input type="hidden" name="ID" value="<?= $pat['ID'] ?>">

         <div class="form-row">
            <div class="form-group col-md-5">
               <label for="first_name">Imię:</label>
               <input type="text" class="form-control" id="first_name" name="first_name"
                      value="<?= FormValue($pat['first_name']) ?>" maxlength="20" required>
            </div>
            <div class="form-group col-md-7">
               <label for="last_name">Nazwisko:</label>
               <input type="text" class="form-control" id="last_name" name="last_name"
                      value="<?= FormValue($pat['last_name']) ?>" maxlength="40" required>
            </div>
         </div>

         <div class="form-row">
            <div class="form-group col-md-4">
               <label for="date_of_birth">Data urodzenia:</label>
               <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                      value="<?= FormValue($pat['date_of_birth']) ?>" max="<?= $today ?>">
            </div>
            <div class="form-group col-md-5">
               <label for="PESEL">PESEL:</label>
               <input type="text" class="form-control" id="PESEL" name="PESEL"
                      pattern="^\d{11}$" value="<?= FormValue($pat['PESEL']) ?>" maxlength="11">
            </div>
            <div class="form-group col-md-3">
               <label for="gender">Płeć:</label>
               <select class="form-control" name="gender" id="gender" title="> wybierz <" required>
                  <option value="f" <?php if ($pat['gender'] == 'female') echo 'selected'; ?>>kobieta</option>
                  <option value="m" <?php if ($pat['gender'] == 'male') echo 'selected'; ?>>mężczyzna</option>
               </select>
            </div>
         </div>

         <div class="form-row">
            <div class="form-group col-md-6">
               <label for="street">Adres zamieszkania:</label>
               <input type="text" class="form-control" id="street" name="street"
                      value="<?= FormValue($pat['street']) ?>" maxlength="100">
            </div>
            <div class="form-group col-md-2">
               <label for="postal_code">Kod pocztowy:</label>
               <input type="text" class="form-control" id="postal_code" name="postal_code"
                      value="<?= FormValue($pat['postal_code']) ?>" maxlength="6">
            </div>
            <div class="form-group col-md-4">
               <label for="city">Miasto:</label>
               <input type="text" class="form-control" id="city" name="city"
                      value="<?= FormValue($pat['city']) ?>" maxlength="40">
            </div>
         </div>

         <hr>

         <div class="form-group">
            <label for="allergy">Alergie:</label>
            <textarea class="form-control" id="allergy"
                      name="allergy" rows="1"><?= FormValue($pat['allergy']) ?></textarea>
            <small>Wprowadź kolejne wartości rozdzielając poszczególne znakiem przecinka. Gdy brak pozostaw puste pole.
            </small>
         </div>

         <div class="form-group">
            <label for="chronic_disease">Choroby przewlekłe:</label>
            <textarea class="form-control" id="chronic_disease"
                      name="chronic_disease" rows="1"><?= FormValue($pat['chronic_disease']) ?></textarea>
            <small>Wprowadź kolejne wartości rozdzielając poszczególne znakiem przecinka. Gdy brak pozostaw puste pole.
            </small>
         </div>

         <div class="form-group">
            <label for="drugs">Przyjmowane leki:</label>
            <textarea class="form-control" id="drugs"
                      name="drugs" rows="1"><?= FormValue($pat['drugs']) ?></textarea>
            <small>Wprowadź kolejne wartości rozdzielając poszczególne znakiem przecinka. Gdy brak pozostaw puste pole.
            </small>
         </div>

         <div class="form-row justify-content-center">
            <button type="submit" class="btn btn-outline-info" name="formStep" value="editPatientData">
               Zapisz zmiany
            </button>
         </div>

      </form>

   </div>
</div>