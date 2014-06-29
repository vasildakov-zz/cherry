<?php

namespace Application\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;


class LoadCurrencyData implements OrderedFixtureInterface, FixtureInterface
{
    public function getOrder() 
    {
        return 2;
    }

    public function load(ObjectManager $objectManager)
    {
    	$currencies = array("EUR", "BNS");

    	foreach ($currencies as $key => $value) 
    	{
    		$currency = new \Application\Entity\Currency(); 
    		$currency->setName($value);
    		$objectManager->persist($currency);
    		$objectManager->flush();
    	}


    }
}