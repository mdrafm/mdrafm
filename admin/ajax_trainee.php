<?php
 
 
 include 'database.php';
 //include('../config.php');

 //$con = new Database();
 
 $db = new Database();
 
 if ( isset($_POST['action']) && $_POST['action'] == 'feedback'){
      
   // print_r($_POST);
   $attn_id = $_POST['id'];
   $feedback = $_POST['feedBack']; 

   //echo  $feedback;exit;
     $db->insert('tbl_feedback',['attendance_id'=>$attn_id, 'feedback'=>$feedback,'status'=>1]);
     $res = $db->getResult();
     //print_r($res);
     if($res){
         echo "success";
     }
 }
 if ( isset($_POST['action']) && $_POST['action'] == 'post_feedback'){
     
    $trng_type = $_POST['trng_type'];
    $program_id = $_POST['program_id'];
    $username = $_POST['username'];
    $suggestion = $_POST['suggestion'];

    $db->insert('tbl_post_trng_feedback',['program_id'=>$program_id, 'trng_type'=>$trng_type,'username'=>$username,'suggestion'=>$suggestion]);
    $res = $db->getResult();
   
    $last_insert_id = $res[0];
    // if($res){
    //     echo "success";
    // }

    $tableData = stripcslashes($_POST['tableData']);
 
    // Decode the JSON array
    $tableData = json_decode($tableData,TRUE);
   // print_r($_POST);

    foreach($tableData as $row){
       // print_r($row);
        if(!isset($row['feedback'])){
            $feedback = 0;
        }else{
            $feedback = $row['feedback'];
        }
       
        $db->insert('tbl_post_trng_feedback_data',['post_feedback_id'=>$last_insert_id, 'feedback_name_id'=>$row['feedback_name_id'],'feedback'=>$feedback]);
        $res2 = $db->getResult();
        if($res2){
         
          echo "success#";
        }
        else{
        
            echo "error#".$res2[0];
        }

       // echo $field;

    }
 }

 if ( isset($_POST['action']) && $_POST['action'] == 'update_post_feedback'){
    $edit_id = $_POST['edit_id'];
    $program_id = $_POST['program_id'];
    $suggestion = $_POST['suggestion'];

    $db->update('tbl_post_trng_feedback',['suggestion'=>$suggestion],'id='.$edit_id);
    $res = $db->getResult();

    if($res){
         
        echo "success#";
      }
      else{
      
          echo "error#".$res[0];
      }
 }

 if ( isset($_POST['action']) && $_POST['action'] == 'select_tranee_Email'){
     
  $tableData = stripcslashes($_POST['tableData']);
 
// Decode the JSON array
  $tableData = json_decode($tableData,TRUE);
  foreach($tableData as $data){

    $db->update('tbl_new_recruite',["email_status"=> $data['send']],'id='.$data['trnee_id']);
    $res = $db->getResult();
    if($res){
     
      echo "success#";
  }
  else{
   
    echo "error#".$res[0];
  }
    //print_r($data);
  }
  
 }
 
 if ( isset($_POST['action']) && $_POST['action'] == 'select_topicWise'){
      
  
    $program_id = $_POST['program_id'];
     
    $sql = "SELECT DISTINCT(m.topic),m.id  FROM `tbl_time_table` t 
            JOIN `tbl_topic_master` m ON t.topic_id = m.id WHERE program_id = '".$program_id."' ORDER BY m.id";
    
    $db->select_sql($sql);
    $res = $db->getResult();
   
    if($res){
      echo '<option>Select Topic</option>';
    
      foreach($res as $row){
        ?>
<option value=<?php echo $row['id'] ?>> <?php echo $row['topic'] ?> </option>
<?php
      }
    
  }
  else{
      //print_r($db->getResult());
      echo '<option>No Class Taken By Faculty  </option>';
  }


  }
 if ( isset($_POST['action']) && $_POST['action'] == 'faculty_feedBack'){
    
    $program_id = $_POST['program_id'];
    
    $db->select_sql("SELECT a.taken_by,f.name FROM (SELECT DISTINCT(u.name),a.taken_by FROM `tbl_attendance`a JOIN `tbl_user` u ON a.taken_by = u.id)a JOIN `tbl_faculty_master` f ON a.name = f.id");

    $res = $db->getResult();
   
    if($res){
      echo '<option>Select Faculty</option>';
    
      foreach($res as $row){
        
      
        ?>
<option value=<?php echo $row['taken_by'] ?>> <?php echo $row['name'] ?> </option>
<?php
      }
    
  }
  else{
      //print_r($db->getResult());
      echo '<option>No Class Taken By Faculty  </option>';
  }

    
}
if ( isset($_POST['action']) && $_POST['action'] == 'fetch_tour_program'){
    
    $program_id = $_POST['program_id'];
    
    $db->select('tbl_tour_long_term_program','id,prg_name',null,null,null,null);

    $res = $db->getResult();
   
    if($res){
      echo '<option value = 0>Select Tour Program</option>';
    
      foreach($res as $row){
        
      
        ?>
<option value=<?php echo $row['id'] ?>> <?php echo $row['prg_name'] ?> </option>
<?php
      }
    
  }
  else{
      //print_r($db->getResult());
      echo '<option>No Program Found  </option>';
  }

    
}
if ( isset($_POST['action']) && $_POST['action'] == 'view_feedBack'){

$program_id = $_POST['program_id'];
$feedback_type = $_POST['feedback'];
$faculty_type = $_POST['faculty_type'];
$topic_id = $_POST['topic_id'];
//print_r($_POST);exit;
switch ($feedback_type) {
    case '1':

       ?>
<table class="table table-striped table-sm" style="width:50%;margin:0px auto;">
    <thead style="font-size: 10px;background-color: rgb(59 67 84);color: #fff;">

        <tr>
            <th scope="col">Faculty Name</th>
            <th scope="col">Avrage Feedback </th>
        </tr>
    </thead>
    <tbody>
        <?php 
                     $sql = "SELECT AVG(u.feedback) as avrage,u.taken_by,t.faculty_type,t.faculty_id,g.name as faculty_name from (SELECT f.feedback,a.time_tbl_id,a.taken_by FROM `tbl_feedback` f JOIN `tbl_attendance` a ON f.attendance_id = a.id) u 
                     JOIN `tbl_time_table` t ON u.time_tbl_id = t.id
                     JOIN `tbl_faculty_master` g ON t.faculty_id = g.id
                     GROUP BY t.faculty_id ";
                    
                    $db->select_sql($sql);
                    $res = $db->getResult();

                      foreach($res as $feedback){
                         // print_r( $feedback);
                          ?>
        <tr>
            <td><?php echo $feedback['faculty_name'] ?></td>
            <td><?php echo number_format((float)$feedback['avrage'], 2, '.', '');  ?></td>
        </tr>


        <?php
                      }
                    ?>
    </tbody>
</table>
<?php
        break;
        case '3':
            ?>
<table class="table table-striped table-sm" style="width:70%;margin:0px auto;">
    <thead style="font-size: 10px;background-color: rgb(59 67 84);color: #fff;">

        <tr>
            <th scope="col">Sl.No</th>
            <th scope="col">Topic</th>
            <th scope="col">Faculty Name</th>
            <th scope="col">Avrage Feedback </th>
        </tr>
    </thead>
    <tbody>
        <?php 
                     $sql = "SELECT AVG(u.feedback) as avrage,top.topic,u.taken_by,t.faculty_type,t.faculty_id,g.name as faculty_name from (SELECT f.feedback,a.time_tbl_id,a.taken_by FROM `tbl_feedback` f JOIN `tbl_attendance` a ON f.attendance_id = a.id) u 
                     JOIN `tbl_time_table` t ON u.time_tbl_id = t.id
                     JOIN `tbl_topic_master` top ON t.topic_id = top.id
                     JOIN `tbl_faculty_master` g ON t.faculty_id = g.id
                     WHERE t.topic_id = '".$topic_id."'
                     GROUP BY t.faculty_id";
                    
                    $db->select_sql($sql);
                    $res = $db->getResult();
                    $count = 0;
                      foreach($res as $feedback){
                         // print_r( $feedback);
                         $count++;
                          ?>
        <tr>
            <td><?php echo $count ?></td>
            <td><?php echo $feedback['topic'] ?></td>
            <td><?php echo $feedback['faculty_name'] ?></td>
            <td><?php echo number_format((float)$feedback['avrage'], 2, '.', '');  ?></td>
        </tr>


        <?php
                      }
                    ?>
    </tbody>
</table>
<?php
            break;
    default:
        # code...
        break;
}

}

