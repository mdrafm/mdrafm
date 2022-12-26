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
                                        <h5 class="modal-title" id="termModalLabel">Long Term Program </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                         <form method="post" id="frm_program">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong>Programm Name</strong></label>
                                                        <input type="text" class="form-control" name="prg_name" id="prg_name"
                                                            placeholder="Enter Paper Code">
                                                    </div>
                                                </div>

                                                
                                                
                                            </div>

                                            <div class="row">
                                              <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong> Tranning Type</strong></label>
                                                        <select class="custom-select mr-sm-2" name="trng_type" id="trng_type">
                                                            <option value=0 selected>Select Tranning Type</option>
                                                            <option value=1 >Long Term Program (Newly Recruited)</option>
                                                            <option value=2 >Long Term Program (In Service)</option>
                                                         
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6" id="syllabus">
                                                    <div class="form-group">
                                                        <label><strong>Syllabus</strong></label>
                                                        <select class="custom-select mr-sm-2" name="syllabus_id" id="syllabus_id">
                                                            <option selected>Select Syllabus Type</option>
                                                                 
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong>Provisanal Start Date</strong></label>
                                                        <input type="date" class="form-control" name="provisonal_Sdate" id="provisonal_Sdate"
                                                            placeholder="Select Date">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong>Provisanal End Date</strong></label>
                                                        <input type="date" class="form-control" name="provisonal_Edate" id="provisonal_Edate"
                                                            placeholder="Select Date">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                
                                            </div>
                                            <div class="row" id="self_regst">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong>Date of Commencement for Self Registration</strong></label>
                                                        <input type="date" class="form-control" name="dt_publication" id="dt_publication"
                                                            placeholder="Select Date">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong>Closing Date of Self Registration  </strong></label>
                                                        <input type="date" class="form-control" name="dt_completion" id="dt_completion"
                                                            placeholder="Select Date">
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="hidden" id="update_id">
                                            <input type="hidden" name="status" value="draft">
                                        </form>
                                    </div>
                                    <div class="modal-footer">

                                        <button type="submit" class="btn btn-primary" name="submit" value="Save"id="save"
                                            onclick="add('Subject','frm_program','tbl_program_master')">Save</button>
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
                                    <div class="col-md-4">  
                                      <h4 class="card-title"> Program Master</h4>
                                    </div>
                                    <div class="col-md-6"></div>
                                    <div class="col-md-2">
                                    <input type="button" class="btn btn-primary" data-toggle="modal" data-target="#termModal"
                                     value="Add New">
                                    </div>
                                </div>
                                

                            </div>
                            <div class="card-body">
                                <div id="term2" class=" table table-responsive table-striped table-hover" style="width:100%;margin:0px auto" >
                                    <table class=" term table">
                                        <thead class="" style="background: #315682;color:#fff;font-size: 11px;">

                                            <th style="width:50px;">Sl No</th>
                                            <th style="text-align:center;">Programm Name</th>
                                            <th style="text-align:center;">Tranning Type</th>
                                            <th style="text-align:center;">Provisanal Start Date</th>
                                            <th style="text-align:center;">Status</th>
                                            <th style="text-align:center;">Details</th>
                                            <th style="text-align:center;">Action</th>
                                        </thead>
                                        <tbody>
                                            <?php 
                               
                               $db = new Database();
                               $count = 0;
                               $db->select('tbl_program_master',"*",null,"trng_type = 1 OR trng_type = 2",null,null);
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
                                                <td style="text-align:center;">
                                                        <?php 
                                                        $db->select_one('tbl_training_type',"type",$row['trng_type']);
                                                        //print_r($db->getResult());
                                                    foreach($db->getResult() as $row1){
                                                        echo $row1['type'];
                                                    }
                                                        //echo $row['trng_type']; 
                                                        ?> 
                                                 </td>
                                                 <!-- <td style="text-align:center;">
                                                    <?php 
                                                        $db->select_one('tbl_sylabus_master',"descr",$row['syllabus_id']);
                                                        
                                                        foreach($db->getResult() as $row1){
                                                            echo $row1['descr'];
                                                        }
                                                                
                                                                
                                                     ?>
                                                 </td> -->
                                                 <!-- <td style="text-align:center;">
                                                    <?php 
                                                        $db->select_one('tbl_faculty_master',"name",$row['course_director']);
                                                        
                                                        foreach($db->getResult() as $row1){
                                                            echo $row1['name'];
                                                        }
                                                                
                                                                
                                                     ?>
                                                 </td> -->
                                                    <td style="text-align:center;"><?php echo date("d-m-Y", strtotime($row['provisonal_Sdate'])) ?> </td>
                                                    
                                                    <td style="text-align:center;">
                                                    <?php
                                                  
                                                    switch ($row['status']) {

                                                        case 'draft':
                                                            echo 'Draft';
                                                            break;

                                                        case 'pendingAtIncharge':
                                                            echo 'Pending at Tranning Incharge';
                                                            break;

                                                        case 'reject_by_incharge':
                                                            echo ' <p style="color:red" >Reject by Tranning Incharge</p>'; 
                                                            echo '<b>Comment: </b>'.$row['remark'];

                                                        case 'pendingAtDirector':
                                                                echo 'Pending at Director';
                                                            break;

                                                        case 'approve':
                                                            echo 'Approved';
                                                            break;
                                                        
                                                    } 
                                                    
                                                    ?> </td>
                                                     <td style="text-align:center;">

                                                       <?php
                                                         if($row['trng_type'] == 1){
                                                            ?>
                                                             <input type="button" class="btn " style="background:#3292a2"
                                                            name="send"
                                                            onclick="datapost('program_detail.php',{id: <?php echo $row['id'] ?>,trng_type: <?php echo $row['trng_type'] ?> })"
                                                            value="View Detail" />
                                                            <?php
                                                         }else{
                                                            ?>
                                                             <input type="button" class="btn " style="background:#3292a2"
                                                            name="send"
                                                            onclick="datapost('program_detail_inservice.php',{id: <?php echo $row['id'] ?>,trng_type: <?php echo $row['trng_type'] ?> })"
                                                            value="View Detail" />
                                                            <?php
                                                         }
                                                       ?>

                                                        
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
                                                                <a href="#" style="color:#e50c0c" id="<?php echo $row['id']; ?>"
                                                                    onclick="cnfBox(<?php echo $row['id']; ?>)"><i
                                                                        class="far fa-trash-alt "
                                                                        style="font-size:1.5rem;"></i></i></a><br>

                                                                <input type="button" class="btn " style="background:#3292a2"  name="send"   id="<?php echo $row['id']; ?>" 
                                                                onclick="sendToApprove(this.id,'tbl_program_master')" value="Send For Approval" />
                                                            
                                                                 <?php
                                                                 break;
                                                                case 'pending':
                                                                    echo "Sent To Director For Approval";
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
    //console.log(trng_type);


    var tbl;
    if(trng_type == 1 ){
         tbl = "tbl_sylabus_master";
         $('#syllabus').show();
         $('#self_regst').show();
    }
    else if(trng_type == 2){
        tbl = "tbl_sylabus_master";
         $('#syllabus').show();
         $('#self_regst').hide();
    }
     else if(trng_type == 3){
         tbl = "tbl_mid_syllabus";
         $('#syllabus').show();
    }
    else{
        $('#syllabus').hide();
    }


    $.ajax({
        type: "POST",
        url: "ajax_master.php",

        data: {
            trng_type: trng_type,
            table:tbl,
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
                
                $.ajax({
                    type: "POST",
                    url: "ajax_master.php",
                    
                    data: {
                        action: "edit_syllabus",
                        table: "tbl_sylabus_master",
                        edit_id: data.syllabus_id

                    },
                    success:function(res){
                        console.log(res);
                        $('#syllabus_id').html(res);
                    }
                });
                
                if(data.trng_type == 2){
                    $('#self_regst').hide();
                }
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


function sendToApprove(id,tbl){
    if(confirm('Are you sure you want to Send this Program to Tranning Incharge For Approval')){
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
                sessionStorage.message = " Successfully Send to Director for  Tranning Incharge";
                sessionStorage.type = "success";
                location.reload();
            }
        }
    })
 }else{
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