<?php
include('../admin/database.php');
$db = new Database();
  
   $sql  = "SELECT id,party_name FROM `tbl_gst_case_law`";

   

   $db->select_sql($sql);

   $result = $db->getResult();

   foreach($result as $row){
    //print_r($row);
    $party = explode("Versus", $row['party_name']);
   //  echo "<pre>";
   //  print_r($party);
     // $rule = $row['rules'];
   //   exit;
     $update = " UPDATE `tbl_gst_case_law` SET `petitioner_name` =  '".$party[0]."' ,`opposite_party` =  '".$party[1]."' WHERE `id` = '".$row['id']."' ";
   //  exit;            
     $db->update_dir($update);
     $res = $db->getResult();
    print_r($res);

    // $sql_gst = "SELECT * FROM `tbl_gst_case_law`";

    //   $res = $db->getResult();

    //   foreach($res as $row2){
          
    //   }

   }
?>