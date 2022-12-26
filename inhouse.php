<?php include('header.php') ?>
<?php include('nav_bar.php') ?>

<div class="">
    <div class="news-head">
        <h2>Inhouse Faculty </h2>
    </div>
<div class="container">
   
   
   
       <p style="text-align: justify !important;margin-left: 15px !important;margin-right: 15px !important;font-family: 'Open Sans', sans-serif;font-size: 1.3rem;">
                MDRAFM faculty have studied and worked in the best institutions of India. Their experience and expertise allows them to bring about 
        their best into the classroom and in their work.This creats an exceptional environment for developing a range of programmes that can build sound theory for analyzing
        complex financial management issues.Apart from the regular faculty, MDRAFM has a wide -array of number of distinguished visiting faculties reputed consultants 
        and faculties on deputation from various services.</p> 
    <div class="row">
       <h3 class="text-center">Director</h3>
        <div class="col-md-6 info_box" style="margin: 30px auto;">
           
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <p><b>Name-</b>Sri Ashok Kumar Mohanty</p>
                    <p><b>Designation-</b>Director</p>
                   <!--  <p><b>Cadre-</b>Odisha Finance Service</p> -->
                   <!--  <p><b>Qualification-</b>MA, M.Phil ,PGDFM</p> -->
                    <p><b> Tel(office) </b> :- 0674-2300394</p>
                    <p><b> Email(office </b>:- dirmdrafm.od@gov.in</p>
                </div>
                <div class="col-md-3">
                <img  src="images/A_K_Mohanty.jpg" onerror="this.src='image/download.jpg' " width="132" height="150">
                </div>
            </div>
        </div>
   </div>
      
   <div class="row">
       <h3 style="margin: 2% auto;">Additional Director</h3>
       <?php
          $sql = "SELECT *  FROM `tbl_faculty_master` WHERE `role` = 1 AND `desig` LIKE '%additional%';";
          $res = mysqli_query($db,$sql);

          while($row = mysqli_fetch_array($res)){
            
              $path = explode("/",$row['image']);
               $image_path = "images/faculty/".$path[3];
           
              ?>
                 <div class="col-md-5 info_box" >
           
                   <div class="row justify-content-center">
                        <div class="col-md-8">
                            <p><b>Name-</b><?php echo $row['name']; ?></p>
                            <p><b>Designation-</b><?php echo $row['desig']; ?></p>
                            <p><b>Cadre-</b><?php echo $row['cader']; ?></p>
                            <p><b>Qualification-</b><?php echo $row['qulftn']; ?></p>
                            <p><b>Telephone-</b><?php echo $row['phone']; ?></p>
                            <p><b>Email Id-</b><?php echo $row['email']; ?></p>
                        </div>
                        <div class="col-md-4">
                           <img  src="<?php echo $image_path ?>"  width="132" height="150">
                        </div>
                   </div>
               </div>
               <div class="col-md-1"></div>
              <?php
          }
        ?>
       
        
   </div>
   <div class="row">
       <h3 style="margin: 2% auto;">Joint Director</h3>
       <?php
          $sql = "SELECT *  FROM `tbl_faculty_master` WHERE `role` = 1 AND `desig` LIKE '%Joint%';";
          $res = mysqli_query($db,$sql);

          while($row = mysqli_fetch_array($res)){
            
              $path = explode("/",$row['image']);
               $image_path = "images/faculty/".$path[3];
           
              ?>
                 <div class="col-md-5 info_box" >
           
                   <div class="row justify-content-center">
                        <div class="col-md-8">
                            <p><b>Name-</b><?php echo $row['name']; ?></p>
                            <p><b>Designation-</b><?php echo $row['desig']; ?></p>
                            <p><b>Cadre-</b><?php echo $row['cader']; ?></p>
                            <p><b>Qualification-</b><?php echo $row['qulftn']; ?></p>
                            <p><b>Telephone-</b><?php echo $row['phone']; ?></p>
                            <p><b>Email Id-</b><?php echo $row['email']; ?></p>
                        </div>
                        <div class="col-md-4">
                           <img  src="<?php echo $image_path ?>"  width="132" height="150">
                        </div>
                   </div>
                   
               </div>
               <div class="col-md-1"></div>
              <?php
          }
        ?>
       
        
   </div>
   <div class="row">
       <h3 style="margin: 2% auto;">Deputy Director(Sr)</h3>
       <?php
          $sql = "SELECT *  FROM `tbl_faculty_master` WHERE `role` = 1 AND `desig` LIKE '%(Sr)%';";
          $res = mysqli_query($db,$sql);

          while($row = mysqli_fetch_array($res)){
            
              $path = explode("/",$row['image']);
               $image_path = "images/faculty/".$path[3];
           
              ?>
                 <div class="col-md-5 info_box" >
           
                   <div class="row justify-content-center">
                        <div class="col-md-8">
                            <p><b>Name-</b><?php echo $row['name']; ?></p>
                            <p><b>Designation-</b><?php echo $row['desig']; ?></p>
                            <p><b>Cadre-</b><?php echo $row['cader']; ?></p>
                            <p><b>Qualification-</b><?php echo $row['qulftn']; ?></p>
                            <p><b>Telephone-</b><?php echo $row['phone']; ?></p>
                            <p><b>Email Id-</b><?php echo $row['email']; ?></p>
                        </div>
                        <div class="col-md-4">
                           <img  src="<?php echo $image_path ?>" <?php echo ($row['id']== 11)? 'width="160"': '"width="132"'?>  height="150" />
                        </div>
                   </div>
               </div>
               <div class="col-md-1"></div>
              <?php
          }
        ?>
       
        
   </div>
   <div class="row">
       <h3 style="margin: 2% auto;">Deputy Director(Jr)</h3>
       <?php
          $sql = "SELECT *  FROM `tbl_faculty_master` WHERE `role` = 1 AND `desig` LIKE '%Jr%';";
          $res = mysqli_query($db,$sql);

          while($row = mysqli_fetch_array($res)){
            
              $path = explode("/",$row['image']);
               $image_path = "images/faculty/".$path[3];
           
              ?>
                 <div class="col-md-5 info_box" >
           
                   <div class="row justify-content-center">
                        <div class="col-md-8">
                            <p><b>Name-</b><?php echo $row['name']; ?></p>
                            <p><b>Designation-</b><?php echo $row['desig']; ?></p>
                            <p><b>Cadre-</b><?php echo $row['cader']; ?></p>
                            <p><b>Qualification-</b><?php echo $row['qulftn']; ?></p>
                            <p><b>Telephone-</b><?php echo $row['phone']; ?></p>
                            <p><b>Email Id-</b><?php echo $row['email']; ?></p>
                        </div>
                        <div class="col-md-4">
                           <img  src="<?php echo $image_path ?>"  width="132" height="150">
                        </div>
                   </div>
               </div>
               <div class="col-md-1"></div>
              <?php
          }
        ?>
       
        
   </div>

</div>
</div>


 
<?php include('footer.php') ?>

<script>
     $('#example').DataTable();
</script>