if ( isset($_POST['action']) && $_POST['action'] == 'view_post_feedBack'){

    $program_id = $_POST['program_id'];
    $traning_type = $_POST['traning_type'];
    $feedback_type = $_POST['feedback_type'];
    $tour_id = $_POST['tour_id'];
    $prog_name = $_POST['prog_name'];
    $prog_id = '';
    $prog_table = '';
    $select_query = '';
    if($program_id ==1){
        $prog_table = 'tbl_new_recruite';
        $select_query = " CONCAT(t.f_name,'',t.l_name) as name,f.suggestion,f.id ";
        if($tour_id ==0){
            $prog_id =  $program_id;
        }else{
            $prog_id = $tour_id;
        }
    }else{
        $prog_id = $program_id;
        $prog_table = 'tbl_mid_trainee_registration';
        $select_query = 't.name,f.suggestion,f.id';
    }
    //print_r($_POST);exit;

    switch ($feedback_type) {
        case '1':
    
           ?>
<!-- <a class=" printbtn" href="#" 
onclick="datapost('post_program_feedback_pdf.php',{program_id: <?php echo $program_id ?> ,traning_type:<?php echo $traning_type; ?> })"
style="float:right;">Print</a> -->

<input type="button" class="printbtn"
    style="background:#3292a2;"
    onclick="datapost('post_program_feedback_pdf.php',{program_id: <?php echo $prog_id ?> ,prog_name: '<?php echo $prog_name ?>',traning_type:<?php echo $traning_type; ?>,
                       tour_id:<?php echo $tour_id; ?> })"
    value="Print" />
