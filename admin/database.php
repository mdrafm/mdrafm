<?php
   
   class Database{
        
      private $db_host = 'localhost';
       private $db_user = 'root';
       private $db_pass = 'MdR@6%&!#$1';
       private $db_name = 'mdrafm';
       private $mysqli = '';
       
       private $result = array();
       private $conn = false;

       public function __construct(){

          if(!$this->conn){

            $this->mysqli = new mysqli($this->db_host, $this->db_user, $this->db_pass,$this->db_name);
            $this->conn = true;

            if($this->mysqli->connect_error){
                array_push($this->result, $this->mysqli->connect_error);
                return false;
            }
          }else{
              return true;
          }
              
       }

       //function to insert in database

       public function insert($table, $params = array()){
           if($this->tableExists($table)){
              
            //print_r($params);
            $table_columns = implode(', ', array_keys($params));
            $table_values = implode('#', $params);
           // print_r($table_columns);
           // print_r($table_values);
            $result_string = "'".str_replace("#","','",$table_values)."'";
             $sql = "INSERT INTO $table ($table_columns) VALUES ($result_string)";
            //  echo $sql;
            //  exit;
            if($this->mysqli->query($sql)){
                array_push($this->result, $this->mysqli->insert_id);
                array_push($this->result, "added successfully");
                return true;
            }else{
                array_push($this->result, $this->mysqli->error);
                return false;
            }
           }
       }

       //direct insert sql is 
       public function insert_sql($sql){
        $query = $this->mysqli->query($sql);
        if($query){
                array_push($this->result, $this->mysqli->insert_id);
                array_push($this->result, "added successfully");
                return true;
        }else{
            array_push($this->result,$this->mysqli->error);
            return false;
        }
       }

       //function to update in Database

       public function update($table, $params = array(),$where=null){
            if($this->tableExists($table)){
                 $args = array();
                 foreach($params as $key => $value){
                     $args[] = "$key = '$value'";
                 }
                $sql = "UPDATE $table SET ". implode(', ', $args);
                if($where != null){
                    $sql .= " WHERE $where";
                }
               //echo $sql; exit;
                if($this->mysqli->query($sql)){
                    array_push($this->result, $this->mysqli->affected_rows);
                    array_push($this->result, "update successfully");
                    return true;
                }else{
                    array_push($this->result, $this->mysqli->error);
                    return false;
                }

            }else{
                return false;
            }
       }

       public function update_dir($sql){
       
            
          // echo $sql; 
            if($this->mysqli->query($sql)){
                array_push($this->result, $this->mysqli->affected_rows);
                array_push($this->result, "update successfully");
                return true;
            }else{
                array_push($this->result, $this->mysqli->error);
                return false;
            }

   }

       //function to delete in Database

       public function delete($table,$where=null){
             
        if($this->tableExists($table)){

            $sql = "DELETE FROM $table ";

            if($where != null){
                $sql .= "WHERE $where";
            }
            
            if($this->mysqli->query($sql)){
                array_push($this->result,"success");
                return true;
            }else{
                array_push($this->result, $this->mysqli->error);
                return false;
            }
            
        }else{
                return false;
            }
       }

       //function to select form database in database
       public function select($table,$rows="*",$join=null,$where=null,$order=null,$limit=null){
           if($this->tableExists($table)){
              $sql = "SELECT $rows FROM $table";
              if($join != null){
                  $sql .= "$join";
              }
              if($where != null){
                $sql .= " WHERE  $where";
              }
                if($order != null){
                    $sql .= " ORDER BY $order";
              }
                if($limit != null){
                    $sql .= " LIMIT 0, $order";
              }

            //echo $sql;
            $query = $this->mysqli->query($sql);
            if($query){
                $this->result = $query->fetch_all(MYSQLI_ASSOC);
                return true;
            }else{
                array_push($this->result,$this->mysqli->error);
                return false;
            }
           }else{
               return false;
           }
       }
       

       public function select_sql($sql){
       
        $query = $this->mysqli->query($sql);
        if($query){
            $this->result = $query->fetch_all(MYSQLI_ASSOC);
            return true;
        }else{
            array_push($this->result,$this->mysqli->error);
            return false;
        }
       }

       public function select_one($table,$rows,$id){
        $sql = "SELECT $rows FROM $table WHERE id = $id";
        //echo $sql;
        $query = $this->mysqli->query($sql);
        if($query){
            $this->result = $query->fetch_all(MYSQLI_ASSOC);
            return true;
        }else{
            array_push($this->result,$this->mysqli->error);
            return false;
        }
       }

       //function to check table in database
        private function tableExists($table){
           // echo $table;
            $sql = "SHOW TABLES FROM $this->db_name LIKe '$table' ";
            $tableInDb = $this->mysqli->query($sql);
            if($tableInDb->num_rows == 1){
                return true;
            }else{
                array_push($this->result, $table."doesnot exists in database");
                return false;
            }
        }

        //function to show result array

        public function getResult(){
            $val = $this->result;
            $this->result = array();
            return $val;
        }

       //close connection to database
       public function __destruct(){
         if($this->conn){
            if($this->mysqli->close()){
                $this->conn = false;
                return true;
            }
         }else{
             return false;
         }
       }
   }

?>