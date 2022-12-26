<!DOCTYPE html>
<html lang="en">


<head>
    <?php 
  
    include('header_link.php');
   
    include('../config.php');
    include 'database.php';
    $db = new Database();
      
      
    ?>
    <!-- <link rel="stylesheet" href="assets/css/timepicker.min.css">
    <script src="assets/js/timepicker.min.js"></script> -->
    <!-- select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <style>
    /* .table tbody tr td a:hover{
       display: block;
    } */
    </style>

</head>

<body class="user-profile">

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <div class="wrapper ">

        <?php //include('sidebar.php'); ?>

        <div class="main-panel" id="main-panel" style="width: 100%;">
            <?php include('navbar.php'); ?>

            <div class="panel-header panel-header-sm">


            </div>


            <div class="content">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header" style="font-size: 0.7rem;">
                                <h5 class="card-title text-center">Madhusudan Das Regional Academy of Financial
                                    Management,Bhubaneswar</h5>
                                <?php 
                                    //print_r($_POST); 
                                   
                                     $db->select_one('tbl_program_master','prg_name',$_POST['program_id']);
                                     //print_r($db->getResult());
                                     foreach($db->getResult() as $prog){
                                       
                                         ?>

                                <h5 class="text-center"> Time Table for <?php echo $prog['prg_name'] ?> </h5>
                                <?php
                                     }
                                    ?>

                            </div>
                            <div class="card-body">
                                <div>
                                    <?php
                                      $db->select('tbl_time_table','DISTINCT(table_range_id)',null,'program_id ='.$_POST['program_id'],null,null);
                                      foreach($db->getResult() as $range){
                                        //print_r($range);
                                             $db->select_one('tbl_time_table_range','name,from_dt,to_dt',$range['table_range_id']);
                                                 foreach($db->getResult() as $info){
                                                    ?>
                                    <p class="text-center"
                                        style="font-size:18px;font-weight: 500; page-break-before: always">
                                        <?php echo $info['name']  ?> &nbsp;(&nbsp;
                                        <?php echo date("d/m/Y", strtotime($info['from_dt'])).' - '.date("d/m/Y", strtotime($info['to_dt']))?>
                                        &nbsp;) </p>
                                    <?php
                                                 }
                                                 
                                             
                                        ?>

                                    <table class="table table-bordered"
                                        style="font-family: sans-serif;margin:50px 0px; ">
                                        <thead style="font-size: 11px;">
                                            <tr>
                                                <th scope="col">Sl No</th>
                                                <th style="text-align:center;" scope="col">Date</th>

                                                <?php  
                                                  $trng_type = $_POST['trng_type'];

                                                 $db->select('tbl_time_table',"MAX(session_no) as session",null," table_range_id = '".$range['table_range_id']."' AND trng_type = '".$trng_type."' ",null,null);
                                                   //print_r( $db->getResult());
                                                   foreach($db->getResult() as $seson){
                                                       
                                                        for($i=1 ; $i <= $seson['session'];$i++ ){
                                                            ?>
                                                <th style="text-align:center;">
                                                    <?php 
                                                           
                                                            //    echo $i ;
                                                               $db->select('tbl_time_table',"class_start_time,class_end_time",null,"session_no = '$i' GROUP BY session_no",null,null);
                                                               //print_r( $db->getResult());
                                                               switch ($i) {
                                                                case '1':
                                                                    echo  $i.' st Session';
                                                                     break;

                                                                  case '2':
                                                                      echo 'Break';
                                                                      break;
                                                                  case '3':
                                                                      echo ($i-1).' nd Session';
                                                                      break;
                                                                  case '4':
                                                                      echo 'Break';
                                                                      break;
                                                                  case '5':
                                                                      echo ($i-2).'rd Session';
                                                                      break;
                                                                  case '6':
                                                                      echo 'Break';
                                                                      break;
                                                                  case '7':
                                                                      echo ($i-3).'th Session';
                                                                      break;
                                                                  case '8':
                                                                      echo ($i-3).'th Session';
                                                                      break;

                                                                   default:
                                                                       echo 'th Session';
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
                                            $db->select('tbl_time_table',"DISTINCT training_dt",null,"  table_range_id = '".$range['table_range_id']."' AND trng_type = '".$trng_type."'",null,null);
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
                                                    $db->select('tbl_time_table',"*",null," table_range_id = '".$range['table_range_id']."' AND training_dt='".$row['training_dt']."' ANd trng_type= '".$trng_type."' ",null,null); 
                                                    //print_r( $db->getResult()); echo '<pre>';
                                                     foreach($db->getResult() as $res){
                                                         ?>
                                                <td class="session" id="<?php echo $res['id']; ?>"
                                                    style="vertical-align: baseline;line-height: 25px;">
                                                    <div>
                                                        <?php 
                                                            echo '<div>'.'Class time - '. $res['class_start_time'] .' - '. $res['class_end_time'].'</div>';
                                                            echo '<div style="margin-top: 10px;font-weight: 600;"> ';
                                                            if($res['trng_type'] == 1){
                                                                if($res['period_type'] == 2) {
                                                                    echo ($res['break_time'] == 1)?'Tea Break':'Lunch Break';
                                                                } 
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
                                                        }else{

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
                                    <hr style="border-top: 6px solid rgba(0,0,0,.1);">
                                    <?php
                                      }
                                    ?>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>


        </div>

    </div>

    </div>

    </div>


    <?php include('common_script.php') ?>

</body>

</html>

<script type="text/javascript">

</script>