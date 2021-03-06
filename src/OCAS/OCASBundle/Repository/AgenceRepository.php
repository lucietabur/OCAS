<?php

namespace OCAS\OCASBundle\Repository;

/**
 * AgenceRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AgenceRepository extends \Doctrine\ORM\EntityRepository
{

  /**
  * Retourne les agences dont le nom contient $req
  */
    public function findByName($req)
    {
        $query = $this->getEntityManager()
                      ->createQuery(
                          "
            SELECT p FROM OCASBundle:Agence p
            WHERE p.rsociale LIKE :key "
                      );
        $query->setParameter('key', '%'.$req.'%');
        return $query->getResult();
    }
}
