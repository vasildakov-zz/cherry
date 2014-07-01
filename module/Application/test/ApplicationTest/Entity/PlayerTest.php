<?php

namespace ApplicationTest\Entity;

use ApplicationTest\Bootstrap;
use PHPUnit_Framework_TestCase;

class PlayerTest extends \PHPUnit_Framework_TestCase
{

	protected function setUp()
    {
    	$serviceManager = Bootstrap::getServiceManager();
    	$this->entityManager = $serviceManager->get('Doctrine\ORM\EntityManager');
    	
    	// see ./Application/src/Fixture/LoadPlayerData.php
    	$this->player1 = $this->entityManager->find('Application\Entity\Player', 1);
    	$this->player2 = $this->entityManager->find('Application\Entity\Player', 2);
    }



    public function testPlayerInstance() 
    {
        $this->assertInstanceOf('Application\Entity\Player', $this->player1);
        $this->assertInstanceOf('Application\Entity\Player', $this->player2);
    }


    /**
     * The first player has real money inserted from the fixtures
     * see ./Application/src/Fixture/LoadTransactionData.php
     */
    public function testPlayer1HasRealMoney() 
    {
    	$currency = $this->entityManager->getRepository('Application\Entity\Currency')->findOneBy(array("name" => "EUR"));
    	$balance = $this->player1->getBalance($currency);
    	$this->assertGreaterThan(0, $balance);
    }


    /**
     * The first player does not have bonus money
     */
    public function testPlayer1HasBonusMoney() 
    {
    	$currency = $this->entityManager->getRepository('Application\Entity\Currency')->findOneBy(array("name" => "BNS"));
    	$balance = $this->player1->getBalance($currency);
    	$this->assertEquals(0, $balance);
    }


    /**
     * The second player does not have real money
     */
    public function testPlayer2HasRealMoney() 
    {
    	$currency = $this->entityManager->getRepository('Application\Entity\Currency')->findOneBy(array("name" => "EUR"));
    	$balance = $this->player2->getBalance($currency);
    	$this->assertEquals(0, $balance);
    }

    protected function tearDown()
    {
        parent::tearDown();
    }
}