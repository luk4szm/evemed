<?php

$step = (!isset($_SESSION['procNew'])) ? 1 : $_SESSION['procNew']['formStep'];

if (isset($_SESSION['procNew'])) {
	$form = $_SESSION['procNew'];
} else {
	$form = null;
}

if (isset($_SESSION['procNewErrors'])) {
	$form['error'] = $_SESSION['procNewErrors'];
	unset($_SESSION['procNewErrors']);
	$nextStepDisabled = 'disabled';
} else {
	$nextStepDisabled = null;
}

if (isset($_SESSION['procNewWarnings'])) {
	$form['warning'] = $_SESSION['procNewWarnings'];
	unset($_SESSION['procNewWarnings']);
}

   echo '<pre>';
   print_r($form);
   echo '</pre>';

?>

<div class="card">
   <div class="card-header">
		<?= Breadcrump(
			array(
				'Zabiegi',
				'Nowy zabieg',
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
			if (isset($_SESSION['procNew'])) {
				//fill form knows data
				foreach ($form AS $name => $value) {
					if ($name != 'error' && $name != 'warning') {
						echo '<input type="hidden" name="' . $name . '" value="' . $value . '">';
					}
				}
			}
			?>

			<?php if (isset($_SESSION['procNew']) && $step > 1) { ?>
            <div class="row justify-content-center">
               <div class="col-md-10">
                  <table class="table table-condensed" style="margin-bottom: 20px;">
                     <tr class="table-sm">
                        <td width="30%">Nazwa skrócona:</td>
                        <td class="f500"><?= $form['name_short'] ?></td>
                     </tr>
                     <tr class="table-sm">
                        <td>Nazwa pełna:</td>
                        <td><?= $form['name_full'] ?></td>
                     </tr>
                     <tr class="table-sm">
                        <td>Cena nominalna:</td>
                        <td class="f500"><?= FormatPrice($form['price']) ?></td>
                     </tr>
                     <tr class="table-sm">
                        <td>Opis zabiegu:</td>
                        <td><?= FormatIsNull($form['description'], 'nie podano') ?></td>
                     </tr>
                  </table>
               </div>
            </div>
			<?php } ?>

			<?php if ($step == 1) { ?>

            <div class="form-row">
               <div class="form-group col-md-9">
                  <label for="name_short">Nazwa skrócona:</label>
                  <input type="text" class="form-control" id="name_short" name="name_short"
                         value="<?= FormValue($form['name_short']) ?>" maxlength="100" required>
               </div>
               <div class="form-group col-md-3" style="margin-bottom: 0">
                  <label for="price">Cena nominalna:</label>
                  <div class="input-group mb-3">
                     <div class="input-group-prepend">
                        <span class="input-group-text">PLN</span>
                     </div>
                     <input type="text" class="form-control" id="price" name="price" style="text-align: right;"
                            value="<?= FormValue($form['price']) ?>" required>
                  </div>
               </div>
            </div>

            <div class="row">
               <div class="form-group col-md-12">
                  <label for="name_full">Pełna nazwa:</label>
                  <input type="text" class="form-control" id="name_full" name="name_full"
                         value="<?= FormValue($form['name_full']) ?>" maxlength="500" required>
               </div>
            </div>

            <div class="row">
               <div class="form-group col-md-12">
                  <label for="description">Opis zabiegu:</label>
                  <textarea class="form-control" id="description" name="description" rows="2"
                            maxlength="1000"><?= FormValue($form['description']) ?></textarea>
               </div>
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
                  Tak, dodaj zabieg do bazy
               </button>
            </div>
			<?php } ?>

      </form>

   </div>
</div>