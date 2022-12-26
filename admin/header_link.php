<?php
   session_start();


   //print_r($_SESSION);
   $user_id = (isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0 )? $_SESSION['user_id'] : -1;

   if($user_id == -1)
  {
	  header('location:../login.php');
	  exit;
  }
?>
<!-- <meta charset="utf-8" /> -->
<!-- <meta http-equiv="content-type" content="text/html;charset=utf-8" /> -->
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
<!-- <link rel="icon" type="image/png" href="assets/img/favicon.png"> -->
<link rel="icon" href="../images/logo.png">
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

<title>

</title>

<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />


<!-- Extra details for Live View on GitHub Pages -->
<!-- Canonical SEO -->
<link rel="canonical" href="https://www.creative-tim.com/product/now-ui-dashboard" />


<!--  Social tags      -->
<meta name="keywords" content="creative tim, html dashboard, html css dashboard, web dashboard, bootstrap 4 dashboard, bootstrap 4, css3 dashboard, bootstrap 4 admin, now ui dashboard bootstrap 4 dashboard, frontend, responsive bootstrap 4 dashboard, free dashboard, free admin dashboard, free bootstrap 4 admin dashboard">
<meta name="description" content="Now UI Dashboard is a beautiful Bootstrap 4 admin dashboard with a large number of components, designed to look beautiful and organized. If you are looking for a tool to manage and visualize data about your business, this dashboard is the thing for you.">


<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="Now Ui Dashboard by Creative Tim">
<meta itemprop="description" content="Now UI Dashboard is a beautiful Bootstrap 4 admin dashboard with a large number of components, designed to look beautiful and organized. If you are looking for a tool to manage and visualize data about your business, this dashboard is the thing for you.">

<meta itemprop="image" content="../../../s3.amazonaws.com/creativetim_bucket/products/75/opt_nudp_thumbnail.jpg">


<!-- Twitter Card data -->
<meta name="twitter:card" content="product">
<meta name="twitter:site" content="@creativetim">
<meta name="twitter:title" content="Now Ui Dashboard by Creative Tim">

<meta name="twitter:description" content="Now UI Dashboard is a beautiful Bootstrap 4 admin dashboard with a large number of components, designed to look beautiful and organized. If you are looking for a tool to manage and visualize data about your business, this dashboard is the thing for you.">
<meta name="twitter:creator" content="@creativetim">
<meta name="twitter:image" content="../../../s3.amazonaws.com/creativetim_bucket/products/75/opt_nudp_thumbnail.jpg">


<!-- Open Graph data -->
<meta property="fb:app_id" content="655968634437471">
<meta property="og:title" content="Now Ui Dashboard by Creative Tim" />
<meta property="og:type" content="article" />
<meta property="og:url" content="dashboard.html" />
<meta property="og:image" content="../../../s3.amazonaws.com/creativetim_bucket/products/75/opt_nudp_thumbnail.jpg"/>
<meta property="og:description" content="Now UI Dashboard is a beautiful Bootstrap 4 admin dashboard with a large number of components, designed to look beautiful and organized. If you are looking for a tool to manage and visualize data about your business, this dashboard is the thing for you." />
<meta property="og:site_name" content="Creative Tim" />




<!--     Fonts and icons     -->

  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
<!-- 
<link rel="stylesheet" href="../../../use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous"> -->

<!-- CSS Files -->

<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
<link href="assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" />



<link href="assets/css/now-ui-dashboard.minaa26.css?v=1.5.0" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.1/css/all.min.css" integrity="sha512-3M00D/rn8n+2ZVXBO9Hib0GKNpkm8MSUU/e2VNthDyBYxKWG+BftNYYcuEjXlyrSO637tidzMBXfE7sQm0INUg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- CSS Just for demo purpose, don't include it in your project -->
<link href="assets/demo/demo.css" rel="stylesheet" />
<link href="assets/css/bootstrap-datepicker3.css" rel="stylesheet" />
<link href="assets/css/toogle_btn.css" rel="stylesheet" />
<link href="assets/css/editor.css" type="text/css" rel="stylesheet"/>

<!-- <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet"> -->

    <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'../../../www.googletagmanager.com/gtm5445.html?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NKDMSK6');</script>
<!-- End Google Tag Manager -->


<style type="text/css">
  #alert_msg{
    position:absolute;
    z-index:1400;
    top:2%;
    /* right:4%; */
    margin:40px auto;
    text-align:center;
    /* background: #4aa6a2; */
    display:none;
}
.loader{
  display:none;
}
.error{
  color:red;
  /* border:1px solid red; */
}

.custom-select {

  color:black ! important;
}

.table>tbody>tr>td,
.table>tbody>tr>th,
.table>tfoot>tr>td,
.table>tfoot>tr>th,
.table>thead>tr>td,
.table>thead>tr>th {
    
    line-height: 18px;
}
.card label{
  font-size: 16px;
}

@media screen and (max-width: 600px) {
  .navbar-wrapper p{
    margin-left: 0px !important;
    font-size: 11px !important;
  }
  .panel-header-sm {
    height: 75px !important;
}
.panel-header {
  padding-top: 50px !important;
    padding-bottom: 25px !important;
}
.form_one{
  width: 120% !important;
  margin-left: -20px !important;
}
#p_address{
  margin-left: -198px;
}
}
.bck_btn{
    text-decoration: none !important;
   
    border-radius: 50%;
    background-color: #18793d;
    color: #fff;
    padding: 11px;
    margin: 12px;
}
.modal { overflow: auto !important; }

  </style>