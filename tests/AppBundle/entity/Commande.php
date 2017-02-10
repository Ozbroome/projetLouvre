<?php

namespace tests\entity;

use ER\BilleterieBundle\Entity\Commande;
/**
 * Description of Commande
 *
 * @author eric
 */
class Commande {
    
    public function testCommande() {
        $commande = new Commande();
        
        $commande
                ->setDateVisite('28/16/2018')
                ->setDemi(1)
                ->setEmail('eric.rodriguez.pp@gmail.com')
                ->setNombre(3);
        
        $this->assertEquals('28/16/2018', $commande->getDateVisite());
        $this->assertEquals(1, $commande->getDemi());
        $this->assertEquals('eric.rodriguez.pp@gmail.com', $commande->getEmail());
        $this->assertEquals(3, $commande->getNombre());
    }
}
