<?php

namespace Application\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;


class LoadGameData implements OrderedFixtureInterface, FixtureInterface
{
    public function getOrder() 
    {
        return 7;
    }

    public function load(ObjectManager $objectManager)
    {
    	// create a test game 
        $game = new \Application\Entity\Game(); 
        $game->setName("The Wish Master");
    	$objectManager->persist($game);
    	$objectManager->flush();
    }
}