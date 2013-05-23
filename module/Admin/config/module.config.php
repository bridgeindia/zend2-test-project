<?php

/*
 * the congig file for Admin module
 * 
 */
return array(
    'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Category' => 'Admin\Controller\CategoryController',
            'Admin\Controller\Employee' => 'Admin\Controller\EmployeeController',
            'Admin\Controller\Message' => 'Admin\Controller\MessageController',
			'Admin\Controller\Index' => 'Admin\Controller\IndexController'
        ),
    ),
	
	'router' => array(
        'routes' => array(
		
		'admin' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/admin',
                    'defaults' => array(
                        'controller' => 'SanAuthAdmin\Controller\Auth',
                        'action'     => 'login',
                    ),
                ),
            ),
		
		
		'adminhome' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/admin/home',
                   
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
		
		
            'category' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/admin/category[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Category',
                        'action'     => 'index',
                    ),
                ),
            ),
			
			'aboutus' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/aboutus[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Category',
                        'action'     => 'index',
                    ),
                ),
            ),
			
            'employee' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/admin/employee[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Employee',
                        'action'     => 'index',
                    ),
                ),
            ),
			
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
			),		
			
            'message' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/admin/message[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Message',
                        'action'     => 'send',
                    ),
                ),
            ),
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
            'admin/index/index' => __DIR__ . '/../view/admin/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
?>
