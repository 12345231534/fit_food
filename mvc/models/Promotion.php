<?php
require_once("BaseModel.php");
class Promotion extends BaseModel{
    private $table = 'promotions';
    function getAllPromotion(){
        return $this->select_array($this->table, "*");
    }
    public function addPromotion($dataArray){
        $query = $this->add($this->table, $dataArray);
        if($query){ return true;}
        else return false;
    }
    public function findPromotion($id){
        $query = "select * from $this->table where id =$id";
        return $this->returnData($this->_query($query));
    }
    public function deletePromotion($id){
        $res = $this->delete($this->table, ['id' => $id]);
        if($res){
            return true;
        }
        return false;
    }
    function getPromotionDetails($id){
        $query = "select * from $this->table where id =$id";
        return $this->returnData($this->_query($query));
    }
     function getPromotionsLimit($a, $b){

        $data = array();
        $data = $this->select_array($this->table, '*', NULL ,  'created_at', $a, $b);
      
        return $data;
    }
    function getPromotionsCount(){
        $query = "SELECT count(id) as count FROM promotions ";
        $data = $this->returnData($this->_query($query));
        return $data;
    }
}