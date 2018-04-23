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
            ),
            'frequent'=>
              array(
                'Menu' => 'home',
                'inscrire des stagiaires' => 'stagiaire_add',
                'ajouter une session de formation' => 'session_add',
                'voir les sessions du mois' => 'session_list',
                'retour des feuilles d\'émargement' => 'session_retour'
              ),
            'rare' => array(
               'Résidences administratives' => 'agence_list',
               'Sièges' => 'siege_list',
               'Intervenants' => 'intervenant_list',
            )
        );
        return $menu;
    }
}
