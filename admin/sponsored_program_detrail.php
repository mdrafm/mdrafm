<!DOCTYPE html>
<html lang="en">


<head>
    <?php
    //header("Cache-Control: no cache");
    // session_cache_limiter("private_no_expire");
    include('header_link.php');
    include('../config.php');
    include 'database.php';
    //echo 123;
    $db = new Database();
    $prog_name = '';
    ?>

    <style type="text/css">
    #frm_newTranee {

        width: 60%;
        margin: 0 auto;
        border: 1px solid #cdcdcd;
        padding: 20px;
        border-radius: 10px;
        background-color: #f1fbfd;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
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


            <div class="content">


                <div class="row">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"> Program Detail</h4>

                            </div>
                            <div class="card-body">
                                <div id="detail" class="">
                                    <?php
                                    
                                    //echo $sql;
                                    
                                    $db->select(
                                        'tbl_short_program_master',
                                        "*",
                                        null,
                                        "id =" . $_POST['id'],
                                        null,
                                        null
                                    );
                                    ///print_r($db->getResult());
                                    foreach ($db->getResult() as $row) {
                                        $prog_name = $row['prg_name'];
                                       // print_r($row);
                                    ?>
                                    <div
                                        style="width: 100%; background-color: #42c19f2e; padding: 5px;border: 3px solid #2daab0;">

                                        <div style="width:33%;float:left;">
                                            Program Name : <?php echo $row['prg_name']; ?></br>
                                            Department Name : <?php echo $row['dept_name']; ?>
                                        </div>
                                        <div style="width:33%;float:left;">

                                            Start Date :<?php echo date("d/m/Y", strtotime($row['start_date'])); ?><br>
                                            End Date:<?php echo date("d/m/Y", strtotime($row['end_date']));  ?>
                                        </div>


                                        <div style="clear:both;background-color: #ffb75b;">
                                            Hall Name : <?php echo $row['hall_name']; ?>
                                        </div>

                                    </div>

                                    <?php
                                    }

                                    ?>



                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header">

                            </div>
                            <div class="card-body">
                                <!-- Nav pills -->
                                <ul class="nav nav-pills" role="tablist">

                                    <li class="nav-item">
                                        <a class="nav-link active " data-toggle="pill" href="#home">Trainee List</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#menu2">Action</a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#menu2">tab3</a>
                                    </li> -->
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">

                                    <div id="home" class="container  tab-pane active"><br>

                                        <div id="term2" class=" table table-responsive table-striped table-hover">
                                            <table class=" term table" id="tableid">
                                                <thead class="" style="background: #315682;color:#fff;font-size: 11px;">


                                                    <th>Sl No</th>

                                                    <th> Name</th>
                                                    <th> HRMS Id</th>
                                                    <th>Designation</th>
                                                    <th>Name of Office</th>
                                                    <th>Email</th>
                                                    <th style="text-align:center;">Phone</th>
                                                    <th style="text-align:center;width: 8rem;">Action</th>
                                                </thead>
                                                <tbody>
                                                    <?php


        $count = 0;


        $db->select('tbl_dept_trainee_registration', "t.id,p.prg_name,t.name,t.designation,t.hrms_id,t.office_name,t.email,t.phone,t.mdrafm_status", 
                  " t JOIN `tbl_short_program_master` p ON t.program_id = p.id", " p.mdrafm_status =1 AND t.program_id =" . $_POST['id'], null, null);
        // print_r( $db->getResult());
        foreach ($db->getResult() as $row) {
           //print_r($row);
            $count++
        ?>
                                                    <tr>

                                                        <td><?php echo $count; ?></td>

                                                        <td> <?php echo $row['name']  ?></td>
                                                        <td> <?php echo $row['hrms_id']  ?></td>
                                                        <td> <?php echo $row['designation']  ?></td>
                                                        <td> <?php echo $row['office_name']  ?></td>
                                                        <td> <?php echo $row['email']  ?></td>
                                                        <td style="text-align:center;"><?php echo $row['phone']; ?>
                                                        </td>


                                                        <td style="text-align:center;">
                                                            <?php
                                                               if($row['mdrafm_status']== 0){
                                                                ?>
                                                                  <a href="#" data-toggle="modal"
                                                                data-target="#detailsModal_<?php echo $row['id']; ?>"
                                                                style="color:#4164b3 ;">
                                                                <i class="far fa-edit " style="font-size:1.5rem;"></i>
                                                            </a>
                                                                <?php
                                                              }
                                                            
                                                            ?>
                                                           

                                                            &nbsp;
                                                            <?php
                                                              if($row['mdrafm_status']== 1){
                                                                ?>
                                                                  <button class="btn btn-info"  >Accepted</button>
                                                                <?php
                                                              }else{
                                                                ?>
                                                                  <button class="btn btn-primary" onclick="accept_trainee(<?php echo $row['id']; ?>)" >Accept</button>
                                                                <?php
                                                              }
                                                            
                                                            ?>
                                                           

                                                            <!--Tranee Detail Modal -->

                                                            <div id="detailsModal_<?php echo $row['id']; ?>"
                                                                class="modal fade">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content" style="width:150%">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="m_title"
                                                                                style="text-align:center;">Edit Trainee
                                                                                details</h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal"
                                                                                aria-hidden="true">&times;</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form method="post"
                                                                                id="frm_newTranee_update_<?php echo $row['id']; ?>"
                                                                                style="width:90%">


                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label><strong>
                                                                                                    Name</strong></label>
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                name="name" id="name"
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
                                                                                                name="hrms_id"
                                                                                                id="hrms_id"
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


                                                                            </form>
                                                                        </div>
                                                                        <div class="modal-footer" id="m_footer">
                                                                            <input type="button" class="btn btn-default"
                                                                                data-dismiss="modal" value="Cancel">
                                                                            <button type="submit"
                                                                                class="btn btn-primary" name="submit"
                                                                                value="Save" id="save"
                                                                                onclick="update('new tranee','frm_newTranee_update_<?php echo $row['id']; ?>','tbl_dept_trainee_registration',<?php echo $row['id']; ?>)">Update</button>
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
                                            <input type="button" class="btn btn-primary" name="send_email"
                                                id="send_email" style="display:none" value="Send Email" />
                                            <div class="loader">
                                                <img src="assets/img/loader.gif" alt="Loading"
                                                    style="width: 300px;height: 90px;float: right;" />
                                            </div>
                                        </div>

                                    </div>

                                    <div id="menu2" class="container tab-pane fade"><br>
                                        <div id="mid_trainee_list"
                                            class=" table table-responsive table-striped table-hover">
                                            <table class=" term table" id="tranee_tbl">
                                                <thead class="" style="background: #315682;color:#fff;font-size: 11px;">


                                                    <th>Sl No</th>

                                                    <th> Name</th>
                                                    <th>Designation</th>
                                                    <th>Name of the Office</th>
                                                    <th>Email</th>
                                                    <th style="text-align:center;">Phone</th>
                                                    <th style="text-align:center;">

                                                        <input class="form-check-input checkAll2" type="checkbox"
                                                            id="checkAll">
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Send All
                                                    </th>
                                                    <th></th>
                                                </thead>
                                                <tbody>
                                                    <?php

                                                    $count = 0;

                                                    $db->select(
                                                        'tbl_dept_trainee_registration',
                                                        "*",
                                                        null,
                                                        " mdrafm_status = 1 AND program_id =" . $_POST['id'],
                                                        null,
                                                        null
                                                    );
                                                    
                                                    foreach ($db->getResult() as $row) {
                                                        
                                                        $count++
                                                    ?>
                                                    <tr>

                                                        <td><?php echo $count; ?></td>

                                                        <td> <?php echo $row['name']  ?></td>
                                                        <td> <?php echo $row['designation']  ?></td>
                                                        <td> <?php echo $row['office_name']  ?></td>
                                                        <td> <?php echo $row['email']  ?></td>
                                                        <td style="text-align:center;"><?php echo $row['phone']; ?>
                                                        </td>
                                                        <td style="text-align:center;">
                                                            <div class="form-check form-check-inline">

                                                                <?php
                                                                  if($row['mail_status']== 1){
                                                                    echo "Mail Sent";
                                                                  }
                                                                  else{
                                                                    ?>
                                                                    <label class="form-check-label"
                                                                    for="inlineCheckbox1">Send Email</label>
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="sent" id="sent" value="1"
                                                                    <?php echo ($row['mail_status']== 1)?'checked':'' ?>
                                                                    style="opacity: 1;visibility: visible;">
                                                                    <?php
                                                                  }
                                                                
                                                                ?>
                                                                
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="hidden" name="tranee_id" id="tranee_id"
                                                                value="<?php echo $row['id']; ?>">
                                                        </td>

                                                    </tr>
                                                    <?php
                                                    }


                                                    ?>

                                                </tbody>
                                            </table>
                                            <input type="button" class="btn btn-primary email_btn" style="display:none" value="Send Email" 
                                                onclick="show_email_div()" />
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

    </div>

    </div>

    <!-- msgBox Modal Modal HTML -->
    <div id="emailModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content" style="width:130%; margin:120px -60px">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="m_title" style="text-align:center;">Email Login Credentials to
                            Trainee </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label> Subject : </label>
                            <input type="text" class="form-control col-sm-8" name="subject" id="subject"
                                placeholder="Enter subject">

                        </div>
                        <div class="form-group">
                            <label> Email Content : </label>
                            <textarea class="form-control" name="email_body" id="email_body" rows="5"
                                style="border: 1px solid black;max-height: 140px;"></textarea>
                        </div>
                        
                        <div class="loader">
                            <img src="assets/img/loader.gif" alt="Loading" style="width: 300px;height: 90px;" />
                        </div>
                    </div>
                    <div class="modal-footer" id="mailbtn">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="button" class="btn btn-primary" value="Send" onclick="send_mail()">

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- msgBox Modal Modal HTML -->


    <!-- msgBox Modal Modal HTML -->
    <div id="traineeDetailModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="m_title" style="text-align:center;">Trainee Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">

                        <div id="detail_body"></div>
                    </div>
                    <div class="modal-footer" id="dtl_footer">


                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- msgBox Modal Modal HTML -->
    <div id="cnfacceptModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="m_title" style="text-align:center;">Accept Trainee</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="warning">
                            <p>Are you sure you want to Accept?</p>

                        </div>
                        <p id="m_body"></p>
                    </div>
                    <div class="modal-footer" id="accept_footer">
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
$("#checkAll").click(function() {
    // alert(123);
    $('.email_btn').show();
    $('input:checkbox').not(this).prop('checked', this.checked);
});

$('input[type="checkbox"]').on('change', function() {
    $('.email_btn').show();
    var checkedValue = $(this).prop('checked');
    // uncheck sibling checkboxes (checkboxes on the same row)
    $(this).closest('tr').find('input[type="checkbox"]').each(function() {
        $(this).prop('checked', false);
    });
    $(this).prop("checked", checkedValue);

});

function show_email_div() {

    let prgram_id = <?php echo $_POST['id'] ?>;

    $.ajax({
        url: 'upload_email_doc.php',
        type: "POST",
        data: {
            'prgram_id': prgram_id,
            'action': 'select_Email_attatch'
        },

        success: function(data) {
            console.log(data);

            $('#emailModal').modal('show');
        }
    });

}

function accept_trainee(id){
    $.ajax({
        url: 'ajax_master.php',
        type: "POST",
        data: {
             'action': 'accept_trainee',
             'id': id,
             'table':"tbl_dept_trainee_registration"
        },

        success: function(data) {
            console.log(data);
            if (data == 'success') {
                sessionStorage.message = " Trainee Registred Successfully";
                sessionStorage.type = "success";
                location.reload();
            }
           
        }
    });

}

function send_mail() {


    let subject = $('#subject').val();
    let email_body = $('#email_body').val();

    TableData = storeTblValues();
    TableData = JSON.stringify(TableData);
  
    let program_id = <?php echo $_POST['id'] ?>;
    $.ajax({
        url: 'short_term_send_email.php',
        type: "POST",
        data: {
            'tableData': TableData,
            subject: subject,
            email_body: email_body,
            program_id: program_id
        },

        beforeSend: function() {
            $('.loader').show();
            //  $('#send_email').prop('disabled', true);
        },

        success: function(res) {
            console.log(res);
           let elm = res.split('#');
            if (elm[0] == 'success') {
                sessionStorage.message = "Email Sent Successfully";
                sessionStorage.type = "success";
                location.reload();
            }
        }
    });


}

function storeTblValues() {
    var TableData = new Array();
    $('#tranee_tbl tr').each(function(row, tr) {
        TableData[row] = {

            "trnee_id": $(tr).find('#tranee_id').val(),
            "name": $(tr).find('td:eq(1)').text(),
            "email": $(tr).find('td:eq(4)').text(),
            "phone": $(tr).find('td:eq(5)').text(),
            "send": ($(tr).find('input[type="checkbox"]:checked').val() == 1) ? "1" : "0",

        }
    });
    TableData.shift(); // first row will be empty - so remove
    return TableData;
}

function upload_email_doc(doc_id) {

    let prgram_id = <?php echo $_POST['id'] ?>;
    var name = document.getElementById(doc_id).files[0].name;
    var form_data = new FormData();
    var ext = name.split('.').pop().toLowerCase();
    if (jQuery.inArray(ext, ['pdf', 'docx']) == -1) {
        alert("Invalid Image File");
    }
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById(doc_id).files[0]);
    var f = document.getElementById(doc_id).files[0];
    var fsize = f.size || f.fileSize;
    if (fsize > 2000000) {
        alert("Image File Size is very big");
    } else {
        form_data.append("file", document.getElementById(doc_id).files[0]);
        form_data.append("action", "email_doc");
        form_data.append("type", doc_id);
        form_data.append("program_id", prgram_id);

        console.log(form_data);
        $.ajax({
            url: "upload_email_doc.php",
            method: "POST",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
            },
            success: function(res) {
                let elm = res.split('#');
                console.log(res);
                if (elm[0] == "success") {
                    sessionStorage.message = "Document" + ' ' + elm[1];
                    sessionStorage.type = "success";
                    $.ajax({
                        url: 'upload_email_doc.php',
                        type: "POST",
                        data: {
                            'prgram_id': prgram_id,
                            'action': 'select_Email_attatch'
                        },

                        success: function(data) {
                            console.log(data);
                            $('#attatchment').html(data);

                            $('#emailModal').modal('show');
                        }
                    });
                }
                return false;
            }
        });
    }
}

