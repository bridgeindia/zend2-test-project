<?php

/*
 * Form to add employee details
 */
namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Admin\Model\CategoryTable;
use Zend \Db\TableGateway\Tablegateway;

class EmployeeForm extends Form
{
    public function __construct($name= null)
    {
        parent::__construct('admin');
        $this->setAttribute('method', 'post');
        
        
        $this->add(array(
            'name' => 'emp_id',
            'attributes' => array(
                'type' => 'hidden',
            ),
            
        ));
        $this->add(array(
            'name' => 'emp_name',
            'attributes' => array(
                'type' => 'text',
            ),
            'options'=> array(
                'label' => 'Employee Name',
            ),
        ));
        $this->add(array(
            'name' => 'emp_mail',
            'attributes' => array(
                'type' => 'email',
            ),
            'options' => array(
                'label' => 'Employee email'
                )
        ));
        $this-> add(array(
            'name' => 'emp_address',
            'attributes' => array(
                'type' => 'textarea'
            ),
            'options' => array(
                'label' => 'Address'
            )
        ));
        $this->add(array(
            'name' => 'emp_state',
            'attributes' => array(
                'type' => 'text'
            ),
            'options' => array(
                'label'=> 'State'
                )
        ));
        $this->add(array(
            'name' => 'emp_country',
            'attributes' => array(
                'type' => 'text'
            ),
            'options' => array(
                'label'=> 'Country'
                )
        ));
        $this->add(array(
            'name' => 'emp_zip',
            'attributes' => array(
                'type' => 'text'
            ),
            'options' => array(
                'label'=> 'Zipcode'
                )
        ));
        $this->add(array(
            'name' => 'emp_phone',
            'attributes' => array(
                'type' => 'text'
            ),
            'options' => array(
                'label'=> 'Phone Number'
                )
        ));
        $this->add(array(
            'name' => 'emp_category',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'options' => array(
                )
            ),
            'options' => array(
                'label'=> 'Select Category',
                
                )
        ));
        $this->add(array(
            'name' => 'emp_desig',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'options' => array(
                    'Junior software developer' => 'Junior software developer',
                    'Senior PHP' => 'Senior PHP',
                ),
            ),
            'options' => array(
                'label'=> 'Employee Designation',
                ),
        ));
        $this->add(array(
            'name' => 'emp_desc',
            'attributes' => array(
                'type' => 'textarea'
            ),
            'options' => array(
                'label'=> 'Description',
                )
        ));
        $this->add(array(
            'name' => 'emp_resume',
            'attributes' => array(
                'type' => 'file'
            ),
            'options' => array(
                'label'=> 'Add resume',
                )
        ));
        $this->add(array(
            'name' => 'emp_username',
            'attributes' => array(
                'type' => 'text'
            ),
            'options' => array(
                'label'=> 'Username',
                )
        ));
        $this->add(array(
            'name' => 'emp_password',
            'attributes' => array(
                'type' => 'password'
            ),
            'options' => array(
                'label'=> 'Password',
                )
        ));
        $this->add(array(
            'name' => 'Empsub',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Add Employee',
                'id' => 'NewEmp',
            )
        ));
    }
    
    /*
     * to load the values from DB
     */
    public function initFromDb($tableGateway)
    {
        $catObj  = new CategoryTable($tableGateway);
        $resultSet = $catObj->fetchAll();
        $options = array();
        if ( $resultSet ){
                foreach ($resultSet as $result)  {
                    $options[0]            = '---Select---';
                    $options[$result['id']] = $result['category'];
                } 
                $this->get('emp_category')->setAttribute('options', $options);
                $this->get('emp_category')->setAttribute('class', 'cat');
                
            }
    }
    
}
?>
  