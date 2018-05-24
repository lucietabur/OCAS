<?php

namespace OCAS\OCASBundle\Services;

class GenerateDoc
{


    public function generateMissionDoc($form,$tbs,$stagiaires)
    {
      $data = $form->getData();
      $data['stagiaires'] = $this->stagiaireToArray($form,$data['stagiaires']);
       // generer le fichier
       setlocale (LC_TIME, 'fr_FR.utf8','fra');
       $tbs->LoadTemplate('/var/www/html/project/fichiers generes/om_ocas genere.docx', OPENTBS_ALREADY_UTF8);
       $tbs->MergeBlock('tbs',$data['stagiaires']);
       $tbs->MergeField('date_edition',$data['date_edition']);
       $tbs->MergeField('libelle',$data['libelle']);
       $tbs->MergeField('lieu',$data['lieu']);
       $tbs->MergeField('imputation',$data['imputation']);
       $tbs->MergeField('suivi_par',$data['suivi_par']);
       $tbs->MergeField('date_formation',$data['date_formation']);
       $tbs->MergeField('heure_formation',$data['date_formation']);
       $tbs->MergeField('ref',$data['ref']);
       $tbs->Show(OPENTBS_DOWNLOAD, 'document.docx');
    }

    public function stagiaireToArray($form,$data)
    {
      $res=array();
      $i=0;
      foreach ($data as $entity){
        array_push($res, array(
          "nom" => $entity->getNom(),
          "fonction" => $entity->getFonction(),
          "titre" => $entity->getTitre(),
          "case" =>  $this->setCheckCase($form,$i),
          "agence" => array(
            "rsociale" => $entity->getAgence()->getRsociale(),
            "num_voie" => $entity->getAgence()->getNumVoie(),
            "code" => $entity->getAgence()->getCodeDepartement(),
            "ville" => $entity->getAgence()->getCommune(),
          ),
          "siege" => array( //TODO: null -> $entity->getAgence()->getSiege()
            "correspondant" => $entity->getAgence()->getSiege()->getCorrespondant(),
            "rsociale" => $entity->getAgence()->getSiege()->getRsociale(),
            "num_voie" => $entity->getAgence()->getSiege()->getNumVoie(),
            "code" => $entity->getAgence()->getSiege()->getCodeDepartement(),
            "ville" => $entity->getAgence()->getSiege()->getCommune(),
          )
        ));
        $i++;
      }
      return $res;
    }

    /**
    * Fonction qui convertit les valeurs des "select" du formulaires
    * en case cochée ou non dans le document
    * en retournant un tableau
    */
    public function setCheckCase($form,$i)
    {
      // récupère la valeur du champ (de type case a cocher) transport du formulaire
      $transport=$form['stagiaires'][$i]['remboursement']->getData();
      $check_case = array();
      //on associe la valeur à la bonne case du formulaire
      if ($transport == 0){
        $check_case['transport'] = "☑";
        $check_case['vehicule'] = "☐";
      }
      else if ($transport == 1){
        $check_case['transport'] = "☐";
        $check_case['vehicule'] = "☑";
      }

      // récupère la valeur du champ (de type case a cocher) restauration du formulaire
      // selon sa valeur on coche la case correspondante
      $restauration=$form['stagiaires'][$i]['restauration']->getData();
      if ($restauration == 0){
        $check_case['pris_en_charge'] = "☑";
        $check_case['a_rembourser'] = "☐";
        $check_case['pas_de_remboursement'] = "☐";
      }
      else if ($restauration == 1){
        $check_case['pris_en_charge'] = "☐";
        $check_case['a_rembourser'] = "☑";
        $check_case['pas_de_remboursement'] = "☐";
      }
      else if ($restauration == 2){
        $check_case['pris_en_charge'] = "☐";
        $check_case['a_rembourser'] = "☐";
        $check_case['pas_de_remboursement'] = "☑";
      }
      //recupere le champ remboursement et l'insere tel quel dans le tableau (type string)
      $remboursement=$form['stagiaires'][$i]['remboursement']->getData();
      $check_case['string'] = $remboursement;
    return $check_case;
    }

    /**
    * prend en argument une date au format datetime et retourne une string du type dd mmmm yyyy (exemple 01 janvier 2018)
    **/
    public function dateToString($date) //TODO: a ameliorer
    {
      setlocale (LC_TIME, 'fr_FR.utf8','fra');
      $date = date("%d %B %Y",$date->getTimeStamp());
      return $date;
    }

    /**
    * prend en argument une heure au format datetime et retourne une string du type HHhMM (exemple 15h12)
    **/
    public function timeToString($date)
    {
      setlocale (LC_TIME, 'fr_FR.utf8','fra');
      $date = strftime("%Hh%M",$date->getTimeStamp());
      return $date;
    }
}
