<?php
session_start();
//print_r($_SESSION);
include('header.php')
?>
<?php include('navbar.php') ?>
<?php
include('../admin/database.php');


$db = new Database();
?>
<style>
	.portlet.box.blue-steel {
		border: 1px solid #7093cc;
		border-top: 0;
	}

	.portlet.box.blue-steel>.portlet-title {
		background-color: #4B77BE;
	}

	.portlet.box.blue-steel>.portlet-title>.caption {
		color: #FFFFFF;
		padding: 11px 0 9px 10px;
		font-size: 18px;
		line-height: 18px;
	}

	form {
		padding: 5px;
	}

	div.checker {
		margin-right: 5px;
	}

	.portlet.box.blue-steel {
		border: 1px solid #7093cc;
		border-top: 0;
	}

	.form .form-actions {
		padding: 20px 10px;
		margin: 0;
		background-color: #e3cfcf;
		border-top: 1px solid #e5e5e5;

	}
	 .checkbox{
		display: flex;
    align-items: center;
    font-size: 1.2rem;
	}
	
	.checkbox2{

    width: 20px;
    height: 20px;
	}
	#tbl_case_law{
		padding: 30px;
       
		/* box-shadow: rgb(0 0 0 / 16%) 0px 3px 6px, rgb(0 0 0 / 23%) 0px 3px 6px; */
	}
	/*
	.checker span {
	 margin-left: 10px;
	} */
</style>
<div class="news-head">
	<h2 style="background: #69acb7fa;color: #ffe4e4;">Judgement Under GST Act Dashboard</h2>

</div>

<div class="mainDivHeight" style="margin: 20px;">
	<div class="container-fluid"  style="padding-left:0px !important; padding-right:0px !important;">

		
		<!-- <div  class="portlet box blue-steel mt-5" >
		   <div class="portlet-title">
				<div class="caption">
					<i class="glyphicon glyphicon-search"></i> Search Reasult
				</div>
				
			</div>
			<div id="tbl_case_law" class="table table-responsive table-striped table-hover">
                
			</div>
		</div> -->

	</div>
</div>
<?php include('../footer.php') ?>
<script>
	$(document).ready(function() {
		$('#broadArea').select2();
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

<script>
	
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