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


            <div class="content">
              

                <div class="row" style="margin-top:50px">
                      <div>
                            <div id="alert_msg" class="alert alert-success">added successfully</div>
                        </div>
                    <div class="col-md-4">
                    <?php 
                   
                     $prog_id = 0;
                     if(isset($_SESSION['program_id'])){
                        $prog_id = $_SESSION['program_id'];
                     }

                    ?>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Time Table</h4>

                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label><strong>Program</strong></label>
                                                <select class="custom-select mr-sm-2" name="program_id" id="program">
                                                    <option selected>Select Program</option>
                                                    <?php 
                                                                    $db = new Database();
                                                                    $count = 0;
                                                                    $db->select('tbl_program_master',"*",null,'trng_type = 1 OR trng_type = 2 AND active = 1',null,null);
                                                                    // print_r( $db->getResult());
                                                                    foreach($db->getResult() as $row){
                                                                        //print_r($row);
                                                                        $count++
                                                                 ?>
                                                    <option value="<?php echo $row['id'] ?>">
                                                        <?php echo $row['prg_name'] ?>
                                                    </option>

                                                    <?php 
                                                            }
                                                       ?>
                                                </select>
                                            </div>
                                        </div>
                                     
                                        

                                    </div>
                                    <br>

                                </form>
                                <input type="hidden" name="update_id" id="update_id" />
                                

                            </div>
                        </div>
                        <div class="card" id='day_wise' style="display:none">
                            <div class="card-body">
                            <div >
                              
                                    <form method="post" action="dayWise_Modification.php">
                                        <div class="row">
                                            <div><strong>Day wise modifiaction</strong></div><br>
                                            <!-- <div class="col-md-3">
                                            <div>Time Table Name : T2</div>
                                            </div> -->
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <!-- <label><strong>Select Date</strong></label> -->
                                                    <select class="custom-select mr-sm-2" name="t_date" id="t_date">
                                                        <option selected>Select Date</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <input type="hidden" name="tbl_id" id='tbl_id' />
                                            <input type="hidden" name="program_id" id='prog_id' />
                                            <input type="hidden" name="type" id='type' value = "1" />
                                            <div class="col-md-4" id="modify_btn">

                                                <div class="form-group">

                                                    <input type="submit" class="btn btn-info" name="Add" value="Modify"
                                                        id="Modify">

                                                </div>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-8">
                    <div class="row" >
                    <div class="card">
                    <h4 class="card-title">Add Time Table</h4>
                        <div class="card-body">
                            <form id="frm_range" method="post" >
                                
                                <div class="row">
                                   
                                        <div class="col-md-3"> 
                                            <div class="form-group">
                                                <label><strong>Time Table Name</strong></label>
                                                <input type="text" class="form-control" id="name" name="name">
                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><strong>From Date</strong></label>
                                                <input type="date" class="form-control" id="from_dt" name="from_dt">
                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><strong>To Date</strong></label>
                                                <input type="date" class="form-control" id="to_dt" name="to_dt">
                                            </div>

                                        </div>
                                        <!-- <input type="hidden" name="type" id="trnng_type"  /> -->
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>&nbsp;</label>
                                                <input type="button" class="btn btn-primary" name="Add" value="Add"
                                                    id="save" style="margin-top: 25px;"
                                                    onclick="add('Time Range','frm_range','tbl_time_table_range')">
                                            </div>

                                        </div>
                                </div>
                                    
                               
                            </form>
                        </div>
                    </div>
                </div>
                    </div>

                </div>
               
                <div class="row" style="margin-top:10px">
                    <div class="card">
                       
                        <div class="card-body">
                            <form method="post" action='view_full_time_table.php'>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><strong>Program</strong></label>
                                            <select class="custom-select mr-sm-2" name="program_id" id="program">
                                                <option selected>Select Program</option>
                                                <?php 
                                                $db = new Database();
                                                $count = 0;
                                                $db->select('tbl_program_master',"*",null,"trng_type = 1 AND status = 'approve' ",null,null);
                                                // print_r( $db->getResult());
                                                foreach($db->getResult() as $row){
                                                    //print_r($row);
                                                    $count++
                                            ?>
                                                <option value="<?php echo $row['id'] ?>">
                                                    <?php echo $row['prg_name'] ?>
                                                </option>

                                                <?php 
                                                            }
                                                       ?>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <input type="submit" class="btn btn-info" name="Add" style="margin-top:25px"
                                            value="View Full Time Table ">

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
           
                <div class="row" style="margin-top:30px">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"></h4>
   
                            </div>
                            <div class="card-body">
                             
                                <div id="show_time_table" class=" table table-responsive table-striped table-hover"
                                    style="width:95%;margin:0px auto">
                                 
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
    let prog_id = <?php echo $prog_id ?>;
   
   
    if(prog_id > 0){
        $('#program').val(prog_id);
        $.ajax({
            type: "POST",
            url: "ajax_timetable.php",
            data: {

                action: "time_table_list",
                program_id: prog_id,
               
            },
            success: function(res) {
                //console.log(res);
                $('#show_time_table').html(res);
            }
        })
    }

    $('#program').on('change', function(){
        let program_id = $('#program').val();
        
        $.ajax({
            type: "POST",
            url: "ajax_timetable.php",
            data: {

                action: "time_table_list",
                table:'tbl_program_master',
                program_id: program_id,
               
            },
            success: function(res) {
                //console.log(res);
                $('#show_time_table').html(res);
            }
        })

    })
