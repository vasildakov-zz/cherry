<?php

namespace Application\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;


class LoadWalletData implements OrderedFixtureInterface, FixtureInterface
{
    public function getOrder() 
    {
        return 3;
    }

    public function load(ObjectManager $objectManager)
    {
    	// we are going to create two wallets for the first player
    	$player = $objectManager->find('Application\Entity\Player', 1);
    	
    	$eur = $objectManager->getRepository('Application\Entity\Currency')->findOneBy(array('name' => 'EUR'));
    	$bns = $objectManager->getRepository('Application\Entity\Currency')->findOneBy(array('name' => 'BNS'));

    	// fixture wallet 1 with real money
    	$wallet1 = new \Application\Entity\Wallet(); 
    	$wallet1->setName("Test Euro Wallet");
    	$wallet1->setCurrency($eur);
    	$wallet1->setPlayer($player);
    	$wallet1->setAmount(0.00);
    	$wallet1->setCreatedAt(new \DateTime);
    	$wallet1->setUpdatedAt(new \DateTime);
    	$wallet1->setStatus(\Application\Entity\Wallet::STATUS_ACTIVE);

    	// fixture wallet 2 with bonus money
    	$wallet2 = new \Application\Entity\Wallet(); 
    	$wallet2->setName("Test Bonus Wallet");
    	$wallet2->setCurrency($bns);
    	$wallet2->setPlayer($player);
    	$wallet2->setAmount(0.00);
    	$wallet2->setCreatedAt(new \DateTime);
    	$wallet2->setUpdatedAt(new \DateTime);
    	$wallet2->setStatus(\Application\Entity\Wallet::STATUS_ACTIVE);

    	$objectManager->persist($wallet1);
    	$objectManager->persist($wallet2);

    	$objectManager->flush();
    }
}