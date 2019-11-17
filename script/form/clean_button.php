<?php

function CleanButton($form)
{

	if (isset($form)) {

		return '
      <button type="submit" class="btn btn-outline-danger" name="formStep" value="del">
         Wyczyść formularz
      </button>
      &emsp;
		';

	}

}