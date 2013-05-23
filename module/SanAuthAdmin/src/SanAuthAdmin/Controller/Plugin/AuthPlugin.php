<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace SanAuthAdmin\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class AuthPlugin extends AbstractPlugin
{
    protected $authservice;
    
    public function authenticate( $e )
    {
        $matches    = $e->getRouteMatch();
        if (! $this->authservice) {
            $this->authservice = $this->getController()->getServiceLocator()
                                      ->get('AuthService');
        }
        if ( $matches->getParam('controller') == 'SanAuthAdmin\Controller\Auth' ){
                return ; 
        }
        //go to login page if not the home page
        if(! $this->authservice->hasIdentity() && $matches->getParam('controller') != 'Application\Controller\Index'){
            header('Location: login');
            exit;
        }
         
        if($this->authservice->hasIdentity()){
            $_SESSION['username'] = $this->authservice->getIdentity();
            
        }
    }
}
?>
