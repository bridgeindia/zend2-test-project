<?php

/*
 * Controller file for adding, editing, deleting 
 * and viewing the employees
 */
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Model\Employee;          
use Admin\Form\EmployeeForm;
//use Admin\Form\SearchForm;

class EmployeeController extends AbstractActionController
{
	protected $employeeTable;
    //protected $categoryTable;

    public function indexAction()
    {
        return new ViewModel(array(
            'employees' => $this->getEmployeeTable()->fetchAll(),
        ));
        
    }
    // to add employees
    public function addAction()
    {
        $form = new EmployeeForm();
        $form = $this->getServiceLocator()->get('Admin\Form\EmployeeForm');
       // $form->get('Empsub')->setValue('Add');
        
        $request = $this->getRequest();
        if($request->isPost())
        {
            $employee = new Employee();
            $form->setInputFilter($employee->getInputFilter());
            $form->setData($request->getPost());
            
            if($form->isValid())
            {
                $employee->exchangeArray($form->getData());
                $this->getEmployeeTable()->saveEmployee($employee);
                
                //redirect to list of employees
                return $this->redirect()->toRoute('employee');
            }
        }
        return array('form' => $form);
    }
    // to edit employee
    public function editAction()
    {
        $emp_id = (int) $this->params()->fromRoute('id', 0);
        if (!$emp_id)
        {
            return $this->redirect()->toRoute('employee', array('action' => 'add'));
        }
        $employee = $this->getEmployeeTable()->getEmployee($emp_id);
        $form = new EmployeeForm();
        $form = $this->getServiceLocator()->get('Admin\Form\EmployeeForm');
        $form->bind($employee);
        $form->get('Empsub')->setAttribute('value', 'Edit');
        $request = $this->getRequest();
        if($request->isPost())
        {
            $form->setInputFilter($employee->getInputFilter());
            $form->setData($request->getPost());
            if($form->isValid())
            {
                $this->getEmployeeTable()->saveEmployee($form->getData());
                
                //redirect to list of employees
                return $this->redirect()->toRoute('employee');
            }
        }
        return array('emp_id'=>$emp_id, 'form' => $form);
        
    } 
    // to delete the employee
    public function deleteAction()
    {
        $emp_id = (int) $this->params()->fromRoute('id' , 0);
        if(!$emp_id)
        {
            return $this->redirect()->toRoute('employee');
        }
        $request = $this->getRequest();
        if($request->isPost())
        {
            $del = $request->getPost('del' , 'No');
            if($del == 'Yes')
            {
                $emp_id = (int) $request->getPost('emp_id');
                $this->getEmployeeTable()->deleteEmployee($emp_id);
            }
            //redirect to listing
            return $this->redirect()->toRoute('employee');
        }
        return array(
            'emp_id' =>$emp_id ,
            'employee' =>$this->getEmployeeTable()->getEmployee($emp_id)
        );
    }
    // to search the employee
    public function searchAction()
    {
        //$form = new SearchForm();
        
        $request = $this->getRequest();
        if($_REQUEST)
        {
            //if($form->isValid())
            //{
                $name = $_REQUEST['search_name'];
                //$category = $_REQUEST['search_category'];
                return new viewModel(array(
                    'search_results' => $this->getEmployeeTable()->searchEmployee($name)
                ));
            //}
            
        }
    }
    
    public function getEmployeeTable()
    {
        if (!$this->employeeTable) {
            $sm = $this->getServiceLocator();
            $this->employeeTable = $sm->get('Admin\Model\EmployeeTable');
            }
        return $this->employeeTable;
    }
    /*
    public function fetchCategory()
    {
        $sm = $this->getServiceLocator();
        $categoryTableGateway = $sm->get('CategoryTableGateway');
        $this->categoryTable = $sm->get('Admin\Model\CategoryTable');
        $categoryObj = new CategoryTable($categoryTableGateway);
        
        return new ViewModel(array(
            'categories' => $this->categoryTable->fetchAll(),
        ));
        
    }*/
}
?>
