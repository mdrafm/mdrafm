<!DOCTYPE html>
<html lang="en">

<head>

    <?php
        include('form1_header_link.php');
        include('header_link.php');
        
        include('../config.php');
        include 'database.php';
        $con = new Database();
    //  print_r($_SESSION);
   
        ?>

</head>

<body class="user-profile">

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->





    <div class="wrapper ">

        <?php include('sidebar.php'); ?>

        <div class="main-panel" id="main-panel" style="margin-top:25px">
            <?php include('navbar.php'); ?>

            <div class="panel-header panel-header-sm">


            </div>


            <div class="content">

                <div class="row" style="margin-top: 50px;">
                    <div class="col-md-1">
                        <!-- <button type="button" class="btn btn-info" onclick="history.go(-1);">Back</button> -->
                        <a href="<?php echo $_SERVER['HTTP_REFERER'] ?>">Back</a>
                    </div>
                    <div class="col-md-10">
                      
                  
             </div>




        </div>

     </div>

    <!-- msgBox Modal Modal HTML -->
    <div id="cnfModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="m_title" style="text-align:center;">Accept Trainee</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="warning">
                            <p>Are you sure you want to Trainee?</p>

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


    <!--   Core JS Files   -->
    <script src="assets/js/core/jquery.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>


    <script src="assets/js/core/bootstrap.min.js"></script>


    <link rel="stylesheet" href="../css/bootstrap-datepicker3.css" />
    <script type="text/javascript" src="../js/bootstrap-datepicker.min.js"></script>
    <script>
    $(function() {
        $('.date-withicon').datepicker({
            format: 'mm-dd-yyyy'
        });
    });
    </script>



    <!--  Google Maps Plugin    -->

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGat1sgDZ-3y6fFe6HD7QUziVC6jlJNog"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="../../../buttons.github.io/buttons.js"></script>


    <!-- Chart JS -->
    <script src="assets/js/plugins/chartjs.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/plugins/bootstrap-notify.js"></script>





    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="assets/js/now-ui-dashboard.minaa26.js?v=1.5.0" type="text/javascript"></script>
    <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
    <script src="assets/demo/demo.js"></script>


    <!-- Sharrre libray -->
    <script src="assets/demo/jquery.sharrre.js"></script>

    <?php include('common_script.php') ?>

</body>

</html>

<script type="text/javascript">
function cnfBox(id) {
    //alert(id);
    $('#m_footer').empty();
    var html =
        `<input type="button" class="btn btn-danger btn-dlt" value="Accept" onclick="Accept_trainee(${id},'tbl_trainee_info')" />`;
    $('#m_footer').append(html);
    $('#cnfModal').modal('show');
}


function Accept_trainee(id, tbl) {

    $.ajax({
        type: "POST",
        url: "ajax_trainee.php",
        data: {

            action: "accept_trainee",
            id: id,
            table: tbl
        },
        success: function(res) {
            console.log(res);
            if (res == "success") {
                sessionStorage.message = "Accepted successfully";
                sessionStorage.type = "success";
                location.reload();
            }
        }
    })
}
</script>