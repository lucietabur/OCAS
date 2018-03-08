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
    $array=preg_split('/[\s]?-[\s]?/', $string);
    // for ($i=0; $i < count($array); $i++) {
    //   if ($array[$i]=="formateur" || $array[$i]=="Formateur" || $array[$i]=="formatrice" || $array[$i]=='Formatrice'){
    //     $array[$i]="Formateur·ice";
    //   }
    // }
      return $array ; // 0 ou 1 espace
  }


}
