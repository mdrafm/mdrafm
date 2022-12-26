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

        color: #fff;
        display: none;
        margin-top: 6%;
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
        font-size: ;
        font-weight: 600;

    }

    .select2-search__field {
        height: 2rem;
    }

    .modal-open {
        overflow: scroll;
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
 

     $db->select('tbl_temp_book_detail',"DISTINCT(location)",null,null,null,null);
     $res_location = $db->getResult();
 //print_r($res_location);
?>

    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-md-12">
                    <!-- <div class=" table-striped table-hover" id="result_tbl">
                    </div> -->
                    <div class="col-md-6" style="margin-left:45%;margin-top:1%">
                        <div id="alert_msg"></div>

                    </div>

                    <div class="card table-card">
                        <div class="card-header">
                            <h4 class="mb-5">Duplicate Books</h4>
                            <div id="tbl_case_law" class="table table-responsive table-striped table-hover">
                            <table id="master" class="table">
                                <thead class="" style="background: #315682;color:#fff;">

                                    <th style="width:50px;">Sl No</th>
                                    <th style="width:130px">Book Ref. No </th>
                                    <th style="width:130px">Book Name</th>
                                    <th style="width:50px">Count</th>
                                    
                                </thead>
                                <tbody>
                                    <?php 
                               
                              
                               $count = 0;
                             
                               $db->select_sql("SELECT book_ref_no,book_name,COUNT(*) as cnt FROM `tbl_temp_book_detail` GROUP BY book_ref_no HAVING COUNT(*) > 1");
                              // print_r( $db->getResult());
                              $result = $db->getResult();
                              if($result){
                                    foreach($result as $row){
                                        //print_r($row); 
                                        $count++;
                                       
                                        ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        
                                        <td style="width:100px"><?php echo $row['book_ref_no']; ?></td>
                                        <td style="width:100px"><?php echo $row['book_name']; ?></td>
                                        <td style="width:100px"><?php echo $row['cnt']; ?></td>
                                        
                                       
                                    </tr>
                                    <?php
                                    }
                              }else{
                                echo "No Record Found";
                              }
                               
                      
                               
                              ?>

                                </tbody>
                            </table>
                            </div>
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
$('#master').DataTable();

</script>