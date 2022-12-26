<!--

=========================================================
* Now UI Dashboard - v1.5.0
=========================================================

* Product Page: https://www.creative-tim.com/product/now-ui-dashboard
* Copyright 2019 Creative Tim (http://www.creative-tim.com)

* Designed by www.invisionapp.com Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

-->

<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from demos.creative-tim.com/now-ui-dashboard/examples/user.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 20 Jan 2022 15:09:23 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
   <head> 
   <?php 
    
    include('header_link.php');
    include('../config.php');
    include 'database.php';
    ?>
   
   <style type="text/css">

        .file {
        visibility: hidden;
        position: absolute;
        }


</style>
    </head>

    <body class="user-profile">
      
      <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->


        <div class="wrapper ">
          
            <?php include('sidebar.php'); ?>

            <div class="main-panel" id="main-panel">
            <?php include('navbar.php'); ?>

                  <div class="panel-header panel-header-sm">
  
  
                  </div>


                  <div class="content">
    
<div class="row">
     <div class="col-md-2">
     </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="title">Form-I</h5>
            </div>
            <div class="card-body">
                <form>
                   
                    <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                                <label><strong>Name of the Training</strong></label>
                                <input type="text" class="form-control" placeholder=" Name of the Training" >
                            </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                                <label><strong>Period of training</strong></label>
                                <input type="text" class="form-control" placeholder=" Period of training" >
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                                <label><strong>Name of the Trainee</strong></label>
                                <input type="text" class="form-control" placeholder=" Enter First Name" >
                            </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                                <label><strong> </strong></label>
                                <input type="text" class="form-control" placeholder=" Enter Last Name" >
                            </div>
                        </div>
                       
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                                <label><strong>Father's Name</strong></label>
                                <input type="text" class="form-control" placeholder=" Enter Father's Name" >
                            </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                                <label><strong>Mother's Name</strong></label>
                                <input type="text" class="form-control" placeholder=" Enter Mother's Name" >
                            </div>
                        </div>
                       
                    </div>
                    
                    
                    <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                                <label><strong>Email</strong></label>
                                <input type="text" class="form-control" name="t_name" placeholder="Enter your Email" >
                            </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                                <label><strong> Blood Group</strong></label>
                                <select class="custom-select mr-sm-2" style="border-radius: 30px;">

                                    <option >A+</option>
                                    <option >A-</option>
                                    <option >B+</option>
                                    <option >B-</option>
                                    <option >AB+</option>
                                    <option >AB-</option>
                                    <option >O+</option>
                                    <option >O-</option>
                                   
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        
                        <div class="col-md-6">
                           <div class="form-group">
                                <label><strong>Educational Qualifications</strong></label>
                                <input type="text" class="form-control" name="t_name" placeholder="Educational Qualifications" >
                            </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                                <label><strong>Date of Birth</strong></label>
                                <input type="date" class="form-control date-withicon" placeholder="Select Date"/>
                            </div>
                        </div>
                    </div>
                    
                    <hr style="box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label style="padding-left: 43%;"><strong>Contact Details</strong></label></br>
                                <label><strong>Parmanent Address</strong></label>
                                <input type="text" class="form-control" placeholder="Enter Parmanent Address" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 pr-1">
                            <div class="form-group">
                                <!-- <label><strong>State</strong></label> -->
                                <input type="text" class="form-control" placeholder="State" >
                            </div>
                        </div>
                        <div class="col-md-4 px-1">
                            <div class="form-group">
                                <!-- <label><strong>District</strong></label> -->
                                <input type="text" class="form-control" placeholder="District" >
                            </div>
                        </div>
                        <div class="col-md-4 pl-1">
                            <div class="form-group">
                                <!-- <label><strong>Pin Code</strong></label> -->
                                <input type="number" class="form-control" placeholder="PIN Code">
                            </div>
                        </div>
                    </div>
                    <hr style="box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Present Address</strong></label>
                                <label style="padding-left: 50px;" > <input class="form-check-input" type="checkbox" value="1" id="p_address" onchange="valueChanged()" > <strong>Same as Parmanent Address</strong></label>
                                <input type="text" class="form-control addr" placeholder="Enter Present Address" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 pr-1">
                            <div class="form-group">
                                <!-- <label><strong>State</strong></label> -->
                                <input type="text" class="form-control addr" placeholder="State" >
                            </div>
                        </div>
                        <div class="col-md-4 px-1">
                            <div class="form-group">
                                <!-- <label><strong>District</strong></label> -->
                                <input type="text" class="form-control addr" placeholder="District" >
                            </div>
                        </div>
                        <div class="col-md-4 pl-1">
                            <div class="form-group">
                                <!-- <label><strong>Pin Code</strong></label> -->
                                <input type="number" class="form-control addr" placeholder="PIN Code">
                            </div>
                        </div>
                       
                    </div>
                   <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                                <label><strong>Mobile Number</strong></label>
                                <input type="text" class="form-control" name="t_name" placeholder="Phone Number" >
                            </div>
                            </div>
                        <div class="col-md-6">
                           <div class="form-group">
                                <label><strong>Email</strong></label>
                                <input type="text" class="form-control" name="t_name" placeholder="Enter your Email" >
                            </div>
                            </div>
                     </div>
                   <div class="row">
                         <div class="col-md-12">
                            <div class="form-group">
                                <label style="padding-left: 43%;"><strong>Bank Details</strong></label>

                            </div></div>
                            <div class="col-md-6">
                           <div class="form-group">
                                <label><strong>Bank Name</strong></label>
                                <input type="text" class="form-control" name="t_name" placeholder="Enter Bank Name" >
                            </div>
                            </div>
                            <div class="col-md-6">
                           <div class="form-group">
                                <label><strong>Account No.</strong></label>
                                <input type="text" class="form-control" name="t_name" placeholder="Enter Account No" >
                            </div>
                            </div>
                            <div class="col-md-6">
                           <div class="form-group">
                                <label><strong>IFSC Code</strong></label>
                                <input type="text" class="form-control" name="t_name" placeholder="Enter IFSC Code" >
                            </div>
                            </div>
                            <div class="col-md-6">
                          <label for="photo" style="margin-left: 20px;"><strong>Marital Status</strong></label>
                            <div class="form-check form-check-inline" style="margin-left: 20px;">
                                <input class="form-check-input" type="radio" name="status" id="active" value="active">
                            <label class="form-check-label" for="inlineRadio1" style="padding-left: 5px;">Married</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="inactive" value="inactive">
                                <label class="form-check-label" for="inlineRadio2" style="padding-left: 5px;">Unmarried</label>
                            </div>
                        </div>

                   </div>


                    <div class="row">
                      <div class="col-md-12">
                            <div class="form-group">
                                <label style="padding-left: 43%;"><strong>Health & Medical History(indicate if)</strong></label>

                            </div></div>
                           <div class="form-check">
      <label class="form-check-label font-weight-bold">
          <input class="form-check-input" type="checkbox" value="" >
         Pregnant Woman
          <span class="form-check-sign ">
              <span class="check"></span>
          </span>
      </label>
  </br>
       <label class="form-check-label font-weight-bold">
          <input class="form-check-input" type="checkbox" value="">
          Lactating Mother
          <span class="form-check-sign">
              <span class="check"></span>
          </span>
      </label>
       </br>
       <label class="form-check-label font-weight-bold">
          <input class="form-check-input" type="checkbox" value="">
          Severe Asthma or chronic disease
          <span class="form-check-sign">
              <span class="check"></span>
          </span>
      </label>
       </br>
       <label class="form-check-label font-weight-bold">
          <input class="form-check-input" type="checkbox" value="">
         High Blood pressure
          <span class="form-check-sign">
              <span class="check"></span>
          </span>
      </label>
       </br>
       <label class="form-check-label font-weight-bold">
          <input class="form-check-input" type="checkbox" value="">
        People with chronic kidney disease undergoing dialysis
          <span class="form-check-sign">
              <span class="check"></span>
          </span>
      </label>
       </br>
       <label class="form-check-label font-weight-bold">
          <input class="form-check-input" type="checkbox" value="">
       Serious heart condition
          <span class="form-check-sign">
              <span class="check"></span>
          </span>
      </label>
       </br>
       <label class="form-check-label font-weight-bold">
          <input class="form-check-input" type="checkbox" value="">
       Any other medical condition that has potential high risk in the COVID environment in the opinion of medical expert
          <span class="form-check-sign">
              <span class="check"></span>
          </span>
      </label>
       </br>
        <label class="form-check-label font-weight-bold">
          <input class="form-check-input" type="checkbox" value="">
       Any other category/symptom as notified
          <span class="form-check-sign">
              <span class="check"></span>
          </span>
      </label>
      <div class="col-md-6">
                           <div class="form-group">
                                <label><strong>Others</strong></label>
                                <input type="text" class="form-control" name="t_name" placeholder="Please Specify" >
                            </div>
                        </div>

  </div>
                                  

                    </div>

                 <div class="row">
                   <div class="col-md-6">
                          <label for="photo" style="margin-left: 20px;"><strong>Whether Differently Abled?</strong></label>
                            <div class="form-check form-check-inline" style="margin-left: 20px;">
                                <input class="form-check-input" type="radio" name="status" id="active" value="active">
                            <label class="form-check-label" for="inlineRadio1" style="padding-left: 5px;">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="inactive" value="inactive">
                                <label class="form-check-label" for="inlineRadio2" style="padding-left: 5px;">No</label>
                            </div>
                        </div>
                   </div>
                   <div class="row">
                   <div class="col-md-6">
                          <label for="photo" style="margin-left: 20px;"><strong>Past Service experience(If any)</strong></label></div>
                            
                            <div class="col-md-6">
                              <input style="margin-right: 50%;" type="text" class="form-control" name="t_name" placeholder="Please Specify" >  
                            
                        </div>
                   </div>
                    <div class="row">
                   <div class="col-md-6">
                          <label for="photo" style="margin-left: 20px;"><strong>Hostel Accommodation</strong></label>
                            <div class="form-check form-check-inline" style="margin-left: 20px;">
                                <input class="form-check-input" type="radio" name="status" id="active" value="active">
                            <label class="form-check-label" for="inlineRadio1" style="padding-left: 5px;">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="inactive" value="inactive">
                                <label class="form-check-label" for="inlineRadio2" style="padding-left: 5px;">No</label>
                            </div>
                        </div>
                   </div>
                    
                        <div class="row">
                            <div class="col-md-12">
                            
                                <label style="padding-left: 43%;"><strong>Upload Dcoumnets</strong></label>
                                </div>

                                <div class="col-md-6">
                            
                                <label class="form-check-label" style="padding-top: 20%;"><strong>Passport size Photo</strong></label>
                               </div>
                               <div class="col-md-6">
                                <div class="ml-2 col-sm-6">
  <img  id="preview" class="img-thumbnail">
</div> 
  <form method="post" id="image-form">
    <input type="file" name="img[]" class="file" accept="image/*" class="form-check-input">
    <div class="form-check form-check-inline input-group my-3">
      <input type="text" class="form-control" disabled placeholder="Upload File" id="file">
      <div class="input-group-append">
        <button type="button" class="browse btn btn-primary">Browse...</button>
      </div>
    </div>
  </form>


  
                                
                        </div>

     <div class="col-md-6">
                            
                                <label class="form-check-label" style="padding-top: 20%;"><strong>Joining report in OGFR II Form</strong></label>
                                <input class="form-control" type="file" name="team_approval_file" id="attached_filesid"/>
                               </div>
 
                        <div class="col-md-6">
                            
                                <label class="form-check-label" style="padding-top: 20%;"><strong>Character Certificate I & II</strong></label>
                               
                               <input class="form-control" type="file" name="team_approval_file" id="attached_filesid"/>
                             </div>     
                        <div class="col-md-6">
                            
                                <label class="form-check-label" style="padding-top: 20%;"><strong><select class="custom-select mr-sm-2" style="border-radius: 30px;">
                                	<option>Adhar Card</option>
                                	<option>Voter Id</option></select></strong></label>
                                <input class="form-control" type="file" name="team_approval_file" id="attached_filesid"/>
                               </div>
                                   
                        <div class="col-md-6">
                            
                                <label class="form-check-label" style="padding-top: 20%;"><strong>PAN Card</strong></label>
                                <input class="form-control" type="file" name="team_approval_file" id="attached_filesid"/>
                               </div>
                                   
                        <div class="col-md-6">
                            
                                <label class="form-check-label" style="padding-top: 20%;"><strong>HSC Certificate</strong></label>
                                <input class="form-control" type="file" name="team_approval_file" id="attached_filesid"/>
                               </div>
                                   
                        <div class="col-md-6">
                            
                                <label class="form-check-label" style="padding-top: 20%;"><strong>Non-employment Certificate</strong></label>
                                <input class="form-control" type="file" name="team_approval_file" id="attached_filesid"/>
                               </div>
                                   
                        <div class="col-md-6">
                            
                                <label class="form-check-label" style="padding-top: 20%;"><strong>Undertaking/Declaration</strong></label>
                                <input class="form-control" type="file" name="team_approval_file" id="attached_filesid"/>
                               </div>
                                   
                        <div class="col-md-6">
                            
                                <label class="form-check-label" style="padding-top: 20%;"><strong>First page of Bank Passbook/Cancelled Bank Cheque Leaf</strong></label>
                                <input class="form-control" type="file" name="team_approval_file" id="attached_filesid"/>
                               </div>
                                  
                        <div class="col-md-6">
                            
                                <label class="form-check-label" style="padding-top: 20%;"><strong>PRAN Card</strong></label>
                                <input class="form-control" type="file" name="team_approval_file" id="attached_filesid"/>
                               </div>
                               
                        <div class="col-md-6">
                            
                                <label class="form-check-label" style="padding-top: 20%;"><strong>NPS Registration form</strong></label>
                                <input class="form-control" type="file" name="team_approval_file" id="attached_filesid"/>
                               </div>
                                      








                        </div>








                        <div class="row">
                          <div class="col-md-5"></div>
                        <div class="col-md-6">
                         <input type="button" class="btn btn-primary" name="submit" value="Save" >
                        </div>
                        </div>
                    </div>
                    </div>
                    
                    
                </form>
            </div>
        </div>
    </div>
    <!-- <div class="col-md-4">
        <div class="card card-user">
            <div class="image">
                <img src="assets/img/bg5.jpg" alt="...">
            </div>
            <div class="card-body">
                <div class="author">
                     <a href="#">
                    <img class="avatar border-gray" src="assets/img/mike.jpg" alt="...">
                        <h5 class="title">Mike Andrew</h5>
                    </a>
                    <p class="description">
                        michael24
                    </p>
                </div>
                <p class="description text-center">
                    "Lamborghini Mercy <br>
                    Your chick she so thirsty <br>
                    I'm in that two seat Lambo"
                </p>
            </div>
            <hr>
            <div class="button-container">
                <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                    <i class="fab fa-facebook-f"></i>
                </button>
                <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                    <i class="fab fa-twitter"></i>
                </button>
                <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                    <i class="fab fa-google-plus-g"></i>
                </button>
            </div>
        </div>
    </div> -->
</div>

                  </div>

                  

               
             </div>
          
        </div>
        
            <div class="fixed-plugin">
    <div class="dropdown show-dropdown">
        <a href="#" data-toggle="dropdown">
        <i class="fa fa-cog fa-2x"> </i>
        </a>
        <ul class="dropdown-menu">
			<li class="header-title"> Sidebar Background</li>
            <li class="adjustments-line">
                <a href="javascript:void(0)" class="switch-trigger background-color">
                    <div class="badge-colors text-center">
						<span class="badge filter badge-yellow" data-color="yellow"></span>
                        <span class="badge filter badge-blue" data-color="blue"></span>
                        <span class="badge filter badge-green" data-color="green"></span>
                        <span class="badge filter badge-orange active" data-color="orange"></span>
                        <span class="badge filter badge-red" data-color="red"></span>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </li>

            

            
            <li class="button-container">
                <a href="https://www.creative-tim.com/product/now-ui-dashboard" target="_blank" class="btn btn-primary btn-block btn-round">Download Now</a>
                <a href="https://demos.creative-tim.com/now-ui-dashboard/docs/1.0/getting-started/introduction.html" target="_blank" class="btn btn-default btn-block btn-round">
                    <i class="now-ui-icons files_single-copy-04"></i>
                    Documentation
                </a>
            </li>
            

            <li class="header-title">Thank you for 95 shares!</li>

            <li class="button-container text-center">
                <button id="twitter" class="btn btn-round btn-info"><i class="fab fa-twitter"></i> &middot; 45</button>
                <button id="facebook" class="btn btn-round btn-info"><i class="fab fa-facebook-f"></i> &middot; 50</button>
                <br>
                <br>
                <a class="github-button" href="https://github.com/creativetimofficial/now-ui-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star ntkme/github-buttons on GitHub">Star</a>
            </li>
        </ul>
    </div>
</div>

        
        















<!--   Core JS Files   -->
<script src="assets/js/core/jquery.min.js" ></script>
<script src="assets/js/core/popper.min.js" ></script>


<script src="assets/js/core/bootstrap.min.js" ></script>


<link rel="stylesheet" href="../css/bootstrap-datepicker3.css"/>
<script type="text/javascript" src="../js/bootstrap-datepicker.min.js"></script>
<script>
$(function(){
   $('.date-withicon').datepicker({
      format: 'mm-dd-yyyy'
    });
});
</script>



<!--  Google Maps Plugin    -->

<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGat1sgDZ-3y6fFe6HD7QUziVC6jlJNog"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="../../../buttons.github.io/buttons.js"></script>


<!-- Chart JS -->
<script src="assets/js/plugins/chartjs.min.js"></script>

<!--  Notifications Plugin    -->
<script src="assets/js/plugins/bootstrap-notify.js"></script>





<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc --><script src="assets/js/now-ui-dashboard.minaa26.js?v=1.5.0" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/demo/demo.js"></script>


  <!-- Sharrre libray -->
<script src="assets/demo/jquery.sharrre.js"></script>

<script>
  $(document).ready(function(){
   
       $('.nav li ').click(function(){
    $('.nav li ').removeClass("active");
    $(this).addClass("active");
});
   
    
    $('#facebook').sharrre({
  share: {
    facebook: true
  },
  enableHover: false,
  enableTracking: false,
  enableCounter: false,
  click: function(api, options){
    api.simulateClick();
    api.openPopup('facebook');
  },
  template: '<i class="fab fa-facebook-f"></i> Facebook',
  url: 'https://demos.creative-tim.com/now-ui-dashboard/examples/dashboard.html'
});

    $('#google').sharrre({
  share: {
    googlePlus: true
  },
  enableCounter: false,
  enableHover: false,
  enableTracking: true,
  click: function(api, options){
    api.simulateClick();
    api.openPopup('googlePlus');
  },
  template: '<i class="fab fa-google-plus"></i> Google',
  url: 'https://demos.creative-tim.com/now-ui-dashboard/examples/dashboard.html'
});

    $('#twitter').sharrre({
  share: {
    twitter: true
  },
  enableHover: false,
  enableTracking: false,
  enableCounter: false,
  buttons: { twitter: {via: 'CreativeTim'}},
  click: function(api, options){
    api.simulateClick();
    api.openPopup('twitter');
  },
  template: '<i class="fab fa-twitter"></i> Twitter',
  url: 'https://demos.creative-tim.com/now-ui-dashboard/examples/dashboard.html'
});

    
    
    
    // Facebook Pixel Code Don't Delete
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','../../../connect.facebook.net/en_US/fbevents.js');

try{
  fbq('init', '111649226022273');
  fbq('track', "PageView");

}catch(err) {
  console.log('Facebook Track Error:', err);
}

  });
</script>
<noscript>
  <img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=111649226022273&amp;ev=PageView&amp;noscript=1"
/>

</noscript>

  <script>

    $(document).on("click", ".browse", function() {

  var file = $(this).parents().find(".file");
  file.trigger("click");
     
});

$('input[type="file"]').change(function(e) {

  var fileName = e.target.files[0].name;
  $("#file").val(fileName);

  var reader = new FileReader();
  reader.onload = function(e) {
    // get loaded data and render thumbnail.
    document.getElementById("preview").src = e.target.result;
  };
  // read the image file as a data URL.
  reader.readAsDataURL(this.files[0]);
});

  $(document).ready(function(){
    $().ready(function(){

        
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

        $('.fixed-plugin a').click(function(event){
          // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
            if($(this).hasClass('switch-trigger')){
                if(event.stopPropagation){
                    event.stopPropagation();
                }
                else if(window.event){
                   window.event.cancelBubble = true;
                }
            }
        });

        $('.fixed-plugin .background-color span').click(function(){
            $(this).siblings().removeClass('active');
            $(this).addClass('active');

            var new_color = $(this).data('color');

            if($sidebar.length != 0){
                $sidebar.attr('data-color',new_color);
            }

            if($full_page.length != 0){
                $full_page.attr('filter-color',new_color);
            }

            if($sidebar_responsive.length != 0){
                $sidebar_responsive.attr('data-color',new_color);
            }
        });

        $('.fixed-plugin .img-holder').click(function(){
            $full_page_background = $('.full-page-background');

            $(this).parent('li').siblings().removeClass('active');
            $(this).parent('li').addClass('active');


            var new_image = $(this).find("img").attr('src');

            if( $sidebar_img_container.length !=0 && $('.switch-sidebar-image input:checked').length != 0 ){
                $sidebar_img_container.fadeOut('fast', function(){
                   $sidebar_img_container.css('background-image','url("' + new_image + '")');
                   $sidebar_img_container.fadeIn('fast');
                });
            }

            if($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0 ) {
                var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                $full_page_background.fadeOut('fast', function(){
                   $full_page_background.css('background-image','url("' + new_image_full_page + '")');
                   $full_page_background.fadeIn('fast');
                });
            }

            if( $('.switch-sidebar-image input:checked').length == 0 ){
                var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
                var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                $sidebar_img_container.css('background-image','url("' + new_image + '")');
                $full_page_background.css('background-image','url("' + new_image_full_page + '")');
            }

            if($sidebar_responsive.length != 0){
                $sidebar_responsive.css('background-image','url("' + new_image + '")');
            }
        });

        $('.switch-sidebar-image input').on("switchChange.bootstrapSwitch", function(){
            $full_page_background = $('.full-page-background');

            $input = $(this);

            if($input.is(':checked')){
                if($sidebar_img_container.length != 0){
                    $sidebar_img_container.fadeIn('fast');
                    $sidebar.attr('data-image','#');
                }

                if($full_page_background.length != 0){
                    $full_page_background.fadeIn('fast');
                    $full_page.attr('data-image','#');
                }

                background_image = true;
            } else {
                if($sidebar_img_container.length != 0){
                    $sidebar.removeAttr('data-image');
                    $sidebar_img_container.fadeOut('fast');
                }

                if($full_page_background.length != 0){
                    $full_page.removeAttr('data-image','#');
                    $full_page_background.fadeOut('fast');
                }

                background_image = false;
            }
        });

        $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function(){
          var $btn = $(this);

          if(sidebar_mini_active == true){
              $('body').removeClass('sidebar-mini');
              sidebar_mini_active = false;
              nowuiDashboard.showSidebarMessage('Sidebar mini deactivated...');
          }else{
              $('body').addClass('sidebar-mini');
              sidebar_mini_active = true;
              nowuiDashboard.showSidebarMessage('Sidebar mini activated...');
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function(){
              window.dispatchEvent(new Event('resize'));
          },180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function(){
              clearInterval(simulateWindowResize);
          },1000);
        });
    });
  });

  function valueChanged(){
      if($('#p_address').is(':checked'))
          $('.addr').hide();
      else
          $('.addr').show();
  }
</script>

    </body>

</html>
