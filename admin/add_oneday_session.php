<!DOCTYPE html>
<html lang="en">


<head>
    <?php 
    
    include('header_link.php');
    include('../config.php');
    include 'database.php';
    $db = new Database();
    ?>
     <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .session_frm{
        padding: 20px;
    border-radius: 5px;
    background: #def4e2;
    box-shadow: rgb(0 0 0 / 16%) 0px 3px 6px, rgb(0 0 0 / 23%) 0px 3px 6px;
    margin-bottom: 20px;
    }
    h4{
        background: #367a9f;
    color: #fff;
    padding: 5px;
    border-radius: 5px;
    margin-top: 0px;
    margin-bottom: 0px;
    }
    .input-control{
        border-color:#864747 !important;
    }
</style>
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
                <?php
               
             $session_date = $_POST['t_date'];
             $prog_id = $_POST['program_id'];
             $time_table = $_POST['time_table'];
             $program_table = $_POST['program_table'];

             $trng_type = 0;
             $prog_name="";
             $db->select($program_table,'prg_name,trng_type',null,"id=".$prog_id,null,null);
             foreach($db->getResult() as $prog_dtl){
                $trng_type = $prog_dtl['trng_type'];
                $prog_name = $prog_dtl['prg_name'];
             }
           
            ?>
                <div class="row">
                   <!-- <div class="col-md-4">
                        <div id="alert_msg" class="alert alert-success">added successfully</div>
                    </div> -->
                    <div class="col-md-12">
                        
                        <div class="card">
                            <div class="card-header">

                                <h5 class="card-title">Add Time Table for <strong> <?php echo $prog_name ?> (<?php echo date('d-m-Y', strtotime($session_date) ) ; ?>) </strong> </h5>
                                <?php // print_r($_POST); ?>
                               <hr>
                                <form method="post" id="add_session_frm">
                                    <div class="row">
                                       <div class="col-md-3">
                                            <div class="form-group">
                                                <label><strong>Class Start Time</strong></label>
                                               <input type="text" class="form-control" name="start_time" id="start_time" value="10:30 AM" />
                                               
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-3">
                                            <div class="form-group">
                                                <label><strong>Class Duration </strong></label>
                                               <input type="text" class="form-control" name="class_duration" id="class_duration"  />
                                               
                                            </div>
                                        </div> -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><strong>Session NO</strong></label>
                                               <input type="num" class="form-control" name="session_no" id="session_no" value="8"/>
                                               
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-2">
                                            <!-- <input type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#termModal" value="Add Session"> -->

                                            <input type="hidden" name="tt_range_id" value="<?php echo $_POST['tt_range_id'] ?>">
                                            <input type="hidden" name="prog_id" value="<?php echo $prog_id ?>">
                                            <input type="hidden" name="time_table" value="<?php echo $time_table ?>">
                                            <input type="hidden" name="session_date" id="session_date" value="<?php echo $session_date ?>">
                                            <input type="hidden" name="trng_type" id="trng_type" value="<?php echo $trng_type ?>">

                                            <button type="button" class="btn btn-primary" onclick="addOneDaySession(<?php  echo $trng_type ?>)" >Add Session</button>


                                        </div>


                                    </div>
                                </form>
                            </div>
                            
                        </div>

                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12" style="background: #fff;">
                    <div  class="col-md-10" id="add_session_div" style="margin: 0 auto;padding: 20px;"></div>
                    </div>
                   
                </div>

            </div>

        </div>

    </div>

    </div>

    </div>
   <!-- msgBox Modal Modal HTML -->
   <div id="guestModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content" style="width:170% ; margin: 50px -120px;background-color: #d9cece;">
                <form>
                    <div class="modal-header" style="background-color: #3b5157;color:#fff;">
                        <h5 class="modal-title" id="m_title" style="text-align:center;">Guest Faculty Subject Details
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row" id="guest">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Geust Faculty Paper</strong></label>
                                    <select class="custom-select mr-sm-2" name="guest_paper" id="guest_paper">
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
                                    <select class="custom-select mr-sm-2" name="guest_subject" id="guest_subject">

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Geust Faculty</strong></label>
                                    <select class="custom-select mr-sm-2" name="guest_faculty[]" multiple="multiple"
                                        id="guest_faculty" style="width:400px">

                                    </select>


                                </div>
                                <p class="faculty_msg text-danger" style="user-select: auto;"></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" id="m_footer" style="background-color: #525264;height: 60px;">
                        <input type="button" class="btn btn-primary btn-sm" id="add_faculty" value="Add">
                        <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel">

                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include('common_script.php') ?>

</body>

</html>

