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
                                <h5 class="card-title">Close Programme </h5>

                            </div>
                            <div class="card-body">
                                <form id="frm_range">

                                   <div class="row">
                                       <div class="col-md-6">
                                            <div class="form-group row select_date">
                                                <div class="col-md-3">
                                                    <label><strong> Program Type</strong></label>
                                                </div>
                                                <div class="col-md-7">

                                                <select class="custom-select mr-sm-2" name="program_type"
                                                        id="program_type">
                                                        <option value='0' selected>Select Program</option>
                                                        <?php
                                                                   
                                                                    $db->select("tbl_training_type","id,type",null,null,null,null );
                                                                    
                                                                    foreach ($db->getResult() as $row) {
                                                                        ?>
                                                        <option value="<?php echo $row['id'] ?>">
                                                            <?php echo $row['type'] ; ?> </option>

                                                        <?php
                                                                            }
                                                                    
                                                                        ?>

                                                    </select>
                                               </div>
                                            </div>

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
    <div id="cnfModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="m_title" style="text-align:center;">Close Program</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="warning">
                            <p class="wrn_msg"></p>

                        </div>
                        <div id="m_body">
                           <p>Are you sure you want to close the program ?</p>
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

$('#program_type').on('change', function() {

    let program_type = $('#program_type').val();

    $.ajax({
        type: 'POST',
        url: "ajax_close_program.php",
        data: {
            program_type: program_type,
            action: "show_program_list"
        },
        success: function(res) {
            console.log(res);

            $('#class_tbl').html(res);  
           
        }

    });
});

function ViewModal(id,trng_type){
        if(trng_type == 4){
            $(`#prgram_list_${id}`).modal('show');
        }else{
            $(`#shortTermModalSponsored_${id}`).modal('show');
        }
    }

function cnfBox(program_id,program_type){
     $('#m_footer').html('');
     $('#m_footer').html(` <input type="button" class="btn btn-success approve_btn"   onclick='close_program(${program_id},${program_type})' value="Approve">
                           <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                           <div class="loader" >
                            <img src="assets/img/loader.gif" alt="Loading" style="width: 300px;height: 90px;"/>
                        </div>
                           `);
     $('#cnfModal').modal('show');
}

function close_program(program_id,program_type){
    
    $.ajax({
        type: 'POST',
        url: "ajax_close_program.php",
        data: {
            program_id:program_id,
            program_type: program_type,
            table:"tbl_short_program_master",
            action: "close_program"
        },
         beforeSend: function(){
                  $('.loader').show();
                  $('.approve_btn').hide();
                //  $('#send_email').prop('disabled', true);
                },
        success: function(res) {
            console.log(res);
            if (res == "success") {
                sessionStorage.message = "Program Closed";
                sessionStorage.type = "success";
                location.reload();
            }
        }

    });

}

</script>