function remove(id, field) {
    //alert(id);
    let prgram_id = <?php echo $_POST['id'] ?>;
    $.ajax({
        type: 'POST',
        url: 'upload_email_doc.php',
        data: {
            id: id,
            field: field,
            action: "remove_report"
        },
        success: function(res) {
            console.log(res);
            let elm = res.split('#');
            //console.log(elm[0]);
            if (elm[0] == "success") {
                //print_r$("#email_div").load(" #email_div");
                $.ajax({
                    url: 'upload_email_doc.php',
                    type: "POST",
                    data: {
                        'prgram_id': prgram_id,
                        'action': 'select_Email_attatch'
                    },

                    success: function(data) {
                        console.log(data);
                        $('#attatchment').html(data);

                        $('#emailModal').modal('show');
                    }
                });
            }
        }
    })
}

function view_trainee_dtl(user_id, status, id) {
    //alert(status);
    $('#dtl_footer').html('');
    $.ajax({
        type: "POST",
        url: "ajax_trainee.php",

        data: {
            action: 'view_trainee_dtl',
            user_id: user_id
        },
        success: function(res) {
            console.log(res);
            $('#detail_body').html(res);
            if (status == 0) {
                $('#dtl_footer').html(` <input type="button" class="btn btn-primary" name="accept" value="Accept"
                                            onclick="cnftrainee(${id})" style="margin: 0 auto;" />
                                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">   
                                            `);
            } else {
                $('#dtl_footer').html(` <input type="button" class="btn btn-success" name="accept" value="Accepted"
                                            style="margin: 0 auto;" />
                                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">   
                                            `);
            }


            $('#traineeDetailModal').modal('show');
        }
    })


}

