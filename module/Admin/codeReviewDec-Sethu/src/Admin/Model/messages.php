<?php

/*
 * input filter for messages table
 */
namespace Admin\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;

class messages implements InputFilterAwareInterface
{
    public $mail_id;
    public $mail_subject;
    public $mail_body;
    public $mail_sender_id;
    public $receiver_category_id;
    public $timestamp;
    public $receiver_id;
    protected $InputFilter;
    
    public function exchangeArray($data)
    {
        
        $this->mail_id               =  (isset($data['mail_id'])) ? $data['mail_id'] : null;
        $this->mail_subject          =  (isset($data['mail_subject'])) ? $data['mail_subject'] : null;
        $this->mail_body             =  (isset($data['mail_content'])) ? $data['mail_content'] : null;
        $this->mail_sender_id        =  (isset($data['mail_sender_id'])) ? $data['mail_sender_id'] : null;
        $this->receiver_id           =  (isset($data['mail_to_receiver'])) ? $data['mail_to_receiver'] : null;
        $this->receiver_category_id  =  (isset($data['mail_to_category'])) ? $data['mail_to_category'] : null;
        
    }
    
    public function getArrayCopy()
    {
        return get_object_vars($data);
    }
    
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception ('Not Used');
    }
    
    public function getInputFilter()
    {
        if(!$this->InputFilter){
            $InputFilter = new InputFilter();
            $factory     = new InputFactory();
            
            $InputFilter->add($factory->createInput(array(
                'name'     => 'mail_to_receiver',
                'required' => false,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' =>'StringTrim'),
                ),
                
            )));
            $this->InputFilter = $InputFilter;
        }
        return $this->InputFilter;
    }
}
?>