function sendToApprove(id, tbl) {
    if (confirm(' You want to Send this Program to Course Director For Approval')) {
        $.ajax({
            type: "POST",
            url: "ajax_master.php",
            data: {

                action: "timeTable_approval",
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
    } else {
        return false;
    }
}


function add(str, frm, tbl) {

    var  program_id = $('#program').val();
    var   update_id = $('#update_id').val();

    $('#show_time_table').html('');
    $.ajax({
        type: "POST",
        url: "ajax_timetable.php",

        data: $('#' + frm).serialize() + '&' + $.param({
             'action': 'add_timetable_range',
             'program_id' : program_id,
             'table': tbl,
             'update_id': update_id
        }),
        success: function(res) {
         console.log(res);   
            let elm = res.split('@');
           // console.log(elm);
            if (elm[1] == "success") {
                $('#name').val('');
                $('#from_dt').val('');
                $('#to_dt').val('');

                $('#update').val('Add');
                $('#update').attr('id','save');
                $('#alert_msg').html(elm[2]);
                $('#alert_msg').show();
                closeAlertBox();
                $('#show_time_table').html(elm[0]);
                
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
            table: "tbl_time_table_range",
            edit_id: id

        },
        success: function(res) {
            console.log(res);
            res.map((data) => {

                    $('#update_id').val(data.id);
                    // $('#program').val(data.program_id);
                    $('#name').val(data.name);
                    $('#from_dt').val(data.from_dt);
                    $('#to_dt').val(data.to_dt);
                    $('#type').val(data.type);
                    $('#tbl_id').val(data.id);
                    $('#prog_id').val(data.program_id)
                    $.ajax({
                        type: "POST",
                        url: "ajax_master.php",
                        data: {

                            action: "timeTable_date",
                            table_name: data.id

                        },
                        success: function(res) {
                            console.log(res);
                            $('#t_date').html(res);

                        }
                    })
                    $('#day_wise').show();
                    $('#save').val('Update');
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
        `<input type="button" class="btn btn-danger btn-dlt" value="Delete" onclick="delete_record(${id},'tbl_time_table_range')" />`;
    $('#m_footer').append(html);
    $('#cnfModal').modal('show');
}

function delete_record(id, tbl) {

    $.ajax({
        type: "POST",
        url: "ajax_timetable.php",
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