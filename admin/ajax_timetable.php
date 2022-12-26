<?php
  include 'database.php';
  include 'common_function.php';
  $db = new Database();
    // print_r($_POST);
    
    // exit;  
   
  $pos = array_search("action",array_keys($_POST));
  $frm_data = array_splice($_POST,0,$pos);
  //print_r($frm_data); exit;
  if(isset($frm_data['faculty'])){
      unset($frm_data['faculty']);
  }
  //print_r($frm_data);exit;

  if( isset($_POST['action']) && $_POST['action'] == 'time_table_list'){
      $program_id = $_POST['program_id'];
      $table= $_POST['table'];
       
      time_table_data($program_id,$table);
    
  }

  

  if( isset($_POST['action']) && $_POST['action'] == 'select_faculty'){
    //print_r($frm_data);
     $faculty_id = $frm_data['facult_id'];
     $table = $frm_data['table'];
     
     $db->select($table,"id,name",null,"role =".$faculty_id,null,null);
     $res = $db->getResult();
     
     if($res){
       echo '<option>Select Faculty</option>';
       foreach($res as $row){
  
        echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
        
         
       }
     }
     else{
       //print_r($db->getResult());
       echo '<option>Faculty Not Found</option>';
     }
    
   }

   if( isset($_POST['action']) && $_POST['action'] == 'select_editFaculty'){
    //print_r($frm_data);
     $faculty_id = $frm_data['facult_id'];
     $table = $frm_data['table'];
     
     $db->select($table,"id,name",null,"id =".$faculty_id,null,null);
     $res = $db->getResult();
     
     if($res){
       echo '<option>Select Faculty</option>';
       foreach($res as $row){
  
        echo '<option value="'.$row['id'].'" selected> '.$row['name'].'</option>';
        
         
       }
     }
     else{
       //print_r($db->getResult());
       echo '<option>Faculty Not Found</option>';
     }
    
   }


   
 if( isset($_POST['action']) && $_POST['action'] == 'select_guest_faculty'){
   
     $table = $frm_data['table'];
     
     $db->select($table,"id,name",null," role = 2 AND status = 1",null,null);
     $res = $db->getResult();
    
     if($res){
       echo '<option>Select Faculty</option>';
       foreach($res as $row){
  
        echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
        
         
       }
     }
     else{
      
       echo '<option>Paper Not Found</option>';
     }
    
   }

   
if( isset($_POST['action']) && $_POST['action'] == 'assign_subjecToFaculty'){
    //print_r($frm_data);
    $paper_id = $_POST['paper_id'];
    $table = $_POST['table'];
    
    $db->select($table,"*",null,"paper_id =".$paper_id,null,null);
    $res = $db->getResult();
   
    if($res){
        echo '<option>Select Subject</option>';
       
        foreach($res as $row1){
            //print_r($row1);
            echo '<option value="'.$row1['id'].'">'.$row1['subject_name'].'</option>';
            
        }
      exit;
    }
    else{
        //print_r($db->getResult());
        echo '<option>Paper Not Found</option>';
    }
  
  }

  
if( isset($_POST['action']) && $_POST['action'] == 'slct_guest_faculty'){
    //print_r($frm_data);
    $paper_id = $_POST['paper_id'];
    $subject_id = $_POST['subject_id'];
    $table = $_POST['table'];
    
  
    $db->select_sql("SELECT d.id,d.name FROM `tbl_guest_faculty` m  join `tbl_faculty_master` d ON m.faculty_id=d.id WHERE m.subject_id = '".$subject_id."' ");
    $res = $db->getResult();
   
    if($res){
        echo '<option>Select Faculty</option>';
       
        foreach($res as $row1){
            //print_r($row1);
            echo '<option value="'.$row1['id'].'">'.$row1['name'].'</option>';
            
        }
      exit;
    }
    else{
        //print_r($db->getResult());
        echo '<option>Paper Not Found</option>';
    }
  
  }

  
//select faculty for time table
if( isset($_POST['action']) && $_POST['action'] == 'add_guest_faculty'){
    
    $faculty = $_POST['faculty_id']; 
   

    $table = $_POST['table'];

   $faculty_id = explode(',', $faculty);
   //print_r($faculty_id);
   
   foreach($faculty_id as $res1){
       //echo $res;
        $db->select($table,"id,name",null,"id =".$res1,null,null);
        $res = $db->getResult();
        
        if($res){
          
            foreach($res as $row){

            echo '<option value="'.$row['id'].'" selected>'.$row['name'].'</option>';
            
            
            }
        }
   }
   
   
}

