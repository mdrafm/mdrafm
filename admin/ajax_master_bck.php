<?php

  include 'database.php';
    // print_r($_POST);
    
    // exit;
  //   print_r($_FILES);
  //  exit;
  $pos = array_search("action",array_keys($_POST));
  $frm_data = array_splice($_POST,0,$pos);
  //print_r($frm_data); exit;
  if(isset($frm_data['faculty'])){
      unset($frm_data['faculty']);
  }
 
  
   //print_r($frm_data);exit;
  
  $db = new Database();
  //save and update
 if ( isset($_POST['action']) && $_POST['action'] == 'add'){
      
        //  print_r($frm_data);
        //  print_r($_POST);
        //  exit;
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

 
 if ( isset($_POST['action']) && $_POST['action'] == 'edit_verify_time'){
   
  $tbl_id = $_POST['tbl_id'];
   
  // print_r($res);
  // exit;
  //$start_time = $_POST['start_time'];
  $start_time = date("H:i:s", strtotime($_POST['start_time']));
  $end_time  =  date("H:i:s", strtotime($_POST['end_time']));
  if($_POST['period'] =='start_time' ){
      
    $db->select_one('tbl_time_table','session_no,program_id,training_dt',$tbl_id);
    $res = $db->getResult();
    foreach ($res as $row){
      $prev_session = $row['session_no'] -1;
      $next_session = $row['session_no'] + 1;
      
      $prev_start_time = '';
      $prev_end_time ='';
      $next_start_time='';
      $next_end_time='';

      // if($prev_session == 0){
      //   echo "start#This is First class#success";
      //   exit;
      // }
      
      $db->select("tbl_time_table","class_start_time,class_end_time",null,"session_no ='".$prev_session."' AND program_id= '".$row['program_id']."' AND training_dt = '".$row['training_dt']."' ",null,null);
      $res1 = $db->getResult();
      foreach($res1 as $row1){
        $prev_start_time = date("H:i:s", strtotime($row1['class_start_time']));
        $prev_end_time =  date("H:i:s", strtotime($row1['class_end_time']));
        
      }

      $db->select("tbl_time_table","class_start_time,class_end_time",null,"session_no ='".$next_session."' AND program_id= '".$row['program_id']."' AND training_dt = '".$row['training_dt']."' ",null,null);
      $res1 = $db->getResult();
      foreach($res1 as $row1){
        $next_start_time = date("H:i:s", strtotime($row1['class_start_time']));
        $next_end_time =  date("H:i:s", strtotime($row1['class_end_time']));
        
      }
      
      if($start_time < $prev_end_time){
        echo  "start#Class overlaps with previous class :".$prev_start_time." - ".$prev_end_time."#error";
        exit;
      }
      elseif($start_time > $next_start_time){
        echo  "start#Class overlaps with next class :".$next_start_time." - ".$next_end_time."#error";
        exit;
      }
      else{
        echo "start#Valid Class Time#success";
      }
      
      
     
    }
  }
  else{

    if($start_time > $end_time ){
      echo  "end#Class overlaps with previous class :".$start_time."#error";
      
      exit;
    }
  }
 }
 

//Modify time table
if ( isset($_POST['action']) && $_POST['action'] == 'update_time_table'){

  //  print_r($_POST);
  //  print_r($frm_data);
  //  exit;
  $update_id = $_POST['update_id'];
  $now = new DateTime();
  if(isset($frm_data['faculty_id'])){
    $faculty = implode(',', $frm_data['faculty_id']);
    $frm_data['faculty_id'] = $faculty;
}

  
  
  $db->select_one("tbl_time_table","training_dt,session_no,period_type,break_time,class_start_time,class_end_time,faculty_id,paper_id,detail_topic_id,paper_covered,session_type,other_class,class_remark",$update_id);
  $res = $db->getResult();
 //print_r($res);
   if($res){
        foreach($res as $row){
         // $oldTable = $row;
            //$db->select_one("tbl_modifytimetable","time_table_id",$update_id);
            $db->select("tbl_modifytimetable","*",null,"time_table_id='".$update_id."' AND session_no = '".$row['session_no']."' AND training_dt = '".$row['training_dt']."' ",null,null);
              $res1 = $db->getResult();
              
              if($res1){
               
                $update_sql = "UPDATE `tbl_modifytimetable` SET `new_session_no` = '".$frm_data['session_no']."', `new_break_time` = '".$frm_data['break']."', `new_class_start_time` = '".$frm_data['class_start_time']."', `new_class_end_time` ='".$frm_data['class_end_time']."',
                              `new_faculty_id` = '".$frm_data['faculty_id']."', `new_term_id` = '".$frm_data['term_id']."', `new_paper_id` = '".$frm_data['paper_id']."', `new_subject_id` = '".$frm_data['subject_id']."', `new_topic_id`  = '".$frm_data['topic_id']."', `new_detail_topic_id` =  '".$frm_data['dtl_topic']."', `new_paper_covered` = '".$frm_data['paper_covered']."',
                              `new_session_type` = '".$frm_data['session_type']."', `new_other_class` = '".$frm_data['other_class']."', `new_class_remark` = '".$frm_data['class_remark']."' 
                               WHERE time_table_id='".$update_id."' AND session_no = '".$row['session_no']."' and training_dt = '".$row['training_dt']."' ";
                              //echo $update_sql;
                $db->update_dir($update_sql);
                $res3 = $db->getResult();
                //print_r($res3);
                if($res3){
                    echo "success#".$res3[1];
                }
                else{
                  //print_r($db->getResult());
                  echo "error#".$res3[0];
                }

              }else{
                
                $insert_sql = "INSERT INTO `tbl_modifytimetable` (`time_table_id`,`training_dt`, `session_no`,`period_type`, `break_time`, `class_start_time`, `class_end_time`, `faculty_id`, 
                                        `paper_id`, `detail_topic_id`, `paper_covered`,`session_type`,`other_class`,`class_remark`, `new_session_no`,`new_period_type`, `new_break_time`, `new_class_start_time`, `new_class_end_time`,
                                         `new_faculty_id`, `new_term_id`, `new_paper_id`, `new_subject_id`, `new_topic_id`, `new_detail_topic_id`, `new_paper_covered`,
                                          `new_session_type`, `new_other_class`, `new_class_remark`, `modify_by`, `status`, `modify_on`) 
                                VALUES ('".$update_id."','".$row['training_dt']."','".$row['session_no']."','".$row['period_type']."', '".$row['break_time']."','".$row['class_start_time']."', '".$row['class_end_time']."', '".$row['faculty_id']."',
                                        '".$row['paper_id']."', '".$row['detail_topic_id']."','". $row['paper_covered']."','". $row['session_type']."','". $row['other_class']."','". $row['class_remark']."',
                                        '".$frm_data['session_no']."','".$frm_data['period_type']."', '".$frm_data['break']."', '".$frm_data['class_start_time']."', '".$frm_data['class_end_time']."',
                                        '".$frm_data['faculty_id']."', '".$frm_data['term_id']."', '".$frm_data['paper_id']."', '".$frm_data['subject_id']."', '".$frm_data['topic_id']."', '".$frm_data['dtl_topic']."','".$frm_data['paper_covered']."',
                                        '".$frm_data['session_type']."','".$frm_data['other_class']."', '".$frm_data['class_remark']."', '".$frm_data['user_id']."', '1','".$now->format('Y-m-d')."' )";
                // echo $insert_sql;
                // exit;
                $db->insert_sql($insert_sql);

                $res2 = $db->getResult();
                //print_r($res2);
                if($res2){
                    echo "success#".$res2[1];
                }
                else{
                  //print_r($db->getResult());
                  echo "error#".$res2[0];
                }
               
              }
         // print_r($row);

        }
   }
   else{
    echo "error#".$res[0];
   }
  
   //print_r($oldTable);

}
//director Approval 
if( isset($_POST['action']) && $_POST['action'] == 'director_approval'){
  $tbl_id = $_POST['tbl_id'];
  $session_no = $_POST['session_no'];
  $trng_dt = $_POST['trng_dt'];
  //echo($trng_dt);
  $db->update("tbl_modifytimetable",['status'=> 2],"time_table_id='".$tbl_id."' AND session_no = '".$session_no."' AND training_dt = '".$trng_dt."'");

    $res = $db->getResult();
                print_r($res);
                if($res){
                    echo "success#".$res[1];
                }
                else{
                  //print_r($db->getResult());
                  echo "error#".$res[0];
                }
}
  // fetch edit code
 if( isset($_POST['action']) && $_POST['action'] == 'edit'){
  
    $edit_id = $_POST['edit_id'];
    $table = $_POST['table'];
   
    $db->select($table,"*",null,'id='.$edit_id,null,null);
    
     $res = $db->getResult();
     //print_r($res);
     echo json_encode($res);
 }
 
 
 if( isset($_POST['action']) && $_POST['action'] == 'approve_modified_timeTable'){
    
    $tbl_id = $_POST['tbl_id'];
    $user_id = $_POST['user_id'];
    $session_no = $_POST['session_no'];
    $trng_dt = $_POST['trng_dt'];
    
    $db->select("tbl_modifytimetable","new_session_no,new_break_time,new_class_start_time,new_class_end_time,new_faculty_id,new_term_id,new_paper_id,new_subject_id,new_topic_id,new_detail_topic_id,new_paper_covered,new_session_type,new_other_class,new_class_remark",null,"time_table_id='".$tbl_id."' AND session_no = '".$session_no."' AND training_dt = '".$trng_dt."' ",null,null);
    $res = $db->getResult();
    if($res){
      foreach($res as $row){
          print_r($row);

          $sql = "UPDATE `tbl_time_table` SET `session_no` = '".$row['new_session_no']."' , `break_time` = '".$row['new_break_time']."',`class_start_time` = '".$row['new_class_start_time']."' ,
                  `class_end_time` = '".$row['new_class_end_time']."', `faculty_id` = '".$row['new_faculty_id']."', `term_id` = '".$row['new_term_id']."', `paper_id` = '".$row['new_paper_id']."',
                  `subject_id` = '".$row['new_subject_id']."' , `topic_id` = '".$row['new_topic_id']."', `detail_topic_id` = '".$row['new_detail_topic_id']."', `paper_covered` = '".$row['new_paper_covered']."',
                   `session_type` = '".$row['new_session_type']."', `other_class` = '".$row['new_other_class']."',`class_remark` = '".$row['new_class_remark']."' 
                   WHERE  id='".$tbl_id."' AND session_no = '".$session_no."' and training_dt = '".$trng_dt."' " ;
          echo $sql ; 
          //exit;
            $db->update_dir($sql);
                $res3 = $db->getResult();
                print_r($res3);
                if($res3){
                    //echo "success#".$res3[1];
                    $db->update("tbl_modifytimetable",['status'=> 3],"time_table_id='".$tbl_id."' AND session_no = '".$session_no."' AND training_dt = '".$trng_dt."'");

                  $res4 = $db->getResult();
                      print_r($res);
                      if($res4){
                          echo "success#".$res4[1];
                      }
                      else{
                        //print_r($db->getResult());
                        echo "error#".$res4[0];
                      }
                }
                else{
                  //print_r($db->getResult());
                  echo "error#".$res3[0];
                }
      }
    }else{

    }
    
   
 }

 if( isset($_POST['action']) && $_POST['action'] == 'selfApprove_modified_timeTable'){
    
  $tbl_id = $_POST['tbl_id'];
  $user_id = $_POST['user_id'];
  $session_no = $_POST['session_no'];
  $trng_dt = $_POST['trng_dt'];
  
  $db->select("tbl_modifytimetable","new_session_no,new_break_time,new_class_start_time,new_class_end_time,new_faculty_id,new_term_id,new_paper_id,new_subject_id,new_topic_id,new_detail_topic_id,new_paper_covered,new_session_type,new_other_class,new_class_remark",null,"time_table_id='".$tbl_id."' AND session_no = '".$session_no."' AND training_dt = '".$trng_dt."' ",null,null);
  $res = $db->getResult();
  if($res){
    foreach($res as $row){
        print_r($row);

        $sql = "UPDATE `tbl_time_table` SET `session_no` = '".$row['new_session_no']."' , `break_time` = '".$row['new_break_time']."',`class_start_time` = '".$row['new_class_start_time']."' ,
                `class_end_time` = '".$row['new_class_end_time']."', `faculty_id` = '".$row['new_faculty_id']."', `term_id` = '".$row['new_term_id']."', `paper_id` = '".$row['new_paper_id']."',
                `subject_id` = '".$row['new_subject_id']."' , `topic_id` = '".$row['new_topic_id']."', `detail_topic_id` = '".$row['new_detail_topic_id']."', `paper_covered` = '".$row['new_paper_covered']."',
                 `session_type` = '".$row['new_session_type']."', `other_class` = '".$row['new_other_class']."',`class_remark` = '".$row['new_class_remark']."' 
                 WHERE  id='".$tbl_id."' AND session_no = '".$session_no."' and training_dt = '".$trng_dt."' " ;
        echo $sql ; 
        //exit;
          $db->update_dir($sql);
              $res3 = $db->getResult();
              print_r($res3);
              if($res3){
                  //echo "success#".$res3[1];
                  $db->update("tbl_modifytimetable",['status'=> 4],"time_table_id='".$tbl_id."' AND session_no = '".$session_no."' AND training_dt = '".$trng_dt."'");

                $res4 = $db->getResult();
                    print_r($res);
                    if($res4){
                        echo "success#".$res4[1];
                    }
                    else{
                      //print_r($db->getResult());
                      echo "error#".$res4[0];
                    }
              }
              else{
                //print_r($db->getResult());
                echo "error#".$res3[0];
              }
    }
  }else{

  }
  
 
}

 // fetch edit code
 if( isset($_POST['action']) && $_POST['action'] == 'frm_edit'){
  
  $edit_id = $_POST['edit_id'];
  $table = $_POST['table'];
  
  $sql = "SELECT t.id,t.paper_id,t.topic,t.session_no,m.id as sub_id,m.descr FROM `tbl_topic_master` t , `tbl_subject_master` m  
         WHERE t.subject_id=m.id AND t.id= '".$edit_id."' AND t.subject_id != 0 ";
  
  $db->select_sql($sql);
  
   $res = $db->getResult();
   //print_r($res);
   echo json_encode($res);
}

 //delete code
 if( isset($_POST['action']) && $_POST['action'] == 'delete'){

    $delete_id = $_POST['id'];
    $status_value = $_POST['status_value'];
    $table = $_POST['table'];

    $db->update($table,['status' => $status_value],'id='.$delete_id);
    $res = $db->getResult();
   if($res){
     echo "success";
   }
   
 }

 //remove code
 if( isset($_POST['action']) && $_POST['action'] == 'remove'){

  $delete_id = $_POST['id'];
  $table = $_POST['table'];

  $db->delete($table,'id='.$delete_id);
  $res = $db->getResult();
 if($res){
   echo "success";
 }
 
}

 //update email content trang incharge

 if( isset($_POST['action']) && $_POST['action'] == 'update_email_incharge'){

  $update_id = $_POST['id'];
  $email_sub = $_POST['email_sub'];
  $email_content = $_POST['email_content'];

  $db->update("tbl_short_program_master",['email_sub' => $email_sub,'email_content'=>$email_content],'id='.$update_id);
  $res = $db->getResult();
 if($res){
   echo "success";
 }
 
}


 if( isset($_POST['action']) && $_POST['action'] == 'ch_active'){

  $delete_id = $_POST['id'];
  $status_value = $_POST['status_value'];
  $table = $_POST['table'];

  $db->update($table,['status' => $status_value],'id='.$delete_id);
  $res = $db->getResult();
 if($res){
   echo "success";
 }
 
}

 //send record 
 if( isset($_POST['action']) && $_POST['action'] == 'send'){

  $recurit_id = $_POST['id'];
  $table = $_POST['table'];

  //$db->delete($table,'id='.$delete_id);
  $db->update($table,["fin_status"=> 1],'id='.$recurit_id);
  $res = $db->getResult();
  if($res){
    echo "success";
  }
  else{
    //print_r($db->getResult());
    echo "error#".$res[0];
  }
 
}

