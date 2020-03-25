<?php

function IsLogged()
{

	if (isset($_SESSION['loggedUser'])) {
		return true;
	} else {
		return false;
	}

}