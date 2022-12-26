<?php
 
 
 include 'database.php';
//    print_r($_POST);
 
//    exit;
 
 $db = new Database();

 if ( isset($_POST['action']) && $_POST['action'] == 'tranee_list'){
  
    $batch_id = $_POST['batch_id'];

    $count = 0;
        $db->select('tbl_batch_master',"id,cover_latter",null,"id =".$_POST['batch_id'],null,null);
        foreach($db->getResult() as $row){
            $file_path_latter = "email_doc/".$row['cover_latter'];
            ?>
<div style="float: right">
    <label><strong> Cover Latter : </strong></label>
    <a href="<?php echo $file_path_latter; ?>" target="_blank">View Latter <img src="../images/document_pdf.png" /></a>
    <br>
</div>

<?php
        }
     ?>
<table class=" term table" id="tranee_tbl">
    <thead class="" style="background: #315682;color:#fff;font-size: 11px;">


        <th style="">Sl No</th>
        <th style="text-align:center;"> Name</th>

        <th style="text-align:center;">DOB</th>
        <th style="text-align:center;">Category</th>
        <th style="text-align:center;">Sex</th>
        <th style="text-align:center;">Email</th>
        <th style="text-align:center;">Phone</th>
        <th style="text-align:center;">Rank</th>
        <th style="text-align:center;">
            <label class="form-check-label">Send All</label><br>
            <input class="form-check-input checkAll2" type="checkbox" id="checkAll">


        </th>
    </thead>
    <tbody>
        <?php 
                               
                           
                               $db->select('tbl_new_recruite',"*",null,"fin_status = 1 AND batch_id =".$batch_id,null,null);
                            //    print_r( $db->getResult());
                            //    exit;
                               foreach($db->getResult() as $row){
                                   //print_r($row);
                                   $count++
                                   ?>
        <tr>

            <td><?php echo $count; ?></td>
            <td style="text-align:center;"><?php echo $row['f_name'] .' '.$row['l_name'];?></td>

            <td style="text-align:center;"><?php echo  date("d-m-Y", strtotime($row['dob'])) ?> </td>
            <td style="text-align:center;">
                <?php 
                                      if($row['category'] == 1){
                                          echo "UR";
                                      }
                                      else if($row['category'] == 2){
                                        echo "UR(W)";
                                    }
                                    else if($row['category'] == 3){
                                        echo "SEBC";
                                    }
                                    else if($row['category'] == 4){
                                        echo "ST";
                                    }
                                    else if($row['category'] == 5){
                                        echo "SC";
                                    }
                                  ?>
            </td>

            <td style="text-align:center;">
                <?php
                                 echo ($row['sex'] == 1) ?  "Male" : "Femail" ; 
                                
                                ?> </td>
            <td style="text-align:center;"><?php echo $row['email']; ?> </td>
            <td style="text-align:center;"><?php echo $row['phone']; ?> </td>
            <td style="text-align:center;"><?php echo $row['roll_no']; ?> </td>
            <td style="text-align:center;">
                <div class='atten' id="attendance_<?php echo  $row['program_id'] ?>">
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="inlineCheckbox1">Send Email</label>

                        <!-- <input class="form-check-input" type="checkbox" name="atten" id="present" value="1"
                            style="opacity: 1;visibility: visible;"> -->

                        <input class="form-check-input" type="checkbox" name="atten" id="present" value="1"
                            <?php echo ($row['email_status']== 1)?'checked':'' ?>
                            style="opacity: 1;visibility: visible;">

                    </div>


                </div>
                </div>
            </td>
            <td>
                <input type="hidden" name="tranee_id" id="tranee_id" value="<?php echo $row['id']; ?>">
            </td>

        </tr>
        <?php
                               }
                      
                               
                              ?>

    </tbody>
</table>
<?php

    exit;
 }

 if ( isset($_POST['action']) && $_POST['action'] == 'faculty_class_list'){
  
    $faculty_id = $_POST['faculty_id'];

    $count = 0;
        
     ?>
<table class=" term table" id="tranee_tbl">
    <thead class="" style="background: #315682;color:#fff;font-size: 11px;">


        <th>Sl No</th>
        <th style="text-align:center;">Program Name</th>

        <th style="text-align:center;">Date</th>
        <th style="text-align:center;">Class Time</th>
        <th style="text-align:center;">Subject</th>


        </th>
    </thead>
    <tbody>
        <?php 
                               
                           
                               $db->select_sql("SELECT p.prg_name,tt.training_dt,tt.class_start_time,tt.class_end_time,tt.trng_type,pm.paper_code,tt.subject_id,tt.topic_id,tt.paper_covered FROM `tbl_time_table` tt 
                                                JOIN `tbl_program_master` p ON tt.program_id = p.id
                                                LEFT JOIN `tbl_paper_master` pm ON tt.paper_id =pm.id 
                                                 WHERE tt.faculty_id = $faculty_id ");
                            //    print_r( $db->getResult());
                            //    exit;
                               foreach($db->getResult() as $row){
                                   //print_r($row);
                                   $count++
                                   ?>
        <tr>

            <td><?php echo $count; ?></td>
            <td><?php echo $row['prg_name'] ?></td>
            <td><?php echo  date("d-m-Y", strtotime($row['training_dt'])) ?> </td>
            <td><?php echo $row['class_start_time'].' - '.$row['class_end_time'] ?> </td>
            <td>
                <?php 
                  $pape_code = '';
                  if($row['trng_type'] == 1 || $row['trng_type'] == 2 ){
                       if($row['paper_covered'] != ''){
                          echo  '<p> Paper Code - '. $row['paper_code'] .'</p>'.'<p>'. $row['paper_covered'] .'</p>';
                          
                       }
                 else{
                          $db->select_one('tbl_topic_master','topic',$row['topic_id']);
                          foreach($db->getResult() as $row1){
                            echo  '<p> Paper Code - '. $row['paper_code'] .'</p>'.'<p>'. $row1['topic'] .'</p>';
                          }
                       }
                  }
                  if($row['trng_type'] == 3  ){
                        if($row['subject_id'] == -1){
                            echo  '<p> '. $row['paper_covered'] ;
                        }
                        else{
                            $db->select_one('tbl_mid_subject_master','descr',$row['subject_id']);
                            foreach($db->getResult() as $row2){
                              echo  '<p>'. $row2['descr'] .'</p>';
                            }
                        }
                  }
                ?>
            </td>
        </tr>
        <?php
                               }
                      
                               
                              ?>

    </tbody>
</table>
<?php

    exit;
 }

 if ( isset($_POST['action']) && $_POST['action'] == 'view_timetable'){
     
    $from_dt = $_POST["from_dt"];
    $to_dt = $_POST["to_dt"];

    ?>
<table class="table table-bordered" style="font-family: sans-serif; ">
    <thead style="font-size: 11px;">
        <tr>
            <th style="" scope="col">Sl No</th>
            <th style="text-align:center;" scope="col">Date</th>

            <?php  
                                               
                                                 $db->select('tbl_time_table',"MAX(session_no) as session",null," table_range_id = '".$_POST['id']."' AND trng_type =".$_POST['type'],null,null);
                                                   //print_r( $db->getResult());
                                                   foreach($db->getResult() as $seson){
                                                       
                                                        for($i=1 ; $i <= $seson['session'];$i++ ){
                                                            ?>
            <th style="text-align:center;">
                <?php 
                                                               echo $i ;
                                                               $db->select('tbl_time_table',"class_start_time,class_end_time",null,"session_no = '$i' GROUP BY session_no",null,null);
                                                               //print_r( $db->getResult());
                                                               switch ($i) {
                                                                   case '1':
                                                                      echo 'st';
                                                                       break;

                                                                    case '2':
                                                                        echo 'nd';
                                                                        break;
                                                                    case '3':
                                                                        echo 'rd';
                                                                        break;

                                                                   default:
                                                                       echo 'th';
                                                                       break;
                                                               }
                                                               
                                                               ?>



            </th>

            <?php
                                                        }
                                                   }

                                            
                                            ?>
        </tr>
    </thead>
    <tbody>
        <?php 
                               
                              
                                            $count = 0;
                                            $db->select('tbl_time_table',"DISTINCT training_dt",null,"  table_range_id = '".$_POST['id']."' AND trng_type =".$_POST['type'],null,null);
                                            // print_r( $db->getResult());
                                            foreach($db->getResult() as $row){
                                                //print_r($row);
                                                $count++
                                                ?>
        <tr>
            <td><?php echo $count; ?></td>
            <td style="text-align:center;">
                <?php echo date("d/m/Y", strtotime($row['training_dt'])); ?> </td>

            <?php
                                                    $db->select('tbl_time_table',"*",null," table_range_id = '".$_POST['id']."' AND training_dt='".$row['training_dt']."' ANd trng_type='".$_POST['type']."' ",null,null); 
                                                    //print_r( $db->getResult()); echo '<pre>';
                                                     foreach($db->getResult() as $res){
                                                         ?>
            <td class="session" id="<?php echo $res['id']; ?>" style="vertical-align: baseline;line-height:15px">
                <div>
                    <?php 
                                                            echo '<div>'.'Class time - '. $res['class_start_time'] .' - '. $res['class_end_time'].'</div>';
                                                            echo '<div style="margin-top: 10px;font-weight: 600;"> ';
                                                            if($res['trng_type'] == 1){
                                                                if($res['period_type'] == 2) {
                                                                    echo ($res['break_time'] == 1)?'Tea Break':'Lunch Break';
                                                                } 
                                                            if($res['session_type'] == 1){

                                                            if($res['paper_covered'] != '' ){
                                                              echo  $res['paper_covered'].'<br>' ;
                                                            }
                                                            else{
                                                                $db->select_one('tbl_topic_master',"topic",$res['topic_id']);
                                                                    
                                                                foreach($db->getResult() as $row3){
                                                                    echo  $row3['topic'].'<br>';
                                                                }
                                                            }
                                                            $db->select_one('tbl_paper_master',"paper_code",$res['paper_id']);
                                                                
                                                            foreach($db->getResult() as $row4){
                                                               
                                                                echo 'Paper - '.$row4['paper_code'].'<br>';
                                                            }

                                                           
                                                            $faculty_id = explode(',',$res['faculty_id']);
                                                       
                                                                foreach($faculty_id as $faculty){
                                                                    $db->select_one("tbl_faculty_master","name",$faculty);
                                                                    
                                                                    foreach($db->getResult() as $row1){
                                                                        echo $row1['name']; echo '<br>';
                                                                    }
                                                                }
                                                           }else{
                                                            echo '<div style="margin-top: 10px;font-weight: 600;">';
                                                               if($res['class_remark'] == '' ){
                                                                 
                                                                $db->select_one('other_topic',"name",$res['other_class']);
                                                                     
                                                                    foreach($db->getResult() as $row3){
                                                                        echo  $row3['name'];
                                                                    }
                                                               }else{
                                                                echo $res['class_remark'];
                                                               }
                                                           } echo '</div>';
                                                        }else{

                                                            if($res['trng_type'] == 2){
                                                                $db->select_one('tbl_mid_syllabus',"subject",$res['subject_id']);
                                                                    
                                                                foreach($db->getResult() as $row4){
                                                                    echo  $row4['subject'].'<br>';
                                                                }
                                                            } 

                                                            else if($res['trng_type'] == 3 || $res['trng_type'] == 4){
                                                                switch ($res['break_time']) {
                                                                    case '1':
                                                                        echo '<p>Tea Break<p>';
                                                                        break;
                                                                    case '2':
                                                                        echo '<p>Lunch Break<p>';
                                                                        break;
                                                                    default:
                                                                    
                                                                    // echo '<div><p>'.'Class time - '. $res['class_start_time'] .' - '. $res['class_end_time'].'</div></p>';
                                                                
                                                                    if($res['session_type'] == 1){
                                                                    if($res['paper_covered'] != '' ){
                                                                        echo '<p>'. $res['paper_covered']. '</p>' ;
                                                                    }
                                                                    else{
                                                                        $db->select_one('tbl_mid_subject_master',"descr",$res['subject_id']);
                                                                            
                                                                        foreach($db->getResult() as $row3){
                                                                            echo '<p>'. $row3['descr']. '</p>';
                                                                        }
                                                                    }
                                                                   
                                                                    
    
                                                                    $faculty_id = explode(',',$res['faculty_id']);
                                                               
                                                                        foreach($faculty_id as $faculty){
                                                                            $db->select_one("tbl_faculty_master","name",$faculty);
                                                                            
                                                                            foreach($db->getResult() as $row1){
                                                                                if($row1['name'] == 'NA'){
                                                                                    echo $res['guest_faculty_name']; echo '<br>';    
                                                                                }else{
                                                                                    echo $row1['name']; echo '<br>';
                                                                                }
                                                                                
                                                                            }
                                                                        }
                                                                   }else{
                                                                    
                                                                       if($res['class_remark'] == '' ){
                                                                         
                                                                        $db->select_one('other_topic',"name",$res['other_class']);
                                                                             
                                                                            foreach($db->getResult() as $row3){
                                                                                echo '<p>'. $row3['name']. '</p>';
                                                                            }
                                                                       }else{
                                                                        echo $res['class_remark'];
                                                                       }
                                                                   }
                                                                        break;
                                                                }
                                                            }
                                                                
                                                           // echo $res['paper_covered'];
                                                        }  
                                                           ?>
                </div>
            </td>
            <?php
                                                         
                                                     }
                                                ?>


        </tr>
        <?php
                                   }
                      
                               
                                  ?>

    </tbody>
</table>
<?php 

                                      $db->select_one('tbl_time_table_range',"status,status_dir,remark",$_POST['id']);
                                      $result = $db->getResult();
                                      foreach($result as $status){
                                         // print_r($status);
                                         if($status['status_dir'] == 0){
                                            ?>
<button type="button" class="btn btn-info" onclick="approve(<?php echo $_POST['id'] ?>,'Approve')">Approve</button>
<button type="button" class="btn btn-danger ml-2" onclick="reject(<?php echo $_POST['id'] ?>,'Reject')">Reject</button>
<?php
                                         }
                                         else{
                                           
                                            if($status['status_dir'] == 1){
                                                ?>
<button type="button" class="btn btn-info">Approved</button>
<?php
                                            }
                                            elseif($status['status_dir'] == 3){
                                                ?>
<button type="button" class="btn btn-danger">Rejected</button>
<p>Reject Comment: <?php echo $status['remark']; ?> </p>
<?php
                                            }else{
    
                                            }
                                         }
                                       
                                        
                                    }
                                    ?>

<?php
 }

 

 if ( isset($_POST['action']) && $_POST['action'] == 'view_class'){

     $program_id = $_POST['program_id'];
     $user_id = $_POST['user_id'];
     $faculty_phone = $_POST['faculty_phone'];
      
     //$db->select_one('tbl_user','name',$user_id);
     $db->select('tbl_faculty_master',"id",null,"phone= '$faculty_phone' ",null,null);
        foreach($db->getResult() as $faculty){
            $faculty_id =  $faculty['id'];
        }
      //echo $faculty_id;
          ?>

<table class=" term table" id="tableid">
    <thead class="" style="background: #315682;color:#fff;font-size: 11px;">

        <th style="">Sl No</th>
        <th style="text-align:center;">Date</th>
        <th style="text-align:center;">Class Topic</th>
        <th style="text-align:center;">Session No</th>
        <th style="text-align:center;">Attendance</th>
        <th style="text-align:center;">PPT</th>
        <th style="text-align:center;">PDF DOC</th>
    </thead>
    <tbody>
        <?php
                        $db->select('tbl_time_table',"*",null,"faculty_id= '$faculty_id'  AND program_id = $program_id ",null,null);
                        $count = 0;
                       // print_r($db->getResult());
                        foreach($db->getResult() as $row){
                        $count++;
                        //print_r($row);            
                    ?>
        <tr>
            <td><?php echo $count; ?></td>

            <td style="text-align:center;"><?php echo date("d-m-Y", strtotime($row['training_dt'])) ; ?></td>
            <td style="text-align:center;">
                <?php 
               
                if($row['detail_topic_id'] != ''){
                    $db->select_one('tbl_detail_topic_master',"dtl_topic",$row['detail_topic_id']);
                    //print_r($db->getResult())  ;                                              
                    foreach($db->getResult() as $row4){
                        echo  $row4['dtl_topic'].'<br>';
                    }
                }
                else{
                    echo $row['paper_covered'];
                }
                ?>


            </td>
            <td style="text-align:center;">
                <?php echo $row['session_no'].'<br>('.$row['class_start_time'].'-'.$row['class_end_time'].')' ?></td>

            <td style="text-align:center;">
                <?php
                   
                   $db->select('tbl_attendance',"DISTINCT(time_tbl_id),status",null,"time_tbl_id = '".$row['id']."' ",null,null);
                   $res_attn = $db->getResult();
                   if($res_attn){
                    foreach($res_attn as $row_attn){
                        //print_r($row_attn);
                        switch ($row_attn['status']) {
                            case '0':
                             ?>
                <input type="button" class="btn btn-primary" style="background:#3292a2"
                    onclick="traneeList(<?php echo $row['id'] ?>,<?php echo $row['program_id'] ?>,<?php echo $row['session_no']; ?>)"
                    name="send" value="Take Attendance" />
                <?php
                            case '1':
                                ?>
                <button class="btn btn-primary"
                    onclick="tranieList_edit(<?php echo $row_attn['time_tbl_id'] ?>,<?php echo $row['program_id'] ?>,<?php echo $row['session_no']; ?>)">Edit
                </button>
                <button class="btn btn-success">Save </button>
                <?php
                                break;
                            
                            default:
                            
                                break;
                        }
                    }
                   }else{
                    ?>
                <input type="button" class="btn btn-primary" style="background:#3292a2"
                    onclick="traneeList(<?php echo $row['id'] ?>,<?php echo $row['program_id'] ?>,<?php echo $row['session_no']; ?>)"
                    name="send" value="Take Attendance" />
                <?php
                   }
                   
                
                ?>

            </td>
            <td style="text-align:center;">
                <?php
                    $db->select('tbl_tranning_document',"id,time_tbl_id,doc_name",null,"doc_type = 'ppt_doc'AND time_tbl_id =".$row['id'],null,null);
                    $res5 = $db->getResult();
                    //print_r($res5);
                    if($res5){
                        foreach($res5 as $row5){
                            //print_r($res5);
                            $file_path_latter = "course_material/".$row5['doc_name'];
                            if($row5['doc_name']== ''){
                                ?>
                <input type="button" class="btn btn-info"
                    onclick="upload_ppt(<?php echo $row['id'] ?>,<?php echo $row['program_id'] ?>,<?php echo $row['session_no']; ?>)"
                    name="send" value="Upload PDF" />
                <?php
                            }
                            else{
                                ?>

                <a href="<?php echo $file_path_latter; ?>" target="_blank">PPT <img
                        src="../images/document_pdf.png" /></a>
                <a href="#" class="remove" id="<?php echo $row5['id'] ?>" onclick="remove(this.id)"> <img
                        src="../images/cross.png" /></a>

                <?php
                            }
                            //print_r($row5);
                        }
                    }
                    else{

                        ?>
                <input type="button" class="btn btn-info"
                    onclick="upload_ppt(<?php echo $row['id'] ?>,<?php echo $row['program_id'] ?>,<?php echo $row['session_no']; ?>)"
                    name="send" value="Upload PPT" />
                <?php
                    }
                    
                
                ?>

            </td>
            <td style="text-align:center;">
                <?php

               $db->select('tbl_tranning_document',"id,time_tbl_id,doc_name",null,"doc_type = 'pdf_doc'AND time_tbl_id =".$row['id'],null,null);
               $res5 = $db->getResult();
               //print_r($res5);
               if($res5){
                   foreach($res5 as $row5){
                       //print_r($res5);
                       $file_path_latter = "course_material/".$row5['doc_name'];
                       if($row5['doc_name']== ''){
                           ?>
                <input type="button" class="btn btn-warning"
                    onclick="upload_pdf(<?php echo $row['id'] ?>,<?php echo $row['program_id'] ?>,<?php echo $row['session_no']; ?>)"
                    name="send" value="Upload pdf Doc" />
                <?php
                       }
                       else{
                           ?>

                <a href="<?php echo $file_path_latter; ?>" target="_blank">PDF Doc <img
                        src="../images/document_pdf.png" /></a>
                <a href="#" class="remove" id="<?php echo $row5['id'] ?>" onclick="remove(this.id)"> <img
                        src="../images/cross.png" /></a>

                <?php
                       }
                       //print_r($row5);
                   }
               }
               else{

                   ?>
                <input type="button" class="btn btn-warning"
                    onclick="upload_pdf(<?php echo $row['id'] ?>,<?php echo $row['program_id'] ?>,<?php echo $row['session_no']; ?>)"
                    name="send" value="Upload PDF" />
                <?php
               }
               
            
            ?>

            </td>
        </tr>
        <?php
                                          }
                                         ?>

    </tbody>
</table>

<?php
      
     
 }

 
 if ( isset($_POST['action']) && $_POST['action'] == 'view_class_course_co'){

    $program_id = $_POST['program_id'];
    $faculty_id = $_POST['faculty_id'];
     
         ?>

<table class=" term table" id="tableid">
    <thead class="" style="background: #315682;color:#fff;font-size: 11px;">

        <th>Sl No</th>
        <th style="text-align:center;">Date</th>
        <th style="text-align:center;">Class Topic</th>
        <th style="text-align:center;">Session No</th>
        <th style="text-align:center;">Attendance</th>
        <th style="text-align:center;">PPT</th>
        <th style="text-align:center;">PDF DOC</th>
    </thead>
    <tbody>
        <?php
                       $db->select('tbl_time_table',"*",null,"faculty_id= '$faculty_id'  AND program_id = $program_id ",null,null);
                       $count = 0;
                      // print_r($db->getResult());
                       foreach($db->getResult() as $row){
                       $count++;
                       //print_r($row);            
                   ?>
        <tr>
            <td><?php echo $count; ?></td>

            <td style="text-align:center;"><?php echo date("d-m-Y", strtotime($row['training_dt'])) ; ?></td>
            <td style="text-align:center;">
                <?php 
              
               if($row['detail_topic_id'] != ''){
                   $db->select_one('tbl_detail_topic_master',"dtl_topic",$row['detail_topic_id']);
                   //print_r($db->getResult())  ;                                              
                   foreach($db->getResult() as $row4){
                       echo  $row4['dtl_topic'].'<br>';
                   }
               }
               else{
                   echo $row['paper_covered'];
               }
               ?>


            </td>
            <td style="text-align:center;">
                <?php echo $row['session_no'].'<br>('.$row['class_start_time'].'-'.$row['class_end_time'].')' ?></td>

            <td style="text-align:center;">
                <?php
                  
                  $db->select('tbl_attendance',"DISTINCT(time_tbl_id),status",null,"time_tbl_id = '".$row['id']."' ",null,null);
                  $res_attn = $db->getResult();
                  if($res_attn){
                   foreach($res_attn as $row_attn){
                       //print_r($row_attn);
                       switch ($row_attn['status']) {
                           case '0':
                            ?>
                <input type="button" class="btn btn-primary" style="background:#3292a2"
                    onclick="traneeList(<?php echo $row['id'] ?>,<?php echo $row['program_id'] ?>,<?php echo $row['session_no']; ?>)"
                    name="send" value="Take Attendance" />
                <?php
                           case '1':
                               ?>
                <button class="btn btn-primary"
                    onclick="tranieList_edit(<?php echo $row_attn['time_tbl_id'] ?>,<?php echo $row['program_id'] ?>,<?php echo $row['session_no']; ?>)">Edit
                </button>
                <!-- <button class="btn btn-success">Save </button> -->
                <?php
                               break;
                           
                           default:
                           
                               break;
                       }
                   }
                  }else{
                   ?>
                <input type="button" class="btn btn-primary" style="background:#3292a2"
                    onclick="traneeList(<?php echo $row['id'] ?>,<?php echo $row['program_id'] ?>,<?php echo $row['session_no']; ?>)"
                    name="send" value="Take Attendance" />
                <?php
                  }
                  
               
               ?>

            </td>
            <td style="text-align:center;">
                <?php
                   $db->select('tbl_tranning_document',"id,time_tbl_id,doc_name",null,"doc_type = 'ppt_doc'AND time_tbl_id =".$row['id'],null,null);
                   $res5 = $db->getResult();
                   //print_r($res5);
                   if($res5){
                       foreach($res5 as $row5){
                           //print_r($res5);
                           $file_path_latter = "course_material/".$row5['doc_name'];
                           if($row5['doc_name']== ''){
                               ?>
                <input type="button" class="btn btn-info"
                    onclick="upload_ppt(<?php echo $row['id'] ?>,<?php echo $row['program_id'] ?>,<?php echo $row['session_no']; ?>)"
                    name="send" value="Upload PDF" />
                <?php
                           }
                           else{
                               ?>

                <a href="<?php echo $file_path_latter; ?>" target="_blank">PPT <img
                        src="../images/document_pdf.png" /></a>
                <a href="#" class="remove" id="<?php echo $row5['id'] ?>" onclick="remove(this.id)"> <img
                        src="../images/cross.png" /></a>

                <?php
                           }
                           //print_r($row5);
                       }
                   }
                   else{

                       ?>
                <input type="button" class="btn btn-info"
                    onclick="upload_ppt(<?php echo $row['id'] ?>,<?php echo $row['program_id'] ?>,<?php echo $row['session_no']; ?>)"
                    name="send" value="Upload PPT" />
                <?php
                   }
                   
               
               ?>

            </td>
            <td style="text-align:center;">
                <?php

              $db->select('tbl_tranning_document',"id,time_tbl_id,doc_name",null,"doc_type = 'pdf_doc'AND time_tbl_id =".$row['id'],null,null);
              $res5 = $db->getResult();
              //print_r($res5);
              if($res5){
                  foreach($res5 as $row5){
                      //print_r($res5);
                      $file_path_latter = "course_material/".$row5['doc_name'];
                      if($row5['doc_name']== ''){
                          ?>
                <input type="button" class="btn btn-warning"
                    onclick="upload_pdf(<?php echo $row['id'] ?>,<?php echo $row['program_id'] ?>,<?php echo $row['session_no']; ?>)"
                    name="send" value="Upload pdf Doc" />
                <?php
                      }
                      else{
                          ?>

                <a href="<?php echo $file_path_latter; ?>" target="_blank">PDF Doc <img
                        src="../images/document_pdf.png" /></a>
                <a href="#" class="remove" id="<?php echo $row5['id'] ?>" onclick="remove(this.id)"> <img
                        src="../images/cross.png" /></a>

                <?php
                      }
                      //print_r($row5);
                  }
              }
              else{

                  ?>
                <input type="button" class="btn btn-warning"
                    onclick="upload_pdf(<?php echo $row['id'] ?>,<?php echo $row['program_id'] ?>,<?php echo $row['session_no']; ?>)"
                    name="send" value="Upload PDF" />
                <?php
              }
              
           
           ?>

            </td>
        </tr>
        <?php
                                         }
                                        ?>

    </tbody>
</table>

<?php
     
    
}
 
 
 if ( isset($_POST['action']) && $_POST['action'] == 'view_class_co'){

    $program_id = $_POST['program_id'];
   
     
         ?>

<table class=" term table" id="tableid">
    <thead class="" style="background: #315682;color:#fff;font-size: 11px;">

        <th>Sl No</th>
        <th style="text-align:center;">Program Name</th>
        <th style="text-align:center;">Date</th>
        <th style="text-align:center;">Session No</th>
        <th style="text-align:center;">Start Time</th>
        <th style="text-align:center;">End Time</th>
        <th style="text-align:center;">Attendance</th>
        <!-- <th style="text-align:center;">PPT</th>
       <th style="text-align:center;">PDF DOC</th> -->


    </thead>
    <tbody>
        <?php
                       $db->select('tbl_time_table',"*",null," program_id = $program_id ",null,null);
                       $count = 0;
                       foreach($db->getResult() as $row){
                       $count++;
                                   
                   ?>
        <tr>
            <td><?php echo $count; ?></td>
            <td style="text-align:center;">
                <?php 
                                                       $db->select_one('tbl_program_master',"id,prg_name",$row['program_id']);
                                                      
                                                       foreach($db->getResult() as $row1){
                                                           echo $prog_name = $row1['prg_name'];
                                                               
                                                       }
                                                     
                                                       ?>
            </td>
            <td style="text-align:center;"><?php echo date("d-m-Y", strtotime($row['training_dt'])) ; ?></td>
            <td style="text-align:center;"><?php echo $row['session_no']; ?></td>
            <td style="text-align:center;"><?php echo $row['class_start_time']; ?></td>
            <td style="text-align:center;"><?php echo $row['class_end_time']; ?></td>
            <td style="text-align:center;">
                <?php
                  
                  $db->select('tbl_attendance',"DISTINCT(time_tbl_id),status",null,"time_tbl_id = '".$row['id']."' ",null,null);
                  $res_attn = $db->getResult();
                  if($res_attn){
                   foreach($res_attn as $row_attn){
                       //print_r($row_attn);
                       switch ($row_attn['status']) {
                           case '0':
                            ?>
                <input type="button" class="btn btn-primary" style="background:#3292a2"
                    onclick="traneeList(<?php echo $row['id'] ?>,<?php echo $row['program_id'] ?>,<?php echo $row['session_no']; ?>)"
                    name="send" value="Take Attendance" />
                <?php
                           case '1':
                               ?>
                <button class="btn btn-primary"
                    onclick="tranieList_edit(<?php echo $row_attn['time_tbl_id'] ?>,<?php echo $row['program_id'] ?>,<?php echo $row['session_no']; ?>)">Edit
                </button>
                <button class="btn btn-success">Save </button>
                <?php
                               break;
                           
                           default:
                           
                               break;
                       }
                   }
                  }else{
                   ?>
                <input type="button" class="btn btn-primary" style="background:#3292a2"
                    onclick="traneeList(<?php echo $row['id'] ?>,<?php echo $row['program_id'] ?>,<?php echo $row['session_no']; ?>)"
                    name="send" value="Take Attendance" />
                <?php
                  }
                  
               
               ?>

            </td>
            <td style="text-align:center;">
                <?php
                   $db->select('tbl_tranning_document',"id,time_tbl_id,doc_name",null,"doc_type = 'ppt_doc'AND time_tbl_id =".$row['id'],null,null);
                   $res5 = $db->getResult();
                   //print_r($res5);
                   if($res5){
                       foreach($res5 as $row5){
                           //print_r($res5);
                           $file_path_latter = "course_material/".$row5['doc_name'];
                           if($row5['doc_name']== ''){
                               ?>
                <input type="button" class="btn btn-info"
                    onclick="upload_ppt(<?php echo $row['id'] ?>,<?php echo $row['program_id'] ?>,<?php echo $row['session_no']; ?>)"
                    name="send" value="Upload PPT" />
                <?php
                           }
                           else{
                               ?>

                <a href="<?php echo $file_path_latter; ?>" target="_blank">PPT <img
                        src="../images/document_pdf.png" /></a>
                <a href="#" class="remove" id="<?php echo $row5['id'] ?>" onclick="remove(this.id)"> <img
                        src="../images/cross.png" /></a>

                <?php
                           }
                           //print_r($row5);
                       }
                   }
                   else{

                       ?>
                <input type="button" class="btn btn-info"
                    onclick="upload_ppt(<?php echo $row['id'] ?>,<?php echo $row['program_id'] ?>,<?php echo $row['session_no']; ?>)"
                    name="send" value="Upload PPT" />
                <?php
                   }
                   
               
               ?>

            </td>
            <td style="text-align:center;">
                <?php

              $db->select('tbl_tranning_document',"id,time_tbl_id,doc_name",null,"doc_type = 'pdf_doc'AND time_tbl_id =".$row['id'],null,null);
              $res5 = $db->getResult();
              //print_r($res5);
              if($res5){
                  foreach($res5 as $row5){
                      //print_r($res5);
                      $file_path_latter = "course_material/".$row5['doc_name'];
                      if($row5['doc_name']== ''){
                          ?>
                <input type="button" class="btn btn-warning"
                    onclick="upload_pdf(<?php echo $row['id'] ?>,<?php echo $row['program_id'] ?>,<?php echo $row['session_no']; ?>)"
                    name="send" value="Upload pdf Doc" />
                <?php
                      }
                      else{
                          ?>

                <a href="<?php echo $file_path_latter; ?>" target="_blank">PDF Doc <img
                        src="../images/document_pdf.png" /></a>
                <a href="#" class="remove" id="<?php echo $row5['id'] ?>" onclick="remove(this.id)"> <img
                        src="../images/cross.png" /></a>

                <?php
                      }
                      //print_r($row5);
                  }
              }
              else{

                  ?>
                <input type="button" class="btn btn-warning"
                    onclick="upload_pdf(<?php echo $row['id'] ?>,<?php echo $row['program_id'] ?>,<?php echo $row['session_no']; ?>)"
                    name="send" value="Upload PPT" />
                <?php
              }
              
           
           ?>

            </td>
        </tr>
        <?php
                                         }
                                        ?>

    </tbody>
</table>

<?php
     
    
}


if ( isset($_POST['action']) && $_POST['action'] == 'view_sponsored_class'){

    $program_id = $_POST['program_id'];
    $trng_dt = $_POST['trng_dt'];
    $trng_type = $_POST['trng_type'];
    
     //echo $faculty_id;
         ?>

<table class=" term table" id="tableid">
    <thead class="" style="background: #315682;color:#fff;font-size: 11px;">

        <th style="">Sl No</th>
        <th style="text-align:center;">Date</th>
        <th style="text-align:center;">Subject</th>
        <th style="text-align:center;">Class Time</th>
        <th style="text-align:center;">Faculty Name</th>
        <th style="text-align:center;">Attendance</th>
        <th style="text-align:center;">Upload Document</th>

    </thead>
    <tbody>
        <?php
                       $db->select('tbl_sponsored_time_table',"*",null,"training_dt= '$trng_dt'  AND program_id = $program_id AND period_type = 1 ",null,null);
                       $count = 0;
                      // print_r($db->getResult());
                       foreach($db->getResult() as $row){
                       $count++;
                       //print_r($row);            
                   ?>
        <tr>
            <td><?php echo $count; ?></td>

            <td style="text-align:center;"><?php echo date("d-m-Y", strtotime($row['training_dt'])) ; ?></td>
            <td style="text-align:center;"> <?php  echo $row['paper_covered'];  ?></td>
            <td style="text-align:center;"><?php echo $row['class_start_time'].' - '.$row['class_end_time'] ?></td>
            <td style="text-align:center;"> <?php  echo $row['faculty_name'];  ?></td>
            <td style="text-align:center;">
                <?php
                  
                  $db->select('tbl_sponsored_attendance',"DISTINCT(time_tbl_id),status",null,"time_tbl_id = '".$row['id']."' ",null,null);
                  $res_attn = $db->getResult();
                  if($res_attn){
                   foreach($res_attn as $row_attn){
                       //print_r($row_attn);
                       switch ($row_attn['status']) {
                           case '0':
                            ?>
                <input type="button" class="btn btn-primary" style="background:#3292a2"
                    onclick="traneeList(<?php echo $row['id'] ?>,<?php echo $row['program_id'] ?>,<?php echo $row['session_no']; ?>)"
                    name="send" value="Take Attendance" />
                <?php
                           case '1':
                               ?>
                <button class="btn btn-primary"
                    onclick="tranieList_edit(<?php echo $row_attn['time_tbl_id'] ?>,<?php echo $row['program_id'] ?>,<?php echo $row['session_no']; ?>)">Edit
                </button>
                <button class="btn btn-success">Save </button>
                <?php
                               break;
                           
                           default:
                           
                               break;
                       }
                   }
                  }else{
                   ?>
                <input type="button" class="btn btn-primary" style="background:#3292a2"
                    onclick="traneeList(<?php echo $row['id'] ?>,<?php echo $row['program_id'] ?>,<?php echo $row['session_no']; ?>)"
                    name="send" value="Take Attendance" />
                <?php
                  }
                  
               
               ?>

            </td>
            <td style="text-align:center;">
                <?php
                   $db->select('tbl_tranning_document',"id,time_tbl_id,doc_name",null,"doc_type = 'ppt_doc'AND time_tbl_id =".$row['id'],null,null);
                   $res5 = $db->getResult();
                   //print_r($res5);
                   if($res5){
                       foreach($res5 as $row5){
                           //print_r($res5);
                           $file_path_latter = "course_material/".$row5['doc_name'];
                           if($row5['doc_name']== ''){
                               ?>
                <input type="button" class="btn btn-info"
                    onclick="upload_ppt(<?php echo $row['id'] ?>,<?php echo $trng_type ?>,<?php echo $row['program_id'] ?>,<?php echo $row['session_no']; ?>)"
                    name="send" value="Upload PDF" />
                <?php
                           }
                           else{
                               ?>

                <a href="<?php echo $file_path_latter; ?>" target="_blank">PPT <img
                        src="../images/document_pdf.png" /></a>
                <a href="#" class="remove" id="<?php echo $row5['id'] ?>" onclick="remove(this.id)"> <img
                        src="../images/cross.png" /></a>

                <?php
                           }
                           //print_r($row5);
                       }
                   }
                   else{

                       ?>
                <input type="button" class="btn btn-info"
                    onclick="upload_ppt(<?php echo $row['id'] ?>,<?php echo $trng_type ?>,<?php echo $row['program_id'] ?>,<?php echo $row['session_no']; ?>)"
                    name="send" value="Upload" />
                <?php
                   }
                   
               
               ?>

            </td>

        </tr>
        <?php
                                         }
                                        ?>

    </tbody>
</table>

<?php
     
    
}


if ( isset($_POST['action']) && $_POST['action'] == 'view_sponsored_class_upload'){

    $program_id = $_POST['program_id'];
    $trng_dt = $_POST['trng_dt'];
    $trng_type = $_POST['trng_type'];
    
     //echo $faculty_id;
         ?>

<table class=" term table" id="tableid">
    <thead class="" style="background: #315682;color:#fff;font-size: 11px;">

        <th style="">Sl No</th>
        <th style="text-align:center;">Date</th>
        <th style="text-align:center;">Subject</th>
        <th style="text-align:center;">Class Time</th>
        <th style="text-align:center;">Faculty Name</th>

        <th style="text-align:center;">Upload Document</th>
        <th style="text-align:center;">Add More</th>

    </thead>
    <tbody>
        <?php
                       $db->select('tbl_sponsored_time_table',"*",null,"training_dt= '$trng_dt'  AND program_id = $program_id AND period_type = 1 ",null,null);
                       $count = 0;
                      // print_r($db->getResult());
                       foreach($db->getResult() as $row){
                       $count++;
                       //print_r($row);            
                   ?>
        <tr>
            <td><?php echo $count; ?></td>

            <td style="text-align:center;"> <?php echo date("d-m-Y", strtotime($row['training_dt'])) ; ?></td>
            <td style="text-align:center;"> <?php echo $row['paper_covered'];  ?></td>
            <td style="text-align:center;"> <?php echo $row['class_start_time'].' - '.$row['class_end_time'] ?></td>
            <td style="text-align:center;"> <?php echo $row['faculty_name'];  ?></td>

            <td style="text-align:center;">
                <?php
                  $doc_name = '';
                   $db->select('tbl_tranning_document',"id,time_tbl_id,doc_name",null,"time_tbl_id =".$row['id'],null,null);
                   $res5 = $db->getResult();
                   //print_r($res5);

                   if($res5){
                       foreach($res5 as $row5){
                        $doc_name = $row5['doc_name'];
                          
                           if($row5['doc_name']== ''){
                               ?>
                            <input type="button" class="btn btn-info"
                                onclick="upload_ppt(<?php echo $row['id'] ?>,<?php echo $trng_type ?>,<?php echo $row['program_id'] ?>,<?php echo $row['session_no']; ?>)"
                                name="send" value="Upload PDF" />
                <?php
                           }
                           else{

                            $doc_name1 = explode(",",$row5['doc_name']);
                            foreach($doc_name1 as $single_doc){
                               // print_r($single_doc);
                                $file_path_latter = "course_material/".$single_doc;
                                ?>
                                  <a class="mr-2" href="<?php echo $file_path_latter; ?>" target="_blank">Doc <img
                                      src="../images/document_pdf.png" /></a>
                                  <a class="mr-2" href="#" class="remove" id="<?php echo $row5['id'] ?>" onclick="remove(this.id, '<?php echo $single_doc ?>')"> <img
                                      src="../images/cross.png" /></a><br>
                                <?php
                            }
                               ?>
                           
               

                <?php
                           }
                           //print_r($row5);
                       }
                   }
                   else{

                       ?>
                <input type="button" class="btn btn-info"
                    onclick="upload_ppt(<?php echo $row['id'] ?>,<?php echo $trng_type ?>,<?php echo $row['program_id'] ?>,<?php echo $row['session_no']; ?>)"
                    name="send" value="Upload" />
                <?php
                   }
                   
               
               ?>

            </td>
            <td style="text-align:center;"> <a href="#" class="add_more text-success" style="display:<?php echo ($doc_name == '')?'none':'' ?>"
            
            onclick="upload_ppt(<?php echo $row['id'] ?>,<?php echo $trng_type ?>,<?php echo $row['program_id'] ?>,<?php echo $row['session_no']; ?>)">
            
            <i class="fa fa-plus-circle" aria-hidden="true"></i>Add_more</a></td>

        </tr>
        <?php
                                         }
                                        ?>

    </tbody>
</table>

<?php
     
    
}

if ( isset($_POST['action']) && $_POST['action'] == 'view_class_attn'){

    $program_id = $_POST['program_id'];
    $attn_date = $_POST['attn_date'];
    $count = 0;
    ?>

<table class=" term table" id="tbl_attandance">
    <thead class="" style="background: #315682;color:#fff;font-size: 11px;">
        <th style="">Sl No</th>
        <th style="text-align:center;">Class</th>
        <th style="text-align:center;">Class Time</th>
        <th style="text-align:center;">Faculty</th>
        <th style="text-align:center;">View</th>

    </thead>
    <tbody>
        <?php
             $class_sql= "SELECT t.id,t.class_start_time,t.class_end_time,f.name,f.desig,top.topic FROM `tbl_time_table` t 
             JOIN `tbl_faculty_master` f ON t.faculty_id = f.id 
             JOIN `tbl_topic_master` top ON t.topic_id = top.id
             WHERE program_id = '$program_id' AND training_dt = '".$attn_date."' " ;
             
             $db->select_sql($class_sql);
             foreach($db->getResult() as $row1){
                $count++;
                 ?>
        <tr class="row_class">
            <td><?php echo $count; ?></td>
            <td><?php echo $row1['topic'];?></td>
            <td style="text-align:center;"><?php echo $row1['class_start_time'].' to '.$row1['class_end_time']; ?> </td>
            <td><?php echo $row1['name'].', '.$row1['desig']; ?> </td>
            <td style="text-align:center;">
                <input type="button" class="btn btn-primary" style="background:#3292a2"
                    onclick="traneeAttnList(<?php echo $row1['id'] ?>)" value=" View" />
            </td>
        </tr>
        <?php
             }
           ?>
    </tbody>
</table>


<?php
    
}

if ( isset($_POST['action']) && $_POST['action'] == 'tranee_atn_list'){
     
   
    $timeTable_id = $_POST['timeTable_id'];
    $count =0;


    ?>
<table class=" term table" id="tbl_attandance">
    <thead class="" style="background: #315682;color:#fff;font-size: 11px;">


        <th style="">Sl No</th>
        <th style="text-align:center;">Name</th>
        <th style="text-align:center;">Email</th>
        <th style="text-align:center;">Phone</th>

        <th style="text-align:center;">Attendance

        </th>

    </thead>
    <tbody>
        <?php
                 
                 $db->select('tbl_attendance',"*",null,"time_tbl_id =".$timeTable_id,null,null);
                
                    foreach($db->getResult() as $row){
                       // print_r($row);
                        $count++;
                        ?>
        <tr class="row_attendance">
            <td><?php echo $count; ?></td>
            <td><?php echo $row['name'];?></td>
            <td><?php echo $row['email']; ?> </td>
            <td style="text-align:center;"><?php echo $row['phone']; ?> </td>

            <td style="text-align:center;"><?php echo ($row['present']== 1)?'Present':'Absent' ?> </td>




        </tr>

        <?php
                    }
               ?>

    </tbody>
</table>

<?php

}
  
 if ( isset($_POST['action']) && $_POST['action'] == 'tranee_atn_edit'){
     
    $program_id = $_POST['program_id'];
    $session_no = $_POST['session_no'];
    $timeTable_id = $_POST['timeTable_id'];
    $count =0;


    ?>
<table class=" term table" id="tbl_attandance">
    <thead class="" style="background: #315682;color:#fff;font-size: 11px;">


        <th style="">Sl No</th>
        <th style="text-align:center;">Name</th>
        <th style="text-align:center;">Email</th>
        <th style="text-align:center;">Phone</th>

        <th style="text-align:center;">Attendance

        </th>
        <th></th>
    </thead>
    <tbody>
        <?php
                 
                 $db->select('tbl_attendance',"*",null,"time_tbl_id =".$timeTable_id,null,null);
                
                    foreach($db->getResult() as $row){
                       // print_r($row);
                        $count++;
                        ?>
        <tr class="row_attendance">
            <td><?php echo $count; ?></td>
            <td style="text-align:center;"><?php echo $row['name'];?></td>
            <td style="text-align:center;"><?php echo $row['email']; ?> </td>
            <td style="text-align:center;"><?php echo $row['phone']; ?> </td>

            <td style="text-align:center;">
                <div class='atten' id="attendance">
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="inlineCheckbox1">Present</label>

                        <input class="form-check-input" type="checkbox" name="atten" id="present" value="1"
                            <?php echo ($row['present']== 1)?'checked':'' ?> style="opacity: 1;visibility: visible;">
                    </div>
                    <!-- <div class="form-check form-check-inline">
                        <label class="form-check-label" for="inlineCheckbox2">Absent</label>
                        <input class="form-check-input" type="checkbox" name="atten" id="absent" value="2"
                            style="opacity: 1;visibility: visible;"> -->

                </div>
                </div>
            </td>
            <td><input type="hidden" name="trainee_id" value=<?php echo $row['id']; ?> /></td>

        </tr>

        <?php
                    }
               ?>

    </tbody>
</table>
<input type="hidden" name="update_id" id="update_id" value="<?php echo $timeTable_id ?>">

<!-- <input type="button" class="btn btn-primary" style="background:#3292a2"
    onclick="save_attendance(<?php echo $timeTable_id ?>,<?php echo $program_id ?>,<?php echo $session_no ?>)"
    name="send" value="save" /> -->
<?php

}



 
 if ( isset($_POST['action']) && $_POST['action'] == 'tranee_atn'){
     
    $program_id = $_POST['program_id'];
    $session_no = $_POST['session_no'];
    $timeTable_id = $_POST['timeTable_id'];
    $count =0;


    ?>
<table class=" term table" id="tbl_attandance">
    <thead class="" style="background: #315682;color:#fff;font-size: 11px;">


        <th>Sl No</th>
        <th style="text-align:center;">Name</th>
        <th style="text-align:center;">Email</th>
        <th style="text-align:center;">Phone</th>

        <th style="text-align:center;">Attendance <br>
            <input class="form-check-input checkAll2" type="checkbox" id="checkAll">

            <label class="form-check-label">Present All</label>
        </th>

    </thead>
    <tbody>
        <?php
                 
                 $db->select('tbl_new_recruite',"*",null,"fin_status = 1  AND program_id =".$program_id,null,null);
                
                    foreach($db->getResult() as $row){
                        $count++;
                        ?>
        <tr class="row_attendance">
            <td><?php echo $count; ?></td>
            <td style="text-align:center;"><?php echo $row['f_name'] .' '.$row['l_name'];?></td>
            <td style="text-align:center;"><?php echo $row['email']; ?> </td>
            <td style="text-align:center;"><?php echo $row['phone']; ?> </td>

            <td style="text-align:center;">
                <div class='atten' id="attendance_<?php echo  $row['program_id'] ?>">
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="inlineCheckbox1">Present</label>

                        <input class="form-check-input" type="checkbox" name="atten" id="present" value="1"
                            style="opacity: 1;visibility: visible;">
                    </div>

                </div>
                </div>
            </td>

        </tr>

        <?php
                    }
               ?>

    </tbody>
</table>
<input type="hidden" name="timeTable_id" id="timeTable_id" value="<?php echo $timeTable_id ?>">
<input type="hidden" name="program_id" id="program_id" value="<?php echo $program_id ?>">
<input type="hidden" name="session_no" id="session_no" value="<?php echo $session_no ?>">

<!-- <input type="button" class="btn btn-primary" style="background:#3292a2"
    onclick="save_attendance(<?php echo $timeTable_id ?>,<?php echo $program_id ?>,<?php echo $session_no ?>)"
    name="send" value="save" /> -->
<?php

}


if ( isset($_POST['action']) && $_POST['action'] == 'sponsored_tranee_atn'){
     
    $program_id = $_POST['program_id'];
    $session_no = $_POST['session_no'];
    $timeTable_id = $_POST['timeTable_id'];
    $count =0;


    ?>
<table class=" term table" id="tbl_attandance">
    <thead class="" style="background: #315682;color:#fff;font-size: 11px;">


        <th>Sl No</th>
        <th style="text-align:center;">Name</th>
        <th style="text-align:center;">Email</th>
        <th style="text-align:center;">Phone</th>

        <th style="text-align:center;">Attendance <br>
            <input class="form-check-input checkAll2" type="checkbox" id="checkAll">

            <label class="form-check-label">Present All</label>
        </th>

    </thead>
    <tbody>
        <?php
                 
                 $db->select('tbl_dept_trainee_registration',"*",null,"program_id =".$program_id,null,null);
                
                    foreach($db->getResult() as $row){
                        $count++;
                        ?>
        <tr class="row_attendance">
            <td><?php echo $count; ?></td>
            <td style="text-align:center;"><?php echo $row['name'] ;?></td>
            <td style="text-align:center;"><?php echo $row['email']; ?> </td>
            <td style="text-align:center;"><?php echo $row['phone']; ?> </td>

            <td style="text-align:center;">
                <div class='atten' id="attendance_<?php echo  $row['program_id'] ?>">
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="inlineCheckbox1">Present</label>

                        <input class="form-check-input" type="checkbox" name="atten" id="present" value="1"
                            style="opacity: 1;visibility: visible;">
                    </div>

                </div>
                </div>
            </td>

        </tr>

        <?php
                    }
               ?>

    </tbody>
</table>
<input type="hidden" name="timeTable_id" id="timeTable_id" value="<?php echo $timeTable_id ?>">
<input type="hidden" name="program_id" id="program_id" value="<?php echo $program_id ?>">
<input type="hidden" name="session_no" id="session_no" value="<?php echo $session_no ?>">

<?php

}

if ( isset($_POST['action']) && $_POST['action'] == 'sponsored_tranee_atn_edit'){
     
    $program_id = $_POST['program_id'];
    $session_no = $_POST['session_no'];
    $timeTable_id = $_POST['timeTable_id'];
    $count =0;


    ?>
<table class=" term table" id="tbl_attandance">
    <thead class="" style="background: #315682;color:#fff;font-size: 11px;">


        <th style="">Sl No</th>
        <th style="text-align:center;">Name</th>
        <th style="text-align:center;">Email</th>
        <th style="text-align:center;">Phone</th>

        <th style="text-align:center;">Attendance

        </th>
        <th></th>
    </thead>
    <tbody>
        <?php
                 
                 $db->select('tbl_sponsored_attendance',"*",null,"time_tbl_id =".$timeTable_id,null,null);
                
                    foreach($db->getResult() as $row){
                       // print_r($row);
                        $count++;
                        ?>
        <tr class="row_attendance">
            <td><?php echo $count; ?></td>
            <td style="text-align:center;"><?php echo $row['name'];?></td>
            <td style="text-align:center;"><?php echo $row['email']; ?> </td>
            <td style="text-align:center;"><?php echo $row['phone']; ?> </td>

            <td style="text-align:center;">
                <div class='atten' id="attendance">
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="inlineCheckbox1">Present</label>

                        <input class="form-check-input" type="checkbox" name="atten" id="present" value="1"
                            <?php echo ($row['present']== 1)?'checked':'' ?> style="opacity: 1;visibility: visible;">
                    </div>
                    <!-- <div class="form-check form-check-inline">
                        <label class="form-check-label" for="inlineCheckbox2">Absent</label>
                        <input class="form-check-input" type="checkbox" name="atten" id="absent" value="2"
                            style="opacity: 1;visibility: visible;"> -->

                </div>
                </div>
            </td>
            <td><input type="hidden" name="trainee_id" value=<?php echo $row['id']; ?> /></td>

        </tr>

        <?php
                    }
               ?>

    </tbody>
</table>
<input type="hidden" name="update_id" id="update_id" value="<?php echo $row['id']; ?>">

<!-- <input type="button" class="btn btn-primary" style="background:#3292a2"
    onclick="save_attendance(<?php echo $timeTable_id ?>,<?php echo $program_id ?>,<?php echo $session_no ?>)"
    name="send" value="save" /> -->
<?php

}


if ( isset($_POST['action']) && $_POST['action'] == 'subjecAssignToFaculty'){

    $faculty_id = $_POST['faculty_id'];
    $table = $_POST['table'];
    $count =0;


    ?>
<table class="table">
    <thead class="" style="background: #315682;color:#fff;font-size: 11px;">


        <th style="">Sl No</th>
        <th style="text-align:center;">Paper</th>
        <th style="text-align:center;">Subject</th>

    </thead>
    <tbody>
        <?php
                 $sql = "SELECT p.paper_name,s.subject_name FROM `tbl_guest_faculty` g
                 JOIN `tbl_guest_paper` p ON g.paper_id = p.id
                 JOIN `tbl_guest_subject` s ON g.subject_id = s.id
                 WHERE g.faculty_id = '$faculty_id' AND g.status = 1";
                // echo $sql;
                $db->select_sql($sql);
                //print_r($db->getResult());
                
                    foreach($db->getResult() as $row){
                        $count++;
                        ?>
        <tr>
            <td><?php echo $count; ?></td>

            <td><?php echo $row['paper_name']; ?> </td>
            <td><?php echo $row['subject_name']; ?> </td>
        </tr>

        <?php
                    }
               ?>

    </tbody>
</table>

<?php

}
if ( isset($_POST['action']) && $_POST['action'] == 'timeTable_date'){
     
    $table_name = $_POST['table_name'];
    $t_date = date("Y-m-d", strtotime($_POST['t_date'])) ;
    $program_id = $_POST['program_id'];
    $trng_type = $_POST['trng_type'];
    $count =0;


    ?>
<h5>Modify Time Table for Date <?php echo $t_date  ?> </h5>
<table class=" term table" id="tbl_attandance">
    <thead class="" style="background: #315682;color:#fff;font-size: 11px;">


        <th style="width: 70px;">Sl No</th>
        <th style="text-align:center;width: 105px;">Session No</th>
        <th style="text-align:center;width: 250px;">Existing Details</th>
        <th style="text-align:center;width: 250px;">Modify Details</th>
        <th style="text-align:center;width: 90px;">Status</th>
        <th style="text-align:center;width: 105px;">action</th>

    </thead>
    <tbody>
        <?php
                 
                 $db->select('tbl_time_table',"*",null,"program_id  = '".$program_id ."'  AND training_dt  = '".$t_date."' ",null,null);
                    //print_r($db->getResult());
                    foreach($db->getResult() as $res){
                        //print_r($res);
                        $count++;
                        ?>
        <tr>
            <td><?php echo $count; ?></td>

            <td style="text-align:center;"><?php echo $res['session_no']; ?> </td>
            <td>
                <?php 
                    $db->select('tbl_modifytimetable',"status",null,"time_table_id  = '".$res['id']."' AND session_no = '".$res['session_no']."' AND training_dt = '".$res['training_dt']."' ",null,null);
                    $res_status_send = $db->getResult();
                    if($res_status_send){
                        
                        foreach($res_status_send as $status_modify){
                            //echo $status_modify['status'];
                            if($status_modify['status'] == 0 || $status_modify['status'] == 1 ){
                                ?>
                <a href="#" style="color:#4164b3;float: right;" class="edit_<?php echo $res['id']; ?>"
                    id="<?php echo $res['id']; ?>" onclick="edit(this.id)"><i class="far fa-edit "
                        style="font-size:1.5rem;"></i></a>
                <?php
                                        }
                                       
                                    }
                    }else{
                        $status_tb_range = 0;
                        if($trng_type == 3 || $trng_type == 4){
                            $db->select('tbl_time_table_range',"*",null,"program_id  = '".$program_id ."' ",null,null);
                        }
                        else{
                            $db->select_one('tbl_time_table_range','status',$table_name);
                        }
                       
                        
                        $res4 = $db->getResult();
                        foreach($res4 as $row4){
                         $status_tb_range = $row4['status'];
                        }
                        //echo $status_tb_range;
                     ?>
                <a href="#" style="color:#4164b3;float: right;display:<?php echo($status_tb_range == 1)?"none":'' ;?>"
                    class="edit_<?php echo $res['id']; ?>" id="<?php echo $res['id']; ?>" onclick="edit(this.id)"><i
                        class="far fa-edit " style="font-size:1.5rem;"></i></a>
                <?php
                                }
                                
                              
                              ?>


                <?php 
                                                    echo '<div><p>'.'Class time - '. $res['class_start_time'] .' - '. $res['class_end_time'].'</div></p>';
                                                    if($res['period_type'] == 2) {
                                                        echo ($res['break_time'] == 1)?'Tea Break':'Lunch Break';
                                                    } 
                                                                                 
                                                    if($res['session_type'] == 1){
                                                    if($res['paper_covered'] != '' ){
                                                        echo '<p>'. $res['paper_covered']. '</p>' ;
                                                    }
                                                    else{
                                                        $db->select_one('tbl_topic_master',"topic",$res['topic_id']);
                                                            
                                                        foreach($db->getResult() as $row3){
                                                            echo '<p>'. $row3['topic']. '</p>';
                                                        }
                                                    }
                                                    $db->select_one('tbl_paper_master',"paper_code",$res['paper_id']);
                                                        
                                                    foreach($db->getResult() as $row4){
                                                        
                                                        echo '<p>'.'Paper - '.$row4['paper_code']. '</p>';
                                                    }

                                                    $faculty_id = explode(',',$res['faculty_id']);
                                                
                                                        foreach($faculty_id as $faculty){
                                                            $db->select_one('tbl_faculty_master',"name",$faculty);
                                                            
                                                            foreach($db->getResult() as $row1){
                                                                echo $row1['name']; echo '<br>';
                                                            }
                                                        }
                                                    }else{
                                                    
                                                        if($res['class_remark'] == '' ){
                                                            
                                                        $db->select_one('other_topic',"name",$res['other_class']);
                                                                
                                                            foreach($db->getResult() as $row3){
                                                                echo '<p>'. $row3['name']. '</p>';
                                                            }
                                                        }else{
                                                        echo $res['class_remark'];
                                                        }
                                                    }
                                                    ?>

            </td>
            <td>
                <?php
                               // echo $res['id'];
                                $db->select('tbl_modifytimetable',"*",null,"time_table_id  = '".$res['id']."' AND session_no = '".$res['session_no']."' AND training_dt = '".$res['training_dt']."' ",null,null);
                                 $new_res = $db->getResult();
                                 foreach($new_res as $new_row){
                                    echo '<div><p>'.'Class time - '. $new_row['new_class_start_time'] .' - '. $new_row['new_class_end_time'].'</div></p>';
                                    
                                    if($new_row['new_session_type'] == 1){
                                        if($new_row['new_paper_covered'] != '' ){
                                            echo '<p>'. $new_row['new_paper_covered']. '</p>' ;
                                        }
                                        else{
                                            $db->select_one('tbl_topic_master',"topic",$new_row['new_topic_id']);
                                                
                                            foreach($db->getResult() as $row3){
                                                echo '<p>'. $row3['topic']. '</p>';
                                            }
                                        }
                                        $db->select_one('tbl_paper_master',"paper_code",$new_row['new_paper_id']);
                                            
                                        foreach($db->getResult() as $row4){
                                           
                                            echo '<p>'.'Paper - '.$row4['paper_code']. '</p>';
                                        }
         
                                        $faculty_id = explode(',',$new_row['new_faculty_id']);
                                   
                                            foreach($faculty_id as $faculty){
                                                $db->select_one('tbl_faculty_master',"name",$faculty);
                                                
                                                foreach($db->getResult() as $row1){
                                                    echo $row1['name']; echo '<br>';
                                                }
                                            }
                                       }else{
                                        if($new_row['new_class_remark'] == '' ){
                                    
                                            $db->select_one('other_topic',"name",$new_row['new_other_class']);
                                                 
                                                foreach($db->getResult() as $row3){
                                                    echo '<p>'. $row3['name']. '</p>';
                                                }
                                           }else{
                                            echo $new_row['new_class_remark'];
                                           }
                                       }
                                 }
                              ?>
            </td>
            <td>
                <?php 
                                   $db->select('tbl_modifytimetable',"status",null,"time_table_id  = '".$res['id']."' AND session_no = '".$res['session_no']."' AND training_dt = '".$res['training_dt']."' ",null,null);
                                   $res_status = $db->getResult();
                                   //print_r($res_status);
                                   foreach($res_status as $row_status){
                                       switch($row_status['status']){
                                           case '1':
                                            echo "Modified";
                                            break;
                                          case '2':
                                            echo "Pending";
                                            break;
                                        case '3':
                                            echo "Approve";
                                            break;
                                        case '4':
                                            echo "Approve";
                                            break;
                                       }
                                   }
                                ?>
            </td>
            <td style="line-height: 25px;">
                <?php 
                                   $db->select('tbl_modifytimetable',"time_table_id,session_no,training_dt,status",null,"time_table_id  = '".$res['id']."' AND session_no = '".$res['session_no']."' AND training_dt = '".$res['training_dt']."' ",null,null);
                                   $res_send = $db->getResult();
                                   //print_r($res_status);
                                   foreach($res_send as $row_send){
                                        //print_r($row_send);
                                        $trng_dt = $row_send['training_dt'];
                                        
                                        switch ($row_send['status']) {
                                            case '1':
                                                ?>
                <button type="submit" class="btn btn-primary" name="dir_approval" id="dir_approval"
                    onclick="cnf_dirApproval(<?php echo $row_send['time_table_id'] ?>,<?php echo $row_send['session_no'] ?>,'<?php echo $trng_dt ?>')">Director
                    Approval</button>
                <button type="submit" class="btn btn-info mt-2" name="self_approval" id="self_approval"
                    onclick="cnf_selfApproval(<?php echo $row_send['time_table_id'] ?>,<?php echo $row_send['session_no'] ?>,'<?php echo $row_send['training_dt'] ?>')">Self
                    Approval</button>
                <?php
                                                break;
                                            case '2':

                                                echo  "Pending At Director For Approval";
                                                break;
                                            case '3':
                                                echo  "Approved By Director";
                                                break;
                                            case '4':
                                                echo  " Self Approved ";
                                                break;
                                            
                                        }
                                       
                                   }
                                ?>

            </td>
        </tr>
        <?php
                    }
               ?>

    </tbody>
</table>

<?php

}

?>