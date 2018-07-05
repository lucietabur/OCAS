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
          'liste'=>
            array(
              'liste des stagiaires' => 'stagiaire_list',
              'liste des sessions' => 'session_list',
              'liste des formations' => 'formation_list',
              'liste des résidences administratives' => 'agence_list',
              'liste des sièges' => 'siege_list',
              'liste des intervenants' => 'intervenant_list',
            ),
            'frequent'=>
              array(
                'Menu' => 'home',
                'voir les stagiaires' => 'stagiaire_list',
                'ajouter un libellé de formation' => 'formation_add',
                'ajouter une session' => 'session_add',
                'inscrire des stagiaires' => 'stagiaire_add',
                'voir les sessions du mois' => 'session_list',
                'retour des feuilles' => 'session_retour'
              ),
        );
        return $menu;
    }
}
