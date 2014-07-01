<?php
/**
 * TransactionListener
 * 
 * @author Vasil Dakov <vasildakov@gmail.com>
 */

namespace Application\Listener;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs as Event;
use Application\Entity\Transaction as Transaction;
use Application\Entity\Bonus as Bonus;

class TransactionListener {

    public function onFlush(Event $args)
    {
        $entity = $args->getEntity();
        $entityManager = $args->getEntityManager();

        if ($entity instanceof Transaction) {

        	// the transaction type must be Deposit and the amount must fit the wagering requirement
        	if($entity->getType() == Transaction::TYPE_DEPOSIT && $entity->getAmount() >= $bonus->getWageringRequirement()) {

        		// the folowing part can be done more intelligently by implementing all necessary methods in
        		// doctrine entity classes instead of calling repositories

        		$bonus    = $entityManager->getRepository('Application\Entity\Bonus')
        		                          ->findOneBy(array('event_trigger' => Bonus::TRIGGER_DEPOSIT));

        		$currency = $entityManager->getRepository('Application\Entity\Currency')
                                          ->findOneBy(array("name" => "BNS"));

        		$wallet   = $entityManager->getRepository('Application\Entity\Wallet')
                                          ->findOneBy(array(
	                                          	"player" => $entity->getWallet()->getPlayer(), 
	                                          	"currency" => $currency));

                $transaction = new Transaction;
                $transaction->setAmount($bonus->getReward());
                $transaction->setWallet($wallet); 
                $transaction->setType(Transaction::TYPE_BONUS); 
                $transaction->setComment($bonus->getReward());
                $transaction->setCreatedAt( new \DateTime); 

    			$entityManager->persist($transaction);
    			$entityManager->flush();
        	}
        }
    }
}