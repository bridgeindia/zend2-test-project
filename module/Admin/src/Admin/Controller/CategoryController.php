<?php

/*
 * Controller file for adding, editing, deleting 
 * and viewing the categories
 */
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Model\Category;          // <-- Add this import
use Admin\Form\CategoryForm;

class CategoryController extends AbstractActionController
{
	protected $categoryTable;

    public function indexAction()
    {
         return new ViewModel(array(
            'categories' => $this->getCategoryTable()->fetchAll(),
        ));;
        
    }
    // to add category
    public function addAction()
    {
        $form = new CategoryForm();
        $form->get('CatSub')->setValue('Add');
        
        $request = $this->getRequest();
        if($request->isPost())
        {
            $category = new Category();
            $form->setInputFilter($category->getInputFilter());
            $form->setData($request->getPost());
            
            if($form->isValid())
            {
                $category->exchangeArray($form->getData());
                $this->getCategoryTable()->saveCategory($category);
                
                //redirect to list of categories
                return $this->redirect()->toRoute('category');
            }
        }
        return array('form' => $form);
    }
    // to edit category
    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id)
        {
            return $this->redirect->toRoute('category', array('action' => 'add'));
        }
        $category = $this->getCategoryTable()->getCategory($id);
        $form = new CategoryForm();
        $form->bind($category);
        $form->get('CatSub')->setAttribute('value', 'Edit');
        $request = $this->getRequest();
        if($request->isPost())
        {
            $form->setInputFilter($category->getInputFilter());
            $form->setData($request->getPost());
            if($form->isValid())
            {
                $this->getCategoryTable()->saveCategory($form->getData());
                
                //redirect to list of categories
                return $this->redirect()->toRoute('category');
            }
        }
        return array('id'=>$id, 'form' => $form);
    } 
    // to delete the category
    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id' , 0);
        if(!$id)
        {
            return $this->redirect()->toRoute('category');
        }
        $request = $this->getRequest();
        if($request->isPost())
        {
            $del = $request->getpost('del' , 'No');
            if($del == 'Yes')
            {
                $id = (int) $request->getPost('id');
                $this->getCategoryTable()->deleteCategory($id);
            }
            //redirect to listing
            return $this->redirect()->toRoute('category');
        }
        return array(
            'id' =>$id ,
            'category' =>$this->getCategoryTable()->getCategory($id)
        );
    }
    
    public function getCategoryTable()
    {
        if (!$this->categoryTable) {
            $sm = $this->getServiceLocator();
            $this->categoryTable = $sm->get('Admin\Model\CategoryTable');
        }
        return $this->categoryTable;
    }
}

?>
