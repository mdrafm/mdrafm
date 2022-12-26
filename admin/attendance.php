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

                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <div class="col-md-3">
                                                    <label><strong>Select Program</strong></label>
                                                </div>
                                                <div class="col-md-7">
                                                    <select class="custom-select mr-sm-2" name="program"
                                                        id="program_id">
                                                        <option value="0" selected>Select Program</option>
                                                        <?php 
                                                        
                                                        $count = 0;
                                                        $db->select('tbl_program_master',"*",null,"trng_type = 1 AND status ='approve'",null,null);
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
                                        <div class="col-md-2">
                                            <label><strong>&nbsp;</strong></label>
                                            <input type="button" class="btn btn-info" onclick="view_class()"
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
    <div id="pptModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="m_title" style="text-align:center;">Upload PPT</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="file" name="ppt_doc" id="ppt_doc" class="form-control"
                                    style="opacity: 1;position: unset;height: 85%;border-radius: 5px;">
                            </div>
                            <div class="col-md-6" id="upload_btn">
                               
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" id="m_footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">

                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="ppfModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="m_title" style="text-align:center;">Upload PDF</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="file" name="pdf_doc" id="pdf_doc" class="form-control"
                                    style="opacity: 1;position: unset;height: 85%;border-radius: 5px;">
                            </div>
                            <div class="col-md-6" id="upload_btn_pdf">
                               
                            </div>
                        </div>
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

function view_class() {
    let program_id = $('#program_id').val();
    // let faculty_name = '<?php echo $_SESSION['name']; ?>';
    let user_id = '<?php echo $_SESSION['user_id']; ?>';
    let username = '<?php echo $_SESSION['username']; ?>';

    $.ajax({
        type: 'POST',
        url: "ajax_search.php",
        data: {
            program_id: program_id,
            user_id: user_id,
            faculty_phone:username,
            action: "view_class"
        },
        success: function(res) {
            console.log(res);
            $('#class_tbl').html(res);
        }

    });
}

function upload_ppt(id, program_id, session) {
    $('#upload_btn').html('');
    $('#upload_btn').html(` <input type="button" class="btn btn-info btn_sm" id="latter_btn"
                                    onclick="upload_ppt_doc(${id},${program_id},${session},'ppt_doc')" value="Upload PPT">`);
    $('#pptModal').modal('show');
}
function upload_pdf(id, program_id, session) {
    $('#upload_btn_pdf').html('');
    $('#upload_btn_pdf').html(` <input type="button" class="btn btn-info btn_sm" id="latter_btn"
                                    onclick="upload_ppt_doc(${id},${program_id},${session},'pdf_doc')" value="Upload PDF">`);
    $('#ppfModal').modal('show');
}

function upload_ppt_doc(id, program_id, session,doc_id) {

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
    form_data.append("action", "upload_ppt_doc");
    form_data.append("type", doc_id);
    form_data.append("tbl_id",id);
    form_data.append("program_id", program_id);
    form_data.append("session", session);
    form_data.append("user_id", <?php echo $_SESSION['user_id'] ?>);
    
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


function remove(id){
    //alert(id);
    if(confirm("Are you sure you want to delete this?")){
        $.ajax({
        type:'POST',
        url:'ajax_master.php',
        data:{action:"remove_report_pptDoc",id:id},
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
    
}


function traneeList(id, program_id, session) {
    console.log(id);
    $.ajax({
        type: 'POST',
        url: "ajax_search.php",
        data: {
            action: "tranee_atn",
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
            action: "tranee_atn_edit",
            timeTable_id: id,
            program_id: program_id,
            session_no: session
            
        },
        success: function(res) {
            console.log(res);
            $('#mailbtn').html('');

            $('#view_tranee').html(res);
            $('#mailbtn').html(` <input type="button" class="btn btn-success" value="Update" onclick="update_attendance(${id})" />
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
    let user_id = <?php echo $_SESSION['user_id']; ?>;

    //alert(timeTable_id);

    // table = $("#tableid").serializeArray();
    TableData = storeTblValues();
    TableData = JSON.stringify(TableData);
    console.log(storeTblValues());

    $.ajax({
        url: 'ajax_attendance.php',
        type: "POST",
        data: {
            'tableData': TableData,
            user_id: user_id,
            session_no: session_no,
            program_id: program_id,
            session_no: session_no,
            timeTable_id: timeTable_id
        },

        success: function(data) {
            console.log(data)
        }
    });
}

function update_attendance(id){
    

    var attendance = [];
    $.each($("input:checkbox[name='atten']:checked"), function() {
        attendance.push($(this).val());
    });
    //alert("We remain open on: " +attendance);

    let update_id = $('#update_id').val();
    let program_id = $('#program_id').val();
    let session_no = $('#session_no').val();
    let user_id = <?php echo $_SESSION['user_id']; ?>;

    //alert(timeTable_id);

    // table = $("#tableid").serializeArray();
    TableData = storeTblValues();
    TableData = JSON.stringify(TableData);
    console.log(storeTblValues());

    $.ajax({
        url: 'ajax_attendance.php',
        type: "POST",
        data: {
            'tableData': TableData,
            user_id: user_id,
            session_no: session_no,
            program_id: program_id,
            session_no: session_no,
            timeTable_id: timeTable_id
        },

        success: function(data) {
            console.log(data)
        }
    });
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