if( isset($_POST['action']) && $_POST['action'] == 'check_faculty'){
   
  $faculty = $_POST['faculty_id'];
  
  $training_dt = $_POST['training_dt'];
  $start_time2 = date("H:i:s", strtotime($_POST['start_time']));
  $end_time2 =   date("H:i:s", strtotime($_POST['end_time']));

   $msg = '';
  foreach($faculty as $faculty_id){
      
    $db->select('tbl_time_table'," a.class_start_time,a.class_end_time,p.prg_name"," a  JOIN `tbl_program_master` p ON a.program_id = p.id ","a.training_dt = '".$training_dt."' AND a.faculty_id = '$faculty_id' ",null,null);
    $res = $db->getResult();
   
    if($res){
       foreach($res as $row){
         //print_r($row);
          $old_start_time2 =   date("H:i:s", strtotime($row['class_start_time']));
          $old_end_time2   =    date("H:i:s", strtotime($row['class_end_time']));

          if($start_time2 >= $old_start_time2 && $start_time2 <= $old_end_time2){
            $msg = 'Faculty has been assign to another class on '.$training_dt.'Time - "'.$row['class_start_time'].'" to "'.$row['class_end_time'].'" For Program - '.$row['prg_name'] ;
             
              // }
       }else{
        $msg = 'Faculty has been assign to another class on '.$training_dt.'Time - "'.$row['class_start_time'].'" to "'.$row['class_end_time'].'" ' ;
       }
    }
    echo 'success#'.$msg;
  }
  
   

}
}

