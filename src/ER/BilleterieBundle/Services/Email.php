<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


namespace ER\BilleterieBundle\Services;

use ER\BilleterieBundle\Entity\Commande;
/**
 * Description of Email
 *
 * @author eric
 */
class Email {
    
    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    private $twig;
    
    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }       
    public function sendEmail(Commande $commande)
    {
        // Image en pièce jointe
        $image = ('img/header.jpg');
        $message = new \Swift_Message();
        $logo = $message->embed(\Swift_Image::fromPath($image));
        // Composition du message du mail
        $message
            ->setCharset('UTF-8')
            ->setSubject('Billet(s) de réservation au Musée du Louvre')
            ->setBody($this->twig->render('ERBilleterieBundle:Default:email.html.twig', array(
                'commande' => $commande,
                'logo' => $logo,
            )))
            ->setContentType('text/html')
            ->setTo($commande->getEmail())
            ->setFrom(array('eric.rodriguez.pp@gmail.com' => 'Musée du Louvre'));
        // Envoi du message au visiteur
        $this->mailer->send($message);
    }
    
}
