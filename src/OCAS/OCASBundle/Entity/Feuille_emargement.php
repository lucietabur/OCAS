<?php

namespace OCAS\OCASBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Feuille_emargement
 *
 * @ORM\Table(name="feuille_emargement")
 * @ORM\Entity(repositoryClass="OCAS\OCASBundle\Repository\Feuille_emargementRepository")
 */
class Feuille_emargement
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
     * @ORM\ManyToMany(targetEntity="Intervenant", inversedBy="feuille_emargement")
     * @ORM\JoinTable(name="feuille_emargement_intervenant",
     *  joinColumns={@ORM\JoinColumn(name="feuille_emargement_id", referencedColumnName="id")},
     *  inverseJoinColumns={@ORM\JoinColumn(name="intervenant_id", referencedColumnName="id")}
     * )
     */
    private $intervenants;

    //TODO
    /**
    * @ORM\ManyToOne(targetEntity="OCAS\OCASBundle\Entity\Formation", inversedBy="feuille_emargement")
    */
    private $formation;

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
     * @return Feuille_emargement
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
     * @return Feuille_emargement
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
     * @return Feuille_emargement
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
     * @return Feuille_emargement
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
     * @return Feuille_emargement
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
     * @return Feuille_emargement
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
     * @return Feuille_emargement
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
     * Add formation
     *
     * @param \OCAS\OCASBundle\Entity\Formation $formation
     *
     * @return Feuille_emargement
     */
    public function addFormation(\OCAS\OCASBundle\Entity\Formation $formation)
    {
        $this->formation[] = $formation;

        return $this;
    }

    /**
     * Remove formation
     *
     * @param \OCAS\OCASBundle\Entity\Formation $formation
     */
    public function removeFormation(\OCAS\OCASBundle\Entity\Formation $formation)
    {
        $this->formation->removeElement($formation);
    }

    /**
     * Get formation
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFormation()
    {
        return $this->formation;
    }

    /**
     * Add detailEmargement
     *
     * @param \OCAS\OCASBundle\Entity\Formation $detailEmargement
     *
     * @return Feuille_emargement
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
     * @return Feuille_emargement
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
     * @return Feuille_emargement
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
     * @return Feuille_emargement
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
}
