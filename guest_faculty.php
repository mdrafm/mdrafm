<?php include('header.php') ?>
<?php include('nav_bar.php') ?>
<?php

include 'admin/database.php';
$conn = new Database();
?>
<div class="news-head">
    <h2>Guest Faculty </h2>
</div>
 <div class="news" >
  <table id="example" class="table table-striped table-bordered" style="width:100%">
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
               $count = 0;
               $sql_visit = "SELECT p.paper_name,s.subject_name,f.name,f.desig,f.phone,f.email FROM `tbl_guest_faculty` g 
               JOIN `tbl_guest_paper` p ON g.paper_id = p.id
               JOIN `tbl_guest_subject` s ON g.subject_id = s.id
               JOIN `tbl_faculty_master` f ON g.faculty_id = f.id";

              $conn->select_sql($sql_visit);

               
              foreach ($conn->getResult() as $row) {
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
    </div>
<?php include('footer.php') ?>

<script>
     $('#example').DataTable();
</script>