if( isset($_POST['action']) && $_POST['action'] == 'send_to_approve'){

  $program_id = $_POST['id'];
  $table = $_POST['table'];

  //$db->delete($table,'id='.$delete_id);
  $db->update($table,["status"=> "pendingAtIncharge"],'id='.$program_id);
  $res = $db->getResult();
  if($res){
    echo "success";
  }
  else{
    //print_r($db->getResult());
    echo "error#".$res[0];
  }
 
}

if( isset($_POST['action']) && $_POST['action'] == 'timeTable_approval'){
  //print_r($_POST);
  $program_id = $_POST['id'];
  //echo $program_id;exit;
  $table = $_POST['table'];
  // 1 -> pending
  //$db->delete($table,'id='.$delete_id);
  $db->update($table,["status"=> 1],'id='.$program_id);
  $res = $db->getResult();
  if($res){
    echo "success";
  }
  else{
    //print_r($db->getResult());
    echo "error#".$res[0];
  }
 
}

if( isset($_POST['action']) && $_POST['action'] == 'approve_program_by_incharge'){
 
  $program_id = $_POST['id'];
  $provisonal_Sdate = $_POST['provisonal_Sdate'];
  $provisonal_Edate = $_POST['provisonal_Edate'];
  $table = $_POST['table'];
  
  $db->update($table,["provisonal_Sdate"=> "$provisonal_Sdate","provisonal_Edate"=> "$provisonal_Edate","status"=> "pendingAtDirector"],'id='.$program_id);
  $res = $db->getResult();
  //print_r($res);
  if($res[0] == 1){

    echo "success";
   
  }
  else{
    
    echo "error#".$res[0];
  }
}

