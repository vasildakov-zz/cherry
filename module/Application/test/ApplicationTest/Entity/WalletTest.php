<?php

namespace ApplicationTest\Entity;

use ApplicationTest\Bootstrap;
use PHPUnit_Framework_TestCase;

class WalletTest extends \PHPUnit_Framework_TestCase
{

	protected function setUp()
    {

    }


    public function testBalanceIsInitiallyZero() 
    {
        $serviceManager = Bootstrap::getServiceManager();
        $entityManager = $serviceManager->get('Doctrine\ORM\EntityManager');

        $wallet = $entityManager->find('Application\Entity\Wallet', 1);

        $this->assertEquals(0, $wallet->getAmount());
    } 


    protected function tearDown()
    {
        parent::tearDown();
    }

}