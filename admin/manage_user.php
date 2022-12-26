<?php
include 'database.php';
$db = new Database();

 $sql = "SELECT id,name,phone FROM `tbl_faculty_master` WHERE id != 5";
 $db->select_sql($sql);
 foreach($db->getResult() as  $row){
   print_r($row);
   $id= $row['id'];
  
   $phone = $row['phone'];
   $newstring = substr($row['phone'], -4);
   $usename = $row['phone'];
   $pass = "Mdrafm@".$newstring;
   $psw = trim($pass);
   $encryptedpass = password_hash($psw,PASSWORD_BCRYPT);
   //echo $psw;exit;

   $insert_sql = "INSERT INTO tbl_user (roll_id,username,name,password) VALUES ( 9,'$phone','$id','$encryptedpass' ) " ;
   //echo $insert_sql;
   //$db->insert_sql($insert_sql);
 }


?>