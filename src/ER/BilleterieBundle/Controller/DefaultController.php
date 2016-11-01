<?php

namespace ER\BilleterieBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ER\BilleterieBundle\Form\CommandeType;
use ER\BilleterieBundle\Form\ClientType;
use ER\BilleterieBundle\Entity\Client;
use ER\BilleterieBundle\Entity\Commande;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use ER\BilleterieBundle\Entity\Billet;
class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        $commande = new Commande();
        $form = $this->get('form.factory')->create(CommandeType::class, $commande);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            
            $session->set('Commande', $commande);
            
            return $this->redirectToRoute('er_billeterie_Client');
        }
        
        return $this->render('ERBilleterieBundle:Default:index.html.twig', array('form' => $form->createView(),
            ));
    }
 
    public function clientAction(Request $request)
    {
        $session = $request->getSession();
        $commande = $session->get('Commande');
        $nombre = $commande->getNombre();
        $clients = array();
        for ($i=0; $i<$nombre; $i++){
            $clients[$i] = new Client();
        }
        $form = $this->createFormBuilder($clients);
        for ($i = 0; $i < $nombre; $i++) {
            $form
                    ->add($i, ClientType::class, array(
                'label' => 'Visiteur ' . ($i + 1) . ':'
            ));
        }
        $form->add('save',   SubmitType::class, array('label'=>'Continuer'));
        $formClient = $form->getForm();
        if ($request->isMethod('POST') && $formClient->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            for ($i = 0; $i < $nombre; $i++) {
                  $commande->addClient($clients[$i]);
                  $clients[$i]->setBillet($this->generateBillet($clients[$i], $commande->getDemi(),$commande));
            }
            $session
                    ->set('Commande', $commande)
                    ->set('Clients', $clients);
            
            $em->persist($commande);
            $em->flush();
            
           
            return $this->redirectToRoute('er_billeterie_paiement');
        }
       /* $formClient = $this->get('form.factory')->create(ClientType::class, $clients);*/
        return $this->render('ERBilleterieBundle:Default:client.html.twig', array('formClient' => $formClient->createView(),
            ));
    }
    
    public function paiementAction(Request $request)
    {
        
        $session = $request->getSession();
        $commande = $session->get('Commande');
        $nombre = $commande->getNombre();
        $clients = $commande->getClients();
        $billets = [];
        for ($i = 0; $i < $nombre; $i++) {
            $billets[$i] = $clients[$i]->getBillet();
        }
     
        
        
        
        return $this->render('ERBilleterieBundle:Default:paiement.html.twig');
    }
    
    
    
    //Fonction pour calculer l'age, et le tarif du billet en fonction de l'age, de l'option "tarif réduit" et du choix "journée complète" ou "demi journée".
    public function generateBillet($client,$typeBillet,$commande) {
        $billet = new Billet();
        $dateVisite = $commande->getDateVisite();
        $dateNaissance = $client->getNaissance();
        $diff = $dateNaissance->diff($dateVisite);
        $age = $diff->format('%Y');
        $tarifReduit = $client->getTarifReduit();
        $categorie = 0;
        $tarif = 16;
        if ($age<4) {
            $categorie = 0;
        }
        elseif ($age < 12 AND $age>4 ) {
            $categorie = 1;
        }
        elseif ($tarifReduit) {
            $categorie = 2;
        }
        elseif ($age>60) {
            $categorie = 3;
        }
        else {
            $categorie = 4;
        }
        switch ($categorie)
        {
            case 0:
                $tarif = 0;
                break;
            case 1:
                $tarif = 8;
                break;
            case 2:
                $tarif = 10;
                break;
            case 3:
                $tarif = 12;
                break;
            case 4:
                $tarif = 16;
                break;
        }
        if ($typeBillet) {
            $tarif = $tarif/2;
        }
        $billet->setCategorie($categorie);
        $billet->setTarif($tarif);
        return $billet;
    }
}