if( isset($_POST['action']) && $_POST['action'] == 'select_paper'){
    //print_r($frm_data);
     $term_id = $frm_data['term_id'];
     $table = $frm_data['table'];
     
     $db->select($table,"DISTINCT term_id",null,"term_id =".$term_id,null,null);
     $res = $db->getResult();
     //print_r($res);exit;
     if($res){
       echo '<option>Select Paper</option>';
       foreach($res as $row){
        
         //  echo '<option value="'.$row['id'].'">'.$row['mjr_subject_id'].'</option>';
         $db->select('tbl_paper_master',"*",null,'term_id='.$row['term_id'],null,null);
         foreach($db->getResult() as $row1){
               echo '<option value="'.$row1['id'].'">'.$row1['title'].'-'.$row1['paper_code'].'</option>';
         }
         
       }
     }
     else{
       //print_r($db->getResult());
       echo '<option>Paper Not Found</option>';
     }
    
   }

   
 if( isset($_POST['action']) && $_POST['action'] == 'select_mjr_subject'){
    //print_r($frm_data);
     $paper_id = $frm_data['paper_id'];
     $table = $frm_data['table'];
     
     $db->select($table,"DISTINCT paper_id",null,"paper_id =".$paper_id,null,null);
     $res = $db->getResult();
     
     if($res){
      
       foreach($res as $row){
        
         //  echo '<option value="'.$row['id'].'">'.$row['mjr_subject_id'].'</option>';
         $db->select('tbl_subject_master',"id,descr",null,'paper_id='.$row['paper_id'],null,null);
         foreach($db->getResult() as $row1){
           print_r($row1);
           ?>
              <option value=" <?php echo $row1['id'] ?>"><?php echo ($row1['descr'] == '')?'No Subject ':$row1['descr'] ?></option
           <?php
         
              // echo '<option value="'.$row1['id'].'">'.$row1['descr'].'</option>';
         }
         
       }
     }
     else{
       //print_r($db->getResult());
       echo '<option>Subject Not Found</option>';
     }
    
   }

   if( isset($_POST['action']) && $_POST['action'] == 'select_topic'){
    //print_r($frm_data);
     $subject_id = $frm_data['subject_id'];
     $table = $frm_data['table'];
     
     $db->select($table,"DISTINCT subject_id",null,"subject_id =".$subject_id,null,null);
     $res = $db->getResult();
      print_r($db->getResult());
     if($res){
       echo '<option>Select Topic</option>';
       foreach($res as $row){
        //print_r($row);
         //  echo '<option value="'.$row['id'].'">'.$row['mjr_subject_id'].'</option>';
         $db->select('tbl_topic_master',"*",null,'subject_id='.$row['subject_id'],null,null);
         foreach($db->getResult() as $row1){
               echo '<option value="'.$row1['id'].'">'.$row1['topic'].'</option>';
         }
         
       }
     }
     else{
       //print_r($db->getResult());
       echo '<option>Paper Not Found</option>';
     }
    
   }

   if( isset($_POST['action']) && $_POST['action'] == 'select_deatail_topic'){
    //print_r($frm_data);
     $topic_id = $frm_data['topic_id'];
     $table = $frm_data['table'];
     
     $db->select($table,"id,dtl_topic",null,"topic_id =".$topic_id,null,null);
     $res = $db->getResult();
     
     if($res){
       echo '<option>Select Detail Topic</option>';
       foreach($res as $row){
  
        echo '<option value="'.$row['id'].'">'.$row['dtl_topic'].'</option>';
        
        //  $db->select('tbl_topic_master',"*",null,'id='.$row['topic_id'],null,null);
        //  foreach($db->getResult() as $row1){
        //      
        //  }
         
       }
     }
     else{
       //print_r($db->getResult());
       echo '<option>Paper Not Found</option>';
     }
    
   }

   if ( isset($_POST['action']) && $_POST['action'] == 'verify_time'){
   
    $program_id= $_POST['program_id'];
    $t_date = $_POST['t_date'];
   
    $start_time = date("H:i:s", strtotime($_POST['start_time']));
    $end_time  =  date("H:i:s", strtotime($_POST['end_time']));
    if($_POST['period'] =='start_time' ){

       $db->select("tbl_time_table","MAX(session_no) as session_no",null,"program_id= '".$program_id."' AND training_dt = '".$t_date."' ",null,null);
       $res = $db->getResult();
       foreach($res as $row){
           $db->select("tbl_time_table","class_start_time,class_end_time",null,"session_no ='".$row['session_no']."' AND program_id= '".$program_id."' AND training_dt = '".$t_date."' ",null,null);
           $res2 = $db->getResult();
           foreach($res2 as $time){
             $old_start_time = date("H:i:s", strtotime($time['class_start_time']));
             $old_end_time =  date("H:i:s", strtotime($time['class_end_time']));
            
             if($start_time < $old_end_time ){
               echo  "start#Class overlaps with previous class :".$time['class_start_time']." - ".$time['class_end_time']."#error";
                 exit;
             }else{
               echo "start#Valid Time#success";
             }
           }
       }
    }else{

       if($start_time > $end_time ){
         echo  "end#Class overlaps with previous class :".$start_time."#error";
         
         exit;
     }
    }
}
if ( isset($_POST['action']) && $_POST['action'] == 'verify_time_edit'){
   
    $program_id= $_POST['program_id'];
    $trng_date = $_POST['trng_date'];
   
    $start_time = date("H:i:s", strtotime($_POST['start_time']));
    $end_time  =  date("H:i:s", strtotime($_POST['end_time']));
    $session_no = $_POST['session_no'];

    if($_POST['period'] =='start_time' ){
       if($session_no > 1){
        $db->select("tbl_time_table","MAX(session_no) as session_no",null,"program_id= '".$program_id."' AND training_dt = '".$trng_date."' ",null,null);
        $res = $db->getResult();
        foreach($res as $row){
            $db->select("tbl_time_table","class_start_time,class_end_time",null,"session_no ='".$row['session_no']."' AND program_id= '".$program_id."' AND training_dt = '".$trng_date."' ",null,null);
            $res2 = $db->getResult();
            foreach($res2 as $time){
              $old_start_time = date("H:i:s", strtotime($time['class_start_time']));
              $old_end_time =  date("H:i:s", strtotime($time['class_end_time']));
             
              if($start_time < $old_end_time ){
                echo  "start#Class overlaps with previous class :".$time['class_start_time']." - ".$time['class_end_time']."#error";
                  exit;
              }else{
                echo "start#Valid Time#success";
              }
            }
        }
       }else{
        echo "start#First Session#success";
       }
       
    }else{

       if($start_time > $end_time ){
         echo  "end#Class overlaps with previous class :".$start_time."#error";
         
         exit;
     }
    }
}


