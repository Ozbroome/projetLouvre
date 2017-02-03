<?php
namespace AppBundle\Services;
use AppBundle\Entity\Order;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
class OrderSuccessMailer
{
	/**
	*@var \Swift_Mailer
	*/
	private $mailer;
	/**
	*@var 
	*/
	private $templating;
	private $container;
	public function __construct(ContainerInterface $container)
	{
		$this->mailer = $container->get('mailer');
		$this->templating = $container->get('templating');
		$this->container = $container;
	}
	public function sendMailSuccess(Order $order, $htmlView)
	{
		//Send an email with pdf contains E-Ticket(s)
		
		$eTickets = "e-billets". $order->getId() . ".pdf";
		$pdfPath = $this->container->getParameter('path.pdf');
		$html2pdf = new \Html2Pdf_Html2Pdf('P','A4','fr',true,'utf-8');
		$html2pdf->WriteHTML($htmlView);
		$html2pdf->Output($pdfPath . $eTickets, 'F');
		$message = \Swift_Message::newInstance()
			->setSubject('Commande de Billets - Musé du Louvre')
			->setFrom('service.billetterie@musee-louvre.fr')
			->setTo($order->getEmailVisitor())
			->setBody(
				$this->templating->render(
					'Emails/orderSuccess.html.twig',
					array('order' => $order)
				),
				'text/html'
			)
			->attach(\Swift_Attachment::fromPath($pdfPath . $eTickets));
		;
		$this->mailer->send($message);
	}
}