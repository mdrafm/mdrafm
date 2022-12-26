<header class="navbar pcoded-header navbar-expand-lg navbar-light header-dark">
    <div class="m-header" style="background-color:#3c93ab !important">
        <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
        <a href="#!" class="b-brand">
            <!-- ========   change your logo hear   ============ -->
            <div class="logo_div">

                <!-- <img src="Act-logos.jpeg" alt="" class="logo"> -->
            </div>

            <!-- <img src="assets/images/logo-icon.png" alt="" class="logo-thumb"> -->
        </a>
        <a href="#!" class="mob-toggler">
            <i class="feather icon-more-vertical"></i>
        </a>
    </div>
   
    <div class="collapse navbar-collapse" style="background-color:#3c93ab !important">
   
               <h4 style="margin-left: 33%;color: #dad3d3;">Library Management System</h4>
           
        <ul class="navbar-nav ml-auto">
           
       
            <li>
                <a href="about_us.php" class="" title="about_us">
                    About us
                </a>
            </li>
            <li>
            <li>
		<div class="dropdown drp-user">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
		<i class="feather icon-user"></i>
		</a>
		<div class="dropdown-menu dropdown-menu-right profile-notification">
		<div class="pro-head">
		<span><?php echo $_SESSION['name'] ?></span>
		</div>
			<ul class="pro-body">
			<a href="logout.php" class="dud-logout" title="Logout">
			<i class="feather icon-log-out"></i> Logout
			</a>
			</li>
			</ul>
    </div>
    </div>
    </li>
    </ul>
    </div>


</header>