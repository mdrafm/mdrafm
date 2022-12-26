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
                                <h5 class="card-title">Attendance of Trainee</h5>

                            </div>
                            <div class="card-body">
                                <form id="frm_range">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <div class="col-md-3">
                                                    <label><strong> Program</strong></label>
                                                </div>
                                                <div class="col-md-7">
                                                    <select class="custom-select mr-sm-2" name="program_name"
                                                        id="program_id">
                                                        <option value='0' selected>Select Program</option>
                                                        <?php
                                                                   
                                                                    $db->select("tbl_short_program_master","id,trng_type,prg_name,start_date,end_date",null," dept_email = '".$_SESSION['username']."' ",null,null );
                                                                    
                                                                    foreach ($db->getResult() as $row) {
                                                                        ?>
                                                        <option value="<?php echo $row['id'] ?>">
                                                            <?php echo $row['prg_name'] ; ?> </option>

                                                        <?php
                                                                            }
                                                                    
                                                                        ?>

                                                    </select>
                                                </div>


                                            </div>

                                        </div>


                                    </div>

                                    <div class="row">
                                       <div class="col-md-6">
                                            <div class="form-group row select_date">
                                            
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                     <div class="col-md-2"></div>

                                        <div class="col-md-2 btnShowClass">
                                            <!-- <label><strong>&nbsp;</strong></label> -->
                                            
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


    <?php include('common_script.php') ?>

</body>

</html>

<script type="text/javascript">

$('#program_id').on('change', function() {

    let program_id = $('#program_id').val();

    $.ajax({
        type: 'POST',
        url: "ajax_attendance_sponsored.php",
        data: {
            program_id: program_id,
            table : "tbl_short_program_master",
            action: "view_class_duration"
        },
        success: function(res) {
            //console.log(res);
            $('.select_date').html(res);
           

            $('#t_date').on('change', function(){
                let trng_dt = $('#t_date').val();
                $('.btnShowClass').html(`<input type="button" class="btn btn-info" 
                onclick="view_class(${program_id},'${trng_dt}')" value="View Class" />`);
                                                            
            })
        }

    });
});

function view_class(program_id,trng_dt) {
    
    let program_name = $('#program_id option:selected').text();
    let prog_date =    $('#t_date option:selected').text();
    $.ajax({
        type: 'POST',
        url: "ajax_attendance_sponsored.php",
        data: {
            program_id: program_id,
            trng_dt:trng_dt,
            table : "tbl_sponsored_time_table",
            action: "view_attn_classes"
        },
        success: function(res) {
            console.log(res);
           
            $('#class_tbl').html(res);
            $('.attn_header').html(`<p style="font-size: 1.3rem;" >Attendance for ${program_name}</p><p style="font-size: 1.3rem; text-align: center;"> <br> Date: ${prog_date} </p>`);

        }

    });
}


function ExportToExcel(type, fn, dl) {
    var elt = document.getElementById('tbl_attandance');
    var wb = XLSX.utils.table_to_book(elt, {
        sheet: "sheet1"
    });
    return dl ?
        XLSX.write(wb, {
            bookType: type,
            bookSST: true,
            type: 'base64'
        }) :
        XLSX.writeFile(wb, fn || ('TraineeAttaendance.' + (type || 'xlsx')));
}
</script>