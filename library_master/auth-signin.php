<?php
   include '../database.php';
   session_start();
        
   $db = new Database(); 
   $err = '';

if(isset($_POST['submit'])){
   
	$username = $_POST['username'];
	$password = $_POST['password'];
	//echo gettype($username);
    $db_pass = '';
   
   $db->select('tbl_circular_user',"id,username,name,password,dept_id,status",null,'username ='."'$username'",null,null);
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
                    $_SESSION['name'] =  $row['name'];
                    $_SESSION['dept_id'] = $row['dept_id'];
                     
                      header('location:index.php');
                }else{
                    //echo 'not valid';
                    $err = "Invalid Password!!";
                }
            }
        }
		
	}


}

?>
<!DOCTYPE html>
<html lang="en">

<head>

	<title>Department Login</title>
	<!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 11]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="" />
	<meta name="keywords" content="">
	<meta name="author" content="Phoenixcoded" />
	<!-- Favicon icon -->
	<link rel="icon" href="Seal_of_Odisha.png" type="image/x-icon">

	<!-- vendor css -->
	<link rel="stylesheet" href="assets/css/style.css">
	
	


</head>

<!-- [ auth-signin ] start -->
<div class="auth-wrapper">
	<div class="auth-content text-center" style="margin-top: -190px;">
		<img src="cms2.png" alt="" class="img-fluid mb-4">
		<div class="card borderless" style="margin-top: -45px;">
		   <form method="POST" action="#">
			<div class="row align-items-center ">
				<div class="col-md-12">
					<div class="card-body">
					   <img class="user" src="Seal_of_Odisha.png" height="100px" width="100px" style="margin-bottom: 12px;">
						<h4 class="mb-3 f-w-400">Department Login</h4>
						<hr>
						<div class="form-group mb-3">
							<input type="text" class="form-control" name="username" placeholder="User Name">
						</div>
						<div class="form-group mb-4">
							<input type="password" class="form-control" name="password" placeholder="Password">
						</div>
						<!-- <div class="custom-control custom-checkbox text-left mb-4 mt-2">
							<input type="checkbox" class="custom-control-input" id="customCheck1">
							<label class="custom-control-label" for="customCheck1">Save credentials.</label>
						</div> -->
						<p class="text-danger"><?php echo ($err != '')? $err:''; ?></p>
						<button class="btn btn-block btn-primary mb-4" name="submit">Signin</button>
						<!-- <input type="submit" name="submit" value="login"> -->
						<hr>
						<!-- <p class="mb-2 text-muted">Forgot password? <a href="auth-reset-password.html" class="f-w-400">Reset</a></p>
						<p class="mb-0 text-muted">Don’t have an account? <a href="auth-signup.html" class="f-w-400">Signup</a></p> -->
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>
<!-- [ auth-signin ] end -->

<!-- Required Js -->
<!-- <script src="assets/js/vendor-all.min.js"></script> -->
<script src="assets/js/plugins/bootstrap.min.js"></script>

<script src="assets/js/pcoded.min.js"></script>



</body>

</html>
