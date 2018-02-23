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
     * @var string
     *
     * @ORM\Column(name="groupe", type="string", length=255, nullable=true)
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
     * @ORM\Column(name="horaire", type="datetime", nullable=true)
     */
    private $horaire;

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
    * @ORM\ManyToOne(targetEntity="OCAS\OCASBundle\Entity\Formateur", inversedBy="feuille_emargement")
    */
    private $formateur;

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
     * Set horaire
     *
     * @param \DateTime $horaire
     *
     * @return Feuille_emargement
     */
    public function setHoraire($horaire)
    {
        $this->horaire = $horaire;

        return $this;
    }

    /**
     * Get horaire
     *
     * @return \DateTime
     */
    public function getHoraire()
    {
        return $this->horaire;
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
        $this->formateur = new \Doctrine\Common\Collections\ArrayCollection();
        $this->formation = new \Doctrine\Common\Collections\ArrayCollection();
        $this->detail_emargement = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add formateur
     *
     * @param \OCAS\OCASBundle\Entity\Formateur $formateur
     *
     * @return Feuille_emargement
     */
    public function addFormateur(\OCAS\OCASBundle\Entity\Formateur $formateur)
    {
        $this->formateur[] = $formateur;

        return $this;
    }

    /**
     * Remove formateur
     *
     * @param \OCAS\OCASBundle\Entity\Formateur $formateur
     */
    public function removeFormateur(\OCAS\OCASBundle\Entity\Formateur $formateur)
    {
        $this->formateur->removeElement($formateur);
    }

    /**
     * Get formateur
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFormateur()
    {
        return $this->formateur;
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
    public function addDetailEmargement(\OCAS\OCASBundle\Entity\Formation $detailEmargement)
    {
        $this->detail_emargement[] = $detailEmargement;

        return $this;
    }

    /**
     * Remove detailEmargement
     *
     * @param \OCAS\OCASBundle\Entity\Formation $detailEmargement
     */
    public function removeDetailEmargement(\OCAS\OCASBundle\Entity\Formation $detailEmargement)
    {
        $this->detail_emargement->removeElement($detailEmargement);
    }

    /**
     * Get detailEmargement
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDetailEmargement()
    {
        return $this->detail_emargement;
    }

    /**
     * Set formateur
     *
     * @param \OCAS\OCASBundle\Entity\Formateur $formateur
     *
     * @return Feuille_emargement
     */
    public function setFormateur(\OCAS\OCASBundle\Entity\Formateur $formateur = null)
    {
        $this->formateur = $formateur;

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
}
