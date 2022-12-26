<?php
   include '../admin/database.php';
   session_start();   
   $db = new Database(); 
   $err = '';
	$db->select('tbl_temp_book_detail',"book_ref_no, COUNT(*)",null,"GROUP BY book_ref_no
HAVING COUNT(*) > 1",null,null);
	$res = $db->getResult();
/* 	SELECT book_ref_no, COUNT(*)
FROM `tbl_temp_book_detail`
GROUP BY book_ref_no
HAVING COUNT(*) > 1; */
	echo count($res);
	//print_r($res);
	/* foreach($res as $row){
		$db_pass = $row['password'];
		if($row['status']==0){
            $err = "Inactive User";
            
        }
        else{
            
            }
        } 
		
	}*/




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('header_link.php') ?>
    <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css'
        rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/fontawesome.min.css"
        integrity="sha512-RvQxwf+3zJuNwl4e0sZjQeX7kUa3o82bDETpgVCH2RiwYSZVDdFJ7N/woNigN/ldyOOoKw8584jM4plQdt8bhA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
    #alert_msg {
        position: absolute;
        z-index: 1400;
        top: 2%;
        /* right:4%; */
        margin: 40px;
        text-align: center;
        background: #2c8a2c;
        color: #fff;
        display: none;
    }

    #circular_frm {
        width: 95%;
        margin: 0 auto;
        padding: 20px;
        box-shadow: rgb(50 50 93 / 25%) 0px 2px 5px -1px, rgb(0 0 0 / 30%) 0px 1px 3px -1px;
        background-color: #f7f7f7;
        border-radius: 5px;
    }

    #circular_frm input {
        border-radius: 5px;
        /* border: none; */
    }

    #circular_frm select {
        border-radius: 5px;
        /* border: none; */
    }

    small {
        font-size: 1rem;
    }

    label {
        color: black;
        font-size: 1.2rem;
        font-weight: 600;

    }

    .select2-search__field {
        height: 2rem;
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
    <?php include('sidebar_nav.php') ?>
    <!-- [ Header ] start -->
    <?php include('header_nav.php') ?>
    <!-- [ Header ] end -->
    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-md-12">
                    <!-- <div class=" table-striped table-hover" id="result_tbl">
                    </div> -->
                    <div class="card table-card">
                        <div class="card-header">
                            <h5>Issue Book</h5>
                        </div>
                    </div>

                </div>

            </div>
            <!-- [ Main Content ] end -->

            <div id="alert_box" class="modal fade" role="dialog" aria-labelledby="alert_boxLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="alert_boxLabel2"></h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <p class="mb-0 alrt_msg">
                            </p>
                        </div>
                        <div class="modal-footer " id="footer_alert">

                        </div>
                    </div>
                </div>
            </div>
           <!-- reject alert box -->

            <!--<div id="reject_alert_box" class="modal fade" role="dialog" aria-labelledby="alert_boxLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Reject Case</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                        <div class="form-group">
                            <label>Reject Comments : </label>

                            <textarea class="form-control" name="comments" id="comments"
                                placeholder="Enter Comments for Reject" rows="5"></textarea>
                           

                        </div>
                        </div>
                        <div class="modal-footer " id="footer_alert2">

                        </div>
                    </div>
                </div>
            </div>-->
        </div>
    </div>
    <!-- [ Main Content ] end -->

    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>



</body>

</html>
<script src="assets/js/common.js"> </script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>


<script src="../js/case.js"> </script>
<script type="text/javascript">
$('#btn_search').click(function() {
    $('#circular_frm').toggle("down");
   
   
});

$.ajax({
    type: "POST",
    url: "../ajax_master.php",
    beforeSend: function() {
        $('.loader').show();
        //  $('#send_email').prop('disabled', true);
    },
    data: {
        action: "search_case",
        caseNo: '',
        caseType: 0,
        caseYear: '',
        // broadArea:broadArea,
        partyName: '',
        courtName: 0,
        orderDate: '',
        // section_gst_act:section_gst_act,
        // rule_gst_act:rule_gst_act,
        keyword: '',
        view: 1,
        case_status: 'Pending'


    },
    success: function(data) {
        $('.loader').hide();
        console.log(data);
        $('#tbl_case_law').html(data);
        $('#case_law').DataTable();
    }

})

function reject_alert(id) {
    
    $('#footer_alert2').html(`<button type="button" class="btn  btn-secondary"
                                data-dismiss="modal">Close</button>
                            <button type="button" class="btn  btn-danger" onclick="reject_case(${id})" >Reject
                                </button>`);
    $('#reject_alert_box').modal('show');
}

function reject_case(id){
	let comments = $('#comments').val();
	
	$.ajax({
        type: "POST",
        url: "ajax_gst_case.php",
        data: {
            action: "reject_case",
            case_id: id,
			comments:comments,
            table: "tbl_gst_case_law"

        },

        success: function(res) {
            console.log(res);
            let elm = res.split('#');
            if (elm[0] == "success") {
                sessionStorage.message = elm[1];
                sessionStorage.type = "success";
                location.reload();
            }


        }
    })
}

</script>