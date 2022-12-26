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
                            <h5>Add Case Type</h5>
                            <div class="card-header-right">
                                <div class="btn-group card-option">
                                <button type="button" class="btn btn-primary m-2" data-toggle="modal"
                                        data-target="#frm_add_new">Add New </button>
                                        
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-md-4">
                                <div id="alert_msg" class="alert alert-success">added successfully</div>
                            </div>
                            <table id="master" class="table">
                                <thead class="" style="background: #315682;color:#fff;">

                                    <th style="width:50px;">Sl No</th>
                                    <th style="width:130px">Case Code </th>
                                    <th style="width:130px">Case Description</th>
                                    <th style="width:50px">Action</th>
                                    
                                </thead>
                                <tbody>
                                    <?php 
                               
                              
                               $count = 0;
                             
                               $db->select("tbl_case_type","*",null,"status=1",'case_code',null);
                              // print_r( $db->getResult());
                              $result = $db->getResult();
                              if($result){
                                    foreach($result as $row){
                                        //print_r($row); 
                                        $count++;
                                       
                                        ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        
                                        <td style="width:100px"><?php echo $row['case_code']; ?></td>
                                        <td style="width:100px"><?php echo $row['case_desc']; ?></td>
                                       
                                        <td style="width:50px">
                                            <a href="#" class="text-primary" id="<?php echo $row['id']; ?> "
                                                data-toggle="tooltip" data-placement="top" title="Edit Case Type "
                                                onclick="edit(this.id)"><span class="pcoded-micon"><i
                                                        class="feather icon-edit"
                                                        style="font-size: 1.7rem;"></i></span></a>
                                            <a href="#" class="text-danger" id="<?php echo $row['id']; ?> "
                                                onclick="delete_alert(this.id)" data-toggle="tooltip"
                                                data-placement="top" title="Delete Case Type"><span class="pcoded-micon"><i
                                                        class="feather icon-trash"
                                                        style="font-size: 1.7rem;"></i></span></a>
                                        </td>
                                       
                                    </tr>
                                    <?php
                                    }
                              }else{
                                echo "No Record Found";
                              }
                               
                      
                               
                              ?>

                                </tbody>
                            </table>
                           
                        </div>
                    </div>
                </div>
                <!-- [ sample-page ] end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->
    <div id="frm_add_new" class="modal fade"  role="dialog" aria-labelledby="alert_boxLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ADD NEW Case Type</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div id="circular_frm">
                        <form id="frm_add">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Case Code</label></div>
                                <div class="col-md-6">
                                    <input class="form-control me-2" type="text" name="case_code" id="case_code"
                                    placeholder="Enter Case Code" required>
                                    <small class="text-danger"></small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><label>Case Description</label></div>
                                <div class="col-md-6">
                                    <input class="form-control me-2" type="text" name="case_desc" id="case_desc"
                                    placeholder="Enter Case Description" required>
                                    <small class="text-danger"></small>
                                </div>
                            </div>
                           
                        </div>
                           
                            <input type="hidden" id="update_id" value="" />
                            </from>
                            <div class="form-group d-flex justify-content-center mt-3">

                                <!-- <input type="button" class="btn btn-primary" value="Save " onclick="add()" /> -->
                            </div>
                    </div>
                </div>
                <div class="modal-footer " id="footer">

                    <button type="button" class="btn  btn-success" onclick="add()" id="btn_save">Save </button>
                    <button type="button" class="btn  btn-warning" onclick="add()" id="btn_update"
                        style="display:none">Update </button>
                    <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
const caseCodeaEl = document.querySelector('#case_code');
const caseDescEl = document.querySelector('#case_desc');

$(document).ready(function() {
    // $('#broad_area').select2({
    //     placeholder: "Select a Broad Area",
    //     allowClear: true,

    // });
    // $('#section_gst_act').select2({
    //     placeholder: "Select a Section under GST Act",
    //     allowClear: true,

    // });

    // $('#rule_gst_act').select2({
    //     placeholder: "Select Rules GST Act",
    //     allowClear: true,

    // });

    $('#master').DataTable();

    $("#order_date").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0"
    });
});


function add() {

    let isCaseCodeatValid = checkTextField(caseCodeaEl),
        isCaseDescValid = checkTextField(caseDescEl)
    let isFormValid = isCaseCodeatValid && isCaseDescValid;
    if (isFormValid) {

        var form_data = new FormData(document.querySelector('form'));
        let update_id = $('#update_id').val();

        form_data.append("action", "add_master");
        form_data.append("update_id", update_id);
        form_data.append("table", "tbl_case_type");


        // console.log(name);
        $.ajax({
            method: "POST",
            url: "ajax_case_master.php",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
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

}

function edit(id) {

    $.ajax({
        type: "POST",
        url: "ajax_gst_case.php",
        data: {
            action: "edit",
            edit_id: id,
            table: "tbl_case_type"

        },
        dataType: "json",
        success: function(res) {
            // console.log(res);
            res.map((data) => {
                console.log(data);
                $('#case_code').val(data.case_code);
                $('#case_desc').val(data.case_desc);
                
                $('#update_id').val(data.id);

                $('#btn_save').hide();
                $('#btn_update').show();
                $('#frm_add_new').modal('show');


            })


        }
    })
}


function delete_alert(id) {

    $('#alert_boxLabel').html("Delete Broad Area");
    $('.alrt_msg').html("Are you sure  want to Delete");
    $('#footer_alert').html(`<button type="button" class="btn  btn-secondary"
                                data-dismiss="modal">Close</button>
                            <button type="button" class="btn  btn-danger" onclick="remove(${id})" >Delete
                                </button>`);
    $('#alert_box').modal('show');
}

function remove(id) {
    $.ajax({
        type: "POST",
        url: "ajax_case_master.php",
        data: {
            action: "remove_case",
            case_id: id,
            table: "tbl_case_type"

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


function add_case() {
    // let isCircularValid = checkTextField(circularEl),
    //     iscircularSubjectValid = checkTextField(circularSubjectEl),
    //     isdateValid = checkTextField(date_picker);


    // let file_name = document.getElementById("circular_file").files;
    // iscircularFileValid = chkFile(file_name);
    // console.log(iscircularFileValid)


    // let isFormValid = isCircularValid &&
    //     iscircularSubjectValid &&
    //     isdateValid && iscircularFileValid;
    let isFormValid = true;

    if (isFormValid) {

        var name = document.getElementById("case_file").files[0].name;

        var form_data = new FormData(document.querySelector('form'));
        // console.log(name);
        var ext = name.split('.').pop().toLowerCase();
        if (jQuery.inArray(ext, ['pdf']) == -1) {
            alert("Invalid Circular File");
        } else {

        }

        form_data.append("action", "add_case");

        // console.log(name);
        $.ajax({
            method: "POST",
            url: "ajax_gst_case.php",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                console.log(res);

                let elm = res.split('#');
                if (elm[0] == "success") {
                    sessionStorage.message = elm[1];
                    sessionStorage.type = "success";
                    location.reload();
                }

                // if (elm[0] == "dup") {
                //     $('#circularNo_err').html('Circular Number Already Present');
                // }
            }
        })
    }

}
</script>