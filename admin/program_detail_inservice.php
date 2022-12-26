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
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <div class="wrapper ">

        <?php include('sidebar.php'); ?>

        <div class="main-panel" id="main-panel">
            <?php include('navbar.php'); ?>

            <div class="panel-header panel-header-sm">


            </div>


            <div class="content">

                <div class="row">
                    <div class="col-md-4">
                        <div id="alert_msg" class="alert alert-success">added successfully</div>
                    </div>
                    <div class="col-md-6">
                        <!-- Modal -->
                    
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"> Program Detail</h4>
                               
                            </div>
                            <div class="card-body">
                                <div id="detail" class="">
                                    <?php
                                    switch ($_POST['trng_type']) {
                                        case '1':

                                            $sql = "SELECT p.id,p.prg_name,t.type,s.descr,p.course_director,p.asst_course_director,p.provisonal_Sdate,p.provisonal_Edate,p.dt_publication,p.dt_completion 
                                            FROM `tbl_program_master` p JOIN `tbl_training_type` t 
                                            ON p.trng_type=t.id
                                            JOIN `tbl_sylabus_master` s 
                                            ON p.syllabus_id=s.id
                                            
                                            WHERE p.id = '" . $_POST['id'] . "' ";
                                            break;
                                        case '2':
                                            $sql = "SELECT p.id,p.prg_name,t.type,s.descr,p.course_director,p.asst_course_director,f.name,p.provisonal_Sdate,p.provisonal_Edate,p.dt_publication,p.dt_completion 
                                                FROM `tbl_program_master` p JOIN `tbl_training_type` t 
                                                ON p.trng_type=t.id
                                                JOIN `tbl_mid_syllabus` s 
                                                ON p.syllabus_id=s.id
                                                JOIN `tbl_faculty_master` f
                                                ON p.course_director = f.id
                                                WHERE p.id = '" . $_POST['id'] . "' ";
                                            break;
                                        case '3':
                                            $sql = "SELECT p.id,p.prg_name,t.type,p.course_director,p.asst_course_director,p.provisonal_Sdate,p.provisonal_Edate,p.status
                                                FROM `tbl_program_master` p JOIN `tbl_training_type` t 
                                                ON p.trng_type=t.id
                                                WHERE p.id = '" . $_POST['id'] . "' ";
                                            break;
                                        case '4':
                                            $sql = "SELECT p.id,p.prg_name,t.type,p.course_director,p.asst_course_director,p.provisonal_Sdate,p.provisonal_Edate,p.status
                                                FROM `tbl_program_master` p JOIN `tbl_training_type` t 
                                                ON p.trng_type=t.id
                                                WHERE p.id = '" . $_POST['id'] . "' ";
                                            break;
                                    }
                                    //echo $sql;
                                    $db->select_sql($sql);
                                    ///print_r($db->getResult());
                                    foreach ($db->getResult() as $row) {
                                        $prog_name = $row['prg_name'];
                                       // print_r($row);
                                    ?>
                                        <div style="width: 100%; background-color: #42c19f2e; padding: 5px;border: 3px solid #2daab0;">

                                            <div style="width:33%;float:left;">
                                                Program Name : <?php echo $row['prg_name']; ?></br>
                                                Program Type : <?php echo $row['type']; ?> </br>
                                                <!-- Course Director :<?php echo $row['name']; ?> -->

                                            </div>
                                            <div style="width:33%;float:left;">

                                                Start Date :<?php echo date("d/m/Y", strtotime($row['provisonal_Edate'])); ?><br>
                                                End Date:<?php echo date("d/m/Y", strtotime($row['provisonal_Edate']));  ?>
                                            </div>
                                            <div style="width:33%;float:left;">
                                               
                                                Course Director : <?php if ($row['course_director'] != 0) {
                                                                        $db->select_one('tbl_faculty_master', 'name', $row['course_director']);
                                                                        foreach ($db->getResult() as $faculty) {
                                                                            echo $faculty['name'];
                                                                        }
                                                                    } ?></br>
                                                Asst Course Director : <?php if ($row['asst_course_director'] != 0) {
                                                                        $db->select_one('tbl_faculty_master', 'name', $row['asst_course_director']);
                                                                        foreach ($db->getResult() as $faculty) {
                                                                            echo $faculty['name'];
                                                                        }
                                                                    } ?></br>
                                            </div>

                                            <div style="clear:both;background-color: #ffb75b;">

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
                                        <a class="nav-link <?php if($_POST['trng_type'] == 1 || $_POST['trng_type'] == 2){ echo 'active';} ?> " data-toggle="pill" href="#home">Trainee List</a>
                                    </li>
                                   
                                    <li class="nav-item" style="display:<?php if ($_POST['trng_type'] == 1 ) {
                                                                            echo "none";
                                                                        } ?>">
                                        <a class="nav-link" data-toggle="pill" href="#menu2">Action</a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#menu2">tab3</a>
                                    </li> -->
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    
                                    <div id="home" class="container  tab-pane active  "><br>

                                        <div id="term2" class=" table table-responsive table-striped table-hover">
                                            <?php
                                            
                                            include "long_term_inservice_trainee_template.php";
                                            ?>

                                            <input type="button" class="btn btn-primary" name="send_email" id="send_email" style="display:none" value="Send Email" />
                                            <div class="loader">
                                                <img src="assets/img/loader.gif" alt="Loading" style="width: 300px;height: 90px;float: right;" />
                                            </div>
                                        </div>

                                    </div>
                                  
                                    <div id="menu2" class="container tab-pane fade"><br>
                                        <div id="mid_trainee_list" class=" table table-responsive table-striped table-hover">
                                            <table class=" term table" id="tranee_tbl">
                                                <thead class="" style="background: #315682;color:#fff;font-size: 11px;">


                                                    <th>Sl No</th>

                                                    <th> Name</th>
                                                   
                                                    <th>Name of the Office</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th style="text-align:center;">
                                                      
                                                        <input class="form-check-input checkAll2" type="checkbox" id="checkAll"  >
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Send All
                                                    </th>
                                                    <th></th>
                                                </thead>
                                                <tbody>
                                                    <?php

                                                    $count = 0;

                                                    $db->select(
                                                        'tbl_new_recruite',
                                                        "*",
                                                        null,
                                                        " mdrafm_status = 1 AND batch_id = (SELECT id FROM `tbl_batch_master` WHERE program_id = '".$_POST['id']."') ",
                                                        null,
                                                        null
                                                    );
                                                    
                                                    foreach ($db->getResult() as $row) {
                                                        
                                                        $count++
                                                    ?>
                                                        <tr>

                                                            <td><?php echo $count; ?></td>

                                                            <td> <?php  echo $row['f_name'] . ' ' . $row['l_name'];  ?></td>
                                                           
                                                            <td> <?php echo $row['place_of_posting']  ?></td>
                                                            <td> <?php echo $row['email']  ?></td>
                                                            <td style="text-align:center;"><?php echo $row['phone']; ?> </td>
                                                            <td style="text-align:center;">
                                                            <div class="form-check form-check-inline">
                                                                   <?php
                                                                      if($row['email_status']== 1){
                                                                        echo "Email was Sent";
                                                                      }else{
                                                                        ?>
                                                                         <label class="form-check-label" for="inlineCheckbox1">Send Email</label>
                                                                            <input class="form-check-input" type="checkbox" name="sent" id="sent" value="1" 
                                                                            <?php echo ($row['email_status']== 1)?'checked':'' ?> 
                                                                                style="opacity: 1;visibility: visible;">
                                                                                <?php
                                                                            }
                                                                       ?>

                                                                    
                                                                </div>
                                                            </td>
                                                             <td>
                                                               <input type="hidden" name="tranee_id" id="tranee_id" value="<?php echo $row['id']; ?>" >
                                                             </td>
                                                            
                                                        </tr>
                                                    <?php
                                                    }


                                                    ?>

                                                </tbody>
                                            </table>
                                            <input type="button" class="btn btn-primary" value="Send Email" onclick="show_email_div()" />
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
            <div class="modal-content"  style="width:130%; margin:120px -60px">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="m_title" style="text-align:center;">Email Login Credentials to Trainee </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                            <div class="form-group">
                                <label> Subject :   </label>
                                <input type="text" class="form-control col-sm-8" name="subject" id="subject"  placeholder="Enter subject">
                                                           
                            </div>
                             <div class="form-group">
                                <label> Email Content :   </label>
                                <textarea  class="form-control" name="email_body" id="email_body" rows="5" style="border: 1px solid black;max-height: 140px;" >This  Login User ID and Password has been provided  you to access Integrated Training Management System  (ITMS).
         URL: https://mdrafm.odisha.gov.in
                               </textarea>
                            </div>
                            <div class="form-group">
                            <label> Attachments :   </label>
                            <div id="attatchment">
                                
                            </div>
                            </div>
                            <div class="loader">
                              <img src="assets/img/loader.gif" alt="Loading" style="width: 300px;height: 90px;"/>
                            </div>
                    </div>
                    <div class="modal-footer" id="mailbtn">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="button" class="btn btn-primary" value="Send" onclick="handle_mail()" >

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

    <div id="detailsModal" class="modal fade">
        <div class="modal-dialog">
        <div class="modal-content" style="width:200%; margin:20px -150px">
                    <div class="modal-header">
                        <h5 class="modal-title" id="termModalLabel">Trainee Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form method="post" id="frm_program">
                            
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label><strong> Name</strong></label>
                                        <input type="text" class="form-control" name="f_name"
                                            id="f_name" placeholder="First Name">
                                    </div>
                                </div>
                                <div class="col-md-6 pl-1">
                                    <div class="form-group">
                                        <label><strong>&nbsp;</strong></label>
                                        <input type="text" class="form-control" name="l_name"
                                            id="l_name" placeholder="Last Name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>HRMS Id</strong></label>
                                        <input type="text" class="form-control" name="hrms_id" id="hrms_id"
                                            placeholder=" Enter HRMS Id">
                                    </div>
                                    
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>Current Place of Posting</strong></label>
                                        <input type="email" class="form-control" name="place_of_posting" id="place_of_posting"
                                            placeholder=" Enter Place of Posting">
                                    </div>
                                    
                                </div>
                                
                            </div>
                            <div class="row">
                               <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>Date Of Birth</strong></label>
                                        <input type="date" class="form-control" name="dob" id="dob"
                                            placeholder="Select DOB">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>Sex</strong></label>
                                        <select class="custom-select mr-sm-2" name="sex" id="sex">
                                            <option selected>Select Sex</option>
                                            <option value="1">Male</option>
                                            <option value="0">Female</option>

                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong> Email</strong></label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder=" Enter Email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong> Phone</strong></label>
                                        <input type="text" class="form-control" name="phone" id="phone"
                                            placeholder=" Enter Phone Number">
                                    </div>
                                </div>
                            </div>
                           
                            
                            

                            <input type="hidden" id="update_id">
                            <input type="hidden" id="trng_type" name="trng_type" value='2'>

                        </form>
                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-primary" name="submit" value="Save"
                            id="save"
                            onclick="add('new recruit','frm_program','tbl_new_recruite')">Save</button>
                    </div>
                </div>
        </div>
    </div>
    <?php include('common_script.php') ?>

