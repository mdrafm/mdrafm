<?php include('header.php') ?>
<?php include('nav_bar.php') ?>
<div class="news-head">
    <h2>Training Calender </h2>
</div>
<div class="container" style="height:54vh">
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <table class="table table-bordered">
                <thead style="font-size: 1.3rem;">
                    <tr style="background-color:#c8d0ff">
                        <th>Sl No</th>
                        <th>Title</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                $count =  0;
                $calendar_sql = "SELECT * FROM `tranning_calendar` WHERE status = 1 ";
                $calendar_res = mysqli_query($db,$calendar_sql);
                while($rows = mysqli_fetch_array($calendar_res)){
                      $count++;
                     ?>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $rows['title']; ?></td>

                        <td> <a href="<?php echo "pdf/".$rows['details'] ?>" class="btn btn-success"><i
                                    class="fa fa-file-pdf-o" style="height:20px;"></i>View Details</a> </td>

                    </tr>
                    <?php
                }
            ?>

                </tbody>
            </table>
        </div>
        <div class="col-md-2">
        </div>
    </div>
</div>
<div class="news">

</div>
<?php include('footer.php') ?>

<script>
  $('#example').DataTable();
</script>