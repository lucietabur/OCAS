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
      // 'Formateur' => 'home',
      // 'Feuille d\'émargement' => 'home',
    );
    return $menu;
  }


}
