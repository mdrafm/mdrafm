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
                                        <h4 class="card-title">Newly Recruited List From Finance Department</h4>
                                    </div>

                                </div>
                                <div class="row" style="margin-top:50px;">
                                    <div class="col-md-5">
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label><strong>Select Batch</strong></label>
                                            </div>
                                            <div class="col-md-7">
                                                <select class="custom-select mr-sm-2" name="batch" id="batch_id">
                                                    <option selected>Select Batch</option>
                                                    <?php 
                                                        
                                                        $count = 0;
                                                        //$db->select('tbl_batch_master',"*",null,null,null,null);
                                                        $sql = "SELECT DISTINCT(batch_id) as batch_id, b.batch_name FROM `tbl_new_recruite` n
                                                                  JOIN `tbl_batch_master`b ON n.batch_id = b.id 
                                                                  WHERE n.fin_status=1;";
                                                        $db->select_sql($sql);
                                                        // print_r( $db->getResult());
                                                        foreach($db->getResult() as $row){
                                                            //print_r($row);
                                                            $count++
                                                        ?>
                                                    <option value="<?php echo $row['batch_id'] ?>">
                                                        <?php echo $row['batch_name'] ?>
                                                    </option>

                                                    <?php 
                                                        }
                                                        ?>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                               <input type="button" class="btn btn-info" value="View " style="margin-top: 0px" id="tranee_list" />
                                            </div>
                                            
                                        </div>
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

 $('#tranee_list').click(function(){
     
    let batch_id = $('#batch_id').val();
    $('#tranee_data').html('');
    $.ajax({
        type: 'POST',
        url:"ajax_search.php",
        data: {batch_id:batch_id , action: "tranee_list"},
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