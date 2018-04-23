<?php

namespace OCAS\OCASBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Session
 *
 * @ORM\Table(name="session")
 * @ORM\Entity(repositoryClass="OCAS\OCASBundle\Repository\SessionRepository")
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
     * @ORM\Column(name="num_emargement", type="integer", unique=false, nullable=true) //TODO: rendre auto increment
     */
    private $numEmargement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_seance", type="datetime")
     */
    private $dateSeance;

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


    //TODO: 2 seances a la meme date et le meme libelle doivent avoir un numero de groupe different
    /**
     * @var int
     *
     * @ORM\Column(name="groupe", type="integer", nullable=true)
     */
    private $groupe;

    /**
     * @var int
     *
     * @ORM\Column(name="duree", type="integer", nullable=true)
     */
    private $duree;

    /**
     * @var \DateTime
     *
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
    * @ORM\Column(name="edite", type="boolean", options={"default":false})
    */
    private $edite = false;

    /**

     * Owning Side
     *
     * @ORM\ManyToMany(targetEntity="Intervenant", inversedBy="session")
     * @ORM\JoinTable(name="session_intervenant",
     *  joinColumns={@ORM\JoinColumn(name="session_id", referencedColumnName="id")},
     *  inverseJoinColumns={@ORM\JoinColumn(name="intervenant_id", referencedColumnName="id")}
     * )
     */
    private $intervenants;


    /**
    * @ORM\ManyToOne(targetEntity="OCAS\OCASBundle\Entity\Libelle_Formation")
    */
    private $libelle_formation;

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
     * @return int
     */
    public function getNumEmargement()
    {
        return $this->numEmargement;
    }

    /**
     * Set dateSeance
     *
     * @param \DateTime $dateSeance
     *
     * @return Session
     */
    public function setDateSeance($dateSeance)
    {
        $this->dateSeance = $dateSeance;

        return $this;
    }

    /**
     * Get dateSeance
     *
     * @return \DateTime
     */
    public function getDateSeance()
    {
        return $this->dateSeance;
    }

    /**
     * Set groupe
     *
     * @param string $groupe
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
     * @return string
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
     * @return int
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
     * Constructor
     */
    public function __construct()
    {
        $this->intervenants = new \Doctrine\Common\Collections\ArrayCollection();
        $this->formation = new \Doctrine\Common\Collections\ArrayCollection();
        $this->detail_formation = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add Intervenant
     *
     * @param Intervenant $intervenant
     */
    public function addIntervenant(Intervenant $intervenant)
    {
        // Si l'objet fait déjà partie de la collection on ne l'ajoute pas
        if (!$this->intervenants->contains($intervenant)) {
            $this->intervenants->add($intervenant);
        }
    }

    public function setIntervenants($items)
    {
        if ($items instanceof ArrayCollection || is_array($items)) {
            foreach ($items as $item) {
                $this->addIntervenant($item);
            }
        } elseif ($items instanceof Intervenant) {
            $this->addIntervenant($items);
        } else {
            throw new Exception("$items must be an instance of Intervenant or ArrayCollection");
        }
    }

    /**
     * Get ArrayCollection
     *
     * @return ArrayCollection $intervenants
     */
    public function getIntervenants()
    {
        return $this->intervenants;
    }





    /**
     * Add detailEmargement
     *
     * @param \OCAS\OCASBundle\Entity\Formation $detailEmargement
     *
     * @return Session
     */
    public function addDetailFormation(\OCAS\OCASBundle\Entity\Formation $detailEmargement)
    {
        $this->detail_formation[] = $detailEmargement;

        return $this;
    }

    /**
     * Remove detailEmargement
     *
     * @param \OCAS\OCASBundle\Entity\Formation $detailEmargement
     */
    public function removeDetailFormation(\OCAS\OCASBundle\Entity\Formation $detailEmargement)
    {
        $this->detail_formation->removeElement($detailEmargement);
    }

    /**
     * Get detailEmargement
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDetailFormation()
    {
        return $this->detail_formation;
    }

    /**
     * Set intervenant
     *
     * @param \OCAS\OCASBundle\Entity\Intervenant $intervenant
     *
     * @return Session
     */
    public function setIntervenant(\OCAS\OCASBundle\Entity\Intervenant $intervenant = null)
    {
        $this->intervenant = $intervenant;

        return $this;
    }

    /**
     * Set formation
     *
     * @param \OCAS\OCASBundle\Entity\Formation $formation
     *
     * @return Session
     */
    public function setFormation(\OCAS\OCASBundle\Entity\Formation $formation = null)
    {
        $this->formation = $formation;

        return $this;
    }

    /**
     * Set retour
     *
     * @param boolean $retour
     *
     * @return Session
     */
    public function setRetour($retour)
    {
        $this->retour = $retour;

        return $this;
    }

    /**
     * Get retour
     *
     * @return boolean
     */
    public function getRetour()
    {
        return $this->retour;
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
     * Set edite
     *
     * @param boolean $edite
     *
     * @return Session
     */
    public function setEdite($edite)
    {
        $this->edite = $edite;

        return $this;
    }

    /**
     * Get edite
     *
     * @return boolean
     */
    public function getEdite()
    {
        return $this->edite;
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
}
