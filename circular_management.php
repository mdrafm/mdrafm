<?php 
session_start();

include('header.php') 
?>
<?php include('nav_bar.php') ?>
<?php 
  include ('admin/database.php') ;
  
 
if (isset($_SESSION))
{
      session_destroy();
      unset($_SESSION);
}
  $db = new Database();
?>

<div class="news-head">
    <h2>Circular Archive</h2>
    
    <a href="cms/auth-signin.php" class="float-right" style="float: right;margin-top: -65px;margin-right: 30px"><button class="btn btn-primary">Login</button><a>  
  
</div>


<div class="container">
  
  <?php
  $dept_id = 0;
  $dept_name = "";

    $slt_dept = "SELECT DISTINCT c.dept_id,d.dept_name FROM `tbl_circular` c JOIN `tbl_department` d ON c.dept_id = d.id";
    $db->select_sql($slt_dept);
    $dept_list =  $db->getResult();
  foreach($dept_list as $dept){
    $dept_name = $dept['dept_name'] ;
    $dept_id = $dept['dept_id'] ;
    ?>
    
      <div class="row text-center" style="flex-direction: column;background: #225763;padding: 5px;border-radius: 5px;">
        
            <!-- <a href="circular_notice.php"> <?php echo $dept['dept_name']; ?> </a> -->
            <input type="button" class="text-center" style="background: none;border: 0;padding: 5px;color: #fff;"
            name="send" onclick="datapost('circular_notice.php',{dept_id: <?php echo $dept['dept_id'] ?>,dept_name: '<?php echo $dept_name  ?>' })" value=" <?php echo $dept['dept_name'] ?>" /> 

       

    </div>
    <div class="row">
        <div class="col-md-4">
            <div id="piechart_0_<?php echo $dept['dept_id']; ?>" style="width: 600px; height: 400px;"></div>
        </div>
        <div class="col-md-4">
            <div id="piechart_12_<?php echo $dept['dept_id']; ?>" style="width: 600px; height: 400px;"></div>
        </div>
        <div class="col-md-4">
            <div id="piechart_24_<?php echo $dept['dept_id']; ?>" style="width: 600px; height: 400px;"></div>
        </div>
    </div>

    <?php
    //$db->select('tbl_circular_group'," year,COUNT(*)",null,null,null,null);
    $cnt = 0;
     $sql = "SELECT year FROM `tbl_circular` WHERE year > '1988' AND dept_id = '".$dept['dept_id']."'  GROUP BY year DESC";
     $db->select_sql($sql);
     $res1 = $db->getResult();
     foreach ($res1 as $row1){
       //print_r($row1);
       $x = count($res1);
       $cnt = floor($x /3) +1;
        
     }
     $num = [0,12,24];
    // echo $num[2];
    // echo $cnt;
     $limt = 0;
     for ($i=0; $i < 3; $i++) { 
        
        $slct_sql = "SELECT year,COUNT(*) as circular FROM `tbl_circular` WHERE year > '1988' AND dept_id = '".$dept['dept_id']."' GROUP BY year DESC  
        UNION 
        SELECT year,COUNT(*) as circular FROM `tbl_circular` WHERE year < '1989' AND dept_id = '".$dept['dept_id']."'  LIMIT $limt,12 " ;
        $db->select_sql($slct_sql);
        $res =  $db->getResult();
       
        foreach ($res as $row){
         // print_r($res);
           ?>
                <script type="text/javascript">
                google.charts.load('current', {
                    'packages': ['corechart']
                });
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {

                    var data = google.visualization.arrayToDataTable([
                        ['Year', 'Circular Count'],

                        <?php 
                                     //print_r($res);
                                      //echo (count($res));
                                      foreach($res as $val){
                                        // console.log($res);
                                        if($val['year'] == 1957){
                                          $val['year'] = 1988;
                                        }
                                        ?>

                        ['<?php echo $val['year'] ?>', <?php echo $val['circular'] ?>],
                        <?php
                                      }
                                      ?>


                    ]);

                    var options = {
                        title: ' Financial Year Wise Number of Circulars Issued',
                        pieSliceText: 'value',
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('piechart_<?php echo  $num[$i] ;?>_<?php echo $dept['dept_id']; ?>'));
                    google.visualization.events.addListener(chart, 'select', selectHandler);

                    function selectHandler() {
                        var selectedItem = chart.getSelection()[0];
                        if (selectedItem) {
                          var year = data.getValue(selectedItem.row, 0);
                          var dept_id = <?php echo $dept_id ?>;
                          //alert('The user selected ' + topping);
                          datapost('circular_notice.php',{dept_id:dept_id,dept_name: '<?php echo $dept_name  ?>',year:year});
                        }
                    }

                    chart.draw(data, options);
                }
                </script>
<?php
        }
      
        $limt = $limt+$cnt;
        
     }
   

 ?>

    <?php
  }

 ?>
    

</div>




<?php include('footer.php') ?>

<script>
  
function datapost(path, params, method) {
    //alert(path);
    method = method || "post"; // Set method to post by default if not specified.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);
    for (var key in params) {
        if (params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);
            form.appendChild(hiddenField);
        }
    }
    document.body.appendChild(form);
    form.submit();
}
</script>