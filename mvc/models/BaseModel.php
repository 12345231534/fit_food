<?php
    class BaseModel extends DB{
        
        function returnData($query){
            $data = null;
            if($query){
                $data = array();
                while ($row = mysqli_fetch_assoc($query)) {
                    $data = $row;
                }
            }
            return $data;
            // return mysqli_fetch_assoc($query);
        }
        function select_array($table, $data = '*',
            $where = NULL,
            $orderby = NULL,
            $start = NULL,
            $limit = NULL,
            $fields_in = NULL,
            $array_where_in = NULL,
            $fields_not_in = NULL,
            $array_where_not_in = NULL
        ){
            $sql ="SELECT $data FROM $table";
            $query = NULL;
            if (isset($where) && $where != NULL) {

                $fields = array_keys($where);
                $fields_list = implode("",$fields);
                
                $values = array_values($where);
                $isFields = true;
                $stringWhere = 'where';
                $string_Caculator = '=';
                $stringBindParam = "";
                foreach($values as $row){
                    $stringBindParam = $stringBindParam . substr((string)gettype($row), 0, 1);
                }
                for ($i=0; $i < count($fields); $i++) { 
                    
                    preg_match('/<=|>=|<|>|!=/',$fields[$i],$matches,PREG_OFFSET_CAPTURE);
                    if ($matches != null) {
                        $string_Caculator = $matches[0][0];
                    }
                    if (!$isFields) {
                        $sql .= " and ";
                        $stringWhere = '';
                    }
                    $isFields = false;
                    $sql .= "  ".$stringWhere." ".preg_replace('/<=|>=|<|>|!=/','',$fields[$i])." ".$string_Caculator." ? ";
                }
                if ($fields_in != NULL && $array_where_in != NULL) {
                    $sql .= ' '.$this->where_in($fields_in,$array_where_in,true).' ';
                }
                if ($fields_not_in != NULL && $array_where_not_in != NULL) {
                    $sql .= ' '.$this->where_not_in($fields_not_in,$array_where_not_in,true).' ';
                }
                if ($orderby !='' && $orderby != NULL) {
                    $sql .= " ORDER BY ".$orderby."";
                }
                if ($limit != NULL) {
                    $sql .= " LIMIT ".$start." , ".$limit."";
                }
                
                $query = $this->con->prepare($sql);
                $query->bind_param($stringBindParam, $fields);
                $query->execute();
                $result = $query->get_result(); // Lấy kết quả từ câu lệnh đã thực hiện
                $data = array();
                while ($row = $result->fetch_assoc()) {
                    
                    $data[] = $row;
                }
                return $data;
            }
            else{
                if ($orderby !='' && $orderby != NULL) {
                    $sql .= " ORDER BY ".$orderby."";
                }
                if ($limit != NULL) {
                    $sql .= " LIMIT ".$start." , ".$limit."";
                }
                $query = $this->con->query($sql);
            }

            $data = null;
            if($query){
                $data = array();
                while ($row = mysqli_fetch_assoc($query)) {
                    $data[] = $row;
                }
            }
            
            return $data;
        }
        function add($table, $data = NULL){
            $fields = array_keys($data);
            $fields_list = implode(",",$fields);
            $values = array_values($data);
            $newValues = array_map(function($value){
                if(is_string($value)){
                    return "'".$value."'";
                }
                else {
                    return $value;
                }
            }, $values);
     
            $newValues = implode(',', $newValues);
            $sql = "INSERT INTO `".$table."`(".$fields_list.") VALUES ($newValues)";
            $query = $this->con->query($sql);
            
            return $query;
        }
        function update($table, $data = NULL,$where = NULL){
            if ($data != NULL && $where != NULL) {
                $fields = array_keys($data);
                $values = array_values($data);
                $where_array = array_keys($where);
                $value_where = array_values($where);
                $sql ="UPDATE $table SET ";
                $isFields = true;
                $isFields_where = true;
                $stringWhere = 'where';
                $string_Caculator = '=';
                for ($i=0; $i < count($fields); $i++) { 
                    if (!$isFields) {
                        $sql .= ", ";
                    }
                    $isFields = false;
                    $sql .= "".$fields[$i]." =?";
                }
                for ($i=0; $i < count($where_array); $i++) {
                    preg_match('/<=|>=|<|>/',$where_array[$i],$matches,PREG_OFFSET_CAPTURE);
                    if ($matches != null) {
                        $string_Caculator = $matches[0][0];
                    
                    } 
                    if (!$isFields_where) {
                    $sql .= " and ";
                    $stringWhere = '';
                    }
                $isFields_where = false;
                $sql .= "  ".$stringWhere." ".preg_replace('/<=|>=|<|>/','',$where_array[$i])." ".$string_Caculator." '".$value_where[$i]."'";
                }
                $query = $this->con->prepare($sql);
                if ($query->execute($values)) {
                    return true;
                }
                else{
                    return false;
                    // return json_encode(
                    //     array(
                    //         'type'      => 'fails',
                    //         'Message'   => 'Update data fails',
                    //     )
                    // );
                }
            }
        }
        function delete($table, array $where = NULL){
            $sql = "DELETE FROM  $table ";
            if ($where != NULL) {
            $where_array = array_keys($where);
            $value_where = array_values($where);
            $isFields_where = true;
            $stringWhere = 'where';
            $string_Caculator = '=';
                for ($i=0; $i < count($where_array); $i++) { 
                    preg_match('/<=|>=|<|>/',$where_array[$i],$matches,PREG_OFFSET_CAPTURE);
                    if ($matches != null) {
                        $string_Caculator = $matches[0][0];
                    }
                    if (!$isFields_where) {
                        $sql .= " and ";
                        $stringWhere = '';
                    }
                    $isFields_where = false;
                    $sql .= "" .$stringWhere." ".preg_replace('/<=|>=|<|>/','',$where_array[$i])." ".$string_Caculator." ?";
                }
                $query = $this->con->prepare($sql);
                if ($query->execute($value_where)) {
                    return true;
                }
                else{
                    return false;
                }
            }
        }
        function select_row($table, $data='*', $where){
            $sql ="SELECT $data FROM $table ";
            if ($where != NULL) {
                $key_where = array_keys($where);
                $value_where = array_values($where);
                $isFields_where = true;
                $stringWhere = 'where';
                for ($i=0; $i < count($key_where); $i++) { 
                    if (!$isFields_where) {
                        $sql .= " and ";
                        $stringWhere = '';
                    }
                    $isFields_where = false;
                    $sql .= "" .$stringWhere." ".$key_where[$i]." = ?";
                }
                $query = $this->con->query($sql);
                return $query;
                
            }
        }
        function select_max_fields($table, $data = '',$where = NULL){
            if ($data != '') {
                $sql = "SELECT MAX(".$data.") as sort FROM $table ";
            }
            if ($where != NULL) {
                $where_array = array_keys($where);
                $value_where = array_values($where);
                $isFields_where = true;
                $stringWhere = 'where';
                for ($i=0; $i < count($where_array); $i++) { 
                    if (!$isFields_where) {
                        $sql .= " and ";
                        $stringWhere = '';
                    }
                    $isFields_where = false;
                    $sql .= "" .$stringWhere." ".$where_array[$i]." = ?";
                }
                $query = $this->con->prepare($sql);
                $query->execute($value_where);
            }
            $query = $this->con->query($sql);
            return $query->fetch_assoc();
        }

        function _query($query){
            $sql = $query;
            $query = $this->con->query($sql);
            return $query;
        }
        // ============================================================================
        function select_array_where_not_in($table,$data = '*',$where = NULL,$fields_not_in = NULL,$array_where_not_in = NULL,$orderby = NULL,$start = NULL,$limit = NULL){
            $sql ="SELECT $data FROM $table";
            if (isset($where) && $where != NULL) {
                $fields = array_keys($where);
                $fields_list = implode("",$fields);
                $values = array_values($where);
                $isFields = true;
                $stringWhere = 'where';
                $stringBindParam = "";
                foreach($values as $row){
                    $stringBindParam = $stringBindParam . substr(gettype($row), 0, 1);
                }
                for ($i=0; $i < count($fields); $i++) { 
                    if (!$isFields) {
                    $sql .= " and ";
                    $stringWhere = '';
                    }
                $isFields = false;
                $sql .= "  ".$stringWhere." ".$fields[$i]." = ? ";
                }
                if ($fields_not_in != NULL && $array_where_not_in != NULL) {
                    $sql .= ' '.$this->where_not_in($fields_not_in,$array_where_not_in,true).' ';
                }
                if ($limit != NULL) {
                    $sql .= " LIMIT ".$start." , ".$limit."";
                }
                if ($orderby !='' && $orderby != NULL) {
                    $sql .= " ORDER BY ".$orderby."";
                }
                $query = $this->con->prepare($sql);
                $query->execute($values);
            }
            else{
                if ($fields_not_in != NULL && $array_where_not_in != NULL) {
                    $sql .= ' '.$this->where_not_in($fields_not_in,$array_where_not_in).' ';
                }
                if ($orderby !='' && $orderby != NULL) {
                    $sql .= " ORDER BY ".$orderby."";
                }
                if ($limit != NULL) {
                    $sql .= " LIMIT ".$start." , ".$limit."";
                }
                $query = $this->con->query($sql);
            }
            return $query->fetch_assoc();
        }
        // JOIN TABLE
        function select_array_join_table($table, $table_join = NULL ,  $query_join = NULL,
            $type_join  = 'LEFT', $data = '*',
            $where = NULL,
            $orderby = NULL,
            $start = NULL,
            $limit = NULL,
           
            ){
            $sql ="SELECT $data FROM $table";
            $query = NULL;
            if (isset($where) && $where != NULL) {
                $fields = array_keys($where);
                $fields_list = implode("",$fields);
                $values = array_values($where);
                $isFields = true;
                if ($table_join != NULL && $query_join != NULL && $type_join != NULL) {
                    $sql .= ' '.$this->join_table($table_join,$query_join,$type_join).' ';

                }
                $stringWhere = 'where';
                $stringBindParam = "";
                foreach($values as $row){
                    $stringBindParam = $stringBindParam . substr(gettype($row), 0, 1);
                }
                for ($i=0; $i < count($fields); $i++) { 
                    if (!$isFields) {
                    $sql .= " and ";
                    $stringWhere = '';
                    }
                $isFields = false;
                $sql .= "  ".$stringWhere." ".$fields[$i]." = ? ";
                }
                if ($limit != NULL) {
                    $sql .= " LIMIT ".$start." , ".$limit."";
                }
                if ($orderby !='' && $orderby != NULL) {
                    $sql .= " ORDER BY ".$orderby."";
                }
                $query = $this->con->prepare($sql);
                $query->bind_param($stringBindParam, $fields);
                $query->execute();
                $result = $query->get_result(); // Lấy kết quả từ câu lệnh đã thực hiện
                $data = array();
                while ($row = $result->fetch_assoc()) {
                    
                    $data[] = $row;
                }
                return $data;
      
            }
            else{
                if ($table_join != NULL && $query_join != NULL && $type_join != NULL) {
                    $sql .= ' '.$this->join_table($table_join,$query_join,$type_join).' ';
                }
                if ($orderby !='' && $orderby != NULL) {
                    $sql .= " ORDER BY ".$orderby."";
                }
                if ($limit != NULL) {
                    $sql .= " LIMIT ".$start." , ".$limit."";
                }
                $query = $this->con->query($sql);
            }
            return $query->fetch_assoc();
        }
        function addMultiple($table, $data){
            if ($data != NULL){
                $fields = array_keys($data[0]);
                $fields_list = implode(",",$fields);
                $qr = str_repeat("?,", count($fields) - 1);
                $sql = "INSERT INTO `".$table."` (".$fields_list.") VALUES";
                $values = [];
                foreach($data as $key => $val){
                    $fields_for = array_keys($val);
                    $fields_list_for = implode(",",$fields_for);
                    $qr_for = str_repeat("?,", count($fields_for) - 1);
                    if (count($data) - 1 > $key) {
                        $sql .= " (${qr_for}?),";
                    }
                    else
                    {
                        $sql .= " (${qr_for}?) ";
                    }
                    $values = array_merge($values, array_values($val));
                }
        
                $query = $this->con->prepare($sql);
                if ($query->execute($values)) {
                    return 
                    array(
                        'type'      => 'sucessFully',
                        'Message'   => 'Insert data success',
                    );
                }
                else{
                    return 
                    array(
                        'type'      => 'fails',
                        'Message'   => 'Insert data fails',
                    );
                }
            }
        }
        // 
        function select_array_join_multi_table($table, $data = '*',
            $where = NULL,
            $orderby = NULL,
            $start = NULL,
            $limit = NULL,
            $joinTable = []
        ){
            $sql ="SELECT $data FROM $table";
            if (isset($where) && $where != NULL) {
                $fields = array_keys($where);
                $fields_list = implode("",$fields);
                $values = array_values($where);
                $isFields = true;
                foreach ($joinTable as $key => $value) {
                $sql .= ' '.$this->join_table(trim($value[0]),trim($value[1]),trim($value[2])).' ';
                }
            
                $stringWhere = 'where';
                for ($i=0; $i < count($fields); $i++) { 
                    if (!$isFields) {
                    $sql .= " and ";
                    $stringWhere = '';
                    }
                $isFields = false;
                $sql .= "  ".$stringWhere." ".$fields[$i]." = ? ";
                }
                if ($limit != NULL) {
                    $sql .= " LIMIT ".$start." , ".$limit."";
                }
                if ($orderby !='' && $orderby != NULL) {
                    $sql .= " ORDER BY ".$orderby."";
                }
                $query = $this->con->prepare($sql);
                $query->execute($values);
            }
            else{
                foreach ($joinTable as $key => $value) {
                $sql .= ' '.$this->join_table(trim($value[0]),trim($value[1]),trim($value[2])).' ';
                }
                if ($orderby !='' && $orderby != NULL) {
                    $sql .= " ORDER BY ".$orderby."";
                }
                if ($limit != NULL) {
                    $sql .= " LIMIT ".$start." , ".$limit."";
                }
                $query = $this->con->query($sql);
            }
            return $query->fetch_assoc();
        }
    
    }
?>