<?php
global $proc; #just for turn off notification
?>

<div class="card">
   <div class="card-header">
		<?= Breadcrump(
			array(
				'Zabiegi',
				$proc['name_short'],
				'Edycja',
			)
		) ?>
   </div>
   <div class="card-body">

      <form class="was-validated" method="post">

         <input type="hidden" name="ID" value="<?= $proc['ID'] ?>">

         <div class="form-group row">
            <label for="name_short" class="col-sm-3 col-form-label">Nazwa skrócona:</label>
            <div class="col-sm-9">
               <input type="text" class="form-control" id="name_short" name="name_short"
                      value="<?= FormValue($proc['name_short']) ?>" maxlength="100" required>
            </div>
         </div>

         <div class="form-group row">
            <label for="name_full" class="col-sm-3 col-form-label">Pełna nazwa:</label>
            <div class="col-sm-9">
               <input type="text" class="form-control" id="name_full" name="name_full"
                      value="<?= FormValue($proc['name_full']) ?>" maxlength="500" required>
            </div>
         </div>

         <div class="form-group row">
            <label for="price" class="col-sm-3 col-form-label">Cena nominalna:</label>
            <div class="col-sm-3">
               <div class="input-group">
                  <div class="input-group-prepend">
                     <span class="input-group-text">PLN</span>
                  </div>
                  <input type="text" class="form-control" id="price" name="price" style="text-align: right;"
                         value="<?= FormValue($proc['price']) ?>" required>
               </div>
            </div>
         </div>

         <div class="form-group row">
            <label for="description" class="col-sm-3 col-form-label">Opis zabiegu:</label>
            <div class="col-sm-9">
               <textarea class="form-control" id="description" name="description"
                         rows="3" maxlength="1000"><?= FormValue($proc['description']) ?></textarea>
            </div>
         </div>

         <div class="form-row justify-content-center">
            <button type="submit" class="btn btn-outline-info" name="formStep" value="editProcedureData">
               Zapisz zmiany
            </button>
         </div>

      </form>

   </div>
</div>