if ( isset($_POST['action']) && $_POST['action'] == 'add_table'){
    //$term = $_POST['term'];
       //print_r($_POST);
       //print_r($frm_data);
      // exit;
    $session_no = $frm_data['session_no'];
    $update_id =$_POST['update_id'];
    $table = $_POST['table'];
    $start_time = date("H:i:s", strtotime($frm_data['class_start_time']));
    $end_time =  date("H:i:s", strtotime($frm_data['class_end_time']));
    $msg = '';
  
    if($start_time > $end_time ){
      echo $msg =  "end#End time should be grater than Start time #error";
       exit;
   }
    

    //check class time validation 
    if($update_id == ''){

      $db->select($table,"class_start_time,class_end_time",null,"session_no ='".$session_no."' AND program_id= '".$frm_data['program_id']."' AND training_dt = '".$frm_data['training_dt']."' ",null,null);
      $res2 = $db->getResult();
      foreach($res2 as $time){
       // print_r($time);
        $old_start_time = date("H:i:s", strtotime($time['class_start_time']));
        $old_end_time =  date("H:i:s", strtotime($time['class_end_time']));
        
        if($start_time < $old_end_time ){
            echo $msg =  "start#Time period overlaps previous class #error";
            exit;
        }
      }
    }
   
   //make `,` seperator to multiple faculty id
    if(isset($frm_data['faculty_id'])){
      $faculty = implode(',', $frm_data['faculty_id']);
      $frm_data['faculty_id'] = $faculty;
  }
     //update time table data
    
    if ($update_id != '' ){
   
       $db->update($table, $frm_data,'id='.$update_id);
       $res = $db->getResult();
      print_r($res);
        if($res){
            echo "msg#".$res[1]."#success";
        }
        else{
         
          echo "msg#".$res[0]."#error";
        }
        
    }
    //add new time table data

    else{
       
      switch ($frm_data['trng_type']) {
        //long term 
        case '1':
          $sql = "INSERT INTO tbl_time_table (program_id,table_range_id,trng_type,training_dt, session_no,period_type,break_time,faculty_type,faculty_id, class_start_time, class_end_time, term_id, paper_id, paper_covered,session_type,other_class,class_remark,no_of_session) 
               VALUES ('".$frm_data['program_id']."','".$frm_data['table_range_id']."','".$frm_data['trng_type']."','".$frm_data['training_dt']."','".$session_no."','".$frm_data['period_type']."','".$frm_data['break']."','".$frm_data['faculty_type']."','".$frm_data['faculty_id']."','".$frm_data['class_start_time']."',
               '".$frm_data['class_end_time']."','".$frm_data['term_id']."','".$frm_data['paper_id']."',
              '".$frm_data['paper_covered']."','".$frm_data['session_type']."','".$frm_data['other_class']."','".$frm_data['class_remark']."','".$frm_data['no_of_session']."')";
          
          break;
       //long term in-servece
          case '2':
            $sql = "INSERT INTO tbl_time_table (program_id,table_range_id,trng_type,training_dt, session_no,period_type,break_time,faculty_type,faculty_id, class_start_time, class_end_time, term_id, paper_id, paper_covered,session_type,other_class,class_remark,no_of_session) 
                 VALUES ('".$frm_data['program_id']."','".$frm_data['table_range_id']."','".$frm_data['trng_type']."','".$frm_data['training_dt']."','".$session_no."','".$frm_data['period_type']."','".$frm_data['break']."','".$frm_data['faculty_type']."','".$frm_data['faculty_id']."','".$frm_data['class_start_time']."',
                 '".$frm_data['class_end_time']."','".$frm_data['term_id']."','".$frm_data['paper_id']."',
                 '".$frm_data['paper_covered']."','".$frm_data['session_type']."','".$frm_data['other_class']."','".$frm_data['class_remark']."','".$frm_data['no_of_session']."')";
            
            break;
        //mid term
        case '3':
            $sql = "INSERT INTO tbl_time_table (program_id,table_range_id,trng_type,training_dt, session_no,period_type,break_time,faculty_type, faculty_id, class_start_time, class_end_time,subject_id, paper_covered,session_type,other_class,class_remark,no_of_session) 
            VALUES ('".$frm_data['program_id']."','".$frm_data['table_range_id']."','".$frm_data['trng_type']."','".$frm_data['training_dt']."','".$session_no."','".$frm_data['period_type']."','".$frm_data['break']."','".$frm_data['faculty_type']."','".$frm_data['faculty_id']."','".$frm_data['class_start_time']."',
            '".$frm_data['class_end_time']."','".$frm_data['subject_id']."','".$frm_data['paper_covered']."','".$frm_data['session_type']."','".$frm_data['other_class']."','".$frm_data['class_remark']."','".$frm_data['no_of_session']."')";
    
            break;
        //short term
        case '4':
          $sql = "INSERT INTO $table (program_id,table_range_id,trng_type,training_dt, session_no,period_type,break_time,faculty_type, faculty_id, class_start_time, class_end_time, paper_covered,session_type,other_class,class_remark,no_of_session) 
            VALUES ('".$frm_data['program_id']."','".$frm_data['table_range_id']."','".$frm_data['trng_type']."','".$frm_data['training_dt']."','".$session_no."','".$frm_data['period_type']."','".$frm_data['break']."','".$frm_data['faculty_type']."','".$frm_data['faculty_id']."','".$frm_data['class_start_time']."',
            '".$frm_data['class_end_time']."','".$frm_data['paper_covered']."','".$frm_data['session_type']."','".$frm_data['other_class']."','".$frm_data['class_remark']."','".$frm_data['no_of_session']."')";
  
          break;
        case '5':
          $sql = "INSERT INTO $table (program_id,table_range_id,trng_type,training_dt, session_no,period_type,break_time,faculty_type, faculty_id,guest_faculty_name, class_start_time, class_end_time, paper_covered,session_type,other_class,class_remark,no_of_session) 
            VALUES ('".$frm_data['program_id']."','".$frm_data['table_range_id']."','".$frm_data['trng_type']."','".$frm_data['training_dt']."','".$session_no."','".$frm_data['period_type']."','".$frm_data['break']."','".$frm_data['faculty_type']."','".$frm_data['faculty_id']."','".$frm_data['guest_faculty_name']."','".$frm_data['class_start_time']."',
            '".$frm_data['class_end_time']."','".$frm_data['paper_covered']."','".$frm_data['session_type']."','".$frm_data['other_class']."','".$frm_data['class_remark']."','".$frm_data['no_of_session']."')";
  
          break;
      }
      
      echo $sql;
      //exit;
       
        $db->insert_sql($sql);
  
       $res = $db->getResult();
       //print_r($res);exit;
      if($res){
          echo "msg#".$res[1]."#success";
          // if($res[0] > 1){
          //     if($frm_data['period_type'] == 1){
          //       $timeTable_sql = "INSERT INTO tbl_faculty_time_table (faculty_id,program_id,date,start_time,end_time) 
          //       values('".$frm_data['faculty_id']."','".$frm_data['program_id']."','".$frm_data['training_dt']."',
          //       '".$frm_data['class_start_time']."','".$frm_data['class_end_time']."')";
          //     $db->insert_sql($timeTable_sql);
          //   }
           
          // }
          
      }
      else{
        //print_r($db->getResult());
        echo "msg#".$res[0]."#error";
      }
    }
    
  }

  //sponsore time table

  