</body>

</html>

<script type="text/javascript">
    $("#checkAll").click(function(){
    // alert(123);
        $('input:checkbox').not(this).prop('checked', this.checked);
    });

    $('input[type="checkbox"]').on('change', function() {
        var checkedValue = $(this).prop('checked');
        // uncheck sibling checkboxes (checkboxes on the same row)
        $(this).closest('tr').find('input[type="checkbox"]').each(function() {
            $(this).prop('checked', false);
        });
        $(this).prop("checked", checkedValue);

    });

function show_email_div(){
    
    let prgram_id = <?php echo $_POST['id'] ?>;
    $('#emailModal').modal('show');

//     $.ajax({
//        url: 'upload_email_doc.php',
//        type: "POST",
//        data: {
//            'prgram_id': prgram_id,
//            'action':'select_Email_attatch'           
//        },

//        success: function(data) {
//            console.log(data);
//          $('#attatchment').html(data);

//         $('#emailModal').modal('show');
//        }
//    });

}

  async function handle_mail(){


            TableData = storeTblValues();
           // TableData = JSON.stringify(TableData);
           const emailStatus =  TableData.map( async data =>{
            console.log(data.send);
            if(data.send == 1){
             const Status = await sendEmail(data.email,data.phone,data.trnee_id,data.name);
             const smsStatus = await handleSms(data.phone);
             return [Status,smsStatus];
            }
          
         
           })
          
          
           const results = await Promise.all(emailStatus);

          /// console.log(results);
}

