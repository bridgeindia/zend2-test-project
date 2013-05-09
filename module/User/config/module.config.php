<?php

/*
 * config file for user module
 * created on 14-dec 2012
 */
return array(
    'controllers' => array(
        'invokables' => array(
            'User\Controller\Checkin' => 'User\Controller\CheckinController',
            
        ),
    ),
	
	'router' => array(
        'routes' => array(
            'checkin' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/checkin[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'User\Controller\Checkin',
                        'action'     => 'index',
                    ),
                ),
            ),
            
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'user' => __DIR__ . '/../view',
        ),
    ),
);
?>
