<?php

namespace ER\BilleterieBundle\Services;

use ER\BilleterieBundle\Entity\Billet;
use ER\BilleterieBundle\Entity\Commande;
use ER\BilleterieBundle\Entity\Client;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GestionCommande
 *
 * @author Eric
 */
class GestionCommande {
    
    public function generateBillets(Commande $commande) {
        foreach($commande->getClients() as $client) {
            $client->setBillet($this->generateBillet($client, $commande));
        }
    }
    
    //Fonction pour calculer l'age, et le tarif du billet en fonction de l'age, de l'option "tarif réduit" et du choix "journée complète" ou "demi journée".
    
    public function generateBillet(Client $client,Commande $commande) {
        $billet = new Billet();
        $dateNaissance = $client->getNaissance();
        $diff = $dateNaissance->diff($commande->getDateVisite());
        $age = $diff->format('%Y');
        $categorie = 0;
        $tarif = 16;
        if ($age<4) {
            $categorie = 0;
            $tarif = 0;
        }
        elseif ($age < 12 AND $age>4 ) {
            $categorie = 1;
             $tarif = 8;
        }
        elseif ($client->getTarifReduit()) {
            $categorie = 2;
             $tarif = 10;
        }
        elseif ($age>60) {
            $categorie = 3;
             $tarif = 12;
        }
        else {
            $categorie = 4;
             $tarif = 16;
        }
       
        if ($commande->getDemi()) {
            $tarif = $tarif/2;
        }
        $billet->setCategorie($categorie);
        $billet->setTarif($tarif);
        return $billet;
    }
}