function sendEmail(email,phone,traine_id,name){

    let subject = $('#subject').val();
    let email_body = $('#email_body').val();
    //console.log(traine_id);

 return $.ajax({
        url: 'send_email.php',
        type: "POST",
        data: {
            action:"inservice_email",
            subject:subject,
            email_body:email_body,
            email:email,
            phone:phone,
            traine_id:traine_id,
            name:name,
        },

        beforeSend: function(){
            $('.loader').show();
            //  $('#send_email').prop('disabled', true);
            },

        success: function(data) {
            console.log(data);
             
            // if(data == 'success'){
            //     sessionStorage.message = "Email Sent Successfully";
            //     sessionStorage.type = "success";
            //     //location.reload();
            // }
        }
     });
}

async function handleSms(phone){
     var otp = "Registration Complete";
     var content = otp+"- Reminder to view the mail received from MDRAFM Govt. of Odisha.";
     const url = "https://govtsms.odisha.gov.in/api/api.php";
     const options = {
        method: 'POST',
        headers: {Accept: 'text/plain'},
        body: new URLSearchParams({
            action: 'singleSMS',
            department_id: 'D018001',
            template_id: '1007847089437214478',
            sms_content: `${otp} - Reminder to view the mail received from MDRAFM Govt. of Odisha.`,
            phonenumber: phone
        })
       };

     try {
        const response = await fetch(url,options);

        if (response.ok) {
            const result = await response.json();
            console.log(result);
        }
    } catch (err) {
    console.error(err);
    }

}

