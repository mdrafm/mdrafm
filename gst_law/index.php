<?php
session_start();

include('header.php')
?>
<?php include('navbar.php') ?>
<?php
include('../admin/database.php');


if (isset($_SESSION)) {
	session_destroy();
	unset($_SESSION);
}
$db = new Database();
?>

<div class="news-head">
	<h2 style="color: #ffe4e4;background-image: linear-gradient(to right top, #051937, #004d7a, #008793, #00bf72, #a8eb12);">Judgement Under GST Act</h2>

</div>

<div class="mainDivHeight" style="margin: 20px;">
	<div class="container-fluid"  style="padding-left:0px !important; padding-right:0px !important;">
       
		<?php include('case_search_template.php') ?>
		<div  class="portlet box blue-steel mt-5" >
		   <div class="portlet-title">
				<div class="caption">
					<i class="glyphicon glyphicon-search"></i> Search Reasult
				</div>
				
			</div>
			<div id="tbl_case_law" class="table table-responsive table-striped table-hover">
                
			</div>
		</div>
	</div>
</div>
<?php include('../footer.php') ?>
<script>
	$(document).ready(function() {
		

		var headerHeight = $('.header').height();
		var windowHeight = $(document).height();
		var mainDivHeight = windowHeight - (headerHeight + 207);
		$('.mainDivHeight').css('min-height', mainDivHeight + 'px');

		$( "#orderDate" ).datepicker({
        changeMonth: true,
        changeYear: true
    });

		$('.form-control').on('change keypress', function() {
			if ($(this).attr('id') != 'txtCaptcha') {
				$('.alert').hide();
				$('#btncasedetail1_2').hide();
				$('#btncasedetail1_1').show();
				$('.reset').show();
			}
		});
	});
</script>
<script src="js/case.js"> </script>
<script>
	
</script>