<?php

namespace Application\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;


class LoadBonusData implements OrderedFixtureInterface, FixtureInterface
{
    public function getOrder() 
    {
        return 6;
    }

    public function load(ObjectManager $objectManager)
    {
    	$bonuses = array(
            array(
                "name" => "First deposit bonus", 
                "reward" => 20, 
                "unit" => \Application\Entity\Bonus::UNIT_PERCENTAGE, 
                "trigger" => \Application\Entity\Bonus::TRIGGER_DEPOSIT,
                "multiplier" => 1,
                ),
            array(
                "name" => "First login bonus",   
                "reward" => 50, 
                "unit" => \Application\Entity\Bonus::UNIT_CURRENCY,
                "trigger" => \Application\Entity\Bonus::TRIGGER_LOGIN,
                "multiplier" => 5,
            ),
        );

    	foreach ($bonuses as $key => $value) 
    	{
    		$bonus = new \Application\Entity\Bonus(); 
    		$bonus->setName($value['name']);
            $bonus->setReward($value['reward']);
            $bonus->setUnit($value['unit']);
            $bonus->setTrigger($value['trigger']);
            $bonus->setMultiplier($value['multiplier']);
            $bonus->setStatus(\Application\Entity\Bonus::STATUS_ACTIVE);

    		$objectManager->persist($bonus);
    		$objectManager->flush();
    	}
    }
    
}