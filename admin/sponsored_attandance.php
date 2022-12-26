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


            <div class="content">


                <div class="row" style="margin-top:50px">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Attendance of Trainee</h5>

                            </div>
                            <div class="card-body">
                                <form id="frm_range">

                                    <div class="row">
                                    <?php 
                                        $porg_id = '';
                                        $trng_type = 0;
                                        $db->select("tbl_short_program_master","id,trng_type,prg_name,start_date,end_date",null," active=1 AND dept_email = '".$_SESSION['username']."' ",null,null );
                                        foreach ($db->getResult() as $row) {
                                            $porg_id = $row['id'];
                                            $trng_type = $row['trng_type'];
                                        }

                                    ?>
                                       
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <div class="col-md-3">
                                                    <label><strong>Select Date</strong></label>
                                                </div>
                                                <div class="col-md-7">
                                                    <select class="custom-select mr-sm-2" name="t_date" id="t_date">
                                                        <option value='0' selected>Select Date</option>
                                                        <?php
                                                                    $begin = new DateTime( $row["start_date"] );
                                                                    $end   = new DateTime( $row["end_date"] );
                                                                    
                                                                    for($i = $begin; $i <= $end; $i->modify('+1 day')){
                                                                        ?>

                                                        <option><?php echo $i->format("Y-m-d"); ?> </option>
                                                    <?php
                                                                }
                                                                
                                                                ?>

                                                </select>
                                                </div>


                                            </div>

                                        </div>
                                        <div class="col-md-2">
                                            <label><strong>&nbsp;</strong></label>
                                            <input type="button" class="btn btn-info" onclick="view_class(<?php echo $trng_type ?>)"
                                                value="View Class" />
                                        </div>

                                    </div>

                                </form>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="row" style="margin-top:20px">
                    <div class="col-md-12">

                        <div class="card">

                            <div class="card-body">

                                <div class="row">

                                    <div id="class_tbl" class=" table table-responsive table-striped table-hover"
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

    </div>

    <!-- msgBox Modal Modal HTML -->
    <div id="viewTraneeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content" style="width:160%; margin:120px -60px">
                <form id="attandance">
                    <div class="modal-header">
                        <h5 class="modal-title" id="m_title" style="text-align:center;">Attandance </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">

                        <div id="view_tranee"></div>


                    </div>
                    <div class="modal-footer" id="mailbtn">
                        <input type="button" class="btn btn-success" value="Save" onclick="save_attendance()" />
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel" />

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- msgBox Modal Modal HTML -->
    <!-- msgBox Modal Modal HTML -->
    <div id="cnfModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="m_title" style="text-align:center;">Attendance Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="warning">
                            <p>Once Approved Attendance Can't Be Modified ...</p>
                           
                        </div>
                        <p id="m_body"></p>
                    </div>
                    <div class="modal-footer" id="m_footer">
                        

                    </div>
                </form>
            </div>
        </div>
    </div>
    

    <?php include('common_script.php') ?>

</body>

</html>

<script type="text/javascript">

function view_class(trng_type) {
    let program_id = <?php echo $porg_id; ?>;
   
    var trng_dt = $('#t_date').val();
    
    $.ajax({
        type: 'POST',
        url: "ajax_search.php",
        data: {
            program_id: program_id,
            trng_dt: trng_dt,
            trng_type: trng_type,
            action: "view_sponsored_class"
        },
        success: function(res) {
           
            $('#class_tbl').html(res);
        }

    });
} 

function traneeList(id, program_id, session) {
    console.log(id);
    $.ajax({
        type: 'POST',
        url: "ajax_search.php",
        data: {
            action: "sponsored_tranee_atn",
            timeTable_id: id,
            program_id: program_id,
            session_no: session
        },
        success: function(res) {
            console.log(res);
            $('#view_tranee').html(res);

            $('#viewTraneeModal').modal('show');

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


        }

    });
}

function tranieList_edit(id,program_id, session) {
    console.log(id);
    $.ajax({
        type: 'POST',
        url: "ajax_search.php",
        data: {
            action: "sponsored_tranee_atn_edit",
            timeTable_id: id,
            program_id: program_id,
            session_no: session
            
        },
        success: function(res) {
            console.log(res);
            $('#mailbtn').html('');

            $('#view_tranee').html(res);
            $('#mailbtn').html(` <input type="button" class="btn btn-success" value="Update" onclick="update_attendance(${id},${program_id})" />
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel" />`);
            $('#viewTraneeModal').modal('show');

            $('input[type="checkbox"]').on('change', function() {
                var checkedValue = $(this).prop('checked');
                // uncheck sibling checkboxes (checkboxes on the same row)
                $(this).closest('tr').find('input[type="checkbox"]').each(function() {
                    $(this).prop('checked', false);
                });
                $(this).prop("checked", checkedValue);

            });


        }

    });
}


