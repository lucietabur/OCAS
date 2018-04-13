<?php

namespace OCAS\OCASBundle\Services;

class Menu
{
    /**
    *Définit le contenu du menu et le retourne
    *
    */
    public function getMenu()
    {
        $menu = array(
      'Accueil' => 'home',
      'Stagiaires' => 'stagiaire_list',
       'Résidences administratives' => 'agence_list',
       'Sièges' => 'siege_list',
       'Formations' => 'formation_list',
       'Intervenants' => 'intervenant_list',
       'Sessions' => 'session_list',
    );
        return $menu;
    }
}
