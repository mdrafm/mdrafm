<?php
   include 'admin/database.php';
   session_start();
        
   $db = new Database();
  
?>
<!doctype html>
<html lang="en">

<head>
    <title>Forget Password</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/logn.css">
    <script src="admin/assets/js/form_valid.js"></script>
    <script src="admin/assets/js/common.js"></script>
    <!-- <link rel="stylesheet" href="main.css">
 -->
 <style>
     @media screen and (max-width: 600px) {
        .logo{
    padding-left: 1px !important;
    margin-bottom:1px !important;
  }
  .logo p {
    padding-left: 8px !important;
    font-size:22px !important;
  }
  .container-fluid{
      width:95% !important;
      padding: 0px 0px 0px 0px !important;
  }
  .wrap img{
      width:100% !important;
      margin-left: -15px;
  }
  .login-wrap {
    margin-left: -8px !important;
    width: 88% !important;
  }
     }
 </style>
</head>

<body>
    <section class="ftco-section">
        <div class="container-fluid">
            <div class="logo" style="display: flex;margin-bottom:10px ;padding-left: 115px;">
            <div class="">
                                    <p class="social-media d-flex justify-content-end">
                                        
                                        <a href="index.php"
                                            class="social-icon d-flex align-items-center justify-content-center"><span
                                                class="fa fa-home"></span></a>
                                    </p>
                                </div>
                <div class="">
                    <img src="images/logo-Copy.png" style="height:120px;weight:100px;background-color:#F7F7F7">
                </div>
                <div>
                    <p style="font-size:28px;color:black;padding-left: 20px;font-family: ui-serif;">Madhusudan Das
                        Regional Academy of Financial Management </p>
                </div>
              
            </div>

            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
						<div class="col-md-7">
							<!-- <div class="img" style="background-image: url(images/itms1.jpg);">
							</div> -->
							<img src="images/itms2.jpg" alt="Login_image" style="width:110%;margin-left: -13px;" />
						</div>
                        <div class="col-md-5">
						<div class="login-wrap" style="margin: 0 auto;">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4">Forget Password</h3>
                                </div>
                                
                            </div>
                            <form class="otp-form" >
                                <div class="form-group mb-3" id="user">
                                    <label class="label" for="name">User Id</label>
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Username"
                                        autocomplete="off">
                                    <p class="text-danger err_msg" ></p>
                                </div>
                                <div class="form-group mb-3" id="otp_div" style="display:none">
                                    <label class="label" for="name">Enter Otp</label>
                                    <input type="text" class="form-control" name="otp" id="otp" placeholder="Your Otp"
                                        autocomplete="off">

                                    <div class = "text-success"> Resend otp after <span id="timer"></span></div>
                                    <div > <a href="#" class="text-danger" style="display:none" id="resend_otp" onclick="getOtp()" >Resend OTP</a>  </div>
                                </div>
                               
                                <div class="loader" style="display:none">
                                            <img src="admin/assets/img/loader.gif" alt="Loading"
                                                style="width: 300px;height: 90px;float: right;" />
                                </div>

                                <div class="form-group">
                                    <button type="button" id="otp_btn" class="form-control rounded submit px-3"
                                        style="background-color:#22ac8b;color:#fff" onclick="getOtp()">Get OTP</button>

                                    <button type="button" id="reset_btn" class="form-control rounded submit px-3" 
                                    style="display:none;background-color:#22ac8b;color:#fff" onclick="verify_otp()">Verify OTP</button>

                                    <!-- <button type="button" id="reset_btn" class="form-control rounded submit px-3" 
                                    style="display:none;background-color:#22ac8b;color:#fff" onclick="reset_password()">Reset Password</button> -->
                                </div>
                                
                            </form>

                            <form class="reset-form" style="display:none">
                                <div class="form-group mb-3" id="user">
                                    <label class="label" for="name">User Id</label>
                                    <input type="text" class="form-control" name="username" id="userName" placeholder="Username"
                                        autocomplete="off" readonly>
                                  
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="name">New Password</label>
                                    <input type="text" class="form-control" name="new_psw" id="new_psw" placeholder="New Password"
                                        autocomplete="off">
                                        <small class="text-danger"></small>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="name">Confirm Password</label>
                                    <input type="text" class="form-control" name="cnf_psw" id="cnf_psw" placeholder="New Password"
                                        autocomplete="off">
                                        <small class="text-danger" ></small>
                                </div>
                                <p style="margin-left: 20%;" class="text-danger err_psw" ></p>
                                 
                                <div class="form-group">
                                    <button type="button" id="reset_btn" class="form-control rounded submit px-3" 
                                    style="background-color:#22ac8b;color:#fff" onclick="reset_password()">Reset Password</button>
                                </div>
                                
                            </form>
                           
                            <!-- <p class="text-center">Not a member? <a data-toggle="tab" href="register.php">Sign Up</a> -->
                            </p>
                        </div>
                          <p style="margin-left:20%" class="text-danger mail_info"> </p>
						</div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>

