<!DOCTYPE html>
<html lang="en">


<head>
    <?php 
    
    include('header_link.php');
    include('../config.php');
    include 'database.php';
   
    ?>
    <style>
    .card label {
        font-size: 1rem;
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
        <?php
         $db = new Database();
         $co_role = 0;
         $asst_co_role = 0;
          $db->select('tbl_role_master','*',null,"status=1 AND name = 'short_course_co' OR name = 'short_asst_course_co' ",null,null);
          
          foreach($db->getResult() as $role){
            if($role['name'] == 'short_course_co') {
               $co_role = $role['id'];
            }
            if($role['name'] == 'short_asst_course_co') {
                $asst_co_role = $role['id'];
             }
            }
        ?>
        <div class="main-panel" id="main-panel">
            <?php include('navbar.php'); ?>

            <div class="panel-header panel-header-sm">


            </div>


            <div class="content" style="margin-top: 50px;">

                <div class="row">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4 class="card-title">Short Program List</h4>
                                    </div>

                                </div>


                            </div>
                            <div class="card-body">
                                <div id="term2" class=" table table-responsive table-striped table-hover"
                                    style="width:100%;margin:0px auto">
                                    <table class=" term table">
                                        <thead class="" style="background: #315682;color:#fff;font-size: 11px;">

                                            <th style="width:50px;">Sl No</th>
                                            <th style="text-align:center;">Programm Name</th>
                                            <th style="text-align:center;">Tranning Type</th>
                                            <th style="text-align:center;">Provisanal Start Date</th>
                                            <th style="text-align:center;">Status</th>
                                            <th style="text-align:center;">Action</th>

                                        </thead>
                                        <tbody>
                                            <?php 
                            
                              
                               $count = 0;
                              // $db->select('tbl_short_program_master',"s.*,c.faculty_id"," s JOIN `tbl_course_director` c ON s.course_director=c.id","s.status != 'draft' ","s.start_date DESC",null );
                                $db->select('tbl_short_program_master',"*",null,"status != 'draft' ","start_date DESC",null );             
                            
                               foreach($db->getResult() as $row){
                                  
                                   $tbl = "";
                                   $count++;
                                   $from_dt = $row['start_date'];
                                   $to_dt = $row['end_date'];
                                   $prg_name = $row['prg_name'];

                                   ?>
                                            <tr>
                                                <td><?php echo $count; ?></td>
                                                <td style="text-align:center;"><?php echo $row['prg_name']; ?> </td>
                                                <td style="text-align:center;">
                                                  <?php 
                                                     if($row['trng_type'] == 4){
                                                        echo "Inhouse Program";
                                                      }else{
                                                        echo "Sponsored Program"; 
                                                      }
                                                  ?> 
                                                </td>
                                                <td style="text-align:center;">
                                                    <?php echo date("d/m/Y", strtotime($row['start_date'])) ?>
                                                </td>
                                                <td style="text-align:center;">
                                                    <?php 
                                                   
                                                    switch ($row['status']) {
                                                        case 'approve':
                                                            echo 'Approved';
                                                            break;
                                                        case 'pendingAtDirector':
                                                            echo 'Pending at Director';
                                                            break;
                                                        case 'reject_by_incharge':
                                                            echo 'Rejected';
                                                            break;
                                                        case 'pendingAtIncharge':
                                                            echo 'Pending';
                                                            break;
                                                       
                                                           
                                                    }
                                                    ?>
                                                </td>
                                                <td style="text-align:center;">

                                                        <input type="button" style="background: #bb1b09;border: 0;
                                                                                padding: 5px;
                                                                                border-radius: 3px;
                                                                                color: #fff;"
                                                              onclick="ViewModal(<?php echo $row['id'] ?>,<?php echo $row['trng_type'] ?>)"   
                                                              value="view"><br>
                                                         <?php
                                                          if ($row['mdrafm_status']==1){
                                                            ?>
                                                               <input type="button" class="m-2"  style="background:#3292a2;border: 0;
                                                                                    padding: 5px;
                                                                                    border-radius: 3px;
                                                                                    color: #fff;"
                                                        name="send" onclick="datapost('view_sponsered_time_table.php',{id: <?php echo $row['id'] ?> ,prog_name:<?php echo "'$prg_name'"  ?>,from_dt:<?php echo "'$from_dt'"  ?>,to_dt:<?php echo "'$to_dt'" ?> })" value="Time Table" /><br> 
                                                        <input type="button"  style="background: rgb(83 52 170);border: 0;
                                                                                        padding: 5px;
                                                                                        border-radius: 3px;
                                                                                        color: #fff;"
                                                        name="send" onclick="datapost('view_sponsered_trainee_list.php',{id: <?php echo $row['id'] ?> ,trng_type:<?php echo $row['trng_type']  ?> })" value="Trainee List" /> 
                                                     
                                                            <?php
                                                          }
                                                         
                                                         ?>
                                                         
                                                      
                                                    <div class="modal fade" id="prgram_list_<?php echo $row['id'] ?>"
                                                        tabindex="-1" aria-labelledby="termModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content"
                                                                style="width:150%; margin:20px -100px">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="termModalLabel"> Short Term
                                                                        Program
                                                                        Detail</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <?php //sprint_r($row); ?>
                                                                    <form>
                                                                        <div class="div">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="row">
                                                                                        <div class="col-md-4 text-left">
                                                                                            <label for="">Program Name:
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="col-md-8 text-left">
                                                                                            <?php echo $row['prg_name']?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            </div><br>
                                                                            <?php 
                                                                            
                                                                            $db->select("tbl_short_program_master","*",null,'id='.$row['id'],null,null);
                                                                            foreach($db->getResult() as $row1){
                                                                                //print_r($row1);
                                                                                if( $row1['status']=='approve' ){
                                                                                    ?>
                                                                           
                                                                            <div class="row">
                                                                    <div class="col-md-12">

                                                                                                <div class="row">
                                                                                                    <div class="col-md-4 text-left">
                                                                                                        <label for="">
                                                                                                            Start Date:
                                                                                                        </label>
                                                                                                    </div>
                                                                                                    <div class="col-md-8 text-left">
                                                                                                        <?php echo date("d-m-Y", strtotime($row1['start_date']))  ?>

                                                                                                    </div>
                                                                                                </div>

                                                                                      </div>
                                                                                            <div class="col-md-12">
                                                                                                <div class="row">
                                                                                                    <div class="col-md-4 text-left">
                                                                                                        <label for=""> End
                                                                                                            Date:
                                                                                                        </label>
                                                                                                    </div>
                                                                                                    <div class="col-md-8 text-left">
                                                                                                        <?php echo date("d-m-Y", strtotime($row1['end_date']))  ?>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>

                                                                                        </div>


                                                                            <?php
                                                                                }else{
                                                                                    ?>
                                                                            <div class="row">
                                                                               

                                                                            </div><br>
                                                                            <div class="row">
                                                                                <div class="col-md-6">

                                                                                    <div class="row">
                                                                                        <div class="col-md-4 text-left">
                                                                                            <label for="">
                                                                                                Start Date:
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="col-md-8 text-left">
                                                                                            <input type="date"
                                                                                                class="form-control"
                                                                                                name="provisonal_Start_date"
                                                                                                id="provisonal_Start_date"
                                                                                                value="<?php echo $row['start_date']?>">

                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="row">
                                                                                        <div class="col-md-4 text-left">
                                                                                            <label for=""> End
                                                                                                Date:
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="col-md-8 text-left">
                                                                                            <input type="date"
                                                                                                class="form-control"
                                                                                                name="provisonal_Edate"
                                                                                                id="provisonal_Edate"
                                                                                                value="<?php echo $row['end_date']?>">

                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            </div><br>
                                                                            <div class="row">
                                                                                    <div class="col-md-6">

                                                                                        <div class="row">
                                                                                            <div
                                                                                                class="col-md-4 text-left">
                                                                                                <label for="">Course
                                                                                                    Director :
                                                                                                </label>
                                                                                            </div>
                                                                                            <div
                                                                                                class="col-md-8 text-left">
                                                                                                <select
                                                                                                    class="custom-select mr-sm-2"
                                                                                                    name="course_director"
                                                                                                    id="course_director_<?php echo $row['id'] ?>"
                                                                                                    style="height: calc(1em + 0.75rem + 2px);padding:0px"
                                                                                                    onchange="add_course_dir(<?php echo $row['id'] ?>,<?php echo $row['course_director'] ?>,<?php echo $co_role ?>,<?php echo $row['trng_type']; ?>,'tbl_short_program_master')">

                                                                                                    <option selected>
                                                                                                        Select
                                                                                                        Course Director
                                                                                                    </option>
                                                                                                    <?php 
                                                                                                       $faculty_id = '';
                                                                                                         $db->select('tbl_program_directors',"course_director",null,'id='.$row['course_director'],null,null);
                                                                                                         foreach($db->getResult() as $row7){
                                                                                                            $faculty_id = $row7['course_director'];
                                                                                                         }
                                                                   
                                                                                                        $db->select('tbl_faculty_master',"id,name",null,'role=1 AND status =1',null,null);
                                                                                                        // print_r( $db->getResult());
                                                                                                        foreach($db->getResult() as $row6){
                                                                                                            //print_r($row);
                                                                                                        
                                                                                                    ?>
                                                                                                    <option
                                                                                                        value="<?php echo $row6['id'] ?>"
                                                                                                        <?php echo ($row6['id'] == $faculty_id)?'selected':'' ?>>
                                                                                                        <?php echo $row6['name'] ?>
                                                                                                    </option>

                                                                                                    <?php 
                                                                                                        }
                                                                                                        ?>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="row">
                                                                                            <div class="row">
                                                                                                <div
                                                                                                    class="col-md-4 text-left">
                                                                                                    <label for="">Asst
                                                                                                        Course
                                                                                                        Director</label>

                                                                                                </div>
                                                                                                <div class="col-md-8 ">

                                                                                                    <select
                                                                                                        class="custom-select mr-sm-2"
                                                                                                        name="asst_course_director"
                                                                                                        id="asst_course_director_<?php echo $row['id'] ?>"
                                                                                                        style="height: calc(1em + 0.75rem + 2px);padding:0px"
                                                                                                        onchange="add_asst_course_dir(<?php echo $row['id'] ?>,<?php echo $row['course_director'] ?>,<?php echo $asst_co_role ?>,<?php echo $row['trng_type']; ?>,'tbl_short_program_master')">

                                                                                                        <option selected
                                                                                                            value="0">
                                                                                                            Asst Course
                                                                                                            Director
                                                                                                        </option>
                                                                                                        <?php 
                                                                                                           $asst_faculty_id = '';
                                                                                                           $db->select('tbl_program_directors',"asst_course_director",null,'id='.$row['course_director'],null,null);
                                                                                                           foreach($db->getResult() as $row8){
                                                                                                              $asst_faculty_id = $row8['asst_course_director'];
                                                                                                           }
                                                                   
                                                                                                        $db->select('tbl_faculty_master',"id,name",null,'role=1 AND status =1',null,null);
                                                                                                        // print_r( $db->getResult());
                                                                                                        foreach($db->getResult() as $row5){
                                                                                                            //print_r($row);
                                                                                                        
                                                                                                    ?>
                                                                                                        <option
                                                                                                            value="<?php echo $row5['id'] ?>"
                                                                                                            <?php echo ($row5['id'] == $asst_faculty_id)?'selected':'' ?>>
                                                                                                            <?php echo $row5['name'] ?>
                                                                                                        </option>

                                                                                                        <?php 
                                                                                                        }
                                                                                                        ?>
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                </div><br>


                                                                            <?php
                                                                                }
                                                                                
                                                                            }
                                                                            ?>






                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <?php
                                                                   // echo $row['status'];
                                                                      switch ($row['status']) {
                                                                          case 'pendingAtDirector':
                                                                            ?>
                                                                    <button type="button" class="btn btn-info"> Already
                                                                        Approved</button>
                                                                    <?php
                                                                              break;
                                                                          case 'pendingAtIncharge':
                                                                            ?>
                                                                    <button type="button" class="btn btn-info"
                                                                        onclick="approve(<?php echo $row['id'] ?>,'Send')">Send To Director</button>

                                                                    <button type="button" class="btn btn-danger ml-2"
                                                                        onclick="reject(<?php echo $row['id'] ?>,'Reject')">Reject</button>

                                                                    <?php
                                                                            break;
                                                                            case 'reject_by_incharge':
                                                                              ?>
                                                                              <div>
                                                                                <p><b> Reject Comment</b> :<span style="color:#6a0027 "><?php echo $row1['remark'] ?></span></p>
                                                                                
                                                                              </div>
                                                                              <button type="button" class="btn btn-info">Already
                                                                                 Rjected</button>
                                                                   
                                                                    <?php
                                                                          
                                                                      }
                                                                    
                                                                  ?>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal fade" id="shortTermModalSponsored_<?php echo $row['id'] ?>"
                                                        tabindex="-1" aria-labelledby="termModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content"
                                                                style="width:200%; margin:20px -100px">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="termModalLabel"> Short Sponsored
                                                                        Program
                                                                        Detail</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <?php //sprint_r($row); ?>
                                                                    <form>
                                                                        <div class="div">
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <div class="row">
                                                                                        <div class="col-md-6 text-left">
                                                                                            <label for="">Program Name:
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="col-md-6 text-left">
                                                                                            <?php echo $row['prg_name']?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="row">
                                                                                        <div class="col-md-6 text-left">
                                                                                            <label for="">Hall Name:
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="col-md-6 text-left">
                                                                                            <?php echo $row['hall_name']?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div><br>
                                                                            <div class="row">
                                                                              <div class="col-md-6">
                                                                                    <div class="row">
                                                                                        <div class="col-md-6 text-left">
                                                                                            <label for="">Department Name:
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="col-md-6 text-left">
                                                                                            <?php echo $row['dept_name']?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="row">
                                                                                        <div class="col-md-6 text-left">
                                                                                            <label for="">Department Email:
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="col-md-6 text-left">
                                                                                            <?php echo $row['dept_email']?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div><br>
                                                                            <div class="row">
                                                                              <div class="col-md-6">
                                                                                    <div class="row">
                                                                                        <div class="col-md-6 text-left">
                                                                                            <label for="">Tranning Start Date:
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="col-md-6 text-left">
                                                                                            <?php echo  date("d/m/Y", strtotime($row['start_date'])) ?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="row">
                                                                                        <div class="col-md-6 text-left">
                                                                                            <label for="">Tranning End Date:
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="col-md-6 text-left">
                                                                                            <?php echo date("d/m/Y", strtotime($row['end_date'])) ?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div><br>
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                <div class="row">
                                                                                    <div class="col-md-4 text-left">
                                                                                        <label for="">Select Course Coordinating Officer</label>
                                                                                        
                                                                                    </div>
                                                                                    <div class="col-md-5 text-left">
                                                                                        <select
                                                                                            class="custom-select mr-sm-2"
                                                                                            name="course_director"
                                                                                            id="course_co_officer_<?php echo $row['id'] ?>"
                                                                                            style="height: calc(1em + 0.75rem + 2px);padding:0px"
                                                                                            onchange="add_course_co(<?php echo $row['id'] ?>,<?php echo $row['course_co_officer'] ?>)"
                                                                                            >
                                                                                           

                                                                                            <option selected>
                                                                                                Select Officer
                                                                                            </option>
                                                                                            <?php 
                                                                  
                                                                   
                                                                                                        $db->select('tbl_faculty_master',"id,name",null,'role=1',null,null);
                                                                                                        // print_r( $db->getResult());
                                                                                                        foreach($db->getResult() as $row4){
                                                                                                            //print_r($row);
                                                                                                        
                                                                                                    ?>
                                                                                            <option
                                                                                                value="<?php echo $row4['id'] ?>"
                                                                                                <?php echo ($row4['id'] == $row['course_co_officer'])?'selected':'' ?>>
                                                                                                <?php echo $row4['name'] ?>
                                                                                            </option>

                                                                                            <?php 
                                                                                                        }
                                                                                                        ?>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="co_info"></div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-12"
                                                                                    style="border-radius: 5px;
                                                                                    margin-top:20px;
                                                                                    padding: 10px;
                                                                                    margin-bottom: 20px;
                                                                                    box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                                                                                    <div class="row justify-content-between ">
                                                                                        <label class="ml-2" 
                                                                                            style="background-color: #82b08d;
                                                                                            border-radius: 5px;
                                                                                            color: #320d0d;
                                                                                            padding: 5px;">
                                                                                            <strong>Email Draft</strong></label><br>
                                                                                            
                                                                                            <input type="button" class="btn btn-primary mr-2"  style="display: <?php echo ($row['mail_status']==1)?'none':''; ?>"  id="email_edit_<?php echo $row['id']?>" 
                                                                                                 onclick="edit_emai(<?php echo $row['id']?>)"  value="Edit"/>
                                                                                         <!-- <button class="btn btn-primary">Edit<button>        -->
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                                <label><strong>Email Subject</strong></label>
                                                                                                <input type="text" class="form-control" name="email_sub" class="email_sub"
                                                                                                    id="email_sub_<?php echo $row['id']?>" value="<?php echo $row['email_sub'] ?>" placeholder="Enter Email Subject" disabled>
                                                                                            </div>
                                                                                        </div>
                                                                                    
                                                                                    </div>
                                                                                    <div class="row">
                                                                                       <div class="col-md-8">
                                                                                            <div class="form-group">
                                                                                                <label><strong> Email content</strong></label>
                                                                                                <textarea class="form-control"
                                                                                                    name="email_content" id="email_content_<?php echo $row['id']?>"
                                                                                                    placeholder="Enter Email Content"
                                                                                                    style="border: 1px solid rgb(79 67 67);border-radius:5px; max-height: 250px;height: 150px;" disabled><?php echo  trim($row['email_content']) ?></textarea>
                                                                                                    
                                                                                                
                                                                                                <!-- <input type="text" class="form-control" name="email_sub"
                                                                                                    id="email_sub" placeholder="Enter Email Subject"> -->
                                                                                            </div>
                                                                                        </div>
                                                                                    </div> 
                                                                                    <input type="button" class="btn btn-success mr-2"  id="updt_btn_<?php echo $row['id']?>" onclick="update_email(<?php echo $row['id']?>)" value="Update" style="display:none"/>
                                                                                </div>
                                                                            </div>


                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <?php
                                                                   // echo $row['status'];
                                                                      switch ($row['status']) {
                                                                          case 'pendingAtDirector':
                                                                            ?>
                                                                    <button type="button" class="btn btn-info"> Already
                                                                        Approved</button>
                                                                    <?php
                                                                              break;
                                                                          case 'pendingAtIncharge':
                                                                            ?>
                                                                    <button type="button" class="btn btn-info mail_btn"
                                                                        onclick="send_mail(<?php echo $row['id'] ?>,'<?php echo $row['dept_email'] ?>','<?php echo $row['dept_name'] ?>')">Send Email</button>
                                                                        <div class="loader" >
                                                                            <img src="assets/img/loader.gif" alt="Loading" style="width: 300px;height: 90px;"/>
                                                                        </div>
                                                                    <button type="button" class="btn btn-danger ml-2"
                                                                        onclick="reject(<?php echo $row['id'] ?>,'Reject')">Reject</button>

                                                                    <?php
                                                                            break;
                                                                            case 'reject_by_incharge':
                                                                              ?>
                                                                              <div>
                                                                                <p><b> Reject Comment</b> :<span style="color:#6a0027 "><?php echo $row1['remark'] ?></span></p>
                                                                                
                                                                              </div>
                                                                              <button type="button" class="btn btn-info">Already
                                                                                 Rjected</button>
                                                                   
                                                                    <?php
                                                                          
                                                                      }
                                                                    
                                                                  ?>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>


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



    <!-- msgBox Modal Modal HTML -->
    <div id="cnfModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="m_title" style="text-align:center;"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="warning">
                            <p class="wrn_msg"></p>

                        </div>
                        <div id="m_body" style="display:none">
                            <div class="form-group">
                                <label> Remark : </label>
                                <textarea class="form-control cancel_comment" style="border: 1px solid black;"
                                    id="reject_comment" rows="3"></textarea>
                            </div>
                        </div>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                    </div>
                    <div class="modal-footer" id="m_footer">
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

function add_course_co(id,co_officer_id){
   
       let co_officer = $(`#course_co_officer_${id}`).val();
       var action;
      

        if(co_officer_id==0){
           action="add_short_co_officer";
        }else{
            action="update_short_co_officer";
        }
        console.log(action);
       $.ajax({
        type: "POST",
        url: "ajax_master.php",
        data: {

            action: action,
            id: id,
            co_officer: co_officer,
            co_officer_id:co_officer_id
        
        },
        success: function(res) {
            console.log(res);
            // if (res == "success") {
            //     sessionStorage.message = "Email Content Updated successfully";
            //     sessionStorage.type = "success";
            //     location.reload();
            // }
        }
      })
}

    function ViewModal(id,trng_type){
        if(trng_type == 4){
            $(`#prgram_list_${id}`).modal('show');
        }else{
            $(`#shortTermModalSponsored_${id}`).modal('show');
        }
    }

    function edit_emai(id){
       //console.log(123); 
        $(`#updt_btn_${id}`).show();
        $(`#email_edit_${id}`).hide();

        $(`#email_sub_${id}`).prop('disabled', false);
        $(`#email_content_${id}`).prop('disabled', false);
    }
    

    function update_email(id){

       let email_sub = $(`#email_sub_${id}`).val();
       let email_content = $(`#email_content_${id}`).val();
       
       $.ajax({
        type: "POST",
        url: "ajax_master.php",
        data: {

            action: "update_email_incharge",
            id: id,
            email_sub: email_sub,
            email_content: email_content,
            
        },
        success: function(res) {
            console.log(res);
            if (res == "success") {
                sessionStorage.message = "Email Content Updated successfully";
                sessionStorage.type = "success";
                location.reload();
            }
        }
      })
        
  
    }

    function send_mail(id,email,dept_name){ 

        let email_sub = $(`#email_sub_${id}`).val();
        let email_content = $(`#email_content_${id}`).val();

        $.ajax({
        type: "POST",
        url: "send_email_dept.php", 
        data: {

            id: id,
            email_sub: email_sub,
            email_content: email_content,
            dept_email:email,
            dept_name:dept_name,
            table : "tbl_short_program_master"
        },
        beforeSend: function(){
                  $('.loader').show();
                  $('.mail_btn').hide();
                //  $('#send_email').prop('disabled', true);
                },
        success: function(res) {
            console.log(res);
            if (res == "success") {
                sessionStorage.message = "Email send successfully";
                sessionStorage.type = "success";
                location.reload();
            }
        }
        })
        

        }

function approve(id, title) {

    $('#m_body').hide();
    $('#m_footer').html('');


    $('#m_title').html(`${title} Program`);
    $('.wrn_msg').html(`Are you sure you want to ${title} this Record?`);
    var html =
        `<input type="button" class="btn btn-success btn-dlt" value="Approve" 
         onclick="approve_record(${id},'tbl_short_program_master')" />`;
    $('#m_footer').append(html);
    $('#cnfModal').modal('show');
}

function reject(id, title) {
    $('#m_footer').html('');

    $('#m_title').html(`${title} Program`);
    $('.wrn_msg').html(`Hello Sir,Please Write Remark For  ${title} this Record?`);
    var html =
        `<input type="button" class="btn btn-danger btn-dlt" value="Reject" onclick="reject_record(${id},'tbl_program_master')" />`;
    $('#m_body').show();
    $('#m_footer').append(html);
    $('#cnfModal').modal('show');
}

function approve_record(id, tbl) {

    var provisonal_Sdate = $('#provisonal_Start_date').val();
    var provisonal_Edate = $('#provisonal_Edate').val();
   
   
    $.ajax({
        type: "POST",
        url: "ajax_master.php",
        data: {

            action: "approve_program_by_incharge",
            id: id,
            provisonal_Sdate: provisonal_Sdate,
            provisonal_Edate: provisonal_Edate,
            table: tbl
        },
        success: function(res) {
            console.log(res);
            if (res == "success") {
                sessionStorage.message = "Record Approve successfully";
                sessionStorage.type = "success";
                location.reload();
            }
        }
    })
}

function reject_record(id, tbl) {
    let msg = $('#reject_comment').val();
    $.ajax({
        type: "POST",
        url: "ajax_master.php",
        data: {

            action: "reject_program_by_incharge",
            id: id,
            msg: msg,
            table: tbl
        },
        success: function(res) {
            console.log(res);
            if (res == "success") {
                sessionStorage.message = "Record Reject successfully";
                sessionStorage.type = "success";
                 location.reload();
            }
        }
    })
}



function cnfBox(id) {
    //alert(id);
    $('#m_footer').empty();
    var html =
        `<input type="button" class="btn btn-danger btn-dlt" value="Delete" onclick="delete_record(${id},'tbl_program_master')" />`;
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

function sendToApprove(id, tbl) {

    $.ajax({
        type: "POST",
        url: "ajax_master.php",
        data: {

            action: "send_to_approve",
            id: id,
            table: tbl
        },
        success: function(res) {
            console.log(res);
            if (res == "success") {
                sessionStorage.message = " Successfully Send to Director for Approval";
                sessionStorage.type = "success";
                location.reload();
            }
        }
    })
}


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