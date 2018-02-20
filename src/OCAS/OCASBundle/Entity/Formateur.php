<?php

namespace OCAS\OCASBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Formateur
 *
 * @ORM\Table(name="formateur")
 * @ORM\Entity(repositoryClass="OCAS\OCASBundle\Repository\FormateurRepository")
 */
class Formateur
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
    * @ORM\OneToMany(targetEntity="OCAS\OCASBundle\Entity\Feuille_emargement", mappedBy="formateur")
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
     * @return Formateur
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
     * Set feuilleEmargement
     *
     * @param \OCAS\OCASBundle\Entity\Feuille_emargement $feuilleEmargement
     *
     * @return Formateur
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
}
