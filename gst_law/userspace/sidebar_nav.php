<!-- [ navigation menu ] start -->
<?php
session_start(); 

include '../../admin/database.php';
$db = new Database();
?>
	<nav class="pcoded-navbar  ">
		<div class="navbar-wrapper  ">
			<div class="navbar-content scroll-div " >
				
				<div class="">
					<div class="main-menu-header" style="background: #f6f6f6;">
						<img class="img-radius" style="width: 89px;margin-bottom: 21px;margin-left: -21px;" src="../../images/logo-Copy.png" alt="User-Profile-Image">
						<div class="user-details">
							<span 
                             style="color: #342897;
                                    font-size: 1.2rem;
                                    font-weight: 600;
                                    text-transform: uppercase;" 
                            ><?php echo $_SESSION['name'] ?></span>
							
						</div>
					</div>
					
				</div>
				
				<ul class="nav pcoded-inner-navbar ">
					<li class="nav-item pcoded-menu-caption">
						<!-- <label>Navigation</label> -->
					</li>
					<li class="nav-item">
					    <a href="index.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
					</li>
					
					<li class="nav-item pcoded-menu-caption">
						<!-- <label>Pages</label> -->
					</li>
					<?php
					  // print_r( $_SESSION);

					   if($_SESSION['role'] == 1){
						?>
						    <li class="nav-item"><a href="add_case.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-sidebar"></i></span><span class="pcoded-mtext">Add Case</span></a></li>
							<li class="nav-item"><a href="view_case.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-sidebar"></i></span><span class="pcoded-mtext">View Case</span></a></li>
							<li class="nav-item"><a href="modify_case.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-sidebar"></i></span><span class="pcoded-mtext">Modify Case</span></a></li>
							<li class="nav-item"><a href="approve_case.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-sidebar"></i></span><span class="pcoded-mtext">Approve Case</span></a></li>
							<li class="nav-item pcoded-hasmenu">
								<a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Case Master</span></a>
								<ul class="pcoded-submenu">
									<li><a href="case_type.php" >Case Type</a></li>
									<li><a href="broad_area.php" >Broad Area</a></li>
									<li><a href="section_gst_act.php">Section GST Act</a></li>
									<li><a href="rule_gst_act.php" >Rule GST Act</a></li>
								</ul>
							</li>
						<?php
					   }

					   if($_SESSION['role'] == 4){
						?>
						   
							<li class="nav-item"><a href="view_case.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-sidebar"></i></span><span class="pcoded-mtext">View Case</span></a></li>
							
						<?php
					   }
					   if($_SESSION['role'] == 3){
						?>
						   
						    <li class="nav-item"><a href="add_case.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-sidebar"></i></span><span class="pcoded-mtext">Add Case</span></a></li>
							<li class="nav-item"><a href="view_case.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-sidebar"></i></span><span class="pcoded-mtext">View Case</span></a></li>
							<li class="nav-item"><a href="modify_case.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-sidebar"></i></span><span class="pcoded-mtext">Modify Case</span></a></li>
							<li class="nav-item"><a href="reject_case.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-sidebar"></i></span><span class="pcoded-mtext">Rejected Case</span></a></li>
							
						<?php
					   }

					   if($_SESSION['role'] == 2){
						?>
						    <li class="nav-item"><a href="approve_case.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-sidebar"></i></span><span class="pcoded-mtext"> Pending For Approval Case</span></a></li>
							<li class="nav-item"><a href="view_case.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-sidebar"></i></span><span class="pcoded-mtext">Approved Case</span></a></li>
						
						<?php
					   }
					?>
					
				</ul>
				
				
			</div>
		</div>
	</nav>
	<!-- [ navigation menu ] end -->