function storeTblValues() {
   var TableData = new Array();
   $('#tranee_tbl tr').each(function(row, tr) {
       TableData[row] = {
          
           "trnee_id": $(tr).find('#tranee_id').val(),
           "name":$(tr).find('td:eq(1)').text(),
           "email":$(tr).find('td:eq(3)').text(),
           "phone":$(tr).find('td:eq(4)').text(),
           "send": ($(tr).find('input[type="checkbox"]:checked').val() == 1)?"1":"0",

       }
   });
   TableData.shift(); // first row will be empty - so remove
   return TableData;
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
            table: "tbl_new_recruite",
            edit_id: id

        },
        success: function(res) {
            console.log(res);
            res.map((data) => {

                    $('#update_id').val(data.id);
                    $('#trng_type').val(data.trng_type);
                   
                    $('#f_name').val(data.f_name);
                    $('#l_name').val(data.l_name);
                    $('#dob').val(data.dob);
                    $('#hrms_id').val(data.hrms_id);
                    $('#place_of_posting').val(data.place_of_posting);
                    $('#sex').val(data.sex);
                    $('#email').val(data.email);
                    $('#phone').val(data.phone);
                    $('#roll_no').val(data.roll_no);
                    $('#district').val(data.district);


                    $('#save').html('Update');
                    $('#save').attr('id', 'update');
                    $('#detailsModal').modal('show');
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



    function cnftrainee(id) {
        //alert(id);
        $('#traineeDetailModal').modal('hide');
        $('#accept_footer').empty();

        $.ajax({
            type: "POST",
            url: "ajax_trainee.php",
            data: {

                action: "check_inservice_trainee",
                id: id,
               
            },
            success: function(res) {
                console.log(res);
                elm = res.split('#');

                if (elm[0] == "error") {
                    $('.warning').hide();
                   $('#m_body').html(elm[1]);
                   var html = ` <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">`;
                   $('#accept_footer').append(html);
                }else{
                    var html =
                    `
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="button" class="btn btn-primary btn-dlt" value="Approve" onclick="Accept_trainee(${id},'tbl_new_recruite')" />`;
                $('#accept_footer').append(html);
                }
            }
        })

        
        $('#cnfacceptModal').modal('show');
    }


    function Accept_trainee(id, tbl) {

        $.ajax({
            type: "POST",
            url: "ajax_trainee.php",
            data: {

                action: "accept_inservice_trainee",
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