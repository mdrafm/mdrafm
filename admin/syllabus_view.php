<?php
    /*Just for your server-side code*/
    header('Content-Type: text/html; charset=ISO-8859-1');
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <?php 
    
    include('header_link.php');
    include('../config.php');
    include 'database.php';
    ?>


 <style type="text/css" media="print">
   
    footer, .sidebar {   
     display: none !important;
    }
    .printbtn{
     display: none !important;
    }
    .finpos_table{
          width: 100% !important;
        }

  @media print {
    .pagebreak { page-break-before: always; } /* page-break-after works, as well */
}

    </style>

</head>

<body class="user-profile">

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <div class="wrapper ">

        <?php include('sidebar.php'); ?>

        <div class="main-panel" id="main-panel">
            <?php include('navbar.php'); ?>

            <div class="panel-header panel-header-sm">


            </div>


            <div class="content" style="margin-top: 50px;font-size: 14px !important;font-color: black !important;" >
            <div class="row">
                    <div class="col-md-12">

                        <div class="card">
                            <form id="syllabus">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>Select Syllabus</strong></label>
                                            <select class="custom-select mr-sm-2" name="syllabus" id="syllabus_id">
                                                <option selected>Select Syllabus</option>
                                                <?php 
                                                                $db = new Database();
                                                                $count = 0;
                                                                $db->select('tbl_sylabus_master',"*",null,null,null,null);
                                                                // print_r( $db->getResult());
                                                                foreach($db->getResult() as $row){
                                                                    //print_r($row);
                                                                    $count++
                                                                ?>
                                                <option value="<?php echo $row['id'] ?>">
                                                    <?php echo $row['descr'] ?>
                                                </option>

                                                <?php 
                                                        }
                                                    ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-2 mt-2">
                                            <div class="form-group">
                                            <label></label>
                                                <input type="button" class="btn btn-primary 2" value="view" id="view_syllabus"  
                                                    onclick="view_syllabus()" />
                                            </div>

                                    </div> -->
                                </dv>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">

                        <div class="card">
                           
                            <div class="card-body" id="printdivcontent">

                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <?php include('common_script.php') ?>

</body>

<script>
     $('#syllabus_id').on('change', function(){

   
        let syllabus_id = $('#syllabus_id').val();

        $.ajax({
            type: "POST",
            url:"ajax_syllabus.php",
            data:{action:'view_syllabus',id:syllabus_id},
            success: function(res) {
                console.log(res);
                $('#printdivcontent').html(res);
            }
        })
     })

     function PrintDiv() 
   {  
    $(".printbtn").hide();
       var divContents = document.getElementById("printdivcontent").innerHTML;  
       var printWindow = window.open('', '', 'height=200,width=400'); 

       printWindow.document.write('<html><head><title>Print DIV Content</title>');  
       printWindow.document.write('</head><body >');  
       printWindow.document.write(divContents);  
       printWindow.document.write('</body></html>');  
       printWindow.document.close();  
       printWindow.print();  
    }  
</script>

</html>

