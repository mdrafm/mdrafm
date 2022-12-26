<?php

include 'database.php';

//    print_r($_POST);
//    exit;
 
 $db = new Database();

 if ( isset($_POST['action']) && $_POST['action'] == 'view_timetable_courseDir'){
     
    $from_dt = $_POST["from_dt"];
    $to_dt = $_POST["to_dt"];

    ?>
<table class="table table-bordered" style="font-family: sans-serif; ">
    <thead style="font-size: 11px;">
        <tr>
            <th style="" scope="col">Sl No</th>
            <th style="text-align:center;" scope="col">Date</th>

            <?php  
                                               
                                                 $db->select('tbl_time_table',"MAX(session_no) as session",null," table_range_id = '".$_POST['id']."' AND trng_type =".$_POST['type'],null,null);
                                                   //print_r( $db->getResult());
                                                   foreach($db->getResult() as $seson){
                                                       
                                                        for($i=1 ; $i <= $seson['session'];$i++ ){
                                                            ?>
            <th style="text-align:center;">
                <?php 
                                                               echo $i ;
                                                               $db->select('tbl_time_table',"class_start_time,class_end_time",null,"session_no = '$i' GROUP BY session_no",null,null);
                                                               //print_r( $db->getResult());
                                                               switch ($i) {
                                                                   case '1':
                                                                      echo 'st';
                                                                       break;

                                                                    case '2':
                                                                        echo 'nd';
                                                                        break;
                                                                    case '3':
                                                                        echo 'rd';
                                                                        break;

                                                                   default:
                                                                       echo 'th';
                                                                       break;
                                                               }
                                                               
                                                               ?>



            </th>

            <?php
                                                        }
                                                   }

                                            
                                            ?>
        </tr>
    </thead>
    <tbody>
        <?php 
                               
                              
                                            $count = 0;
                                            $db->select('tbl_time_table',"DISTINCT training_dt",null,"  table_range_id = '".$_POST['id']."' AND trng_type =".$_POST['type'],null,null);
                                            // print_r( $db->getResult());
                                            foreach($db->getResult() as $row){
                                                //print_r($row);
                                                $count++
                                                ?>
        <tr>
            <td><?php echo $count; ?></td>
            <td style="text-align:center;">
                <?php echo date("d/m/Y", strtotime($row['training_dt'])); ?> </td>

            <?php
                                                    $db->select('tbl_time_table',"*",null," table_range_id = '".$_POST['id']."' AND training_dt='".$row['training_dt']."' ANd trng_type='".$_POST['type']."' ",null,null); 
                                                    //print_r( $db->getResult()); echo '<pre>';
                                                     foreach($db->getResult() as $res){
                                                         ?>
            <td class="session" id="<?php echo $res['id']; ?>" style="vertical-align: baseline;line-height:15px">
                <div>
                    <?php 
                                                            echo '<div>'.'Class time - '. $res['class_start_time'] .' - '. $res['class_end_time'].'</div>';
                                                            echo '<div style="margin-top: 10px;font-weight: 600;"> ';
                                                            if($res['trng_type'] == 1){

                                                            if($res['session_type'] == 1){

                                                            if($res['paper_covered'] != '' ){
                                                              echo  $res['paper_covered'].'<br>' ;
                                                            }
                                                            else{
                                                                $db->select_one('tbl_topic_master',"topic",$res['topic_id']);
                                                                    
                                                                foreach($db->getResult() as $row3){
                                                                    echo  $row3['topic'].'<br>';
                                                                }
                                                            }
                                                            $db->select_one('tbl_paper_master',"paper_code",$res['paper_id']);
                                                                
                                                            foreach($db->getResult() as $row4){
                                                               
                                                                echo 'Paper - '.$row4['paper_code'].'<br>';
                                                            }

                                                           
                                                            $faculty_id = explode(',',$res['faculty_id']);
                                                       
                                                                foreach($faculty_id as $faculty){
                                                                    $db->select_one("tbl_faculty_master","name",$faculty);
                                                                    
                                                                    foreach($db->getResult() as $row1){
                                                                        echo $row1['name']; echo '<br>';
                                                                    }
                                                                }
                                                           }else{
                                                            echo '<div style="margin-top: 10px;font-weight: 600;">';
                                                               if($res['class_remark'] == '' ){
                                                                 
                                                                $db->select_one('other_topic',"name",$res['other_class']);
                                                                     
                                                                    foreach($db->getResult() as $row3){
                                                                        echo  $row3['name'];
                                                                    }
                                                               }else{
                                                                echo $res['class_remark'];
                                                               }
                                                           } echo '</div>';
                                                        }
                                                        else{

                                                            if($res['trng_type'] == 2){
                                                                $db->select_one('tbl_mid_syllabus',"subject",$res['subject_id']);
                                                                    
                                                                foreach($db->getResult() as $row4){
                                                                    echo  $row4['subject'].'<br>';
                                                                }
                                                            }
                                                            else if($res['trng_type'] == 3 || $res['trng_type'] == 4){
                                                                switch ($res['break_time']) {
                                                                    case '1':
                                                                        echo '<p>Tea Break<p>';
                                                                        break;
                                                                    case '2':
                                                                        echo '<p>Lunch Break<p>';
                                                                        break;
                                                                    default:
                                                                    
                                                                    // echo '<div><p>'.'Class time - '. $res['class_start_time'] .' - '. $res['class_end_time'].'</div></p>';
                                                                
                                                                    if($res['session_type'] == 1){
                                                                    if($res['paper_covered'] != '' ){
                                                                        echo '<p>'. $res['paper_covered']. '</p>' ;
                                                                    }
                                                                    else{
                                                                        $db->select_one('tbl_mid_subject_master',"descr",$res['subject_id']);
                                                                            
                                                                        foreach($db->getResult() as $row3){
                                                                            echo '<p>'. $row3['descr']. '</p>';
                                                                        }
                                                                    }
                                                                   
                                                                    
    
                                                                    $faculty_id = explode(',',$res['faculty_id']);
                                                               
                                                                        foreach($faculty_id as $faculty){
                                                                            $db->select_one("tbl_faculty_master","name",$faculty);
                                                                            
                                                                            foreach($db->getResult() as $row1){
                                                                                if($row1['name'] == 'NA'){
                                                                                    echo $res['guest_faculty_name']; echo '<br>';    
                                                                                }else{
                                                                                    echo $row1['name']; echo '<br>';
                                                                                }
                                                                                
                                                                            }
                                                                        }
                                                                   }else{
                                                                    
                                                                       if($res['class_remark'] == '' ){
                                                                         
                                                                        $db->select_one('other_topic',"name",$res['other_class']);
                                                                             
                                                                            foreach($db->getResult() as $row3){
                                                                                echo '<p>'. $row3['name']. '</p>';
                                                                            }
                                                                       }else{
                                                                        echo $res['class_remark'];
                                                                       }
                                                                   }
                                                                        break;
                                                                }
                                                            }
                                                                
                                                            //echo $res['paper_covered'];
                                                        }  
                                                           ?>
                </div>
            </td>
            <?php
                                                         
                                                     }
                                                ?>


        </tr>
        <?php
                                   }
                      
                               
                                  ?>

    </tbody>
</table>
<?php 

            $db->select_one('tbl_time_table_range',"status,status_dir,remark",$_POST['id']);
            $result = $db->getResult();
            foreach($result as $status){
                // print_r($status);
            if($status['status'] == 1){
                ?>
                    <button type="button" class="btn btn-success" onclick="approve(<?php echo $_POST['id'] ?>,'Approve')">Approve</button>
                    <button type="button" class="btn btn-danger ml-2" onclick="reject(<?php echo $_POST['id'] ?>,'Reject')">Reject</button>
                <?php
            }  
            elseif($status['status'] == 2){
                ?>
                <button type="button" class="btn btn-info">Approved</button>
                <?php
            }
            elseif($status['status'] == 3){
                ?>
                    <button type="button" class="btn btn-danger">Rejected</button>
                    <p class="text-danger">Reject Comment :</p> &nbsp; <?php echo $status['remark']; ?> 
                <?php
            }else{

            }
            
            
        }
        ?>

    <?php
      }

    ?>