<?php
require_once("BaseModel.php");
class Banner extends BaseModel{
    private $table = 'banners';
    function getAllBanner(){
        return $this->select_array($this->table, "*");
    }
    public function addBanner($dataArray){
        $query = $this->add($this->table, $dataArray);
        if($query){ return true;}
        else return false;
    }
    public function findBanner($id){
        $query = "select * from $this->table where id =$id";
        return $this->returnData($this->_query($query));
    }
    public function deleteBanner($id){
        $res = $this->delete($this->table, ['id' => $id]);
        if($res){
            return true;
        }
        return false;
    }
     public function updateBanner($id, $dataArray){
        $res = $this->update($this->table, $dataArray, ['id' => $id]);
        if($res){
            return true;
        }
        return false;
    }
    function getBannerDetails($id){
        $query = $this->select_row($this->table,'*', ['id' =>  $id]);
        return $this->returnData($query);
    }
     function getBannersLimit($a, $b){

        $data = array();
        $data = $this->select_array($this->table, '*', NULL ,  'created_at', $a, $b);
      
        return $data;
    }
    function getBannersCount(){
        $query = "SELECT count(id) as count FROM banners ";
        $data = $this->returnData($this->_query($query));
        return $data;
    }
}