<script type="text/javascript">

    // $('#add_session_frm').submit(function(e){
    //     e.preventDefault();
     function addOneDaySession(trng_type){
        let URL = '';
        let table = '';
        if(trng_type == 3 || trng_type ==4){
            URL = "inhouse_one_day_session_template.php";
            table = "tbl_inhouse_time_table";
        }
        else if(trng_type == 5 || trng_type ==8){
            URL = "sponsored_one_day_session_template.php";
            table = "tbl_sponsored_time_table.php";
        }
        else if(trng_type == 1 || trng_type ==2){
            URL = "one_day_session_template.php";
            table = "tbl_time_table.php";
        }
      
        $.ajax({
            type: "POST",
            url: URL,
            data: $('#add_session_frm').serialize(),
            success:function(data){
                console.log(data);
                $('#add_session_div').html(data);

                $('.period_type').on('change', function() {
                    let id = $(this).attr('id');
                    //console.log(id);
                    
                         let period = $(`#${id}`).val();
                      
                        if (period == '2') {period
                            $('#break_fld_'+id).show();
                            $('#class_time_'+id).hide();
                        } else {
                            $('#break_fld_'+id).hide();
                            $('#class_time_'+id).show();
                        }

                          //break time code 

                    $('#break_'+id).on('change', function() {
                        var break_time = $('#break_'+id).val();
                        let breakTime = "";
                        let class_start_time = $('.class_start_time_'+id).val();

                        // alert(break_time);
                        $('#class_time_'+id).hide();

                        switch (break_time) {
                            case "0":
                                $('#class_time_'+id).show();
                                break;
                            case "1":
                                breakTime = .25;

                                break;
                            case "2":
                                breakTime = 1;
                                break;
                            default:
                                break;
                        }
                        $.ajax({
                            type: "POST",
                            url: "ajax_timetable.php",

                            data: {
                                action: "add_break_time",
                                breakTime: breakTime,
                                class_start_time: class_start_time

                            },
                            success: function(res) {
                                console.log(res);
                                $('.class_end_time_'+id).val(res);

                            }
                        })

                    })
                    })
                
               //session type code

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

                  //faculty section
                 $('.inhouse').select2();
                 $('#guest_faculty').select2();
                    $('input[name="faculty"]').click(function() {
                        if ($(this).is(':checked')) {
                            //alert($(this).val());
                            let div_id = $(this).attr('id');
                            console.log(div_id);
                            let id = $(this).val();
                            if (id == 1) {
                                $.ajax({
                                    type: "POST",
                                    url: "ajax_timetable.php",

                                    data: {
                                        facult_id: id,
                                        table: "tbl_faculty_master",
                                        action: "select_faculty"
                                    },
                                    success: function(res) {
                                        console.log(res);
                                        $('.faculty_id_div').html(res);
                                        $('#faculty_id_'+div_id).select2();
                                    }
                                })
                            } else {
                                //    $('#guest').show();
                                //    $('.inhouse').hide();
                                $('#guestModal').modal('show');

                                $.ajax({
                                    type: "POST",
                                    url: "ajax_timetable.php",

                                    data: {

                                        table: "tbl_faculty_master",
                                        action: "select_guest_faculty"
                                    },
                                    success: function(res) {

                                        $('.faculty_id_div').html(res);

                                     
                                    }
                                })

                                $('#add_faculty').on('click', function() {
                                    var guest_faculty = $('#guest_faculty').val();
                                    var faculty = guest_faculty.toString();
                                    $.ajax({

                                        type: "POST",
                                        url: "ajax_timetable.php",

                                        data: {
                                            action: "add_guest_faculty",
                                            faculty_id: faculty,
                                            table: "tbl_faculty_master"

                                        },
                                        success: function(res) {
                                            console.log(res);
                                            $('#faculty_id_'+div_id).html(res);
                                        }
                                    });


                                    $('#guestModal').modal('hide');
                                    console.log(faculty);
                                })

                            }

                        }
                    })
                $('select[name="subject_id"]').on('change',function() {
                  
                    let sub_id = $(this).attr('id');
                    let elm = sub_id.split('_');
                    let id = elm[1];
                    let subj_id = $('#subjectId_'+id).val();

                    if (subj_id == -1) {
                        $('#otherSubject_'+id).show();
                    }
                    else{
                        $('#otherSubject_'+id).hide();
                    }
                   
                })
            }

            

        })
    }

    

function addSession(id,trng_type,callback) {

var update_id = $('#update_id_'+id).val();
var faculty = $("input[name = 'faculty']:checked",'#frm_timeTable_'+id).val();
console.log(update_id);
let table;

    if(trng_type == 3 || trng_type == 4){
       table = "tbl_inhouse_time_table";
    }
    else if(trng_type == 5 || trng_type ==8){
        table = "tbl_sponsored_time_table";
    }
    else if(trng_type == 1 || trng_type ==2){
        table = "tbl_time_table";
    }

$.ajax({
    type: "POST",
    url: "ajax_timetable.php",

    data: $('#frm_timeTable_'+id).serialize() + '&' + $.param({
        'faculty_type': faculty,
        'action': 'add_table',
        'table': table,
        'update_id': update_id
    }),
    success: function(res) {
        console.log(res);
        let elm = res.split('#');
        var str = "Time Table";
        callback(elm[2],id);
       
        if (elm[2] == "success") {
            sessionStorage.message = str + ' ' + elm[1];
            sessionStorage.type = "success";
            addOneDaySession(trng_type);
            //location.reload();
        }

        if ((elm[2] == "error")) {
            if (elm[0] == 'start') {
                $('#start_time').html(elm[1]);
                $('#start_time').show();
            }
            if (elm[0] == 'end') {
                $('#end_time').html(elm[1]);
                $('#end_time').show();
            }

        }
    }
})

}

function showMsg(flag,id){

//alert(flag);
$('#alert_msg_'+id).show();
closeMsgBox(id);

}

function closeMsgBox(id){
window.setTimeout(function () {
$("#alert_msg_"+id).fadeOut(500)
}, 3000);
}

</script>