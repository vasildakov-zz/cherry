<?php

namespace ApplicationTest\Entity;

use ApplicationTest\Bootstrap;
use PHPUnit_Framework_TestCase;

class WalletTest extends \PHPUnit_Framework_TestCase
{

	protected function setUp()
    {
        $serviceManager = Bootstrap::getServiceManager();
        $this->entityManager = $serviceManager->get('Doctrine\ORM\EntityManager');

        $this->player1 = $this->entityManager->find('Application\Entity\Player', 1);
        $this->player2 = $this->entityManager->find('Application\Entity\Player', 2);
    }


    /**
     * The Wallet 2 for Player 2 does not have any deposits 
     */
    public function testBalanceIsInitiallyZero() 
    {
        $wallet = $this->entityManager->find('Application\Entity\Wallet', 2);
        $this->assertEquals(0, $wallet->getBalance());
    } 


    /**
     * The real money wallet has 200.00 euros
     * see ./Application/src/Fixture/LoadTransactionData.php
     */
    public function testPlayer1RealMoneyWalletBalance() 
    {
        $currency = $this->entityManager->getRepository('Application\Entity\Currency')
                                        ->findOneBy(array("name" => "EUR"));

        $wallet   = $this->entityManager->getRepository('Application\Entity\Wallet')
                                        ->findOneBy(array("player" => $this->player1, "currency" => $currency));

        $this->assertEquals(200, $wallet->getBalance());

    }


    protected function tearDown()
    {
        parent::tearDown();
    }

}