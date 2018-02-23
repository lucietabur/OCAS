<?php

namespace OCAS\OCASBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Detail_emargement
 *
 * @ORM\Table(name="detail_emargement")
 * @ORM\Entity(repositoryClass="OCAS\OCASBundle\Repository\Detail_emargementRepository")
 */
class Detail_emargement
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
     * @ORM\Column(name="type_formation", type="string", length=255, nullable=true)
     */
    private $typeFormation;

    /**
    * @ORM\ManyToOne(targetEntity="OCAS\OCASBundle\Entity\Feuille_emargement")
    * @ORM\JoinColumn(nullable=false)
    */
    private $feuille_emargement;

    /**
    * @ORM\ManyToOne(targetEntity="OCAS\OCASBundle\Entity\Stagiaire")
    * @ORM\JoinColumn(nullable=false)
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
     * @return Detail_emargement
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
     * @return Detail_emargement
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
     * @return Detail_emargement
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
     * @return Detail_emargement
     */
    public function setTypeFormation($typeFormation)
    {
        $this->typeFormation = $typeFormation;

        return $this;
    }

    /**
     * Get typeFormation
     *
     * @return string
     */
    public function getTypeFormation()
    {
        return $this->typeFormation;
    }

    /**
     * Set feuilleEmargement
     *
     * @param \OCAS\OCASBundle\Entity\Feuille_emargement $feuilleEmargement
     *
     * @return Detail_emargement
     */
    public function setFeuilleEmargement(\OCAS\OCASBundle\Entity\Feuille_emargement $feuilleEmargement)
    {
        $this->feuille_emargement = $feuilleEmargement;

        return $this;
    }

    /**
     * Get feuilleEmargement
     *
     * @return \OCAS\OCASBundle\Entity\Feuille_emargement
     */
    public function getFeuilleEmargement()
    {
        return $this->feuille_emargement;
    }

    /**
     * Set stagiaire
     *
     * @param \OCAS\OCASBundle\Entity\Stagiaire $stagiaire
     *
     * @return Detail_emargement
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
}
