<?php

namespace OCAS\OCASBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use OCAS\OCASBundle\Services\ArrayToString;

/**
 * Stagiaire
 *
 * @ORM\Table(name="stagiaire")
 * @ORM\Entity(repositoryClass="OCAS\OCASBundle\Repository\StagiaireRepository")
 */
class Stagiaire
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
     * @ORM\Column(name="nom", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $nom;

    /**
     * @var string
     * @ORM\Column(name="fonction", type="string", length=255, nullable=true)
     */
    private $fonction;

    /**
     * @var string
     * @ORM\Column(name="ville", type="string", length=255,nullable=true)
     */
    private $ville;

    /**
     * @var \DateTime
     * @ORM\Column(name="naissance", type="datetime", nullable=true)
     * @Assert\DateTime();
     */
    private $naissance;

    /**
     * @var string
     * @ORM\Column(name="titre", type="string", length=255, nullable=true)
     */
    private $titre;

    /**
     * @var string
     * @ORM\Column(name="nationalite", type="string", length=255, nullable=true)
     */
    private $nationalite;

    /**
     * @var int
     * @ORM\Column(name="quotite", type="integer",nullable=true)
     */
    private $quotite;

    /**
    * @ORM\ManyToOne(targetEntity="OCAS\OCASBundle\Entity\Statut")
    */
    private $statut;

    /**
    * @ORM\ManyToOne(targetEntity="OCAS\OCASBundle\Entity\Agence")
    */
    private $agence;

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
     * Set nom
     *
     * @param string $nom
     *
     * @return Stagiaire
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     * @ORM\PrePersist
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set fonction (convertit le tableau en texte)
     *
     * @param string $fonction
     *
     * @return Stagiaire
     */
    public function setFonction($fonction)
    {
        $arrayToString = new ArrayToString();
        $this->fonction = $arrayToString->arrayToString($fonction);
        return $this;
    }

    /**
     * Get fonction
     *
     * @return string
     */
    public function getFonction()
    {
        $arrayToString = new ArrayToString();
        $this->fonction = $arrayToString->stringToArray($this->fonction);
        return $this->fonction;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Stagiaire
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set naissance
     *
     * @param \DateTime $naissance
     *
     * @return Stagiaire
     */
    public function setNaissance($naissance)
    {
        $this->naissance = $naissance;

        return $this;
    }

    /**
     * Get naissance
     *
     * @return \DateTime
     */
    public function getNaissance()
    {
        return $this->naissance;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Stagiaire
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set nationalite
     *
     * @param string $nationalite
     *
     * @return Stagiaire
     */
    public function setNationalite($nationalite)
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    /**
     * Get nationalite
     *
     * @return string
     */
    public function getNationalite()
    {
        return $this->nationalite;
    }

    /**
     * Set quotite
     *
     * @param integer $quotite
     *
     * @return Stagiaire
     */
    public function setQuotite($quotite)
    {
        $this->quotite = $quotite;

        return $this;
    }

    /**
     * Get quotite
     *
     * @return int
     */
    public function getQuotite()
    {
        return $this->quotite;
    }

    /**
     * Set statut
     *
     * @param \OCAS\OCASBundle\Entity\Statut $statut
     *
     * @return Stagiaire
     */
    public function setStatut(\OCAS\OCASBundle\Entity\Statut $statut = null)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return \OCAS\OCASBundle\Entity\Statut
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set agence
     *
     * @param \OCAS\OCASBundle\Entity\Agence $agence
     *
     * @return Formation
     */
    public function setAgence(\OCAS\OCASBundle\Entity\Agence $agence = null)
    {
        $this->agence = $agence;

        return $this;
    }

    /**
     * Get agence
     *
     * @return \OCAS\OCASBundle\Entity\Agence
     */
    public function getAgence()
    {
        return $this->agence;
    }
}
