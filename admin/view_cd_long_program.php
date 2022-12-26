<!DOCTYPE html>
<html lang="en">


<head>
    <?php 
    
    include('header_link.php');
    include('../config.php');
    include 'database.php';
   
    ?>
    <style>
    .card label {
        font-size: 1rem;
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
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4 class="card-title">Program List</h4>
                                        
                                    </div>

                                </div>


                            </div>
                            <div class="card-body">
                                <div id="term2" class=" table table-responsive table-striped table-hover"
                                    style="width:100%;margin:0px auto">
                                    <table class=" term table">
                                        <thead class="" style="background: #315682;color:#fff;font-size: 11px;">

                                            <th style="width:50px;">Sl No</th>
                                            <th style="text-align:center;">Programm Name</th>
                                            <th style="text-align:center;">Tranning Type</th>
                                            <th style="text-align:center;">Provisanal Start Date</th>
                                            <th style="text-align:center;">Status</th>
                                            <th style="text-align:center;">Action</th>

                                        </thead>
                                        <tbody>
                                            <?php 
                               
                               $db = new Database();
                             
                                           
                                 $db->select('tbl_faculty_master','id,name',null,'phone='.$_SESSION['username'],null,null);
                                 foreach($db->getResult() as $row1){
                                     $faculty_id = $row1['id'];
                                 }
                                
                                 $roll_id = explode(',',$_SESSION['roll_id']);
                                 foreach($roll_id as $roll){
                                    switch ($roll) {
                                        case '8':
                                             $cd_sql = " AND p.course_director =".$faculty_id;
                                            break;
                                        case '13':
                                            $cd_sql = " AND p.asst_course_director =".$faculty_id;
                                            break;
                                        default:
                                            # code...
                                            break;
                                    }
                                 }
                               $count = 0;
                               //$db->select('tbl_program_master',"*",null,null,null,null);
                               $sql = "SELECT p.id,p.prg_name,t.id as trng_id,t.type,p.provisonal_Sdate,p.provisonal_Edate,p.dt_publication,p.dt_completion,p.status,p.course_director,p.asst_course_director 
                                            FROM `tbl_program_master` p JOIN `tbl_training_type` t 
                                            ON p.trng_type=t.id
                                            WHERE p.status != 'draft'  AND ( p.trng_type = 1 OR p.trng_type = 2 )  ".$cd_sql;
                                $db->select_sql($sql);             
                              // print_r( $db->getResult());
                               foreach($db->getResult() as $row){
                                    //print_r($row); 
                                   $tbl = "";
                                //    if($row['trng_type']==1){
                                //        $tbl = 'tbl_sylabus_master';
                                //    }
                                   $count++
                                   ?>
                                            <tr>
                                                <td><?php echo $count; ?></td>
                                                <td style="text-align:center;"><?php echo $row['prg_name']; ?> </td>
                                                <td style="text-align:center;"><?php echo $row['type']; ?> </td>
                                                <td style="text-align:center;">
                                                    <?php echo date("d/m/Y", strtotime($row['provisonal_Sdate'])) ?>
                                                </td>
                                                <td style="text-align:center;">
                                                    <?php 
                                                   
                                                    switch ($row['status']) {
                                                        case 'approve':
                                                            echo 'Approve';
                                                            break;
                                                        case 'pendingAtDirector':
                                                            echo 'Pending at Director';
                                                            break;
                                                        case 'reject_by_incharge':
                                                            echo 'Rejected';
                                                            break;
                                                        case 'pendingAtIncharge':
                                                            echo 'Pending';
                                                            break;
                                                       
                                                            break;
                                                        default:
                                                            # code...
                                                            break;
                                                    }
                                                    ?>
                                                </td>
                                                <td style="text-align:center;">
  
                                                    <!-- <input type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#prgram_list_<?php echo $row['id'] ?>"
                                                        value="view"> -->
                                                        <input type="button" style="background: #bb1b09;border: 0;
                                                                                padding: 5px;
                                                                                border-radius: 3px;
                                                                                color: #fff;"
                                                                data-toggle="modal"  data-target="#prgram_list_<?php echo $row['id'] ?>"
                                                              value="view"><br>
                                                    <?php
                                                      if($row['status']=='approve'){
                                                         $db->select('tbl_new_recruite','*',null,"mdrafm_status = 1 AND program_id =".$row['id'],null,null);
                                                         $res1 = $db->getResult();
                                                         if($res1){
                                                            
                                                                ?>
                                                                   <input type="button"  style="background: rgb(83 52 170);border: 0;
                                                                                        padding: 5px;
                                                                                        border-radius: 3px;
                                                                                        color: #fff;"
                                                        name="send" onclick="datapost('view_trainee_list.php',{id: <?php echo $row['id'] ?> ,trng_type:<?php echo $row['trng_id']  ?> })" value="Trainee List" /> 
                                                     
                                                                <?php
                                                             
                                                         }
                                                      }
                                                    ?>

                                                    <div class="modal fade" id="prgram_list_<?php echo $row['id'] ?>"
                                                        tabindex="-1" aria-labelledby="termModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content"
                                                                style="width:160%; margin:20px -100px">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="termModalLabel">
                                                                        Program
                                                                        Detail</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <?php //sprint_r($row); ?>
                                                                    <form>
                                                                        <div class="div">

                                                                            <?php 
                                                                            
                                                                           // $db->select("tbl_program_master","*",null,'id='.$row['id'],null,null);
                                                                           $sql = "SELECT p.id,p.prg_name,t.id as trng_type,t.type,s.descr,p.course_director,p.asst_course_director,p.provisonal_Sdate,p.provisonal_Edate,p.dt_publication,p.dt_completion,
                                                                                   p.status,p.course_director,p.asst_course_director
                                                                                    FROM `tbl_program_master` p JOIN `tbl_training_type` t 
                                                                                    ON p.trng_type=t.id
                                                                                    JOIN `tbl_sylabus_master` s 
                                                                                    ON p.syllabus_id=s.id
                                                                                    
                                                                                    WHERE p.id = '" . $row['id'] . "' ";
                                                                           $db->select_sql($sql);

                                                                            foreach($db->getResult() as $row1){
                                                                                //print_r($row1);
                                                                                if( $row1['status']=='pendingAtIncharge' ){
                                                                                    ?>
                                                                            <div style="width: 100%;  padding: 5px;">

                                                                                <div class="d-flex">
                                                                                    <p> Program Name :
                                                                                        <?php echo $row['prg_name']; ?>
                                                                                    </p></br>
                                                                                </div>
                                                                                <!-- <div
                                                                                    class="d-flex justify-content-between">

                                                                                    <p> Start Date
                                                                                        :<?php echo date("d/m/Y", strtotime($row['provisonal_Edate'])); ?>
                                                                                    </p>
                                                                                    <p> End
                                                                                        Date:<?php echo date("d/m/Y", strtotime($row['provisonal_Edate']));  ?>
                                                                                    </p>

                                                                                </div> -->
                                                                                <!-- <div class="d-flex justify-content-between">
                                                                                        
                                                                                         <p>   Course Director : <?php if ($row['course_director'] != 0) {
                                                                                                                    $db->select_one('tbl_faculty_master', 'name', $row['course_director']);
                                                                                                                    foreach ($db->getResult() as $faculty) {
                                                                                                                        echo $faculty['name'];
                                                                                                                    }
                                                                                                                } ?> </p>
                                                                                           
                                                                                        <p> Asst Course Director : <?php if ($row['asst_course_director'] != 0) {
                                                                                                                    $db->select_one('tbl_faculty_master', 'name', $row['asst_course_director']);
                                                                                                                    foreach ($db->getResult() as $faculty) {
                                                                                                                        echo $faculty['name'];
                                                                                                                    }
                                                                                                                } ?></p>
                                                                                        </div> -->
                                                                                <div class="row">
                                                                                    <div class="col-md-6">

                                                                                        <div class="row">
                                                                                            <div
                                                                                                class="col-md-4 text-left">
                                                                                                <label for="">Provisonal
                                                                                                    Start Date:
                                                                                                </label>
                                                                                            </div>
                                                                                            <div
                                                                                                class="col-md-8 text-left">
                                                                                                <input type="date"
                                                                                                    class="form-control"
                                                                                                    name="provisonal_Start_date"
                                                                                                    id="provisonal_Start_date"
                                                                                                    value="<?php echo $row['provisonal_Sdate']?>">

                                                                                            </div>
                                                                                        </div>

                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="row">
                                                                                            <div
                                                                                                class="col-md-4 text-left">
                                                                                                <label for="">Provisonal
                                                                                                    End
                                                                                                    Date:
                                                                                                </label>
                                                                                            </div>
                                                                                            <div
                                                                                                class="col-md-8 text-left">
                                                                                                <input type="date"
                                                                                                    class="form-control"
                                                                                                    name="provisonal_Edate"
                                                                                                    id="provisonal_Edate"
                                                                                                    value="<?php echo $row['provisonal_Edate']?>">

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                </div><br>
                                                                                <div class="row"
                                                                                    style="display: <?php echo ($row1['trng_type'] == 2)?'none':'' ?> ">
                                                                                    <div class="col-md-6">

                                                                                        <div class="row">
                                                                                            <div
                                                                                                class="col-md-4 text-left">
                                                                                                <label for="">Date of
                                                                                                    Commencement for
                                                                                                    Self
                                                                                                    Registration
                                                                                                </label>
                                                                                            </div>
                                                                                            <div
                                                                                                class="col-md-8 text-left">
                                                                                                <input type="date"
                                                                                                    class="form-control"
                                                                                                    name="dt_publication"
                                                                                                    id="dt_publication"
                                                                                                    value="<?php echo $row['dt_publication']?>">

                                                                                            </div>
                                                                                        </div>

                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="row">
                                                                                            <div
                                                                                                class="col-md-4 text-left">
                                                                                                <label for="">Closing
                                                                                                    Date
                                                                                                    of Self Registration
                                                                                                </label>
                                                                                            </div>
                                                                                            <div
                                                                                                class="col-md-8 text-left">
                                                                                                <input type="date"
                                                                                                    class="form-control"
                                                                                                    name="dt_completion"
                                                                                                    id="dt_completion"
                                                                                                    value="<?php echo $row['dt_completion']?>">

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                </div><br>
                                                                                <div class="row">
                                                                                    <div class="col-md-6">

                                                                                        <div class="row">
                                                                                            <div
                                                                                                class="col-md-4 text-left">
                                                                                                <label for="">Course
                                                                                                    Director :
                                                                                                </label>
                                                                                            </div>
                                                                                            <div
                                                                                                class="col-md-8 text-left">
                                                                                                <select
                                                                                                    class="custom-select mr-sm-2"
                                                                                                    name="course_director"
                                                                                                    id="course_director_<?php echo $row['id'] ?>"
                                                                                                    style="height: calc(1em + 0.75rem + 2px);padding:0px"
                                                                                                    onchange="add_course_dir(<?php echo $row['id'] ?>,<?php echo $row['course_director'] ?>,8)">

                                                                                                    <option selected>
                                                                                                        Select
                                                                                                        Course Director
                                                                                                    </option>
                                                                                                    <?php 
                                                                  
                                                                   
                                                                                                        $db->select('tbl_faculty_master',"id,name",null,'role=1 AND status =1',null,null);
                                                                                                        // print_r( $db->getResult());
                                                                                                        foreach($db->getResult() as $row6){
                                                                                                            //print_r($row);
                                                                                                        
                                                                                                    ?>
                                                                                                    <option
                                                                                                        value="<?php echo $row6['id'] ?>"
                                                                                                        <?php echo ($row6['id'] == $row['course_director'])?'selected':'' ?>>
                                                                                                        <?php echo $row6['name'] ?>
                                                                                                    </option>

                                                                                                    <?php 
                                                                                                        }
                                                                                                        ?>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="row">
                                                                                            <div class="row">
                                                                                                <div
                                                                                                    class="col-md-4 text-left">
                                                                                                    <label for="">Asst
                                                                                                        Course
                                                                                                        Director</label>

                                                                                                </div>
                                                                                                <div class="col-md-8 ">

                                                                                                    <select
                                                                                                        class="custom-select mr-sm-2"
                                                                                                        name="asst_course_director"
                                                                                                        id="asst_course_director_<?php echo $row['id'] ?>"
                                                                                                        style="height: calc(1em + 0.75rem + 2px);padding:0px"
                                                                                                        onchange="add_asst_course_dir(<?php echo $row['id'] ?>,<?php echo $row['asst_course_director'] ?>,13)">

                                                                                                        <option selected
                                                                                                            value="0">
                                                                                                            Asst Course
                                                                                                            Director
                                                                                                        </option>
                                                                                                        <?php 
                                                                  
                                                                   
                                                                                                        $db->select('tbl_faculty_master',"id,name",null,'role=1 AND status =1',null,null);
                                                                                                        // print_r( $db->getResult());
                                                                                                        foreach($db->getResult() as $row5){
                                                                                                            //print_r($row);
                                                                                                        
                                                                                                    ?>
                                                                                                        <option
                                                                                                            value="<?php echo $row5['id'] ?>"
                                                                                                            <?php echo ($row5['id'] == $row1['asst_course_director'])?'selected':'' ?>>
                                                                                                            <?php echo $row5['name'] ?>
                                                                                                        </option>

                                                                                                        <?php 
                                                                                                        }
                                                                                                        ?>
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                </div><br>



                                                                                <div
                                                                                    style="clear:both;background-color: #ffb75b;">

                                                                                </div>

                                                                            </div>



                                                                            <?php
                                                                                }else{
                                                                                    ?>
                                                                            <div class="row">


                                                                            </div><br>
                                                                            <div class="row">
                                                                                <div class="col-md-6">

                                                                                    <div class="row">
                                                                                        <div class="col-md-4 text-left">
                                                                                            <label for="">Provisonal
                                                                                                Start Date:
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="col-md-8 text-left">
                                                                                            <input type="date"
                                                                                                class="form-control"
                                                                                                name="provisonal_Start_date"
                                                                                                id="provisonal_Start_date"
                                                                                                value="<?php echo $row['provisonal_Sdate']?>">

                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="row">
                                                                                        <div class="col-md-4 text-left">
                                                                                            <label for="">Provisonal End
                                                                                                Date:
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="col-md-8 text-left">
                                                                                            <input type="date"
                                                                                                class="form-control"
                                                                                                name="provisonal_Edate"
                                                                                                id="provisonal_Edate"
                                                                                                value="<?php echo $row['provisonal_Edate']?>">

                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                            <div class="row">
                                                                               <div class="col-md-6">
                                                                                    <div class="row">
                                                                                        <div class="col-md-4 text-left">
                                                                                            <label for="">Course Director:
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="col-md-8 text-left">
                                                                                            <?php if ($row['course_director'] != 0) {
                                                                                                                    $db->select_one('tbl_faculty_master', 'name', $row['course_director']);
                                                                                                                    foreach ($db->getResult() as $faculty) {
                                                                                                                        echo $faculty['name'];
                                                                                                                    }
                                                                                                                } ?>

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="row">
                                                                                        <div class="col-md-4 text-left">
                                                                                            <label for="">Asst Course Director:
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="col-md-8 text-left">
                                                                                        <?php if ($row['asst_course_director'] != 0) {
                                                                                                                    $db->select_one('tbl_faculty_master', 'name', $row['asst_course_director']);
                                                                                                                    foreach ($db->getResult() as $faculty) {
                                                                                                                        echo $faculty['name'];
                                                                                                                    }
                                                                                                                } ?>

                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                 
                                                                            </div>



                                                                            <?php
                                                                                }
                                                                                
                                                                            }
                                                                            ?>






                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <?php
                                                                      switch ($row['status']) {
                                                                          case 'pendingAtDirector':
                                                                            ?>
                                                                    <button type="button" class="btn btn-info"> Already
                                                                        Approved</button>
                                                                    <?php
                                                                              break;
                                                                          case 'pendingAtIncharge':
                                                                            ?>
                                                                    <button type="button" class="btn btn-info"
                                                                        onclick="approve(<?php echo $row['id'] ?>,'Send')">Send
                                                                        To Director</button>

                                                                    <button type="button" class="btn btn-danger ml-2"
                                                                        onclick="reject(<?php echo $row['id'] ?>,'Reject')">Reject</button>

                                                                    <?php
                                                                            break;
                                                                            case 'reject_by_incharge':
                                                                              ?>
                                                                    <div>
                                                                        <p><b> Reject Comment</b> :<span
                                                                                style="color:#6a0027 "><?php echo $row1['remark'] ?></span>
                                                                        </p>

                                                                    </div>
                                                                    <button type="button" class="btn btn-info">Already
                                                                        Rjected</button>

                                                                    <?php
                                                                          
                                                                      }
                                                                    
                                                                  ?>

                                                                </div>
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

    <?php include('common_script.php') ?>

</body>

</html>

<script type="text/javascript">
function approve(id, title) {



    $('#m_body').hide();
    $('#m_footer').html('');


    $('#m_title').html(`${title} Program`);
    $('.wrn_msg').html(`Hello Sir, Are you sure you want to ${title} this Record?`);
    var html =
        `<input type="button" class="btn btn-success btn-dlt" value="Approve" 
         onclick="approve_record(${id},'tbl_program_master')" />`;
    $('#m_footer').append(html);
    $('#cnfModal').modal('show');
}

function reject(id, title) {
    $('#m_footer').html('');

    $('#m_title').html(`${title} Program`);
    $('.wrn_msg').html(`Hello Sir,Please Write Remark For  ${title} this Record?`);
    var html =
        `<input type="button" class="btn btn-danger btn-dlt" value="Reject" onclick="reject_record(${id},'tbl_program_master')" />`;
    $('#m_body').show();
    $('#m_footer').append(html);
    $('#cnfModal').modal('show');
}

function approve_record(id, tbl) {

    var provisonal_Sdate = $('#provisonal_Start_date').val();
    var provisonal_Edate = $('#provisonal_Edate').val();


    $.ajax({
        type: "POST",
        url: "ajax_master.php",
        data: {

            action: "approve_program_by_incharge",
            id: id,
            provisonal_Sdate: provisonal_Sdate,
            provisonal_Edate: provisonal_Edate,
            table: tbl
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

function reject_record(id, tbl) {
    let msg = $('#reject_comment').val();
    $.ajax({
        type: "POST",
        url: "ajax_master.php",
        data: {

            action: "reject_program_by_incharge",
            id: id,
            msg: msg,
            table: tbl
        },
        success: function(res) {
            console.log(res);
            if (res == "success") {
                sessionStorage.message = "Record Reject successfully";
                sessionStorage.type = "success";
                location.reload();
            }
        }
    })
}

$('#term_id').on('change', function() {
    var term_id = $(this).val();
    // alert(term_id);

    $.ajax({
        type: "POST",
        url: "ajax_master.php",

        data: {
            term_id: term_id,
            table: "tbl_paper_master",
            action: "select"
        },
        success: function(res) {
            //console.log(res);
            $('#paper_id').html(res);
        }
    })

})

$('#trng_type').on('change', function() {
    var trng_type = $(this).val();
    // alert(term_id);
    var tbl;
    if (trng_type == 1) {
        tbl = "tbl_sylabus_master";
        $('#syllabus').show();
    } else if (trng_type == 2) {
        tbl = "tbl_mid_syllabus";
        $('#syllabus').show();
    } else {
        $('#syllabus').hide();
    }


    $.ajax({
        type: "POST",
        url: "ajax_master.php",

        data: {
            trng_type: trng_type,
            table: tbl,
            action: "select_syllabus"
        },
        success: function(res) {
            console.log(res);
            $('#syllabus_id').html(res);
        }
    })

})

function add(str, frm, tbl) {


    var update_id = $('#update_id').val();

    $.ajax({
        type: "POST",
        url: "ajax_master.php",

        data: $('#' + frm).serialize() + '&' + $.param({
            'action': 'add',
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
            table: "tbl_program_master",
            edit_id: id

        },
        success: function(res) {
            console.log(res);
            res.map((data) => {

                    $('#update_id').val(data.id);
                    $('#trng_type').val(data.trng_type);
                    $('#syllabus_id').val(data.syllabus_id);
                    $('#course_director').val(data.course_director);
                    $('#prg_name').val(data.prg_name);
                    $('#provisonal_Sdate').val(data.provisonal_Sdate);
                    $('#provisonal_Edate').val(data.provisonal_Edate);
                    $('#dt_publication').val(data.dt_publication);
                    $('#dt_completion').val(data.dt_completion);


                    $('#save').html('Update');
                    $('#save').attr('id', 'update');
                    $('#termModal').modal('show');
                }

            )

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

function add_course_dir(id, old_course_dir, roll) {

    let course_dir = $(`#course_director_${id}`).val();
    var action;
    //console.log(roll);

    if (old_course_dir == 0) {
        action = "add_course_dir";
    } else {
        action = "update_course_dir";
    }
    console.log(action);
    $.ajax({
        type: "POST",
        url: "ajax_master.php",
        data: {

            action: action,
            id: id,
            new_course_dir: course_dir,
            old_course_dir: old_course_dir,
            roll_id: roll,
            table: "tbl_program_master"
        },
        success: function(res) {
            console.log(res);
            // if (res == "success") {
            //     sessionStorage.message = "Email Content Updated successfully";
            //     sessionStorage.type = "success";
            //     location.reload();
            // }
        }
    })
}

function add_asst_course_dir(id, old_course_dir, roll) {

    let course_dir = $(`#asst_course_director_${id}`).val();
    var action;

    console.log(course_dir);

    if (old_course_dir == 0) {
        action = "add_asst_course_dir";
    } else {
        action = "update_asst_course_dir";
    }
    console.log(action);
    $.ajax({
        type: "POST",
        url: "ajax_master.php",
        data: {

            action: action,
            id: id,
            new_course_dir: course_dir,
            old_course_dir: old_course_dir,
            roll_id: roll,
            table: "tbl_program_master"

        },
        success: function(res) {
            console.log(res);
            // if (res == "success") {
            //     sessionStorage.message = "Email Content Updated successfully";
            //     sessionStorage.type = "success";
            //     location.reload();
            // }
        }
    })
}

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