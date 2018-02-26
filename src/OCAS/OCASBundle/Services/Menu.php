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
      // 'Agence' => 'home',
      // 'Siege' => 'home',
      // 'Formation' => 'home',
       'Formateur' => 'formateur_list',
       'Feuille d\'émargement' => 'feuille_list',
    );
    return $menu;
  }


}