if( isset($_POST['action']) && $_POST['action'] == 'approve_program'){
    
    //print_r($_POST);exit;

    $program_id = $_POST['id'];
    $course_director = $_POST['course_director'];
    $asst_course_director = $_POST['asst_course_director'];
    $provisonal_Sdate = $_POST['provisonal_Sdate'];
    $provisonal_Edate = $_POST['provisonal_Edate'];
    
    $table = $_POST['table'];
    // echo $provisonal_Edate;
    // exit;
    //$db->delete($table,'id='.$delete_id);
    $db->update($table,["course_director"=> $course_director,"asst_course_director"=> $asst_course_director,"provisonal_Sdate"=> "$provisonal_Sdate","provisonal_Edate"=> "$provisonal_Edate","status"=> "approve"],'id='.$program_id);
    $res = $db->getResult();
    
    if($res[0] == 1){
      $update_sql_director = "UPDATE `tbl_user` SET `roll_id` = '8,9' WHERE `tbl_user`.`id` = (SELECT u.id FROM `tbl_faculty_master` f JOIN `tbl_user` u  ON f.phone=u.username  WHERE f.id  = $course_director )";
      $db->update_dir($update_sql_director);
      $update_res = $db->getResult();
     // print_r($update_res);
      
      if($update_res[0] == 1){
        $update_sql_asstdirector = "UPDATE `tbl_user` SET `roll_id` = '9,10' WHERE `tbl_user`.`id` = (SELECT u.id FROM `tbl_faculty_master` f JOIN `tbl_user` u  ON f.phone=u.username  WHERE f.id  = $asst_course_director )";
        $db->update_dir($update_sql_asstdirector);
        echo "success";
      }else{
        
        echo "error#assist course director";
      }
     
    }
    else{
      //print_r($db->getResult());
      echo "error#course director";
    }
}


