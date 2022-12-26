<!DOCTYPE html>
<html lang="en">

<head>

    <?php

        include('header_link.php');
        include('form1_header_link.php');
        include('../config.php');
      
    
   
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

                <div class="row">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="title">Form-I</h5>
                            </div>
                            <?php
                    $id = $_SESSION['user_id'];
                    $sql2 = mysqli_query($db, "SELECT *  FROM `tbl_trainee_info` WHERE `user_id` =".$id);
                    $sql = "SELECT *  FROM `tbl_trainee_info` WHERE `user_id` =".$id;
                    //echo $sql;exit;
                    if(mysqli_num_rows($sql2)>0){

                        while($res = mysqli_fetch_array($sql2)) {
                           // print_r($res);
                ?>
                            <div class="card-body">
                                <form>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong>Name of the Training</strong></label>
                                                <input type="text" disabled class="form-control"
                                                    placeholder=" <?php echo $res['training_name'];?>">

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong>Period of training</strong></label>
                                                <input type="text" disabled class="form-control"
                                                    placeholder="<?php echo $res['period_of_training'];?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong>Name of the Trainee</strong></label>
                                                <input type="text" disabled class="form-control"
                                                    placeholder="<?php echo $res['first_name'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> &nbsp;</label>
                                                <input type="text" disabled class="form-control"
                                                    placeholder="<?php echo $res['last_name'];?>">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong>Father's Name</strong></label>
                                                <input type="text" disabled class="form-control"
                                                    placeholder="<?php echo $res['father_name'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong>Mother's Name</strong></label>
                                                <input type="text" disabled class="form-control"
                                                    placeholder="<?php echo $res['mother_name'];?>">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong> Blood Group</strong></label>
                                                <input type="text" disabled class="form-control" name="t_name"
                                                    placeholder="<?php echo $res['blood_group'];?>">
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong>Date of Birth</strong></label>
                                                <input type="text" disabled class="form-control" name="t_name"
                                                    placeholder="<?php echo date("d-m-Y",strtotime($res['d_o_b']));?>">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong>Educational Qualifications</strong></label>
                                                <input type="text" disabled class="form-control" name="t_name"
                                                    placeholder="<?php echo $res['qualification'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong>Marital Status</strong></label>
                                                <input type="text" disabled class="form-control date-withicon"
                                                    placeholder="<?php echo $res['marital_status'];?>" />
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label style="padding-left: 43%;"><strong>Contact
                                                        Details</strong></label></br>
                                                <label><strong>Parmanent Address</strong></label>
                                                <input type="text" disabled class="form-control"
                                                    placeholder="<?php echo $res['parmanent_addr'];?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 pr-1">
                                            <div class="form-group">
                                                <!-- <label><strong>State</strong></label> -->

                                                <input type="text" disabled class="form-control"
                                                    placeholder="<?php echo $res['state_id'];?>">

                                            </div>
                                        </div>
                                        <div class="col-md-4 px-1">
                                            <div class="form-group">
                                                <!-- <label><strong>District</strong></label> -->
                                                <input type="text" disabled class="form-control"
                                                    placeholder="<?php echo $res['district_id'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4 pl-1">
                                            <div class="form-group">
                                                <!-- <label><strong>Pin Code</strong></label> -->
                                                <input type="number" disabled class="form-control"
                                                    placeholder="<?php echo $res['pr_pin'];?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label><strong>Present Address</strong></label>

                                                <input type="text" disabled class="form-control addr"
                                                    placeholder="<?php echo $res['present_addr'];?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 pr-1">
                                            <div class="form-group">
                                                <!-- <label><strong>State</strong></label> -->
                                                <input type="text" disabled class="form-control addr"
                                                    placeholder="<?php echo $res['p_state'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4 px-1">
                                            <div class="form-group">
                                                <!-- <label><strong>District</strong></label> -->
                                                <input type="text" disabled class="form-control addr"
                                                    placeholder="<?php echo $res['p_dist'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4 pl-1">
                                            <div class="form-group">
                                                <!-- <label><strong>Pin Code</strong></label> -->
                                                <input type="number" disabled class="form-control addr"
                                                    placeholder="<?php echo $res['p_pin'];?>">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong>Mobile Number</strong></label>
                                                <input type="text" disabled class="form-control" name="t_name"
                                                    placeholder="<?php echo $res['mobile'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong>Email</strong></label>
                                                <input type="text" disabled class="form-control" name="t_name"
                                                    placeholder="<?php echo $res['email'];?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label style="padding-left: 43%;"><strong>Bank Details</strong></label>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong>Bank Name</strong></label>
                                                <input type="text" disabled class="form-control" name="t_name"
                                                    placeholder="<?php echo $res['bank_id'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong>Account No.</strong></label>
                                                <input type="text" disabled class="form-control" name="t_name"
                                                    placeholder="<?php echo $res['account_num'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong>IFSC Code</strong></label>
                                                <input type="text" disabled class="form-control" name="t_name"
                                                    placeholder="<?php echo $res['ifsc_code'];?>">
                                            </div>
                                        </div>


                                    </div>


                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label style="padding-left: 43%;"><strong>Health & Medical
                                                        History(indicate if)</strong></label>

                                            </div>
                                        </div>
                                        <div class="form-check">

                                            <?php

$sql3 = mysqli_query($db, "SELECT *  FROM `tbl_medical_info` WHERE `user_id` =".$id);

if(mysqli_num_rows($sql3)>0)
{
   

    while($res1 = mysqli_fetch_array($sql3)) {
         $medical = explode(',', $res1['reason']);

          foreach($medical as $reason){
       
            $sql4 = mysqli_query($db, "SELECT *  FROM `tbl_medical_history` WHERE `id` =".$reason);
            while($res2 = mysqli_fetch_array($sql4)) {
?>

                                            <input type="text" disabled class="form-control" name="t_name"
                                                placeholder="<?php  echo $res2['medical_history']; ?>" />

                                            </label></br>
                                            <?php    }

}

 ?>

                                            <div class="row">

                                                <div class="col-md-6">

                                                    <label for="photo" style="margin-left: 20px;"><strong>Any other
                                                            category/symptom as notified</strong></label>
                                                    <input type="text" disabled class="form-control" name="t_name"
                                                        placeholder="<?php  echo $res1['other']; ?>">

                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="photo" style="margin-left: 20px;"><strong>Whether Differently
                                                    Abled?</strong></label>
                                            <input type="text" disabled class="form-control" name="t_name"
                                                placeholder="<?php  echo $res1['diff_abled']; ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="photo" style="margin-left: 20px;"><strong>Past Service
                                                    experience(If any)</strong></label>
                                            <input style="margin-right: 50%;" type="text" class="form-control"
                                                name="t_name" placeholder="<?php  echo $res1['past_service']; ?>">

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="photo" style="margin-left: 20px;"><strong>Hostel
                                                    Accommodation</strong></label>
                                            <input style="margin-right: 50%;" type="text" class="form-control"
                                                name="t_name" placeholder="<?php  echo $res1['hostel_acc']; ?>">

                                        </div>
                                    </div>
                                    <?php }

}
                    ?>
                                    <div class="row">
                                        <div class="col-md-12">

                                            <label style="padding-left: 43%;"><strong>Upload Dcoumnets</strong></label>
                                        </div>
                                        <?php 

$sql5 = mysqli_query($db, "SELECT *  FROM `tbl_traniee_documents` WHERE `user_id` =".$id);
if(mysqli_num_rows($sql5)>0)
{
   

    while($res5 = mysqli_fetch_array($sql5)) {
        
        ?>
                                        <div class="col-md-6">

                                            <label class="form-check-label" style="padding-top: 20%;"><strong>Passport
                                                    size Photo</strong>
                                            </label>



                                            <a href="uploads/<?php echo $res5['photo'];?>" target="_blank"
                                                class="form-control"><?php echo $res5['photo'];?></a>



                                        </div>
                                        <div class="col-md-6">


                                            <label class="form-check-label" style="padding-top: 20%;"><strong>Joining
                                                    report in OGFR II Form</strong></label>
                                            <a href="uploads/<?php echo $res5['joining_report'];?>" target="_blank"
                                                class="form-control"><?php echo $res5['joining_report'];?></a>
                                        </div>

                                        <div class="col-md-6">

                                            <label class="form-check-label" style="padding-top: 20%;"><strong>Character
                                                    Certificate I & II</strong></label>

                                            <a href="uploads/<?php echo $res5['character_certificate'];?>"
                                                target="_blank"
                                                class="form-control"><?php echo $res5['character_certificate'];?></a>
                                        </div>
                                        <div class="col-md-6">

                                            <label class="form-check-label" style="padding-top: 20%;"><strong>Adhar
                                                    Card/VoterID</strong></label>
                                            <a href="uploads/<?php echo $res5['idproof_type'];?>" target="_blank"
                                                class="form-control"><?php echo $res5['idproof_type'];?></a>
                                        </div>

                                        <div class="col-md-6">

                                            <label class="form-check-label" style="padding-top: 20%;"><strong>PAN
                                                    Card</strong></label>
                                            <a href="uploads/<?php echo $res5['PAN_card'];?>" target="_blank"
                                                class="form-control"><?php echo $res5['PAN_card'];?></a>
                                        </div>

                                        <div class="col-md-6">

                                            <label class="form-check-label" style="padding-top: 20%;"><strong>HSC
                                                    Certificate</strong></label>
                                            <a href="uploads/<?php echo $res5['hsc_certificate'];?>" target="_blank"
                                                class="form-control"><?php echo $res5['hsc_certificate'];?></a>
                                        </div>

                                        <div class="col-md-6">

                                            <label class="form-check-label"
                                                style="padding-top: 20%;"><strong>Non-employment
                                                    Certificate</strong></label>
                                            <a href="uploads/<?php echo $res5['non_employment'];?>" target="_blank"
                                                class="form-control"><?php echo $res5['non_employment'];?></a>
                                        </div>

                                        <div class="col-md-6">

                                            <label class="form-check-label"
                                                style="padding-top: 20%;"><strong>Undertaking/Declaration</strong></label>
                                            <a href="uploads/<?php echo $res5['undertaking_declaration'];?>"
                                                target="_blank"
                                                class="form-control"><?php echo $res5['undertaking_declaration'];?></a>
                                        </div>

                                        <div class="col-md-6">

                                            <label class="form-check-label" style="padding-top: 20%;"><strong>First page
                                                    of Bank Passbook/Cancelled Bank Cheque Leaf</strong></label>
                                            <a href="uploads/<?php echo $res5['bank_passbook'];?>" target="_blank"
                                                class="form-control"><?php echo $res5['bank_passbook'];?></a>
                                        </div>

                                        <div class="col-md-6">

                                            <label class="form-check-label" style="padding-top: 20%;"><strong>PRAN
                                                    Card</strong></label>
                                            <a href="uploads/<?php echo $res5['PRAN_Card'];?>" target="_blank"
                                                class="form-control"><?php echo $res5['PRAN_Card'];?></a>
                                        </div>

                                        <div class="col-md-6">

                                            <label class="form-check-label" style="padding-top: 20%;"><strong>NPS
                                                    Registration form</strong></label>
                                            <a href="uploads/<?php echo $res5['NPS_registration'];?>" target="_blank"
                                                class="form-control"><?php echo $res5['NPS_registration'];?></a>
                                        </div>









                                    </div>



                                    <?php 
}
}?>




                                    <div class="row">
                                        <div class="col-md-5"></div>
                                        <div class="col-md-6">
                                            <?php
                                              if($res['status'] == 0  ){
                                                  ?>
                                                    <input type="button" class="btn btn-primary" name="submitToMdrafm"
                                                value="Submit To MDRAFM"
                                                onclick="submitmdrafm(<?php echo $res['user_id'] ?>)" />
                                                  <?php
                                              }else{
                                                ?>
                                                <input type="button" class="btn btn-success" name="submitToMdrafm"
                                                value="Complete" />
                                            
                                              <?php
                                              }
                                            
                                            ?>
                                           

                                        </div>
                                    </div>
                            </div>
                        </div>


                        </form>
                    </div>
                </div>
            </div>
            <?php }
}?>

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
                        <h5 class="modal-title" id="m_title" style="text-align:center;">Delete Program</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="warning">
                            <p>Are you sure you want to Submit To MDRAFM?</p>
                            <!-- <p class="text-warning"><small>This action cannot be undone.</small></p> -->
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
    <?php include('common_script.php') ?>
    <script type="text/javascript">
    function submitmdrafm(id) {

        //alert(id)

        cnfBox(id)
        //window.location.href="dashboard1.php";

    }

    function cnfBox(id) {
        //alert(id);
        $('#m_footer').empty();
        var html =
            `<input type="button" class="btn btn-danger btn-dlt" value="Submit" onclick="sendToMdrafm(${id},'tbl_trainee_info')" />`;
        $('#m_footer').append(html);
        $('#cnfModal').modal('show');
    }

    function sendToMdrafm(id,tbl){

        $.ajax({
        type: "POST",
        url: "ajax_trainee.php",
        data: {

            action: "send_mdrafm",
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



</body>

</html>