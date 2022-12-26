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


            <div class="content" style="margin-top: 50px;" >

                <div class="row">
                    <div class="col-md-12">

                        <div class="card">
                           
                            <div class="card-body" id="printdivcontent">

                                <a class="btn btn-warning printbtn" href="javascript: PrintDiv();">print</a>

                                    <?php
                                        for($k=0; $k<5; $k++)
                                        {
                                    ?>
                                    <table width="100%" border="0" align="center" class="maintable">
                                        <tr>
                                            <td colspan="3" align="center" >
                                            <h3>Subject Code: OGFR, DFPR & Budgeting</h2></br>
                                            <b>paper: 101 </br>
                                            Total Number of session: 40</b>
                                            </td>
                                        </tr>


                                        <tr>
                                            <td colspan="3" align="right">TotalMarks: 100</td>
                                        </tr>
                                    </table>

                                    <table width="100%" border="1" align="center" style="border: 1px solid black">
                                        <tr>
                                            <td>Session No.</td>
                                            <td>Content of the Syllabus</td>
                                            <td>Session Objectives: the participants would, at the end of the session , be familiar with: </td>
                                        </tr>

                                        <?php
                                            for($j=0; $j<5; $j++){
                                        ?>


                                        <tr>
                                            <th colspan="3" align="left">Odisha General Financial Rules</th>
                                        </tr>

                                        <?php
                                            for($i=0; $i<5; $i++){
                                        ?>

                                        <tr>
                                            <td>1-2</td>
                                            <td>General System of Financial Control </td>
                                            <td>
                                                <ul>
                                                    <li>Rules Governing Receipt of Govt. money</li>
                                                    <li>Rules Governing Receipt of Govt. money</li>
                                                    <li>Rules Governing Receipt of Govt. money</li>
                                                    <li>Rules Governing Receipt of Govt. money</li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <?php 
                                            }
                                        ?>

                                        <?php
                                            }
                                        ?>
                                    </table>

                                    <div class="pagebreak"> </div>
                                    
                                    <?php
                                        }
                                    ?>
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

