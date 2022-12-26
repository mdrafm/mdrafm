<?php include('common_function.php'); ?>
<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>

    <?php 
    
    include('header_link.php');
    include('../config.php');
    include 'database.php';
    $db = new Database();
  ?>

  <style>
     .notification{
        margin: 5% 30%;
        padding: 0 auto;
        /* border: 1px solid black; */
        width: 40%;
        height: auto;

      }
      .notify-header{
        padding-left: 30% !important ;
        font-size: 1.5rem;
        font-weight: 700;
        color: #281b1b;
        background-color: #3c93ab !important ;
        border-bottom: 1px solid #d7b5b5 !important ;
      }
  </style>

</head>

<body class="user-profile">


    <div class="wrapper ">

        <?php include('sidebar.php'); ?>

        <div class="main-panel" id="main-panel">
            <?php include('navbar.php'); ?>

            <div class="panel-header panel-header-sm">


            </div>

             <?php  

                 if($trng_type == 2){
                    
                    ?>
                      <div class="card card-nav-tabs notification">
                        <div class="card-header card-header-warning  notify-header">
                            Syllabus & Time Table
                        </div>
                        <div class="card-body">
                            
                            <table class="table">
                                <tr>
                                    <td>Syllabus of OFS Promotion</td>
                                    <td> <a href="assets/Syllabus_OFS_on_promotion.pdf" target="_blank" >View </a> </td>
                                </tr>
                                <tr> 
                                    <td>Time Table ( 05.09.2022 to 09.09.2022 )</td>
                                    <td> <a href="assets/time_table1.pdf" target="_blank" >View </a> </td>
                                </tr>
                                <tr>
                                    <td>Time Table ( 25.08.2022 to 03.09.2022 )</td>
                                    <td> <a href="assets/time_table.jpg" target="_blank" >View </a> </td>
                                </tr>
                                tr>
                                    <td>Time Table ( 12.09.2022 to 17.09.2022 )</td>
                                    <td> <a href="assets/time_table3.jpeg" target="_blank" >View </a> </td>
                                </tr>
                            </table>
                            
                        </div>
                    </div>
                    <?php
                 } 


                 if($trng_type == 4){
                    
                    ?>
            <div class="card card-nav-tabs notification">
                <div class="card-header card-header-warning  notify-header">
                    Notifications
                </div>
                <div class="card-body">

                    <table class="table">
                        <!-- <tr>
                                    <td>Syllabus of OFS Promotion</td>
                                    <td> <a href="assets/Syllabus_OFS_on_promotion.pdf" target="_blank" >View </a> </td>
                                </tr> -->
                        <tr>
                            <td>Nomination Letter </td>
                            <td> <a href="assets/docs/Nomination_Letter.pdf" target="_blank">View </a> </td>
                        </tr>
                        <!-- <tr>
                            <td>Welcome Letter</td>
                            <td> <a href="assets/docs/welcome_letter.pdf" target="_blank">View </a> </td>
                        </tr> -->
                        <tr>
                            <td>Time Table ( 19.12.2022 to 23.12.2022 )</td>
                            <td> <a href="assets/docs/Programme_Schedule.pdf" target="_blank">View </a> </td>
                        </tr>
                        
                    </table>

                </div>
            </div>
            <?php
                 } 

             ?>
        <!--     <div class="content2" style="display: <?php echo ($trng_type ==2)?'none':'' ?> " >
            <div class="card card-nav-tabs notification">
                <div class="card-header card-header-warning  notify-header">
                    Notifications
                </div>
                <div class="card-body">
                    <?php 
                       $program_id =  getProgramId(); 
                       $color = ['','#23755b','#4f4a47','rgb(168 77 22)','#851811','#3b7174'];
                       
                       echo "Time Table Approval";
                       $db->select('tbl_time_table_range',"*",null," program_id = '$program_id' AND type = 1 AND status != 0",null,null);
                    // print_r( $db->getResult());
                       foreach($db->getResult() as $row){
                           //print_r($row);
                          
                          ?>
                            <div class="alert" style="background-color: <?php echo $color[rand(1,5)] ?>" role="alert">
                            <?php echo $row['name']; ?> Pending for Approval 
                            </div>
                          <?php
                       }
                    ?>
                    <h4 class="card-title"></h4>
                    <p class="card-text"></p>
                    
                </div>
            </div>
            </div> -->

        </div>

        

        <!--   Core JS Files   -->
        <script src="assets/js/core/jquery.min.js"></script>
        <script src="assets/js/core/popper.min.js"></script>


        <script src="assets/js/core/bootstrap.min.js"></script>


        <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>




        <!--  Google Maps Plugin    -->

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGat1sgDZ-3y6fFe6HD7QUziVC6jlJNog"></script>

        <!-- Place this tag in your head or just before your close body tag. -->
        <script async defer src="../../../buttons.github.io/buttons.js"></script>


        <!-- Chart JS -->
        <script src="assets/js/plugins/chartjs.min.js"></script>

        <!--  Notifications Plugin    -->
        <script src="assets/js/plugins/bootstrap-notify.js"></script>





        <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="assets/js/now-ui-dashboard.minaa26.js?v=1.5.0" type="text/javascript"></script>
        <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
        <script src="assets/demo/demo.js"></script>


        <!-- Sharrre libray -->
        <script src="assets/demo/jquery.sharrre.js"></script>

       

        <script>
        $(document).ready(function() {
            $().ready(function() {
                
                $sidebar = $('.sidebar');
                $sidebar_img_container = $sidebar.find('.sidebar-background');

                $full_page = $('.full-page');

                $sidebar_responsive = $('body > .navbar-collapse');
                sidebar_mini_active = true;

                window_width = $(window).width();

                fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

                // if( window_width > 767 && fixed_plugin_open == 'Dashboard' ){
                //     if($('.fixed-plugin .dropdown').hasClass('show-dropdown')){
                //         $('.fixed-plugin .dropdown').addClass('show');
                //     }
                //
                // }

                $('.fixed-plugin a').click(function(event) {
                    // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
                    if ($(this).hasClass('switch-trigger')) {
                        if (event.stopPropagation) {
                            event.stopPropagation();
                        } else if (window.event) {
                            window.event.cancelBubble = true;
                        }
                    }
                });

                $('.fixed-plugin .background-color span').click(function() {
                    $(this).siblings().removeClass('active');
                    $(this).addClass('active');

                    var new_color = $(this).data('color');

                    if ($sidebar.length != 0) {
                        $sidebar.attr('data-color', new_color);
                    }

                    if ($full_page.length != 0) {
                        $full_page.attr('filter-color', new_color);
                    }

                    if ($sidebar_responsive.length != 0) {
                        $sidebar_responsive.attr('data-color', new_color);
                    }
                });

                $('.fixed-plugin .img-holder').click(function() {
                    $full_page_background = $('.full-page-background');

                    $(this).parent('li').siblings().removeClass('active');
                    $(this).parent('li').addClass('active');


                    var new_image = $(this).find("img").attr('src');

                    if ($sidebar_img_container.length != 0 && $(
                            '.switch-sidebar-image input:checked').length != 0) {
                        $sidebar_img_container.fadeOut('fast', function() {
                            $sidebar_img_container.css('background-image', 'url("' +
                                new_image + '")');
                            $sidebar_img_container.fadeIn('fast');
                        });
                    }

                    if ($full_page_background.length != 0 && $(
                            '.switch-sidebar-image input:checked').length != 0) {
                        var new_image_full_page = $('.fixed-plugin li.active .img-holder').find(
                            'img').data('src');

                        $full_page_background.fadeOut('fast', function() {
                            $full_page_background.css('background-image', 'url("' +
                                new_image_full_page + '")');
                            $full_page_background.fadeIn('fast');
                        });
                    }

                    if ($('.switch-sidebar-image input:checked').length == 0) {
                        var new_image = $('.fixed-plugin li.active .img-holder').find("img")
                            .attr('src');
                        var new_image_full_page = $('.fixed-plugin li.active .img-holder').find(
                            'img').data('src');

                        $sidebar_img_container.css('background-image', 'url("' + new_image +
                            '")');
                        $full_page_background.css('background-image', 'url("' +
                            new_image_full_page + '")');
                    }

                    if ($sidebar_responsive.length != 0) {
                        $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
                    }
                });

                $('.switch-sidebar-image input').on("switchChange.bootstrapSwitch", function() {
                    $full_page_background = $('.full-page-background');

                    $input = $(this);

                    if ($input.is(':checked')) {
                        if ($sidebar_img_container.length != 0) {
                            $sidebar_img_container.fadeIn('fast');
                            $sidebar.attr('data-image', '#');
                        }

                        if ($full_page_background.length != 0) {
                            $full_page_background.fadeIn('fast');
                            $full_page.attr('data-image', '#');
                        }

                        background_image = true;
                    } else {
                        if ($sidebar_img_container.length != 0) {
                            $sidebar.removeAttr('data-image');
                            $sidebar_img_container.fadeOut('fast');
                        }

                        if ($full_page_background.length != 0) {
                            $full_page.removeAttr('data-image', '#');
                            $full_page_background.fadeOut('fast');
                        }

                        background_image = false;
                    }
                });

                $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function() {
                    var $btn = $(this);

                    if (sidebar_mini_active == true) {
                        $('body').removeClass('sidebar-mini');
                        sidebar_mini_active = false;
                        nowuiDashboard.showSidebarMessage('Sidebar mini deactivated...');
                    } else {
                        $('body').addClass('sidebar-mini');
                        sidebar_mini_active = true;
                        nowuiDashboard.showSidebarMessage('Sidebar mini activated...');
                    }

                    // we simulate the window Resize so the charts will get updated in realtime.
                    var simulateWindowResize = setInterval(function() {
                        window.dispatchEvent(new Event('resize'));
                    }, 180);

                    // we stop the simulation of Window Resize after the animations are completed
                    setTimeout(function() {
                        clearInterval(simulateWindowResize);
                    }, 1000);
                });
            });
        });
         
      
   //$('.program_list').on('click', function(){
    
        
        </script>

</body>

</html>