<?php

namespace OCAS\OCASBundle\Services;

class Menu
{
    /**
    *Définie le contenu du menu et le retourne
    *
    */
    public function getMenu()
    {
        $menu = array(
      'Accueil' => 'home',
      'Stagiaires' => 'stagiaire_list',
       'Agence' => 'agence_list',
       'Siege' => 'siege_list',
       'Formation' => 'formation_list',
       'Intervenant' => 'intervenant_list',
       'Feuille d\'émargement' => 'feuille_list',
    );
        return $menu;
    }
}
