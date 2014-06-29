<?php
/**
 * DepositListener
 * 
 * @author Vasil Dakov <vasildakov@gmail.com>
 */

namespace Application\Listener;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs as Event;
use Application\Entity\Transaction as Transaction;

class DepositListener {

    public function onFlush(Transaction $click, Event $args)
    {
        $entity = $args->getEntity();
        $entityManager = $args->getEntityManager();

        if ($entity instanceof Transaction) {
        	// add bonus on deposit here 
        }
    }

}