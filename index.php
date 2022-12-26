
<?php 
 session_start();

 
if (isset($_SESSION))
{
      session_destroy();
      unset($_SESSION);
}

include('header.php'); 
include('nav_bar.php') ;

?>

<?php 

include ('admin/database.php');
$conn = new Database();

?>
<!--location Modal start -->
<div class="modal fade" id="location" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 650px">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Madhusudan Das Regional Academy of Financial
                    Management (MDRAFM), Bhubaneswar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14967.093460744445!2d85.8138516!3d20.3096459!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x1e98ae9e0901e35c!2sMadhusudan%20Das%20Regional%20Academy%20of%20Financial%20Management%20(MDRAFM)!5e0!3m2!1sen!2sin!4v1643266425146!5m2!1sen!2sin"
                    width="600" height="350" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <!-- <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  
                  </div> -->
        </div>
    </div>
</div>
<!-- location Modal end -->
<!-- info section start -->
<section class="info">

    <div  class="build_img">
        <img src="images/building1.jpg" style="width: 400px;height: 275px;" />
    </div>
    <div class="info-dtls" style="height: 275px;;overflow: hidden; padding:5px ">

       
        <div class="program">
            <div class="program-wrap">
                <h3>Ongoing Training Programmes</h3>
                <div class="view-content" style="height: 200px;overflow: hidden;margin-top: -4px;">
                   
                        <ul style="list-style-type: circle;padding: 20px;">
                        <?php 
                                  
                                  $conn->select('tbl_other_program',"*",null,null,null,null);
                                  $res = $conn->getResult();
                                    foreach($res as $row){
                                          //print_r($row);exit;
                                      $curr = date("Y-m-d");
                                      $currDate=date('Y-m-d', strtotime($curr));

                                    $active = date('Y-m-d', strtotime($row['active_dt']));
                                    $inActive = date('Y-m-d', strtotime($row['in_active_dt']));
                                    
                                    if (($currDate >= $active) && ($currDate <= $inActive)){
                                          ?>
                                          <li>
                                                <a style="color: #0d3746;text-decoration: none;font-weight: 300;font-size: 15px;" href="onGoingProgram.php">
                                                <?php echo $row['title']; ?>
                                                </a>
                                                <span><img src="images/newicon.gif" style="height: 20px; width: 40px; user-select: auto;display:<?php echo ($row['new'] == 1)?'':'none'; ?>"></span>
                                          </li>
                                          
                                          <hr style="border:none;background:rgb(230 4 4 / 57%);height:1px;margin:10px 0px; width:390px;">
                                                
                                       <?php
                                    }
                                       
                                  }
                              
                              ?>


                        </ul>
                   

                </div>
                <!-- <div style="float: right;margin-top: -8px">
                    <a href="onGoingProgram.php"> View More </a>
                </div> -->
            </div>
        </div>
       
        <br>
    </div>
    <div class="woners" style="width: 400px;background-image: url('images/istock.jpg')">
            <!-- <img src="images/bg-2.jpg" style="width: 400px;float: right;" /> -->

            <div class="header-buttom ">
                    <div class="pt-1" style="margin-bottom: 10px;">
                        <div class="Profile prof2" style="width:300px;">
                            <img class="photo" src="images/np.jpg" width="70" height="83"
                                style="display:block; float:left; margin-right:8px; border:solid 1px #CCC;">
                            <div class="desig pt-4" ><strong>Shri Niranjan Pujari</strong><br><p style="color:#010101;font-size: 12px;"> Hon'ble Cabinet Minister, Finance</p></div>
                        </div>
                    </div>
                    <div class="pb-2" >
                        <div class="Profile prof3" style="width:300px;">
                            <img class="photo" src="images/pri_sec.png" width="70" height="83"
                                style="display:block; float:left; margin-right:8px; border:solid 1px #CCC;">
                            <div class="desig pt-4"><strong>Shri Vishal Kumar Dev, IAS</strong><br> <p style="color:#010101;font-size: 12px;">Principal Secretary, Finance</p></div>
                        </div>
                    </div>
                    <div class="img3" style="margin-bottom: 15px;">
                        <div class="Profile prof" style="width:300px;">
                            <img class="photo" src="images/ak_mohanty.jpg" width="70" height="83"
                                style="display:block; float:left; margin-right:8px; border:solid 1px #CCC;">
                            <div class="desig pt-4"><strong>Shri Ashok kumar Mohanty, OFS</strong><br><p style="color:#010101;font-size: 12px;">Director,MDRAFM</p></div>
                        </div>
                    </div>
                </div>
    </div>
