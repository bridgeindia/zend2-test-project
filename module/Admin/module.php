<?php

/*
 * module file for the Admin module
 * created by Sethu on Dec 1, 2012
 */
namespace Admin;

use Admin\Model\Category;
use Admin\Model\CategoryTable;
use Admin\Model\Employee;
use Admin\Model\EmployeeTable;
use Admin\Form\EmployeeForm;
use Admin\Model\MessagesTable;
use Admin\Model\Messages;
use Admin\Form\SendMailForm;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module
{
    public function getAutoloaderConfig()
    {
	  
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
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
            'factories' => array(
                'Admin\Model\CategoryTable' =>  function($sm) {
                    $tableGateway = $sm->get('CategoryTableGateway');
                    $table = new CategoryTable($tableGateway);
                    return $table;
                },
                'CategoryTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Category());
                    return new TableGateway('category', $dbAdapter, null, $resultSetPrototype);
                },
                 'Admin\Model\EmployeeTable' =>  function($sm) {
                    $tableGateway = $sm->get('EmployeeTableGateway');
                    $table = new EmployeeTable($tableGateway);
                    return $table;
                },
                'EmployeeTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Employee());
                    return new TableGateway('employee', $dbAdapter, null, $resultSetPrototype);
                },
                 'Admin\Form\EmployeeForm' => function ($sm){
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $tableGateway = new TableGateway('category' , $dbAdapter);
                    $form = new EmployeeForm();
                    $form->initFromDb( $tableGateway);
                    return $form;
                 }, 
                 'Admin\Form\SendMailForm' => function ($sm){
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $tableGatewayEmp = new TableGateway('employee' , $dbAdapter);
                     $tableGatewayCat = new TableGateway('category' , $dbAdapter);
                     $form = new SendMailForm();
                     $form->initFromDb ($tableGatewayEmp , $tableGatewayCat);
                     return $form;
                 },
                 'Admin\Model\MessagesTable' =>  function($sm) {
                    $tableGateway = $sm->get('MessagesTableGateway');
                    $table = new MessagesTable($tableGateway);
                    return $table;
                },
                'MessagesTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Messages());
                    return new TableGateway('messages', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }
}
?>