<div class="feedback-heading">
    <p style="padding: 5px;">Post Program Trainee Feedback</p>
</div>

<table class="table table-striped table-sm" style="width:60%;margin-top: 50px">
    <thead style="font-size: 10px;background-color: rgb(59 67 84);color: #fff;">

        <tr>
            <th scope="col">Feedback Category</th>
            <th scope="col">Avrage Feedback </th>
        </tr>
    </thead>
    <tbody>
        <?php 
                        $db->select('tbl_feedback_master','*',null,null,null,null);
                        foreach($db->getResult() as $row1){
                            $sql = "SELECT m.feedback as name,AVG(d.feedback) as avrage FROM `tbl_post_trng_feedback` p 
                            LEFT JOIN `tbl_post_trng_feedback_data` d ON p.id = d.post_feedback_id
                            JOIN `tbl_feedback_master` m ON d.feedback_name_id = m.id WHERE p.program_id = '".$prog_id."' AND 
                            p.trng_type = '".$traning_type."' AND m.feedback = '".$row1['feedback']."' ";
                           
                           $db->select_sql($sql);
                           $res = $db->getResult();
       
                             foreach($res as $feedback){
                                // print_r( $feedback);
                                 ?>
        <tr>
            <td><?php echo $feedback['name'] ?></td>
            <td><?php echo number_format((float)$feedback['avrage'], 1, '.', '');  ?></td>
        </tr>


        <?php
                             }
                        }
                        
                        ?>
    </tbody>
</table>
<div class="feedback-heading" style="margin-top: 50px">
    <p style="padding: 5px;">Post Program Trainee Suggestion</p>
</div>

<table class="table table-striped table-sm" style="width:60%;">
    <thead style="font-size: 10px;background-color: rgb(59 67 84);color: #fff;">

        <tr>
            <th scope="col">Sl No</th>
            <th scope="col">Name </th>
            <th scope="col">Suggestions
            <th>
        </tr>
    </thead>
    <tbody>
        <?php 
                        $db->select('tbl_post_trng_feedback',$select_query,' f JOIN '.$prog_table.' t ON f.username=t.phone',null,null,null);
                      
                           $res = $db->getResult();
                           $count = 0;
                             foreach($res as $row2){
                                // print_r( $feedback);
                                $count++;
                                 ?>
        <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row2['name'] ?></td>
            <td><?php echo $row2['suggestion'] ?> </td>
        </tr>


        <?php
                             }
                        
                        
                        ?>
    </tbody>
