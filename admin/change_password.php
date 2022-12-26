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
                    <div class="col-md-6" style="margin: 0 auto;">

                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="card-title text-center">Change Password</h4>
                                    </div>
                                </div>

                            </div>
                            <div class="card-body">
                                <form method="post" id="frm_faculty" enctype="multipart/form-data" style="margin-left: 50px;">
                                 
                                    <div class="row">

                                        <div class="col-md-10">
                                            <label class="form-label">Prvious Password</label>
                                            <input type="text" class="form-control" id="prev_psw" name="prev_psw" required >
                                            <small id="prev_err" class="text-danger"></small>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-10">
                                            <label class="form-label">New Password</label>
                                            <input type="text" class="form-control" id="new_psw" name="new_psw" required>
                                            <small></small>

                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-10">
                                            <label class="form-label">confirm Password</label>
                                            <input type="text" class="form-control" id="cnf_passwod" name="cnf_passwod" required>
                                            <small></small>

                                        </div>

                                    </div>

                                    <input type="hidden" name="action" id="action" value="change_psw">
                                    <input type="hidden" name="user_id" id="user_id" value= <?php echo $_SESSION['user_id']; ?> >

                                    <button type="submit" class="btn btn-primary" name="save" id="save" style="margin-left: 100px;">Change Password</button>
                                </form>
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

const new_pswE1 = document.querySelector('#new_psw');
const cnf_passwodE1 = document.querySelector('#cnf_passwod');



$('#frm_faculty').on('submit', function(e) {
    e.preventDefault();
    $('#prev_err').html('');
 
   
    // validate forms
    
    let isNewPswValid = checkPassword(new_pswE1),
        isCnfPasswodValid = checkConfirmPassword(cnf_passwodE1,new_pswE1);

      
    let isFormValid = isNewPswValid && isCnfPasswodValid;

   if(isFormValid)
   {
    $.ajax({
            type: "POST",
            url: "ajax_changepsw.php",
            data: new FormData(this),
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            success: function(res) {
                console.log(res);
                let elm = res.split('#');
                if (elm[0] == "success") {
                    sessionStorage.message = 'User' + ' ' + elm[1];
                    sessionStorage.type = "success";
                    window.location.href = 'index.php';
                } else {
                    console.log(elm[1]);
                     $('#prev_err').html(elm[1]);
                   // location.reload();
                }

            }
        });
   }
       
   
})

</script>