if( isset($_POST['action']) && $_POST['action'] == 'reject_program_by_incharge'){
    
  $remark = $_POST['msg'];
  $program_id = $_POST['id'];
  $table = $_POST['table'];

  //$db->delete($table,'id='.$delete_id);
  $db->update($table,["status"=> "reject_by_incharge","remark" =>$remark],'id='.$program_id);
  $res = $db->getResult();
  //print_r($res);
  if($res){
    echo "success";
  }
  else{
    //print_r($db->getResult());
    echo "error#".$res[0];
  }
}

if( isset($_POST['action']) && $_POST['action'] == 'reject_program'){
    
  $remark = $_POST['msg'];
  $program_id = $_POST['id'];
  $table = $_POST['table'];

  //$db->delete($table,'id='.$delete_id);
  $db->update($table,["status"=> "rejectedByDirector","remark" =>$remark],'id='.$program_id);
  $res = $db->getResult();
  //print_r($res);
  if($res){
    echo "success";
  }
  else{
    //print_r($db->getResult());
    echo "error#".$res[0];
  }
}

//time table Approve by director  
if( isset($_POST['action']) && $_POST['action'] == 'dir_approve_timeTable'){

  $timeTable_id = $_POST['id'];
  $table = $_POST['table'];

  $db->update($table,["status_dir"=> 1],'id='.$timeTable_id);
  $res = $db->getResult();
  if($res){
    echo "success";
  }
  else{
  
    echo "error#".$res[0];
  }
}
//time table reject by director  
if( isset($_POST['action']) && $_POST['action'] == 'dir_reject_timeTable'){
    
  $remark = $_POST['msg'];
  $timeTable_id = $_POST['id'];
  $table = $_POST['table'];
  $db->update($table,["status_dir"=> 3,"remark" =>$remark],'id='.$timeTable_id);
  $res = $db->getResult();
  
  if($res){
    echo "success";
  }
  else{
    
    echo "error#".$res[0];
  }
}
//time table approve by course  director 

if( isset($_POST['action']) && $_POST['action'] == 'approve_timeTable'){

    $timeTable_id = $_POST['id'];
    $table = $_POST['table'];

    //$db->delete($table,'id='.$delete_id);
    $db->update($table,["status"=> 2],'id='.$timeTable_id);
    $res = $db->getResult();
    if($res){
      echo "success";
    }
    else{
      //print_r($db->getResult());
      echo "error#".$res[0];
    }
}
//time table reject by director 
if( isset($_POST['action']) && $_POST['action'] == 'reject_timeTable'){
    
  $remark = $_POST['msg'];
  $timeTable_id = $_POST['id'];
  $table = $_POST['table'];

  //$db->delete($table,'id='.$delete_id);
  $db->update($table,["status"=> 3,"remark" =>$remark],'id='.$timeTable_id);
  $res = $db->getResult();
  //print_r($res);
  if($res){
    echo "success";
  }
  else{
    //print_r($db->getResult());
    echo "error#".$res[0];
  }
}
 //dependent select options for faculty
 
 
 if( isset($_POST['action']) && $_POST['action'] == 'edit_syllabus'){
  //print_r($frm_data);
   $syllabus_id = $_POST['edit_id'];
   $table = $_POST['table'];
   
   $db->select($table,"*",null,"id =".$syllabus_id,null,null);
   $res = $db->getResult();
   
   if($res){
     echo '<option>Select Syllabus</option>';
     foreach($res as $row){

      echo '<option value="'.$row['id'].'">'.$row['descr'].'</option>';
      
       
     }
   }
   else{
     //print_r($db->getResult());
     echo '<option>Syllabus Not Found</option>';
   }
  
 }

 if( isset($_POST['action']) && $_POST['action'] == 'select_term'){
  //print_r($frm_data);
   $syllabus_id = $frm_data['syllabus_id'];
   $table = $frm_data['table'];
   
   $db->select($table,"*",null,"syllabus_id =".$syllabus_id,null,null);
   $res = $db->getResult();
   
   if($res){
     echo '<option value="0" >Select term</option>';
     foreach($res as $row){

      echo '<option value="'.$row['id'].'">'.$row['term'].'</option>';
      
       
     }
   }
   else{
   
     echo '<option>Term Not Found</option>';
   }
  
 }

 if( isset($_POST['action']) && $_POST['action'] == 'subjecToFaculty'){
  //print_r($frm_data);
  $faculty_id = $_POST['faculty_id'];
  $paper_id = $_POST['paper_id'];
  $table = $_POST['table'];
  $subject = array();
  
  $db->select("tbl_guest_faculty","subject_id",null,"status = 1 AND faculty_id =".$faculty_id,null,null);
  $res = $db->getResult();
 
  if($res){
   
      foreach($res as $row1){
         
         $subject[] = $row1['subject_id'];
          
      }
      echo '<option>Select Subject</option>';
      $db->select($table,"*",null,"status = 1  AND paper_id =".$paper_id,null,null);
          $res2 = $db->getResult();
          foreach($res2 as $row2){
            //print_r($row2);
           // echo $row2['id'];
            ?>
echo <option value=<?php echo  $row2['id'] ?>
    style="display: <?php if(in_array( $row2['id'] , $subject)){echo 'none';}  ?> "><?php echo  $row2['subject_name'] ?>
</option>
<?php
           // echo '<option value="'.$row2['id'].'"  "'.if(in_array($row2['id'],$subject)){ echo "show" } .'" >'.$row2['subject_name'].'</option>';
          }
          // print_r($res2);

      //print_r($subject);
    exit;
  }
  else{
     
      echo '<option>Subject Not Found</option>';
  }

}


 if( isset($_POST['action']) && $_POST['action'] == 'select_subject'){
  
  $paper_id = $_POST['paper_id'];
  $table = $_POST['table'];
  
  $db->select($table,"*",null," paper_id =".$paper_id,null,null);
  $res = $db->getResult();
 
  if($res){
     // echo '<option value = "0">Select Subject</option>';
     
      foreach($res as $row1){
          //echo ($row1['descr']);
          //echo ('<option value="'.$row1['id'].'">'.($row1['descr'] != '')?'No Subject Available':$row1['descr'].'</option>');
          ?>
<option value=" <?php echo $row1['id'] ?>"><?php echo ($row1['descr'] == '')?'No Subject ':$row1['descr'] ?></option>
<?php
          
      }
    exit;
  }
  else{
      //print_r($db->getResult());
      echo '<option>Subject Not Found</option>';
  }

}
 //dependent select options on edit
 if( isset($_POST['action']) && $_POST['action'] == 'select_edit'){
  //print_r($frm_data);
   $id = $frm_data['id'];
   $table = $frm_data['table'];
  
   $db->select($table,"*",null,"id =".$id,null,null);
   $res = $db->getResult();
   //print_r($res);
   if($res){
    
     foreach($res as $row){
      // echo '<option value="'.$row['id'].'">'.$row['title'].'</option>';
      echo $row['id'];
     }
   }
   else{
     //print_r($db->getResult());
     echo '<option>Paper Not Found</option>';
   }
  
 }
  
