<?php

/*
 * to check the working time of an employee
 * created on  14-Dec 2012
 * 
 */
namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class CheckinController extends AbstractActionController
{
    public function checkInAction()
    {
        $time_in = time();
        echo $time_in;
        exit;
    }
    
    public function checkOutAction( $time_in )
    {  
        $time_out = time();
        $working_hours = $time_out- $time_in;
        echo $working_hours;
        exit;
    }
}
?>
