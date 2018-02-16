<?php

namespace OCASBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Agence
 *
 * @ORM\Table(name="agence")
 * @ORM\Entity(repositoryClass="OCASBundle\Repository\AgenceRepository")
 */
class Agence
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
    * @ORM\ManyToOne(targetEntity="OCASBundle\Entity\Siege")
    */
    private $siege;


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
     * @return Agence
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
     * @return Agence
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
     * @return Agence
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
     * @return Agence
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
     * @return Agence
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
     * @return Agence
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
     * @return Agence
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
     * @return Agence
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
     * @return Agence
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
     * Set siege
     *
     * @param \OCASBundle\Entity\Siege $siege
     *
     * @return Agence
     */
    public function setSiege(\OCASBundle\Entity\Siege $siege = null)
    {
        $this->siege = $siege;

        return $this;
    }

    /**
     * Get siege
     *
     * @return \OCASBundle\Entity\Siege
     */
    public function getSiege()
    {
        return $this->siege;
    }
}
