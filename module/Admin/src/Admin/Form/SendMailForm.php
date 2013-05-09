<?php

/*
 * to send individual mail
 */
namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Admin\Model\EmployeeTable;
use Admin\Model\CategoryTable;
use Zend\Db\TableGateway\TableGateway;

class SendMailForm extends Form
{
    public function  __construct($name = null)
    {
        parent::__construct('admin');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'mail_to_receiver',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'options' => array(
             )),
             'options' => array(
                 'label' => 'Select Employee'
             )
            
        ));
        $this->add(array(
            'name' => 'mail_to_category',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'options' => array(
             )),
             'options' => array(
                 'label' => 'Select Category'
             )
            
        ));
        $this->add(array(
            'name' => 'mail_subject',
            'attributes' => array(
                'type' => 'text'
            ),
            'options' => array(
                'label' => 'Subject'
            )
        ));
        $this->add(array(
            'name' => 'mail_content',
            'attributes' => array(
                'type' => 'textarea'
            ),
            'options' => array(
                'label' => 'Body'
            )
        ));
        $this->add(array(
            'name' => 'mail_send',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Send'
            ),
            
        ));
    }
    /*
     * to load values from DB
     */
    public function initFromDb($tableGatewayEmp , $tableGatewayCat)
    {
        //creating the obj of employeetable
        $empObj = new EmployeeTable($tableGatewayEmp);
        $resultSet = $empObj->fetchAll();
        
        $options = array();
        
        if($resultSet){
            foreach ($resultSet as $result){
                $options[0]  =  '---Select---';
                $options[$result['emp_id']]  =  $result['emp_name'];
            }
            $this->get('mail_to_receiver')->setAttribute('options', $options);
        }
        
        $this->fetchCategory($tableGatewayCat);
    }
    /*
     * to fetch all the category list
     * @param $tablegateway
     */
    public function fetchCategory($tableGatewayCat)
    {
        $catObj  = new CategoryTable($tableGatewayCat);
        $results = $catObj->fetchAll();
        $option = array();
        if ( $results ){
                foreach ($results as $result)  {
                    $option[0]            = '---Select---';
                    $option[$result['id']] = $result['category'];
                } 
                $this->get('mail_to_category')->setAttribute('options', $option);
            }
    }
}
?>
