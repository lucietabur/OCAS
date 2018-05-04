<?php

namespace OCAS\OCASBundle\Repository;
use Symfony\Component\Validator\Constraints\DateTime;
/**
 * Detail_formationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class Detail_sessionRepository extends \Doctrine\ORM\EntityRepository
{

  /**
  * Compte le nombre de présents a une session
  * une personne est considérée présente si son nombre d'h de présence est >0
  **/
  public function countPresentSession($session)
  {
    $query = $this->_em->createQuery('SELECT COUNT(d) FROM OCASBundle:Detail_session d  WHERE d.session=:session AND d.hPresent>0')
    ->setParameter("session", $session);
    $results = $query->getResult();
    //TODO: verifier que ca marche
    return $results;
  }

  /**
  * Compte le nombre d'inscrits a une session
  * une personne est considérée présente si son nombre d'h de présence est >0
  **/
  public function countInscritSession($session)
  {
    $query = $this->_em->createQuery('SELECT COUNT(d) FROM OCASBundle:Detail_session d  WHERE d.session=:session')
    ->setParameter("session", $session);
    $results = $query->getResult();
    //TODO: verifier que ca marche
    return $results;
  }

  /**
  * Retourne les stagiaires inscrits a une session
  * une personne est considérée présente si son nombre d'h de présence est >0
  **/
  public function getInscritSession($session)
  {
    $query = $this->_em->createQuery('SELECT s.id, s.nom, d.typeFormation, d.hPresent, d.hAbsent, d.hFacture
      FROM OCASBundle:Detail_session d LEFT JOIN OCASBundle:Stagiaire s
      WHERE d.session=:session AND d.stagiaire=s')
    ->setParameter("session", $session);
    $results = $query->getResult();
    //TODO: verifier que ca marche
    return $results;
  }




/**
* renvoie les sessions dont il faut rentrer la liste des absents
* c'est à dire une session dont la date de retour est supérieure à la date du jour
* et dont le nombre de présent est NULL
**/
public function retourSession()
{
  $datejour = new \DateTime();
  $datejour->setTime(00,00);
  var_dump($datejour);
  $query = $this->_em->createQuery("SELECT s FROM OCASBundle:Session s  WHERE s.dateRetour >= :datejour ")
  ->setParameter("datejour", $datejour);
  $results = $query->getResult();
  //TODO: verifier que ca marche
  return $results;
}
}
