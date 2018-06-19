<?php

namespace OCAS\OCASBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use OCAS\OCASBundle\Services\ArrayToString;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Detail_session
 *
 * @ORM\Table(name="detail_session")
 * @ORM\Entity(repositoryClass="OCAS\OCASBundle\Repository\Detail_sessionRepository")
 * @UniqueEntity(
 *    fields={"stagiaire_id","session_id"},
 *    message="Ce·tte stagiaire a déjà été ajouté·e à cette sesssion"
 *    )
 */
class Detail_session
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="h_present", type="integer", nullable=true)
     */
    private $hPresent;

    /**
     * @var int
     *
     * @ORM\Column(name="h_absent", type="integer", nullable=true)
     */
    private $hAbsent;

    /**
     * @var int
     *
     * @ORM\Column(name="h_facture", type="integer", nullable=true)
     */
    private $hFacture;

    /**
     * @var string
     *
     * @ORM\Column(name="motif_absence", type="string", length=255, nullable=true)
     */
    private $motif_absence;

    /**
    * @ORM\ManyToOne(targetEntity="OCAS\OCASBundle\Entity\Session", inversedBy="details_session")
    * @ORM\JoinColumn(name="session_id", referencedColumnName="id",nullable=false)
    */
    private $session;

    /**
    * @ORM\ManyToOne(targetEntity="OCAS\OCASBundle\Entity\Stagiaire", inversedBy="detail_session")
    * @ORM\JoinColumn(name="stagiaire_id", referencedColumnName="id", nullable=false)
    */
    private $stagiaire;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set hPresent
     *
     * @param integer $hPresent
     *
     * @return Detail_session
     */
    public function setHPresent($hPresent)
    {
        $this->hPresent = $hPresent;

        return $this;
    }

    /**
     * Get hPresent
     *
     * @return int
     */
    public function getHPresent()
    {
        return $this->hPresent;
    }

    /**
     * Set hAbsent
     *
     * @param integer $hAbsent
     *
     * @return Detail_session
     */
    public function setHAbsent($hAbsent)
    {
        $this->hAbsent = $hAbsent;

        return $this;
    }

    /**
     * Get hAbsent
     *
     * @return int
     */
    public function getHAbsent()
    {
        return $this->hAbsent;
    }

    /**
     * Set hFacture
     *
     * @param integer $hFacture
     *
     * @return Detail_session
     */
    public function setHFacture($hFacture)
    {
        $this->hFacture = $hFacture;

        return $this;
    }

    /**
     * Get hFacture
     *
     * @return int
     */
    public function getHFacture()
    {
        return $this->hFacture;
    }

    /**
     * Set typeFormation
     *
     * @param string $typeFormation
     *
     * @return Detail_session
     */
    public function setTypeFormation($typeFormation)
    {
      $arrayToString = new ArrayToString();
      $this->typeFormation = $arrayToString->typeArrayOrString($typeFormation);
      return $this;
    }

    /**
     * Get typeFormation
     *
     * @return string
     */
    public function getTypeFormation()
    {
      $arrayToString = new ArrayToString();
      $this->typeFormation = $arrayToString->typeArrayOrString($this->typeFormation);
      return $this->typeFormation;
    }

    /**
     * Set sessionEmargement
     *
     * @param \OCAS\OCASBundle\Entity\Session $sessionEmargement
     *
     * @return Detail_session
     */
    public function setSessionEmargement(\OCAS\OCASBundle\Entity\Session $sessionEmargement)
    {
        $this->session = $sessionEmargement;

        return $this;
    }

    /**
     * Get sessionEmargement
     *
     * @return \OCAS\OCASBundle\Entity\Session
     */
    public function getSessionEmargement()
    {
        return $this->session;
    }

    /**
     * Set stagiaire
     *
     * @param \OCAS\OCASBundle\Entity\Stagiaire $stagiaire
     *
     * @return Detail_session
     */
    public function setStagiaire(\OCAS\OCASBundle\Entity\Stagiaire $stagiaire)
    {
        $this->stagiaire = $stagiaire;

        return $this;
    }

    /**
     * Get stagiaire
     *
     * @return \OCAS\OCASBundle\Entity\Stagiaire
     */
    public function getStagiaire()
    {
        return $this->stagiaire;
    }

    /**
     * Set formation
     *
     * @param \OCAS\OCASBundle\Entity\Formation $formation
     *
     * @return Detail_session
     */
    public function setFormation(\OCAS\OCASBundle\Entity\Formation $formation)
    {
        $this->formation = $formation;

        return $this;
    }

    /**
     * Get formation
     *
     * @return \OCAS\OCASBundle\Entity\Formation
     */
    public function getFormation()
    {
        return $this->formation;
    }

    /**
     * Set session
     *
     * @param \OCAS\OCASBundle\Entity\Session $session
     *
     * @return Detail_session
     */
    public function setSession(\OCAS\OCASBundle\Entity\Session $session)
    {
        $this->session = $session;

        return $this;
    }

    /**
     * Get session
     *
     * @return \OCAS\OCASBundle\Entity\Session
     */
    public function getSession()
    {
        return $this->session;
    }
}