function save_attendance() {


    var attendance = [];
    $.each($("input:checkbox[name='atten']:checked"), function() {
        attendance.push($(this).val());
    });
    //alert("We remain open on: " +attendance);

    let timeTable_id = $('#timeTable_id').val();
    let program_id = $('#program_id').val();
    let session_no = $('#session_no').val();
   

    //alert(timeTable_id);

    // table = $("#tableid").serializeArray();
    TableData = storeTblValues();
    TableData = JSON.stringify(TableData);
    //console.log(storeTblValues());

    $.ajax({
        url: 'ajax_attendance_sponsored.php',
        type: "POST",
        data: {
            'tableData': TableData,
            action:'save_attendance',
            session_no: session_no,
            program_id: program_id,
            session_no: session_no,
            timeTable_id: timeTable_id
        },

        success: function(res) {
            let elm = res.split('#');
            if (elm[0] == "success") {
                sessionStorage.message = elm[1];
                sessionStorage.type = "success";
                location.reload();
            }
        }
    });
}

function cnfBox(time_tbl_id,program_id){
    
    $('#m_footer').empty();
    var html =
        `<input type="button" class="btn btn-success btn-dlt" value="Approve" onclick="final_save_attn(${time_tbl_id},${program_id})" />
        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">`;
    $('#m_footer').append(html);
    $('#cnfModal').modal('show');
}

function final_save_attn(time_tbl_id,program_id) {


$.ajax({
    url: 'ajax_attendance_sponsored.php',
    type: "POST",
    data: {
            action:"final_save_attn",
            timeTable_id: time_tbl_id,
            program_id: program_id,
           
    },

    success: function(res) {
        console.log(res);
        let elm = res.split('#');
        if (elm[0] == "success") {
            sessionStorage.message = elm[1];
            sessionStorage.type = "success";
            location.reload();
        }
    }
});

}

function update_attendance(time_tbl_id,program_id){
    

    var attendance = [];
    $.each($("input:checkbox[name='atten']:checked"), function() {
        attendance.push($(this).val());
    });
   
    TableData = storeTblValues();
    TableData = JSON.stringify(TableData);
   

    $.ajax({
        url: 'ajax_attendance_sponsored.php',
        type: "POST",
        data: {
            'tableData': TableData,
            action: 'update_attendance',
            time_tbl_id: time_tbl_id,
            program_id: program_id,
           
        },

        success: function(res) {
            let elm = res.split('#');
            if (elm[0] == "success") {
                sessionStorage.message = elm[1];
                sessionStorage.type = "success";
                location.reload();
            }
        }
    });
}

function attn_report(time_tbl_id,program_id,session_no){

    $.ajax({
        url: 'ajax_search.php',
        type: "POST",
        data: {
            action: 'trainee_attendance_report',
            timeTable_id: time_tbl_id,
            session_no:session_no,
            program_id: program_id,
            table: 'tbl_sponsored_attendance'
           
        },

        success: function(res) {
           // console.log(res);
            $('#mailbtn').html('');
            $('#m_title').html('');


            $('#view_tranee').html(res);
            $('#m_title').html('<p class="text-center"> Attendance Report</p>');

            $('#mailbtn').html(`<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel" />`);
                        
            $('#viewTraneeModal').modal('show');
        }
    });
}
function ExportToExcel(type, fn, dl) {
       var elt = document.getElementById('tbl_attandance');
       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('TraineeAttaendance.' + (type || 'xlsx')));
    }

function storeTblValues() {
    var TableData = new Array();
    $('#tbl_attandance tr').each(function(row, tr) {
        TableData[row] = {
            "name": $(tr).find('td:eq(1)').text(),
            "email": $(tr).find('td:eq(2)').text(),
            "phone": $(tr).find('td:eq(3)').text(),
            "attandance": $(tr).find('input[type="checkbox"]:checked').val()

        }
    });
    TableData.shift(); // first row will be empty - so remove
    return TableData;
}
</script>