</table>

<?php
            break;
            case '2':
                ?>
<div class="feedback-heading" style="margin-top: 10px">
    <p style="padding: 5px;">Post Program Individual Trainee Feedback</p>
</div>

<?php
                   $db->select('tbl_post_trng_feedback',$select_query,' f JOIN '.$prog_table.' t ON f.username=t.phone',
                   "f.program_id = '".$prog_id."' AND  f.trng_type = '".$traning_type."'",null,null);
                  
                      
                   $res = $db->getResult();
                  
                     foreach($res as $row3){
                        // print_r( $feedback);
                     
                        ?>
                        <div class="feedback_div">
                            <div class="row ind-heading" style="margin-top: 50px">
                               <div class="col-md-2">Name :</div>
                               <div class="col-md-7"><?php echo $row3['name']; ?></div>
                               
                            </div>

                            <table class="table table-striped table-sm" style="width:70%;margin-top: 30px">
                                <thead style="font-size: 10px;background-color: rgb(59 67 84);color: #fff;">

                                    <tr>
                                        <th scope="col">Sl.No</th>
                                        <th scope="col">Feedback Category</th>
                                        <th scope="col">Rating</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                     $count = 0;
                                                   $sql = "SELECT m.feedback as name,d.feedback as rating FROM `tbl_post_trng_feedback` p 
                                                   LEFT JOIN `tbl_post_trng_feedback_data` d ON p.id = d.post_feedback_id
                                                   JOIN `tbl_feedback_master` m ON d.feedback_name_id = m.id WHERE p.program_id = '".$prog_id."' AND 
                                                   p.trng_type = '".$traning_type."' AND d.post_feedback_id = '".$row3['id']."' ";

                                                    $db->select_sql($sql);
                                                    $count = 0;
                                                    foreach($db->getResult() as $rating){
                                                        // print_r( $feedback);
                                                        $count++;
                                                        ?>
                                    <tr>
                                        <td><?php echo $count ?></td>
                                        <td><?php echo $rating['name'] ?></td>
                                        <td><?php echo $rating['rating'] ?></td>
                                        
                                    </tr>


                                    <?php
                                                    }
                                                    ?>
                                </tbody>
                            </table>
                            <div class="row" style="width: 70%;
                                background: #00802c24;
                                padding: 10px;
                                margin-left: 5px">
                                <div class="col-md-3" style="text-align: center;
                                    font-size: 1.2rem;
                                    font-weight: 600;
                                    color: #3851a5;">Suggestion</div>
                                <div class="col-md-9">
                                    <textarea  style="width: 80%;height: 100%;" row="3" > <?php echo $row3['suggestion'] ?> </textarea>
                                </div>
                            </div>
                        </div>
                            <!-- <hr> -->

<?php
                     }
                
                ?>


<?php
                break;
        default:
            # code...
            break;
    }
    
    }

