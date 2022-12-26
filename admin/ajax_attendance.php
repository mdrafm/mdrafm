<?php
include 'database.php';
   $db = new Database();

  //print_r($_POST);
  $user_id = $_POST['user_id'];
  $session_no = $_POST['session_no'];
  $program_id = $_POST['program_id'];
  $timeTable_id = $_POST['timeTable_id'];

  $tableData = stripcslashes($_POST['tableData']);
 
// Decode the JSON array
  $tableData = json_decode($tableData,TRUE);
   
  foreach($tableData as $data){
      //print_r($data);
      $attendance=  isset($data['attandance'])?'1':'0' ;
      if(isset($data['trainee_id']) && $data['trainee_id'] > 1){
        $db->update('tbl_attendance',["present"=>$attendance],"id=".$data['trainee_id']);
        $res1 = $db->getResult();
        echo "#success";
      }else{
        $sql = "INSERT INTO `tbl_attendance` ( `program_id`, `time_tbl_id`, `session_no`, `name`, `email`, `phone`, `present`, `taken_by`, `status`) 
        VALUES ( '$program_id','$timeTable_id','$session_no','".$data['name']."','".$data['email']."','".$data['phone']."','".present."','$user_id', '1');";
        $db->insert_sql($sql);
        $res = $db->getResult();
        echo "success";
      }
    
   
     

  }

  
  
?>