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
        return 4;
    }

    public function load(ObjectManager $objectManager)
    {

        // get the wallets for player with id 1

    }
}