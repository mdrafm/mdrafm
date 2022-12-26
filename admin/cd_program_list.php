<!DOCTYPE html>
<html lang="en">


<head>
    <?php 
    
    include('header_link.php');
    include('../config.php');
    include 'database.php';
   
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
                                    <div class="col-md-4">
                                        <h4 class="card-title"> Program Type</h4>
                                    </div>

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Program Type</strong></label>
                                    <select class="custom-select mr-sm-2" name="trng_type" id="trng_type">
                                        <option selected> Program Type</option>
                                        <option value=1> Long Term(Newly Recruited)</option>
                                        <option value=2> Long Term(InService)</option>
                                        <option value=3> Mid Term Program</option>
                                     
                                    </select>
                                </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4 class="card-title"> Program List</h4>
                                    </div>

                                </div>


                            </div>
                            <div class="card-body">
                                <div id="cd_program" class=" table table-responsive table-striped table-hover"
                                    style="width:100%;margin:0px auto">
                                   
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
                        <h5 class="modal-title" id="m_title" style="text-align:center;"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="warning">
                            <p class="wrn_msg"></p>

                        </div>
                        <div id="m_body" style="display:none">
                            <div class="form-group">
                                <label> Remark : </label>
                                <textarea class="form-control cancel_comment" style="border: 1px solid black;"
                                    id="reject_comment" rows="3"></textarea>
                            </div>
                        </div>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
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
    $('#trng_type').on('change', function(){
        let trng_type = $('#trng_type').val();
        let username = <?php echo $_SESSION['username']; ?>;
      
        if(trng_type == 3){
            var url = "cd_midTerm_template.php";
        }else{
            var url = "cd_longTerm_template.php";
        }
        //console.log(url);
        $.ajax({
        type: "POST",
        url: url,
        data: {

            trng_type:trng_type,
            username:username
        },
        success: function(res) {
            console.log(res);
            $('#cd_program').html(res);
        }
    })
    })
</script>