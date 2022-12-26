<!DOCTYPE html>
<html lang="en">


<head>
    <?php 
    
    include('header_link.php');
    include('../config.php');
    include 'database.php';
    $db = new Database();
    ?>

</head>

<body class="user-profile">

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <div class="wrapper ">

        <?php include('sidebar.php'); ?>

        <div class="main-panel" id="main-panel">
            <?php include('navbar.php'); ?>

            <div class="panel-header panel-header-sm">


            </div>


            <div class="content" style="margin-top: 50px;">

                <div class="row">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4 class="card-title"> Modified Time Table Approval</h4>
                                    </div>

                                </div>


                            </div>
                            <div class="card-body">
                                <div id="term2" class=" table table-responsive table-striped table-hover"
                                    style="width:100%;margin:0px auto">
                                   <table class=" term table" id="tbl_attandance">
                                        <thead class="" style="background: #315682;color:#fff;font-size: 11px;">


                                            <th style="width: 70px;">Sl No</th>
                                            <th style="text-align:center;width: 105px;">Program Name</th>
                                            <th style="text-align:center;width: 105px;">Time Table Name</th>
                                            <th style="text-align:center;width: 105px;">Session No</th>
                                            <th style="text-align:center;width: 250px;">Existing Details</th>
                                            <th style="text-align:center;width: 250px;">Modify Details</th>
                                            <th style="text-align:center;width: 105px;">Action</th>
                                            
                                        </thead>
                                            <tbody>
                                                <?php
                                                    $count = 0;
                                                    //$db->select('tbl_modifytimetable',"*",null,"status = 1",null,null);
                                                    $sql = "SELECT m.* ,r.program_id,r.name
                                                    FROM `tbl_modifytimetable` m JOIN `tbl_time_table` t ON m.time_table_id = t.id 
                                                    JOIN `tbl_time_table_range` r ON t.table_range_id = r.id 
                                                    WHERE m.status = 2 OR m.status = 3";
                                                    $db->select_sql($sql);
                                                    $res = $db->getResult();
                                                    foreach($res as $row){
                                                        //print_r($row);
                                                        $count++;
                                                        ?>
                                                        <tr>
                                                          <td><?php echo $count; ?></td>
                                                          <td>
                                                              <?php
                                                               $db->select_one('tbl_program_master',"id,prg_name",$row['program_id']);
                                                    
                                                               foreach($db->getResult() as $row1){
                                                                   echo $prog_name = $row1['prg_name'];
                                                                        $prog_id   = $row1['id'];
                                                               }
                                                             
                                                               ?>
                                                            
                                                          </td>
                                                          <td><?php echo $row['name']; ?></td>
                                                          <td><?php echo $row['session_no']; ?></td>
                                                          <td>
                                                              <?php
                                                                  echo '<div><p>'.'Class time - '. $row['class_start_time'] .' - '. $row['class_end_time'].'</div></p>';
                                               
                                                                  if($row['session_type'] == 1){
                                                                      if($row['paper_covered'] != '' ){
                                                                          echo '<p>'. $row['paper_covered']. '</p>' ;
                                                                      }
                                                                      else{
                                                                          $db->select_one('tbl_topic_master',"topic",$row['topic_id']);
                                                                              
                                                                          foreach($db->getResult() as $row3){
                                                                              echo '<p>'. $row3['topic']. '</p>';
                                                                          }
                                                                      }
                                                                      $db->select_one('tbl_paper_master',"paper_code",$row['paper_id']);
                                                                          
                                                                      foreach($db->getResult() as $row4){
                                                                         
                                                                          echo '<p>'.'Paper - '.$row4['paper_code']. '</p>';
                                                                      }
                                       
                                                                      $faculty_id = explode(',',$row['faculty_id']);
                                                                 
                                                                          foreach($faculty_id as $faculty){
                                                                              $db->select_one('tbl_faculty_master',"name",$faculty);
                                                                              
                                                                              foreach($db->getResult() as $row1){
                                                                                  echo $row1['name']; echo '<br>';
                                                                              }
                                                                          }
                                                                     }else{
                                                                      if($row['class_remark'] == '' ){
                                                                  
                                                                          $db->select_one('other_topic',"name",$row['other_class']);
                                                                               
                                                                              foreach($db->getResult() as $row3){
                                                                                  echo '<p>'. $row3['name']. '</p>';
                                                                              }
                                                                         }else{
                                                                          echo $row['class_remark'];
                                                                         }
                                                                     }
                                                              ?>
                                                          </td>
                                                          <td>
                                                              <?php
                                                                   echo '<div><p>'.'Class time - '. $row['new_class_start_time'] .' - '. $row['new_class_end_time'].'</div></p>';
                                    
                                                                   if($row['new_session_type'] == 1){
                                                                       if($row['new_paper_covered'] != '' ){
                                                                           echo '<p>'. $row['new_paper_covered']. '</p>' ;
                                                                       }
                                                                       else{
                                                                           $db->select_one('tbl_topic_master',"topic",$row['new_topic_id']);
                                                                               
                                                                           foreach($db->getResult() as $row3){
                                                                               echo '<p>'. $row3['topic']. '</p>';
                                                                           }
                                                                       }
                                                                       $db->select_one('tbl_paper_master',"paper_code",$row['new_paper_id']);
                                                                           
                                                                       foreach($db->getResult() as $row4){
                                                                          
                                                                           echo '<p>'.'Paper - '.$row4['paper_code']. '</p>';
                                                                       }
                                        
                                                                       $faculty_id = explode(',',$row['new_faculty_id']);
                                                                  
                                                                           foreach($faculty_id as $faculty){
                                                                               $db->select_one('tbl_faculty_master',"name",$faculty);
                                                                               
                                                                               foreach($db->getResult() as $row1){
                                                                                   echo $row1['name']; echo '<br>';
                                                                               }
                                                                           }
                                                                      }else{
                                                                       if($row['new_class_remark'] == '' ){
                                                                   
                                                                           $db->select_one('other_topic',"name",$row['new_other_class']);
                                                                                
                                                                               foreach($db->getResult() as $row3){
                                                                                   echo '<p>'. $row3['name']. '</p>';
                                                                               }
                                                                          }else{
                                                                           echo $row['new_class_remark'];
                                                                          }
                                                                      }
                                                              ?>
                                                          </td>
                                                          <td>
                                                             <?php
                                                               switch($row['status']){
                                                                   case '2':
                                                                    ?>
                                                                       <button type="submit" class="btn btn-info mt-2" 
                                                                       onclick="approve(<?php echo $row['time_table_id'] ?>,<?php echo $row['session_no'] ?>,'<?php echo $row['training_dt']  ?>',<?php echo $_SESSION['user_id']; ?>)">Approve</button>
                                                                    <?php
                                                                    break;
                                                                    case '3':
                                                                        ?>
                                                                         <button type="button" class="btn btn-success">Already Approved </button>
                                                                        <?php
                                                                    break;
                                                               }
                                                             ?>
                                                        
                                                          </td>
                                                            </tr>
                                                        <?php
                                                    }
                                                ?>
                                            </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>


        </div>

    </div>

    </div>

    </div>



    <!-- msgBox Modal Modal HTML -->
    <div id="cnfModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="m_title" style="text-align:center;"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="warning">
                            <p class="wrn_msg"></p>

                        </div>
                        <div id="m_body" style="display:none">
                            <div class="form-group">
                                <label> Remark : </label>
                                <textarea class="form-control cancel_comment" style="border: 1px solid black;"
                                    id="reject_comment" rows="3"></textarea>
                            </div>
                        </div>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                    </div>
                    <div class="modal-footer" id="m_footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- msgBox Modal Modal HTML -->
    <div id="timetableModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content" style="width:200%; margin:20px -150px">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="timeTable_title" style="text-align:center;"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        
                        <div id="time_Table"></div>
                      
                    </div>
                    <div class="modal-footer" id="t_footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">

                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include('common_script.php') ?>

