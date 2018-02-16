<?php

namespace OCASBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Siege
 *
 * @ORM\Table(name="siege")
 * @ORM\Entity(repositoryClass="OCASBundle\Repository\SiegeRepository")
 */
class Siege
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
     * @ORM\Column(name="rsociale", type="string", length=255)
     */
    private $rsociale;

    /**
     * @var string
     *
     * @ORM\Column(name="correspondant", type="string", length=255, nullable=true)
     */
    private $correspondant;

    /**
     * @var string
     *
     * @ORM\Column(name="num_voie", type="string", length=255)
     */
    private $numVoie;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_complement", type="string", length=255, nullable=true)
     */
    private $adresseComplement;

    /**
     * @var int
     *
     * @ORM\Column(name="code_departement", type="integer")
     */
    private $codeDepartement;

    /**
     * @var string
     *
     * @ORM\Column(name="commune", type="string", length=255)
     */
    private $commune;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=255, nullable=true)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=255, nullable=true)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="cedex", type="string", length=255, nullable=true)
     */
    private $cedex;


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
     * Set rsociale
     *
     * @param string $rsociale
     *
     * @return Siege
     */
    public function setRsociale($rsociale)
    {
        $this->rsociale = $rsociale;

        return $this;
    }

    /**
     * Get rsociale
     *
     * @return string
     */
    public function getRsociale()
    {
        return $this->rsociale;
    }

    /**
     * Set correspondant
     *
     * @param string $correspondant
     *
     * @return Siege
     */
    public function setCorrespondant($correspondant)
    {
        $this->correspondant = $correspondant;

        return $this;
    }

    /**
     * Get correspondant
     *
     * @return string
     */
    public function getCorrespondant()
    {
        return $this->correspondant;
    }

    /**
     * Set numVoie
     *
     * @param string $numVoie
     *
     * @return Siege
     */
    public function setNumVoie($numVoie)
    {
        $this->numVoie = $numVoie;

        return $this;
    }

    /**
     * Get numVoie
     *
     * @return string
     */
    public function getNumVoie()
    {
        return $this->numVoie;
    }

    /**
     * Set adresseComplement
     *
     * @param string $adresseComplement
     *
     * @return Siege
     */
    public function setAdresseComplement($adresseComplement)
    {
        $this->adresseComplement = $adresseComplement;

        return $this;
    }

    /**
     * Get adresseComplement
     *
     * @return string
     */
    public function getAdresseComplement()
    {
        return $this->adresseComplement;
    }

    /**
     * Set codeDepartement
     *
     * @param integer $codeDepartement
     *
     * @return Siege
     */
    public function setCodeDepartement($codeDepartement)
    {
        $this->codeDepartement = $codeDepartement;

        return $this;
    }

    /**
     * Get codeDepartement
     *
     * @return int
     */
    public function getCodeDepartement()
    {
        return $this->codeDepartement;
    }

    /**
     * Set commune
     *
     * @param string $commune
     *
     * @return Siege
     */
    public function setCommune($commune)
    {
        $this->commune = $commune;

        return $this;
    }

    /**
     * Get commune
     *
     * @return string
     */
    public function getCommune()
    {
        return $this->commune;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Siege
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set fax
     *
     * @param string $fax
     *
     * @return Siege
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set cedex
     *
     * @param string $cedex
     *
     * @return Siege
     */
    public function setCedex($cedex)
    {
        $this->cedex = $cedex;

        return $this;
    }

    /**
     * Get cedex
     *
     * @return string
     */
    public function getCedex()
    {
        return $this->cedex;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->agences = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add agence
     *
     * @param \OCASBundle\Entity\Agence $agence
     *
     * @return Siege
     */
    public function addAgence(\OCASBundle\Entity\Agence $agence)
    {
        $this->agences[] = $agence;

        return $this;
    }

    /**
     * Remove agence
     *
     * @param \OCASBundle\Entity\Agence $agence
     */
    public function removeAgence(\OCASBundle\Entity\Agence $agence)
    {
        $this->agences->removeElement($agence);
    }

    /**
     * Get agences
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAgences()
    {
        return $this->agences;
    }
}
