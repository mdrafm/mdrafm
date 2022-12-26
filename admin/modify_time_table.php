<!DOCTYPE html>
<html lang="en">


<head>
    <?php 
    
    include('header_link.php');
    include('../config.php');
    include 'database.php';
    ?>
<!-- select2 -->
<link href="assets/css/mdtimepicker.css" rel="stylesheet" type="text/css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
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


            <div class="content">


                <div class="row" style="margin-top:50px">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"> Modify Time Table</h4>

                            </div>
                            <div class="card-body">
                                <form id="frm_range">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><strong>Select Training Type</strong></label>
                                                <select class="custom-select mr-sm-2" name="traning_type" id="traning_type">
                                                    <option selected>Select Type</option>
                                                    <?php 
                                                                    $db = new Database();
                                                                    $count = 0;
                                                                    $db->select('tbl_training_type',"*",null,null,null,null);
                                                                    // print_r( $db->getResult());
                                                                    foreach($db->getResult() as $row){
                                                                        //print_r($row);
                                                                        $count++
                                                                 ?>
                                                    <option value="<?php echo $row['id'] ?>">
                                                        <?php echo $row['type'] ?>
                                                    </option>

                                                    <?php 
                                                            }
                                                       ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><strong>Select Program</strong></label>
                                                <select class="custom-select mr-sm-2" name="program_id" id="program_id">
                                                    <option selected>Select Program</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3" id="table_name_div">
                                            <div class="form-group">
                                                <label><strong>Select Time Table</strong></label>
                                                <select class="custom-select mr-sm-2" name="table_name" id="table_name">
                                                    <option selected>Select Time Table</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><strong>Select Date</strong></label>
                                                <select class="custom-select mr-sm-2" name="t_date" id="t_date">
                                                    <option selected>Select Date</option>
                                                </select>
                                            </div>
                                        </div>
                                         <input type="hidden" name="type" value="1" />

                                    </div>
                                    <div class="row">
                                        <div class="col-md-11">
                                            <div class="form-group">

                                                <input type="button" class="btn btn-primary" value="view" id="view_time_table"  style="float: right"
                                                    onclick="time_table()">
                                            </div>

                                        </div>
                                    </div>
                                </form>
                                <input type="hidden" name="update_id"  id="update_id" />
                            </div>
                        </div>

                    </div>

                </div>

                <div class="row" style="margin-top:50px">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"></h4>

                            </div>
                            <div class="card-body">
                                <div id="term2" class=" table table-responsive table-striped table-hover"
                                    style="width:95%;margin:0px auto;display:none">
                                   
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
    

    <div class="fixed-plugin">
        <div class="dropdown show-dropdown">
            <a href="#" data-toggle="dropdown">
                <i class="fa fa-cog fa-2x"> </i>
            </a>
            <ul class="dropdown-menu">
                <li class="header-title"> Sidebar Background</li>
                <li class="adjustments-line">
                    <a href="javascript:void(0)" class="switch-trigger background-color">
                        <div class="badge-colors text-center">
                            <span class="badge filter badge-yellow" data-color="yellow"></span>
                            <span class="badge filter badge-blue" data-color="blue"></span>
                            <span class="badge filter badge-green" data-color="green"></span>
                            <span class="badge filter badge-orange active" data-color="orange"></span>
                            <span class="badge filter badge-red" data-color="red"></span>
                        </div>
                        <div class="clearfix"></div>
                    </a>
                </li>


            </ul>
        </div>
    </div>

    <!-- msgBox Modal Modal HTML -->
    <div id="cnfModalSend" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="m_title" style="text-align:center;"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="warning">
                            <p>Are you sure you want to Send this Record?</p>
                            <p class="text-warning"><small>This action cannot be undone.</small></p>
                        </div>
                        <p id="m_body"></p>
                    </div>
                    <div class="modal-footer" id="ms_footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">

                    </div>
                </form>
            </div>
        </div>
    </div>

         <!-- Modal -->
         <div class="modal fade" id="termModal" tabindex="-1" aria-labelledby="termModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content" style="width:200%; margin:20px -150px">
                                    <div class="modal-header">

                                        <h5 class="modal-title" id="termModalLabel"> Edit Time Table </h5>
                                           

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <form method="post" id="frm_timeTable">
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong>Training Date</strong></label>
                                                        <input type="date" class="form-control" name="training_dt"
                                                            id="training_dt" placeholder="Select Training Date"
                                                            >
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group"> 
                                                        <label><strong> Period Type</strong></label>
                                                        <select class="custom-select mr-sm-2" name="period_type"
                                                            id="period_type">
                                                            <option value="0">Select Period Type</option>
                                                            <option value="1"> Session</option>
                                                            <option value="2"> Break</option>
                                                        </select>



                                                    </div>
                                                </div>
                                                <div class="col-md-3" id="break_fld" style="display:none">
                                                    <div class="form-group">
                                                        <label><strong> Break</strong></label>
                                                        <select class="custom-select mr-sm-2" name="break" id="break">

                                                            <option value="0">Select Break</option>
                                                            <option value="1"> Tea Break</option>
                                                            <option value="2"> Lunch Break</option>

                                                        </select>


                                                    </div>
                                                </div>


                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong> Class Start Time</strong></label>
                                                       
                                                            <input type="text" class="form-control" name="class_start_time" id="timepicker_start"/>
                                                            <p id='start_time' style="display:none"></p>
                                                            <span> <button type="button" id="verify_start" onclick = "verify_time('start_time')" class="btn btn-sm" style="background-color:#141664">Verify Class Time</button></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong>Class End Time</strong></label>
                                                        <input type="text" class="form-control" name="class_end_time"  id="timePicker_end"/>
                                                        <p id='end_time' style="display:none"></p>
                                                        <span> <button type="button" id="verify_end" onclick = "verify_time('end_time')" class="btn btn-sm" style="background-color:#141664">Verify Class Time</button></span>
                                                    </div>
                                                </div>

                                            </div>
                                            <div id="class_time">
                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label><strong>Session Type</strong></label>
                                                            <div class="form-check form-check-inline"
                                                                style="margin-left: 20px;">
                                                                <input class="form-check-input" type="radio"
                                                                    name="session_type" id="ClassRoom" value="1"
                                                                    checked>
                                                                <label class="form-check-label" for="Inhouse"
                                                                    style="padding-left: 5px;">ClassRoom Study</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="session_type" id="other" value="2">
                                                                <label class="form-check-label" for="Visiting"
                                                                    style="padding-left: 5px;">Other</label>
                                                            </div>
                                                           
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 class_room">
                                                        <div class="form-group">
                                                            <label><strong>Faculty Name</strong></label>
                                                            <div class="form-check form-check-inline"
                                                                style="margin-left: 20px;">
                                                                <input class="form-check-input" type="radio"
                                                                    name="faculty" id="inHouse" value="1">
                                                                <label class="form-check-label" for="Inhouse"
                                                                    style="padding-left: 5px;">Inhouse Faculty</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="faculty" id="guest" value="2">
                                                                <label class="form-check-label" for="Visiting"
                                                                    style="padding-left: 5px;">Visiting Faculty</label>
                                                            </div>
                                                            <select class="custom-select mr-sm-6 faculty_id_div" name="faculty_id[]"
                                                                multiple="multiple" id="faculty_id" style="width:400px">
                                                                <option selected value="0">Select Faculty</option>

                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 ">
                                                        <div class="others" style="display:none">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label><strong>Select Other
                                                                                Class</strong></label>
                                                                        <select class="custom-select mr-sm-2"
                                                                            name="other_class" id="other_class">
                                                                            <option selected value="0">Select Other
                                                                                Class</option>
                                                                            <?php 
                                                                        
                                                                        $count = 0;
                                                                        $db->select('other_topic',"*",null,null,null,null);
                                                                        // print_r( $db->getResult());
                                                                        foreach($db->getResult() as $row){
                                                                            //print_r($row);
                                                                            $count++
                                                                    ?>
                                                                            <option value="<?php echo $row['id'] ?>">
                                                                                <?php echo $row['name'] ?>
                                                                            </option>

                                                                            <?php 
                                                        }
                                                        ?>
                                                                        </select>


                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label><strong>Remark</strong></label>
                                                                        <textarea class="form-control"
                                                                            name="class_remark" id="class_remark"
                                                                            placeholder="Remark for Other Class"
                                                                            rows="3"
                                                                            style="border: 1px solid #e3e3e3;border-radius:5px;"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- class room -->
                                                <div class="class_room">


                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label><strong>Term</strong></label>
                                                                <select class="custom-select mr-sm-2" name="term_id"
                                                                    id="term_id">
                                                                    <option selected value="0">Select Term</option>
                                                                    <?php 
                                                                    $db = new Database();
                                                                    $count = 0;
                                                                    $db->select('tbl_term_master',"*",null,null,null,null);
                                                                    // print_r( $db->getResult());
                                                                    foreach($db->getResult() as $row){
                                                                        //print_r($row);
                                                                        $count++
                                                                 ?>
                                                                    <option value="<?php echo $row['id'] ?>">
                                                                        <?php echo $row['term'] ?>
                                                                    </option>

                                                                    <?php 
                                                       }
                                                       ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label><strong>Paper</strong></label>
                                                                <select class="custom-select mr-sm-2" name="paper_id"
                                                                    id="paper_id">
                                                                    <option selected value="0">Select Paper</option>

                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row">

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label><strong>Subject</strong></label>
                                                                <select class="custom-select mr-sm-2"
                                                                    name="subject_id" id="subject_id">
                                                                    <option selected value="0">Select Subject</option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label><strong>Topic</strong></label>
                                                                <select class="custom-select mr-sm-2" id="topic_id"
                                                                    name="topic_id">
                                                                    <option selected value="0">Select Topic</option>

                                                                </select>
                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label><strong> Sub-Topic</strong></label>
                                                                <select class="custom-select mr-sm-2" id="dtl_topic_id"
                                                                    name="dtl_topic">
                                                                    <option selected value="0">Select Topic Detail
                                                                    </option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label><strong>Related Topic</strong></label>
                                                                <textarea class="form-control" name="paper_covered"
                                                                    id="paper_covered" placeholder="Enter Related Topic"
                                                                    rows="3"
                                                                    style="border: 1px solid #e3e3e3;border-radius:5px;"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- mid turm & short term -->
                                                <div class="trng_cat" style="display:none" >
                                                <div class="row">
                                                        <div class="col-md-6 mid_subject_div">
                                                            <div class="form-group">
                                                                <label><strong>Subject</strong></label>
                                                                <select class="custom-select mr-sm-2" name="subject_id"
                                                                    id="mid_subject_id">
                                                                    <option selected value="0">Select Subject</option>
                                                                    <?php
                                                                       $db->select('tbl_mid_subject_master',"*",null,null,null,null);
                                                                       foreach($db->getResult() as $midSub){
                                                                          ?>
                                                                    <option value=<?php echo $midSub['id'] ?>>
                                                                        <?php echo $midSub['descr'] ?> </option>
                                                                    <?php
                                                                       }
                                                                     ?>
                                                                    <option value="-1">Other</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6" style="display:none" id="other_subject">
                                                            <div class="form-group">
                                                                <label><strong>Other Subject</strong></label>
                                                                <textarea class="form-control" name="paper_covered"
                                                                    id="paper_covered" placeholder="Enter Other Subject"
                                                                    rows="3"
                                                                    style="border: 1px solid #e3e3e3;border-radius:5px;"></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6" style="display:none" id="short_subject">
                                                            <div class="form-group">
                                                                <label><strong>Subject</strong></label>
                                                                <textarea class="form-control" name="paper_covered"
                                                                    id="paper_covered2" placeholder="Enter Other Subject"
                                                                    rows="3"
                                                                    style="border: 1px solid #e3e3e3;border-radius:5px;"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end class room -->
                                            <input type="hidden" name="trng_type" value="1">
                                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" />
                                            <input type="hidden" id="update_id">
                                            <input type="hidden"name ="session_no"  id = "session_no" >
                                        </form>
                                        <input type="hidden" id = "cls_start_time">
                                        <input type="hidden" id = "cls_end_time" >
                                       
                                        <input type="hidden" id = "trng_dt" >
                                    </div>
                                    <div class="modal-footer">

                                        <button type="submit" class="btn btn-primary" name="submit" value="Save"
                                            id="save"
                                            onclick="update_table('Time Table','frm_timeTable','tbl_modifytimetable')">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
         <!-- Guest Faculty Modal -->
    <div id="guestModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content" style="width:170% ; margin: 50px -120px;background-color: #d9cece;">
                <form>
                    <div class="modal-header" style="background-color: #3b5157;color:#fff;">
                        <h5 class="modal-title" id="m_title" style="text-align:center;">Guest Faculty Subject Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                    <div class="row" id="guest" >
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Geust Faculty Paper</strong></label>
                                    <select class="custom-select mr-sm-2" name="guest_paper"
                                        id="guest_paper">
                                        <option selected value="0">Select Paper</option>
                                        <?php 
                                        $db = new Database();
                                        $count = 0;
                                        $db->select('tbl_guest_paper',"*",null,null,null,null);
                                        // print_r( $db->getResult());
                                        foreach($db->getResult() as $row){
                                            //print_r($row);
                                            $count++
                                        ?>
                                        <option value="<?php echo $row['id'] ?>">
                                            <?php echo $row['paper_name'] ?>
                                        </option>

                                        <?php 
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Geust Faculty Subject</strong></label>
                                    <select class="custom-select mr-sm-2" name="guest_subject"
                                        id="guest_subject">
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Geust Faculty</strong></label>
                                    <select class="custom-select mr-sm-2" name="guest_faculty[]"  multiple="multiple" 
                                        id="guest_faculty" style="width:400px">
                                        
                                    </select>
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" id="m_footer" style="background-color: #525264;height: 60px;">
                    <input type="button" class="btn btn-primary btn-sm" id="add_faculty"  value="Add">
                        <input type="button" class="btn btn-default btn-sm"  data-dismiss="modal" value="Cancel">

                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include('common_script.php') ?>

</body>

</html>

<script type="text/javascript">
$('#timepicker_start').mdtimepicker(); //Initializes the time picker
$("#timePicker_end").mdtimepicker();

$('#faculty_id').select2();
$('#guest_faculty').select2();

$('#traning_type').on('change', function(){
   var type = $('#traning_type').val();

   $.ajax({
        type: "POST",
        url: "ajax_master.php",
        data: {

            action: "timeTable_prgram",
            type: type,
            
        },
        success: function(res) {
            
                $('#program_id').html(res);
            
            
            
        }
    })
})

$('#program_id').on('change', function(){
   var program_id = $('#program_id').val();

   $.ajax({
        type: "POST",
        url: "ajax_master.php",
        data: {

            action: "timeTable_name",
            program_id: program_id,
            
        },
        success: function(res) {
            const trng_type =  $('#traning_type').val();
            if(trng_type == 3 || trng_type ==4){
                $('#table_name_div').css('display', 'none');

                $.ajax({
                    type: "POST",
                    url: "ajax_master.php",
                    data: {

                        action: "timeTable_date",
                        program_id: program_id,
                        trng_type:trng_type,
                        
                    },
                    success: function(res) {
                        console.log(res);
                        $('#t_date').html(res);
                        
                    }
                })
                
            }else{
                $('#table_name').html(res);
            }
           
            
        }
    })
})  
$('#table_name').on('change', function(){
  
   var table_name = $('#table_name').val();
  
   $.ajax({
        type: "POST",
        url: "ajax_master.php",
        data: {

            action: "timeTable_date",
            table_name:table_name
            
        },
        success: function(res) {
            console.log(res);
            $('#t_date').html(res);
            
        }
    })
})  



function time_table(){
    var table_name = $('#table_name').val();
    var t_date = $('#t_date').val();
    var program_id = $('#program_id').val();
    const trng_type =  $('#traning_type').val();

    $.ajax({
        type: "POST",
        url: "ajax_search.php",
        data: {

            action: "timeTable_date",
            table_name:table_name,
            program_id:program_id,
            trng_type:trng_type,
            t_date:t_date
            
        },
        success: function(res) {
            console.log(res);
            $('#term2').html(res);
            $('#term2').show();
            
        }
    })
}



function verify_time(period){
    //$("#timePicker_end").val("12:30 PM");
    let start_time =   $("#timepicker_start").val();
    let end_time =   $("#timePicker_end").val();
    let update_id =   $("#update_id").val();
    
    //alert(program_id);
    $.ajax({
        type: "POST",
        url:"ajax_master.php",
        data:{'action':'edit_verify_time',period:period,start_time:start_time,end_time:end_time,tbl_id:update_id},
        success: function(data){
            //console.log(data);
            let elm = data.split('#');
            console.log(elm);
            if(elm[0] == 'start'){
                $('#start_time').addClass('error');
                $('#start_time').html(elm[1]);
                $('#start_time').show();
            }else{
                $('#start_time').hide();
                $('#end_time').addClass('error');
                $('#end_time').html(elm[1]);
                $('#end_time').show();
            }
        }
    })
}
$('#mid_subject_id').on('change', function() {
    let sub_id = $('#mid_subject_id').val();
    if (sub_id == -1) {
        $('#other_subject').show();
    }
})
function edit(id) {

$.ajax({
    type: "POST",
    url: "ajax_master.php",
    dataType: "json",
    data: {
        action: "edit",
        table: "tbl_time_table",
        edit_id: id

    },
    success: function(res) {
        console.log(res);
        res.map((data) => {

                $('#update_id').val(data.id);
                $('#program').val(data.program_id);

                $('#training_dt').val(data.training_dt);
                $('#period_type').val(data.period_type);
                if(data.period_type == 2){
                    $('#break_fld').show();
                    $('#break').val(data.break_time);
                    $('#class_time').hide();
                }
                $('#timepicker_start').val(data.class_start_time);
                $('#timePicker_end').val(data.class_end_time);
                $('#faculty_id').val(data.faculty_id);
                $('#term_id').val(data.term_id);
                $('#paper_id').val(data.paper_id);
                $('#subject_id').val(data.subject_id);
                $('#topic_id').val(data.topic_id);
                $('#paper_covered').val(data.paper_covered);
                $('#cls_start_time').val(data.class_start_time);
                $('#cls_end_time').val(data.class_end_time);
                $('#session_no').val(data.session_no);
                $('#trng_dt').val(data.training_dt);
                var paper = $('#paper_id').val();

               

                if (data.session_type == 2) {
                    //console.log(23);
                    $('#other').attr('checked', 'checked');
                    $('.class_room').hide();
                    $('.others').show();


                    $.ajax({

                        type: "POST",
                        url: "ajax_edit_master.php",

                        data: {
                            other_class: data.other_class,

                            table: "other_topic",
                            action: "other_class"
                        },
                        success: function(res) {
                            console.log(res);
                            $('#other_class').html(res);
                        }
                    });
                    //$('#class_remark').val(data.class_remark);

                } else {

                    $('#ClassRoom').attr('checked', 'checked');
                    $('.class_room').show();
                    $('.others').hide();

                    if(data.trng_type == "3"){
                        $('.class_room').hide();
                        $('.trng_cat').show();
                    }

                    if( data.trng_type == "4"){
                        $('.class_room').hide();
                        $('.mid_subject_div').hide();
                        $('.other_subject').hide();
                        $('.trng_cat').show(); 
                        $('#short_subject').show();
                        
                        $('#paper_covered2').val(data.paper_covered);

                    }

                    if(data.faculty_type == 2){
                       
                       $('#guest').attr('checked', 'checked');
                  }else{
                    
                      $('#inHouse').attr('checked', 'checked');
                  }

                    $.ajax({

                        type: "POST",
                        url: "ajax_timetable.php",

                        data: {
                          
                            facult_id: data.faculty_id,

                            table: "tbl_faculty_master",
                            action: "select_editFaculty"
                        },
                        success: function(res) {
                            console.log(res);
                            $('#faculty_id').html(res);
                        }
                    });

                  
                        var term_id = data.term_id;
                         var paper_id = data.paper_id;

                        $.ajax({
                            type: "POST",
                            url: "ajax_edit_master.php",

                            data: {
                                term_id: term_id,
                                paper_id:paper_id,
                                table: "tbl_paper_master",
                                action: "select_paper"
                            },
                            success: function(res) {
                                //console.log(res);
                                $('#paper_id').html(res);
                                   var paper = $('#paper_id').val();
                               
                                    $.ajax({
                                        type: "POST",
                                        url: "ajax_edit_master.php",

                                        data: {
                                            sub_id: data.subject_id,
                                            paper_id: paper,
                                            table: "tbl_subject_master",
                                            action: "select_subject"
                                        },
                                        success: function(res) {
                                            //console.log(res);
                                            $('#subject_id').html(res);
                                            mjr_sub = $('#subject_id').val();
                                            //console.log(mjr_sub);
                                            $.ajax({
                                                type: "POST",
                                                url: "ajax_edit_master.php",

                                                data: {
                                                    topic_id: data.topic_id,
                                                    mjr_sub_id: mjr_sub,
                                                    table: "tbl_topic_master",
                                                    action: "select_topic"
                                                },
                                                success: function(res) {
                                                   
                                                    $('#topic_id').html(res);
                                                    var topic_id = $('#topic_id').val();
                                                    var dtl_topic_id = data.detail_topic_id;
                                                   $.ajax({
                                                        type: "POST",
                                                        url: "ajax_edit_master.php",

                                                        data: {
                                                            topic_id: topic_id,
                                                            
                                                            dtl_topic_id:dtl_topic_id,
                                                            table: "tbl_detail_topic_master",
                                                            action: "select_detail_topic"
                                                        },
                                                        success: function(res) {
                                                            console.log(res);
                                                            $('#dtl_topic_id').html(res);
                                                                
                                                                    

                                                        }
                                                    });

                                                    
                                                }
                                            });
                                           
                                        }
                                    });
                            }
                        })

                  
                }

                $('#save').html('Update');
                $('#save').attr('id', 'update');
                $('#termModal').modal('show');

            }

        )

    }
})
}




//uptate timr table 
function update_table(str, frm, tbl) {


var update_id = $('#update_id').val();
var faculty = $("input[name = 'faculty']:checked").val();

$.ajax({
    type: "POST",
    url: "ajax_master.php",

    data: $('#' + frm).serialize() + '&' + $.param({
        'faculty_type':faculty,
        'action': 'update_time_table',
        'table': tbl,
        'update_id': update_id
    }),
    success: function(res) {
        console.log(res);
        let elm = res.split('#');
        if (elm[0] == "success") {
            sessionStorage.message = str + ' ' + elm[1];
            sessionStorage.type = "success";
            location.reload();
            //$("#term2").load(" #term2 > *");
        }
    }
})

}

function sendToApprove(id,tbl){
    if(confirm('Are you sure you want to Send this Program to Director For Approval')){
    $.ajax({
        type: "POST",
        url: "ajax_master.php",
        data: {

            action: "timeTable_approval",
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
 }else{
     return false;
 }
}

//modify time tableapproval status code , 0->draft,1->pending at director,2->approve by director,3->self Approve

function cnf_dirApproval(tbl_id,session_no,trng_dt) {
    //alert(id);
    $('#ms_footer').empty();
    $('#m_title').empty();

    var html =
       
        `<button type="submit" class="btn btn-primary" onclick="dirApproval(${tbl_id},${session_no},'${trng_dt}')">Send to Director</button>`;
    $('#m_title').html(`Send to Director for Approval `);                                         
    $('#ms_footer').append(html);
    $('#cnfModalSend').modal('show');
}

function cnf_selfApproval(tbl_id,session_no,trng_dt){
    $('#ms_footer').empty();
    $('#m_title').empty();

    var html =
       
        `<button type="submit" class="btn btn-primary" onclick="selfApproval(${tbl_id},${session_no},'${trng_dt}')">Self Approve</button>`;
    $('#m_title').html(`Self Approval Approval `);                                         
    $('#ms_footer').append(html);
    $('#cnfModalSend').modal('show');
}

function selfApproval(tbl_id,session_no,trng_dt) {
  var user_id = <?php echo $_SESSION['user_id']; ?>;
  //alert(user_id);
        $.ajax({
            type: "POST",
            url: "ajax_master.php",
            data: {

                action: "selfApprove_modified_timeTable",
                tbl_id: tbl_id,
                session_no: session_no,
                trng_dt:trng_dt,
                user_id:user_id

            },
            success: function(res) {
                console.log(res);
                if (res == "success") {
                    sessionStorage.message = "record deleted successfully";
                    sessionStorage.type = "success";
                    location.reload();
                }
            }
        })
}

function dirApproval(tbl_id,session_no,trng_dt) {

    $.ajax({
        type: "POST",
        url: "ajax_master.php",
        data: {

            action: "director_approval",
            tbl_id: tbl_id,
            session_no: session_no,
            trng_dt:trng_dt
        },
        success: function(res) {
            console.log(res);
            // if (res == "success") {
            //     sessionStorage.message = "record deleted successfully";
            //     sessionStorage.type = "success";
            //     location.reload();
            // }
        }
    })
}

$('input[name="session_type"]').click(function() {
    if ($(this).is(':checked')) {
        //alert($(this).val());
        let id = $(this).val();
        if (id == 2) {
            $('.class_room').hide();
            $('.others').show();
        } else {
            $('.class_room').show();
            $('.others').hide();
        }

    }
})

$('#period_type').on('change',function(){
    let period = $('#period_type').val();
  
    if(period == '2'){
        $('#break_fld').show();
    }
    else{
        $('#break_fld').hide();
    }
})

function datapost(path, params, method) {
    //alert(path);
    method = method || "post"; // Set method to post by default if not specified.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);
    for (var key in params) {
        if (params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);
            form.appendChild(hiddenField);
        }
    }
    document.body.appendChild(form);
    form.submit();
}
</script>