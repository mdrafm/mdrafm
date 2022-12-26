<!DOCTYPE html>
<html lang="en">


<head>
    <?php 
  
    include('header_link.php');
   
    include('../config.php');
    include 'database.php';
    $db = new Database();
    $from_dt = $_POST["from_dt"];
    $to_dt = $_POST["to_dt"];
   // print_r($_POST);
    $trng_dt = '';
   

   
    ?>
    <!-- <link rel="stylesheet" href="assets/css/timepicker.min.css">
    <script src="assets/js/timepicker.min.js"></script> -->
    <!-- select2 -->

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.1.0/minty/bootstrap.min.css"> -->
    <link href="assets/css/mdtimepicker.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <style>
    /* .table tbody tr td a:hover{
       display: block;
    } */
    body {
        color: black !important;
    }

    .table {
        color: black !important;
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

                <div class="row">
                    <div class="col-md-4">
                        <div id="alert_msg" class="alert alert-success">added successfully</div>
                    </div>
                    <div class="col-md-6">
                        <!-- Modal -->
                        <div class="modal fade" id="termModal" tabindex="-1" aria-labelledby="termModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content" style="width:200%; margin:20px -150px">
                                    <div class="modal-header">

                                        <h5 class="modal-title" id="termModalLabel">Time Table For
                                            <?php echo $_POST['prog_name'] ?></h5>

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div id="time_table_div"></div>

                                    </div>
                                    <div class="modal-footer">

                                        <button type="submit" class="btn btn-primary" name="submit" value="Save"
                                            id="save"
                                            onclick="add('Time Table','frm_timeTable','tbl_sponsored_time_table')">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header">

                                <h5 class="card-title"> Time Table </h5>

                                <div class="row">
                                    <div class="col-md-7">
                                        Duration
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        : From <strong> <?php echo  date("d/m/Y", strtotime($_POST['from_dt']));  ?> </strong> To
                                        <strong><?php echo date("d/m/Y", strtotime($_POST['to_dt']));  ?></strong>
                                    </div>
                                </div>
                                <div class="row">
                            
                                    <div class="col-md-4">
                                        <br>
                                        <div class="form-group">
                                            <label><strong>Program :</strong></label>
                                            <strong><?php echo $_POST['prog_name'];  ?></strong>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong> Select Date</strong></label>
                                            <select class="custom-select mr-sm-2" name="t_date" id="t_date">
                                                <option value='0' selected>Select Date</option>
                                                <?php
                                                              $begin = new DateTime( $_POST["from_dt"] );
                                                              $end   = new DateTime( $_POST["to_dt"] );
                                                              
                                                              for($i = $begin; $i <= $end; $i->modify('+1 day')){
                                                                  ?>

                                                <option><?php echo $i->format("Y-m-d"); ?> </option>
                                                <?php
                                                              }
                                                            
                                                            ?>

                                            </select>
                                            <small class="text-danger" id="t_date_error" style="display:none">Please
                                                select a Date</small>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <!-- <input type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#termModal" value="Add Session"> -->
                                            <?php 
                                              $end_dt = $_POST["to_dt"];
                                              $today_dt = date("Y-m-d");
                                              
                                             ?>
                                        <input type="button" class="btn btn-primary" id="add_session"
                                            value="Add Session" <?php echo ( $today_dt > $end_dt )?'disabled':'' ?> >


                                    </div>


                                </div>

                            </div>
                            <div class="card-body">

                            </div>
                        </div>

                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Time Table</h4>

                            </div>
                            <div class="card-body">
                                <div id="term2" class=" table table-responsive table-striped table-hover">
                                    <table class=" term table">
                                        <thead class="" style="background: #315682;color:#fff;font-size: 11px;">

                                            <th>Sl No</th>
                                            <th>Date</th>

                                            <?php  
                                              $session_count = 0;
                                                 $db->select('tbl_sponsored_time_table',"MAX(session_no) as session",null,"program_id = '".$_POST['id']."' ",null,null);
                                                   //print_r( $db->getResult());
                                                   foreach($db->getResult() as $seson){
                                                    $session_count = $seson['session'];
                                                        for($i=1 ; $i <= $seson['session'];$i++ ){
                                                            ?>
                                            <th>
                                                <?php 
                                                               echo $i ;
                                                               $db->select('tbl_sponsored_time_table',"class_start_time,class_end_time",null,"session_no = '$i' GROUP BY session_no",null,null);
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

                                                Session <br>

                                            </th>
                                            <?php
                                                        }
                                                   }

                                            
                                            ?>

                                        </thead>
                                        <tbody>
                                            <?php 
                               
                              
                                            $count = 0;
                                            $db->select('tbl_sponsored_time_table',"DISTINCT training_dt",null,"program_id = '".$_POST['id']."' ",null,null);
                                            // print_r( $db->getResult());
                                            foreach($db->getResult() as $row){
                                                //print_r($row);
                                                $count++
                                                ?>
                                            <tr>
                                                <td><?php echo $count; ?></td>
                                                <td><?php echo date("d-m-Y", strtotime($row['training_dt']))  ?> </td>

                                                <?php
                                                   for ($x=1; $x <= $session_count ; $x++) { 
                                                    $db->select('tbl_sponsored_time_table',"*",null,"program_id = '".$_POST['id']."' AND training_dt='".$row['training_dt']."' AND session_no = '".$x."' ",null,null); 
                                                    //print_r( $db->getResult()); echo '<pre>';
                                                    ?>
                                                <td class="session">
                                                    <?php
                                                     foreach($db->getResult() as $res){
                                                             //print_r($res);
                                                            ?>
                                                    <a href="#" style="color:#4164b3;float: right;"
                                                        class="edit_<?php echo $res['id']; ?>"
                                                        id="<?php echo $res['id']; ?>" onclick="edit(this.id)"><i
                                                            class="far fa-edit " style="font-size:1.5rem;"></i></a>
                                                    <?php
                                                            switch ($res['break_time']) {
                                                                case '1':
                                                                    echo '<div><p>'.'Break Time - '. $res['class_start_time'] .' - '. $res['class_end_time'].'</div></p><p>Tea Break<p>';
                                                                    break;
                                                                case '2':
                                                                    echo '<div><p>'.'Lunch Time - '. $res['class_start_time'] .' - '. $res['class_end_time'].'</div></p><p>Tea Break<p>';
                                                                    break;
                                                                default:
                                                                
                                                                echo '<div><p>'.'Class time - '. $res['class_start_time'] .' - '. $res['class_end_time'].'</div></p>';
                                                            
                                                                if($res['session_type'] == 1){
                                                                if($res['paper_covered'] != '' ){
                                                                    echo '<p>'. $res['paper_covered']. '</p>' ;
                                                                    echo '<p>'. $res['faculty_name']. '</p>' ;
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
                                                     ?>
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

    <!-- msgBox Modal Modal HTML -->
    <div id="cnfModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="m_title" style="text-align:center;">Delete Term</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="warning">
                            <p>Are you sure you want to delete this Record?</p>
                            <p class="text-warning"><small>This action cannot be undone.</small></p>
                        </div>
                        <p id="m_body"></p>
                    </div>
                    <div class="modal-footer" id="m_footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- msgBox Modal Modal HTML -->
    <div id="cnfModaSend" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="m_title" style="text-align:center;">Send TO MDRAFM</h5>
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
    <?php include('common_script.php') ?>

</body>

</html>

<script type="text/javascript">


$('#add_session').on('click', function() {
    let t_date = $('#t_date').val();

    var cur_dt = new Date();
    var act_date = new Date(t_date);
    // console.log(act_date);
    // console.log(cur_dt);
    if (t_date == 0) {
        // $('#t_date_error').html('Please select a date');
        $('#t_date_error').show();

    } else {
        $('#t_date_error').hide();
        $('#termModal').modal('show');

        $('#period_type').on('change', function() {
            let period = $('#period_type').val();

            if (period == '2') {
                $('#break_fld').show();
            } else {
                $('#break_fld').hide();
                $('#class_time').show();
            }
        })

        //break time code 

        $('#break').on('change', function() {
            var break_time = $('#break').val();
            let breakTime = "";
            let class_start_time = $('.class_start_time').val();

            // alert(break_time);
            $('#class_time').hide();

            switch (break_time) {
                case "0":
                    $('#class_time').show();
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
                    $('.class_end_time').val(res);

                }
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



    }

})

$('#t_date').on('change', function() {
    //alert(12);
    var t_date = $('#t_date').val();
    var id = <?php echo $_POST['id'] ?>;
    var prog_id = <?php echo $_POST['id'] ?>;
    var prog_name = `<?php echo $_POST['prog_name'] ?>`;

    $('#t_date_error').hide();
    $('#add_session').attr('disabled',false);


    $.ajax({

        type: "POST",
        url: "sponsored_time_table_template.php",

        data: {
            action: "time_table_date",
            id: id,
            prog_id: prog_id,
            prog_name: prog_name,
            session_date: t_date

        },
        success: function(res) {
            console.log(res);
            elm = res.split('^');
            console.log(elm[0]);
             if(elm[0]=='error'){
                $('#t_date_error').html(elm[1]);
                $('#t_date_error').show();
                $('#add_session').attr('disabled',true);
             }
             $('#t_date_error').hide();
            $('#time_table_div').html(res);
            $('#training_dt').val(t_date);

           


        }
    })

})




$('#training_dt').on('change', function() {
    var from_dt = <?php echo "'$from_dt'" ?>;
    var to_dt = <?php echo "'$to_dt'" ?>;
    var session_dt = $('#training_dt').val();
   
    var select_dt = $('#training_dt').val();
    if (select_dt < from_dt) {
        alert(`Please select date between ${from_dt} to ${to_dt}`);
        $('#training_dt').val('');
    }
    if (select_dt > to_dt) {
        alert(`Please select date between ${from_dt} to ${to_dt}`);
        $('#training_dt').val('');
    }


})



function convertTime(time) {
    var hours = Number(time.match(/^(\d+)/)[1]);
    var minutes = Number(time.match(/:(\d+)/)[1]);
    var AMPM = time.match(/\s(.*)$/)[1];
    if (AMPM === "PM" && hours < 12) hours = hours + 12;
    if (AMPM === "AM" && hours === 12) hours = hours - 12;
    var sHours = hours.toString();
    var sMinutes = minutes.toString();
    if (hours < 10) sHours = "0" + sHours;
    if (minutes < 10) sMinutes = "0" + sMinutes;
    return (sHours + ":" + sMinutes);
}


function add(str, frm, tbl) {


    var update_id = $('#update_id').val();
    

    // console.log(faculty);
    $.ajax({
        type: "POST",
        url: "ajax_timetable.php",

        data: $('#' + frm).serialize() + '&' + $.param({
            
            'action': 'add_sponsored_table',
            'table': tbl,
            'update_id': update_id
        }),
        success: function(res) {
            console.log(res);
            let elm = res.split('#');
            console.log(elm);
            if (elm[2] == "success") {
                sessionStorage.message = str + ' ' + elm[1];
                sessionStorage.type = "success";
                location.reload();
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

function edit(id) {

    $.ajax({
        type: "POST",
        url: "short_time_table_template_edit.php",
       
        data: {
           
            table: "tbl_sponsored_time_table",
            edit_id: id

        },
        success: function(res) {
            console.log(res);
            
                    $('#time_table_div').html(res);
                    $('#save').html('Update');
                    $('#save').attr('id', 'update');
                    $('#termModal').modal('show');

        }
    })
}



async function getData(sub_id, paper) {

    const result = await $.ajax({
        type: "POST",
        url: "ajax_edit_master.php",

        data: {
            mjr_id: sub_id,
            paper_id: paper,
            table: "tbl_mjr_subject_master",
            action: "select_mjr_subject"
        }
    });
    return result;
}

function cnfBox(id) {
    //alert(id);
    $('#m_footer').empty();
    var html =
        `<input type="button" class="btn btn-danger btn-dlt" value="Delete" onclick="delete_record(${id},'tbl_sponsored_time_table')" />`;
    $('#m_footer').append(html);
    $('#cnfModal').modal('show');
}

function delete_record(id, tbl) {

    $.ajax({
        type: "POST",
        url: "ajax_master.php",
        data: {

            action: "delete",
            id: id,
            table: tbl
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

function send_record(id, tbl) {

    $.ajax({
        type: "POST",
        url: "ajax_master.php",
        data: {

            action: "send",
            id: id,
            table: tbl
        },
        success: function(res) {
            console.log(res);
            if (res == "success") {
                sessionStorage.message = "Send to MDRAFM Successfully";
                sessionStorage.type = "success";
                location.reload();
            }
        }
    })
}
</script>