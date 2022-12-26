<?php include('header.php') ?>
<?php include('nav_bar.php') ?>
<?php
 include ('admin/database.php');
 $conn = new Database();
?>
<div class="news-head">
    <h2>Ongoing Training Programmes </h2>
</div>
 <div class="news" >
  <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th style="width:75px;">Sl No</th>
                <th style="text-align:center;" >title</th>
                <th style="text-align:center;" >Description</th>
                <!-- <th>Date</th> -->
                <!-- <th>View</th> -->
                
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 0;
               $conn->select('tbl_other_program',"*",null,null,null,null);
               $res = $conn->getResult();
                 foreach($res as $row){
                    $count++;
                     ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $row['title']; ?></td>
                            <td>
                            <?php
                                if($row['descr_doc']==''){
                                    ?>
                                        <div> <?php echo $row['descr']; ?> </div>
                                    <?php
                                }else{
                                    ?>
                                        <a href= 'doc/ongoing/<?php echo $row['descr_doc']; ?>' target="_blank" >document <img src="images/document_pdf.png" /></a>
                                                
                                    <?php
                                }
                            ?>
                            </td>
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