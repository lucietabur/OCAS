<?php

namespace OCAS\OCASBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use OCAS\OCASBundle\Services\Validator\Constraints as SessionAssert;
/**
 * Session
 *
 * @ORM\Table(name="session")
 * @ORM\Entity(repositoryClass="OCAS\OCASBundle\Repository\SessionRepository")
 * @UniqueEntity(
 *    fields={"libelle_formation","dateDebut","groupe"},
 *    errorPath="groupe",
 *    message="Ce groupe existe déjà pour cette session"
 *    )
 */
class Session
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
     * @ORM\Column(name="num_emargement", type="integer", unique=false, nullable=true)
     */
    private $numEmargement;

    /**
     * @var \DateTime
     * @Assert\Date()
     * @SessionAssert\ThisYear
     * @ORM\Column(name="date_debut", type="datetime", nullable=true)
     */
    private $dateDebut;

    /**
     * @var \DateTime
     * @Assert\Date()
     * @Assert\GreaterThan(propertyPath="date_debut")
     * @ORM\Column(name="date_fin", type="datetime", nullable=true)
     */
    private $dateFin;

    /**
     * @var int
     *
     * @ORM\Column(name="groupe", type="integer", nullable=true)
     */
    private $groupe;

    /**
     * @var \DateTime
     * @Assert\Time()
     * @ORM\Column(name="duree", type="time", nullable=true)
     */
    private $duree;

    /**
     * @var \DateTime
     * @Assert\Date()
     * @Assert\GreaterThan(propertyPath="date_fin")
     * @ORM\Column(name="date_retour", type="datetime", nullable=true)
     */
    private $dateRetour;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=255,nullable=true)
     */
    private $lieu;

    /**
     * @var string
     *
     * @ORM\Column(name="observation", type="string", length=255,nullable=true)
     */
    private $observation;

    /**
    * @var boolean
    *
    * @ORM\Column(name="feuille_edite", type="boolean", options={"default":false})
    */
    private $feuille_edite = false;

    /**
    * @var boolean
    *
    * @ORM\Column(name="mission_edite", type="boolean", options={"default":false})
    */
    private $mission_edite = false;

    /**

     * Owning Side
     *
     * @ORM\ManyToMany(targetEntity="Intervenant", inversedBy="session")
     * @ORM\JoinTable(name="session_intervenant",
     *  joinColumns={@ORM\JoinColumn(name="session_id", referencedColumnName="id", onDelete="CASCADE")},
     *  inverseJoinColumns={@ORM\JoinColumn(name="intervenant_id", referencedColumnName="id", onDelete="CASCADE")}
     * )
     */
    private $intervenants;


    /**
    * @ORM\ManyToOne(targetEntity="OCAS\OCASBundle\Entity\Libelle_Formation")
    * @ORM\JoinColumn(onDelete="SET NULL")
    */
    private $libelle_formation;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->intervenants = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set numEmargement
     *
     * @param integer $numEmargement
     *
     * @return Session
     */
    public function setNumEmargement($numEmargement)
    {
        $this->numEmargement = $numEmargement;

        return $this;
    }

    /**
     * Get numEmargement
     *
     * @return integer
     */
    public function getNumEmargement()
    {
        return $this->numEmargement;
    }


    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return Session
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
     * @return Session
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
     * Set groupe
     *
     * @param integer $groupe
     *
     * @return Session
     */
    public function setGroupe($groupe)
    {
        $this->groupe = $groupe;

        return $this;
    }

    /**
     * Get groupe
     *
     * @return integer
     */
    public function getGroupe()
    {
        return $this->groupe;
    }

    /**
     * Set duree
     *
     * @param integer $duree
     *
     * @return Session
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree
     *
     * @return integer
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set dateRetour
     *
     * @param \DateTime $dateRetour
     *
     * @return Session
     */
    public function setDateRetour($dateRetour)
    {
        $this->dateRetour = $dateRetour;

        return $this;
    }

    /**
     * Get dateRetour
     *
     * @return \DateTime
     */
    public function getDateRetour()
    {
        return $this->dateRetour;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     *
     * @return Session
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set observation
     *
     * @param string $observation
     *
     * @return Session
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
     * Add intervenant
     *
     * @param \OCAS\OCASBundle\Entity\Intervenant $intervenant
     *
     * @return Session
     */
    public function addIntervenant(\OCAS\OCASBundle\Entity\Intervenant $intervenant)
    {
        $this->intervenants[] = $intervenant;

        return $this;
    }

    /**
     * Remove intervenant
     *
     * @param \OCAS\OCASBundle\Entity\Intervenant $intervenant
     */
    public function removeIntervenant(\OCAS\OCASBundle\Entity\Intervenant $intervenant)
    {
        $this->intervenants->removeElement($intervenant);
    }

    /**
     * Get intervenants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIntervenants()
    {
        return $this->intervenants;
    }

    /**
     * Set libelleFormation
     *
     * @param \OCAS\OCASBundle\Entity\Libelle_Formation $libelleFormation
     *
     * @return Session
     */
    public function setLibelleFormation(\OCAS\OCASBundle\Entity\Libelle_Formation $libelleFormation = null)
    {
        $this->libelle_formation = $libelleFormation;

        return $this;
    }

    /**
     * Get libelleFormation
     *
     * @return \OCAS\OCASBundle\Entity\Libelle_Formation
     */
    public function getLibelleFormation()
    {
        return $this->libelle_formation;
    }

    /**
     * Set feuilleEdite
     *
     * @param boolean $feuilleEdite
     *
     * @return Session
     */
    public function setFeuilleEdite($feuilleEdite)
    {
        $this->feuille_edite = $feuilleEdite;

        return $this;
    }

    /**
     * Get feuilleEdite
     *
     * @return boolean
     */
    public function getFeuilleEdite()
    {
        return $this->feuille_edite;
    }

    /**
     * Set missionEdite
     *
     * @param boolean $missionEdite
     *
     * @return Session
     */
    public function setMissionEdite($missionEdite)
    {
        $this->mission_edite = $missionEdite;

        return $this;
    }

    /**
     * Get missionEdite
     *
     * @return boolean
     */
    public function getMissionEdite()
    {
        return $this->mission_edite;
    }
}
