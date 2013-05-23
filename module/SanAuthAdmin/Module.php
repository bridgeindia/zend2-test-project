<?php
//module/SanAuthAdmin/Module.php

namespace SanAuthAdmin;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Mvc\MvcEvent;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;

class Module implements AutoloaderProviderInterface,
                        ConfigProviderInterface
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $eventManager->attach('dispatch', array($this, 'loadConfiguration'), 2);
    }
    
    public function loadConfiguration(MvcEvent $e)
    {
        $application   = $e->getApplication();
        $sm            = $application->getServiceManager();
        $sharedManager = $application->getEventManager()->getSharedManager();

        $sharedManager->attach('Zend\Mvc\Controller\AbstractActionController','dispatch',
            function($e) use ($sm) {
                $sm->get('ControllerPluginManager')->get('AuthPlugin')
                   ->authenticate($e); //pass to the plugin...   
            }
        );
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
		    // if we're in a namespace deeper than one level we need to fix the \ in the path
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/' , __NAMESPACE__),
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    public function getServiceConfig()
    {
        return array(
	
	// setting db config immediately if necessary, ignore if already defined in global.php    
	//   'db' => array(
	//	'username' => 'YOUR USERNAME HERE',
	//	'password' => 'YOUR PASSWORD HERE',
	//	'driver'         => 'Pdo',
	//	'dsn'            => 'mysql:dbname=zf2tutorial;host=localhost',
	//	'driver_options' => array(
	//	    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
	//	),
	//    ),
	    
            'factories'=>array(
//		 'Zend\Db\Adapter\Adapter'
  //                  => 'Zend\Db\Adapter\AdapterServiceFactory',
		
		'SanAuthAdmin\Model\MyAuthStorage' => function($sm){
		    return new \SanAuthAdmin\Model\MyAuthStorage('zf_tutorial');  
		},
		
		'AuthService' => function($sm) {
		    $dbAdapter      = $sm->get('Zend\Db\Adapter\Adapter');
            $dbTableAuthAdapter  = new DbTableAuthAdapter($dbAdapter, 'users','user_name','pass_word', 'MD5(?)');
		    
		    $authService = new AuthenticationService();
		    $authService->setAdapter($dbTableAuthAdapter);
		    $authService->setStorage($sm->get('SanAuthAdmin\Model\MyAuthStorage'));
		     
		    return $authService;
		},
            ),
        );
    }

}
