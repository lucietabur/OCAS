<?php

namespace OCAS\OCASBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Detail_formation
 *
 * @ORM\Table(name="detail_formation")
 * @ORM\Entity(repositoryClass="OCAS\OCASBundle\Repository\Detail_formationRepository")
 */
class Detail_formation
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
    * @ORM\ManyToOne(targetEntity="OCAS\OCASBundle\Entity\Formation", inversedBy="details_formation")
    * @ORM\JoinColumn(name="formation_id", referencedColumnName="id",nullable=false)
    */
    private $formation;

    /**
    * @ORM\ManyToOne(targetEntity="OCAS\OCASBundle\Entity\Stagiaire", inversedBy="detail_formation")
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
     * @return Detail_formation
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
     * @return Detail_formation
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
     * @return Detail_formation
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
     * @return Detail_formation
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
     * @return Detail_formation
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
     * @return Detail_formation
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
     * @return Detail_formation
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
}
