<?php

function IsSiteAdmin()
{

	if (isset($_SESSION['loggedUser']['admin']) && $_SESSION['loggedUser']['admin'] == true) {
		return true;
	} else {
		return false;
	}

}