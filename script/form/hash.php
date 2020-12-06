<?php

function FormHashGenerate($salt = '$ji*h_pL')
{
   $hash = hash('SHA1', md5(mt_rand(1, 999999) . $salt));

   $_SESSION['csrf_hash'] = $hash;

   return $hash;
}

function FormHashValidation($hash)
{
   if ($hash === $_SESSION['csrf_hash']) {
      unset($_SESSION['csrf_hash']);
      return true;
   } else {
      return false;
   }
}