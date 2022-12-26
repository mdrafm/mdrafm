<?php
  //print_r($_SESSION);
  $user_id ='';
  if( isset($_SESSION['user_id']) && $_SESSION['user_id'] != ''){
    $user_id = $_SESSION['user_id'];
  }
 // echo $user_id;
?>
<section class="header-nav" style="display: block;">

    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #1e4f87;">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse justify-content-between " id="main_nav" >
           
            <ul class="navbar-nav">
                   <li class="nav-item"> <a class="nav-link" href="index.php" style="color:#fff"><i class="fa fa-home" aria-hidden="true"></i>Home </a> </li>
                
                    <li class="nav-item" style="margin-left: 119px;display: <?php echo ($user_id == '')?'none':'' ?>"><a class="nav-link" href="login.php" style="color:#fff">Add Case</a></li>
                       
            </ul>
            
            <ul class="navbar-nav">
                
               <li class="nav-item" style="margin-left: 119px; display: <?php echo ($user_id == '')?'':'none' ?>" > <i class="fa fa-unlock-alt" aria-hidden="true" style="color: sandybrown;"></i><a class="nav-link" href="login.php" style="color:#fff">Login</a></li>
   
            </ul>

        </div> <!-- navbar-collapse.// -->

    </nav>
</section>