if ( isset($_POST['action']) && $_POST['action'] == 'add_sponsored_table'){
  //$term = $_POST['term'];
  $session_no = 0;
  $update_id = $_POST['update_id'];
  $table = $_POST['table'];
  $start_time = date("H:i:s", strtotime($frm_data['class_start_time']));
  $end_time =  date("H:i:s", strtotime($frm_data['class_end_time']));
  $msg = '';

  if($start_time > $end_time ){
    echo $msg =  "end#End time should be grater than Start time #error";
     exit;
 }
  //  
  if($update_id == ''){
      $db->select("tbl_sponsored_time_table","MAX(session_no) as session_no",null,"program_id= '".$frm_data['program_id']."' AND training_dt = '".$frm_data['training_dt']."' ",null,null);
      $res1 = $db->getResult();
     
      if($res1 == null) {
        $session_no = 1;
      }else{
        foreach($res1 as $row){
          $session_no = $row['session_no'] +1;
          $db->select("tbl_sponsored_time_table","class_start_time,class_end_time",null,"session_no ='".$row['session_no']."' AND program_id= '".$frm_data['program_id']."' AND training_dt = '".$frm_data['training_dt']."' ",null,null);
          $res2 = $db->getResult();
          foreach($res2 as $time){
            $old_start_time = date("H:i:s", strtotime($time['class_start_time']));
            $old_end_time =  date("H:i:s", strtotime($time['class_end_time']));
            
            if($start_time < $old_end_time ){
                echo $msg =  "start#Time period overlaps previous class #error";
                exit;
            }
          }
        
        }
      }
  }
  
  // echo $session_no;
  // exit;
 
   //update
  if ($update_id != '' ){
  // echo "123";
     $db->update($table, $frm_data,'id='.$update_id);
     $res = $db->getResult();
     //print_r($res);
      if($res){
          echo "msg#".$res[1]."#success";
      }
      else{
        //print_r($db->getResult());
        echo "msg#".$res[0]."#error";
      }
      
  }
  //add
  else{
    

        $sql = "INSERT INTO tbl_sponsored_time_table (program_id,training_dt, session_no,period_type,break_time, faculty_name, class_start_time, class_end_time, paper_covered,session_type,other_class,class_remark,no_of_session) 
          VALUES ('".$frm_data['program_id']."','".$frm_data['training_dt']."','".$session_no."','".$frm_data['period_type']."','".$frm_data['break_time']."','".$frm_data['faculty_name']."','".$frm_data['class_start_time']."',
          '".$frm_data['class_end_time']."','".$frm_data['paper_covered']."','".$frm_data['session_type']."','".$frm_data['other_class']."','".$frm_data['class_remark']."','".$frm_data['no_of_session']."')";
        
    
    //echo $sql;exit;
     
      $db->insert_sql($sql);
     // $db->insert($table, $frm_data);

     $res = $db->getResult();
     //print_r($res);
    if($res){
        echo "msg#".$res[1]."#success";
        
        
    }
    else{
      //print_r($db->getResult());
      echo "msg#".$res[0]."#error";
    }
  }
  
}
  
  //save and update of time table 
 if ( isset($_POST['action']) && $_POST['action'] == 'add_timetable_range'){
      
    // $db->select("tbl_time_table_range","*",null,'program_id='.$frm_data['program_id'],null,null);
    // $res = $db->getResult();
   
        $update_id =$_POST['update_id'];
        $table = $_POST['table'];
        $frm_data['program_id'] = $_POST['program_id'];

//echo $_POST['program_id'];
    // print_r($_POST);
    //  print_r($frm_data);

    // exit;
    
    if ($update_id != '' ){
         
      $db->update($table, $frm_data,'id='.$update_id);
      $res = $db->getResult();
     
       if($res){
        time_table_data($_POST['program_id'],'tbl_program_master');
           echo "@success@".$res[1];
       }
       else{
        
         echo "error#".$res[0];
       }
       
   }else{
        
    $trng_type = get_trngType($_POST['program_id'],'tbl_program_master');
   
    $frm_data['type']= $trng_type;
    //print_r($frm_data);
    
      $db->insert($table, $frm_data);

      $res = $db->getResult();
    
    if($res){
      time_table_data($_POST['program_id'],'tbl_program_master');
        echo "@success@".$res[1];
    }
    else{
    
      echo "error#".$res[0];
    }
   }
    
  
    
     
}

