<?php

class DB{

    protected $con;
    protected $servername = "localhost";
    protected $username = "root";
    protected $password = "";
    protected $dbname = "fitfood";


    function __construct(){
        $this->con = mysqli_connect($this->servername, $this->username, $this->password);
        mysqli_select_db($this->con, $this->dbname);
        mysqli_query($this->con, "SET NAMES 'utf8'");
    }
  

     function where_not_in($fields = NULL, $array = NULL,$is_where = false){
        $qr ='';
        $string_where = ' where ';
        $id_array = array_values($array);
        $values = implode(',',$id_array);
        if ($fields != NULL && $array != NULL) {
            if ($is_where == true) {
                $string_where = ' and';
            }
            $qr .= $string_where.' '.$fields.'  not in ('.$values.')';
        }
        return $qr;
    }
    function join_table($table = NULL , $query_join = NULL,$type_join = NULL){
        $qr = '';
        if ($table != NULL && $query_join != NULL && $type_join != NULL) {
            $qr .= ' '.$type_join.' JOIN ' .$table .' '.'ON '.$query_join;
        }
        return $qr;
    }
    function where_in($fields = NULL, $array = NULL,$is_where = false){
        $qr ='';
        $string_where = ' where ';
        $id_array = array_values($array);
        $values = implode(',',$id_array);
        if ($fields != NULL && $array != NULL) {
            if ($is_where == true) {
                $string_where = ' and';
            }
            $qr .= $string_where.' '.$fields.'   in ('.$values.')';
        }
        return $qr;
    }
  

}

?>
