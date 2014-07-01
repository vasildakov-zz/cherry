<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Http\Response;
use Zend\Navigation\Service\ConstructedNavigationFactory;


class WalletController extends AbstractActionController
{

    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;


    public function indexAction()
    {

    }


    /**
     * Deposit action
     */
    public function depositAction() 
    {
    	$authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
        $player = $authService->getIdentity();

        // get the currency by name
        $currency = $this->getEntityManager()
                         ->getRepository('Application\Entity\Currency')
                         ->findOneBy(array('name' => "EUR"));

        // get the real money wallet
        $wallet = $this->getEntityManager()
                       ->getRepository('Application\Entity\Wallet')
                       ->findOneBy(array('player' => $player, "currency" => $currency));


        $form = new \Application\Form\DepositForm();
        $request = $this->getRequest();

        if($request->isPost()) 
        {
            $transaction = new \Application\Entity\Transaction;
            $transaction->setWallet($wallet);
            $transaction->setAmount( (double)$this->getRequest()->getPost('amount'));
            $transaction->setType(\Application\Entity\Transaction::TYPE_DEPOSIT);
            $transaction->setComment("added by the player");
            $transaction->setCreatedAt(new \DateTime);

            $this->getEntityManager()->persist($transaction);
            $this->getEntityManager()->flush();

            return $this->redirect()->toRoute('account');
        }

        return new ViewModel(array(
            'form' => $form
        ));
    }



    public function withdrawAction() 
    {

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