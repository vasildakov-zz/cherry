<?php


namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Http\Response;

class AuthenticationController extends AbstractActionController
{

    protected $authservice;


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


    public function indexAction()
    {
        return $this->redirect()->toRoute('login');
    }


    public function loginAction()
    {
        $authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
        $adapter = $authService->getAdapter();

        // redirect if user has identity
        if ( $authService->getIdentity() ){
            return $this->redirect()->toRoute("account");
        }


    	$form = new \Application\Form\LoginForm();
    	$request = $this->getRequest();

    	if($request->isPost()) {

    		$form->setData($request->getPost());

            // set identity and credential
            $adapter->setIdentityValue($request->getPost('email'));
            $adapter->setCredentialValue(md5($request->getPost('password')));
            
            // authenticate
            $authResult = $adapter->authenticate();

            if ($authResult->isValid()) {

                $identity = $authResult->getIdentity();
                $authService->getStorage()->write($identity);

                $loggedUser = $authService->getIdentity();
                #var_dump($loggedUser); 
                #exit();

                #$this->session = new Container('login_session');
                #$this->session->username = $authResult->getIdentity()->getUsername();

                // the redirect must be determined by user role
                return $this->redirect()->toRoute('account');
            }

            $this->flashMessenger()->addMessage('Invalid username or password!' );
    	}


    	return new ViewModel(array(
            'form' => $form,
            'messages'  => $this->flashMessenger()->getMessages(),
        ));
    }


    
    public function registerAction() 
    {
    	return new ViewModel();
    }


    public function logoutAction() 
    {
        $authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');

        $user = $authService->getIdentity();

        $authService->clearIdentity();
        return $this->redirect()->toRoute('login');
    }


    /**
     * @return Zend\Authentication\AuthenticationService
     */
    public function getAuthService() 
    {
        if (!$this->authservice) {
            $this->authservice = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
        }
        return $this->authservice;
    }
}
