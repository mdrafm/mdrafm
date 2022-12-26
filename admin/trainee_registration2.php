<!DOCTYPE html>
<html lang="en">


<head>
    <?php 
    
    include('header_link.php');
    include('../config.php');
    include 'database.php';
    $db = new Database();
    
    ?>
    <style type="text/css">
    #menu1 {
        padding: 20px;
        border-radius: 5px;
        background-color: #f2efef;
        box-shadow: rgb(0 0 0 / 2%) 0px 1px 3px 0px, rgb(27 31 35 / 15%) 0px 0px 0px 1p
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

                <div class="row" style="margin-top:10px">
                    <div class="card">

                        <div class="card-body">

                            <div id="menu1" class="container">
                                <h5 class="text-center">Add New Trainee For Nomination Purpose </h5><br>
                                <?php //print_r($_SESSION ) ?>
                                <?php 
                                    $porg_id = '';
                                    $trng_type = '';
                                    $mdrafm_status = 0;
                                    $db->select("tbl_short_program_master","id,trng_type,mdrafm_status",null,"dept_email = '".$_SESSION['username']."' ",null,null );
                                    foreach ($db->getResult() as $row) {
                                        $porg_id = $row['id'];
                                        $trng_type = $row['trng_type'];
                                        $mdrafm_status = $row['mdrafm_status'];
                                    }
                                   //echo $porg_id;
                                ?>
                                <form method="post" id="frm_newTranee">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong> Name</strong></label>
                                                <input type="text" class="form-control" name="name" id="name"
                                                    placeholder="Enter Name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong> HRMS Id</strong></label>
                                                <input type="text" class="form-control" name="hrms_id" id="hrms_id"
                                                    placeholder="Enter HRMS Id">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong>Designation</strong></label>
                                                <input type="text" class="form-control" name="designation"
                                                    id="designation" placeholder="Enter Designation">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong>Name of the Office</strong></label>
                                                <input type="text" class="form-control" name="office_name"
                                                    id="office_name" placeholder="Name of the Office">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong> Email</strong></label>
                                                <input type="email" class="form-control" name="email" id="email"
                                                    placeholder=" Enter Email" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong> Phone</strong></label>
                                                <input type="text" class="form-control" name="phone" id="phone"
                                                    placeholder=" Enter Phone Number" required> 
                                            </div>
                                        </div>
                                    </div>



                                    <!-- <input type="hidden" id="update_id"> -->
                                    <input type="hidden" name="program_id" value="<?php echo $porg_id; ?>" />
                                    <input type="hidden" name="trng_type" value="<?php echo $trng_type; ?>" />
                                        
                                </form>
                                <div class="d-flex justify-content-center ">
                                    <button type="submit" class="btn btn-primary" name="submit" value="Save" id="save"
                                        onclick="add('new tranee','frm_newTranee','tbl_dept_trainee_registration')">Save</button>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div id="alert_msg" class="alert alert-success">added successfully</div>
                    </div>
                    <div class="col-md-6">

                    </div>
                    <div class="col-md-2">

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4 class="card-title">Trainee List </h4>
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
                                    <table class=" term table" id="tableid">
                                        <thead class="" style="background: #315682;color:#fff;font-size: 11px;">


                                            <th>Sl No</th>

                                            <th>Name</th>
                                            <th>HRMS Id</th>
                                            <th>Designation</th>
                                            <th>Place of Posting</th>
                                            <th>Email</th>
                                            <th style="text-align:center;">Phone</th>
                                            <th style="text-align:center;width: 8rem;">Action</th>
                                        </thead>
                                        <tbody>
                                            <?php


        $count = 0;


        $db->select('tbl_dept_trainee_registration', "*", null, "program_id =" . $porg_id, null, null);
                  
        // print_r( $db->getResult());
        foreach ($db->getResult() as $row) {
           // print_r($row);
            $count++
        ?>
                                            <tr>

                                                <td><?php echo $count; ?></td>

                                                <td> <?php echo $row['name']  ?></td>
                                                <td> <?php echo $row['hrms_id']  ?></td>
                                                <td> <?php echo $row['designation']  ?></td>
                                                <td> <?php echo $row['office_name']  ?></td>
                                                <td> <?php echo $row['email']  ?></td>
                                                <td style="text-align:center;"><?php echo $row['phone']; ?> </td>


                                                <td style="text-align:center;">
                                                  <?php
                                                   
                                                     if($mdrafm_status == 0){
                                                         ?>
                                                           <a href="#" data-toggle="modal"
                                                        data-target="#detailsModal_<?php echo $row['id']; ?>"
                                                        style="color:#4164b3 ;">
                                                        <i class="far fa-edit " style="font-size:1.5rem;"></i>
                                                    </a>

                                                    &nbsp;
                                                    <a href="#" style="color:#e50c0c"
                                                        id="<?php echo $row['id']; ?>"
                                                        onclick="cnfBox(<?php echo $row['id']; ?>)"><i
                                                            class="far fa-trash-alt "
                                                            style="font-size:1.5rem;"></i></i>
                                                    </a><br>
                                                         <?php
                                                     }
                                                  
                                                  ?>
                                                    

                                                    <!--Tranee Detail Modal -->

                                                    <div id="detailsModal_<?php echo $row['id']; ?>" class="modal fade">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content" style="width:150%">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="m_title"
                                                                        style="text-align:center;">Edit Trainee details
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal"
                                                                        aria-hidden="true">&times;</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="post" id="frm_newTranee_update_<?php echo $row['id']; ?>"
                                                                        style="width:90%">


                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label><strong>
                                                                                            Name</strong></label>
                                                                                    <input type="text"
                                                                                        class="form-control" name="name"
                                                                                        id="name"
                                                                                        placeholder="Enter Name"
                                                                                        value="<?php echo $row['name']; ?>" />
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label><strong> HRMS
                                                                                            Id</strong></label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        name="hrms_id" id="hrms_id"
                                                                                        placeholder="Enter HRMS Id"
                                                                                        value="<?php echo $row['hrms_id']; ?>">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label><strong>Designation</strong></label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        name="designation"
                                                                                        id="designation"
                                                                                        placeholder="Enter Designation"
                                                                                        value="<?php echo $row['designation']; ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label><strong>Name of the
                                                                                            Office</strong></label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        name="office_name"
                                                                                        id="office_name"
                                                                                        placeholder="Enter Name of the Office"
                                                                                        value="<?php echo $row['office_name']; ?>">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label><strong>
                                                                                            Email</strong></label>
                                                                                    <input type="email"
                                                                                        class="form-control"
                                                                                        name="email" id="email"
                                                                                        placeholder=" Enter Email"
                                                                                        value="<?php echo $row['email']; ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label><strong>
                                                                                            Phone</strong></label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        name="phone" id="phone"
                                                                                        placeholder=" Enter Phone Number"
                                                                                        value="<?php echo $row['phone']; ?>">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <input type="hidden"  id="update_id" value="" />
                                                                      
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer" id="m_footer">
                                                                    <input type="button" class="btn btn-default"
                                                                        data-dismiss="modal" value="Cancel">
                                                                    <button type="submit" class="btn btn-primary"
                                                                        name="submit" value="Save" id="save"
                                                                        onclick="add('new tranee','frm_newTranee_update_<?php echo $row['id']; ?>','tbl_dept_trainee_registration',<?php echo $row['id']; ?>)">Update</button>
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
                                <?php 
                                  if($mdrafm_status == 0){
                                    ?>
                                      <input type="button" class="btn btn-success" onclick="send_to_mdrafm(<?php echo $porg_id ?>)"  name="submit" value="Send to MDRAFM" />
                                    <?php
                                  }else{
                                    ?>
                                       <input type="button" class="btn btn-info" value="Already Send to MDRAFM" disabled />
                                    <?php
                                  }
                                ?>

                               
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
                    <div class="modal-footer" id="m_footer2">
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



function add(str, frm, tbl,updt_id) {


    var update_id = $('#update_id').val();
    console.log(frm);
    $.ajax({
        type: "POST",
        url: "ajax_master.php",

        data: $('#' + frm).serialize() + '&' + $.param({
            'action': 'add',
            'table': tbl,
            'update_id': updt_id
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



function cnfBox(id) {
    //alert(id);
    $('#m_footer2').empty();
    var html =
        `<input type="button" class="btn btn-danger btn-dlt" value="Delete" onclick="delete_record(${id},'tbl_dept_trainee_registration')" />`;
    $('#m_footer2').append(html);
    $('#cnfModal').modal('show');
}

function delete_record(id, tbl) {

    $.ajax({
        type: "POST",
        url: "ajax_master.php",
        data: {

            action: "remove",
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

function send_to_mdrafm(prog_id){
    let tbl = "tbl_short_program_master";
    $.ajax({
            type: "POST",
            url: "ajax_master.php",
            data: {

                action: "send_sponsored_program_mdrafm",
                prog_id: prog_id,
                table: tbl
            },
            success: function(res) {
                console.log(res);
                let elm = res.split('#');
                if (elm[0] == "success") {
                    sessionStorage.message = " Successfully Send to MDRAFM";
                    sessionStorage.type = "success";
                    location.reload();
                }
            }
        })
}
</script>