//send all record in fin login
if( isset($_POST['action']) && $_POST['action'] == 'sendrecord'){
        
  foreach($frm_data as $key => $value){
   // print_r($value);
    $cnt = count($value);

    for($i = 0 ;$i<$cnt ;$i++){
       $db->update('tbl_new_recruite',["fin_status"=> 1],'id='.$value[$i]);
       $res = $db->getResult();

       
       //print_r($res);
    }
    if($res){
      $db->update('tbl_batch_master',["mdrafm_status"=> 1],'id='.$_POST['batch_id']);
      echo "success";
  }
  else{
    //print_r($db->getResult());
    echo "error#".$res[0];
  }

  }
}
//send all record in fin login
if( isset($_POST['action']) && $_POST['action'] == 'select_syllabus'){
        
    //$trng_type = $_POST['trng_type'];
    //$mjr_id = $_POST['mjr_id'];
     //print_r($frm_data);
  
    $table = $frm_data['table'];
    //echo $table;
    $db->select($table,"*",null,null,null,null);

    $res = $db->getResult();
  
    if($res){
        echo '<option>Select Syllabus</option>';
      
        foreach($res as $row1){
          
        
          ?>
<option value=<?php echo $row1['id'] ?>> <?php echo $row1['descr'] ?> </option>
<?php
        }
      
    }
    else{
        //print_r($db->getResult());
        echo '<option>Paper Not Found</option>';
    }
}

if( isset($_POST['action']) && $_POST['action'] == 'timeTable_prgram'){
  $type = $_POST['type'];

  $db->select('tbl_program_master',"id,prg_name",null,"trng_type =".$type,null,null);

    $res = $db->getResult();
   
    if($res){
      echo '<option>Select Program</option>';
    
      foreach($res as $row){
        
      
        ?>
<option value=<?php echo $row['id'] ?>> <?php echo $row['prg_name'] ?> </option>
<?php
      }
    
  }
  else{
      //print_r($db->getResult());
      echo '<option>Program Not Found</option>';
  }
}

if( isset($_POST['action']) && $_POST['action'] == 'timeTable_name'){
  $program_id = $_POST['program_id'];

  $db->select('tbl_time_table_range',"id,name",null,"program_id =$program_id AND status_dir = 1 " ,null,null);

    $res = $db->getResult();
   
    if($res){
      echo '<option>Select Time Table</option>';
    
      foreach($res as $row){
        
      
        ?>
<option value=<?php echo $row['id'] ?>> <?php echo $row['name'] ?> </option>
<?php
      }
    
  }
  else{
      //print_r($db->getResult());
      echo '<option>Program Not Found</option>';
  }
}
if( isset($_POST['action']) && $_POST['action'] == 'timeTable_date'){

  $table_name = $_POST['table_name'];
  $trng_type = $_POST['trng_type'];
  $program_id = $_POST['program_id'];
  
   if($trng_type == 3 || $trng_type == 4){

    
    $db->select('tbl_time_table_range',"from_dt,to_dt",null,"program_id =".$program_id,null,null);
    $res = $db->getResult();
      foreach ($res as $row){
        
        $begin = new DateTime( $row["from_dt"] );
        $end   = new DateTime( $row["to_dt"] );

        for($i = $begin; $i <= $end; $i->modify('+1 day')){
           ?>
<option><?php echo $i->format("d-m-Y"); ?> </option>
<?php
        }
      }
     
   }else{

    $db->select_one('tbl_time_table_range','from_dt,to_dt',$table_name);
    $res = $db->getResult();
      foreach ($res as $row){
        
        $begin = new DateTime( $row["from_dt"] );
        $end   = new DateTime( $row["to_dt"] );

        for($i = $begin; $i <= $end; $i->modify('+1 day')){
           ?>
<option><?php echo $i->format("d-m-Y"); ?> </option>
<?php
        }
      }

   }


   
    //print_r($res);
    exit;
    
}


if( isset($_POST['action']) && $_POST['action'] == 'add_prgram_batch'){
   
  $program_id = $_POST['program_id'];
  $batch_id = $_POST['batch_id'];
  
  $db->update('tbl_batch_master',["program_id"=> $program_id],'id='.$batch_id);
  $res = $db->getResult();

       if($res){
        echo "success";
    }
    else{
     
      echo "error#".$res[0];
    }
      
}

if( isset($_POST['action']) && $_POST['action'] == 'email_docs'){
  $program_id = $_POST['program_id'];

  $db->select('tbl_email_doc',"*",null,"program_id =".$program_id,null,null);
  foreach($db->getResult() as $row){
     // print_r($row);
     
      ?>
latter : <a href="<?php echo "email_doc/".$row['latter']; ?>" target="_blank">latter <img
        src="../images/document_pdf.png" /></a><br>
Annexure 1 : <a href="<?php echo "email_doc/".$row['anx1']; ?>" target="_blank">Annexure1 <img
        src="../images/document_pdf.png" /></a><br>
Annexure 2 : <a href="<?php echo "email_doc/".$row['anx2']; ?>" target="_blank">
    Annexure2 <img src="../images/document_pdf.png" /></a>
<?php
  }
}

if( isset($_POST['action']) && $_POST['action'] == 'cover_latter'){
     //print_r($_POST);
     $type = $_POST['type'];
     $batch_id = $_POST['batch_id'];

      $filename = strtolower(basename($_FILES['file']['name']));
     $ext = substr($filename, strrpos($filename, '.') + 1);
    
     $md_referenceno= gen_uuid();
     $ext=".".$ext;
     $new_filename = 'email_doc/'. $md_referenceno . $ext;
     $doc_name = $md_referenceno . $ext;
    
     if(move_uploaded_file($_FILES['file']['tmp_name'],$new_filename)){

        $db->update('tbl_batch_master', ['cover_latter'=>$doc_name],'id ='.$batch_id);
        if($db->getResult()){
            echo "success#Document uploaded Successfully";
        }
        else{
          //print_r($db->getResult());
          echo "error#".$res[0];
        }
     }
}

