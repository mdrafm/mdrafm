<!DOCTYPE html>
<html lang="en">


<head>
    <?php 
    
    include('header_link.php');
    include('../config.php');
    include 'database.php';
    $db = new Database();
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


            <div class="content"  style="margin-top: 50px;">

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
                                        <h5 class="modal-title" id="termModalLabel">Trainee Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <form method="post" id="frm_program">
                                            <div class="row">
                                                <div class="col-md-2">
                                                  <label><strong> Batch</strong></label>
                                                </div>
                                                <div class="col-md-4  pl-1">
                                                <div class="form-group">
                                                  <input type="text" class="form-control"  value="<?php echo $_POST['batch_name'] ?>" style="color:black" readonly />
                                                  <input type="hidden" name="batch_id" id="batch_id" value="<?php echo $_POST['id'] ?>" />
                                                </div>
                                                </div>
                                            </div>
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
                                                        <label><strong>Current Place of Posting</strong></label>
                                                        <input type="email" class="form-control" name="place_of_posting" id="place_of_posting"
                                                            placeholder=" Enter Place of Posting">
                                                    </div>
                                                    <!-- <div class="form-group">
                                                        <label><strong>Category</strong></label>
                                                        <select class="custom-select mr-sm-2" name="category"
                                                            id="category">
                                                            <option selected>Select Category</option>
                                                            <option value="1">UR</option>
                                                            <option value="3">SEBC</option>
                                                            <option value="4">ST</option>
                                                            <option value="5">SC</option>
                                                        </select>
                                                    </div> -->
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong>Date Of Birth</strong></label>
                                                        <input type="date" class="form-control" name="dob" id="dob"
                                                            placeholder="Select DOB">
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
                                            <div class="row">
                                                
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
                                                <!-- <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong> Rank</strong></label>
                                                        <input type="text" class="form-control" name="roll_no"
                                                            id="roll_no" placeholder=" Enter Roll No">
                                                    </div>
                                                </div> -->
                                            </div>
                                            <!-- <div class="row">
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong> Home District</strong></label>
                                                        <input type="text" class="form-control" name="district"
                                                            id="district" placeholder=" Enter Home District">
                                                    </div>
                                                </div>
                                            </div> -->
                                            

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

                    </div>
                    <div class="col-md-2">
                       
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-4">  <h4 class="card-title"> Newly Recruited Trainee</h4></div>
                                    <div class="col-md-5"></div>
                                    <div class="col-md-3">
                                        <?php
                                            //$sql = "SELECT DISTINCT(batch_id),fin_status FROM `tbl_new_recruite` WHERE batch_id = 1;"
                                            $db->select('tbl_new_recruite','DISTINCT(batch_id),fin_status',null,"batch_id =".$_POST['id'],null,null);
                                           // print_r($db->getResult());
                                            $res = $db->getResult();
                                           if( empty($res)){
                                            ?>
                                            <input type="button" class="btn btn-primary" data-toggle="modal" data-target="#termModal"
                                            value="Add New Tranee ">
                                            <?php
                                           }else{
                                              
                                            foreach($res as $row1){
                                               // print_r($row1);
                                               
                                                  if($row1['fin_status'] == 1){
                                                    ?>
                                                     <input type="button" class="btn" style="background: #343954;" value="Already Sent To MDRAFM ">
                                                      
                                                    <?php
                                                  }else{
                                                      ?>
                                                      <input type="button" class="btn btn-primary" data-toggle="modal" data-target="#termModal"
                                                      value="Add New Tranee ">
                                                      <?php
                                                  }
                                              }
                                            
                                           }
                                            
                                         
                                        ?>
                                    
                                    </div>
                                </div>
                               
                                <?php //print_r($_POST); ?>
                            </div>
                            <div class="card-body">  
                                <table class="table  table-striped table-hover" style="width: 60%;">
                                <tr>
                                  <td> <strong>Batch</strong> </td> 
                                  <td><strong><?php echo $_POST['batch_name'] .'-'. $_POST['batch_year']  ?></strong></td> 
                                  <td><input type="button" class="btn btn-info" value="view Tranee List" id="tranee_list" /></td>  
                                <tr>
                                <form method="post" id="newfrm">
                                </table>
                               
                                <!-- <div class="row">
                                    <div class="col-md-3">
                                        <label>Batch</label>
                                    </div>
                                    <div class="col-md-5">
                                       <input type="text" class="form-control" value="<?php echo $_POST['batch_name'] ?>" />
                                    </div>
                                </div> -->
                                <div id="tranee" class=" table table-responsive table-striped table-hover" style="display:none">
                                    <table class=" term table" >
                                        <thead class="" style="background: #315682;color:#fff;font-size: 11px;">

                                        <th style="">Sl No</th>
                                        <th style="text-align:center;"> Name</th>
                                        <!-- <th style="text-align:center;">Program</th> -->
                                        <th style="text-align:center;">DOB</th>
                                        <!-- <th style="text-align:center;">Category</th> -->
                                        <th style="text-align:center;">Place of Posting</th>
                                        <th style="text-align:center;">Sex</th>
                                        <th style="text-align:center;">Email</th>
                                        <th style="text-align:center;">Phone</th>
                                        <!-- <th style="text-align:center;">Rank</th>
                                        <th style="text-align:center;">District</th> -->

                                <!-- <th>Date</th> -->
                                <th style="text-align:center;width: 8rem;">Action</th>



                                        </thead>
                                        <tbody>
                                        <?php 
                               
                              
                               $count = 0;
                               $db->select('tbl_new_recruite',"*",null,"batch_id =".$_POST['id'],null,null);
                              // print_r( $db->getResult());
                              $ids = array();
                              $fin_status = '';
                               foreach($db->getResult() as $row){
                                   //print_r($row);
                                   $fin_status = $row['fin_status'];
                                   array_push($ids,$row['id']);
                                   $count++;
                                   //sprint_r($ids);
                                   ?>
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td style="text-align:center;"><?php echo $row['f_name'] .' '.$row['l_name']; ?> </td>
                               
                                <td style="text-align:center;"><?php echo $row['dob']; ?> </td>
                                <td style="text-align:center;">
                                  <?php 
                                  echo $row['place_of_posting'];
                                //       if($row['category'] == 1){
                                //           echo "UR";
                                //       }
                                //       else if($row['category'] == 2){
                                //         echo "UR(W)";
                                //     }
                                //     else if($row['category'] == 3){
                                //         echo "SEBC";
                                //     }
                                //     else if($row['category'] == 4){
                                //         echo "ST";
                                //     }
                                //     else if($row['category'] == 5){
                                //         echo "SC";
                                //     }
                                //   ?> 
                               </td>
                                
                                <td style="text-align:center;">
                                    <?php
                                 echo ($row['sex'] == 1) ?  "Male" : "Femail" ; 
                                
                                ?> </td>
                                 <td style="text-align:center;"><?php echo $row['email']; ?> </td>
                                 <td style="text-align:center;"><?php echo $row['phone']; ?> </td>
                                 <!-- <td style="text-align:center;"><?php echo $row['roll_no']; ?> </td>
                                 <td style="text-align:center;"><?php echo $row['district']; ?> </td> -->

                                <td style="text-align:center;">
                                   <?php
                                     if($row['fin_status'] == 0){
                                         ?>
                                          <a href="#" style="color:#4164b3" class="edit" id="<?php echo $row['id']; ?>"
                                        onclick="edit(this.id)"><i class="far fa-edit "
                                            style="font-size:1.5rem;"></i></a> &nbsp;
                                            <a href="#" style="color:#e50c0c" id="<?php echo $row['id']; ?>"
                                                onclick="cnfBox(<?php echo $row['id']; ?>)"><i class="far fa-trash-alt "
                                                    style="font-size:1.5rem;"></i></i></a><br>
                                            <!-- <input type="text" class="btn " style="background:#3292a2" 
                                            onclick="cnfBox2(<?php echo $row['id'] ?>)" name="send" value="send to MDRAFM" /> -->
                                         <?php
                                     }else{
                                         ?>
                                           <input type="text" class="btn " style="background:#3292a2" name="send" value="Sent to MDRAFM" disabled />
                                          
                                         <?php
                                     }
                                   
                                   ?>
                                    
                                </td>
                                <input type="hidden"  name="new_id[]" value="<?php echo $row['id']; ?>" />

                            </tr>
                            <?php
                               }
                             
                               
                              ?>

                                        </tbody>
                                    </table>
                                  <div class="row">
                                      <div class="col-md-6">
                                          <?php
                                          
                                          $db->select('tbl_batch_master',"id,cover_latter,mdrafm_status",null,"id =".$_POST['id'],null,null);
                                          foreach($db->getResult() as $row){
                                             // print_r($row);
                                              $file_path_latter = "email_doc/".$row['cover_latter'];
                                            
                                              if($row['cover_latter'] == '' && $row['mdrafm_status']== 0){
                                               
                                                  ?>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <input type="file" name="latter" id="latter" class="form-control"
                                                                style="opacity: 1;position: unset;height: 85%;border-radius: 5px;">
                                                        </div>
                                                        <div class="col-md-6">
                                                        <input type="button" class="btn btn-info" id="latter_btn" 
                                                                onclick="upload_cover_latter('latter')" value="Upload Cover Latter">
                                                        </div>
                                                    </div>
                                                  <?php
                                              }else{
                                                  ?>
                                                    <div class="col-md-6" id="latter_doc" style="display: <?php echo  ($row['mdrafm_status']== 1)?'none':'' ?> " >
                                                    <a href="<?php echo $file_path_latter; ?>" target="_blank" >Cover Latter <img src="../images/document_pdf.png" /></a>
                                                    <a href="#" class="remove" id="<?php echo $row['id'] ?>"  onclick = "remove(this.id,'cover_latter')" > <img src="../images/cross.png" /></a>
                                                 </div>
                                                  <?php
                                              }
                                          }
                                          ?>
                                          
                                      </div>

                                      <div class="col-md-3">
                                      </div>
                                     <div class="col-md-3">
                                     <input type="button" class="btn btn-primary " style="display: <?php echo  ( $fin_status== 1)?'none':'' ?> "
                                           <?php if ( $fin_status == 1){ echo "disabled"; } ?>
                                            onclick="cnfBox2(<?php echo $_POST['id'] ?>)"  value="Send to MDRAFM" />
                                     </div>
                                                   
                                  </div>
                                           
                            </form>
                                   
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

