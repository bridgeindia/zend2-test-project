<?php
namespace Admin\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Where;
use Zend\Db\Sql\Sql;
use Zend\Db\Adapter\Adpater;
use Admin\Model\Messages;


class MessagesTable 
{

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) 
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll( $id ) 
    {
        
        $resultSet = $this->tableGateway->select(array('mail_sender_id' => $id));
        return $resultSet; 
    }

    public function saveMail(Messages $message, $dbAdapter) 
    {
        $data = array(
            'mail_subject' => $message->mail_subject,
            'mail_body' => $message->mail_body,
            'mail_sender_id' => 1,
            'timestamp' => date("Y-m-d H:i:s"),
        );
        $this->tableGateway->insert($data);
        $mail_id = $this->tableGateway->getLastInsertValue();
        //for personal message
        if($message->receiver_id){
            $this->saveReceiver($mail_id , $message->receiver_id, $dbAdapter);
        }
        else if($message->receiver_category_id){
            $this->saveReceiverFromCategory($mail_id , $message->receiver_category_id, $dbAdapter);
        }
        
    }
    /*
     * to insert the single user
     * @params 
     * $mail_id - last inserted value of message
     * $receiver_id -  the receiver's id
     */
    public function saveReceiver($mail_id , $receiver_id, $dbAdapter)
    {
        $sql = new Sql($dbAdapter);
        $insert = new Insert('message_receivers');
        //the inser query
        $insert->values(array(
            'mail_id' => $mail_id ,
            'receiver_id' => $receiver_id
        ));
        $query = $sql->prepareStatementForSqlObject( $insert );
        $query->execute();
    }
    /*
     * to insert thr users from the given category
     * @params mail id, category id, dbadapter
     */
    public function saveReceiverFromCategory($mail_id , $cat_id , $dbAdapter)
    {
        
        $sql    = new Sql($dbAdapter);
        $select = new Select('employee');
        $insert = new Insert('message_receivers');
        $select->columns(array('emp_id'));
        $select->where(array('emp_category' => $cat_id));
        
        $query  = $sql->prepareStatementForSqlObject($select);
        $user_ids = $query->execute();
        
        //toget the all users of that category
        foreach ($user_ids as $user){
           $insert->values(array(
              'mail_id' => $mail_id,
               'receiver_id' => $user['emp_id']
           ));
           $query = $sql->prepareStatementForSqlObject( $insert );
           $query->execute();
        }
       
    }

}

?>
