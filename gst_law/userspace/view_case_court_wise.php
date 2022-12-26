<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('header_link.php') ?>
    <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css'
        rel='stylesheet'>
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />

    <style>
    #alert_msg {
        position: absolute;
        z-index: 1400;
        top: 2%;
        /* right:4%; */
        margin: 40px;
        text-align: center;
        background: #2c8a2c;
        color: #fff;
        display: none;
    }

    #circular_frm {
        width: 70%;
        margin: 0 auto;
        padding: 20px;
        box-shadow: rgb(50 50 93 / 25%) 0px 2px 5px -1px, rgb(0 0 0 / 30%) 0px 1px 3px -1px;
        background-color: #77bfb4;
        border-radius: 5px;
    }

    #edit_circular_frm {
        width: 70%;
        margin: 0 auto;
        padding: 20px;
        box-shadow: rgb(50 50 93 / 25%) 0px 2px 5px -1px, rgb(0 0 0 / 30%) 0px 1px 3px -1px;
        background-color: #77bfb4;
        border-radius: 5px;
    }

    small {
        font-size: 1rem;
    }
    </style>
</head>

<body class="">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <?php include('sidebar_nav.php') ?>
    <!-- [ Header ] start -->
    <?php include('header_nav.php') ?>
    <!-- [ Header ] end -->

    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-content">

            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- [ sample-page ] start -->

                <div class="col-sm-12">
                    <div class="card">

                        <div class="card-header">
                            <h5>View Case Year Wise</h5>
                           
                            <div class="card-header-right">
                                <div class="btn-group card-option">
                                    <button type="button" class="btn dropdown-toggle btn-icon" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="feather icon-more-horizontal"></i>
                                    </button>
                                    <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                        <li class="dropdown-item full-card"><a href="#!"><span><i
                                                        class="feather icon-maximize"></i> maximize</span><span
                                                    style="display:none"><i class="feather icon-minimize"></i>
                                                    Restore</span></a></li>
                                        <li class="dropdown-item minimize-card"><a href="#!"><span><i
                                                        class="feather icon-minus"></i> collapse</span><span
                                                    style="display:none"><i class="feather icon-plus"></i>
                                                    expand</span></a></li>
                                        <!-- <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                    <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li> -->
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- [ sample-page ] end -->
            </div>
            <div class="row">

                <div class="col-md-12">
                    <!-- <div class=" table-striped table-hover" id="result_tbl">
                    </div> -->
                    <div class="card table-card">

                        <div class="card-header">
                            <h5>Search Result</h5>

                        </div>
                        <div class="card-body p-0">
                            <div class="loader" style="display: none">
                                <p>Loading Data...</p>
                                <img src="assets/images/loader.gif" alt="Loading"
                                    style="width: 300px;height: 90px;float: right;" />
                            </div>
                            <div id="tbl_case_law" class="table table-responsive table-striped table-hover">

                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div id="edit_case" class="modal fade" role="dialog" aria-labelledby="alert_boxLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" style="width: 200%;margin-left: -40%;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="alert_boxLabel">Edit Case</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <?php include ('case_form_template.php'); ?>
                        </div>
                        <div class="modal-footer " id="footer">

                        </div>
                    </div>
                </div>
            </div>




            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->

    <div id="alert_box" class="modal fade" role="dialog" aria-labelledby="alert_boxLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="alert_boxLabel2"></h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0 alrt_msg">
                    </p>
                </div>
                <div class="modal-footer " id="footer_alert">

                </div>
            </div>
        </div>
    </div>
    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>



</body>

</html>

<script src="assets/js/common.js"> </script>


<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="../js/case.js"> </script>
<script type="text/javascript">
$('#btn_search').click(function() {
    $('#search').toggle("down");
    // $('#search').show();
    $('#view_only').val(1);
});
$('#broadArea').select2({

    placeholder: "Select a Broad Area",
    allowClear: true,
});
$('#section_gst_act').select2({
    dropdownParent: "#modal-container",
    placeholder: "Select a Section under GST Act",
    allowClear: true,

});

$('#rule_gst_act').select2({
    placeholder: "Select Rules GST Act",
    allowClear: true,

});

$("#order_date").datepicker({
    changeMonth: true,
    changeYear: true,
    yearRange: "-100:+0"
});
var court = '<?php echo $_POST["court"] ?>';
$.ajax({
    type: "POST",
    url: "../ajax_master.php",
    beforeSend: function() {
        $('.loader').show();
        //  $('#send_email').prop('disabled', true);
    },
    data: {
        action: "search_case",
        caseNo: '',
        caseType: 0,
        caseYear: '',
        // broadArea:broadArea,
        partyName: '',
        courtName: 0,
        orderDate: '',
        // section_gst_act:section_gst_act,
        // rule_gst_act:rule_gst_act,
        keyword: '',
        view: 1


    },
    success: function(data) {
        $('.loader').hide();
        console.log(data);
        $('#tbl_case_law').html(data);
        $('#case_law').DataTable();
    }

})



function drop_alert(id) {
    $('#alert_boxLabel2').html("Remove Circular File");
    $('.alrt_msg').html("Are you sure  want to Drop this Circular");
    $('#footer_alert').html(`<button type="button" class="btn  btn-secondary"
                                data-dismiss="modal">Close</button>
                            <button type="button" class="btn  btn-danger" onclick="remove(${id})" >Delete
                                </button>`);
    $('#alert_box').modal('show');
}
//drop circular to change circular number 

function remove(id) {
    $.ajax({
        type: "POST",
        url: "ajax_case_master.php",
        data: {
            action: "remove_case",
            case_id: id,
            table: "tbl_gst_case_law"

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
    })
}

function cnf_update() {
    $('#alert_boxLabel').html("Update Circular");
    $('.alrt_msg').html("Are you sure  want to update this Circular");
    $('#footer').html(`<button type="button" class="btn  btn-secondary"
                                data-dismiss="modal">Close</button>
                            <button type="button" class="btn  btn-warning" onclick="update_circular()" >Update
                                </button>`);
    $('#alert_box').modal('show');
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