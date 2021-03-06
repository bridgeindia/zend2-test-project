<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
		'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Onestop\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'onestop' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/onestop/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Onestop\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
					
				),
				
				 
				
						
				
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
			
			
			
			
			 'administrator' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/onestop/admin',
                    'defaults' => array(
                        '__NAMESPACE__' => 'SanAuth\Controller',
                        'controller'    => 'Dashboard',
                        'action'        => 'index',
                    ),
                ),
			),	
			
			
			
			 'login' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/onestop/login',
                    'defaults' => array(
                        '__NAMESPACE__' => 'SanAuth\Controller',
                        'controller'    => 'Auth',
                        'action'        => 'login',
                    ),
                ),
			),		
			
			 'contactus' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/onestop/contactus',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Onestop\Controller',
                        'controller'    => 'Index',
                        'action'        => 'contactus',
                    ),
                ),
			),			
			
			
			 'send' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/onestop/contactus/send/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Onestop\Controller',
                        'controller'    => 'Index',
                        'action'        => 'send',
                    ),
                ),
			),			
			
			
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
        ),
		
    ),
	
	 'service_manager' => array(
        'Zend\Authentication\AuthenticationService' => function($sm) {
            $authService = new \Zend\Authentication\AuthenticationService();
            $authService->setStorage(new \Zend\Authentication\Storage\Session('user', 'details'));

            return $authService;
        },
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Onestop\Controller\Index' => 'Onestop\Controller\IndexController'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'onestop/index/index' => __DIR__ . '/../view/onestop/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
