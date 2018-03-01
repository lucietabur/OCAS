<?php

namespace OCAS\OCASBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Intervenant
 *
 * @ORM\Table(name="intervenant")
 * @ORM\Entity(repositoryClass="OCAS\OCASBundle\Repository\IntervenantRepository")
 */
class Intervenant
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
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
    * @ORM\ManyToMany(targetEntity="OCAS\OCASBundle\Entity\Feuille_emargement", mappedBy="intervenant")
    * @ORM\JoinColumn(nullable=false)
    */
    private $feuille_emargement;

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
     * @return Intervenant
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Intervenant
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set feuilleEmargement
     *
     * @param \OCAS\OCASBundle\Entity\Feuille_emargement $feuilleEmargement
     *
     * @return Intervenant
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
     * @return Intervenant
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
}