function upload_cover_latter(doc_id) {

    //let prgram_id = $('#prgram_id').val();
    let batch_id = <?php echo $_POST['id'] ?>;
    alert(doc_id);
    var name = document.getElementById(doc_id).files[0].name;
    var form_data = new FormData();
    var ext = name.split('.').pop().toLowerCase();
    if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg', 'pdf']) == -1) {
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
        form_data.append("action", "cover_latter");
        form_data.append("type", doc_id);
        form_data.append("batch_id", batch_id);
        
        console.log(form_data);
        $.ajax({
            url: "ajax_master.php",
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
                    sessionStorage.message =  "Document" +' '+ elm[1]; 
                    sessionStorage.type = "success";
                    location.reload();
                }
                return false;
            }
        });
    }
}

function remove(id,field){
    //alert(id);
    $.ajax({
        type:'POST',
        url:'ajax_master.php',
        data:{action:"remove_report",id:id,field:field},
        success: function(res){
            console.log(res);
            let elm = res.split('#');
            //console.log(elm[0]);
            if (elm[0] == "success") {
                //print_r$("#email_div").load(" #email_div");
                location.reload();
            }
        }
    })
}



    $('#tranee_list').click(function(){
        $('#tranee').toggle();
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
                    $('#program').val(data.program);
                    $('#dob').val(data.dob);
                    $('#category').val(data.category);
                    $('#sex').val(data.sex);
                    $('#email').val(data.email);
                    $('#phone').val(data.phone);
                    $('#roll_no').val(data.roll_no);
                    $('#district').val(data.district);


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
        `<input type="button" class="btn btn-danger btn-dlt" value="Delete" onclick="delete_record(${id},'tbl_new_recruite')" />`;
    $('#m_footer').append(html);
    $('#cnfModal').modal('show');
}

function cnfBox2(id) {
    //alert(id);
   
    $('#ms_footer').empty();
   
    var html =
        `<input type="button" class="btn btn-primary btn-dlt" value="Send" onclick="send_record(${id},'tbl_new_recruite')" />`;
    $('#ms_footer').append(html);
    $('#cnfModaSend').modal('show');
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

function send_record(id,tbl) {

$.ajax({
    type: "POST",
    url: "ajax_master.php",
    data: $('#newfrm').serialize() + '&' + $.param({
            'action': 'sendrecord','batch_id':id,
           
        }),
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