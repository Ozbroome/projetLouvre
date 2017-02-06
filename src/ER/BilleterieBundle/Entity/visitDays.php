<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Visiting_day
 *
 * @ORM\Table(name="visiting_day")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Visiting_dayRepository")
 */
class Visiting_day
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
     * @var int
     *
     * @ORM\Column(name="number_tickets", type="integer", nullable=true)
     */
    private $numberTickets;
    
   /**
    *@var bool
    *
    *@ORM\Column(name="reservable", type="boolean")
    */
    private $reservable;
    
   /**
    *@var string
    *
    *@ORM\Column(name="availability", type="string")
    */
    private $availability;
    
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
     * @return jour_visite
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
     * Set numberTickets
     *
     * @param integer $numberTickets
     *
     * @return Visiting_day
     */
    public function setNumberTickets($numberTickets)
    {
        $this->numberTickets = $numberTickets;
        return $this;
    }
    
    /**
     * Get numberTickets
     *
     * @return integer
     */
    public function getNumberTickets()
    {
        return $this->numberTickets;
    }
    
    /**
     * Set reservable
     *
     * @param boolean $reservable
     *
     * @return Visiting_day
     */
    public function setReservable($reservable)
    {
        $this->reservable = $reservable;
        return $this;
    }
    
    /**
     * Get reservable
     *
     * @return boolean
     */
    public function getReservable()
    {
        return $this->reservable;
    }
    
    /**
     * Set availability
     *
     * @param string $availability
     *
     * @return Visiting_day
     */
    public function setAvailability($availability)
    {
        $this->availability = $availability;
        return $this;
    }
    
    /**
     * Get availability
     *
     * @return string
     */
    public function getAvailability()
    {
        return $this->availability;
    }
}