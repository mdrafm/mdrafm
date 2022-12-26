<!-- [ navigation menu ] start -->
<?php
session_start(); 

include '../admin/database.php';
$db = new Database();
 //echo $_SESSION['roll_id'];
?>
	<nav class="pcoded-navbar" style="background-color:#3c93ab !important">
		<div class="navbar-wrapper  ">
			<div class="navbar-content scroll-div " >
				
				<div class="">
					<div class="main-menu-header" style="background: #f6f6f6;">
						<img class="img-radius" style="width: 89px;margin-bottom: 21px;margin-left: -21px;" src="../images/logo-Copy.png" alt="User-Profile-Image">
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
					    <a href="index.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext" style="font-weight: 600;">Dashboard</span></a>
					</li>
					
					<li class="nav-item pcoded-menu-caption">
						<!-- <label>Pages</label> -->
					</li>
					<?php
					   if($_SESSION['roll_id'] == 15){
						?>
						    <li class="nav-item"><a href="edit_book_details.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-sidebar"></i></span><span class="pcoded-mtext">Edit Book Details</span></a></li>
							<li class="nav-item"><a href="dup_book_details.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-sidebar"></i></span><span class="pcoded-mtext">Duplicate Books</span></a></li>
						    <li class="nav-item"><a href="" class="nav-link "><span class="pcoded-micon"><i class="feather icon-sidebar"></i></span><span class="pcoded-mtext">Add Book Type</span></a></li>
							<li class="nav-item"><a href="" class="nav-link "><span class="pcoded-micon"><i class="feather icon-sidebar"></i></span><span class="pcoded-mtext">Add Vendor Name</span></a></li>
							<li class="nav-item"><a href="" class="nav-link "><span class="pcoded-micon"><i class="feather icon-sidebar"></i></span><span class="pcoded-mtext">Add Book Details</span></a></li>
							
							<li class="nav-item"><a href="" class="nav-link "><span class="pcoded-micon"><i class="feather icon-sidebar"></i></span><span class="pcoded-mtext">Issue/return Book</span></a></li>
							<!--<li class="nav-item pcoded-hasmenu">
								<a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Barcode Generation</span></a>
								<ul class="pcoded-submenu">
									<li><a href="case_type.php" >Case Type</a></li>
									<li><a href="broad_area.php" >Broad Area</a></li>
									<li><a href="section_gst_act.php">Section GST Act</a></li>
									<li><a href="rule_gst_act.php" >Rule GST Act</a></li>
								</ul>
							</li>-->
						<?php
					   }else if($_SESSION['roll_id'] == 9)
					   { ?>
						<li class="nav-item"><a href="member_book_issue.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-sidebar"></i></span><span class="pcoded-mtext">Issue Book</span></a></li>
						<li class="nav-item"><a href="view_case.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-sidebar"></i></span><span class="pcoded-mtext">Book issued register</span></a></li>  
					  <?php  }
						?>							
				</ul>
				
				
			</div>
		</div>
	</nav>
	<!-- [ navigation menu ] end -->