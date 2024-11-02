<?php
require_once("BaseModel.php");
class Order extends BaseModel{
    private $table = 'orders';

    public function addOrder($dataArray){
        $query = $this->add($this->table, $dataArray);
        if($query){ return true;}
        else return false;
    }
    public function findOrder($id){
        $query = "select * from $this->table where id =$id";
        return $this->returnData($this->_query($query));
    }
    public function deleteOrder($id){
        $res = $this->delete($this->table, ['id' => $id]);
        if($res){
            return true;
        }
        return false;
    }
 
    function getAllOrder(){
        return $this->select_array($this->table, "*");
    }

    public function updateOrder($id, $dataArray){
        $res = $this->update($this->table, $dataArray, ['id' => $id]);
        
        if($res){
            return true;
        }
        return false;
    }

    function getUncompletedOrderscount(){
        $query = "SELECT count(id) as count FROM $this->table  WHERE status = 0 ";
        $data = $this->returnData($this->_query($query));
        return $data;
    }
    function getMonthlyRevenue($month){
        $query = "SELECT SUM(total_price) as count FROM orders WHERE MONTH(created_at) = $month And status = 1";
        $data = $this->returnData($this->_query($query));
        return $data;
    }
    function getYearlyRevenue($year){
        $query = "SELECT SUM(total_price) as count FROM orders WHERE YEAR(created_at) = $year And status = 1";
        $data = $this->returnData($this->_query($query));
        return $data;
    }
}