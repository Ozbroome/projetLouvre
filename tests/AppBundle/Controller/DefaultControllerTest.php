<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('La billetterie du Louvre', $crawler->filter('.container h1')->text());
    }
    public function testCreationCommande()
    {
         $client = static::createClient();
        // Ouverture page 1 Commande
        $crawler = $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('ER\BilleterieBundle\Controller\DefaultController::indexAction', $client->getRequest()->attributes->get('_controller'));
        $this->assertContains('La billetterie du Louvre', $client->getResponse()->getContent());
        $form = $crawler->selectButton('Continuer')->form(array(
            // valeurs du formulaire commande
            'er_billeteriebundle_commande[dateVisite]' => '27/02/2017',
            'er_billeteriebundle_commande[demi]' =>'1',
            'er_billeteriebundle_commande[nombre]' => '3',
            'er_billeteriebundle_commande[email]' => 'eric.rodriguez.pp@gmail.com',
        ));
        $client->submit($form);
        // Envoi vers la page 2 Visiteurs
        $crawler = $client->request('POST', '/client');
        $this->assertTrue($client->getResponse()->isSuccessful(), 'response status is 2xx');
        $this->assertEquals('ER\BilleterieBundle\Controller\DefaultController::clientAction', $client->getRequest()->attributes->get('_controller'));
    }
}
