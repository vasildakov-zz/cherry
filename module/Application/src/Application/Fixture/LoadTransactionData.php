<?php

namespace Application\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;


class LoadTransactionData implements OrderedFixtureInterface, FixtureInterface
{
    public function getOrder() 
    {
        return 10;
    }

    public function load(ObjectManager $objectManager)
    {
        // get the wallets for player with id 1
        $player = $objectManager->find('Application\Entity\Player', 1);

        // the amounts will be added as deposits to the wallet
    	$amounts = array(10, 20, 30, 100, 40);

        $currency = $objectManager->getRepository('Application\Entity\Currency')->findOneBy(array("name" => "EUR"));
        $wallet = $objectManager->getRepository('Application\Entity\Wallet')->findOneBy(array("player" => $player, "currency" => $currency));

        foreach($amounts as $amount) 
        {
        	$transaction = new \Application\Entity\Transaction;
        	$transaction->setWallet($wallet);
        	$transaction->setAmount($amount);
        	$transaction->setType(\Application\Entity\Transaction::TYPE_DEPOSIT);
        	$transaction->setCreatedAt(new \DateTime);

    		$objectManager->persist($transaction);
    		$objectManager->flush();
        }


    }
}