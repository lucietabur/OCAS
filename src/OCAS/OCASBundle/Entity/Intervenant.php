<?php

namespace OCAS\OCASBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Intervenant
 *
 * @ORM\Table(name="intervenant")
 * @ORM\Entity(repositoryClass="OCAS\OCASBundle\Repository\IntervenantRepository")
 * @UniqueEntity("nom", message="Cet·te intervenant·e a déjà été créé·e")
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
     * @ORM\Column(name="adresse", type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     *
     * Inverse Side
     *
     * @ORM\ManyToMany(targetEntity="Session", mappedBy="intervenants", cascade={"persist", "merge"})
     */
    private $session;

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

    public function setSessions($items)
    {
        if ($items instanceof ArrayCollection || is_array($items)) {
            foreach ($items as $item) {
                $this->addSession($item);
            }
        } elseif ($items instanceof Session) {
            $this->addSession($items);
        } else {
            throw new Exception("$items must be an instance of Session or ArrayCollection");
        }
    }

    /**
     * Get ArrayCollection
     *
     * @return ArrayCollection $sessions
     */
    public function getSessions()
    {
        return $this->sessions;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sessions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add Session
     *
     * @param Session $session
     */
    public function addSession(Session $session)
    {
        // Si l'objet fait déjà partie de la collection on ne l'ajoute pas
        if (!$this->sessions->contains($session)) {
            if (!$session->getProduits()->contains($this)) {
                $session->addProduit($this);  // Lie le Session au produit.
            }
            $this->sessions->add($session);
        }
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
     * Add sessionEmargement
     *
     * @param \OCAS\OCASBundle\Entity\session $sessionEmargement
     *
     * @return Intervenant
     */
    public function addSessionEmargement(\OCAS\OCASBundle\Entity\session $sessionEmargement)
    {
        $this->session[] = $sessionEmargement;

        return $this;
    }

    /**
     * Get sessionEmargement
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSessionEmargement()
    {
        return $this->session;
    }

    /**
     * Remove session
     *
     * @param \OCAS\OCASBundle\Entity\Session $session
     */
    public function removeSession(\OCAS\OCASBundle\Entity\Session $session)
    {
        $this->session->removeElement($session);
    }

    /**
     * Get session
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSession()
    {
        return $this->session;
    }
}
