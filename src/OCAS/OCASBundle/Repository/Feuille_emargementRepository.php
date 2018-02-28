<?php

namespace OCAS\OCASBundle\Repository;

/**
 * Feuille_emargementRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class Feuille_emargementRepository extends \Doctrine\ORM\EntityRepository
{
  /**
  * Compte toutes les feuilles d'emargement de l'annee en cours
  */
  public function nombreFeuilles()
  {
    annee = new date("Y");
    $builder = $this->createQueryBuilder('a');
    $builder->select('COUNT(a.id) AS nombre')
            ->where('a.date_debut LIKE "'.$annee.'%"')
            ->orderBy('a.date_debut');
    return $builder->getQuery()->getSingleScalarResult();
  }
}
