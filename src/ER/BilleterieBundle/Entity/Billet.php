<?php

namespace ER\BilleterieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Billet
 * 
 * @ORM\Table(name="billet")
 * @ORM\Entity(repositoryClass="ER\BilleterieBundle\Repository\BilletRepository")
 */
class Billet
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
     * @ORM\Column(name="demi", type="integer")
     */
    private $categorie;

    /**
     * @var int
     *
     * @ORM\Column(name="tarif", type="integer")
     */
    private $tarif;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255)
     */
    private $codeBillet;
    
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
     * Set categorie
     *
     * @param integer $categorie
     *
     * @return Billet
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return int
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set tarif
     *
     * @param integer $tarif
     *
     * @return Billet
     */
    public function setTarif($tarif)
    {
        $this->tarif = $tarif;

        return $this;
    }

    /**
     * Get tarif
     *
     * @return int
     */
    public function getTarif()
    {
        return $this->tarif;
    }

    /**
     * Set codeBillet
     *
     * @param string $codeBillet
     *
     * @return Billet
     */
    public function setCodeBillet($codeBillet)
    {
        $this->codeBillet = $codeBillet;

        return $this;
    }

    /**
     * Get codeBillet
     *
     * @return string
     */
    public function getCodeBillet()
    {
        return $this->codeBillet;
    }
}
