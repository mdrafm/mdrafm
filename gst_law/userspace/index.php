<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('header_link.php') ?>

    <style type="text/css">
        .table_wrapper {
            margin: 20px;
        }

        #year_case th {
            background: #2c3e50ed;
            color: #fff;
        }

        #court th {
            background: #2c3e50ed;
            color: #fff;
        }

        .card-header {
            background: #0d9c5beb;

        }
    </style>

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
                                $db->select('tbl_gst_case_law', "COUNT(*) as total_case", null, "status =1", null, null);
                                foreach ($db->getResult() as $case_count) {
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
                <div class="col-md-12">
                    <div class="card table-card" style="height: 80vh; overflow-y: scroll;">

                       
                        <div class="card-body p-0">
                            <ul class="nav nav-pills m-2" role="tablist">
                                <li class="nav-item">
                                    <button class="nav-link active" data-toggle="pill" onclick="barChart('pieChart','barChart')">Bar Chart</button>
                                </li>
                                <li class="nav-item ml-2">
                                    <button class="nav-link" data-toggle="pill" onclick="pieChart('pieChart','barChart')">Pie Chart</button>
                                </li>
                                


                            </ul>
                            <div>

                                <div id="pieChart" class="container " style="display:none;">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div id="pieChart1"></div>
                                        </div>
                                        <!-- <div class="col-md-1"></div> -->
                                        <div class="col-md-5">
                                            <div id="pieChart2" ></div>
                                        </div>

                                    </div>
                                </div>

                                <div id="barChart" class="container active"  >

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div  id="chart_div2"></div>
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-5">
                                            <div id="chart_div" style="margin-left: 10rem;"></div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <!-- <div class="card">
                        <div class="card-header">
                            <h5>Pie Charts</h5>
                        </div>
                        <div class="card-body">
                            <div id="pie-chart-1" style="width:100%"></div>
                        </div>
                    </div> -->
                </div>
                <?php
                $sql = "SELECT c.court_name,COUNT(*) as caseNo FROM `tbl_gst_case_law` g JOIN `tbl_court` c ON g.court_name = c.id  WHERE g.case_status = 'Approved' GROUP BY c.court_name";
                $db->select_sql($sql);

                $res2 =  $db->getResult();
                ?>
               
             <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['corechart']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {

                        var data = google.visualization.arrayToDataTable([
                            ['Court Name', 'No of Cases'],

                            <?php
                            foreach ($res2 as $val1) {
                               
                            ?>

                                ['<?php echo $val1['court_name'] ?>', <?php echo $val1['caseNo'] ?>],
                            <?php
                            }
                            ?>
                        ]);

                        var options = {
                            title: ' GST CASES COURT WISE',
                            pieSliceText: 'value',
                            width: 900,
                            height: 600,
                        };

                        var chart = new google.visualization.PieChart(document.getElementById('pieChart1'));
                       
                        chart.draw(data, options);
                    }
                </script> 

<script type="text/javascript">
                                    google.charts.load('current', {packages: ['corechart', 'bar']});
                                    google.charts.setOnLoadCallback(drawBasic);

                                    function drawBasic() {
                                        var data = google.visualization.arrayToDataTable([
                                            ['Court Name', 'No of Cases',{ role: 'annotation' }],
                                            <?php
                                              foreach($res2 as $row2){
                                                // if($row['case_year'] == 0){
                                                //     $row['case_year'] = 'NA';
                                                //   }
                                                ?>
                                                  ['<?php echo $row2['court_name'] ?>', <?php echo $row2['caseNo'] ?>,'<?php echo $row2['caseNo'] ?>'],
                                                <?php
                                              }
                                            ?>
                                          
                                        ]);

                                        var options = {
                                            title: 'GST CASES COURT WISE',
                                            width: 1200,
                                            height:800,
                                            chartArea: {top:30,bottum:0,width:"50%",height:"60%"},
                                            chart:{ margin:'100px' },
                                            colors: ['#b0120a', '#ffab91'],
                                            fontSize: 13,
                                            hAxis: {
                                            title: 'No of Cases',
                                           
                                            minValue: 0
                                            },
                                            vAxis: {
                                            title: 'Court Name'
                                            },
                                            legend: { position: "none" },
                                        };
                                        var chart = new google.visualization.BarChart(document.getElementById('chart_div2'));
                                        chart.draw(data, options);
                                        }
                                </script>
                <?php
                $sql = "SELECT r.case_year,COUNT(*) as caseNo  FROM `tbl_case_ref` r LEFT JOIN `tbl_gst_case_law` l on r.case_id = l.id  WHERE l.case_status = 'Approved'  GROUP BY case_year DESC";
                $db->select_sql($sql);
                $res =  $db->getResult();
                ?>
                
                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['corechart']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {

                        var data = google.visualization.arrayToDataTable([
                            ['Year', 'No of Cases'],

                            <?php
                            foreach ($res as $val2) {
                                if ($val2['case_year'] == 0) {
                                    $val2['case_year'] = 'NA';
                                }
                            ?>

                                ['<?php echo $val2['case_year'] ?>', <?php echo $val2['caseNo'] ?>],
                            <?php
                            }
                            ?>
                        ]);

                        var options = {
                            title: ' GST CASES YEAR WISE',
                            pieSliceText: 'value',
                            width: 900,
                            height: 600,
                        };

                        var chart = new google.visualization.PieChart(document.getElementById('pieChart2'));
                       
                        chart.draw(data, options);
                    }
                </script> 
                <script type="text/javascript">
                    google.charts.load('current', {
                        packages: ['corechart', 'bar']
                    });
                    google.charts.setOnLoadCallback(drawBasic);

                    function drawBasic() {
                        var data = google.visualization.arrayToDataTable([
                            ['Year', 'No of Cases', {
                                role: 'annotation'
                            }],
                            <?php
                            foreach ($res as $row) {
                                if ($row['case_year'] == 0) {
                                    $row['case_year'] = 'NA';
                                }
                            ?>['<?php echo $row['case_year'] ?>', <?php echo $row['caseNo'] ?>, '<?php echo $row['caseNo'] ?>'],
                            <?php
                            }
                            ?>

                        ]);

                        var options = {
                            title: 'GST CASES YEAR WISE',
                            width: 500,
                            height: 400,
                            chartArea: {
                                top: 40,
                                width: '50%'
                            },
                            colors: ['#3240a8'],
                            hAxis: {
                                title: 'No of Cases',
                                minValue: 0
                            },
                            vAxis: {
                                title: 'Year'
                            },
                            legend: {
                                position: "none"
                            },
                        };
                        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
                        chart.draw(data, options);
                    }
                </script>

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
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

</body>

</html>

<script>
    $('#year_case').DataTable();
    $('#court').DataTable();

    function pieChart(pie_id,bar_id){
      
        $('#'+pie_id).show();
        $('#'+bar_id).hide();
    }
    function barChart(pie_id,bar_id){
        $('#'+pie_id).hide();
        $('#'+bar_id).show();
    }

    function datapost(path, params, method) {
        //alert(path);
        method = method || "post"; // Set method to post by default if not specified.
        var form = document.createElement("form");
        form.setAttribute("method", method);
        form.setAttribute("action", path);
        for (var key in params) {
            if (params.hasOwnProperty(key)) {
                var hiddenField = document.createElement("input");
                hiddenField.setAttribute("type", "hidden");
                hiddenField.setAttribute("name", key);
                hiddenField.setAttribute("value", params[key]);
                form.appendChild(hiddenField);
            }
        }
        document.body.appendChild(form);
        form.submit();
    }
</script>