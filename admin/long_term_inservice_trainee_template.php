<table class=" term table" id="tableid">
    <thead class="" style="background: #315682;color:#fff;font-size: 11px;">


        <th>Sl No</th>
       
        <th style="text-align:center;"> Name</th>
        <th style="text-align:center;">DOB</th>
        <th style="text-align:center;">HRMS ID</th>
        <th style="text-align:center;">Email</th>
        <th style="text-align:center;">Phone</th>
        <th style="text-align:center;">Status</th>
        <th style="text-align:center;width: 8rem;">Action</th>
    </thead>
    <tbody>
        <?php


        $count = 0;
        
       // $sql = "SELECT * FROM `tbl_new_recruite` WHERE batch_id = (SELECT id FROM `tbl_batch_master` WHERE program_id = 4);"
        $db->select(
            'tbl_new_recruite',
            "*",
            null,
            " batch_id = (SELECT id FROM `tbl_batch_master` WHERE program_id = '".$_POST['id']."') ",
            null,
            null
        );
        // print_r( $db->getResult());
        foreach ($db->getResult() as $row) {
           //print_r($row);
            $count++
        ?>
            <tr>

                <td><?php echo $count; ?></td>
              
                <td> <?php echo $row['f_name'] . ' ' . $row['l_name']; ?></td>
                <td><?php echo date('d-m-Y', strtotime($row['dob']) )  ?>
                <td><?php echo $row['hrms_id']  ?>
                <td><?php echo $row['email']; ?>
                <td><?php echo $row['phone']; ?>
                </td>

                <td style="text-align:center;">
                    <?php
                    if ($row['mdrafm_status'] == 0) {
                        echo "Pending";
                    } else {
                        echo "Accepted";
                    }


                    ?>
                </td>

                <td style="text-align:center;">
                       <a href="#" style="color:#4164b3 ;"
                            class="edit_<?php echo $row['id']; ?>"
                            id="<?php echo $row['id']; ?>"
                            onclick="edit(this.id)"><i class="far fa-edit "
                                style="font-size:1.5rem;"></i></a>
                                                           
                  
                    <input type="button" class="btn " style="background:#3292a2 ; display: <?php echo ($row['mdrafm_status']==1)?'none':'' ?> " 
                      
                     onclick="cnftrainee(<?php echo $row['id'] ?>)" value="Accept" />
                    &nbsp;
                   
                </td>
            </tr>
        <?php
        }


        ?>

    </tbody>
</table>