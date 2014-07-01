<?php
/**
 * LoginListener
 * 
 * @author Vasil Dakov <vasildakov@gmail.com>
 */

namespace Application\Listener;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs as Event;
use Application\Entity\Login as Login;

class LoginListener {

    public function onFlush(Login $login, Event $args)
    {
        $entity = $args->getEntity();
        $entityManager = $args->getEntityManager();

        if ($entity instanceof Login) {
        	// first login bonus code 

        	$player = $entity->getPlayer();
            $logins = $entityManager->getRepository('Application\Entity\Login')->findOneBy(array('player' => $player));

        	// apply first login bonus
        	if($logins->count() == 1 ) {

        		$currency = $entityManager->getRepository('Application\Entity\Currency')
                            ->findOneBy(array('name' => 'BNS'));

        		// retrive player bonus wallet if exists
        		if(true === $player->hasWallet($currency)) {
        			$wallet = $entityManager->getRepository('Application\Entity\Wallet')
        			         ->findOneBy(array('player' => $player, 'currency' => $currency));
        		}
        		else {
        			$wallet = new Application\Entity\Wallet();
        			$wallet->setPlayer($player);
        			$wallet->setCurrency($currency);
        			$wallet->setCreatedAt(new \DateTime);
        			// what should be the initial status of the bonus wallet?
        			$wallet->setStatus(Application\Entity\Wallet::STATUS_ACTIVE);
        		}

        		$bonus = $entityManager->getRepository('Application\Entity\Bonus')
        		          ->findOneBy(array('trigger' => \Application\Entity\Bonus::TRIGGER_LOGIN));

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