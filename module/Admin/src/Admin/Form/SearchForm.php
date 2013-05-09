<?php
/*
 * to search an employee with name or category
 */

namespace Admin\Form;

use Zend\Form\Form;

class SearchForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('admin');
        $this->setAttribute('method', 'post');
        
        $this->add(array(
            'name' => 'search_name',
            'attributes' => array(
                'type' => 'text'
            ),
            'options' => array(
                'label' => 'Name'
            )
        ));
        
        $this->add(array(
            'name' => 'search_category',
            'attributes' => array(
                'type' => 'text'
            ),
            'options' => array(
                'label' => 'Category',
            )
        ));
        
        $this->add(array(
            'name' => 'search_sub',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Search',
                'id' => 'search_sub'
            )
        ));
    }
}