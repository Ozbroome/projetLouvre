<?php

namespace Tests\AppBundle\Entity;

use ER\BilleterieBundle\Entity\Client;
/**
 * Description of Commande
 *
 * @author eric
 */
class ClientTest extends \PHPUnit_Framework_TestCase {
    public function testClient() {
        $client = new Client();
        
        $client
                ->setNom('Rodriguez')
                ->setPrenom('Eric')
                ->setNaissance( \DateTime::createFromFormat('d/m/Y','28/12/2000'));
        
        $this->assertEquals('Rodriguez', $client->getNom());
         $this->assertEquals('Eric', $client->getprenom());
        $this->assertEquals('28/12/2000', $client->getNaissance()->format('d/m/Y'));
      
    }
}
