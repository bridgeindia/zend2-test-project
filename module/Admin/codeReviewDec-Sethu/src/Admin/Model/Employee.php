<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Admin\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
        
class Employee implements InputFilterAwareInterface
{
    public $emp_id;
    public $emp_name;
    public $emp_mail;
    public $emp_address;
    public $emp_state;
    public $emp_country;
    public $emp_zip;
    public $emp_phone;
    public $emp_category;
    public $emp_desig;
    public $emp_desc;
    public $emp_resume;
    public $emp_username;
    public $emp_password;
    protected $inputFilter;
    
	 
    public function exchangeArray($data)
    {
        $this->emp_id     = (isset($data['emp_id'])) ? $data['emp_id'] : null;
        $this->emp_name     = (isset($data['emp_name'])) ? $data['emp_name'] : null;
        $this->emp_mail     = (isset($data['emp_mail'])) ? $data['emp_mail'] : null;
        $this->emp_address     = (isset($data['emp_address'])) ? $data['emp_address'] : null;
        $this->emp_state     = (isset($data['emp_state'])) ? $data['emp_state'] : null;
        $this->emp_country     = (isset($data['emp_country'])) ? $data['emp_country'] : null;
        $this->emp_zip     = (isset($data['emp_zip'])) ? $data['emp_zip'] : null;
        $this->emp_phone     = (isset($data['emp_phone'])) ? $data['emp_phone'] : null;
        $this->emp_category     = (isset($data['emp_category'])) ? $data['emp_category'] : null;
        $this->emp_desig     = (isset($data['emp_desig'])) ? $data['emp_desig'] : null;
        $this->emp_desc     = (isset($data['emp_desc'])) ? $data['emp_desc'] : null;
        $this->emp_resume     = (isset($data['emp_resume'])) ? $data['emp_resume'] : null;
        $this->emp_username     = (isset($data['emp_username'])) ? $data['emp_username'] : null;
        $this->emp_password     = (isset($data['emp_password'])) ? $data['emp_password'] : null;
    }
	
	public function getArrayCopy()
    {
        return get_object_vars($this);
    }

	
	public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                'name'     => 'emp_name',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' =>'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' =>'StringLength',
                        'options' =>array(
                            'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            )));
            $inputFilter->add($factory->createInput(array(
                'name'     => 'emp_mail',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' =>'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' =>'StringLength',
                        'options' =>array(
                            'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            )));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

}
?>
