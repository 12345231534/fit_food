<?php
require_once("BaseModel.php");
class Product extends BaseModel{
    private $table = 'products';


    function getProductDetails($id){
        $query = "select * from $this->table where id =$id";
        return $this->returnData($this->_query($query));
    }
     function getProductsLimit($a, $b){
        $data = array();
        $data = $this->select_array($this->table, '*', NULL ,  'created_at', $a, $b);

        return $data;
    }
    function getProductsCount(){
        $query = "SELECT count(id) as count FROM products";
        $data = $this->returnData($this->_query($query));
        return $data;
    }
    public function updateProduct($id, $dataArray){
        $res = $this->update($this->table, $dataArray, ['id' => $id]);
        if($res){
            return true;
        }
        return false;
    }

    public function addProduct($dataArray){
        $query = $this->add($this->table, $dataArray);
        if($query){ return true;}
        else return false;
    }
    public function findProduct($id){
        $query = "select * from $this->table where id =$id";
        return $this->returnData($this->_query($query));
    }
    public function deleteProduct($id){
        $res = $this->delete($this->table, ['id' => $id]);
        if($res){
            return true;
        }
        return false;
    }
    public function getAllProduct( $orderby = NULL){
        // $query = "select * from $this->table ORDER BY $orderby DESC ";
        $data = $this->select_array($this->table, '*', NULL, $orderby);
        return $data;
    }
}