<script type="text/javascript">
    let timerOn = true;
    let otp = '';
    let username = '';

    showMessage();

    function timer(remaining) {
    var m = Math.floor(remaining / 60);
    var s = remaining % 60;
    
    m = m < 10 ? '0' + m : m;
    s = s < 10 ? '0' + s : s;
    document.getElementById('timer').innerHTML = m + ':' + s;
    remaining -= 1;
    
    if(remaining >= 0 && timerOn) {
        setTimeout(function() {
            timer(remaining);
        }, 1000);
        return;
    }

    if(!timerOn) {
        // Do validate stuff here
        return;
    }
    
    // Do timeout stuff here
     $('#resend_otp').show();
        otp = '';
        console.log('expire_otp - ',otp);
    }

    
// function expire_otp(){
    
//     window.setTimeout(function () {
//         otp = '';
//     }, 120000);

// }

async function getSms(otp){
    // var otp = "12355";
     var content = otp+" is the OTP for Password reset, MDRAFM Govt. of Odisha.";
     const url = "https://govtsms.odisha.gov.in/api/api.php";
     const options = {
        method: 'POST',
        headers: {Accept: 'text/plain'},
        body: new URLSearchParams({
            action: 'singleSMS',
            department_id: 'D018001',
            template_id: '1007820644219645124',
            sms_content: `${otp} is the OTP for Password reset, MDRAFM Govt. of Odisha.`,
            phonenumber: '8249527287'
        })
       };

     try {
        const response = await fetch(url,options);

        if (response.ok) {
            const result = await response.json();
            console.log(result);
        }
    } catch (err) {
    console.error(err);
    }

}
function getOtp(){
     username = $('#username').val();
     var generateOtp = Math.floor(100000 + Math.random() * 900000);
     getSms(generateOtp);

    $.ajax({
        type: "POST",
        url: "ajax_forget_password.php",
        data: {
            username:username,
            otp:generateOtp,
            action:'send_otp'
        },
        beforeSend: function() {
                    $('.loader').show();
                    $('#otp_btn').prop('disabled', true);
                },
        success: function(res){

            console.log(res);
           let elm = res.split('#');
           
           if(elm[0]=='success'){
            let str = elm[1].split('-');
            let email =  str[1].replace(str[1].substring(3,6), 'xxx');
            let phone =  username.replace(username.substring(3,6), 'xxx');
            let email_msg = str[0]+' - '+email;
            let phone_msg = "& Registered Phone No - "+phone;
            $('.loader').hide();
            $('#otp_div').show();
            $('#user').hide();
            $('#otp_btn').hide();
            $('#reset_btn').show();
            $('.mail_info').html(email_msg+"<br>"+phone_msg);
            timer(120);

            otp = elm[2];
            console.log(otp);
           }else{
            $('.loader').hide();
            $('#otp_btn').prop('disabled', false);
            $('.err_msg').html(elm[1]);
           }
        }
    })

}

function verify_otp(){

    let entered_otp = $('#otp').val();
     
    if(entered_otp == otp){

         $('.otp-form').hide();
         $('.reset-form').show();
         $('.mail_info').hide();
         $('#userName').val(username);

    }else{
        $('.mail_info').html('');
        $('.mail_info').html('Wrong OTP');
        console.log('Wrong otp');
    }
    

}

function reset_password(){

    const userNameEl = document.querySelector('#userName');
    const newpswE1 = document.querySelector('#new_psw');
    const cnfpswE1 = document.querySelector('#cnf_psw');

    let isPasswordValid = checkPassword(newpswE1),
        isCnfPasswodValid = checkConfirmPassword(cnfpswE1,newpswE1);
     
    let isFormValid = isPasswordValid &&
                      isCnfPasswodValid ;
    let new_psw =  $('#new_psw').val(); 
    let UserName =  $('#userName').val();                 
    if(isFormValid){
        $.ajax({
        type: "POST",
        url: "ajax_forget_password.php",
        data: {
            username:UserName,
            new_psw:new_psw,
            action:'reset_password'
        },
        success: function(res){

            console.log(res);
            let elm = res.split('#');
            if(elm[0]== "success"){
                sessionStorage.message = elm[1];
                sessionStorage.type = "success";
                //location.reload();
                window.location.href = "login.php";
            }else{
                $('.mail_info').html(elm[1]);
            }
        }
    })
    }
}

</script>