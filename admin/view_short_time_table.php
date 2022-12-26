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
      $course_director = $_POST['course_director'];
      $asst_course_director = $_POST['asst_course_director'];

      print_r($_POST);
      
      $trng_type = $_POST['type'];
      $time_table ='';
    $program_table='';
     if( $trng_type == 1 || $trng_type == 2){
         $time_table = 'tbl_time_table';
        $program_table = 'tbl_program_master';
     }
     elseif($trng_type == 3 || $trng_type == 8){
                //  $time_table = 'tbl_inhouse_time_table';
             $program_table = 'tbl_mid_program_master';
     }
     elseif($trng_type == 4 || $trng_type == 5){
        //  $time_table = 'tbl_short_term_time_table';
             $program_table = 'tbl_short_program_master';
     }

     if($trng_type == 3 || $trng_type ==4){
      
        $time_table = "tbl_inhouse_time_table";
    }
    else if($trng_type == 5 || $trng_type ==8){
       
        $time_table = "tbl_sponsored_time_table.php";
    }

    if( $trng_type == 1 || $trng_type == 2){

        $db->select('tbl_program_master',"f.name,f.desig,p.provisonal_Sdate,p.provisonal_Edate"," p JOIN `tbl_faculty_master` f ON p.course_director = f.id","p.id=".$_POST['prog_id'],null,null);
        foreach($db->getResult() as $res){
          $coDir = $res['name'];
          $desig = $res['desig'];
          $asst_coDir = '';
          $asst_desig = '';
          $startDtae = $res['provisonal_Sdate'];
          $endDate = $res['provisonal_Edate'];
        }
    }else{
       
    //     $db->select($program_table,"f.name,f.desig,p.start_date,p.end_date"," p JOIN `tbl_faculty_master` f ON p.course_director = f.id","p.id=".$_POST['prog_id'],null,null);
    $db->select($program_table,"p.start_date,p.end_date,d.course_director,d.asst_course_director"," p JOIN `tbl_program_directors` d ON p.course_director = d.id","p.id=".$_POST['prog_id'],null,null);
      foreach($db->getResult() as $res){
       
                 $db->select('tbl_faculty_master','name,desig',null,'id='.$res['course_director'],null,null);
                 foreach($db->getResult() as $res_coDir){
                    $coDir =  $res_coDir['name']; 
                    $desig =  $res_coDir['desig']; 
                 }

                 $db->select('tbl_faculty_master','name,desig',null,'id='.$res['asst_course_director'],null,null);
                 foreach($db->getResult() as $res_asst_coDir){
                    $asst_coDir =  $res_asst_coDir['name']; 
                    $asst_desig =  $res_asst_coDir['desig']; 
                 }

       
        $startDtae = $res['start_date'];
        $endDate = $res['end_date'];
      }
    }
     
      

    ?>
    <!-- <link rel="stylesheet" href="assets/css/timepicker.min.css">
    <script src="assets/js/timepicker.min.js"></script> -->
    <!-- select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <style>
    /* .table tbody tr td a:hover{
       display: block;
    } */
    h5{
        font-weight:bold;
    }
    .note p{
        font-size: .8rem;
    }
    .note h5{
        font-size: 1rem
    }
    .note h3{
        margin-right: 10%;
    }
    </style>

</head>

