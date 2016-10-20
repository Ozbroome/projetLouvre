<?php

namespace ER\BilleterieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table(name="client")
 * @ORM\Entity(repositoryClass="ER\BilleterieBundle\Repository\ClientRepository")
 */
class Client
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
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="naissance", type="date")
     */
    private $naissance;

    /**
     *
     * @var type Commande
     * 
     * @ORM\ManyToOne(targetEntity="ER\BilleterieBundle\Entity\Commande", inversedBy="clients")
     */
    private $commande;
    
    /**
     *
     * @var type Billet
     * 
     * @ORM\OneToOne(targetEntity="ER\BilleterieBundle\Entity\Billet")
     */
    private $billet;
    
    /**
     * Get id
     *
     * @return integer
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
     * @return Client
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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Client
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set naissance
     *
     * @param \DateTime $naissance
     *
     * @return Client
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
     * Set commande
     *
     * @param \ER\BilleterieBundle\Entity\Commande $commande
     *
     * @return Client
     */
    public function setCommande(\ER\BilleterieBundle\Entity\Commande $commande = null)
    {
        $this->commande = $commande;

        return $this;
    }

    /**
     * Get commande
     *
     * @return \ER\BilleterieBundle\Entity\Commande
     */
    public function getCommande()
    {
        return $this->commande;
    }

    /**
     * Set billet
     *
     * @param \ER\BilleterieBundle\Entity\Billet $billet
     *
     * @return Client
     */
    public function setBillet(\ER\BilleterieBundle\Entity\Billet $billet = null)
    {
        $this->billet = $billet;

        return $this;
    }

    /**
     * Get billet
     *
     * @return \ER\BilleterieBundle\Entity\Billet
     */
    public function getBillet()
    {
        return $this->billet;
    }
}
