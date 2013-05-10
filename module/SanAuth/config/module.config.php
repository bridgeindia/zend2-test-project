<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'SanAuth\Controller\Auth' => 'SanAuth\Controller\AuthController',
            'SanAuth\Controller\Dashboard' => 'SanAuth\Controller\DashboardController'
        ),
    ),
    'router' => array(
        'routes' => array(
            
            'login' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/login',
                    'defaults' => array(
                        '__NAMESPACE__' => 'SanAuth\Controller',
                        'controller'    => 'Auth',
                        'action'        => 'login',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'process' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:action]',
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
            
            'dashboard' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/home',
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
                            'route'    => '/[:action]',
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
            
        ),
    ),
	
	 'service_manager' => array(
        'Zend\Authentication\AuthenticationService' => function($sm) {
            $authService = new \Zend\Authentication\AuthenticationService();
            $authService->setStorage(new \Zend\Authentication\Storage\Session('user', 'details'));

            return $authService;
        },
    ),
	
    'view_manager' => array(
        'template_path_stack' => array(
            'SanAuth' => __DIR__ . '/../view',
        ),
    ),
    'controller_plugins' => array(
	    'invokables' => array(
	       'AuthPlugin' => 'SanAuth\Controller\Plugin\AuthPlugin',
	     )
	 ),
);
