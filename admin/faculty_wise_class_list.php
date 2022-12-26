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


            <div class="content" style="margin-top: 50px;">


                <div class="row">
                    <div class="col-md-12">
                       
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                               

                                    <div class="col-md-6">
                                        <h4 class="card-title">Faculty Wise Class List</h4>
                                    </div>

                                </div>
                                <div class="row" style="margin-top:50px;">
                                <div class="col-md-5"> <div class="form-group">
                                        <label><strong>Faculty Type</strong></label>
                                        <div class="form-check form-check-inline"
                                            style="margin-left: 20px;">
                                            <input class="form-check-input" type="radio"
                                                name="faculty" id="active" value="1" >
                                            <label class="form-check-label" for="Inhouse"
                                                style="padding-left: 5px;">Inhouse Faculty</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio"
                                                name="faculty" id="inactive" value="2">
                                            <label class="form-check-label" for="Visiting"
                                                style="padding-left: 5px;">Visiting Faculty</label>
                                        </div>
                                        
                                    </div></div>
                                <div class="col-md-5">
                                    
                                   
                                    <select class="custom-select mr-sm-6 faculty_id_div inhouse" name="faculty_id"
                                             id="faculty_id" style="width:400px">
                                            <option selected value="0">Select Faculty</option>

                                        </select>
                                   
                                </div>
                                <div class="col-md-2">
                                <input type="button" class="btn btn-info" value="View " style="margin-top: 0px" id="class_list" />
                                </div>
                                 
                                </div>


                            </div>
                            <div class="card-body">
                                <div class=" table table-responsive table-striped table-hover" id="tranee_data"></div>
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

 $('#class_list').click(function(){
     
    let faculty_id = $('#faculty_id').val();
    $('#tranee_data').html('');
    $.ajax({
        type: 'POST',
        url:"ajax_search.php",
        data: {faculty_id:faculty_id , action: "faculty_class_list"},
        success: function(res){
            console.log(res);
            $('#tranee_data').html(res);
        }

    });
 })

function edit(id) {

    $.ajax({
        type: "POST",
        url: "ajax_master.php",
        dataType: "json",
        data: {
            action: "edit",
            table: "tbl_new_recruite",
            edit_id: id

        },
        success: function(res) {
            console.log(res);
            res.map((data) => {

                    $('#update_id').val(data.id);
                    $('#trng_type').val(data.trng_type);


                }

            )

        }
    })
}
</script>