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


                <div class="row" style="margin-top:20px">
                    <div class="col-md-12">
                         
                        <div class="card">

                            <div class="card-body">
                            <h3> Class Feedback </h3>
                                <div class="row">

                                    <div id="class_tbl" class=" table table-responsive table-striped table-hover"
                                        style="width:95%;margin:0px auto">
                                        <table class=" term table" id="tableid">
                                          <thead class="" style="background: #315682;color:#fff;font-size: 11px;">
                                            <th style="">Sl No</th>
                                            <th style="text-align:center;">Paper Code</th>
                                            <th style="text-align:center;">subject</th>
                                            <th style="text-align:center;">Topic</th>
                                            <th style="text-align:center;">Sub topic</th>
                                            <th style="text-align:center;">Session No</th>
                                            <th style="text-align:center;">Feadback</th>
                                            <th style="text-align:center;">Action</th>
                                            

                                          </thead> 
                                          <tbody>
                                              <?php
                                              $count = 0;
                                             
                                              $sql = "SELECT atn.id,atn.session_no ,pm.paper_code as paper_code,sm.descr as subject,tm.topic,dtm.dtl_topic FROM `tbl_attendance` atn 
                                              JOIN  `tbl_time_table` tt ON atn.time_tbl_id=tt.id 
                                                                                             JOIN `tbl_paper_master`pm on tt.paper_id= pm.id
                                                                                             JOIN `tbl_subject_master` sm on tt.subject_id=sm.id
                                                                                             JOIN `tbl_topic_master` tm on tt.topic_id = tm.id
                                                                                             JOIN `tbl_detail_topic_master` dtm on tt.detail_topic_id = dtm.id 
                                             WHERE atn.present = 1 AND atn.phone = '".$_SESSION['username']."'";
                                               $db->select_sql($sql);
                                               foreach($db->getResult() as $row ){
                                                   //print_r($row);
                                                   $count++;
                                                   ?>
                                                   <tr>
                                                        <td style="text-align:center;"><?php echo $count; ?></td>
                                                        <td style="text-align:center;" class="paper_code"><?php echo $row['paper_code'] ?></td>
                                                        <td style="text-align:center;"><?php echo $row['subject'] ?></td>
                                                        <td style="text-align:center;"><?php echo $row['topic'] ?></td>
                                                        <td style="text-align:center;"><?php echo $row['dtl_topic'] ?></td>
                                                        <td style="text-align:center;"><?php echo $row['session_no'] ?> </td>
                                                        <?php
                                                           
                                                           $db->select('tbl_feedback',"attendance_id,feedback",null,"attendance_id =".$row['id'],null,null);
                                                           $feedback = $db->getResult();
                                                           //print_r($feedback);
                                                           if($feedback){

                                                            foreach($feedback as $slctFeedback){
                                                                echo '<td>';
                                                                switch($slctFeedback['feedback']){
                                                                       case '5':
                                                                        echo "Excellent";
                                                                        break;
                                                                       case '4':
                                                                        echo "Very Good";
                                                                        break;
                                                                       case '3':
                                                                        echo "Good";
                                                                        break;
                                                                       case '2':
                                                                        echo "Average";
                                                                        break;
                                                                       case '1':
                                                                        echo "Needs Improvement";
                                                                        break;
                                                                       
                                                                }
                                                                echo '</td>';
                                                            }
                                                            echo '<td></td>';
                                                           }else{
                                                             ?>
                                                              <td class="d-flex" >
                                                            <div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="feedback_<?php echo $row['id'] ?>"  value="5" >
                                                                    <label class="form-check-label" for="inlineRadio1">Excellent</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="feedback_<?php echo $row['id'] ?>"  value="4" >
                                                                    <label class="form-check-label" for="inlineRadio2" > Very Good</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="feedback_<?php echo $row['id'] ?>" value="3" >
                                                                    <label class="form-check-label" for="inlineRadio3" >Good</label>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="feedback_<?php echo $row['id'] ?>" value="2" >
                                                                    <label class="form-check-label" for="inlineRadio3" >Average</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="feedback_<?php echo $row['id'] ?>" value="1" >
                                                                    <label class="form-check-label" for="inlineRadio4" >Needs Improvement</label>
                                                               </div>
                                                            </div>
                                                            
                                                            
                                                       </td>
                                                       <td> <button class="btn btn-success" id="save_<?php echo $row['id'] ?>"  onclick="sendFeedback(<?php echo $row['id'] ?>)" >Send</button> </td>
                                                             <?php
                                                           }
                                                        //    foreach($db->getResult() as $feedback){

                                                        //    }
                                                        
                                                        ?>
                                                        
                                                      
                                                        
                                                       
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

    </div>

    <!-- msgBox Modal Modal HTML -->
    <div id="viewTraneeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content" style="width:160%; margin:120px -60px">
                <form id="attandance">
                    <div class="modal-header">
                        <h5 class="modal-title" id="m_title" style="text-align:center;">Attandance </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">

                        <div id="view_tranee"></div>


                    </div>
                    <div class="modal-footer" id="mailbtn">
                        <input type="button" class="btn btn-success" value="Save" onclick="save_attendance()" />
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel" />

                    </div>
                </form>
            </div>
        </div>
    </div>
    
    

    <?php include('common_script.php') ?>

</body>

</html>
<script>
  $(document).ready(function(){
   
  })
  function sendFeedback(id){
    //let paper_code = $(this).closest('tr').find('.paper_code').text();
    let paper_code = $('#save_'+id).closest('tr').find('.paper_code').text();
        let feedBack = $(`input[name="feedback_${id}"]:checked`).val();
      
        $.ajax({
        type:'POST',
        url:'ajax_trainee.php',
        data:{action:"feedback",id:id,feedBack:feedBack},
        success: function(res){
            console.log(res);
            if(res == 'success'){
                location.reload();
            }
           // let elm = res.split('#');
            //console.log(elm[0]);
            // if (elm[0] == "success") {
              
            //     location.reload();
            // }
        }
    })
        
    }
</script>