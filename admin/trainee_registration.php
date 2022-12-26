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

               <div class="row">
                    <div class="col-md-12">

                        <div class="card">
                           
                            <div class="card-body">
                                <div id="term2" class=" table table-responsive table-striped table-hover">
                                  
                                    <table class=" term table" id="tableid" style="width: 65%;margin: 0px auto;">
                                        <thead class="" style="background: #315682;color:#fff;font-size: 11px;">

                                            <th style="">Sl No</th>
                                            <th style="text-align:center;"> Program Name</th>
                                            <th style="text-align:center;">Start Date </th>
                                            <th style="text-align:center;">End Date </th>
                                            <th style="text-align:center;width: 10rem;"> </th>
                                        </thead>
                                        <tbody>
                                            <?php 
                               
                           
                               $count = 0;
                               $sql = "SELECT id,prg_name,trng_type,start_date,end_date  FROM `tbl_short_program_master` WHERE mdrafm_status = 0 AND dept_email = '".$_SESSION['username']."' 
                                       UNION 
                                       SELECT id,prg_name,trng_type,start_date,end_date  FROM `tbl_short_program_master` WHERE mdrafm_status = 0 AND dept_email = '".$_SESSION['username']."' ";
                               $db->select_sql($sql);
                              // print_r( $db->getResult());
                               foreach($db->getResult() as $row){
                                   //print_r($row);
                                   $count++;
                                  
                                   ?>
                                            <tr>
                                               
                                                <td><?php echo $count; ?></td>
                                                <td><?php echo $row['prg_name'] ?></td>
                                                
                                                <td style="text-align:center;"><?php echo date('d-m-Y', strtotime($row['start_date'])) ; ?> </td>
                                                <td style="text-align:center;"><?php echo date('d-m-Y', strtotime($row['end_date'])) ; ?> </td>
                                                
                                                <td>
                                              
                                                <input type="button" class="btn " style="background:#3292a2"
                                                        name="send" onclick="datapost('dept_trainee_registration.php',{id: <?php echo $row['id'] ?> ,trng_type:<?php echo $row['trng_type'] ?> })" value="Manage Trainee" />
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
const nameEl = document.querySelector('#name');
const emailE1 = document.querySelector('#email');
const phoneE1 = document.querySelector('#phone');


function addProgram() {
    let trng_type = $('#trng_type').val();
    // alert(trng_type); 
    if (trng_type == 5) {
        $('#shortTermModalSponsored').modal('show');
    } else {
        $('#shortTermModalInhouse').modal('show');
    }


}



function add(str, frm, tbl, updt_id) {
    // validate forms
    let isNameValid = checkTextField(nameEl),
        isEmailValid = checkEmail(emailE1),
        isPhoneValid = checkPhone(phoneE1);

    let isFormValid = isNameValid &&
        isEmailValid &&
        isPhoneValid;


    var update_id = $('#update_id').val();
    if (isFormValid) {
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


}

function edit(str, frm, tbl, updt_id) {
    // validate forms


    var update_id = $('#update_id').val();

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

function send_to_mdrafm(prog_id) {
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

function datapost(path, params, method) {
			//alert(path);
			method = method || "post"; // Set method to post by default if not specified.
			var form = document.createElement("form");
			form.setAttribute("method", method);
			form.setAttribute("action", path);
			for(var key in params) {
				if(params.hasOwnProperty(key)) {
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