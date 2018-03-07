<?php

namespace OCAS\OCASBundle\Services;

class ArrayToString
{

  public function arrayToString($array)
  {
    $string='';
    for ($i=0; $i < count($array); $i++) {
      $string.=$array[$i];
      if ($i+1<count($array)){
        $string.=' - ';
      }
    }
    return $string;
  }

  public function stringToArray($string)
  {
      return preg_split('/[\s]?-[\s]?/', $string); // 0 ou 1 espace 
  }


}
