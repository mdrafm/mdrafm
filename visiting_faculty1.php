<?php include('header.php') ?>
<?php include('nav_bar.php') ?>
<div class="news-head">
    <h2>Visiting Faculty </h2>
</div>
 <div class="news" >
  <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th style="width:75px;">Sl No</th>
                <th style="text-align:center;" >Name</th>
                <th>Designation</th>
                <th>Phone No</th>
                <th>E Mail ID</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
               $count = 0;
               $sql_visit = "SELECT * FROM tbl_faculty_master WHERE role =2";
               $sql_visit_res = mysqli_query($db,$sql_visit);
               
               while ($row = mysqli_fetch_array($sql_visit_res)){
                   $count++;
                   ?>
                    <tr>
                        <td><?php echo $count; ?></td>
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