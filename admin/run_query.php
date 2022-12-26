<?php 
  
  include 'database.php';
  $db = new Database();

  $select_faculty =  $db->select('tbl_faculty_master',"name,email,phone ",null,"id != 1 ",null,null);
  $select_faculty_res = $db->getResult() ;

  foreach($select_faculty_res as $faculty){
      //print_r($faculty);

      $name = $faculty['name'];
      $username = $faculty['phone'];
      $email = $faculty['email'];
      $newstring = substr($faculty['phone'], -5);
      $pass = "Mdrafm@".$newstring;
      $psw = trim($pass);

      $encryptedpass = password_hash($psw,PASSWORD_BCRYPT);

      $insert_sql = "INSERT INTO tbl_user (roll_id,username,name,email,password) VALUES ( 9,'$username','$name','$email','$encryptedpass' ) " ;
      
      $db->insert_sql($insert_sql);

      $res = $db->getResult();
      if($res){
        echo "success";
      }else{
        echo "error";
      }
	//echo $insert_sql;exit;


  }

  ?>