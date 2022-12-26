<?php
   //include '../admin/database.php';
   //session_start();   
  // $db = new Database(); 
  // $err = '';
	
/* 	SELECT book_ref_no, COUNT(*)
FROM `tbl_temp_book_detail`
GROUP BY book_ref_no
HAVING COUNT(*) > 1; */
	//echo count($res);
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
   
            <!-- [ Main Content ] end -->
<?php
 $db->select('tbl_temp_book_detail',"*",null,null,null,"50");
     $res_book = $db->getResult();
 //print_r($res);
?>
     <div class="pcoded-main-container">
        <div class="pcoded-content">
<form id="frm_add">
<div class="row">
<div class="form-group col-md-6 ">
<label>Book Name :</label>
<input class="form-control me-2" type="search" name="petitioner_name" id="petitioner_name"
placeholder="Enter Book Name" required>
<small class="text-danger"></small>
</div>
</div>
</form>
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-md-12">
                    <!-- <div class=" table-striped table-hover" id="result_tbl">
                    </div> -->
                    <div class="card table-card">
                        <div class="card-header">
                            <h5>Issue Book</h5>
                            <div id="tbl_case_law" class="table table-responsive table-striped table-hover">
                            <table id="case_law" class="table">
                            <thead class="" style="background: #315682;color:#fff;">
                            <th style="width:50px;">Sl No</th>
                            <th >Book Name </th>
                            <th >Author Name</th>
                            <th>Edition</th>
                            <th>Volume</th>
                            <th>Book type</th> 
                            <th>Price</th>
                            <th>quantity</th>
                            <th>Action</th>
                            </thead>
                            <tbody>
                            <?php 
                            //print_r($res_book);
                            $sl_no=1;
                           foreach($res_book as $res)
                           {
                            $id=$res['id'];
                            $book_name=$res['book_name'];
                            $author_name=$res['author_name'];
                            $edition=$res['edition'];
                            $volume=$res['volume'];
                            $book_type=$res['book_type'];
                            $price=$res['price'];
                            $quantity=$res['quantity'];
                            ?>
                            <tr>
                                <td><?php echo $sl_no++;?></td>
                                <td><?php echo $book_name?></td>
                                <td><?php echo $author_name?></td>
                                <td><?php echo $edition?></td>
                                <td><?php echo $volume?></td>
                                <td><?php echo $book_type?></td>
                                <td><?php echo $price?></td>
                                <td><?php echo $quantity?></td>
                                <td>   <input type="button" class="btn btn-primary" value="Issue Book"/></td>
                            </tr>
                        <?php   }
                            ?>
                           

                            </tbody>
                            </table>
                             </div>
                        </div>
                    </div>

                </div>

            </div>
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

/*
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

})*/ 



$(document).ready(function () {
    $('#case_law').DataTable();
});
</script>
