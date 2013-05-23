<?php
//module/SanAuthAdmin/src/SanAuthAdmin/Controller/SuccessController.php

namespace SanAuthAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class DashboardController extends AbstractActionController
{
    public function indexAction()
    {
        if (! $this->getServiceLocator()
                 ->get('AuthService')->hasIdentity()){
            return $this->redirect()->toRoute('login');
        }
         return new ViewModel();
    }
}