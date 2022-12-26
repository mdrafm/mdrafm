<?php
include('../../admin/database.php');
$db = new Database();

$pos = array_search("action",array_keys($_POST));
  $frm_data = array_splice($_POST,0,$pos);

  
if(isset($_POST['action']) && $_POST['action'] == 'add_master'){
      
    $update_id =$_POST['update_id'];
    $table = $_POST['table'];
   
     //update
    if ($update_id != '' ){
     
       $db->update($table, $frm_data,'id='.$update_id);
       $res = $db->getResult();
      
        if($res){
            echo "success#".$res[1];
        }
        else{
         
          echo "error#".$res[0];
        }
        
    }
    //add
    else{
     // echo 123;
    // print_r($frm_data);
        $db->insert($table, $frm_data);

       $res = $db->getResult();
       //print_r($res);
      if($res){
          echo "success#".$res[1];
      }
      else{
        //print_r($db->getResult());
        echo "error#".$res[0];
      }
    }
    
  }

  if(isset($_POST['action']) && $_POST['action'] == 'remove_case'){
    $case_id = $_POST['case_id'];
    $table = $_POST['table'];

    $db->update($table, ["status" => 0 ],'id='.$case_id);
    $res = $db->getResult();
   // print_r($res);
    if($res){
        echo "success#".$res[1];
    }
    else{
        //print_r($db->getResult());
        echo "error#".$res[0];
    }
  }
?>