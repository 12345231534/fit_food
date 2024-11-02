<?php 
class Authorization extends controller{
    private $UserModel;
    function __construct(){
         $this->UserModel  = $this->model('UserModel');
    }
    function checkAuth($fields){
        $id = $fields['id'];
        $username = $fields['username'];
        $checkUS = $this->UserModel->select_array('*',['id' => $id,'username' => $username]);
        if ($checkUS != NULL && count($checkUS) > 0) {
            return true;
        }
        else{
            return false;
        }
    }
     function checkAuthUser($array){
        $id = $array['id'];
        $username = $array['username'];
        $checkUS = $this->AccountsModel->select_array('*',['id' => $id,'username' => $username]);
        if ($checkUS != NULL && count($checkUS) > 0) {
            return true;
        }
        else{
            return false;
        }
    }
}