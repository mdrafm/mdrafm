<?php //include('header.php') ?>
<?php //include('nav_bar.php') ?>

<?php
   include 'admin/database.php';
   //session_start();   
   $db = new Database(); 
   $err = '';

if(isset($_POST['submit'])){
   
	$username = $_POST['username'];
	$password = $_POST['password'];
	//echo gettype($username);
    $db_pass = '';
	$db->select('tbl_user',"id,username,name,password,roll_id,status",null,'username ='."'$username'",null,null);
	$res = $db->getResult();
	foreach($res as $row){
		$db_pass = $row['password'];
		if($row['status']==0){
            $err = "Inactive User";
            
        }
        else{
            if($db_pass !== false){
                $validPassword = password_verify($password,$db_pass);
                if($validPassword){
                    
                    $_SESSION['user_id'] =  $row['id'];
                    $_SESSION['username'] =  $row['username'];
                    $name =  $row['name'];
                    $_SESSION['roll_id'] = $row['roll_id'];
                      if(($row['roll_id']== 5) || ($row['roll_id']== 15)){
    
                          $db->select_one('tbl_user','name',$row['id']);
                          foreach($db->getResult() as $librarian){
                            $_SESSION['name'] =  $librarian['name'];
                          }
                      }
                      else{
                        $_SESSION['name'] =  $name;
                      }
					  //print_r($_SESSION);exit;
					 //echo "hello";exit;
                      header('location:library_master/index.php');
                }else{
                    //echo 'not valid';
                    $err = "Invalid Password!!";
                }
            }
        }
		
	}


}

