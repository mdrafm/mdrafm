<!DOCTYPE html>
<html lang="en">

<head>
<?php include('header_link.php') ?>
    
    

</head>
<body class="">
	<!-- [ Pre-loader ] start -->
	<div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div>
	<!-- [ Pre-loader ] End -->
	<!-- [ navigation menu ] start -->
    <?php include('sidebar_nav.php') ?>
	<!-- [ navigation menu ] end -->
	<!-- [ Header ] start -->
	<?php include('header_nav.php') ?>
	<!-- [ Header ] end -->
	
	

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Dashboard Analytics</h5>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- table card-1 start -->
            <div class="col-md-12 col-xl-4">
                
                <!-- widget primary card start -->
                <div class="card flat-card widget-primary-card">
                    <div class="row-table">
                        <div class="col-sm-3 card-body">
                            <i class="feather icon-star-on"></i>
                        </div>
                        <div class="col-sm-9">
                            <?php 
                           // print_r($_SESSION) 
                           // SELECT COUNT(*) as total_circular FROM `tbl_circular` WHERE dept_id = 10;
                             $db->select('tbl_gst_case_law',"COUNT(*) as total_case",null,"status =1",null,null);
                             foreach($db->getResult() as $case_count){
                                //print_r($circular_count);
                                ?>
                                   <h4>Total GST Case Law</h4>
                                   <h6><?php echo $case_count['total_case'] ?></h6>
                                <?php
                             }
                            ?>
                            
                        </div>
                    </div>
                </div>
                <!-- widget primary card end -->
            </div>
            <!-- table card-1 end -->
            <!-- table card-2 start -->
            <div class="col-md-12 col-xl-4">
                
                <!-- widget-success-card start -->
                <!-- <div class="card flat-card widget-purple-card">
                    <div class="row-table">
                        <div class="col-sm-3 card-body">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="col-sm-9">
                            <h4>17</h4>
                            <h6>Achievements</h6>
                        </div>
                    </div>
                </div> -->
                <!-- widget-success-card end -->
            </div>
            <!-- table card-2 end -->
           
            <!-- prject ,team member start -->
            <div class="col-xl-6 col-md-12">
                <div class="card table-card" style="height: 60vh; overflow-y: scroll;display:none">
   
                    <div class="card-header">
                        <h5>Circular Year Wise</h5>
                       
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" id="year_circular">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Year</th>
                                        <th>No of Circular</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 0;
                                      $sql = "SELECT year,COUNT(*) as circular FROM `tbl_circular` WHERE dept_id = 10 GROUP BY year ORDER BY year DESC";
                                      $db->select_sql($sql);

                                      foreach($db->getResult() as $row){
                                        $count++;
                                        ?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo $row['year']; ?></td>
                                            <td><?php echo $row['circular']; ?></td>
                                      
                                       </tr>
                                        <?php
                                      }
                                    ?>
                                    
                                    
                                   
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-12">
            <div class="card table-card" style="height: 60vh; overflow-y: scroll;display:none">
                    <div class="card-header">
                        <h5>Circular Category Wise</h5>
                       
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Category name</th>
                                        <th>No of Circular</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 0;
                                      $sql_group = "SELECT g.group_name,COUNT(*) as circular FROM `tbl_circular` c 
                                      RIGHT JOIN `tbl_circular_group` g ON c.group = g.id  
                                      WHERE g.dept_id = 10 AND c.dept_id = 10 GROUP BY `group`";
                                      $db->select_sql($sql_group);

                                      foreach($db->getResult() as $row1){
                                        $count++;
                                        ?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo $row1['group_name']; ?></td>
                                            <td><?php echo $row1['circular']; ?></td>
                                      
                                       </tr>
                                        <?php
                                      }
                                    ?>
                                    
                                    
                                   
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- prject ,team member start -->
            

           
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>


    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>

<!-- Apex Chart -->
<script src="assets/js/plugins/apexcharts.min.js"></script>


<!-- custom-chart js -->
<script src="assets/js/pages/dashboard-main.js"></script>
</body>

</html>

<script>
   // $('#year_circular').DataTable();
    $('#year_circular').DataTable();
</script>
