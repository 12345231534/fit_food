<?php
require_once("BaseModel.php");
require_once "./mvc/core/redirect.php";


class User extends BaseModel{
    private $table = 'users';

    public function login($username, $password){
        $query = "SELECT * from $this->table  WHERE username = '" . $username . "' AND password = '" . $password . "' AND status = 1";
        $user = $this->returnData($this->_query($query));
        if($user!=NULL && $user){
            return $user;
        }
        else{
            return NULL;
        }
        
    }
    public function updateUser($id, $dataArray){
        $res = $this->update($this->table, $dataArray, ['id' => $id]);
        if($res){
            return true;
        }
        return false;
    }
    public function findUser($id){
        $query = "select * from $this->table where id =$id";
        return $this->returnData($this->_query($query));
    }
    public function deleteUser($id){
        $res = $this->delete($this->table, ['id' => $id]);
        if($res){
            return true;
        }
        return false;
    }
    public function getAllUser( $orderby = NULL){
        // $query = "select * from $this->table ORDER BY $orderby DESC ";
        $data = $this->select_array($this->table, '*', NULL, $orderby);
        return $data;
    }


    public function addUser($dataArray){
        $query = $this->add($this->table, $dataArray);
        if($query){ return true;}
        else return false;
    }

    public function getUsersCount($auth_id){
        $query = "SELECT COUNT(id) as count FROM $this->table WHERE auth_id = $auth_id";
        return $this->returnData($this->_query($query));
    }
   
}