function add(str, frm, tbl, updt_id) {


   

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

function update(str, frm, tbl, id) {



    $.ajax({
        type: "POST",
        url: "ajax_master.php",

        data: $('#' + frm).serialize() + '&' + $.param({
            'action': 'add',
            'table': tbl,
            'update_id': id
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
            table: "tbl_tranee_registration",
            edit_id: id

        },
        success: function(res) {
            console.log(res);
            res.map((data) => {

                    $('#update_id').val(data.id);
                    $('#name').val(data.name);
                    $('#service_No').val(data.service_no);
                    $('#dob').val(data.dob);
                    $('#sex').val(data.sex);
                    $('#email').val(data.email);
                    $('#phone').val(data.phone);
                    $('#address').val(data.address);
                    $('#state').val(data.state);
                    $('#district').val(data.district);
                    $('#pin').val(data.pin);
                    $('#program_id').val(data.program_id);

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
        `<input type="button" class="btn btn-danger btn-dlt" value="Delete" onclick="delete_record(${id},'tbl_tranee_registration')" />`;
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


function cnftrainee(id) {
    //alert(id);
    $('#traineeDetailModal').modal('hide');
    $('#m_footer').empty();
    var html =
        `<input type="button" class="btn btn-danger btn-dlt" value="Accept" onclick="Accept_trainee(${id},'tbl_trainee_info')" />`;
    $('#accept_footer').append(html);
    $('#cnfacceptModal').modal('show');
}


function Accept_trainee(id, tbl) {

    $.ajax({
        type: "POST",
        url: "ajax_trainee.php",
        data: {

            action: "accept_trainee",
            id: id,
            table: tbl
        },
        success: function(res) {
            console.log(res);
            if (res == "success") {
                sessionStorage.message = "Accepted successfully";
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