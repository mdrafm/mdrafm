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
                                        <h4 class="card-title">Medium Program List</h4>
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
                               $count = 0;
                               //$db->select('tbl_program_master',"*",null,null,null,null);
                               $sql = "SELECT p.id,p.prg_name,t.type,p.provisonal_Sdate,p.provisonal_Edate,p.dt_publication,p.dt_completion,p.status 
                                            FROM `tbl_program_master` p JOIN `tbl_training_type` t 
                                            ON p.trng_type=t.id
                                            WHERE p.status != 'draft' AND p.trng_type = 3 ";
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
                                                        case 'reject':
                                                            echo 'Reject';
                                                            break;
                                                        case 'pending':
                                                            echo 'Pending';
                                                        default:
                                                            # code...
                                                            break;
                                                    }
                                                    ?>
                                                </td>
                                                <td style="text-align:center;">

                                                    <input type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#prgram_list_<?php echo $row['id'] ?>"
                                                        value="view">
                                                    <?php
                                                      if($row['status'] == 'approve'){
                                                          ?>
                                                    <input type="button" class="btn btn-warning" data-toggle="modal"
                                                        data-target="#change_co_director_<?php echo $row['id'] ?>"
                                                        value="change Course Director">

                                                    <?php
                                                      }
                                                    ?>
                                                    <!-- change director modal -->
                                                    <div class="modal fade"
                                                        id="change_co_director_<?php echo $row['id'] ?>" tabindex="-1"
                                                        aria-labelledby="termModalLabel" aria-hidden="true">

                                                        <div class="modal-dialog">

                                                            <div class="modal-content"
                                                                style="width:130%; margin:20px -100px">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="termModalLabel">Change
                                                                        Course director</h5>

                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="div">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="row">
                                                                                    <div class="col-md-4 text-left">
                                                                                        <label for="">Program Name:
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="col-md-8 text-left">
                                                                                        <?php echo $row['prg_name']?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">


                                                                            </div>
                                                                        </div><br>
                                                                        <?php 
                                                                            
                                                                            $db->select("tbl_program_master","*",null,'id='.$row['id'],null,null);
                                                                            foreach($db->getResult() as $row1){
                                                                                //print_r($row1);
                                                                                if( $row1['status']=='approve' ){
                                                                                    ?>
                                                                        <div class="row">
                                                                            <div class="col-md-12">

                                                                                <div class="row">
                                                                                    <div class="col-md-4 text-left">
                                                                                        <label for="">Course
                                                                                            Director</label>


                                                                                    </div>
                                                                                    <div class="col-md-6 text-left">
                                                                                        <select
                                                                                            class="custom-select mr-sm-2"
                                                                                            name="course_director"
                                                                                           
                                                                                            id="course_director_update_<?php echo $row['id'] ?>"
                                                                                            style="height: calc(1em + 0.75rem + 2px);padding:0px">


                                                                                            <option value="0" selected>Select
                                                                                                Course Director
                                                                                            </option>
                                                                                            <?php 
                                                                  
                                                                   
                                                                                                        $db->select('tbl_faculty_master',"id,name",null,'role=1',null,null);
                                                                                                        // print_r( $db->getResult());
                                                                                                        foreach($db->getResult() as $row4){
                                                                                                            //print_r($row);
                                                                                                        
                                                                                                    ?>
                                                                                            <option
                                                                                                value="<?php echo $row4['id'] ?>"
                                                                                                <?php echo ($row4['id'] == $row1['course_director'])?'selected':'' ?>>
                                                                                                <?php echo $row4['name'] ?>
                                                                                            </option>

                                                                                            <?php 
                                                                                                        }
                                                                                                        ?>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                           
                                                                        </div><br>
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="row">
                                                                                    <div class="col-md-4 text-left">
                                                                                        <label for="">Asst Course
                                                                                            Director</label>

                                                                                    </div>
                                                                                    <div class="col-md-6 text-left">
                                                                                        <select
                                                                                            class="custom-select mr-sm-2"
                                                                                            name="asst_course_director"
                                                                                         
                                                                                            id="asst_course_director_update_<?php echo $row['id'] ?>"
                                                                                            style="height: calc(1em + 0.75rem + 2px);padding:0px">


                                                                                            <option selected value="0">Select
                                                                                               Asst Course Director
                                                                                            </option>
                                                                                            <?php 
                                                                  
                                                                   
                                                                                                        $db->select('tbl_faculty_master',"id,name",null,'role=1',null,null);
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
                                                                        <div class="row mt-2">
                                                                            <div class="col-md-12">

                                                                                <div class="row">
                                                                                    <div class="col-md-4 text-left">
                                                                                        <label for="">Provisonal
                                                                                            Start Date:
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="col-md-8 text-left">
                                                                                        <?php echo date("d-m-Y", strtotime($row1['provisonal_Sdate']))  ?>

                                                                                    </div>
                                                                                </div>

                                                                            </div>


                                                                        </div>
                                                                        <div class="row mt-2">
                                                                            <div class="col-md-12">
                                                                                <div class="row">
                                                                                    <div class="col-md-4 text-left">
                                                                                        <label for="">Provisonal End
                                                                                            Date:
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="col-md-8 text-left">
                                                                                        <?php echo date("d-m-Y", strtotime($row1['provisonal_Edate']))  ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <?php
                                                                                }
                                                                                
                                                                            }
                                                                            ?>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-primary"
                                                                        onclick="change_co_director('<?php echo $row['id'] ?>')">Update</button>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="prgram_list_<?php echo $row['id'] ?>"
                                                        tabindex="-1" aria-labelledby="termModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content"
                                                                style="width:130%; margin:20px -100px">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="termModalLabel"> Medium
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
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="row">
                                                                                        <div class="col-md-4 text-left">
                                                                                            <label for="">Program Name:
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="col-md-8 text-left">
                                                                                            <?php echo $row['prg_name']?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            </div><br>
                                                                            <?php 
                                                                            
                                                                            $db->select("tbl_program_master","*",null,'id='.$row['id'],null,null);
                                                                            foreach($db->getResult() as $row1){
                                                                                //print_r($row1);
                                                                                if( $row1['status']=='approve' ){
                                                                                    ?>
                                                                            <div class="row">
                                                                                <div class="col-md-12">

                                                                                    <div class="row">
                                                                                        <div class="col-md-4 text-left">
                                                                                            <label for="">Course
                                                                                                Director</label>

                                                                                        </div>
                                                                                        <div class="col-md-8 text-left">
                                                                                            <?php
                                                                                               $db->select('tbl_faculty_master',"name",null,'id='.$row1['course_director'],null,null);
                                                                                               // print_r( $db->getResult());
                                                                                               foreach($db->getResult() as $row2){
                                                                                                   echo $row2['name'];
                                                                                               }
                                                                                            ?>

                                                                                        </div>
                                                                                    </div>

                                                                                </div>


                                                                            </div><br>
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="row">
                                                                                        <div class="col-md-4 text-left">
                                                                                            <label for="">Asst Course
                                                                                                Director</label>

                                                                                        </div>
                                                                                        <div class="col-md-8 text-left">
                                                                                            <?php
                                                                                               $db->select('tbl_faculty_master',"name",null,'id='.$row1['asst_course_director'],null,null);
                                                                                               // print_r( $db->getResult());
                                                                                               foreach($db->getResult() as $row2){
                                                                                                   echo $row2['name'];
                                                                                               }
                                                                                            ?>

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div> <br>
                                                                            <div class="row">
                                                                                <div class="col-md-12">

                                                                                    <div class="row">
                                                                                        <div class="col-md-4 text-left">
                                                                                            <label for="">Provisonal
                                                                                                Start Date:
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="col-md-8 text-left">
                                                                                            <?php echo date("d-m-Y", strtotime($row1['provisonal_Sdate']))  ?>

                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                                <div class="col-md-12 mt-2">
                                                                                    <div class="row">
                                                                                        <div class="col-md-4 text-left">
                                                                                            <label for="">Provisonal End
                                                                                                Date:
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="col-md-8 text-left">
                                                                                            <?php echo date("d-m-Y", strtotime($row1['provisonal_Edate']))  ?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            </div>


                                                                            <?php
                                                                                }else{
                                                                                    ?>
                                                                            <div class="row">
                                                                                <div class="col-md-6">

                                                                                    <div class="row">
                                                                                        <div class="col-md-4 text-left">
                                                                                            <label for="">Course
                                                                                                Director
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="col-md-8 text-left">
                                                                                            <select
                                                                                                class="custom-select mr-sm-2"
                                                                                                name="course_director"
                                                                                                id="course_director"
                                                                                                style="height: calc(1em + 0.75rem + 2px);padding:0px">


                                                                                                <option selected>
                                                                                                    Course Director
                                                                                                </option>
                                                                                                <?php 
                                                                  
                                                                   
                                                                                                        $db->select('tbl_faculty_master',"id,name",null,'role=1',null,null);
                                                                                                        // print_r( $db->getResult());
                                                                                                        foreach($db->getResult() as $row1){
                                                                                                            //print_r($row);
                                                                                                        
                                                                                                    ?>
                                                                                                <option
                                                                                                    value="<?php echo $row1['id'] ?>">
                                                                                                    <?php echo $row1['name'] ?>
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
                                                                                        <div class="col-md-4 text-left">
                                                                                            <label for=""> Assistant
                                                                                                Course
                                                                                                Director
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="col-md-8 text-left">
                                                                                            <select
                                                                                                class="custom-select mr-sm-2"
                                                                                                name="asst_course_director"
                                                                                                id="asst_course_director"
                                                                                                style="height: calc(1em + 0.75rem + 2px);padding:0px">


                                                                                                <option selected>
                                                                                                    Assistant
                                                                                                    Course Director
                                                                                                </option>
                                                                                                <?php 
                                                                  
                                                                   
                                                                                                        $db->select('tbl_faculty_master',"id,name",null,'role=1',null,null);
                                                                                                        // print_r( $db->getResult());
                                                                                                        foreach($db->getResult() as $row1){
                                                                                                            //print_r($row);
                                                                                                        
                                                                                                    ?>
                                                                                                <option
                                                                                                    value="<?php echo $row1['id'] ?>">
                                                                                                    <?php echo $row1['name'] ?>
                                                                                                </option>

                                                                                                <?php 
                                                                                                        }
                                                                                                        ?>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

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



                                                                            <?php
                                                                                }
                                                                                
                                                                            }
                                                                            ?>






                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <?php
                                                                      switch ($row['status']) {
                                                                          case 'approve':
                                                                            ?>
                                                                    <button type="button" class="btn btn-info"> Already
                                                                        Approved</button>
                                                                    <?php
                                                                              break;
                                                                          case 'pendingAtDirector':
                                                                            ?>
                                                                    <button type="button" class="btn btn-info"
                                                                        onclick="approve(<?php echo $row['id'] ?>,'Approve')">Approve</button>

                                                                    <button type="button" class="btn btn-danger ml-2"
                                                                        onclick="reject(<?php echo $row['id'] ?>,'Reject')">Reject</button>

                                                                    <?php
                                                                            break;
                                                                            case 'rejectedByDirector':
                                                                              ?>
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
$('#asst_course_director').on('change', function() {
    var course_director = $('#course_director').val();
    var asst_course_director = $('#asst_course_director').val();

    if (course_director == asst_course_director) {
        alert("Assistant Course Director & Course Director can't be same..")
        $('#asst_course_director').val('Assistant Course Director');
    }
})

function approve(id, title) {

    var course_director = $('#course_director').val();
    var asst_course_director = $('#asst_course_director').val();

    $('#m_body').hide();
    $('#m_footer').html('');


    $('#m_title').html(`${title} Program`);
    $('.wrn_msg').html(`Hello Sir, Are you sure you want to ${title} this Record?`);
    var html =
        `<input type="button" class="btn btn-success btn-dlt" value="Approve" 
         onclick="approve_record(${id},${course_director},${asst_course_director},'tbl_program_master')" />`;
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

function approve_record(id, course_director, asst_course_director, tbl) {

    var provisonal_Sdate = $('#provisonal_Start_date').val();
    var provisonal_Edate = $('#provisonal_Edate').val();

    $.ajax({
        type: "POST",
        url: "ajax_master.php",
        data: {

            action: "approve_program",
            id: id,
            course_director: course_director,
            asst_course_director: asst_course_director,
            provisonal_Sdate: provisonal_Sdate,
            provisonal_Edate: provisonal_Edate,

            table: tbl
        },
        success: function(res) {
            console.log(res);
            if (res == "success") {
                sessionStorage.message = "Program Approve successfully";
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

            action: "reject_program",
            id: id,
            msg: msg,
            table: tbl
        },
        success: function(res) {
            console.log(res);
            if (res == "success") {
                sessionStorage.message = "Program Rejected successfully";
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

function change_co_director(id) {
    let co_director = $(`#course_director_update_${id}`).val();
    let asst_co_director = $(`#asst_course_director_update_${id}`).val();

     console.log(asst_co_director,co_director);
    $.ajax({
        type: "POST",
        url: "ajax_master.php",
        data: {

            action: "change_co_director",
            program_id: id,
            co_director_id: co_director,
            asst_co_director:asst_co_director
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