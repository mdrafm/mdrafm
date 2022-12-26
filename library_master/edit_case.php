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
                            <h5>Edit Case</h5>
                            <?php //print_r($_POST) ?>
                            <!-- <div class="card-header-right">
                              <button onclick="history.back()">Go Back</button>
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
                                      
                                    </ul>
                                </div>
                            </div> -->
                        </div>
                        <div class="card-body">
                            <div class="col-md-4">
                                <div id="alert_msg" class="alert alert-success">added successfully</div>
                            </div>

                            <div id="circular_frm">
                                <?php
                                  
                                  $db->select('tbl_gst_case_law','*',null,"id=".$_POST['case_id'],null,null);
                                  foreach($db->getResult() as $row){
                                    ?>
                                <form id="frm_add" enctype="multipart/form-data">
                                    <div class="row">

                                        <div class="form-group col-md-6 ">
                                            <label>Name of the Petitioner :</label>
                                            <input class="form-control me-2" type="search" name="petitioner_name"
                                                id="petitioner_name" placeholder="Enter Name of The Petitioner"
                                                value="<?php echo $row['petitioner_name']?>">
                                            <small class="text-danger" id="petitioner_err"></small>

                                        </div>
                                        <div class="form-group col-md-6 ">
                                            <label>Name of the Opposite Party :</label>
                                            <input class="form-control me-2" type="search" name="opposite_party"
                                                id="opposite_party" placeholder="Enter Name of The Opposite Party"
                                                value="<?php echo $row['opposite_party']?>">
                                            <small class="text-danger" id="oppositeParty_err"></small>

                                        </div>

                                    </div>
                                    <div class="row" style="float: right;">
                                    <div class="form-group col-md-12 ">
                                           <input type="button" class="btn btn-primary" value="Add" id="add_more_case" style="padding: 5px;margin-top: 2.5rem;">
                                    </div>
                                    </div>
                                    <div id="case_ref">
                                    <?php 

                                    $db->select('tbl_case_ref','*',null,'case_id='.$row['id'],null,null);
                                    foreach($db->getResult() as $ref){
                                      // print_r($ref);
                                       ?>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Case Type</label>
                                            <select class="form-control " name="case_type[]" id="case_type"
                                                style="width: 100%;">

                                                <option value="0">Select Case Type</option>
                                                <?php
                                        // print_r($_SESSION);
                                                $db->select('tbl_case_type',"*",null,null,null,null);
                                            //  print_r( $db->getResult());
                                                foreach($db->getResult() as $type){
                                                    ?>

                                                <option value="<?php echo $type['id'] ?>"
                                                    <?php echo ($ref['case_type'] == $type['id'])?'selected':'' ?>>
                                                    <?php echo ($type['case_desc'] == '')?$type['case_code']:$type['case_code'].'-'.$type['case_desc'] ?>
                                                </option>
                                                </option>
                                                <?php
                                                }

                                            ?>

                                            </select>

                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Case Number :</label>
                                            <input class="form-control me-2" type="text" name="case_no[]" id="case_no"
                                                placeholder="Enter Case Number" value="<?php echo $ref['case_no'] ?>"
                                                required>
                                            <small class="text-danger" id="caseNo_err"></small>

                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Case Year</label>
                                            <select class="form-control " name="case_year[]" id="case_year"
                                                style="width: 100%;">

                                                <option value="0">Select Case Year</option>
                                                <?php
                                         // print_r($_SESSION);
                                                $db->select('tbl_case_type',"*",null,null,null,null);
                                            //  print_r( $db->getResult());
                                            $years = [2022,2021,2020,1999,1998,1997,1996,1995,1994,1993,1992,1991,1991];
                                                foreach($years as $year){
                                                    ?>

                                                <option value="<?php echo $year ?>"
                                                    <?php echo ($ref['case_year'] == $year)?'selected':'' ?>>
                                                    <?php echo $year ?>
                                                </option>
                                                <?php
                                                }

                                            ?>

                                            </select>

                                        </div>
                                        <input type="hidden" name="ref_id[]" value="<?php echo $ref['id'] ?>">
                                        <div class="form-group col-md-2">
                                           <input type="button" class="btn btn-danger" value="REMOVE" onclick="remove_case_ref(<?php echo $ref['id'] ?>)" style="padding: 5px;margin-top: 2.5rem;">
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    
                                    ?>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Name of Court which has passed the Judgement</label>
                                            <select class="form-control " name="court_name" id="court_name"
                                                style="width: 100%;">

                                                <option value="0">Select Court Name</option>
                                                <?php
                                           
                                                $db->select('tbl_court',"*",null,null,null,null);
                                               
                                                foreach($db->getResult() as $court){
                                                    ?>
                                                <option value="<?php echo $court['id'] ?>"
                                                    <?php echo ($row['court_name'] == $court['id'])?'selected':'' ?>>
                                                    <?php echo $court['court_name'] ?>
                                                </option>
                                                <?php
                                                }

                                            ?>

                                            </select>

                                        </div>

                                        <div class="from-group col-md-6">
                                            <label>Date of Order</label>
                                            <input type="text" class="form-control" id="order_date" name="order_date"
                                                placeholder="Order Date" value="<?php echo $row['order_date'] ?>"
                                                autocomplete="off">
                                            <small class="text-danger"></small>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="form-group col-md-6">
                                            <label>Broad Area</label>
                                            <select class="form-control form-select " name="broad_area[]"
                                                id="broad_area" style="width: 100%;" multiple="multiple">

                                                <option value="0">Select Broad Area</option>
                                                <?php
                                                $db->select('tbl_broad_area',"*",null,null,"broad_area",null);
                                                foreach($db->getResult() as $broad){
                                                    ?>
                                                <option value="<?php echo $broad['id'] ?>"
                                                    <?php echo ($row['broad_area'] == $broad['id'])?'selected':'' ?>>
                                                    <?php echo $broad['broad_area'] ?>
                                                </option>
                                                <?php
                                                }

                                            ?>

                                            </select>

                                        </div>


                                        <div class="form-group col-md-6">
                                            <label>Section Under GST Act</label>
                                            <select class="form-control " name="section_gst_act[]" id="section_gst_act"
                                                style="width: 100%;" multiple="multiple">

                                                <option value="0">Select Section Under GST Act</option>
                                                <?php
                                      // print_r($_SESSION);
                                            $db->select('tbl_section_gst_act',"*",null,null,"section",null);
                                           //  print_r( $db->getResult());
                                            foreach($db->getResult() as $section){
                                                ?>
                                                <option value="<?php echo $section['id'] ?>"
                                                    <?php echo ($row['section_gst_act'] == $section['id'])?'selected':'' ?>>
                                                    <?php echo $section['section'] ?>
                                                </option>
                                                <?php
                                            }

                                        ?>

                                            </select>

                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Rule Under GST Act</label>
                                            <select class="form-control " name="rule_gst_act[]" id="rule_gst_act"
                                                style="width: 100%;" multiple="multiple">

                                                <option value="0">Select Rule Under GST Act</option>
                                                <?php
                                           // print_r($_SESSION);
                                            $db->select('tbl_rule_gst_act',"*",null,null,"rules",null);
                                           //  print_r( $db->getResult());
                                            foreach($db->getResult() as $rule){
                                                ?>
                                                <option value="<?php echo $rule['id'] ?>"
                                                    <?php echo ($row['rule_gst_act'] == $rule['id'])?'selected':'' ?>>
                                                    <?php echo $rule['rules'] ?>
                                                </option>
                                                <?php
                                            }

                                          ?>

                                            </select>

                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Government Circulars/Notifications :</label>
                                            <input class="form-control me-2" type="text" name="govt_circular"
                                                id="govt_circular" placeholder="Enter govt Circulars/Notifications"
                                                value="<?php echo $row['govt_circular'] ?>" required>
                                            <small class="text-danger" id="govyCirculars_err"></small>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>issue raised/Addresed in the Case</label>

                                            <textarea class="form-control" name="issue_in_case" id="issue_in_case"
                                                placeholder="Enter issue raised/Addresed in the Case "
                                                rows="5"><?php echo $row['issue_in_case'] ?></textarea>
                                            <small class="text-danger"></small>

                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Court Judgement in Brief</label>

                                            <textarea class="form-control" name="court_judgement" id="court_judgement"
                                                placeholder="Enter Court Judgement"
                                                rows="5"><?php echo $row['court_judgement'] ?></textarea>
                                            <small class="text-danger"></small>

                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="form-group col-md-6">
                                            <label>Case File</label>
                                            <?php
                                              if($row['case_file']==''){
                                                $flag = 1;
                                                ?>
                                            <input type="file" class="form-control" id="case_file" name="case_file"
                                                placeholder="Case File" autocomplete="off">
                                            <?php
                                              }else{
                                                $flag = 2;
                                                $path = "../case_file/".$row['case_file'];
                                                ?>
                                            <div class="file">
                                                <a href="<?php echo $path; ?>" target="_blank" style="color:#c9100c"
                                                    id="edit_case_file"><img src="assets/images/document_pdf.png" />

                                                    case_file</a>
                                                <button type="button" class="btn remove"
                                                    onclick="remove(<?php echo $row['id'] ?>)">
                                                    <img src="assets/images/cross.png" />
                                                </button>
                                            </div>

                                            <?php
                                              }
                                            ?>

                                            <small class="text-danger" id="caseFile_error"></small>
                                        </div>
                                    </div>
                                    <input type="hidden" name="update_id" value="<?php echo $row['id']; ?>">
                                    </from>

                                    <?php
                                  }
                                
                                ?>


                                    <div class="form-group d-flex justify-content-center mt-3">
                                        <input type="button" class="btn btn-primary" value="Update "
                                            onclick="update_case(<?php echo $flag ?>)" />
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ sample-page ] end -->
            </div>
            <div id="alert_box" class="modal fade" role="dialog" aria-labelledby="alert_boxLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="alert_boxLabel"></h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <p class="mb-0 alrt_msg">
                            </p>
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

    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>