if ( isset($_POST['action']) && $_POST['action'] == 'view_trainee_dtl'){
    $user_id = $_POST['user_id'];
   
    ?>
<div class="card">
    <div class="card-header">
        <h5 class="title">Form-I</h5>
    </div>
    <?php
                                //print_r($_POST);
                               $id = 0;
                               $db->select('tbl_user',"id",null," username =".$user_id,null,null);
                               $result = $db->getResult();
                               if($result){
                                  foreach($result as $new_row ){
                                      //print_r($new_row);
                                      $id = $new_row['id'];
                                  }
                               }
                               else{
                                   echo "Registration Not Yet Done By Trainee";
                                   exit;
                               }
                              
                               // $sql2 = mysqli_query($db, "SELECT *  FROM `tbl_trainee_info` WHERE  status = 1 AND user_id =".$id);

                               // $sql = "SELECT *  FROM `tbl_trainee_info` WHERE `user_id` =".$id;
                                //echo $sql;exit;
                                $db->select('tbl_trainee_info',"*",null," status = 1 AND user_id =".$id,null,null);
                                $row1 =  $db->getResult();
                                
                                if($row1){

                                   // while($res = mysqli_fetch_array($sql2)) {
                                    foreach($row1 as $res ){   
                                    // print_r($res);
                                    ?>
    <div class="card-body">
        <form>



            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><strong>Name of the Trainee</strong></label>
                        <input type="text" disabled class="form-control" placeholder="<?php echo $res['first_name'];?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label> &nbsp;</label>
                        <input type="text" disabled class="form-control" placeholder="<?php echo $res['last_name'];?>">
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><strong>Father's Name</strong></label>
                        <input type="text" disabled class="form-control"
                            placeholder="<?php echo $res['father_name'];?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><strong>Mother's Name</strong></label>
                        <input type="text" disabled class="form-control"
                            placeholder="<?php echo $res['mother_name'];?>">
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><strong> Blood Group</strong></label>
                        <input type="text" disabled class="form-control" name="t_name"
                            placeholder="<?php echo $res['blood_group'];?>">
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <label><strong>Date of Birth</strong></label>
                        <input type="text" disabled class="form-control" name="t_name"
                            placeholder="<?php echo date("d-m-Y",strtotime($res['d_o_b']));?>">
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label><strong>Educational Qualifications</strong></label>
                        <input type="text" disabled class="form-control" name="t_name"
                            placeholder="<?php echo $res['qualification'];?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><strong>Marital Status</strong></label>
                        <input type="text" disabled class="form-control date-withicon"
                            placeholder="<?php echo $res['marital_status'];?>" />
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label style="padding-left: 43%;"><strong>Contact
                                Details</strong></label></br>
                        <label><strong>Parmanent Address</strong></label>
                        <input type="text" disabled class="form-control"
                            placeholder="<?php echo $res['parmanent_addr'];?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 pr-1">
                    <div class="form-group">
                        <!-- <label><strong>State</strong></label> -->

                        <input type="text" disabled class="form-control" placeholder="<?php echo $res['state_id'];?>">

                    </div>
                </div>
                <div class="col-md-4 px-1">
                    <div class="form-group">
                        <!-- <label><strong>District</strong></label> -->
                        <input type="text" disabled class="form-control"
                            placeholder="<?php echo $res['district_id'];?>">
                    </div>
                </div>
                <div class="col-md-4 pl-1">
                    <div class="form-group">
                        <!-- <label><strong>Pin Code</strong></label> -->
                        <input type="number" disabled class="form-control" placeholder="<?php echo $res['pr_pin'];?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label><strong>Present Address</strong></label>

                        <input type="text" disabled class="form-control addr"
                            placeholder="<?php echo $res['present_addr'];?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 pr-1">
                    <div class="form-group">
                        <!-- <label><strong>State</strong></label> -->
                        <input type="text" disabled class="form-control addr"
                            placeholder="<?php echo $res['p_state'];?>">
                    </div>
                </div>
                <div class="col-md-4 px-1">
                    <div class="form-group">
                        <!-- <label><strong>District</strong></label> -->
                        <input type="text" disabled class="form-control addr"
                            placeholder="<?php echo $res['p_dist'];?>">
                    </div>
                </div>
                <div class="col-md-4 pl-1">
                    <div class="form-group">
                        <!-- <label><strong>Pin Code</strong></label> -->
                        <input type="number" disabled class="form-control addr"
                            placeholder="<?php echo $res['p_pin'];?>">
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><strong>Mobile Number</strong></label>
                        <input type="text" disabled class="form-control" name="t_name"
                            placeholder="<?php echo $res['mobile'];?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><strong>Email</strong></label>
                        <input type="text" disabled class="form-control" name="t_name"
                            placeholder="<?php echo $res['email'];?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label style="padding-left: 43%;"><strong>Bank Details</strong></label>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><strong>Bank Name</strong></label>
                        <input type="text" disabled class="form-control" name="t_name"
                            placeholder="<?php echo $res['bank_id'];?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><strong>Account No.</strong></label>
                        <input type="text" disabled class="form-control" name="t_name"
                            placeholder="<?php echo $res['account_num'];?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><strong>IFSC Code</strong></label>
                        <input type="text" disabled class="form-control" name="t_name"
                            placeholder="<?php echo $res['ifsc_code'];?>">
                    </div>
                </div>


            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label style="padding-left: 43%;"><strong>Health & Medical
                                History(indicate if)</strong></label>

                    </div>
                </div>
                <div class="form-check">

                    <?php

                                            //$sql3 = mysqli_query($db, "SELECT *  FROM `tbl_medical_info` WHERE `user_id` =".$id);
                                            $db->select('tbl_medical_info',"*",null,"  user_id =".$id,null,null);
                                            $row3 =  $db->getResult();
                                            if($row3)
                                            {
                                            

                                                // while($res1 = mysqli_fetch_array($sql3)) {
                                                  foreach ($row3 as $res1){
                                                    $medical = explode(',', $res1['reason']);

                                                    foreach($medical as $reason){
                                                    
                                                        //$sql4 = mysqli_query($db, "SELECT *  FROM `tbl_medical_history` WHERE `id` =".$reason);
                                                        $db->select('tbl_medical_history',"*",null,"  id =".$reason,null,null);
                                                        $row4 =  $db->getResult();
                                                        //while($res2 = mysqli_fetch_array($sql4)) {
                                                          foreach ($row4 as $res2){
                                            ?>

                    <input type="text" disabled class="form-control" name="t_name"
                        placeholder="<?php  echo $res2['medical_history']; ?>" />

                    </label></br>
                    <?php    }

                                            }

                                            ?>

                    <div class="row">

                        <div class="col-md-6">

                            <label for="photo" style="margin-left: 20px;"><strong>Any other
                                    category/symptom as notified</strong></label>
                            <input type="text" disabled class="form-control" name="t_name"
                                placeholder="<?php  echo $res1['other']; ?>">

                        </div>
                    </div>
                </div>


            </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="photo" style="margin-left: 20px;"><strong>Whether Differently
                            Abled?</strong></label>
                    <input type="text" disabled class="form-control" name="t_name"
                        placeholder="<?php  echo $res1['diff_abled']; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="photo" style="margin-left: 20px;"><strong>Past Service
                            experience(If any)</strong></label>
                    <input style="margin-right: 50%;" type="text" class="form-control" name="t_name"
                        placeholder="<?php  echo $res1['past_service']; ?>">

                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="photo" style="margin-left: 20px;"><strong>Hostel
                            Accommodation</strong></label>
                    <input style="margin-right: 50%;" type="text" class="form-control" name="t_name"
                        placeholder="<?php  echo $res1['hostel_acc']; ?>">

                </div>
            </div>
            <?php }

                                        }
                                     ?>
            <div class="row">
                <div class="col-md-12">

                    <label style="padding-left: 43%;"><strong>Upload Dcoumnets</strong></label>
                </div>
                <?php 
                                        //$sql5 = mysqli_query($db, "SELECT *  FROM `tbl_traniee_documents` WHERE `user_id` =".$id);
                                        $db->select('tbl_traniee_documents',"*",null,"  user_id =".$id,null,null);
                                        $row5 =  $db->getResult();
                                        if($row5)
                                        {
                                        

                                           // while($res5 = mysqli_fetch_array($sql5)) {

                                            foreach($row5 as $res5){
                                              
                                              ?>
                <div class="col-md-6">

                    <label class="form-check-label" style="padding-top: 20%;"><strong>Passport
                            size Photo</strong>
                    </label>



                    <a href="uploads/<?php echo $res5['photo'];?>" target="_blank"
                        class="form-control"><?php echo $res5['photo'];?></a>



                </div>
                <div class="col-md-6">

                    <label class="form-check-label" style="padding-top: 20%;"><strong>Joining
                            report in OGFR II Form</strong></label>
                    <a href="uploads/<?php echo $res5['joining_report'];?>" target="_blank"
                        class="form-control"><?php echo $res5['joining_report'];?></a>
                </div>

                <div class="col-md-6">

                    <label class="form-check-label" style="padding-top: 20%;"><strong>Character
                            Certificate I & II</strong></label>

                    <a href="uploads/<?php echo $res5['character_certificate'];?>" target="_blank"
                        class="form-control"><?php echo $res5['character_certificate'];?></a>
                </div>
                <div class="col-md-6">

                    <label class="form-check-label" style="padding-top: 20%;"><strong>Adhar
                            Card/VoterID</strong></label>
                    <a href="uploads/<?php echo $res5['idproof_type'];?>" target="_blank"
                        class="form-control"><?php echo $res5['idproof_type'];?></a>
                </div>

                <div class="col-md-6">

                    <label class="form-check-label" style="padding-top: 20%;"><strong>PAN
                            Card</strong></label>
                    <a href="uploads/<?php echo $res5['PAN_card'];?>" target="_blank"
                        class="form-control"><?php echo $res5['PAN_card'];?></a>
                </div>

                <div class="col-md-6">

                    <label class="form-check-label" style="padding-top: 20%;"><strong>HSC
                            Certificate</strong></label>
                    <a href="uploads/<?php echo $res5['hsc_certificate'];?>" target="_blank"
                        class="form-control"><?php echo $res5['hsc_certificate'];?></a>
                </div>

                <div class="col-md-6">

                    <label class="form-check-label" style="padding-top: 20%;"><strong>Non-employment
                            Certificate</strong></label>
                    <a href="uploads/<?php echo $res5['non_employment'];?>" target="_blank"
                        class="form-control"><?php echo $res5['non_employment'];?></a>
                </div>

                <div class="col-md-6">

                    <label class="form-check-label"
                        style="padding-top: 20%;"><strong>Undertaking/Declaration</strong></label>
                    <a href="uploads/<?php echo $res5['undertaking_declaration'];?>" target="_blank"
                        class="form-control"><?php echo $res5['undertaking_declaration'];?></a>
                </div>

                <div class="col-md-6">

                    <label class="form-check-label" style="padding-top: 20%;"><strong>First page
                            of Bank Passbook/Cancelled Bank Cheque Leaf</strong></label>
                    <a href="uploads/<?php echo $res5['bank_passbook'];?>" target="_blank"
                        class="form-control"><?php echo $res5['bank_passbook'];?></a>
                </div>

                <div class="col-md-6">

                    <label class="form-check-label" style="padding-top: 20%;"><strong>PRAN
                            Card</strong></label>
                    <a href="uploads/<?php echo $res5['PRAN_Card'];?>" target="_blank"
                        class="form-control"><?php echo $res5['PRAN_Card'];?></a>
                </div>

                <div class="col-md-6">

                    <label class="form-check-label" style="padding-top: 20%;"><strong>NPS
                            Registration form</strong></label>
                    <a href="uploads/<?php echo $res5['NPS_registration'];?>" target="_blank"
                        class="form-control"><?php echo $res5['NPS_registration'];?></a>
                </div>





                <?php 
                                        }
                                        }?>




                <div class="row">
                    <div class="col-md-5"></div>
                    <div class="col-md-6">

                    </div>
                </div>
            </div>
    </div>


    </form>


</div>
<div class="col-md-1">
</div>
</div>

</div>

<?php 
                
                                }
                           } 
              
                            ?>

</div>
<?php
}

