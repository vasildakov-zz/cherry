<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AccountController extends AbstractActionController
{

    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;


    public function indexAction()
    {
        $authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
        $player = $authService->getIdentity();

        // $currency = $this->getEntityManager()->getRepository('Application\Entity\Currency')->findOneBy(array('name' => "EUR"));

        return new ViewModel(array(
			'player' => $player,
			'balance' => $player->getBalance(),
        ));

    }

    /**
     * @param Doctrine\ORM\EntityManager
     */
    public function setEntityManager(EntityManager $em)
    {
        $this->em = $em;
    }


    /**
     * @return Doctrine\ORM\EntityManager
     */
    public function getEntityManager() 
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }


}