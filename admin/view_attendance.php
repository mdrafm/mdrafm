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
                                <h5 class="card-title">View Attendance of Trainee</h5>

                            </div>
                            <div class="card-body">
                                <form id="frm_range">

                                    <div class="row">

                                        <div class="col-md-5">
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
                                        <div class="col-md-5">
                                            <div class="form-group row">
                                                <div class="col-md-3">
                                                    <label><strong>Select Date</strong></label>
                                                </div>
                                                <div class="col-md-7">
                                                   <input type="date" name='attn_date' id="attn_date" class="form-control" placeholder="Select Date" >
                                                </div>


                                            </div>

                                        </div>
                                        <div class="col-md-2">
                                            <label><strong>&nbsp;</strong></label>
                                            <input type="button" class="btn btn-info" onclick="view_attn()"
                                                value="View" />
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

function view_attn() {
    let program_id = $('#program_id').val();
    let attn_date = $('#attn_date').val();
    
   
    $.ajax({
        type: 'POST',
        url: "ajax_search.php",
        data: {
            program_id: program_id,
            attn_date,attn_date,
          
            action: "view_class_attn"
        },
        success: function(res) {
           // console.log(res);
            $('#class_tbl').html(res);
        }

    });
}


function traneeAttnList(id) {
    console.log(id);
    $.ajax({
        type: 'POST',
        url: "ajax_search.php",
        data: {
            action: "tranee_atn_list",
            timeTable_id: id,
            
        },
        success: function(res) {
            console.log(res);
            $('#view_tranee').html(res);

            $('#viewTraneeModal').modal('show');


        }

    });
}


</script>