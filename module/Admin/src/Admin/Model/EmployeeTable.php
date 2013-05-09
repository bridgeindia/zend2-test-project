<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Admin\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class EmployeeTable 
{

    protected $tableGateway;

    //public $name;

    public function __construct(TableGateway $tableGateway) 
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }
    /**
     *
     * @param type $id
     * @return type 
     */
    public function getEmployee($id) 
    
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('emp_id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveEmployee(Employee $employee)
    {
        $data = array(
            'emp_id' => $employee->emp_id,
            'emp_name' => $employee->emp_name,
            'emp_mail' => $employee->emp_mail,
            'emp_address' => $employee->emp_address,
            'emp_state' => $employee->emp_state,
            'emp_country' => $employee->emp_country,
            'emp_phone' => $employee->emp_phone,
            'emp_zip' => $employee->emp_zip,
            'emp_category' => $employee->emp_category,
            'emp_desig' => $employee->emp_desig,
            'emp_desc' => $employee->emp_desc,
            'emp_resume' => $employee->emp_resume,
            'emp_username' => $employee->emp_username,
            'emp_password' => md5($employee->emp_password),
        );

        $id = (int) $employee->emp_id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getEmployee($id)) {
                $this->tableGateway->update($data, array('emp_id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deleteEmployee($id) 
    {
        $this->tableGateway->delete(array('emp_id' => $id));
    }

    public function searchEmployee($name = null, $category = null) 
    {
        $resultset = $this->tableGateway
                    ->select(function (Select $select) use ($name,$category){
                        $select->where->like('emp_name', '%' . $name . '%');
    
                    });
        return $resultset;
    }

}

?>
