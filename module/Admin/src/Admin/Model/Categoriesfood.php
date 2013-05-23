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
        
class Categoriesfood implements InputFilterAwareInterface
{
    public $id;
    public $categoryName;
    protected $inputFilter;
    
	 
    public function exchangeArray($data)
    {
        $this->id     = (isset($data['id'])) ? $data['id'] : null;
        $this->categoryName     = (isset($data['categoryName'])) ? $data['categoryName'] : null;
       
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
