<?php
require_once("BaseModel.php");
class Collection extends BaseModel{
    private $table = 'collections';
     function getAllCollection(){
        return $this->select_array($this->table, "*");
    }
    public function addCollection($dataArray){
        $query = $this->add($this->table, $dataArray);
        if($query){ return true;}
        else return false;
    }
    public function findCollection($id){
        $query = "select * from $this->table where id =$id";
        return $this->returnData($this->_query($query));
    }
    public function deleteCollection($id){
        $res = $this->delete($this->table, ['id' => $id]);
        if($res){
            return true;
        }
        return false;
    }
     public function updateCollection($id, $dataArray){
        $res = $this->update($this->table, $dataArray, ['id' => $id]);
        if($res){
            return true;
        }
        return false;
    }
    function getCollectionDetails($id){
        $query = $this->select_row($this->table,'*', ['id' =>  $id]);
        return $this->returnData($query);
    }
     function getCollectionsLimit($a, $b){

        $data = array();
        $data = $this->select_array($this->table, '*', NULL ,  'created_at', $a, $b);
      
        return $data;
    }
    function getCollectionsCount(){
        $query = "SELECT count(id) as count FROM collections ";
        $data = $this->returnData($this->_query($query));
        return $data;
    }
}