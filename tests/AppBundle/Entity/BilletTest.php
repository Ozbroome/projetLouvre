<?php
namespace Tests\AppBundle\Entity;

use ER\BilleterieBundle\Entity\Billet;
/**
 * Description of Commande
 *
 * @author eric
 */
class BilletTest extends \PHPUnit_Framework_TestCase {
    public function testBillet()
    {
        $billet = new Billet();
        $billet
            ->setCategorie('1')
            ->setTarif('12')
            ->setCodeBillet('abc12315');
        $this->assertEquals('1', $billet->getCategorie());
        $this->assertEquals('12', $billet->getTarif());
        $this->assertEquals('abc12315', $billet->getCodeBillet());
    }
}
