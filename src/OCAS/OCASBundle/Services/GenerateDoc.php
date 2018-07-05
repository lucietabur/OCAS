<?php

namespace OCAS\OCASBundle\Services;

class GenerateDoc
{

    /**
    * génère l'ordre de MissionType
    */
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

    /**
    * génère la feuille d'émargement
    */
    public function generateFeuilleDoc($session,$libelle,$stagiaires,$tbs)
    {
      $session = $this->sessionToArray($session,$stagiaires);
      $data = $this->nomStagiaireToArray($stagiaires);
       // generer le fichier
       setlocale (LC_TIME, 'fr_FR.utf8','fra');
      $tbs->LoadTemplate('/var/www/html/project/fichiers generes/Emargement PAFOC.docx', OPENTBS_ALREADY_UTF8);
       $tbs->MergeField('libelle',$libelle[0]['libelle']);
       $tbs->Assigned['expl_2'] = array('b_auto', $data);
       $tbs->MergeBlock('expl_2', 'assigned');
       $tbs->MergeBlock('tbs',$session);
       $tbs->Show(OPENTBS_DOWNLOAD, 'document.docx');
    }

    /**
    * retourne un tableau de sessions formaté pour la feuille d'emargement'
    */
    public function sessionToArray($session,$stagiaires)
    {
      $res=array();

      // $interval = $session->getDateDebut()->diff($session->getDateFin());
      for ($i=1; $i <= 3; $i++) {
        // $date_formation=date_add($session->getDateDebut(),date_interval_create_from_date_string('+'.$i.' days'));
        array_push($res,array(
                  "intervenants" => $session->getIntervenants()[0]->getNom(),
                  "num_emargement" => $session->getNumEmargement(),
                  "date_formation" => $session->getDateDebut(),
                  "heure_debut" => $session->getDateDebut(),
                  "date_debut" => $session->getDateDebut(),
                  // "date_fin" =>  $session->getDateFin(),
                  "duree" =>  $session->getDuree(),
                  "stagiaires" => $this->nomStagiaireToArray($stagiaires),
                  "date_edition" => new \DateTime('today'),
                ));
      }
      return $res;
    }

    /**
    * retourne un tableau de stagiaires formaté pour la feuille de mission
    */
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
    * retourne un tableau d'intervenants formaté pour la feuille d'émargement
    */
    public function intervenantToArray($session)
    {
      $res='';
      $intervenants=$session->getIntervenants()->toArray();
      for ($i=0; $i < sizeof($intervenants); $i++) {
        $res+=$session->getIntervenants()[$i]->getNom();
      }
      dump($res);exit;
      // foreach ($session->getIntervenants() as $entity){
      //   $res+=', '+$entity->getNom();
      // }
      return $res;
    }

    /**
    * retourne un tableau de stagiaires formaté pour la feuille d'émargement
    */
    public function nomStagiaireToArray($stagiaires){
      $res = array();
      foreach ($stagiaires as $stagiaire) {
        $res[] = array('nom' => $stagiaire->getNom());
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




    //TODO : inutile ?
    /**
    * prend en argument une date au format datetime et retourne une string du type dd mmmm yyyy (exemple 01 janvier 2018)
    **/
    public function dateToString($date)
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
      if ($date != null){
        setlocale (LC_TIME, 'fr_FR.utf8','fra');
        $date = strftime("%Hh%M",$date->getTimeStamp());
        return $date;
      }
    }
}
