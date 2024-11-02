<?php
require_once("BaseModel.php");
class OrderDetail extends BaseModel{
    private $table = 'order_details';

    public function addOrderDetail($dataArray){
        $query = $this->add($this->table, $dataArray);
        if($query){ return true;}
        else return false;
    }
    public function getOrderDetailOfOrder($order_id){
        $data =  $this-> select_array_join_table($this->table, 'products', 'order_details.product_id = products.id', 'LEFT', "*", ['order_id' => $order_id ]);
       
        return $data;

    }
 
    public function deleteOrderDetail($id){
        $res = $this->delete('order', ['id' => $id]);
        if($res){
            return true;
        }
        return false;
    }

    function getAllOrderDetail(){
        return $this->select_array($this->table, "*");
    }
 
    function getUncompletedOrderDetailscount(){
        $query = "SELECT count(id) as count FROM $this->table  WHERE status = 0 ";
        $data = $this->returnData($this->_query($query));
        return $data;
    }
    function getMonthlyRevenue($month){
        $query = "SELECT SUM(total_price) as count FROM orderDetails WHERE MONTH(created_at) = $month And status = 1";
        $data = $this->returnData($this->_query($query));
        return $data;
    }
    function getYearlyRevenue($year){
        $query = "SELECT SUM(total_price) as count FROM orderDetails WHERE YEAR(created_at) = $year And status = 1";
        $data = $this->returnData($this->_query($query));
        return $data;
    }
}