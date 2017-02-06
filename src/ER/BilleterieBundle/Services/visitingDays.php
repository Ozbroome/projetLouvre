<?php
namespace ER\BilleterieBundle\Services;
use Doctrine\ORM\EntityManager;
use ER\BilleterieBundle\Entity\Order;
use ER\BilleterieBundle\Entity\Visiting_day;
class ControlVisitingDays{
	private $em;
	public function __construct(EntityManager $em){
		$this->em = $em;
	}
	//return a list of the invalid visiting day(s)
	public function getInvalidVisitingDaysList(Boolean $json = null){
		$listIVDTab =[];
		$listIVD = $this->em->getRepository('AppBundle:Visiting_day')
			->getInvalidDays()
		;
		foreach ($listIVD as $VD) {
			$listIVDTab[] = [$VD->getDate(), $VD->getAvailability()];
		}
		return $listIVDTab;
	}
	//return true if the date parameter is a valid day
	public function isValidVisitingDay($date){
		//load list of invalid days
		$listIVDTab = $this->getInvalidVisitingDaysList();
		$dateToday = new \DateTime();
		
		//test if is a invalid day
		foreach ($listIVDTab as $key => $iVD) {
			
			if($date->format('Y-m-d') === $iVD[0]->format('Y-m-d')){
				return false;
			}
		}
		//test if is tuesday or sunday
		if($date->format('N') === '2' || $date->format('N') === '7'){
			return false;
		}
		//test if is a previous day
            		if($date->format('Y-m-d') < $dateToday->format('Y-m-d')){
                		return false;
            		}
		//test if is 21h past
		if($date->format('Y-m-d') === $dateToday->format('Y-m-d') && $dateToday->format('H') > '20'){
			return false;
		}
		
		//if date is valid
		return true;
	}
	public function createVisitingDay($date)
	{
		$date->setTime(00,00,00);
		$visitingDay = $this->em->getRepository('AppBundle:Visiting_day')
			->getVisitingDayWithDate($date);
		;
		
		if(count($visitingDay) === 0){
			$visitingDay = new Visiting_day();
			$visitingDay
				->setReservable(true)
				->setAvailability('open')
				->setDate($date)
				->setNumberTickets(0)
			;
			$this->em->persist($visitingDay);
			$this->em->flush();
		}
		
	}
	//set new visiting day if not exist and add number of ticket(s) and set if the visiting day is valid (<=1000 tickets)
	public function setVisitingDay($date, Order $order)
	{
		$date->setTime(00,00,00);
		$visitingDay = $this->em->getRepository('AppBundle:Visiting_day')
			->getVisitingDayWithDate($date);
		;
		$tickets = $order->getTickets();
		$nbTicketsOrder = count($tickets);
		foreach ($visitingDay as $VD) {
			$nbTickets = $VD->getNumberTickets();
			$nbTickets += $nbTicketsOrder;
			$VD->setNumberTickets($nbTickets);
			if($nbTickets >= 1000){
				$VD->setReservable(false);
				$VD->setAvailability('onSite');
			
				$this->em->persist($VD);
			}
		}
		$this->em->flush();
	}
	public function hasRoom($date, Order $order)
	{
		$date->setTime(00,00,00);
		$visitingDay = $this->em->getRepository('AppBundle:Visiting_day')
			->getVisitingDayWithDate($date);
		;
		$tickets = $order->getTickets();
		$nbTicketsOrder = count($tickets);
		if(count($visitingDay) > 0){
			$nbTicketsVD = $visitingDay[0]->getNumberTickets();
			return $hasRoom = array(
				'availability' => (($nbTicketsVD + $nbTicketsOrder) <= 1000) ,
				'nbPlaces' => (1000 - $nbTicketsVD)
			);
		}
		else{
			return;
		}
	}
}