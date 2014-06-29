<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Http\Response;
use Zend\Navigation\Service\ConstructedNavigationFactory;


class ProfileController extends AbstractActionController
{

    public function indexAction()
    {
        $authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
        $player = $authService->getIdentity();

        $form = new \Application\Form\PlayerForm(); 
        $form->bind($player);

        return new ViewModel(array(
            'form' => $form,
            'player' => $player
        ));
    }


    public function editAction() 
    {
    	$id = (int)$this->getEvent()->getRouteMatch()->getParam('id');
        $player = $this->getEntityManager()->find('Application\Entity\Player', $id);

        $form = new \Application\Form\PlayerForm();
        $form->setBindOnValidate(false);
        $form->bind($player);
        $form->get('submit')->setAttribute('label', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->post());
            if ($form->isValid()) {
                $form->bindValues();
                $this->getEntityManager()->flush();

                return $this->redirect()->toRoute('profile');
            }
        }
    }



}