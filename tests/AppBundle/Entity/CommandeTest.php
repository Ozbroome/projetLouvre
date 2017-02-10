<?php

namespace Tests\AppBundle\Entity;

use ER\BilleterieBundle\Entity\Commande;
/**
 * Description of Commande
 *
 * @author eric
 */
class CommandeTest extends \PHPUnit_Framework_TestCase{
    
    public function testCommande() {
        $commande = new Commande();
        
        $commande
                ->setDateVisite( \DateTime::createFromFormat('d/m/Y','28/12/2018'))
                ->setDemi(1)
                ->setEmail('eric.rodriguez.pp@gmail.com')
                ->setNombre(3);
        
        $this->assertEquals('28/12/2018', $commande->getDateVisite()->format('d/m/Y'));
        $this->assertEquals(1, $commande->getDemi());
        $this->assertEquals('eric.rodriguez.pp@gmail.com', $commande->getEmail());
        $this->assertEquals(3, $commande->getNombre());
    }
}
