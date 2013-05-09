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
            'Admin\Controller\Message' => 'Admin\Controller\MessageController'
        ),
    ),
	
	'router' => array(
        'routes' => array(
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
        'template_path_stack' => array(
            'admin' => __DIR__ . '/../view',
        ),
    ),
);
?>
