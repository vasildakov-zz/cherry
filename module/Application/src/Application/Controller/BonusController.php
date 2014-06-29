<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Http\Response;
use Zend\Navigation\Service\ConstructedNavigationFactory;


class BonusController extends AbstractActionController
{
    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;


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



	// bonus listing
    public function indexAction()
    {
    	$bonuses = $this->getEntityManager()->getRepository('Application\Entity\Bonus')->findAll();

    	return new ViewModel(array(
            'bonuses' => $bonuses,
        ));
    }
}