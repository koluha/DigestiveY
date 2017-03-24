<?php 
class UserIdentity extends CUserIdentity
{
    private $_id;
    public function authenticate()
    {
        $record=UserModel::model()->findByAttributes(array('username'=>$this->username));
        if ($record===null){
        $record=UserModel::model()->findByAttributes(array('mail'=>$this->username));
        }
        
        if($record===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if(!CPasswordHelper::verifyPassword($this->password,$record->password))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
        {
            $this->_id=$record->id;
           // $this->setState('title', $record->title);
            $this->errorCode=self::ERROR_NONE;
        }
        return !$this->errorCode;
    }
 
    public function getId()
    {
        return $this->_id;
    }
    
}