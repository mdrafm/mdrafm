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

              
                <div class="row"  style="margin-top:50px">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header">
                                <?php print_r($_POST) ?>
                                <h4 class="card-title">Add Session from </h4>

                            </div>
                            <div class="card-body">
                                <form id="frm_range">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                             <label><strong>From Date</strong></label>
                                             <input type="date" class="form-control" id="from_dt" name="from_dt">
                                         </div>
                                           
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                             <label><strong>To Date</strong></label>
                                             <input type="date" class="form-control" id="to_dt" name="to_dt">
                                            </div>
                                           
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                            
                                             <input type="button" class="btn btn-primary" name="Add" value="Add" onclick="add('Time Range','frm_range','tbl_time_table_range')">
                                            </div>
                                           
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
    $('input[name="faculty"]').click(function(){
        if($(this).is(':checked')){
            //alert($(this).val());
            let id = $(this).val();

            $.ajax({
                    type: "POST",
                    url: "ajax_master.php",

                    data: {
                        faculty_id: id,
                        table: "tbl_faculty_master",
                        action: "select_faculty"
                    },
                    success: function(res) {
                        // console.log(res);
                        $('#faculty_id').html(res);
                    }
            })
        }
    })
$('#paper_id').on('change', function() {
    var paper_id = $(this).val();
    // alert(term_id);

    $.ajax({
        type: "POST",
        url: "ajax_master.php",

        data: {
            paper_id: paper_id,
            table: "tbl_subject_master",
            action: "select_mjr_subject"
        },
        success: function(res) {
            // console.log(res);
            $('#mjr_subject_id').html(res);
        }
    })

})

$('#mjr_subject_id').on('change', function() {
    var subject_id = $(this).val();
    // alert(term_id);
    $('#topic_id').html('');
    $.ajax({
        type: "POST",
        url: "ajax_master.php",

        data: {
            mjr_subject_id: subject_id,
            table: "tbl_subject_master",
            action: "select_topic"
        },
        success: function(res) {
            //console.log(res);
            $('#topic_id').html(res);
        }
    })

})
$('#topic_id').on('change', function() {
    var topic_id = $(this).val();
    // alert(term_id);
    //$('#topic_id').html('');
    $.ajax({
        type: "POST",
        url: "ajax_master.php",

        data: {
            topic_id: topic_id,
            table: "tbl_subject_master",
            action: "select_subject"
        },
        success: function(res) {
            console.log(res);
            $('#subject_id').html(res);
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
            table: "tbl_time_table",
            edit_id: id

        },
        success: function(res) {
            console.log(res);
            res.map((data) => {

                    $('#update_id').val(data.id);
                    $('#program').val(data.program_id);

                    $('#training_dt').val(data.training_dt);
                    $('#session_no').val(data.session_no);
                    $('#class_start_time').val(data.class_start_time);
                    $('#class_end_time').val(data.class_end_time);
                    $('#faculty_id').val(data.faculty_id);
                    $('#term_id').val(data.term_id);
                    $('#topic_id').val(data.topic_id);
                    // $('#paper_id').html(`<option value="${data.paper_id}"></option>`);
                    $.ajax({
                        type: "POST",
                        url: "ajax_master.php",

                        data: {
                            id: data.paper_id,
                            table: "tbl_paper_master",
                            action: "select_edit"
                        },
                        success: function(res) {
                            console.log(res);
                            $('#paper_id').html(res);
                        }
                    })



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
        `<input type="button" class="btn btn-danger btn-dlt" value="Delete" onclick="delete_record(${id},'tbl_time_table')" />`;
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
</script>