if( isset($_POST['action']) && $_POST['action'] == 'add_faculty'){
  
   $filename = strtolower(basename($_FILES['photo']['name']));
   $ext = substr($filename, strrpos($filename, '.') + 1);
  //  echo $filename;
  //  exit;
  //print_r($frm_data);exit;
  $md_referenceno= gen_uuid();
  $ext=".".$ext;
  $new_filename = '../images/faculty/'. $md_referenceno . $ext;
  $doc_name = $md_referenceno . $ext;
  $frm_data['role'] = $_POST['role'];
  $frm_data['image'] = $doc_name;
  
  $db->select('tbl_faculty_master',"*",null,"phone = ".$frm_data['phone'],null,null);
  $res = $db->getResult();

  if( empty($res)) {
    if(move_uploaded_file($_FILES['photo']['tmp_name'],$new_filename)){

     

      $db->insert('tbl_faculty_master', $frm_data);
      
      $res = $db->getResult();
      $last_insert_id = $res[0];
      
      if($last_insert_id > 0){
       
        $username = $frm_data['phone'];
        $name = $last_insert_id;
        $email = $frm_data['email'];
        $roll = 9;
        $newstring = substr($frm_data['phone'], -5);
      
        $pass = "Mdrafm@".$newstring;
        $psw = trim($pass);
        $encryptedpass = password_hash($psw,PASSWORD_BCRYPT);
      
        $insert_sql = "INSERT INTO tbl_user (roll_id,username,name,email,password) VALUES ('$roll', '$username','$name','$email','$encryptedpass' ) " ;
        
      
        $db->insert_sql($insert_sql);
        $user_insert = $db->getResult();
      
        if($user_insert[0] > 0 ){
          echo "success#".$user_insert[1];
        }else{
          echo "error#".$user_insert[0];
        }
      
      }
      else{
       
       echo "error#".$res[0];
      }
      }
  }
  else{
    echo "error#Mobile No Already exists";
    exit;
  }
  
 

}

if( isset($_POST['action']) && $_POST['action'] == 'add_guest_faculty'){

  $frm_data['role'] = $_POST['role'];
//print_r($_POST);

if($_POST['update_id'] == 0 ) {
 $db->select('tbl_faculty_master',"*",null,"phone = ".$frm_data['phone'],null,null);
 $res = $db->getResult();

 if( empty($res)) {
  
   

    
     $db->insert('tbl_faculty_master', $frm_data);
     
     $res = $db->getResult();
     $last_insert_id = $res[0];
     
     if($last_insert_id > 0){
      
       $username = $frm_data['phone'];
       $name = $last_insert_id;
       $email = $frm_data['email'];
       $roll = 9;
       $newstring = substr($frm_data['phone'], -5);
     
       $pass = "Mdrafm@".$newstring;
       $psw = trim($pass);
       $encryptedpass = password_hash($psw,PASSWORD_BCRYPT);
     
       $insert_sql = "INSERT INTO tbl_user (roll_id,username,name,email,password) VALUES ('$roll', '$username','$name','$email','$encryptedpass' ) " ;
       
     
       $db->insert_sql($insert_sql);
       $user_insert = $db->getResult();
     
       if($user_insert[0] > 0 ){
         echo "success#".$user_insert[1];
       }else{
         echo "error#".$user_insert[0];
       }
     
     }
     else{
      
      echo "error#".$res[0];
     }
   
 }
 else{
   echo "error#Mobile No Already exists";
   exit;
 }
 
}
else{

  $update_data = ["name" => $frm_data['name'],"desig" => $frm_data['desig'], "phone" => $frm_data['phone'],"email" => $frm_data['email'] ];
  $db->update('tbl_faculty_master',$update_data,'id ='.$_POST['update_id']);
   if($db->getResult()){
       echo "success# Updated Successfully";
   }
   else{
     //print_r($db->getResult());
     echo "error#".$res[0];
   }

   
} 

}

if( isset($_POST['action']) && $_POST['action'] == 'edit_faculty'){

   //print_r($_POST);
   //print_r($frm_data);
   //print_r($_FILES);
   $update_data = array();
   if($_FILES['photo']['name'] == ''){
    $update_data = ["name" => $frm_data['name'],"desig" => $frm_data['desig'],"cader" => $frm_data['cader'],"qulftn" => $frm_data['qulftn'],
    "phone" => $frm_data['phone'],"email" => $frm_data['email'] ];


   }else{
      $filename = strtolower(basename($_FILES['photo']['name']));
      $ext = substr($filename, strrpos($filename, '.') + 1);
      
      $md_referenceno= gen_uuid();
      $ext=".".$ext;
      $new_filename = '../images/faculty/'. $md_referenceno . $ext;
      $doc_name = $md_referenceno . $ext;
   
      $frm_data['image'] = $doc_name;

      if(move_uploaded_file($_FILES['photo']['tmp_name'],$new_filename)){
        $update_data = ["name" => $frm_data['name'],"desig" => $frm_data['desig'],"cader" => $frm_data['cader'],"qulftn" => $frm_data['qulftn'],
                       "phone" => $frm_data['phone'],"email" => $frm_data['email'],"image" => $frm_data['image']];
      }
   }

   $db->update('tbl_faculty_master',$update_data,'id ='.$_POST['update_id']);
   if($db->getResult()){
       echo "success#Faculty Updated Successfully";
   }
   else{
     //print_r($db->getResult());
     echo "error#".$res[0];
   }

   exit;
  

}