if ( isset($_POST['action']) && $_POST['action'] == 'accept_trainee'){
    
  
  $trainee_id = $_POST['id'];
 
  $table = $_POST['table'];

  $db->update($table,['mdrafm_status' => 1],' user_id='.$trainee_id);
  $res = $db->getResult();
  if($res){
    echo "success";
  }
}
if ( isset($_POST['action']) && $_POST['action'] == 'accept_inservice_trainee'){
    
  
    $trainee_id = $_POST['id'];
   
    $table = $_POST['table'];
  
    $db->update($table,['mdrafm_status' => 1],' id='.$trainee_id);
    $res = $db->getResult();
    if($res){
      echo "success";
    }
  }
  if ( isset($_POST['action']) && $_POST['action'] == 'check_inservice_trainee'){
    
  
    $trainee_id = $_POST['id'];
   
     
    $db->select("tbl_new_recruite","email,phone",null,"id=".$trainee_id,null,null);
    $res = $db->getResult();
    foreach($res as $row){
        if($row['email'] == ''){
            $msg = "error#Please Update Email Before Accept ";
        }
        else if ($row['phone'] == ''){
            $msg = "error#Please Update Phone Number Before Accept ";
        }
        else{
            $msg = "success#";
        }
    }
    echo $msg;
    // if($res){
    //   echo "success#";
    // }
  }
  

if ( isset($_POST['action']) && $_POST['action'] == 'send_mdrafm'){
    
  
  $trainee_id = $_POST['id'];
 
  $table = $_POST['table'];

  $db->update($table,['status' => 1],' user_id='.$trainee_id);
  $res = $db->getResult();
  if($res){
    echo "success";
  }
}

?>