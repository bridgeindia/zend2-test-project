<?php

/*
 * To add category details
 */
namespace Admin\Form;

use Zend\Form\Form;

class CategoryForm extends Form
{
    public function __construct($name= null)
    {
        parent::__construct('admin');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden',
            ),
            
        ));
        $this->add(array(
            'name' => 'category',
            'attributes' => array(
                'type' => 'text',
            ),
            'options'=> array(
                'label' => 'Category Name',
            ),
        ));
        $this->add(array(
            'name' => 'CatSub',
            'attributes' => array(
                'type' => 'submit',
            ),
            'options' => array(
                'label' => 'Add category',
                'id' => 'NewCat',
            ),
        ));
    }
    
    
}
?>
