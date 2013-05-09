<?php

/*
 * to manage internal mssages
 */
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Form\SendMailForm;
use Admin\Model\MessageTable;
use Admin\Model\Messages;

class MessageController extends AbstractActionController
{
    protected $messagesTable;
    
    public function inboxAction()
    {
        
    }
    
    public function sentItemsAction()
    {
        return new ViewModel(array(
            'sentItems' => $this->getMessageTable()->fetchAll( $id = 1 ),
        ));;
    }
    
    public function sendAction()
    {
        $form = new SendMailForm();
        $form = $this->getServiceLocator()->get('Admin\Form\SendMailForm');
        $request= $this->getRequest();
        if($request->isPost()){
            $this->sendMessage($form, $request);
        }
        return array(
            'form' => $form
        );
    }
    /*
     * to send mail to employees in a particular category
     */
    public function sendToCategoryAction()
    {
        $form = new SendMailForm();
        $form = $this->getServiceLocator()->get('Admin\Form\SendMailForm');
        $request= $this->getRequest();
        if($request->isPost()){
            $this->sendMessage($form, $request);
        }
        return array(
            'form' => $form
        );
    }
    /*
     * to send the message to person/category
     */
    public function sendMessage($form, $request)
    {
        $message = new Messages();
        $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $form->setInputFilter($message->getInputFilter());
        $form->setData($request->getPost());

        if($form->isValid()){
            $data = $form->getData();
            $message->exchangeArray($form->getData());
            $this->getMessageTable()->saveMail($message, $dbAdapter);
            return $this->redirect()->toRoute('message');
        }
    }
    
    public function getMessageTable()
    {
        if(!$this->messagesTable){
            $sm = $this->getServiceLocator();
            $this->messagesTable = $sm->get('Admin\Model\MessagesTable');
        }
        return $this->messagesTable;
    }
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        /*
        
        
        
        
            //to get the emp details with this id
            $tableGateway = $this->getServiceLocator()->get('EmployeeTableGateway');
            $empObj = new EmployeeTable($tableGateway);
            $emp_details = $empObj->getEmployee($id);
                        
            $to   = $emp_details->emp_mail;
            
            
            
        
    }
//    
    public function sendMail()
    {
        $message = new Message();
        $message->addTo($to)
                ->addFrom('shlachu@gmail.com')
                ->setSubject($sub)
                ->setBody($body);

        $transport = new SmtpTransport();
        $options =  new SmtpOptions (array (
                'name' => 'gmail',
                'host' => 'smtp.gmail.com',
                'port' => 465,
                'connectionClass' => 'login',
                'connectionConfig' => array(
                    'ssl' => 'ssl',
                    'username' => 'shlachu@gmail.com',
                    'password' => '*****'
                )));
        $transport->setOptions($options);
        $transport->send($message);
        return $this->redirect()->toRoute('mail');
    }*/
}
?>
