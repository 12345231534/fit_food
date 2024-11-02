<?php
require_once("model.php");
class Cart extends BaseModel{
    const TABLE = 'carts';

    function add_to_cart($product_id, $quantity){
        $sql = "INSERT INTO ".self::TABLE." (product_id, quantity) VALUES ($product_id, $quantity) ON DUPLICATE KEY UPDATE quantity = quantity + $quantity";
        return $this->con->query($sql);
    }
}