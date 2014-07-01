<?php

namespace ApplicationTest\Entity;

use ApplicationTest\Bootstrap;
use PHPUnit_Framework_TestCase;

class BonusTest extends \PHPUnit_Framework_TestCase
{

	protected function setUp()
    {
        $serviceManager = Bootstrap::getServiceManager();
        $this->entityManager = $serviceManager->get('Doctrine\ORM\EntityManager');

        // First deposit bonus
        $this->firstDepositBonus = $this->entityManager->find('Application\Entity\Bonus', 1);

        // First login bonus
        $this->firstLoginBonus   = $this->entityManager->find('Application\Entity\Bonus', 2);
    }



    public function testFirstDepositBonusIsApplicable() 
    {
    	$transaction = new \Application\Entity\Transaction();
        $transaction->setAmount(250.00);
        $this->assertTrue($this->firstDepositBonus->isApplicable($transaction) );
    	
    }


    /**
     * The deposited amount does not meet wagering requirement
     * for the first deposit bonus
     */
    public function testFirstDepositBonusIsNotApplicable()
    {
        $transaction = new \Application\Entity\Transaction();
        $transaction->setAmount(100.00);
        $this->assertFalse($this->firstDepositBonus->isApplicable($transaction));
    }


    protected function tearDown()
    {
        parent::tearDown();
    }

}