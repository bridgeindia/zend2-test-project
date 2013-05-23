<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'SanAuthAdmin\Controller\Auth' => 'SanAuthAdmin\Controller\AuthController',
            'SanAuthAdmin\Controller\Dashboard' => 'SanAuthAdmin\Controller\DashboardController'
        ),
    ),
    'router' => array(
        'routes' => array(
            
            'adminlogin' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/admin/login',
                    'defaults' => array(
                        '__NAMESPACE__' => 'SanAuthAdmin\Controller',
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
				
				
				'adminhome' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/adminhome',
                    'defaults' => array(
                        '__NAMESPACE__' => 'admin\Controller',
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
            'SanAuthAdmin' => __DIR__ . '/../view',
        ),
    ),
    'controller_plugins' => array(
	    'invokables' => array(
	       'AuthPlugin' => 'SanAuthAdmin\Controller\Plugin\AuthPlugin',
	     )
	 ),
);
