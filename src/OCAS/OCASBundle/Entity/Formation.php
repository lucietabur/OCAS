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
    * @ORM\OneToMany(targetEntity="OCAS\OCASBundle\Entity\Session", mappedBy="formation")
    * @ORM\JoinColumn(nullable=false)
    */
    private $session;

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
     * Set sessionEmargement
     *
     * @param \OCAS\OCASBundle\Entity\Session $sessionEmargement
     *
     * @return Formation
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
     * Constructor
     */
    public function __construct()
    {
        $this->session = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add sessionEmargement
     *
     * @param \OCAS\OCASBundle\Entity\Session $sessionEmargement
     *
     * @return Formation
     */
    public function addSessionEmargement(\OCAS\OCASBundle\Entity\Session $sessionEmargement)
    {
        $this->session[] = $sessionEmargement;

        return $this;
    }

    /**
     * Remove sessionEmargement
     *
     * @param \OCAS\OCASBundle\Entity\Session $sessionEmargement
     */
    public function removeSessionEmargement(\OCAS\OCASBundle\Entity\Session $sessionEmargement)
    {
        $this->session->removeElement($sessionEmargement);
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
