<?php

/*
 * Controller file for adding, editing, deleting 
 * and viewing the categories
 */
namespace Onestop\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
 use Onestop\Model\Contactmodel;  
use Onestop\Form\ContactForm;

class IndexController extends AbstractActionController
{
	protected $cochinTable;

    public function indexAction()
    {
	  $auth  = $this->getServiceLocator()
                 ->get('AuthService')->hasIdentity();
				 
       if (! $this->getServiceLocator()
                 ->get('AuthService')->hasIdentity()){
            return $this->redirect()->toRoute('login');
        }  
		
		$this->layout()->auth = $auth;
		
		
	return new ViewModel( array(
        'auth' => $auth,
    ));
      // return new ViewModel();
    }
	
	public function contactusAction()
    {
         
        $form = new ContactForm();
		return array('form' => $form);
    }
	public function aboutusAction()
	{
		return new ViewModel();
	}
    public function sendAction()
    {
        $form = new ContactForm();
		$request = $this->getRequest();
		
		
       if($request->isPost())
        {
		  $contact = new Contactmodel();
		  $form->setInputFilter($contact->getInputFilter());
          $form->setData($request->getPost());
		  
		  
			if($form->isValid())
            {
			  $postData = $request->getPost();
			  print_r($postData);exit;
			      $email    = $postData->email;
				  $body     = $postData->feedback;
				  $subject  = "VPS cash test feedback";
				  
				  $message = new Message();
				  $message->addFrom("info@vpscash.com", "VPS")
		        ->addTo($email)
		        ->setSubject("VPS Cash feedback");
		        $message->setBody($body);
				
				$transport = new SendmailTransport();
				
				 $sent = true;
				 try {
				  $transport->send($message);
				 }
				 catch (Exception $e) {
				  $sent = false;
				 }
				if($sent==true)
				{
					//$this->view->sucessMessage = "Your feedback has been sent";
					$this->flashMessenger()->addMessage('Thank you for your comment!');
					 //set flash message
                    return $this->redirect()->toRoute('thankyou');
					
					
					  
				}
				else
				{
				    $this->flashMessenger()->addMessage('There has been a problem sending your feedback. Please try again later!');
					return $this->redirect()->toRoute('failure');
					//$this->flashMessenger()->addMessage('There has been a problem sending your feedback. PLeas try again later');
					
				}
		 
			}
			
		
		}
		return array('form' => $form);
    }
   
}

?>
