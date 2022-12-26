<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('header_link.php') ?>

<style type="text/css">
    .table_wrapper{
        margin:20px;
    }
   #year_case th{
        background: #2c3e50ed;
    color: #fff;
    }
    #court th{
        background: #2c3e50ed;
    color: #fff;
    }
    .card-header{
        background: #0d9c5beb;
    
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
    <!-- [ navigation menu ] start -->
    <?php include('sidebar_nav.php') ?>
    <!-- [ navigation menu ] end -->
    <!-- [ Header ] start -->
    <?php include('header_nav.php') ?>
    <!-- [ Header ] end -->



    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Dashboard</h5>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- table card-1 start -->
                <div class="col-md-12 col-xl-4">

                    <!-- widget primary card start -->
                    <div class="card flat-card widget-primary-card">
                        <div class="row-table">
                            <div class="col-sm-3 card-body">
                                <i class="feather icon-star-on"></i>
                            </div>
                            <div class="col-sm-9">
                                <?php 
                           // print_r($_SESSION) 
                           // SELECT COUNT(*) as total_circular FROM `tbl_circular` WHERE dept_id = 10;
                             $db->select('tbl_gst_case_law',"COUNT(*) as total_case",null,"status =1",null,null);
                             foreach($db->getResult() as $case_count){
                                //print_r($circular_count);
                                ?>
                                <!-- <h4>Total BooK</h4>
                                <h6><?php echo $case_count['total_case'] ?></h6> -->
                                <?php
                             }
                            ?>

                            </div>
                        </div>
                    </div>
                    <!-- widget primary card end -->
                </div>
                <!-- table card-1 end -->
                <!-- table card-2 start -->
                <div class="col-md-12 col-xl-4">

                    <!-- widget-success-card start -->
                    <!-- <div class="card flat-card widget-purple-card">
                    <div class="row-table">
                        <div class="col-sm-3 card-body">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="col-sm-9">
                            <h4>17</h4>
                            <h6>Achievements</h6>
                        </div>
                    </div>
                </div> -->
                    <!-- widget-success-card end -->
                </div>
                <!-- table card-2 end -->

                <!-- prject ,team member start -->
               
                <!-- prject ,team member start -->



            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>


    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>

    <!-- Apex Chart -->
    <script src="assets/js/plugins/apexcharts.min.js"></script>


    <!-- custom-chart js -->
    <script src="assets/js/pages/dashboard-main.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

</body>

</html>

<script>
$('#year_case').DataTable();
$('#court').DataTable();



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