<body class="user-profile">

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <div class="wrapper ">

        <?php //include('sidebar.php'); ?>

        <div class="main-panel" id="main-panel" style="width: 100%;">
            <?php include('navbar.php'); ?>

            <div class="panel-header panel-header-sm">


            </div>


            <div class="content">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header" style="font-size: 0.7rem;">
                                <h5 class="card-title text-center">Madhusudan Das Regional Academy of Financial
                                    Management,Bhubaneswar</h5>
                                <h5 class="text-center"> Time Table for <?php echo $_POST['prog_name'] .', '.$startDtae.' to '.$endDate ?> </h5>
                                <h5 class="text-center">Course Director - <?php echo $coDir.','.$desig ?> </h5>
                                <h5 class="text-center"> Assistant Course Director - <?php echo $asst_coDir.','.$asst_desig ?> </h5>
                                <?php
                                if($_POST['type'] == 1){
                                    ?>
                                     <h5 class="text-center"> <?php echo $_POST['tbl_name']  ?> &nbsp;(&nbsp; <?php echo date("d/m/Y", strtotime($_POST['from_dt'])).' - '.date("d/m/Y", strtotime($_POST['to_dt']))?> &nbsp;)
                                    <?php
                                }
                                ?>
                               
                                </h5>
                               
                            </div>
                            <div class="card-body">
                                <div>
                                    <table  class="table table-bordered" style="font-family: sans-serif; ">
                                      
                                            <tr>
                                                <th style="" scope="col">Sl No</th>
                                                <th style="text-align:center;" scope="col">Date</th>

                                                <?php  
                                               
                                                 $db->select($time_table,"MAX(session_no) as session",null," table_range_id = '".$_POST['id']."' AND trng_type =".$_POST['type'],null,null);
                                                   //print_r( $db->getResult());
                                                   foreach($db->getResult() as $seson){
                                                       
                                                        for($i=1 ; $i <= $seson['session'];$i++ ){
                                                            ?>
                                                            <th style="text-align:center;">
                                                                <?php 
                                                                 $db->select($time_table,"MAX(session_no) as session",null," table_range_id = '".$_POST['id']."'  AND trng_type =".$_POST['type'],null,null);
                                                               //echo $i ;
                                                               $db->select($time_table,"class_start_time,class_end_time",null,"session_no = '$i' GROUP BY session_no",null,null);
                                                               //print_r( $db->getResult());
                                                               switch ($i) {
                                                                   case '1':
                                                                      echo  $i.' st Session';
                                                                       break;

                                                                    case '2':
                                                                        echo 'Break';
                                                                        break;
                                                                    case '3':
                                                                        echo ($i-1).' nd Session';
                                                                        break;
                                                                    case '4':
                                                                        echo 'Break';
                                                                        break;
                                                                    case '5':
                                                                        echo ($i-2).'rd Session';
                                                                        break;
                                                                    case '6':
                                                                        echo 'Break';
                                                                        break;
                                                                    case '7':
                                                                        echo ($i-3).'th Session';
                                                                        break;
                                                                    case '8':
                                                                        echo ($i-3).'th Session';
                                                                        break;

                                                                   default:
                                                                       echo 'th Session';
                                                                       break;
                                                               }
                                                               
                                                               ?>

                                                   

                                                </th>

                                                <?php
                                                        }
                                                   }

                                            
                                            ?>
                                         </tr>
                                       
                                       
                                            <?php 
                               
                              
                                            $count = 0;
                                            $db->select($time_table,"DISTINCT training_dt",null,"  table_range_id = '".$_POST['id']."' AND trng_type =".$_POST['type'],null,null);
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
                                                    $db->select($time_table,"*",null," table_range_id = '".$_POST['id']."' AND training_dt='".$row['training_dt']."' ANd trng_type='".$_POST['type']."' ",null,null); 
                                                    //print_r( $db->getResult()); echo '<pre>';
                                                     foreach($db->getResult() as $res){
                                                        // print_r($res);exit;
                                                         ?>
                                                <td colspan = <?php echo $res['no_of_session'] ?> class="session" id="<?php echo $res['id']; ?>" style="vertical-align: baseline;line-height: 15px;">
                                                       <div>
                                                    <?php 
                                                            echo '<div>'.'Class time - '. $res['class_start_time'] .' - '. $res['class_end_time'].'</div>';
                                                            echo '<div style="margin-top: 10px;font-weight: 600;"> ';
                                                            if($res['trng_type'] == 1 || $res['trng_type'] == 2){
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
                                                                    $db->select_one('tbl_faculty_master',"name",$faculty);
                                                                    
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
                                                        }

                                                        // else if($res['trng_type'] == 2){
                                                        //     $db->select_one('tbl_mid_syllabus',"subject",$res['subject_id']);
                                                                
                                                        //     foreach($db->getResult() as $row4){
                                                        //         echo  $row4['subject'].'<br>';
                                                        //     }
                                                        // }
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

                                       
                                    </table>
                                </div>
                                <div class="note">
                                  <h4>Nota bene:</h4>
                                  <p>1. Adjustment of classes may be made with prior approval of the Director, MDRAFM, Bhubaneswar.<p>
                                  <p>2. Computer and Establishment Sections are to take necessary steps for smooth running of classes.<p>
                                  <p>3. Asst. Librarian is directed to remain present in the Library and facilitate the participants.	<p>
                                      <h3 style="float:right" >Director</h3><br>
                                      <h5>Memo No.______________ /M. dated_____________________</h5>
                                      <h5>Copy to the All Faculties / Guest Faculties / Sr. Stenographer /  All Probationers / Notice Board for information and necessary action.</h5>
                                      <h3 style="float:right" >Director</h3>
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
$('#faculty_id').select2();


$('#t_date').on('change', function() {
    //alert(12);
    var t_date = $('#t_date').val();
    var date = `${t_date}`;
    $('#training_dt').val(date);

})

$('#training_dt').on('change', function() {
    var from_dt = <?php echo "'$from_dt'" ?>;
    var to_dt = <?php echo "'$to_dt'" ?>;

    var select_dt = $('#training_dt').val();
    if (select_dt < from_dt) {
        alert(`Please select date between ${from_dt} to ${to_dt}`);
        $('#training_dt').val('');
    }
    if (select_dt > to_dt) {
        alert(`Please select date between ${from_dt} to ${to_dt}`);
        $('#training_dt').val('');
    }
    //console.log(select_dt);
})



$('input[name="faculty"]').click(function() {
    if ($(this).is(':checked')) {
        //alert($(this).val());
        let id = $(this).val();

        $.ajax({
            type: "POST",
            url: "ajax_master.php",

            data: {
                facult_id: id,
                table: "tbl_faculty_master",
                action: "select_faculty"
            },
            success: function(res) {
                console.log(res);
                $('#faculty_id').html(res);
            }
        })
    }
})
$('#paper_id').on('click', function() {
    var paper_id = $(this).val();
    // alert(term_id);

    $.ajax({
        type: "POST",
        url: "ajax_master.php",

        data: {
            paper_id: paper_id,
            table: "tbl_subject_master",
            action: "select_mjr_subject"
        },
        success: function(res) {
            // console.log(res);
            $('#mjr_subject_id').html(res);
        }
    })

})

$('#mjr_subject_id').on('change', function() {
    var subject_id = $(this).val();
    // alert(term_id);
    $('#topic_id').html('');
    $.ajax({
        type: "POST",
        url: "ajax_master.php",

        data: {
            mjr_subject_id: subject_id,
            table: "tbl_subject_master",
            action: "select_topic"
        },
        success: function(res) {
            //console.log(res);
            $('#topic_id').html(res);
        }
    })

})
$('#topic_id').on('change', function() {
    var topic_id = $(this).val();
    // alert(term_id);
    //$('#topic_id').html('');
    $.ajax({
        type: "POST",
        url: "ajax_master.php",

        data: {
            topic_id: topic_id,
            table: "tbl_subject_master",
            action: "select_subject"
        },
        success: function(res) {
            console.log(res);
            $('#subject_id').html(res);
        }
    })

})

function add(str, frm, tbl) {


    var update_id = $('#update_id').val();

    $.ajax({
        type: "POST",
        url: "ajax_master.php",

        data: $('#' + frm).serialize() + '&' + $.param({
            'action': 'add_table',
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
            }
        }
    })

}

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
                    $('#session_no').val(data.session_no);
                    $('#class_start_time').val(data.class_start_time);
                    $('#class_end_time').val(data.class_end_time);
                    $('#faculty_id').val(data.faculty_id);
                    $('#term_id').val(data.term_id);
                    $('#paper_id').val(data.paper_id);
                    $('#mjr_subject_id').val(data.mjr_subject_id);
                    $('#topic_id').val(data.topic_id);
                    $('#paper_covered').val(data.paper_covered);
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

                        $.ajax({

                            type: "POST",
                            url: "ajax_edit_master.php",

                            data: {
                                faculty_id: data.faculty_id,

                                table: "tbl_faculty_master",
                                action: "select_faculty"
                            },
                            success: function(res) {
                                console.log(res);
                                $('#faculty_id').html(res);
                            }
                        });

                        var mjr_sub = '';
                        $.ajax({
                            type: "POST",
                            url: "ajax_edit_master.php",

                            data: {
                                mjr_id: data.mjr_subject_id,
                                paper_id: paper,
                                table: "tbl_mjr_subject_master",
                                action: "select_mjr_subject"
                            },
                            success: function(res) {
                                //console.log(res);
                                $('#mjr_subject_id').html(res);
                                mjr_sub = $('#mjr_subject_id').val();
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
                                        //console.log(res);
                                        $('#topic_id').html(res);
                                        var topic_id = $('#topic_id').val();


                                        $.ajax({
                                            type: "POST",
                                            url: "ajax_edit_master.php",

                                            data: {
                                                topic_id: topic_id,
                                                sub_id: data.subject_id,
                                                table: "tbl_subject_master",
                                                action: "select_subject"
                                            },
                                            success: function(res) {

                                                $('#subject_id')
                                                    .html(
                                                        res);

                                            }
                                        });
                                    }
                                });
                            }
                        });
                    }

                    $('#save').html('Update');
                    $('#save').attr('id', 'update');
                    $('#termModal').modal('show');

                }

            )

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
        `<input type="button" class="btn btn-danger btn-dlt" value="Delete" onclick="delete_record(${id},'tbl_time_table')" />`;
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