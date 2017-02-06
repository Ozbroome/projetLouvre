<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ER\BilleterieBundle\Validator\Constraints;
 
 use Doctrine\ORM\EntityManagerInterface;
 use Symfony\Component\Validator\Constraint;
 use Symfony\Component\Validator\ConstraintValidator;

/**
 * Description of visitDaysValidator
 *
 * @author eric
 */
class VisitDaysValidator extends ConstraintValidator {

        private $em;
        
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    
    public function validate ($value, Constraint $constraint) {
        $today = new \DateTime();
        $time = date("H");
        $today->setTime(0, 0, 0);
        $visitDate = $value->getDateVisite();
        $demi = $value->getDemi();
       //validator jour passé
        if ($visitDate < $today) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
        if(($visitDate == $today) && ($demi == 0) && ($time >= 14)) {
            $this->context->buildViolation($constraint->message4)
                ->addViolation();
        }
        
        //validator jours fériés, dimanche, mardi.
        $year = $visitDate->format('Y');
        $holidays = array(
        mktime(0, 0, 0, 1, 1, $year),  // 1er janvier
        mktime(0, 0, 0, 5, 1, $year),  // Fête du travail
        mktime(0, 0, 0, 5, 8, $year),  // Victoire des alliés
        mktime(0, 0, 0, 7, 14, $year),  // Fête nationale
        mktime(0, 0, 0, 8, 15, $year),  // Assomption
        mktime(0, 0, 0, 11, 1, $year),  // Toussaint
        mktime(0, 0, 0, 11, 11, $year),  // Armistice
        mktime(0, 0, 0, 12, 25, $year),  // Noel
        );
        
        $daysOff = array(
            "mardi" =>2,
            "dimanche"=> 7,
        );
        if (in_array($visitDate->getTimestamp(), $holidays)) {
            $this->context->buildViolation($constraint->message3)
                ->addViolation();
        } 
        
                // Récupère les entités avec le meme jour de réservation
        $daysReservation = $this->em
            ->getRepository('ERBilleterieBundle:Commande')
            ->findBy(array('dateVisite' => $visitDate))
        ;
        // Si il n'y a pas d'entités avec le même jour de réservation
        // On arrête tout de suite
        if (empty($daysReservation)) {
            return;
        }
        // Initialisation du nombre de reservation à 0
        $nbReservations = 0;
        // Récupère le nombre de billets pour chaque entité récupérée
        foreach ($daysReservation as $daysReservations) {
            // Compte le nombre de billets liés
            $nbTickets = $daysReservations->getNombre();
            // Ajoute ce nombre au total
            $nbReservations += $nbTickets;
        }
        
        if ($nbReservations >= 2) {
            // Déclenche l'erreur
             $this->context->buildViolation($constraint->message3)
                ->addViolation();
        }
    }
}