if( isset($_POST['action']) && $_POST['action'] == 'get_program_detail'){

  $edit_id = $_POST['id'];
  $table = $_POST['table'];

  time_table_data($edit_id,'tbl_short_program_master');
  // $db->select($table,"*",null,'id='.$edit_id,null,null);
  
  //  $res = $db->getResult();
  //  //print_r($res);
  //  echo json_encode($res);
}
if( isset($_POST['action']) && $_POST['action'] == 'get_program_data'){

  $edit_id = $_POST['id'];
  $table = $_POST['table'];

  
  $db->select($table,"*",null,'id='.$edit_id,null,null);
  
   $res = $db->getResult();
   //print_r($res);
   echo json_encode($res);
}

if( isset($_POST['action']) && $_POST['action'] == 'add_break_time'){
  //print_r($_POST);
   $breakTime = $_POST['breakTime'];
   $class_start_time = $_POST['class_start_time'];

   $start_time=  date("H:i:s", strtotime($class_start_time)+60*60*$breakTime);
   $break_time_cnv = date("g:i A", strtotime($start_time));

   echo $break_time_cnv;
}

if( isset($_POST['action']) && $_POST['action'] == 'delete'){

  $delete_id = $_POST['id'];
 
  $table = $_POST['table'];

  $db->delete($table,'id='.$delete_id);
  $res = $db->getResult();
 if($res){
   echo "success";
 }
 
}

?>