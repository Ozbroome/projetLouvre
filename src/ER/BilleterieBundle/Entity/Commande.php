<?php

namespace ER\BilleterieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="ER\BilleterieBundle\Repository\CommandeRepository")
 */
class Commande
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
     * @var \DateTime
     * 
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateVisite", type="date")
     */
    private $dateVisite;

    /**
     * @var bool
     *
     * @ORM\Column(name="demi", type="boolean")
     */
    private $demi;

    /**
     * @var int
     *
     * @ORM\Column(name="nombre", type="integer")
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;
    
    /**
     *
     * @var type 
     * 
     * @ORM\OneToMany(targetEntity="ER\BilleterieBundle\Entity\Client", mappedBy="commande",cascade={"persist"})
     */
    private $clients;
    
    
    public function __construct()
    {
        $this->date= new \DateTime();
    }
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Commande
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set dateVisite
     *
     * @param \DateTime $dateVisite
     *
     * @return Commande
     */
    public function setDateVisite($dateVisite)
    {
        $this->dateVisite = $dateVisite;

        return $this;
    }

    /**
     * Get dateVisite
     *
     * @return \DateTime
     */
    public function getDateVisite()
    {
        return $this->dateVisite;
    }

    /**
     * Set demi
     *
     * @param boolean $demi
     *
     * @return Commande
     */
    public function setDemi($demi)
    {
        $this->demi = $demi;

        return $this;
    }

    /**
     * Get demi
     *
     * @return bool
     */
    public function getDemi()
    {
        return $this->demi;
    }

    /**
     * Set nombre
     *
     * @param integer $nombre
     *
     * @return Commande
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return int
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Commande
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Add client
     *
     * @param \ER\BilleterieBundle\Entity\Client $client
     *
     * @return Commande
     */
    public function addClient(\ER\BilleterieBundle\Entity\Client $client)
    {
        $this->clients[] = $client;
        $client->setCommande($this);

        return $this;
    }

    /**
     * Remove client
     *
     * @param \ER\BilleterieBundle\Entity\Client $client
     */
    public function removeClient(\ER\BilleterieBundle\Entity\Client $client)
    {
        $this->clients->removeElement($client);
    }

    /**
     * Get clients
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClients()
    {
        return $this->clients;
    }
}
