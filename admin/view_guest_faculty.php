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
                                <u><h2 align="center">Data Base for Tranning Faculties</h2></u>
                                <a class="btn btn-warning printbtn" href="javascript: PrintDiv();" style="float:right;">print</a>
                                
                                    <table align="left" border="1" width="100%" style="text-align:left;" >
                                    <thead>
                                        <tr>
                                            <th style="width:75px;">Sl No</th>
                                            <th style="text-align:center;" >Paper Name</th>
                                            <th>Subjects</th>
                                            <th>Faculty Name</th>
                                            <th>Designation</th>
                                            <th>Contact No</th>
                                            <th>E Mail</th>

                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                     $db = new Database();
                                        $count = 0;
                                        $sql_visit = "SELECT p.paper_name,s.subject_name,f.name,f.desig,f.phone,f.email FROM `tbl_guest_faculty` g 
                                        JOIN `tbl_guest_paper` p ON g.paper_id = p.id
                                        JOIN `tbl_guest_subject` s ON g.subject_id = s.id
                                        JOIN `tbl_faculty_master` f ON g.faculty_id = f.id";

                                        $db->select_sql($sql_visit);

                                        
                                        foreach ($db->getResult() as $row) {
                                            // print_r($row);
                                            $count++;
                                            ?>
                                            <tr>
                                                <td><?php echo $count; ?></td>
                                                <td><?php echo $row['paper_name']; ?></td>
                                                <td><?php echo $row['subject_name']; ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['desig']; ?></td>
                                                <td><?php echo $row['phone']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                            </tr>
                                            <?php
                                        }
                                    ?>
                                    </tbody>         
                                    </table>
                                     

                                    <div class="pagebreak"> </div>
                                    
                                   
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

const table = document.querySelector('table');

let headerCell = null;
let slCell = 0;
for (let row of table.rows) {

  const slCell = row.cells[0];
  const firstCell = row.cells[1];
  
  if (headerCell === null || firstCell.innerText !== headerCell.innerText) {
    headerCell = firstCell;
  } else {
    headerCell.rowSpan++;
    //slCell.rowSpan++;
    firstCell.remove();
  }
}

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

