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
     *
     * Inverse Side
     *
     * @ORM\ManyToMany(targetEntity="feuille_emargement", mappedBy="intervenants", cascade={"persist", "merge"})
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

    public function setFeuille_emargements($items)
    {
        if ($items instanceof ArrayCollection || is_array($items)) {
            foreach ($items as $item) {
                $this->addFeuille_emargement($item);
            }
        } elseif ($items instanceof Feuille_emargement) {
            $this->addFeuille_emargement($items);
        } else {
            throw new Exception("$items must be an instance of Feuille_emargement or ArrayCollection");
        }
    }

    /**
     * Get ArrayCollection
     *
     * @return ArrayCollection $feuille_emargements
     */
    public function getFeuille_emargements()
    {
        return $this->feuille_emargements;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->feuille_emargements = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add Feuille_emargement
     *
     * @param Feuille_emargement $feuille_emargement
     */
    public function addFeuille_emargement(Feuille_emargement $feuille_emargement)
    {
        // Si l'objet fait déjà partie de la collection on ne l'ajoute pas
        if (!$this->feuille_emargements->contains($feuille_emargement)) {
            if (!$feuille_emargement->getProduits()->contains($this)) {
                $feuille_emargement->addProduit($this);  // Lie le Feuille_emargement au produit.
            }
            $this->feuille_emargements->add($feuille_emargement);
        }
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
