<?php

namespace Application\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;


class LoadPlayerData implements OrderedFixtureInterface, FixtureInterface
{
    public function getOrder() 
    {
        return 1;
    }

    public function load(ObjectManager $objectManager)
    {
    	// $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    	$players = $this->getMockPlayers();

    	foreach($players as $row) 
    	{
		    $player = new \Application\Entity\Player();
		    $player->setUsername($row['username']);
            $player->setPassword(123456);
            $player->setName($row['name']);
            $player->setSurname($row['surname']);
		    $player->setEmail( $row['email'] );
            $player->setAge( $row['age'] );
            $player->setGender( $row['gender'] );
            $player->setUpdatedAt( new \DateTime() );

		    $objectManager->persist($player);
		    $objectManager->flush();
    	}

    }


    public function getMockPlayers() 
    {
        return  array(
                array(
                    'username' => 'TheRing',     
                    'name' => 'Alan', 
                    'surname' => 'Howard',    
                    'email' => "alan.howard@gmail.com",
                    'gender' => 1,
                    'age' => 76
                ),
                array(
                    'username' => 'Frodo',     
                    'name' => 'Elijah',
                    'surname' => 'Wood',    
                    'email' => "elijah.wood@gmail.com",
                    'gender' => 1,
                    'age' => 33
                ),
                array(
                    'username' => 'Galadriel',     
                    'name' => 'Cate',
                    'surname' => 'Blanchett',    
                    'email' => "cate.blanchett@gmail.com",
                    'gender' => 2,
                    'age' => 45
                ),  
            );   
    }

}