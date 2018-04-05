<?php

namespace OCAS\OCASBundle\Services;

class ArrayToString
{
    /** si la fonction recoit une string elle le convertit en array
    * et si elle recoit un array elle le convertit en string
    * en appelant la fonction correspondante
    */
    public function arrayOrString($arg)
    {
        if (is_array($arg)) {
            return $this->arrayToString($arg);
        } elseif (is_string($arg)) {
            return $this->stringToArray($arg);
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

    public function stringToArray($string)
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
}
