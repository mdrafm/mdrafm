<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('header_link.php') ?>
    <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css'
        rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/fontawesome.min.css"
        integrity="sha512-RvQxwf+3zJuNwl4e0sZjQeX7kUa3o82bDETpgVCH2RiwYSZVDdFJ7N/woNigN/ldyOOoKw8584jM4plQdt8bhA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        width: 95%;
        margin: 0 auto;
        padding: 20px;
        box-shadow: rgb(50 50 93 / 25%) 0px 2px 5px -1px, rgb(0 0 0 / 30%) 0px 1px 3px -1px;
        background-color: #f7f7f7;
        border-radius: 5px;
    }

    #circular_frm input {
        border-radius: 5px;
        /* border: none; */
    }

    #circular_frm select {
        border-radius: 5px;
        /* border: none; */
    }

    small {
        font-size: 1rem;
    }

    label {
        color: black;
        font-size: 1.2rem;
        font-weight: 600;

    }

    .select2-search__field {
        height: 2rem;
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
                            <h5>Add New Case</h5>
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
                        <div class="card-body">
                            <div class="col-md-4">
                                <div id="alert_msg" class="alert alert-success">added successfully</div>
                            </div>
                            <button type="button" class="btn btn-labeled btn-success" style="margin-right: 2.5rem"
                                id="btn_search">
                                <span class="btn-label" style="margin-right:15px"></span>Add New
                            </button>

                            <div id="circular_frm" style="display:none">
                                <?php include ('case_form_template.php'); ?>
                                
                                    <div class="form-group d-flex justify-content-center mt-3">
                                        <input type="button" class="btn btn-primary" value="Submit2 "
                                            onclick="add_case()" />
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
                            <h5> Send For Approval</h5>

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
        </div>
    </div>
    <!-- [ Main Content ] end -->

    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>



</body>

</html>
<script src="assets/js/common.js"> </script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="../../ckeditor/ckeditor.js"> </script>


<script src="../js/case.js"> </script>
<script type="text/javascript">
$('#btn_search').click(function() {
    $('#circular_frm').toggle("down");
   
   
});

CKEDITOR.replace('issue_in_case');
CKEDITOR.replace('court_judgement');

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
        case_status: 'Draft'


    },
    success: function(data) {
        $('.loader').hide();
        console.log(data);
        $('#tbl_case_law').html(data);
        $('#case_law').DataTable();
    }

})
</script>