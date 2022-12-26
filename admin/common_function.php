<?php
//  include 'database.php';
//  $db = new Database();
 //$db = new Database();
  function time_table_data($program_id,$table){
    ?>
        <table class=" term table">
                                        <thead class="" style="background: #315682;color:#fff;font-size: 11px;">

                                            <th >Sl No</th>
                                            <th style="text-align:center;">Name</th>
                                            <th style="text-align:center;">Program Name</th>
                                            <th style="text-align:center;">From Date</th>
                                            <th style="text-align:center;">To Date</th>
                                            <th style="text-align:center;">Status</th>
                                            <th style="text-align:center;">View</th>
                                            <th style="text-align:center;">Add Session</th>
                                            <th style="text-align:center;">Action</th>

                                        </thead>
                                        <tbody>
                                            <?php 
                               
                                        $db = new Database();
                                        $count = 0;
                                        $trng_type = get_trngType($program_id,$table);
                                        $db->select('tbl_time_table_range',"*",null,"type = '$trng_type' AND program_id=".$program_id,"from_dt",null);
                                         //print_r( $db->getResult());
                                        foreach($db->getResult() as $row){
                                            //print_r($row);
                                            $count++;
                                            $from_dt = $row['from_dt'];
                                            $to_dt = $row['to_dt'];
                                            $prog_name='';
                                            $prog_id = '';
                                            $tbl_name = $row['name'];
                                            $bg_color = '';
                                            switch ($row['status']) {
                                                case '3':
                                                    $bg_color = '#a58989;'; 
                                                    break;
                                                case '2':
                                                    $bg_color = '#8889a1';
                                                    break;
                                                default:
                                                    # code...
                                                    break;
                                            }
                                           
                                            ?>
                                            <tr style="background-color: <?php echo $bg_color; ?>">
                                                <td><?php echo $count; ?></td>
                                                <td style="text-align:center;"><?php echo $row['name'] ?></td>
                                                <td style="text-align:center;">
                                                    <?php 
                                                        $slt_prog_sql = "SELECT p.id,p.prg_name,p.trng_type,d.course_director as course_dir_id,d.asst_course_director as asst_course_dir_id FROM `$table` p 
                                                        JOIN `tbl_program_directors` d ON p.course_director = d.id WHERE p.id= $program_id AND p.active = 1";

                                                        $db->select_sql($slt_prog_sql);
                                                       
                                                        foreach($db->getResult() as $row1){
                                                            echo $prog_name = $row1['prg_name'];
                                                                 $prog_id   = $row1['id'];
                                                                 $trng_type = $row1['trng_type'];
                                                                 $course_director = $row1['course_dir_id'];
                                                                 $asst_course_director = $row1['asst_course_dir_id'];;
                                                        }
                                                      
                                                        ?>
                                                </td>
                                                <td style="text-align:center;">
                                                    <?php echo date("d-m-Y", strtotime($row['from_dt']));  ?> </td>
                                                <td style="text-align:center;">
                                                    <?php echo date("d-m-Y", strtotime($row['to_dt']));  ?> </td>
                                                <td style="text-align:center;">
                                                    <?php 
                                                     switch ($row['status']) {
                                                         case '0':
                                                            echo "Draft";
                                                             break;
                                                        case '1':
                                                            echo "Pending";
                                                                break;
                                                        case '2':
                                                            echo "Aprove";
                                                                break;
                                                        case '3':
                                                            echo "Reject";
                                                                break;
                                                         
                                                     }
                                                   ?>

                                                </td>
                                                <td style="text-align:center;">
                                                <?php 
                                                $page = '';
                                                   if($trng_type == 4 || $trng_type == 5){
                                                      $page = 'view_short_time_table.php';
                                                   }
                                                   else{
                                                      $page = 'view_time_table.php';
                                                   }
                                                ?>

                                                    <input type="button" class="btn " style="background:rgb(36 62 118);"
                                                        name="send"
                                                        onclick="datapost( <?php echo  "'$page'" ?>,{id: <?php echo $row['id'] ?> ,
                                                        tbl_name: <?php echo "'$tbl_name'" ?>,type:<?php echo $trng_type; ?>,prog_id:<?php echo $prog_id; ?>,prog_name:<?php echo "'$prog_name'"  ?>,
                                                        course_director:<?php echo $course_director ?>,asst_course_director:<?php echo $asst_course_director ?>,from_dt:<?php echo "'$from_dt'"  ?>,to_dt:<?php echo "'$to_dt'" ?> })"
                                                        value="View" />


                                                </td>
                                                <td style="text-align:center;">
                                                    <?php
                                                     switch ($row['status']) {
                                                         case '0':
                                                             ?>
                                                    <input type="button" class="btn btn-primary"
                                                        style="background:#3292a2;" name="send"
                                                        onclick="datapost('add_time_table.php',{id: <?php echo $row['id'] ?> ,prog_id:<?php echo $prog_id; ?>,trng_type:<?php echo $trng_type; ?>,prog_name:<?php echo "'$prog_name'"  ?>,from_dt:<?php echo "'$from_dt'"  ?>,to_dt:<?php echo "'$to_dt'" ?> })"
                                                        value="<?php echo ($row['status'] == 2)?"Modify Session": "Add Session"?>" />
                                                    <?php
                                                             break;
                                                         case '3':
                                                            ?>
                                                    <input type="button" class="btn btn-primary"
                                                        style="background:rgb(162 115 50);" name="send"
                                                        onclick="datapost('modify_time_table_prog_sec.php',{id: <?php echo $row['id'] ?> ,prog_id:<?php echo $prog_id; ?>,prog_name:<?php echo "'$prog_name'"  ?>,from_dt:<?php echo "'$from_dt'"  ?>,to_dt:<?php echo "'$to_dt'" ?> })"
                                                        value="Modify Session" />
                                                    <?php
                                                         default:
                                                             # code...
                                                             break;
                                                     }
                                                    
                                                    ?>

                                                </td>

                                                <td style="text-align:center;line-height: 20px;">
                                                    <?php
                                                       switch ($row['status']) {
                                                           case '0':
                                                               ?>

                                                    <a href="#" style="color:#4164b3" class="edit"
                                                        id="<?php echo $row['id']; ?>" onclick="edit(this.id)"><i
                                                            class="far fa-edit " style="font-size:1.5rem;"></i></a>
                                                    &nbsp;
                                                    <a href="#" style="color:#e50c0c" id="<?php echo $row['id']; ?>"
                                                        onclick="cnfBox(<?php echo $row['id']; ?>)"><i
                                                            class="far fa-trash-alt "
                                                            style="font-size:1.5rem;"></i></i></a><br>
                                                    <input type="button" class="btn " style="background:rgb(68 162 50);"
                                                        name="send" id="<?php echo $row['id']; ?>"
                                                        onclick="sendToApprove(this.id,'tbl_time_table_range')"
                                                        value="Send To Approve" />
                                                    <?php
                                                               break;
                                                               case '1':
                                                                   echo "Sent To Course Director For Approval";
                                                                   break;
                                                                case '2':
                                                                echo "Approved By Course Director ";
                                                                break;
                                                                case '3':
                                                                    echo " <p> ". $row['remark']." </p>";
                                                                    break;
                                                           
                                                           default:
                                                               # code...
                                                               break;
                                                       }
                                                    ?>


                                                </td>

                                            </tr>
                                            <?php
                                                }
                                        
                                                
                                                ?>

                                        </tbody>
                                    </table>
    <?php
  }


  function getProgramId(){ 
    $db = new Database();
    $program_id = array();
    $prog_sql = "SELECT id FROM `tbl_program_master` WHERE status = 'pendingAtIncharge' ";
    $db->select_sql($prog_sql);
    foreach($db->getResult() as $program){

        array_push($program_id,$program['id']);
    }
    return $program_id ;
  }
 
  function getShortProgramId(){
    $db = new Database();

    $shortprogram_id = array();
    $prog_sql = "SELECT id FROM `tbl_short_program_master` WHERE status = 'pendingAtIncharge' ";
    $db->select_sql($prog_sql);

    foreach($db->getResult() as $program){
       array_push($shortprogram_id,$program['id']);
    }

    return $shortprogram_id ;
  }

function get_trngType($prog_id,$table){
    $db = new Database();

    $trng_type = 1;
    $trng_sql = "SELECT `trng_type` FROM $table WHERE id =".$prog_id;
    $db->select_sql($trng_sql);
    foreach($db->getResult() as $row){

        $trng_type = $row['trng_type'];
    }
    return $trng_type ;
}


?>