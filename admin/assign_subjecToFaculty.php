<!DOCTYPE html>
<html lang="en">


<head>
    <?php 
    
    include('header_link.php');
    include('../config.php');
    include 'database.php';
    $db = new Database();

    //dependent select options for major subject
 
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
                                        <h5 class="modal-title" id="termModalLabel">Assign Subjetc to Guest Faculty</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                    <form method="post" id="frm_topic">
                                          <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong>Select Guest Faculty</strong></label>
                                                        <select class="custom-select mr-sm-2" id="faculty_id"
                                                            name="faculty_id">
                                                            <option selected>Select Guest Faculty</option>
                                                            <?php 
                                                                   
                                                                    $count = 0;
                                                                    $db->select('tbl_faculty_master',"id,name",null,"status = 1 AND role = 2",null,null);
                                                                    // print_r( $db->getResult());
                                                                    foreach($db->getResult() as $row){
                                                                        //print_r($row);
                                                                        $count++
                                                                ?>
                                                                            <option value="<?php echo $row['id'] ?>">
                                                                                <?php echo $row['name'] ; ?>
                                                                            </option>

                                                                            <?php 
                                                                    }
                                                             ?>
                                                        </select>
                                                      
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div id="sub_tbl" class=" table table-responsive table-striped table-hover" 
                                                     style="width: 70%; margin-left: 50px;border: 1px solid #c7c0c0; 
                                                     box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;display:none" >
                                                </div>
                                                
                                            </div>
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label><strong>Paper Code</strong></label>
                                                        <select class="custom-select mr-sm-2" id="paper_id"
                                                            name="paper_id">
                                                            <option selected>Select Paper</option>
                                                            <?php 
                                                                   
                                                                    $count = 0;
                                                                    $db->select('tbl_guest_paper',"*",null,null,null,null);
                                                                    // print_r( $db->getResult());
                                                                    foreach($db->getResult() as $row){
                                                                        //print_r($row);
                                                                        $count++
                                                                ?>
                                                                            <option value="<?php echo $row['id'] ?>">
                                                                                <?php echo $row['paper_name'] ; ?>
                                                                            </option>

                                                                            <?php 
                                                                    }
                                                             ?>
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                               <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label><strong>Subject</strong></label>
                                                        <select class="custom-select mr-sm-2" id="subject_id"
                                                            name="subject_id">
                                                            <option selected>Select Subject</option>
                                                            
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                           
                                            
                                            <input type="hidden" id="update_id">
                                        </form>
                                    </div>
                                    <div class="modal-footer">

                                        <button type="submit" class="btn btn-primary" name="submit" value="Save"
                                            id="save"
                                            onclick="add('Assign','frm_topic','tbl_guest_faculty')">Save</button>
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
                                    <div class="col-md-6">  
                                    <h4 class="card-title">Guest Faculty Subject Deatails</h4>
                                    </div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-2">
                                    <input type="button" class="btn btn-primary" data-toggle="modal" data-target="#termModal"
                            value="Add New">
                                    </div>
                                </div>
                               

                            </div>
                            <div class="card-body">
                                <div id="term2" class=" table table-responsive table-striped table-hover" style="width:95%;margin:0px auto" >
                                    <table class=" term table">
                                        <thead class="" style="background: #315682;color:#fff;font-size: 11px;">

                                            <th style="">Sl No</th>

                                            <th style="text-align:center;">Paper code</th>
                                            <th style="text-align:center;">Subject</th>
                                            <th style="text-align:center;">Faculty Name</th>
                                            <th style="text-align:center;">Action</th>



                                        </thead>
                                        <tbody>
                                            <?php 
                               
                               $db = new Database();
                               $count = 0;
                               $db->select('tbl_guest_faculty',"*",null,null,null,null);
                              // print_r( $db->getResult());
                               foreach($db->getResult() as $row){
                                   //print_r($row);
                                   $count++
                                   ?>
                                            <tr>
                                                <td><?php echo $count; ?></td>
                                                <td style="text-align:center;">
                                                <?php
                                                        $db->select_one('tbl_guest_paper',"paper_name",$row['paper_id']);
                                                        
                                                        foreach($db->getResult() as $row1){
                                                            echo $row1['paper_name'];
                                                        }
                                                    ?>
                                                
                                                </td>
                                                <td>
                                                <?php
                                                        $db->select_one('tbl_guest_subject',"subject_name",$row['subject_id']);
                                                        
                                                        foreach($db->getResult() as $row1){
                                                            echo $row1['subject_name'];
                                                        }
                                                    ?>
                                                
                                                </td>
                                                <td>
                                                    <?php 

                                                    $db->select_one('tbl_faculty_master',"name",$row['faculty_id']);
                                                        
                                                    foreach($db->getResult() as $row2){
                                                        echo $row2['name'];
                                                    }
                                                    
                                                    ?>
                                                </td>
                                              

                                                    <td style="text-align:center;width:100px">

                                                        <a href="#" style="color:#4164b3" class="edit"
                                                            id="<?php echo $row['id']; ?>" onclick="edit(this.id)"><i
                                                                class="far fa-edit " style="font-size:1.5rem;"></i></a>
                                                        &nbsp;
                                                        <!-- <a href="#" style="color:#e50c0c" id="<?php echo $row['id']; ?>"
                                                            onclick="cnfBox(<?php echo $row['id']; ?>)"><i
                                                                class="far fa-trash-alt "
                                                                style="font-size:1.5rem;"></i></i></a><br> -->
                                                        <label class="switch">
                                                            <input type="checkbox" id = <?php echo $row['id']; ?> class = "chk_<?php echo $row['id']; ?>"  <?php echo ($row['status'] == 1)?'checked':'' ?>> 
                                                            <span class="slider round" id ="status_<?php echo $row['id']; ?>" > <?php echo ($row['status'] == 1)?'active':'inactive' ?></span>
                                                            
                                                        </label>
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
                        <!-- <div class="warning">
                            <p>Are you sure you want to do this Operation?</p>
                            <p class="text-warning"><small>This action cannot be undone.</small></p>
                        </div> -->
                        <p id="m_body"></p>
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


$('input[type="checkbox"]').click(function(){

    
    id = $(this).attr('id');

    if ($(this).is(':checked')) {
     
        $(`#status_${id}`).text('active');
        cnfBox(id,'active');
    }else{
        cnfBox(id, 'inactive')
        $(`#status_${id}`).text('inactive');
    }
   
})

$('#paper_id').on('change', function() {
    var paper_id = $(this).val();
    //alert(paper_id);
    var faculty_id = $('#faculty_id').val();

    $.ajax({
        type: "POST",
        url: "ajax_master.php",

        data: {
            action: "subjecToFaculty",
            paper_id: paper_id,
            faculty_id:faculty_id,
            table: "tbl_guest_subject",
            
        },
        success: function(res) {
            console.log(res);
            $('#subject_id').html(res);
        }
    })

})

$('#faculty_id').on('change', function() {
    var faculty_id = $(this).val();
    //alert(paper_id);

    $.ajax({
        type: "POST",
        url: "ajax_search.php",

        data: {
            action: "subjecAssignToFaculty",
            faculty_id: faculty_id,
            table: "tbl_guest_faculty",
            
        },
        success: function(res) {
            console.log(res);

            $('#sub_tbl').html(res);
            $('#sub_tbl').show(res);
            
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
        action: "edit_facultySubject",
        table: "tbl_guest_faculty_master",
        edit_id: id

    },
    success: function(res) {
        console.log(res);
        res.map((data) => {

                $('#update_id').val(data.id);
                $('#paper_id').val(data.paper_id);
                $('#subject_id').html(`<option value="${data.subject_id}" >${data.subject_name}</option>`);
                $('#guest_faculty_id').val(data.guest_faculty_id);
               
               
                $('#save').html('Update');
                $('#save').attr('id', 'update');
                $('#termModal').modal('show');
            }

        )

    }
})
}

function cnfBox(id,status) {
    //alert(id);
    console.log(status);
    let title = (status == 'active')?'Active Record':'Inactive Record';

    $('#m_footer').empty();
    $('#m_title').empty();
    $('#m_body').empty();

    $('#m_title').append(title);
    $('#m_body').append(`Are you sure you want to ${status} this Record? `);

    var html =
        `<input type="button" class="btn btn-danger btn-dlt" value= ${status} onclick="delete_record(${id},'${status}','tbl_guest_faculty')" />`;
    $('#m_footer').append(html);
    $('#cnfModal').modal('show');
}

function delete_record(id,status, tbl) {
   let sts = status;
  let  status_value =  (status == 'active')?'1':'0';
    $.ajax({
        type: "POST",
        url: "ajax_master.php",
        data: {

            action: "delete",
            id: id,
            status_value:status_value,
            table: tbl
        },
        success: function(res) {
            console.log(res);
            if (res == "success") {
                sessionStorage.message = `record ${sts} successfully`;
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