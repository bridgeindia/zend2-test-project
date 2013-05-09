<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $e->getApplication()->getServiceManager()->get('translator');
        $eventManager        = $e->getApplication()->getEventManager();
        $serviceManager     = $e->getApplication()->getServiceManager();               
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    /** 
     * Store session in database
     * 
     * @param type $e
     */
    private function initDbSession( $e )
    {
        // grab the config array
        $serviceManager     = $e->getApplication()->getServiceManager();
        $config             = $serviceManager->get('config');
        $dbAdapter          = $serviceManager->get('Zend\Db\Adapter\Adapter');
        $saveHandler   = new \My\Session\SaveHandler\Mysql( $config['db'] );
                
        $sessionConfig = new SessionConfig();
        $sessionConfig->setOptions($config['session']);
                
        // pass the saveHandler to the sessionManager and start the session
        $sessionManager = new \Zend\Session\SessionManager( $sessionConfig , NULL, $saveHandler );
        $sessionManager->start();
                
        Container::setDefaultManager($sessionManager);        
    }
}