if( isset($_POST['action']) && $_POST['action'] == 'upload_ppt_doc'){
  //print_r($_POST);

  $type = $_POST['type'];
  $timeTable_id = $_POST['tbl_id'];
  $program_id = $_POST['program_id'];
  $session = $_POST['session'];
  $user_id = $_POST['user_id'];
 
   $filename = strtolower(basename($_FILES['file']['name']));
  $ext = substr($filename, strrpos($filename, '.') + 1);
 
  $md_referenceno= gen_uuid();
  $ext=".".$ext;
  $new_filename = 'course_material/'. $md_referenceno . $ext;
  $doc_name = $md_referenceno . $ext;
 
  if(move_uploaded_file($_FILES['file']['tmp_name'],$new_filename)){

     $db->insert_sql("INSERT INTO `tbl_tranning_document` (`time_tbl_id`, `session_no`, `doc_type`, `doc_name`, `add_by`) 
          VALUES ('$timeTable_id', '$session', '$type', '$doc_name', '$user_id');");
     if($db->getResult()){
         echo "success#Document uploaded Successfully";
     }
     else{
       //print_r($db->getResult());
       echo "error#".$res[0];
     }
  }
}

if (isset($_POST['action']) && $_POST['action'] == 'remove_report_pptDoc'){
  $delete_id = $_POST['id'];
  
  // print_r($_POST);
  // exit;
  $db->select('tbl_tranning_document',"doc_name",null,"id =".$delete_id,null,null);
   $res =  $db->getResult();
   foreach($res as $row1){
     
       $file_path = "/mdrafm2/admin/course_material/".$row1['doc_name'];
       $path = $_SERVER['DOCUMENT_ROOT'].$file_path;
      //  echo $path;
      //  exit;
       if($path)
         {
             unlink($path);
             $db->delete('tbl_tranning_document','id='.$delete_id);
             $res = $db->getResult();
             if($res){
                 echo "success#".$res[1];
             }
             else{
                 //print_r($db->getResult());
                 echo "error#".$res[0];
             }
         }
         else
         {
             echo "File Not Found";
             exit;
         }
   }
 
}

if (isset($_POST['action']) && $_POST['action'] == 'remove_report'){
  $update_id = $_POST['id'];
  $field = $_POST['field'];

  $db->select('tbl_batch_master',"$field",null,"id =".$update_id,null,null);
   $res =  $db->getResult();
   foreach($res as $row1){
     
       $file_path = "/mdrafm2/admin/email_doc/".$row1[$field];
       $path = $_SERVER['DOCUMENT_ROOT'].$file_path;
       //echo $path;
       if($path)
         {
             unlink($path);
             $db->update('tbl_batch_master', [$field => "" ],'id='.$update_id);
             $res = $db->getResult();
             if($res){
                 echo "success#".$res[1];
             }
             else{
                 //print_r($db->getResult());
                 echo "error#".$res[0];
             }
         }
         else
         {
             echo "File Not Found";
             exit;
         }
   }
 
}

if (isset($_POST['action']) && $_POST['action'] == 'remove_image'){
  $update_id = $_POST['id'];
 

  $db->select('tbl_faculty_master',"image",null,"id =".$update_id,null,null);
   $res =  $db->getResult();
   foreach($res as $row1){
         //print_r($row1);
       $file_path = "/mdrafm2/images/faculty/".$row1['image'];
       $path = $_SERVER['DOCUMENT_ROOT'].$file_path;
       //echo $path;
       if($path)
         {
             unlink($path);
             $db->update('tbl_faculty_master', [ "image" => "" ],'id='.$update_id);
             $res = $db->getResult();
             if($res){
                 echo "success#".$res[1];
             }
             else{
                 //print_r($db->getResult());
                 echo "error#".$res[0];
             }
         }
         else
         {
             echo "File Not Found";
             exit;
         }
   }
 
}


if (isset($_POST['action']) && $_POST['action'] == 'change_co_director'){
  $program_id = $_POST['program_id'];
   $co_director_id = $_POST['co_director_id'];
   $asst_co_director = $_POST['asst_co_director'];

    $date = date("Y-m-d") ;
    $db->select_one('tbl_program_master','id,course_director,asst_course_director',$program_id);
    $res = $db->getResult();
    foreach($res as $row){
      $id = $row['id'];
      $course_director = $row['course_director'];
      $asst_course_director = $row['asst_course_director'];

       $director = array();
       if($course_director != $co_director_id){
          $director['course_director'] = $co_director_id;
       }
       if($asst_course_director != $asst_co_director){
        
        $director['asst_course_director'] = $asst_co_director;
       }
       //$director['date'] = $date;
       //print_r($director); exit;
       if($course_director != $co_director_id){
       $db->insert('tbl_co_director_log', ['program_id'=> $id,'faculty_id'=>  $course_director,'date'=>$date]);
       }

       if($asst_co_director != $asst_course_director){
         $db->insert('tbl_asst_co_director_log', ['program_id'=> $id,'faculty_id'=>  $asst_course_director,'date'=>$date]);
       }
       
     
       $res1 = $db->getResult();
      if($res1[0] > 0 ){
        $db->update('tbl_program_master',$director,'id='.$program_id);
        $res2 = $db->getResult();
        if($res2){
          $db->update('tbl_program_master',$director,'id='.$program_id);
          $res2 = $db->getResult();
          if($res2){
            if($course_director != $co_director_id){
              $update_sql = "UPDATE `tbl_user` SET `roll_id` = '9' WHERE `tbl_user`.`id` = (SELECT u.id FROM `tbl_faculty_master` f JOIN `tbl_user` u  ON f.phone=u.username  WHERE f.id  = $course_director)";
              $db->update_dir($update_sql);
              $update_res = $db->getResult();
              if($update_res[0] == 1){
                
                $update_sql2 = "UPDATE `tbl_user` SET `roll_id` = '8,9' WHERE `tbl_user`.`id` = (SELECT u.id FROM `tbl_faculty_master` f JOIN `tbl_user` u  ON f.phone=u.username  WHERE f.id  = $co_director_id)";
                $db->update_dir($update_sql2);
                $update_res2 = $db->getResult();
                if($update_res2[0] == 1){
                  $msg['co_msg'] =  "success#Course Director Updated Successfully";
                }else{
                  
                  $msg['co_msg'] = "error# update new director";
                }
              }else{
                
                $msg['co_msg'] = "error#remove old director";
              }
            }
            if($asst_co_director != $asst_course_director){
              
              $update_sql = "UPDATE `tbl_user` SET `roll_id` = '9' WHERE `tbl_user`.`id` = (SELECT u.id FROM `tbl_faculty_master` f JOIN `tbl_user` u  ON f.phone=u.username  WHERE f.id  = $asst_course_director)";
              $db->update_dir($update_sql);
              $update_res = $db->getResult();
              //print_r($update_res);
              if($update_res[0] == 1){
                
                $update_sql2 = "UPDATE `tbl_user` SET `roll_id` = '9,10' WHERE `tbl_user`.`id` = (SELECT u.id FROM `tbl_faculty_master` f JOIN `tbl_user` u  ON f.phone=u.username  WHERE f.id  = $asst_co_director)";
                $db->update_dir($update_sql2);
                $update_res2 = $db->getResult();
                if($update_res2[0] == 1){
                  $msg['asst_co_msg'] =  "success# Assistant Course Director Updated Successfully";
                }else{
                  
                  $msg['asst_co_msg'] = "error#update new asst director";
                }
              }else{
                
                $msg['asst_co_msg'] = "error#remove old asst director";
              }
            }
          
         }
  
         echo implode(" ",$msg) ;
        }
        
      }
    }
}


if( isset($_POST['action']) && $_POST['action'] == 'edit_facultySubject'){
  
  $edit_id = $_POST['edit_id'];
  $table = $_POST['table'];
  
  $sql = "SELECT m.paper_id,s.id as subject_id,s.subject_name,m.guest_faculty_id FROM `tbl_guest_faculty_master` m 
          JOIN `tbl_guest_subject` s ON m.subject_id =s.id 
          WHERE m.id = '".$edit_id."' ";
  //echo $sql;
  $db->select_sql($sql);
  
   $res = $db->getResult();
   //print_r($res);
   echo json_encode($res);
}

if( isset($_POST['action']) && $_POST['action'] == 'chk_email'){

   $email = $_POST['email'];
   if($email == ''){
     exit;
   }
  
   $db->select('tbl_faculty_master',"*",null,"email = '".$email."' ",null,null);
  $res = $db->getResult();
  
  if($res){
    if( !empty($res)) {
      
      echo "yes";
  }
  }
  

}

if( isset($_POST['action']) && $_POST['action'] == 'chk_phone'){

  $phone = $_POST['phone'];
  if($phone == ''){
    exit;
  }
 
  $db->select('tbl_faculty_master',"*",null,"phone = '".$phone."' ",null,null);
 $res = $db->getResult();
 
 if($res){
   if( !empty($res)) {
     
     echo "yes";
 }
 }
 

}

if( isset($_POST['action']) && $_POST['action'] == 'add_short_co_officer'){

  $program_id = $_POST['id'];
  $co_officer = $_POST['co_officer'];

  $db->update('tbl_short_program_master',["course_co_officer"=>$co_officer],'id='.$program_id);
  $res = $db->getResult();

  if($res){
     $sql = "SELECT u.id,u.roll_id FROM `tbl_faculty_master` f JOIN `tbl_user` u  ON f.phone=u.username  WHERE f.id  = $co_officer";
      $db->select_sql($sql);
      foreach($db->getResult() as $row1){
      
        $roll = $row1['roll_id'].',12';

        $update_sql = "UPDATE `tbl_user` SET `roll_id` = '$roll' WHERE `tbl_user`.`id` = (SELECT u.id FROM `tbl_faculty_master` f JOIN `tbl_user` u  ON f.phone=u.username  WHERE f.id  = $co_officer)";
        $db->update_dir($update_sql);
        $update_res = $db->getResult();
        if($update_res[0] == 1){
         echo  "success# Course Coordinating Officer Successfully";
        }
      }
  }
}
  if( isset($_POST['action']) && $_POST['action'] == 'update_short_co_officer'){

    $program_id = $_POST['id'];
    $co_officer = $_POST['co_officer'];
    $co_officer_id= $_POST['co_officer_id'];

    $db->select('tbl_short_program_master',"course_co_officer",null,"course_co_officer = '".$co_officer_id."' ",null,null);
    $res = $db->getResult();
     if(count($res) >1 ){
      $db->update('tbl_short_program_master',["course_co_officer"=>$co_officer],'id='.$program_id);
      $res = $db->getResult();

      if($res){
        $sql = "SELECT u.id,u.roll_id FROM `tbl_faculty_master` f JOIN `tbl_user` u  ON f.phone=u.username  WHERE f.id  = $co_officer";
          $db->select_sql($sql);
          foreach($db->getResult() as $row1){
          
            $roll2 = $row1['roll_id'].',12';

            $update_sql = "UPDATE `tbl_user` SET `roll_id` = '$roll2' WHERE `tbl_user`.`id` = (SELECT u.id FROM `tbl_faculty_master` f JOIN `tbl_user` u  ON f.phone=u.username  WHERE f.id  = $co_officer)";
            $db->update_dir($update_sql);
            $update_res = $db->getResult();
            if($update_res[0] == 1){
            echo  "success# Course Coordinating Officer Successfully";
            }
          }
      }
      
     }else{
      // $db->update('tbl_short_program_master',["course_co_officer"=>$co_officer],'id='.$program_id);
      // $res = $db->getResult();
    
     // if($res){
      $sql = "SELECT u.id,u.roll_id FROM `tbl_faculty_master` f JOIN `tbl_user` u  ON f.phone=u.username  WHERE f.id  = $co_officer_id";
      $db->select_sql($sql);
      foreach($db->getResult() as $row1){
      
        $roll = explode(",",$row1['roll_id']) ;
        $key = array_search ('12', $roll);
       // print_r($roll);
        unset($roll[$key]);
        $new_roll = implode(",",$roll);
        
        //echo $new_roll;exit;
       //remove old assign course co officer
        $update_sql = "UPDATE `tbl_user` SET `roll_id` = '$new_roll' WHERE `tbl_user`.`id` = (SELECT u.id FROM `tbl_faculty_master` f JOIN `tbl_user` u  ON f.phone=u.username  WHERE f.id  = $co_officer_id)";
       
        $db->update_dir($update_sql);
        $update_res = $db->getResult();
        if($update_res[0] == 1){
        //update new course co officer

          $db->update('tbl_short_program_master',["course_co_officer"=>$co_officer],'id='.$program_id);
          $res = $db->getResult();

          if($res){
            $sql = "SELECT u.id,u.roll_id FROM `tbl_faculty_master` f JOIN `tbl_user` u  ON f.phone=u.username  WHERE f.id  = $co_officer";
              $db->select_sql($sql);
              foreach($db->getResult() as $row1){
              
                $roll2 = $row1['roll_id'].',12';

                $update_sql = "UPDATE `tbl_user` SET `roll_id` = '$roll2' WHERE `tbl_user`.`id` = (SELECT u.id FROM `tbl_faculty_master` f JOIN `tbl_user` u  ON f.phone=u.username  WHERE f.id  = $co_officer)";
                $db->update_dir($update_sql);
                $update_res = $db->getResult();
                if($update_res[0] == 1){
                echo  "success# Course Coordinating Officer Successfully";
                }
              }
          }
        }
      }
  //}
     }
    
  
    
 

}

function gen_uuid() 
{ 
      $s = strtoupper(md5(uniqid(date("YmdHis"),true))); 
       $guidText =substr($s,0,4)."-".substr($s,4,4)."-" ;
       
       $date=date("his");
     return "mdrafm-".$guidText.$date;
}



// function chk_user($id){
 
//   $db->select_one('tbl_faculty_master','phone',$id);
 
 
//   $res =  $db->getResult();
//   foreach($res as $row1){

//   }
// }

?>