</body>

</html>
<script src="assets/js/common.js"> </script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="../../ckeditor/ckeditor.js"> </script>
<script type="text/javascript">
const circularEl = document.querySelector('#circular_no');
const circularSubjectEl = document.querySelector('#circular_subject');
const date_picker = document.querySelector('#date_picker');
// const circular_file = document.querySelector('#circular_file');

$(document).ready(function() {
    $('#broad_area').select2({
        placeholder: "Select a Broad Area",
        allowClear: true,

    });
    $('#section_gst_act').select2({
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

    CKEDITOR.replace('issue_in_case');
    CKEDITOR.replace('court_judgement');
});



function update_case(flag) {
    console.log(flag);
    // let isCircularValid = checkTextField(circularEl),
    //     iscircularSubjectValid = checkTextField(circularSubjectEl),
    //     isdateValid = checkTextField(date_picker);


    // let file_name = document.getElementById("circular_file").files;
    // iscircularFileValid = chkFile(file_name);
    // console.log(iscircularFileValid)


    // let isFormValid = isCircularValid &&
    //     iscircularSubjectValid &&
    //     isdateValid && iscircularFileValid;
    const courtJudgementEl =  CKEDITOR.instances['court_judgement'].getData();
	const issueInCaseaseEl =  CKEDITOR.instances['issue_in_case'].getData(); 

    let isFormValid = true;

    if (isFormValid) {
        if (flag == 1) {

            var name = document.getElementById("case_file").files[0]
            if (name) {
                name = name.name;
                var ext = name.split('.').pop().toLowerCase();
                if (jQuery.inArray(ext, ['pdf']) == -1) {
                    alert("Invalid Case File");
                }
            } else {

            }

        }

        var form_data = new FormData(document.querySelector('form'));
        form_data.append("action", "update_case");
        form_data.append("issue_in_case",issueInCaseaseEl);
		form_data.append("court_judgement", courtJudgementEl);
        

        // console.log(name);
        $.ajax({
            method: "POST",
            url: "ajax_gst_case.php",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                console.log(res)

                let elm = res.split('#');
                console.log(elm)
                if (elm.includes("success")) {
                    sessionStorage.message = "Updated Successfully";
                    sessionStorage.type = "success";
                    window.location.replace("add_case.php");

                }

                // if (elm[0] == "dup") {
                //     $('#circularNo_err').html('Circular Number Already Present');
                // }
            }
        })
    }

}

function remove(id) {
    // alert(id);
    $('#alert_boxLabel').html("Remove Case File");
    $('.alrt_msg').html("Are you sure  want to remove this file");
    $('#footer').html(`<button type="button" class="btn  btn-secondary"
                                data-dismiss="modal">Close</button>
                            <button type="button" class="btn  btn-danger" onclick="remove_case(${id})" >Remove
                                </button>`);
    $('#alert_box').modal('show');
}

function remove_case(id) {

    $.ajax({
        type: "POST",
        url: "ajax_gst_case.php",
        data: {
            action: "remove_case",
            case_id: id,

        },
        success: function(res) {
            console.log(res);
            let elm = res.split('#');
            if (elm[0] == "success") {
                $('#alert_box').modal('hide');
                // $('#exist_file').hide();
                // $('#new_file').show();
                location.reload();

            }

        }
    })
}

function remove_case_ref(id){
    $('#alert_boxLabel').html("Remove Case Ref.No row");
    $('.alrt_msg').html("Are you sure  want to remove this file");
    $('#footer').html(`<button type="button" class="btn  btn-secondary"
                                data-dismiss="modal">Close</button>
                            <button type="button" class="btn  btn-danger" onclick="remove_ref(${id})" >Remove
                                </button>`);
    $('#alert_box').modal('show');
}

function remove_ref(id) {

$.ajax({
    type: "POST",
    url: "ajax_gst_case.php",
    data: {
        action: "remove_case_ref",
        ref_id: id,

    },
    success: function(res) {
        console.log(res);
        let elm = res.split('#');
        console.log(elm);
        if (elm[0] == "success") {
            $('#alert_box').modal('hide');
            // $('#exist_file').hide();
            // $('#new_file').show();
            location.reload();

        }

    }
})
}

var cnt = 0;
    $('#add_more_case').click(function(){
       
       cnt++;
  
        $('#case_ref').append( `<div class="row" id="ref_case_div_${cnt}">
            <div class="form-group col-md-4">
                <label>Case Type :</label>
                <select class="form-control " name="new_case_type[]" id="case_type" style="width: 100%;">

                    <option value="0">Select Case Type</option>
                    <?php
                                        // print_r($_SESSION);
                                                $db->select('tbl_case_type',"*",null,'status = 1','case_code',null);
                                            //  print_r( $db->getResult());
                                                foreach($db->getResult() as $type){
                                                    ?>

                    <option value="<?php echo $type['id'] ?>">
                        <?php echo ($type['case_desc'] == '')?$type['case_code']:$type['case_code'].'-'.$type['case_desc'] ?>
                    </option>
                    </option>
                    <?php
                                                }

                                            ?>

                </select>
                <small class="text-danger" id="caseType_err"></small>
            </div>
            <div class="form-group col-md-3">
                <label>Case Number :</label>
                <input class="form-control me-2" type="text" name="new_case_no[]" id="case_no" placeholder="Enter Case Number"
                    onkeypress="return onlyNumbers(event);" required>
                <small class="text-danger" id="caseNo_err"></small>

            </div>
            <div class="form-group col-md-3">
                <label>Case Year :</label>
                <select class="form-control " name="new_case_year[]" id="case_year" style="width: 100%;">

                    <option value="0">Select Case Year</option>
                    <?php
                                        // print_r($_SESSION);
                                                $db->select('tbl_case_type',"*",null,null,null,null);
                                            //  print_r( $db->getResult());
                                            $years = [2022,2021,2020,1999,1998,1997,1996,1995,1994,1993,1992,1991,1991];
                                                foreach($years as $year){
                                                    ?>

                    <option value="<?php echo $year ?>">
                        <?php echo $year ?>
                    </option>
                    <?php
                                                }

                                            ?>

                </select>
                <small class="text-danger" id="caseYear_err"></small>
            </div>
            <div class="form-group col-md-2">
                <input type="button" class="btn btn-danger" value="REMOVE" onclick="remove_ref(${cnt})" style="padding: 5px;margin-top: 2.5rem;">
            </div>
        </div>`);
    })

    function remove_ref(id){
        console.log(id);
        $('#ref_case_div_'+id).remove();
    }
</script>