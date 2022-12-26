<?php
include 'database.php';
   $db = new Database();

  //print_r($_POST);exit;
  if ( isset($_POST['action']) && $_POST['action'] == 'save_attendance'){

  $session_no = $_POST['session_no'];
  $program_id = $_POST['program_id'];
  $timeTable_id = $_POST['timeTable_id'];

  $tableData = stripcslashes($_POST['tableData']);
 
// Decode the JSON array
  $tableData = json_decode($tableData,TRUE);
   $msg = '';
  foreach($tableData as $data){
      //print_r($data);
        $attendance=  isset($data['attandance'])?'1':'0' ;
      

        $sql = "INSERT INTO `tbl_sponsored_attendance` ( `program_id`, `time_tbl_id`, `session_no`, `name`, `email`, `phone`, `present`, `status`) 
        VALUES ( '$program_id','$timeTable_id','$session_no','".$data['name']."','".$data['email']."','".$data['phone']."','".$attendance."', '1');";
        $db->insert_sql($sql);
        if($db->getResult()){
         $msg = 'success#Attandance Taken Successfully';
      
      }
    
  }

  echo $msg;
} 

if ( isset($_POST['action']) && $_POST['action'] == 'update_attendance'){

     //print_r($_POST);
     $time_tbl_id = $_POST['time_tbl_id'];
     $program_id = $_POST['program_id'];

     $tableData = stripcslashes($_POST['tableData']);
 
    // Decode the JSON array
      $tableData = json_decode($tableData,TRUE);

      foreach($tableData as $data){
        $attendance=  isset($data['attandance'])?'1':'0' ;
        $update_sql = "UPDATE `tbl_sponsored_attendance` SET `present` = '$attendance' WHERE  `id`= (SELECT `id` FROM `tbl_sponsored_attendance` WHERE `time_tbl_id` = '$time_tbl_id' AND `phone` = '".$data['phone']."') ";
        $db->update_dir($update_sql);

        if($db->getResult()){
          $msg = 'success#Attandance Update Successfully';
       }
      }

      
       echo $msg;
    }
    
    if ( isset($_POST['action']) && $_POST['action'] == 'final_save_attn'){

        $time_tbl_id = $_POST['timeTable_id'];
        $program_id = $_POST['program_id'];

        $update_sql = "UPDATE `tbl_sponsored_attendance` SET `status` = 2 WHERE `time_tbl_id` = '$time_tbl_id'  ";
        $db->update_dir($update_sql);

        if($db->getResult()){
          $msg = 'success#Attandance Save Successfully';
       }

       echo $msg;
        
    }

    if ( isset($_POST['action']) && $_POST['action'] == 'view_class_duration'){

      $program_id = $_POST['program_id'];
      $table = $_POST['table'];
      $db->select($table,"start_date,end_date",null," id = '".$program_id."' ",null,null );
      ?>
         <div class="col-md-3">
            <label><strong>Select Date</strong></label>
        </div>
        <div class="col-md-7">
      <?php
      foreach ($db->getResult() as $row) {
        ?>
          <select class="custom-select mr-sm-2" name="t_date" id="t_date">
                  <option value='0' selected>Select Date</option>
                  <?php
                              $begin = new DateTime( $row["start_date"] );
                              $end   = new DateTime( $row["end_date"] );
                              
                              for($i = $begin; $i <= $end; $i->modify('+1 day')){
                                  ?>

                                    <option><?php echo $i->format("d-m-Y"); ?> </option>
                                 <?php
                                   }
                          
                                   ?>

          </select>
        <?php
      }
     ?>
     </div>
     <?php
    }
    
    if ( isset($_POST['action']) && $_POST['action'] == 'view_attn_classes'){
      $program_id = $_POST['program_id'];
      $trng_dt = date( "Y-m-d", strtotime($_POST['trng_dt']) ) ;
      $table = $_POST['table'];

      $db->select($table,"training_dt,session_no,class_start_time,class_end_time ",null,
                  " program_id = '$program_id' AND period_type = 1 AND training_dt='".$trng_dt."' ",null,null );
      ?>
        

        <div>
            <button class="btn btn-danger float-right" onclick="ExportToExcel('xlsx')">Export to excel</button>
        </div>
        <table class=" term table" id="tbl_attandance">
          <thead>
             <td colspan="8" ><div class="attn_header"> </div> </td>
          </thead>
          <thead class="" style="background: #315682;color:#fff;font-size: 11px;">
            <th>Sl No</th>
            <th>Name</th>
            <th>Name of Office</th>
            <!-- <th>Phone</th> -->
            <?php
              foreach ($db->getResult() as $row) {
                //print_r($row);
                ?>
                  <th style="text-align:center;">Class <br> ( <?php echo $row['class_start_time'].' - '. $row['class_end_time']  ?> ) </th>
                <?php
              }
            ?>

          </thead>
        <tbody>
             <?php
             $count = 0;
              $db->select("tbl_dept_trainee_registration","name,office_name,phone ",null,
              " program_id = '$program_id' AND mdrafm_status=1 ",null,null );
              foreach ($db->getResult() as $row1) {
                $count++;
                  ?>
                  <tr>
                   <td> <?php echo $count; ?></td>
                   <td> <?php echo $row1['name'] ?> </td>
                   <td> <?php echo $row1['office_name'] ?> </td>
                   <!-- <td> <?php echo $row1['phone'] ?> </td> -->
                   <?php
                     $sql = "SELECT present FROM (SELECT s.session_no,t.name,t.phone,t.present FROM `tbl_sponsored_time_table` s JOIN `tbl_sponsored_attendance` t ON s.id = t.time_tbl_id 
                             WHERE s.training_dt = '".$trng_dt."') u WHERE u.phone = '".$row1['phone']."' " ;
                    $db->select_sql($sql);
                     foreach ($db->getResult() as $row2) {
                     // print_r($row2);
                       ?>
                        <td><?php echo ($row2['present']==1)?' <p class="text-success" >✔</p>':'<p class="text-danger" >✗</p>'; ?>  </td>
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
      
    }
?>