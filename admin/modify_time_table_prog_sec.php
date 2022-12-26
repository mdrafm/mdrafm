<!DOCTYPE html>
<html lang="en">


<head>
    <?php 
  
    include('header_link.php');
   
    include('../config.php');
    include 'database.php';
    $db = new Database();
    $from_dt = $_POST["from_dt"];
    $to_dt = $_POST["to_dt"];
    ?>
    <!-- <link rel="stylesheet" href="assets/css/timepicker.min.css">
    <script src="assets/js/timepicker.min.js"></script> -->
    <!-- select2 -->
   
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.1.0/minty/bootstrap.min.css"> -->
    <link href="assets/css/mdtimepicker.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <style>
    /* .table tbody tr td a:hover{
       display: block;
    } */
    body{
        color:black !important;
    }
    .table{
        color:black !important;
    }
    </style>

</head>

<body class="user-profile">

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <div class="wrapper ">

        <?php include('sidebar.php'); ?>

        <div class="main-panel" id="main-panel">
            <?php include('navbar.php'); ?>

            <div class="panel-header panel-header-sm">


            </div>


            <div class="content" style="margin-top: 50px;">

                <div class="row">
                    <div class="col-md-4">
                        <div id="alert_msg" class="alert alert-success">added successfully</div>
                    </div>
                    <div class="col-md-6">
                        <!-- Modal -->
                        <div class="modal fade" id="termModal" tabindex="-1" aria-labelledby="termModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content" style="width:200%; margin:20px -150px">
                                    <div class="modal-header">

                                        <h5 class="modal-title" id="termModalLabel">Time Table For
                                            <?php echo $_POST['prog_name'] ?></h5>

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <form method="post" id="frm_timeTable">
                                            <input type="hidden" name="program_id"
                                                value="<?php echo $_POST['prog_id'] ?>" />
                                            <input type="hidden" name="table_range_id"
                                                value="<?php echo $_POST['id'] ?>" />
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong>Training Date</strong></label>
                                                        <input type="date" class="form-control" name="training_dt"
                                                            id="training_dt" placeholder="Select Training Date"
                                                            value=<?php echo $from_dt ?>>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label><strong> Period Type</strong></label>
                                                        <select class="custom-select mr-sm-2" name="period_type"
                                                            id="period_type">
                                                            <option value="0">Select Period Type</option>
                                                            <option value="1"> Session</option>
                                                            <option value="2"> Break</option>
                                                        </select>


                                                    </div>
                                                </div>
                                                <div class="col-md-3" id="break_fld" style="display:none" >
                                                    <div class="form-group">
                                                        <label><strong> Break</strong></label>
                                                        <select class="custom-select mr-sm-2" name="break_time" id="break">

                                                            <option value="0" >Select Break</option>
                                                            <option value="1"> Tea Break</option>
                                                            <option value="2"> Lunch Break</option>

                                                        </select>


                                                    </div>
                                                </div>


                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong> Class Start Time</strong></label>
                                                            <input type="text" class="form-control" name="class_start_time" id="timepicker_start"/>
                                                            <p id='start_time' style="display:none"></p>
                                                            <span> <button type="button" id="verify_start" onclick = "verify_time('start_time')" class="btn btn-sm" style="background-color:#141664">Verify Class Time</button></span>
                                                            
                                                    </div>
                                                   
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong>Class End Time</strong></label>
                                                            <input type="text" class="form-control" name="class_end_time"  id="timePicker_end"/>
                                                            <p id='end_time' style="display:none"></p>
                                                            <span> <button type="button" id="verify_end" onclick = "verify_time('end_time')" class="btn btn-sm" style="background-color:#141664">Verify Class Time</button></span>
                                                    </div>
                                                   
                                                </div>

                                            </div>
                                            <div id="class_time">
                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label><strong>Session Type</strong></label>
                                                            <div class="form-check form-check-inline"
                                                                style="margin-left: 20px;">
                                                                <input class="form-check-input" type="radio"
                                                                    name="session_type" id="ClassRoom" value="1"
                                                                    checked>
                                                                <label class="form-check-label" for="Inhouse"
                                                                    style="padding-left: 5px;">ClassRoom Study</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="session_type" id="other" value="2">
                                                                <label class="form-check-label" for="Visiting"
                                                                    style="padding-left: 5px;">Other</label>
                                                            </div>
                                                            <!-- <select class="custom-select mr-sm-6" name="faculty_id[]" multiple="multiple"
                                                            id="faculty_id" style="width:400px">
                                                            <option selected>Select Faculty</option>

                                                        </select> -->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 class_room">
                                                        <div class="form-group">
                                                            <label><strong>Faculty Name</strong></label>
                                                            <div class="form-check form-check-inline"
                                                                style="margin-left: 20px;">
                                                                <input class="form-check-input" type="radio"
                                                                    name="faculty" id="active" value="1">
                                                                <label class="form-check-label" for="Inhouse"
                                                                    style="padding-left: 5px;">Inhouse Faculty</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="faculty" id="inactive" value="2">
                                                                <label class="form-check-label" for="Visiting"
                                                                    style="padding-left: 5px;">Visiting Faculty</label>
                                                            </div>
                                                            <select class="custom-select mr-sm-6 faculty_id_div" name="faculty_id[]"
                                                                multiple="multiple"  id="faculty_id" style="width:400px">
                                                                <option selected value="0">Select Faculty</option>

                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 ">
                                                        <div class="others" style="display:none">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label><strong>Select Other
                                                                                Class</strong></label>
                                                                        <select class="custom-select mr-sm-2"
                                                                            name="other_class" id="other_class">
                                                                            <option selected value="0">Select Other
                                                                                Class</option>
                                                                            <?php 
                                                                        
                                                                        $count = 0;
                                                                        $db->select('other_topic',"*",null,null,null,null);
                                                                        // print_r( $db->getResult());
                                                                        foreach($db->getResult() as $row){
                                                                            //print_r($row);
                                                                            $count++
                                                                    ?>
                                                                            <option value="<?php echo $row['id'] ?>">
                                                                                <?php echo $row['name'] ?>
                                                                            </option>

                                                                            <?php 
                                                        }
                                                        ?>
                                                                        </select>


                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label><strong>Remark</strong></label>
                                                                        <textarea class="form-control"
                                                                            name="class_remark" id="class_remark"
                                                                            placeholder="Remark for Other Class"
                                                                            rows="3"
                                                                            style="border: 1px solid #e3e3e3;border-radius:5px;"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- class room -->
                                                <div class="class_room">


                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label><strong>Term</strong></label>
                                                                <select class="custom-select mr-sm-2" name="term_id"
                                                                    id="term_id">
                                                                    <option selected value="0">Select Term</option>
                                                                    <?php 
                                                                    $db = new Database();
                                                                    $count = 0;
                                                                    $db->select('tbl_term_master',"*",null,null,null,null);
                                                                    // print_r( $db->getResult());
                                                                    foreach($db->getResult() as $row){
                                                                        //print_r($row);
                                                                        $count++
                                                                 ?>
                                                                    <option value="<?php echo $row['id'] ?>">
                                                                        <?php echo $row['term'] ?>
                                                                    </option>

                                                                    <?php 
                                                       }
                                                       ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label><strong>Paper</strong></label>
                                                                <select class="custom-select mr-sm-2" name="paper_id"
                                                                    id="paper_id">
                                                                    <option selected value="0">Select Paper</option>

                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row">

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label><strong>Subject</strong></label>
                                                                <select class="custom-select mr-sm-2"
                                                                    name="subject_id" id="subject_id">
                                                                    <option selected value="0">Select Subject</option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label><strong>Topic</strong></label>
                                                                <select class="custom-select mr-sm-2" id="topic_id"
                                                                    name="topic_id">
                                                                    <option selected value="0">Select Topic</option>

                                                                </select>
                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label><strong>Topic Detail</strong></label>
                                                                <select class="custom-select mr-sm-2" id="detail_topic_id"
                                                                    name="detail_topic_id">
                                                                    <option selected value="0">Select Topic Detail
                                                                    </option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label><strong>Topic To Be Covered</strong></label>
                                                                <textarea class="form-control" name="paper_covered"
                                                                    id="paper_covered" placeholder="Enter topic covered"
                                                                    rows="3"
                                                                    style="border: 1px solid #e3e3e3;border-radius:5px;"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end class room -->
                                            <input type="hidden" name="trng_type" value="1">
                                            <input type="hidden" id="update_id">
                                        </form>

                                        <input type="hidden" id = "cls_start_time">
                                        <input type="hidden" id = "cls_end_time" >
                                        <input type="hidden" id = "session_no" >
                                        <input type="hidden" id = "trng_dt" >
                                    </div>
                                    <div class="modal-footer">

                                        <button type="submit" class="btn btn-primary" name="submit" value="Save"
                                            id="save"
                                            onclick="add('Time Table','frm_timeTable','tbl_time_table')">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header">

                                <h5 class="card-title"> Time Table </h5>

                                <div class="row">
                                    <div class="col-md-7">
                                        Duration
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        : From <strong> <?php echo $_POST["from_dt"] ?> </strong> To
                                        <strong><?php echo $_POST["to_dt"] ?></strong>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>Program</strong></label>
                                            <select class="custom-select mr-sm-2" name="program_id" id="program">
                                                <option selected>Select Program</option>
                                                <?php 
                                                                   
                                                                    $count = 0;
                                                                    $db->select('tbl_program_master',"*",null,"trng_type = 1",null,null);
                                                                    // print_r( $db->getResult());
                                                                    foreach($db->getResult() as $row){
                                                                        //print_r($row);
                                                                        $count++
                                                                 ?>
                                                <option value="<?php echo $row['id'] ?>"
                                                    <?php echo ($row['id'] == $_POST['prog_id'] )?'selected': '' ?>>
                                                    <?php echo $row['prg_name'] ?>
                                                </option>

                                                <?php 
                                                       }
                                                       ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong> Select Date</strong></label>
                                            <select class="custom-select mr-sm-2" name="t_date" id="t_date">
                                                <option value='0' selected>Select Date</option>
                                                <?php
                                                              $begin = new DateTime( $_POST["from_dt"] );
                                                              $end   = new DateTime( $_POST["to_dt"] );
                                                              
                                                              for($i = $begin; $i <= $end; $i->modify('+1 day')){
                                                                  ?>

                                                <option><?php echo $i->format("Y-m-d"); ?> </option>
                                                <?php
                                                              }
                                                            
                                                            ?>

                                            </select>
                                            <small class="text-danger" id="t_date_error" style="display:none">Please select a Date</small>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <!-- <input type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#termModal" value="Add Session"> -->
                                            <input type="button" class="btn btn-primary" id="add_session"  value="Add Session">
                                            
                                            
                                    </div>


                                </div>

                            </div>
                            <div class="card-body">

                            </div>
                        </div>

                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Time Table</h4>

                            </div>
                            <div class="card-body">
                                <div id="term2" class=" table table-responsive table-striped table-hover">
                                    <table class=" term table">
                                        <thead class="" style="background: #315682;color:#fff;font-size: 11px;">

                                            <th style="">Sl No</th>
                                            <th >Date</th>

                                            <?php  
                                              $session_count = 0;
                                                 $db->select('tbl_time_table',"MAX(session_no) as session",null,"table_range_id = '".$_POST['id']."' AND trng_type =1 ",null,null);
                                                   //print_r( $db->getResult());
                                                   foreach($db->getResult() as $seson){
                                                    $session_count = $seson['session'];
                                                        for($i=1 ; $i <= $seson['session'];$i++ ){
                                                            ?>
                                            <th >
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

                                                Session <br>

                                            </th>
                                            <?php
                                                        }
                                                   }

                                            
                                            ?>

                                        </thead>
                                        <tbody>
                                            <?php 
                               
                              
                                            $count = 0;
                                            $db->select('tbl_time_table',"DISTINCT training_dt",null,"table_range_id = '".$_POST['id']."' AND trng_type =1 ",null,null);
                                            // print_r( $db->getResult());
                                            foreach($db->getResult() as $row){
                                                //print_r($row);
                                                $count++
                                                ?>
                                            <tr>
                                                <td><?php echo $count; ?></td>
                                                <td><?php echo $row['training_dt']; ?> </td>

                                                <?php
                                                   for ($x=1; $x <= $session_count ; $x++) { 
                                                    $db->select('tbl_time_table',"*",null,"table_range_id = '".$_POST['id']."' AND trng_type = 1 AND training_dt='".$row['training_dt']."' AND session_no = '".$x."' ",null,null); 
                                                    //print_r( $db->getResult()); echo '<pre>';
                                                    ?>
                                                          <td class="session" style="line-height:15px"> 
                                                              <?php
                                                     foreach($db->getResult() as $res){
                                                             //print_r($res);
                                                            ?>
                                                            <a href="#" style="color:#4164b3;float: right;"
                                                        class="edit_<?php echo $res['id']; ?>"
                                                        id="<?php echo $res['id']; ?>" onclick="edit(this.id)"><i
                                                            class="far fa-edit " style="font-size:1.5rem;"></i></a>
                                                            <?php
                                                            switch ($res['break_time']) {
                                                                case '1':
                                                                    echo '<div><p>'.'Break Time - '. $res['class_start_time'] .' - '. $res['class_end_time'].'</div></p><p>Tea Break<p>';
                                                                    break;
                                                                case '2':
                                                                    echo '<div><p>'.'Lunch Time - '. $res['class_start_time'] .' - '. $res['class_end_time'].'</div></p><p>Tea Break<p>';
                                                                    break;
                                                                default:
                                                                
                                                                echo '<p>'.'Class time - '. $res['class_start_time'] .' - '. $res['class_end_time'].'</p>';
                                                            
                                                                if($res['session_type'] == 1){
                                                                if($res['paper_covered'] != '' ){
                                                                    echo '<p>'. $res['paper_covered']. '</p>' ;
                                                                }
                                                                else{
                                                                    $db->select_one('tbl_topic_master',"topic",$res['topic_id']);
                                                                        
                                                                    foreach($db->getResult() as $row3){
                                                                        echo '<p>'. $row3['topic']. '</p>';
                                                                    }
                                                                }
                                                                $db->select_one('tbl_paper_master',"paper_code",$res['paper_id']);
                                                                    
                                                                foreach($db->getResult() as $row4){
                                                                   
                                                                    echo '<p>'.'Paper - '.$row4['paper_code']. '</p>';
                                                                }
    
                                                                $faculty_id = explode(',',$res['faculty_id']);
                                                           
                                                                    foreach($faculty_id as $faculty){
                                                                        $db->select_one('tbl_faculty_master',"name",$faculty);
                                                                        
                                                                        foreach($db->getResult() as $row1){
                                                                            echo $row1['name']; echo '<br>';
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
                                                     ?>
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

    <div class="fixed-plugin">
        <div class="dropdown show-dropdown">
            <a href="#" data-toggle="dropdown">
                <i class="fa fa-cog fa-2x"> </i>
            </a>
            <ul class="dropdown-menu">
                <li class="header-title"> Sidebar Background</li>
                <li class="adjustments-line">
                    <a href="javascript:void(0)" class="switch-trigger background-color">
                        <div class="badge-colors text-center">
                            <span class="badge filter badge-yellow" data-color="yellow"></span>
                            <span class="badge filter badge-blue" data-color="blue"></span>
                            <span class="badge filter badge-green" data-color="green"></span>
                            <span class="badge filter badge-orange active" data-color="orange"></span>
                            <span class="badge filter badge-red" data-color="red"></span>
                        </div>
                        <div class="clearfix"></div>
                    </a>
                </li>


            </ul>
        </div>
    </div>
    <!-- Guest Faculty Modal -->
    <div id="guestModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content" style="width:170% ; margin: 50px -120px;background-color: #d9cece;">
                <form>
                    <div class="modal-header" style="background-color: #3b5157;color:#fff;">
                        <h5 class="modal-title" id="m_title" style="text-align:center;">Guest Faculty Subject Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                    <div class="row" id="guest" >
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Geust Faculty Paper</strong></label>
                                    <select class="custom-select mr-sm-2" name="guest_paper"
                                        id="guest_paper">
                                        <option selected value="0">Select Paper</option>
                                        <?php 
                                        $db = new Database();
                                        $count = 0;
                                        $db->select('tbl_guest_paper',"*",null,null,null,null);
                                        // print_r( $db->getResult());
                                        foreach($db->getResult() as $row){
                                            //print_r($row);
                                            $count++
                                        ?>
                                        <option value="<?php echo $row['id'] ?>">
                                            <?php echo $row['paper_name'] ?>
                                        </option>

                                        <?php 
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Geust Faculty Subject</strong></label>
                                    <select class="custom-select mr-sm-2" name="guest_subject"
                                        id="guest_subject">
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Geust Faculty</strong></label>
                                    <select class="custom-select mr-sm-2" name="guest_faculty[]"  multiple="multiple" 
                                        id="guest_faculty" style="width:400px">
                                        
                                    </select>
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" id="m_footer" style="background-color: #525264;height: 60px;">
                    <input type="button" class="btn btn-primary btn-sm" id="add_faculty"  value="Add">
                        <input type="button" class="btn btn-default btn-sm"  data-dismiss="modal" value="Cancel">

                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- msgBox Modal Modal HTML -->
    <div id="cnfModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="m_title" style="text-align:center;">Delete Term</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="warning">
                            <p>Are you sure you want to delete this Record?</p>
                            <p class="text-warning"><small>This action cannot be undone.</small></p>
                        </div>
                        <p id="m_body"></p>
                    </div>
                    <div class="modal-footer" id="m_footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- msgBox Modal Modal HTML -->
    <div id="cnfModaSend" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="m_title" style="text-align:center;">Send TO MDRAFM</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="warning">
                            <p>Are you sure you want to Send this Record?</p>
                            <p class="text-warning"><small>This action cannot be undone.</small></p>
                        </div>
                        <p id="m_body"></p>
                    </div>
                    <div class="modal-footer" id="ms_footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">

                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include('common_script.php') ?>

</body>

</html>

<script type="text/javascript">
$('#faculty_id').select2();
$('#guest_faculty').select2();


$('#timepicker_start').mdtimepicker(); //Initializes the time picker
$("#timePicker_end").mdtimepicker();

$('#add_session').on('click', function(){
    let t_date = $('#t_date').val();
    if(t_date == 0){
      // $('#t_date_error').html('Please select a date');
       $('#t_date_error').show();
       
    }else{
        $('#t_date_error').hide();
        $('#termModal').modal('show');
    }
    //alert(t_date);
})

$('#t_date').on('change', function() {
    //alert(12);
    var t_date = $('#t_date').val();
    var date = `${t_date}`;
    $('#training_dt').val(date);

})

$('#period_type').on('change',function(){
    let period = $('#period_type').val();
  
    if(period == '2'){
        $('#break_fld').show();
    }
    else{
        $('#break_fld').hide();
    }
})

$('#training_dt').on('change', function() {
    var from_dt = <?php echo "'$from_dt'" ?>;
    var to_dt = <?php echo "'$to_dt'" ?>;

    var select_dt = $('#training_dt').val();
    if (select_dt < from_dt) {
        alert(`Please select date between ${from_dt} to ${to_dt}`);
        $('#training_dt').val('');
    }
    if (select_dt > to_dt) {
        alert(`Please select date between ${from_dt} to ${to_dt}`);
        $('#training_dt').val('');
    }
    //console.log(select_dt);
})

//break time code 

$('#break').on('change', function(){
    var break_time = $('#break').val();
    //alert(break_time);
    $('#class_time').hide();
    if(break_time == 0){
        $('#class_time').show();
    }
})


$('input[name="faculty"]').click(function() {
    if ($(this).is(':checked')) {
        //alert($(this).val());
        let id = $(this).val();
        if(id == 1){
                $.ajax({
                type: "POST",
                url: "ajax_timetable.php",

                data: {
                    facult_id: id,
                    table: "tbl_faculty_master",
                    action: "select_faculty"
                },
                success: function(res) {
                    console.log(res);
                    $('.faculty_id_div').html(res);
                }
            })
        }else{
            //    $('#guest').show();
            //    $('.inhouse').hide();
            $('#guestModal').modal('show');
            
            $.ajax({
                type: "POST",
                url: "ajax_timetable.php",

                data: {
                   
                    table: "tbl_faculty_master",
                    action: "select_guest_faculty"
                },
                success: function(res) {
                    
                    $('.faculty_id_div').html(res);
                   

                }
            })

        }
        
    }
})

$('#guest_paper').on('change', function() {
    var paper_id = $(this).val();
    //alert(paper_id);

    $.ajax({
        type: "POST",
        url: "ajax_timetable.php",

        data: {
            action: "assign_subjecToFaculty",
            paper_id: paper_id,
            table: "tbl_guest_subject",
            
        },
        success: function(res) {
            console.log(res);
            $('#guest_subject').html(res);
        }
    })

})

$('#guest_subject').on('change', function() {
    var subject_id = $(this).val();
    var paper_id =$('#guest_paper').val();
    //alert(paper_id);

    $.ajax({
        type: "POST",
        url: "ajax_timetable.php",

        data: {
            action: "slct_guest_faculty",
            paper_id: paper_id,
            subject_id:subject_id,
            table: "tbl_guest_subject",
            
        },
        success: function(res) {
            console.log(res);
            $('#guest_faculty').html(res);
        }
    })

})

$('#add_faculty').on('click', function() {
    var guest_faculty = $('#guest_faculty').val();
    var faculty = guest_faculty.toString();
          $.ajax({

                type: "POST",
                url: "ajax_timetable.php",

                data: {
                    action: "add_guest_faculty",
                    faculty_id: faculty,
                    table: "tbl_faculty_master"
                    
                },
                success: function(res) {
                    console.log(res);
                    $('#faculty_id').html(res);
                }
            });
   
   
    $('#guestModal').modal('hide');
    console.log(faculty);
})

$('#term_id').on('click', function() {
    var term_id = $(this).val();
    // alert(term_id);

    $.ajax({
        type: "POST",
        url: "ajax_timetable.php",

        data: {
            term_id: term_id,
            table: "tbl_paper_master",
            action: "select_paper"
        },
        success: function(res) {
            console.log(res);
            $('#paper_id').html(res);
        }
    })

})

$('#paper_id').on('click', function() {
    var paper_id = $(this).val();
    // alert(term_id);

    $.ajax({
        type: "POST",
        url: "ajax_timetable.php",

        data: {
            paper_id: paper_id,
            table: "tbl_subject_master",
            action: "select_mjr_subject"
        },
        success: function(res) {
            console.log(res);
            $('#mjr_subject_id').html(res);
        }
    })

})

$('#mjr_subject_id').on('change', function() {
    var subject_id = $(this).val();
    // alert(term_id);
    $('#topic_id').html('');
    $.ajax({
        type: "POST",
        url: "ajax_timetable.php",

        data: {
            subject_id: subject_id,
            table: "tbl_topic_master",
            action: "select_topic"
        },
        success: function(res) {
            console.log(res);
            $('#topic_id').html(res);
        }
    })

})
$('#topic_id').on('change', function() {
    var topic_id = $(this).val();

    $.ajax({
        type: "POST",
        url: "ajax_timetable.php",

        data: {
            topic_id: topic_id,
            table: "tbl_detail_topic_master",
            action: "select_deatail_topic"
        },
        success: function(res) {
            console.log(res);
            $('#subject_id').html(res);
        }
    })

})


function add(str, frm, tbl) {


    var update_id = $('#update_id').val();
    var faculty = $("input[name = 'faculty']:checked").val();
   
    $.ajax({
        type: "POST",
        url: "ajax_timetable.php",

        data: $('#' + frm).serialize() + '&' + $.param({
            
            'faculty_type':faculty,
            'action': 'add_table',
            'table': tbl,
            'update_id': update_id
        }),
        success: function(res) {
            console.log(res);
            let elm = res.split('#');
            console.log(elm);
            if (elm[1] == "success") {
                
                location.reload();
            }
            if (elm[2] == "success") {
                sessionStorage.message = str + ' ' + elm[1];
                sessionStorage.type = "success";
                location.reload();
            }
            
            if((elm[2] == "error")){
                if(elm[0] == 'start'){
                    $('#start_time').html(elm[1]);
                    $('#start_time').show();
                }
                if(elm[0] == 'end'){
                    $('#end_time').html(elm[1]);
                    $('#end_time').show();
                }
               
            }
        }
    })

}

function edit(id) {

$.ajax({
    type: "POST",
    url: "ajax_master.php",
    dataType: "json",
    data: {
        action: "edit",
        table: "tbl_time_table",
        edit_id: id

    },
    success: function(res) {
        console.log(res);
        res.map((data) => {

                $('#update_id').val(data.id);
                $('#program').val(data.program_id);

                $('#training_dt').val(data.training_dt);
                $('#period_type').val(data.period_type);
                if(data.period_type == 2){
                    $('#break_fld').show();
                    $('#break').val(data.break_time);
                    $('#class_time').hide();
                }
                $('#timepicker_start').val(data.class_start_time);
                $('#timePicker_end').val(data.class_end_time);
                $('#faculty_id').val(data.faculty_id);
                $('#term_id').val(data.term_id);
                $('#paper_id').val(data.paper_id);
                $('#subject_id').val(data.subject_id);
                $('#topic_id').val(data.topic_id);
                $('#paper_covered').val(data.paper_covered);
                $('#cls_start_time').val(data.class_start_time);
                $('#cls_end_time').val(data.class_end_time);
                $('#session_no').val(data.session_no);
                $('#trng_dt').val(data.training_dt);
                var paper = $('#paper_id').val();

                if (data.session_type == 2) {
                    //console.log(23);
                    $('#other').attr('checked', 'checked');
                    $('.class_room').hide();
                    $('.others').show();


                    $.ajax({

                        type: "POST",
                        url: "ajax_edit_master.php",

                        data: {
                            other_class: data.other_class,

                            table: "other_topic",
                            action: "other_class"
                        },
                        success: function(res) {
                            console.log(res);
                            $('#other_class').html(res);
                        }
                    });
                    //$('#class_remark').val(data.class_remark);

                } else {

                    $('#ClassRoom').attr('checked', 'checked');
                    $('.class_room').show();
                    $('.others').hide();
                    
                    
                    if(data.faculty_type == 2){
                       
                       $('#guest').attr('checked', 'checked');
                  }else{
                    
                      $('#inHouse').attr('checked', 'checked');
                  }
                  
                    $.ajax({

                        type: "POST",
                        url: "ajax_timetable.php",

                        data: {
                            facult_id: data.faculty_id,

                            table: "tbl_faculty_master",
                            action: "select_faculty"
                        },
                        success: function(res) {
                            //console.log(res);
                            $('#faculty_id').html(res);
                        }
                    });

                  
                        var term_id = data.term_id;
                         var paper_id = data.paper_id;

                        $.ajax({
                            type: "POST",
                            url: "ajax_edit_master.php",

                            data: {
                                term_id: term_id,
                                paper_id:paper_id,
                                table: "tbl_paper_master",
                                action: "select_paper"
                            },
                            success: function(res) {
                                //console.log(res);
                                $('#paper_id').html(res);
                                   var paper = $('#paper_id').val();
                               
                                    $.ajax({
                                        type: "POST",
                                        url: "ajax_edit_master.php",

                                        data: {
                                            sub_id: data.subject_id,
                                            paper_id: paper,
                                            table: "tbl_subject_master",
                                            action: "select_subject"
                                        },
                                        success: function(res) {
                                            //console.log(res);
                                            $('#subject_id').html(res);
                                            mjr_sub = $('#subject_id').val();
                                            //console.log(mjr_sub);
                                            $.ajax({
                                                type: "POST",
                                                url: "ajax_edit_master.php",

                                                data: {
                                                    topic_id: data.topic_id,
                                                    mjr_sub_id: mjr_sub,
                                                    table: "tbl_topic_master",
                                                    action: "select_topic"
                                                },
                                                success: function(res) {
                                                   
                                                    $('#topic_id').html(res);
                                                    var topic_id = $('#topic_id').val();
                                                    var dtl_topic_id = data.detail_topic_id;
                                                   $.ajax({
                                                        type: "POST",
                                                        url: "ajax_edit_master.php",

                                                        data: {
                                                            topic_id: topic_id,
                                                            
                                                            dtl_topic_id:dtl_topic_id,
                                                            table: "tbl_detail_topic_master",
                                                            action: "select_detail_topic"
                                                        },
                                                        success: function(res) {
                                                            console.log(res);
                                                            $('#detail_topic_id').html(res);
                                                                
                                                                    

                                                        }
                                                    });

                                                    
                                                }
                                            });
                                           
                                        }
                                    });
                            }
                        })

                  
                }

                $('#save').html('Update');
                $('#save').attr('id', 'update');
                $('#termModal').modal('show');

            }

        )

    }
})
}

$('input[name="session_type"]').click(function() {
    if ($(this).is(':checked')) {
        //alert($(this).val());
        let id = $(this).val();
        if (id == 2) {
            $('.class_room').hide();
            $('.others').show();
        } else {
            $('.class_room').show();
            $('.others').hide();
        }

    }
})

async function getData(sub_id, paper) {

    const result = await $.ajax({
        type: "POST",
        url: "ajax_edit_master.php",

        data: {
            mjr_id: sub_id,
            paper_id: paper,
            table: "tbl_mjr_subject_master",
            action: "select_mjr_subject"
        }
    });
    return result;
}

function cnfBox(id) {
    //alert(id);
    $('#m_footer').empty();
    var html =
        `<input type="button" class="btn btn-danger btn-dlt" value="Delete" onclick="delete_record(${id},'tbl_time_table')" />`;
    $('#m_footer').append(html);
    $('#cnfModal').modal('show');
}

function delete_record(id, tbl) {

    $.ajax({
        type: "POST",
        url: "ajax_master.php",
        data: {

            action: "delete",
            id: id,
            table: tbl
        },
        success: function(res) {
            console.log(res);
            if (res == "success") {
                sessionStorage.message = "record deleted successfully";
                sessionStorage.type = "success";
                location.reload();
            }
        }
    })
}


function verify_time(period){
    //$("#timePicker_end").val("12:30 PM");
    let start_time =   $("#cls_start_time").val();
    let end_time =   $("#cls_end_time").val();
    let session_no =  $("#session_no").val();
    let t_date = $('#trng_dt').val();
   // alert(start_time);
    let program_id = "<?php echo $_POST['prog_id']; ?>";
   
    //alert(program_id);
    $.ajax({
        type: "POST",
        url:"ajax_timetable.php",
        data:{'action':'verify_time_edit',period:period,program_id:program_id,trng_date:t_date,start_time:start_time,end_time:end_time,session_no:session_no},
        success: function(data){
            console.log(data);
            let elm = data.split('#');
            if(elm[0] == 'start'){
                $('#start_time').addClass('error');
                $('#start_time').html(elm[1]);
                $('#start_time').show();
            }else{
                $('#start_time').hide();
                $('#end_time').addClass('error');
                $('#end_time').html(elm[1]);
                $('#end_time').show();
            }
        }
    })
}

function send_record(id, tbl) {

    $.ajax({
        type: "POST",
        url: "ajax_master.php",
        data: {

            action: "send",
            id: id,
            table: tbl
        },
        success: function(res) {
            console.log(res);
            if (res == "success") {
                sessionStorage.message = "Send to MDRAFM Successfully";
                sessionStorage.type = "success";
                location.reload();
            }
        }
    })
}
</script>