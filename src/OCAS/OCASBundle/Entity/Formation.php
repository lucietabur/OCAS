<?php

namespace OCAS\OCASBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Formation
 *
 * @ORM\Table(name="formation")
 * @ORM\Entity(repositoryClass="OCAS\OCASBundle\Repository\FormationRepository")
 */
class Formation
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
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255, nullable=true) //TODO
     */
    private $libelle;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="datetime", nullable=true)
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="datetime", nullable=true)
     */
    private $dateFin;

    /**
     * @var string
     *
     * @ORM\Column(name="observation", type="string", length=255, nullable=true)
     */
    private $observation;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=255, nullable=true)
     */
    private $lieu;

    /**
    * @ORM\OneToMany(targetEntity="OCAS\OCASBundle\Entity\Feuille_emargement", mappedBy="formation")
    * @ORM\JoinColumn(nullable=false)
    */
    private $feuille_emargement;

    /**
    * @ORM\ManyToOne(targetEntity="OCAS\OCASBundle\Entity\Libelle_Formation")
    */
    private $libelle_formation;

    /**@ORM\OneToMany(targetEntity="detail_formation", mappedBy="formation", cascade={"persist", "merge"})
    */
    private $detail_formation;

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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Formation
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle.' - '.$this->dateDebut->format('d-m');
        //TODO: a voir dans quel cas
    }


    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return Formation
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return Formation
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set observation
     *
     * @param string $observation
     *
     * @return Formation
     */
    public function setObservation($observation)
    {
        $this->observation = $observation;

        return $this;
    }

    /**
     * Get observation
     *
     * @return string
     */
    public function getObservation()
    {
        return $this->observation;
    }

    /**
     * Set lieu
     *
     * @param \OCAS\OCASBundle\Entity\Agence $lieu
     *
     * @return Formation
     */
    public function setLieu(\OCAS\OCASBundle\Entity\Agence $lieu = null)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return \OCAS\OCASBundle\Entity\Agence
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set feuilleEmargement
     *
     * @param \OCAS\OCASBundle\Entity\Feuille_emargement $feuilleEmargement
     *
     * @return Formation
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
     * Constructor
     */
    public function __construct()
    {
        $this->feuille_emargement = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add feuilleEmargement
     *
     * @param \OCAS\OCASBundle\Entity\Feuille_emargement $feuilleEmargement
     *
     * @return Formation
     */
    public function addFeuilleEmargement(\OCAS\OCASBundle\Entity\Feuille_emargement $feuilleEmargement)
    {
        $this->feuille_emargement[] = $feuilleEmargement;

        return $this;
    }

    /**
     * Remove feuilleEmargement
     *
     * @param \OCAS\OCASBundle\Entity\Feuille_emargement $feuilleEmargement
     */
    public function removeFeuilleEmargement(\OCAS\OCASBundle\Entity\Feuille_emargement $feuilleEmargement)
    {
        $this->feuille_emargement->removeElement($feuilleEmargement);
    }

    /**
     * Set libelle_formation
     *
     * @param \OCAS\OCASBundle\Entity\Libelle_Formation $libelle_formation
     *
     * @return Formation
     */
    public function setLibelleFormation(\OCAS\OCASBundle\Entity\Libelle_Formation $libelle_formation = null)
    {
        $this->libelle_formation = $libelle_formation;

        return $this;
    }

    /**
     * Get libelle_formation
     *
     * @return \OCAS\OCASBundle\Entity\libelle_formation
     */
    public function getLibelleformation()
    {
        return $this->libelle_formation;
    }
}
