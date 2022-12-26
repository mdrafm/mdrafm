<?php
  include('config.php');
  print_r($_POST);
  if(isset($_POST['submit'])){
    //echo "123";
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cnf_password = $_POST['cnf_password'];
    $email = $_POST['email'];

    $chk_sql = "select * from tbl_user where email = '$email'";
    $chk_res = mysqli_query($db,$chk_sql);

	$encryptedpass = password_hash($password,PASSWORD_BCRYPT);
	$insert_sql = "INSERT INTO tbl_user (username,name,email,password) VALUES ( '$username','$name','$email','$encryptedpass' ) " ;
	//echo $insert_sql;exit;
	$inserd_res = mysqli_query($db,$insert_sql);

	if(mysqli_affected_rows($db) > 0){
		header("Location: login.php");
		die();
	}else{
	  $msg = "database error".$db->error;
	}
    
    
    // if( mysqli_num_rows($chk_res) >1 ){

    //     $msg = "user already exist";
    // }

    // elseif($password == $cnf_password ){
    //     $msg = "passwords doesn't match";
    // }
    // else
    // {
    //     $encryptedpass = password_hash($password,PASSWORD_BCRYPT);
    //     $insert_sql = "INSERT INTO tbl_user (username,name,email,password) VALUES ( '$username','$name','$email','$encryptedpass' ) " ;
	// 	echo $insert_sql;exit;
	// 	$inserd_res = mysqli_query($db,$insert_sql);

	// 	if(mysqli_affected_rows($db) > 0){
	// 		header("Location: login.php");
    //         die();
	// 	}else{
	// 	  $msg = "database error";
	// 	}

    // }

	echo $msg;
	exit;
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
	<!-- <link rel="stylesheet" href="main.css">
 -->
    
	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="logo" style="display: flex;margin-bottom:10px ;padding-left: 115px;">
				<div class="">
				   <img src="images/logo-Copy.png" style="height:120px;weight:100px;background-color:#F7F7F7">
				</div>
				<div>
				  <p style="font-size:28px;color:black;padding-left: 20px;font-family: ui-serif;">Madhusudan Das Regional Academy of Financial Management </p>
				</div>
				
			</div>
			
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="img" style="background-image: url(images/building1.jpg);">
			      </div>
						<div class="login-wrap p-4 p-md-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Sign In</h3>
			      		</div>
								<div class="w-100">
									<p class="social-media d-flex justify-content-end">
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
									</p>
								</div>
			      	</div>
							<form action="#" class="signin-form" method="post">
			      		<div class="form-group ">
			      			<label class="label" for="name">name</label>
			      			<input type="text" class="form-control" name="name" placeholder="name" required autocomplete="off">
			      		</div>
                          <div class="form-group ">
			      			<label class="label" for="name">username</label>
			      			<input type="text" class="form-control" name="username" placeholder="Username" required autocomplete="off">
			      		</div>
		            <div class="form-group">
		            	<label class="label" for="password">Password</label>
		              <input type="password" class="form-control" name="password" placeholder="Password" required autocomplete="off">
		            </div>
                    <div class="form-group">
		            	<label class="label" for="password">Confirm Password</label>
		              <input type="password" class="form-control" name="cnf_password" placeholder=" CNF Password" required autocomplete="off">
		            </div>
                    <div class="form-group">
		            	<label class="label" for="email">Email</label>
		              <input type="email" class="form-control" name="email" placeholder="Email" required autocomplete="off">
		            </div>
		            <div class="form-group">
		            	<button type="submit" name="submit" class="form-control btn btn-primary rounded submit px-3">Sign up</button>
		            </div>
		            
		          </form>
		         
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

