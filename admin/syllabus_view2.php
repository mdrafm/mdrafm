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
                           
                            <div class="card-body" id="printdivcontent">

                                <a class="btn btn-warning printbtn" href="javascript: PrintDiv();" style="float:right;">print</a>
                                     <?php
                                        $db = new Database();
                                        $selctsyl=$db->select_sql("SELECT * FROM `tbl_sylabus_master` WHERE status = 1 ");
                                        foreach($db->getResult() as $rowselcttsyl){  
                                        }
                                        ?>

                                    <u><h2 align="center">Syllabus for <?php echo $rowselcttsyl['descr']; ?></h2></u>
                                    
                                    <table align="left" width="100%" style="text-align:left;">
                                        <tr>
                                            <th colspan="2"><h5>(A) <u>DURATION</u><h5></th>
                                        </tr>

                                        <?php
                                        $selctterms=$db->select_sql("SELECT * FROM `tbl_term_master` wHERE syllabus_id='".$rowselcttsyl['id']."' AND status = 1 ");
                                        
                                            ?>

                                        <tr>
                                            <th>&nbsp;</th>
                                            <th>

                                                <?php
                                                $durm=0;
                                                        $durw=0;
                                                    foreach($db->getResult() as $rowselctterm){ 
                                                            if($rowselctterm['duration_type']=='1'){
                                                                $durm=$durm+$rowselctterm['duration'];
                                                            }else{
                                                                $durw=$durw+$rowselctterm['duration'];
                                                                $durwmo=floor($durw/4);
                                                                $durm=$durm+$durwmo;
                                                                $durw1=$durw%4;
                                                                $durw=$durw1;
                                                            }
                                                        }


                                                ?>
                                                <ul>
                                                    <li style="font-size:14px;">TOTAL DURATION -  <?php echo  $durm; ?> MONTHS <?php echo $durw; ?> WEEKS</li>
                                                </ul>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>&nbsp;</td>
                                            <th>
                                                <ul>
                                                    <li style="font-size:12px;">CLASSIFICATION OF DURATION</li>
                                                    <ul>
                                                        <?php
                                                         $selctterms=$db->select_sql("SELECT * FROM `tbl_term_master` where syllabus_id='".$rowselcttsyl['id']."' AND status = 1 ");
                                                        foreach($db->getResult() as $rowselctterm1){ 
                                                            ?>
                                                            <li style="font-size:12px;"><?php echo $rowselctterm1['term']; ?> - <?php echo $rowselctterm1['duration']; ?> <?php echo $b = $rowselctterm1['duration_type'] == 1 ? 'MONTHS' : 'WEEKS'; ?> </li>
                                                       <?php } ?>
                                                    </ul>
                                                </ul>
                                            </th>
                                        </tr>
                                    </table>


                                    <table align="left">
                                        <tr>
                                            <th colspan="2"><h5>(B) <u>OUTLINE OF SYLLABUS</u><h5></th>
                                        </tr>
                                    </table>
                                     <?php

                                             $selctterms=$db->select_sql("SELECT * FROM `tbl_term_master` WHERE status = 1 AND id != '4' ");
                                             foreach($db->getResult() as $rowselctterms){ ?>
                                            

                                    <table align="center" width="90%" border="0">
                                        <tr><td>&nbsp;</td></tr>
                                        <tr><td border="0" colspan="5" align="center"><u><?php echo $rowselctterms['term']; ?></u></td></tr>
                                    </table>

                                    <table align="center" width="90%" border="1">
                                        <tr>
                                            <td align="middle">SL NO</td>
                                             <td align="middle">PAPER CODE</td>
                                             <td align="middle">TITLE OF THE PAPER</td>
                                             <td align="middle">NO. OF SESSIONS</td>
                                             <td align="middle">TOTAL MARKS</td>
                                        </tr>

                                        <?php
                                        $slno=1;
                                        $totalmarks=0;
                                        $totalsession=0;
                                             $selcttermspaper=$db->select_sql("SELECT * FROM tbl_paper_master pm join tbl_dtl_syllabus_master sm on pm.id=sm.paper_id  where pm.term_id='".$rowselctterms['id']."' AND pm.status =1  ");
                                             foreach($db->getResult() as $rowselctpaperterm){ ?>
                                        
                                        <tr>
                                            <td align="middle"><?php echo $slno; ?></td>
                                             <td align="middle"><?php echo $rowselctpaperterm['paper_code']; ?></td>
                                             <td><?php echo $rowselctpaperterm['title']; ?></td>


                                             <td align="middle"><?php echo $rowselctpaperterm['session_no']; ?></td>
                                             <td align="middle"><?php echo $rowselctpaperterm['total_mark']; ?></td>
                                        </tr>
                                        <?php 
                                        $slno++;
                                        $totalsession=$totalsession+$rowselctpaperterm['session_no'];
                                        $totalmarks=$totalmarks+$rowselctpaperterm['total_mark'];

                                            }
                                        ?>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td align="middle">TOTAL</td>
                                            <td align="middle"><?php echo $totalsession; ?></td>
                                            <td align="middle"><?php echo $totalmarks; ?></td>
                                        </tr>
                                        
                                    </table>
                                       
                                       
                                    
                                <?php  } ?>

                                <?php
                                   $count = 0;
                                  $db->select_sql("SELECT * FROM `tbl_term_master` WHERE status = 1 AND id = 4");
                                  foreach($db->getResult() as $rowselctfield){
                                      $count++;
                                      ?>
                                      <table align="center" width="90%" border="0">
                                          <tr><td>&nbsp;</td></tr>
                                          <tr><td border="0" colspan="5" align="center"><u><?php echo $rowselctfield['term']; ?></u></td></tr>
                                      </table>
                                      <table align="center" width="90%" border="1">
                                      <tr>
                                             <td align="middle">SL NO</td>
                                             <td align="middle">PARTICULARS</td>
                                             <td align="middle">DURATION</td>
                                             
                                        </tr>
                                        <?php
                                            $db->select_sql("SELECT * FROM `tbl_field_visit` WHERE term_id = '".$rowselctfield['id']."' ");
                                            foreach($db->getResult() as $rowselctstudy){
                                               ?>
                                               <tr>
                                            <td align="middle"><?php echo $count; ?></td>
                                             <td><?php echo $rowselctstudy['particulars']; ?></td>
                                             <td><?php echo $rowselctstudy['duration']; ?></td>


                                        </tr>
                                               <?php
                                            }
                                        
                                        ?>
                                        
                                      </table>
                                      <?php
                                  }
                                
                                ?>
                                  <!-- <iframe src="OFS_Syllabus_final.docx" width="100%" height="500px"> -->
                                <?php
                                        $selctterms1=$db->select_sql("SELECT * FROM `tbl_term_master` WHERE status = 1 AND syllabus_id='".$rowselcttsyl['id']."' ");
                                         foreach($db->getResult() as $rowselctterms1){

                                            echo "<br><h2 align='center'>".$rowselctterms1['term']."</h2>";
                                        
                                            ?>
                                   <?php
                                       $count = 0;

                                       $selctpaper=$db->select_sql("select * from tbl_paper_master pm join tbl_dtl_syllabus_master sm on pm.id=sm.paper_id where pm.term_id='".$rowselctterms1['id']."'");
                                        
                                         // print_r($db->getResult());exit;

                                        foreach($db->getResult() as $row){
                                             $i=1;
                                        // for($k=0; $k<5; $k++)
                                        // {
                                    ?>
                                </br>
                                    <table width="90%" border="0" align="center" class="maintable">
                                        <tr>
                                            <td colspan="3" align="center" >
                                            <h6>Subject Code: <?php echo $row['title'] ?></h6></br>
                                            <b>paper: <?php echo $row['paper_code'] ?> </br>
                                            Total Number of session: <?php echo $row['session_no'] ?></b>
                                            </td>
                                        </tr>


                                        <tr>
                                            <td colspan="3" align="right">TotalMarks: <?php echo $row['total_mark'] ?></td>
                                        </tr>
                                    </table>

                                    <table width="90%" border="1" align="center" style="border: 1px solid black">
                                        <tr>
                                            <td>Session No.</td>
                                            <td>Content of the Syllabus</td>
                                            <td>Session Objectives: the participants would, at the end of the session , be familiar with: </td>
                                        </tr>

                                        <?php
                                        $selctsubject=$db->select_sql("SELECT * FROM tbl_subject_master sm WHERE status = 1 AND paper_id='".$row['paper_id']."' ");

                                            foreach($db->getResult() as $row_subject){
                                        ?>

                                        <tr>
                                            <th colspan="3" align="left"><?php echo $row_subject['descr']; ?></th>
                                        </tr>

                                        <?php

                                        
                                        $selcttopic=$db->select_sql("SELECT * FROM tbl_topic_master sm WHERE status = 1 AND subject_id='".$row_subject['id']."'");
                                            foreach($db->getResult() as $row_topics){
                                                $j=($i+$row_topics['session_no'])-1;
                                                
                                        ?>

                                        <tr>
                                            <td><?php echo $i; ?>-<?php echo $j; ?> </td>
                                            <td><?php echo $row_topics['topic']; ?> </td>
                                            <td>
                                                <ul>
                                                    <?php
                                                        $selcttopicdtls=$db->select_sql("SELECT * FROM tbl_detail_topic_master sm WHERE status = 1 AND topic_id='".$row_topics['id']."'");
                                                        foreach($db->getResult() as $row_selcttopicdtls){
                                                    ?>
                                                    <li><?php echo $row_selcttopicdtls['dtl_topic'];?></li>
                                                    <?php
                                                        }
                                                    ?>
                                                </ul>
                                            </td>
                                        </tr>

                                        <?php
                                        $j=$j+1;
                                         $i=$j;
                                            }
                                        ?>

                                        <?php
                                            }
                                        ?>
                                    </table>

                                    <div class="pagebreak"> </div>
                                    
                                    <?php
                                        }
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

