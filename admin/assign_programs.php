<!DOCTYPE html>
<html lang="en">


<head>
    <?php 
    
    include('header_link.php');
    include('../config.php');
    include 'database.php';
    
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
                                        <h4 class="card-title"> Programs </h4>
                                    </div>
                                    <div class="col-md-6"></div>
                                    <!-- <div class="col-md-2">
                                    <input type="button" class="btn btn-primary" data-toggle="modal" data-target="#termModal"
                                     value="Add New">
                                    </div> -->
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
                                            <th style="text-align:center;">Start Date</th>
                                            <th style="text-align:center;">Status</th>
                                            <th style="text-align:center;">Details</th>
                                            <th style="text-align:center;">Action</th>
                                        </thead>
                                        <tbody>
                                            <?php 
                               
                               $db = new Database();
                               $count = 0;
                               $sql = "SELECT * FROM `tbl_short_program_master` WHERE course_co_officer = (SELECT id FROM `tbl_faculty_master` WHERE phone = '".$_SESSION['username']."')";
                               $db->select_sql($sql);
                              // print_r( $_SESSION);
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
                                                <td><?php echo $row['prg_name']; ?> </td>
                                                <td>
                                                    <?php 
                                                        
                                                        if($row['trng_type'] == 4){
                                                          echo "Inhouse Program";
                                                        }else{
                                                          echo "Sponsored Program"; 
                                                        }
                                                    ?>
                                                </td>


                                                <td>
                                                    <?php echo date("d-m-Y", strtotime($row['start_date'])) ?>
                                                </td>

                                                <td style="text-align:center;">
                                                    <?php
                                                 // echo $row['status'];
                                                    switch ($row['status']) {
                                                        case 'draft':
                                                            echo 'Draft';
                                                            break;
                                                        case 'pendingAtIncharge':
                                                        
                                                            echo 'Pending At Tranning Incharge';
                                                            break;
                                                        case 'approve':
                                                            echo 'Approved';
                                                            break;
                                                        case 'reject_by_incharge':
                                                            echo ' <p style="color:red" >Reject by Tranning Incharge</p>'; 
                                                            //echo '<br>';
                                                            echo '<b>Comment: </b>'.$row['remark'];
                                                        case 'pendingAtDirector':
                                                                echo 'Pending at Director';
                                                                break;
                                                            break;
                                                        
                                                    } 
                                                    
                                                    ?> </td>
                                                <td style="text-align:center;">
                                                   
                                                           <input type="button" class="btn " style="background:#3292a2"
                                                            name="send"
                                                            onclick="datapost('sponsored_program_detrail.php',{id: <?php echo $row['id'] ?>,trng_type: <?php echo $row['trng_type'] ?> })"
                                                            value="View Detail" />

                                                </td>

                                                <td style="text-align:center;">

                                                    <?php
                                                         switch ($row['status']) {
                                                             case 'draft':
                                                                 ?>
                                                    <a href="#" style="color:#4164b3" class="edit"
                                                        id="<?php echo $row['id']; ?>" onclick="edit(this.id)"><i
                                                            class="far fa-edit " style="font-size:1.5rem;"></i></a>
                                                    &nbsp;
                                                    <!-- <a href="#" style="color:#e50c0c" id="<?php echo $row['id']; ?>"
                                                        onclick="cnfBox(<?php echo $row['id']; ?>)"><i
                                                            class="far fa-trash-alt "
                                                            style="font-size:1.5rem;"></i></i></a><br> -->

                                                    <input type="button" class="btn " style="background:#3292a2"
                                                        name="send" id="<?php echo $row['id']; ?>"
                                                        onclick="sendToApprove(this.id,'tbl_short_program_master')"
                                                        value="Send For Approval" />

                                                    <?php
                                                                 break;
                                                                case 'pending':
                                                                    echo "Sent To Director For Approval";
                                                                    break;
                                                                case 'pendingAtIncharge':
                                                                    echo "Pending At Tranning Incharge";
                                                                    break;
                                                                case 'approve':
                                                                   ?>
                                                    <input type="text" class="btn" style="background:#3292a2"
                                                        data-toggle="modal"
                                                        data-target="#viewTraineeModal_<?php echo $row['id'] ?>"
                                                        value="View Trainee Detail" />


                                                    <!-- Modal -->
                                                    <div class="modal fade"
                                                        id="viewTraineeModal_<?php echo $row['id'] ?>"
                                                        data-backdrop="static" data-keyboard="false" tabindex="-1"
                                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content"
                                                                style="width:200%; margin:20px -150px">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="staticBackdropLabel">
                                                                        Trainee Detail</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="prog_div">
                                                                        <div id="term2"
                                                                            class=" table table-responsive table-striped table-hover"
                                                                            style="width:100%;margin:0px auto">
                                                                            <table class=" term table" id="tableid">
                                                                                <thead class=""
                                                                                    style="background: #315682;color:#fff;font-size: 11px;">


                                                                                    <th>Sl No</th>

                                                                                    <th>Name</th>
                                                                                    <th>HRMS Id</th>
                                                                                    <th>Designation</th>
                                                                                    <th>Place of Posting</th>
                                                                                    <th>Email</th>
                                                                                    <th style="text-align:center;">Phone
                                                                                    </th>
                                                                                    
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php


        $count = 0;


        $db->select('tbl_dept_trainee_registration', "*", null, "program_id =" . $row['id'], null, null);
                  
        // print_r( $db->getResult());
        foreach ($db->getResult() as $row) {
           // print_r($row);
            $count++
        ?>
                                                                                    <tr>

                                                                                        <td><?php echo $count; ?></td>

                                                                                        <td> <?php echo $row['name']  ?>
                                                                                        </td>
                                                                                        <td> <?php echo $row['hrms_id']  ?>
                                                                                        </td>
                                                                                        <td> <?php echo $row['designation']  ?>
                                                                                        </td>
                                                                                        <td> <?php echo $row['office_name']  ?>
                                                                                        </td>
                                                                                        <td> <?php echo $row['email']  ?>
                                                                                        </td>
                                                                                        <td style="text-align:center;">
                                                                                            <?php echo $row['phone']; ?>
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
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                                    break;
                                                                case 'reject_by_incharge':
                                                                    ?>
                                                    <a href="#" style="color:#4164b3" class="edit"
                                                        id="<?php echo $row['id']; ?>" onclick="edit(this.id)"><i
                                                            class="far fa-edit " style="font-size:1.5rem;"></i></a>

                                                    <input type="text" class="btn btn-info btn-sm "
                                                        style="background:#843c26;" name="send"
                                                        id="<?php echo $row['id']; ?>"
                                                        onclick="sendToApprove(this.id,'tbl_short_program_master')"
                                                        value="Send For Approval" />
                                                    <?php
                                                                    break;
                                                             default:
                                                                 # code...
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
                        <h5 class="modal-title" id="m_title" style="text-align:center;">Delete Program</h5>
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
function addProgram() {
    let trng_type = $('#trng_type').val();
    // alert(trng_type); 
    if (trng_type == 5) {
        $('#shortTermModalSponsored').modal('show');
    } else {
        $('#shortTermModalInhouse').modal('show');
    }


}



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
            table: "tbl_short_program_master",
            edit_id: id

        },
        success: function(res) {
            console.log(res);
            res.map((data) => {

                    $('#update_id').val(data.id);

                    if (data.trng_type == 5) {
                        $('#shortTermModalSponsored').modal('show');

                        $('#dept_name').val(data.dept_name);
                        $('#dept_email').val(data.dept_email);
                        $('#hall_name').val(data.hall_name);
                        $('#email_sub').val(data.email_sub);
                        $('#email_content').val(data.email_content);
                    } else {
                        $('#shortTermModalInhouse').modal('show');
                    }

                    $('#prg_name').val(data.prg_name);
                    $('#start_date').val(data.start_date);
                    $('#end_date').val(data.end_date);
                    // $('#dt_publication').val(data.dt_publication);
                    // $('#dt_completion').val(data.dt_completion);


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
        `<input type="button" class="btn btn-danger btn-dlt" value="Delete" onclick="delete_record(${id},'tbl_short_program_master')" />`;
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

function sendToApprove(id, tbl) {
    if (confirm('Are you sure you want to Send this Program to Tranning Incharge For Approval')) {
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
                    sessionStorage.message = " Successfully Send to Tranning Incharge for Approval";
                    sessionStorage.type = "success";
                    location.reload();
                }
            }
        })
    } else {
        return false;
    }
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