?>
<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/logn.css">
    
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
                    <p style="font-weight:600;font-size:28px;color:black;padding-top: 10px;;padding-left: 20px;font-family: ui-serif;color:#22ac8b">Welcome to Library Management System</p>
                </div>
                    
            </div>

            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
						<div class="col-md-9">
							<div class="row">
							<div class="col-md-12">
							<center><h4 style="font-size:15px;font-weight: 600"> SUBSCRIBED DATABASE </h4><img src="library/line.png" style="height: 2px; width: 60px;margin-top: -35px"></center> 
							<div class="row">
							<div class="col-md-2"></div>
							<div class="col-md-4">
							<p style="text-align-last: center;">	
							 <a href="https://www.taxmann.com/auth/login">  <img src="library/taxmann.png" style="height: 50px;margin-top: -15px"> </a> 
							</p> <br>
							</div>
							<div class="col-md-4">
							<p style="text-align-last: center;">	
							 <a href="https://www.expresslibrary.mheducation.com/">  <img src="images/ipc_logo.png" style="height: 50px;margin-top: -15px"> </a> 
							</p> <br>
							</div>
							</div>
							</div>
							</div>
						<div class="row">
						<div class="col-md-12 pd0" style="margin-top: -30px">
						<center><h4 style="font-size:15px;"> OPEN DATABASE </h4><img src="library/line.png" style="height: 2px; width: 60px;margin-top: -30px"></center> 
						<div class="row" style="margin-left: 2%;background-color:">
						<div class="col-md-3 pd0" >
						<img src="library/arrow.png" id="er" style="height: 20px"><a href="https://dbie.rbi.org.in/"> <img class="lom" src="library/RBI%20LOGO%20Final.png" style="height: 46px"></a>  
						</div>
						<div class="col-md-3 pd0">
						<img src="library/arrow.png" id="er" style="height: 20px"> <a href="https://www.india.gov.in/"> <img class="lom" src="library/logo_1.png" style="height: 48px"></a> 
						</div>
						<div class="col-md-3 pd0">
						<img src="library/arrow.png" id="er" style="height: 20px"> <a href="https://data.gov.in/"> <img class="lom" src="library/logo.png" style="height: 45px;background-color: #85be00"></a>  
						</div>
						<div class="col-md-3 pd0">
						<img src="library/arrow.png" id="er" style="height: 20px"> <a href="https://odisha.data.gov.in/"> <img class="lom" src="library/Odisha_data_gov.png" style="height: 55px"></a>
						</div>
						</div>
						<div class="row" style="margin-left: 10%">
						<div class="col-md-3 pd0">
						  <img src="library/arrow.png" id="er" style="height: 20px"><a href="http://iipmpublications.com/"> <img class="lom" src="library/logo-iipm.jpg" style="height: 46px"></a> 
						</div> 
						<div class="col-md-3 pd0">
						 <img src="library/arrow.png" id="er" style="height: 20px"><a href="https://www.sebi.gov.in/"> <img class="lom" src="library/sebi11.png" style="height: 30px;width: 80%"></a> 
						</div>
						<div class="col-md-3 pd0">
						 <img src="library/arrow.png" id="er" style="height: 20px"><a href="https://www.bseindia.com/"> <img class="lom" src="library/bse.png" style="height: 46px"></a> 
						</div>
						<div class="col-md-3 pd0">
						 <img src="library/arrow.png" id="er" style="height: 20px"><a href="https://www.nseindia.com/"> <img class="lom" src="library/NSE.svg" style="height: 46px"></a> 
						</div>
						</div>
						<div class="row" style="margin-left: 10%">
						<div class="col-md-3 pd0">
						<img src="library/arrow.png" id="er" style="height: 20px"><a href="https://www.nism.ac.in/"> <img class="lom" src="library/nism.png" style="height: 25px"></a>
						</div> 
						<div class="col-md-3 pd0">
						<img src="library/arrow.png" id="er" style="height: 20px"><a href="https://pfrda.org.in/"> <img class="lom" src="library/pfrda.png" style="height: 30px"></a> 
						</div>
						<div class="col-md-3 pd0">
						<img src="library/arrow.png" id="er" style="height: 20px"><a href="http://niti.gov.in/"> <img class="lom1" src="library/niti.png" style="height: 50px"></a> 
						</div>
						</div>
						</div>
						</div>
						<!--div complete-->
						<div class="col-md-12 pd0" style="margin-left: 10%" >
						<div class="row">
						<div class="col-md-3 pd0">
						<img src="library/arrow.png" id="er" style="height: 20px"><a href="https://data.worldbank.org/"> <img class="lom" src="library/worldbank.svg" style="height: 35px"></a>  
						</div>
						<div class="col-md-3 pd0">
						<img src="library/arrow.png" id="er" style="height: 20px"><a href="https://www.imf.org/en/data"> <img src="library/imflogo.png" class="lom" style="height: 40px; "></a> 
						</div>
						<div class="col-md-3 pd0"> 
						<img src="library/arrow.png" id="er" style="height: 20px"><a href="https://core.ac.uk/"> <img class="lom" src="library/core.png" style="height: 46px"></a>  
						</div>
						<div class="col-md-3 pd0">
						<img src="library/arrow.png" id="er" style="height: 20px"><a href="https://doaj.org/"> <img class="lom" src="library/doaj.png" style="height: 40px"></a>  
						</div>
						</div>
						</div>		
						<!--div complete-->
						<div class="col-md-12 pd0"  style="margin-left: 10%">
					    <div class="row">
						<div class="col-md-3 pd0">
						 <img src="library/arrow.png" id="er" style="height: 20px"><a href="http://asci.org.in/index.php/publications/asci-journal-of-management#previous-issues"> <img class="lom" src="library/logojune22.png" style="height: 30px;  "></a>  
						</div>
						<div class="col-md-4 pd0">
					 	 <img src="library/arrow.png" id="er" style="height: 20px"><a href="https://cmie.com/"> <img class="lom" src="library/cmie1.png" style="height: 30px"></a> 
						</div> 
						</div>
						</div>
						<br> 
						<!--div complete-->
						</div>
                        <div class="col-md-3" 
                            style="background-image: url(library/login_bg.jpg);background-size: 25rem 35rem;
                                background-repeat: no-repeat;
                            ">

                        <p id="alert_msg" style="width: 70%; margin-left: 10%;color:#fff;background-color: #59ac60;"></p>
   
						<div class="login-wrap" style="margin: 0 auto;">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4">Sign In</h3>
                                </div>
                                <!-- <div class="w-100">
                                    <p class="social-media d-flex justify-content-end">
                                        <a href="#"
                                            class="social-icon d-flex align-items-center justify-content-center"><span
                                                class="fa fa-facebook"></span></a>
                                        <a href="#"
                                            class="social-icon d-flex align-items-center justify-content-center"><span
                                                class="fa fa-twitter"></span></a>
                                        <a href="#"
                                            class="social-icon d-flex align-items-center justify-content-center"><span
                                                class="fa fa-home"></span></a>
                                    </p>
                                </div> -->
                            </div>
                            <form action="#" class="signin-form" method="post">
                                <div class="form-group mb-3">
                                    <label class="label" for="name">User Id</label>
                                    <input type="text" class="form-control" name="username" placeholder="Username"
                                        autocomplete="off">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="password">Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Password"
                                        autocomplete="off">
                                        <br>
                                    <p class="text-danger"><?php echo ($err != '')? $err:''; ?></p>
                                </div>

                                <div class="form-group">
                                    <button type="submit" name="submit" class="form-control rounded submit px-3"
                                        style="background-color:#22ac8b;color:#fff">Sign In</button>
                                </div>
                                <div class="form-group d-md-flex">
                                    <div class="w-50 text-left">
                                       
                                    </div>
                                    <div class="w-50 text-md-right ">
                                        <a class="text-danger" href="forget_password.php">Forgot Password</a>
                                    </div>
                                </div>
                            </form>
                            <!-- <p class="text-center">Not a member? <a data-toggle="tab" href="register.php">Sign Up</a> -->
                            </p>
                        </div>
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
   
<script>
    showMessage();
  
function showMessage(){
	if ( sessionStorage.type=="success" ) {
        console.log(123);
        $('#alert_msg').show();
        //$('#btn_records_mtnc').show();
        $("#alert_msg").addClass("alert alert-success").html(sessionStorage.message);
        closeAlertBox();
       
        sessionStorage.removeItem("message");
        sessionStorage.removeItem("type");
    }
    if (sessionStorage.type == "error") {
        $('#alert_msg').show();
        $("#alert_msg").addClass("alert ").html(sessionStorage.message);
        closeAlertBox();
        sessionStorage.removeItem("message");
        sessionStorage.removeItem("type");
    }

}

function closeAlertBox(){
window.setTimeout(function () {
$("#alert_msg").fadeOut(300)
}, 3000);
}

</script>
</body>

</html>