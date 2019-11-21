<?php

function FormatNrTel($nr)
{

   if ($nr) {

      //prefixy nr komórkowych
      $kom = array('50', '51', '53', '60', '66', '69', '72', '73', '78', '79', '88');

      //prefix przetwarzanego nr
      $prefix = substr($nr, 0, 2);

      if (in_array($prefix, $kom)) {
         $nrNew = implode('&nbsp;', str_split($nr, 3));
      } else {
         $nrNew = '(' . $prefix . ') ' . $nr['2'] . $nr['3'] . $nr['4'] . ' ' . $nr['5'] . $nr['6'] . ' ' . $nr['7'] . $nr['8'];
      }

   } else {

      $nrNew = NULL;
   }

   return $nrNew;

}