</section>
<!-- info section end -->
<!-- news section start -->
<!-- <div class=" " style="margin-top:-10px ;background-image:url(images/bg-1-1.jpg);height: 365px;" > -->
<section class="" style="display: block;">
    <div class="notice ">
        <div class=" information">
            <div class="new info-box holder" style="background-color:#dcdcdc;">
                <h3 class="content-header">MDRAFM News</h3>
                <div class="content ">
                    <div class="view-content" style="">
                       
                            <ul style="list-style-type: circle;padding: 20px;" id="news2">
                            <?php 
                                  
                                  $conn->select('tbl_news',"*",null,null,null,null);
                                  $res1 = $conn->getResult();
                                    foreach($res1 as $row1){
                                         // print_r($row1);exit;
                                      $curr = date("Y-m-d");
                                      $currDate=date('Y-m-d', strtotime($curr));

                                    $active = date('Y-m-d', strtotime($row1['active_dt']));
                                    $inActive = date('Y-m-d', strtotime($row1['in_active_dt']));
                                    
                                    if (($currDate >= $active) && ($currDate <= $inActive)){
                                          ?>
                                          <li>
                                                <a style="color: #0d3746;text-decoration: none;font-weight: 300;font-size: 15px;" href="news.php">
                                                <?php echo $row1['title']; ?>
                                                </a>
                                                <span><img src="images/newicon.gif" style="height: 20px; width: 40px; user-select: auto;display:<?php echo ($row1['new'] == 1)?'':'none'; ?>"></span>
                                          </li>
                                          
                                          <hr style="border:none;background:rgb(230 4 4 / 57%);height:1px;margin:10px 0px; width:390px;">
                                                
                                       <?php
                                    }
                                       
                                  }
                              
                              ?>

                            </ul>
                       
                    </div>

                    <!-- <div class="footer-content">
                        <a href="news.php"> View More </a>
                    </div> -->
                </div>
            </div>

            <div class="notification info-box holder" style="background-color:#dcdcdc;">
                <h3 class="content-header">Image Gallery</h3>
                <div class="content">
                    <div class="view-content" style="height: 195px;overflow-y:hidden;">
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="images/galary/image16.jpg" class="d-block w-100" alt="...">
                            </div>
                        <?php
                               for($i=1;$i<11;$i++){
                                  
                                   ?>
                                   <div class="carousel-item  ">
                                        <img src="images/galary/image<?php echo $i; ?>.jpg" class="d-block w-100" alt="...">
                                    </div>
                                   <?php
                               }
                            ?>
                           
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                        </div>
                    </div>

                    <!-- <div class="footer-content">
                        <a href="notification.php"> View More </a>
                    </div> -->
                </div>
            </div>
            
            <div class="events info-box holder" style="background-color:#dcdcdc;">
                <h3 class="content-header">Other Events</h3>
                <div class="content">
                    <div class="view-content" style="">
                   
                        <ul style="list-style-type: circle;padding: 20px;" id="news">
                        <?php 
                                  
                                  $conn->select('tbl_other_event',"*",null,null,null,null);
                                  $res1 = $conn->getResult();
                                    foreach($res1 as $row1){
                                         // print_r($row1);exit;
                                      $curr = date("Y-m-d");
                                      $currDate=date('Y-m-d', strtotime($curr));

                                    $active = date('Y-m-d', strtotime($row1['active_dt']));
                                    $inActive = date('Y-m-d', strtotime($row1['in_active_dt']));
                                    
                                    if (($currDate >= $active) && ($currDate <= $inActive)){
                                          ?>
                                          <li>
                                                <a style="color: #0d3746;text-decoration: none;font-weight: 300;font-size: 15px;" href="#" 
                                                onclick="datapost('events.php',{id: <?php echo $row1['id'] ?> })" >
                                                <?php echo $row1['title']; ?>
                                                </a>
                                                <span><img src="images/newicon.gif" style="height: 20px; width: 40px; user-select: auto;display:<?php echo ($row1['new'] == 1)?'':'none'; ?>"></span>
                                          </li>
                                          
                                          <hr style="border:none;background:rgb(230 4 4 / 57%);height:1px;margin:10px 0px; width:390px;">
                                                
                                       <?php
                                    }
                                       
                                  }
                              
                              ?>
                        </ul>
                       
                    </div>

                    <!-- <div class="footer-content">
                        <a href="events.php"> View More </a>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- </div> -->
<!-- news section end -->
<div id="scroll-container">
  <div id=""><marquee  width="">
  For any application issues kindly e-mail us at : <b>mdraf.fin@gmail.com</b></marquee></div>
</div>

<?php include('footer.php') ?>


<script type="text/javascript">
    
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
<!-- <script>
function tick() {
    console.log(123);
    $('#news li:first').slideUp(function() {
        $(this).appendTo($('#news')).slideDown();
    });
    $('#news hr:first').slideUp(function() {
        $(this).appendTo($('#news')).slideDown();
    });

    $('#notify li:first').slideUp(function() {
        $(this).appendTo($('#notify')).slideDown();
    });
    $('#notify hr:first').slideUp(function() {
        $(this).appendTo($('#notify')).slideDown();
    });
}

// jquery ready start
$(document).ready(function() {
    // jQuery code
    setInterval(function() {
        tick()
    }, 3000);

    //////////////////////// Prevent closing from click inside dropdown
    $(document).on('click', '.dropdown-menu', function(e) {
        e.stopPropagation();
    });

    // make it as accordion for smaller screens
    if ($(window).width() < 992) {
        $('.dropdown-menu a').click(function(e) {
            e.preventDefault();
            if ($(this).next('.submenu').length) {
                $(this).next('.submenu').toggle();
            }
            $('.dropdown').on('hide.bs.dropdown', function() {
                $(this).find('.submenu').hide();
            })
        });
    }

}); // jquery end
</script> -->