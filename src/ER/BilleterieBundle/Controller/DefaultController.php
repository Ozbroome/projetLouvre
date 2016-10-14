<?php

namespace ER\BilleterieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ER\BilleterieBundle\Form\CommandeType;
use ER\BilleterieBundle\Entity\Commande;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $commande = new Commande();
        $form = $this->get('form.factory')->create(CommandeType::class, $commande);
        
        return $this->render('ERBilleterieBundle:Default:index.html.twig', array('form' => $form->createView(),
            ));
    }
}