</body>

</html>

<script type="text/javascript">
// status code 1->pending,2->approve,3->reject


function approve(tbl_id,session_no,trng_dt,user_id) {
    $('#m_body').hide();
    $('#m_footer').html('');
  
    $('#m_title').html(`Approve Modified Time Table`);
    $('.wrn_msg').html(`Hello Sir, Are you sure you want to Approve this Time Table?`);
    var html =
        `<input type="button" class="btn btn-success btn-dlt" value="Approve" onclick="approve_record(${tbl_id},${session_no},'${trng_dt}',${user_id})" />`;
    $('#m_footer').append(html);
    $('#cnfModal').modal('show');
}

function reject(id, title) {
    $('#m_footer').html('');
    $('#timetableModal').modal('hide');
    $('#m_title').html(`${title} Time Table`);
    $('.wrn_msg').html(`Hello Sir,Please Write Remark For  ${title} Time Table?`);
    var html =
        `<input type="button" class="btn btn-danger btn-dlt" value="Reject" onclick="reject_record(${id},'tbl_time_table_range')" />`;
    $('#m_body').show();
    $('#m_footer').append(html);
    $('#cnfModal').modal('show');
}

function approve_record(tbl_id,session_no,trng_dt,user_id) {
   
    $.ajax({
        type: "POST",
        url: "ajax_master.php",
        data: {

            action: "approve_modified_timeTable",
            tbl_id: tbl_id,
            session_no:session_no,
            trng_dt:trng_dt,
            user_id: user_id
        },
        success: function(res) {
            console.log(res);
            if (res == "success") {
                sessionStorage.message = "Record Approve successfully";
                sessionStorage.type = "success";
                location.reload();
            }
        }
    })
}



function cnfBox(id) {
    //alert(id);
    $('#m_footer').empty();
    var html =
        `<input type="button" class="btn btn-danger btn-dlt" value="Delete" onclick="delete_record(${id},'tbl_program_master')" />`;
    $('#m_footer').append(html);
    $('#cnfModal').modal('show');
}

function sendToApprove(id, tbl) {

    $.ajax({
        type: "POST",
        url: "ajax_master.php",
        data: {

            action: "send_to_approve",
            id: id,
            table: tbl
        },
        success: function(res) {
            console.log(res);
            if (res == "success") {
                sessionStorage.message = " Successfully Send to Director for Approval";
                sessionStorage.type = "success";
                location.reload();
            }
        }
    })
}

</script>