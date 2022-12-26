<?php include('header.php') ?>
<?php include('nav_bar.php') ?>
<div class="news-head">
    <h2>Regular Employees </h2>
</div>
 <div class="news" >
  <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead style="background-color:#c8d0ff">
            <tr>
                <th style="width:75px;">Sl No</th>
                <th style="text-align:center;" >Name</th>
                <th>Designation</th>
                <th>Address</th>
                <th>Phone No</th>
                <th>EMail ID</th>
                <th>Photo</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
               $count = 0;
               $sql_visit = "SELECT * FROM tbl_staf_master WHERE type=1";
               $sql_visit_res = mysqli_query($db,$sql_visit);
               
               while ($row = mysqli_fetch_array($sql_visit_res)){
                   $count++;
                   ?>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['desig']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><img  src="<?php echo "images/staff/".$row['image']; ?>"  width="80px" height="80px"></td>
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