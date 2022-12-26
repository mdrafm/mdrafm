<?php include 'database.php'; ?>
<table class=" term table">
<thead class="" style="background: #315682;color:#fff;font-size: 11px;">

    <th style="width:50px;">Sl No</th>
    <th style="text-align:center;">Programm Name</th>
    <th style="text-align:center;">Start Date</th>
    <th style="text-align:center;">End Date</th>
    <th style="text-align:center;">Status</th>
    <th style="text-align:center;">Action</th>
</thead>
<tbody>
    <?php 

$db = new Database();
$count = 0;
$username = $_POST['username'];
$sql = "SELECT * FROM `tbl_mid_program_master` WHERE course_director = (SELECT id FROM `tbl_faculty_master` WHERE phone = '".$username."')";
//echo $sql;exit;
$db->select_sql($sql);
//print_r($db->getResult());
foreach($db->getResult() as $row){
//print_r($row);
$tbl = "";
//    if($row['trng_type']==1){
//        $tbl = 'tbl_sylabus_master';
//    }
$count++
?>
    <tr>
        <td><?php echo $count; ?></td>
        <td><?php echo $row['prg_name']; ?> </td>
       
        <td>
            <?php echo date("d-m-Y", strtotime($row['start_date'])) ?>
        </td>
        <td>
            <?php echo date("d-m-Y", strtotime($row['end_date'])) ?>
        </td>

        <td style="text-align:center;">
            <?php
         // echo $row['status'];
            switch ($row['status']) {
                case 'draft':
                    echo 'Draft';
                    break;
                case 'pendingAtIncharge':
                
                    echo 'Pending At Tranning Incharge';
                    break;
                case 'approve':
                    echo 'Approved';
                    break;
                case 'reject_by_incharge':
                    echo ' <p style="color:red" >Reject by Tranning Incharge</p>'; 
                    //echo '<br>';
                    echo '<b>Comment: </b>'.$row['remark'];
                case 'pendingAtDirector':
                        echo 'Pending at Director';
                        break;
                    break;
                
            } 
            
            ?> </td>
        <td style="text-align:center;">
           
                   <input type="button" class="btn " style="background:#3292a2"
                    name="send"
                    onclick="datapost('sponsored_program_detrail.php',{id: <?php echo $row['id'] ?>,trng_type: <?php echo $row['trng_type'] ?> })"
                    value="View Detail" />

        </td>

  
    </tr>
    <?php
}


?>

</tbody>
</table>