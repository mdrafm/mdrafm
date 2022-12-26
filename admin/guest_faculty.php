<?php
 
 
 include 'database.php';
 
 $db = new Database();
   
 $db->select("tbl_guest_subject","id,subject_name",null,null,null,null);
 //$db->select_sql("SELECT gf.id as details_id , fm.id as master_id FROM `tbl_guest_faculty_details` gf JOIN `tbl_faculty_master` fm ON  gf.name =fm.name");
 $res = $db->getResult();
 
 
 foreach($res as $row){

   //print_r($row);

      $sql = "UPDATE `tbl_guest_faculty` SET subject = '".$row['id']."'  WHERE  subject = '".$row['subject_name']."' ";
      $db->update_dir($sql);
      //echo $sql;
    // print_r($row['name_desig_faculties']);
     //$arr = explode(',',$row['name_desig_faculties']);
      //echo($arr['0']);
      // $sql_guest = "SELECT id,name FROM tbl_faculty_master WHERE name = '".$arr['0']."' AND role=2 ";
      // $db->select_sql($sql_guest);
      // $res2 = $db->getResult();
      // foreach($res2 as $row2){
      //  // echo $row2['id'].'<br>';
      //   $sql3 = "UPDATE `tbl_guest_faculty` SET name_desig_faculties = '".$row2['id']."'  WHERE  id = '".$row['id']."' ";
      //   $db->update_dir($sql3);
      //   //echo $sql3.'<br>';
      // }

     // echo $sql_guest;
     //exit;
     //print_r($row);
      //exit;
     //array_shift($arr);
    // $arr2 = implode(" , ",$arr);
     //$sql = "UPDATE `tbl_guest_faculty` SET guest_faculty_id = '".$row['master_id']."'  WHERE  guest_faculty_id = '".$row['details_id']."' ";
    // echo '<br>';
   // $sql = "INSERT INTO `tbl_staf_master` (`type`,`name`,`desig`,`address`,`phone`,`email`,`image`) VALUES ( 2 ,'".$row['name']."','".$row['desig']."','".$row['address']."','".$row['phone']."','".$row['email']."','".$row['image']."')";
     // echo $sql; 
     //$db->update_dir($sql);
    // exit;
    // $res = $db->getResult();
    // print_r($res);

 }

 ?>