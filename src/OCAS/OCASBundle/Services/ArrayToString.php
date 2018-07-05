<?php

namespace OCAS\OCASBundle\Services;

class ArrayToString
{
    /** si la fonction recoit une string elle le convertit en array
    * et si elle recoit un array elle le convertit en string
    * en appelant la fonction correspondante
    */
    public function fonctionArrayOrString($arg)
    {
        if (is_array($arg)) {
            return $this->arrayToString($arg);
        } elseif (is_string($arg)) {
            return $this->fonctionStringToArray($arg);
        }
    }

    /** si la fonction recoit une string elle le convertit en array
    * et si elle recoit un array elle le convertit en string
    * en appelant le type correspondant
    */
    public function typeArrayOrString($arg)
    {
        if (is_array($arg)) {
            return $this->arrayToString($arg);
        } elseif (is_string($arg)) {
            return $this->typeStringToArray($arg);
        }
    }

    public function arrayToString($array)
    {
        $string='';
        for ($i=0; $i < count($array); $i++) {
            $string.=$array[$i];
            if ($i+1<count($array)) {
                $string.=' - ';
            }
        }
        return $string;
    }

    public function fonctionStringToArray($string)
    {
        $array=preg_split('/[\s]?-[\s]?/', $string);
        for ($i=0; $i < count($array); $i++) {
            if (strpos($array[$i], "Format")!==false) {
                $array[$i]="Formateur·ice";
            }
            if ("psychologue"===$array[$i]) {
                $array[$i]="Psychologue";
            }
            if (strpos($array[$i], "Conseill")!==false) {
                $array[$i]='Conseiller·e en formation continue';
            }
            if (strpos($array[$i], "Assistant")!==false) {
                $array[$i]='Assistant·e administratif·ve';
            }
            if ('responsable des affaires administratives et financières'===$array[$i]) {
                $array[$i]='Responsable des affaires administratives et financières';
            }
            if (strpos($array[$i], "Direct")!==false) {
                $array[$i]='Directeur·ice des études';
            }
            if (strpos($array[$i], "Coordinat")!==false) {
                $array[$i]='Coordinateur·ice';
            }
            if ('vacataire'===$array[$i]) {
                $array[$i]='Vacataire';
            }
            if (strpos($array[$i], 'Animat')!==false) {
                $array[$i]='Animateur·ice en formation continue';
            }
        }
        return $array ; // 0 ou 1 espace
    }

    public function typeStringToArray($string)
    {
        $array=preg_split('/[\s]?-[\s]?/', $string);
        for ($i=0; $i < count($array); $i++) {
          if ("Insertion/Orientation"===$array[$i]) {
              $array[$i]="Insertion / Orientation";
          }
          if (strpos($array[$i], "Qualif")!==false) {
              $array[$i]='Qualification';
          }
          if (strpos($array[$i], "Insert")!==false) {
              $array[$i]='Insertion / Orientation';
          }
          if (strpos($array[$i], "Orient")!==false) {
              $array[$i]='Insertion / Orientation';
          }
          if (strpos($array[$i], "Ill")!==false) {
              $array[$i]='Formation Génerale / Illétrisme';
          }
          if ('vacataire'===$array[$i]) {
              $array[$i]='Vacataire';
          }
        }
        return $array ; // 0 ou 1 espace
    }

    //prend en entree une durée en seconde et retourne la durée en heure décimale
    public function intToHour($int){
      return;
    }
}
