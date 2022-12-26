<?php 


include 'database.php';
$db = new Database();

//  print_r($_POST);
// exit;

$session_date = $_POST['session_date'];
$prog_id = $_POST['prog_id'];
$session_no = $_POST['session_no'];
$time_table = $_POST['time_table'];
$trng_type = $_POST['trng_type'];

$flag = 0;
if($time_table == 'tbl_mid_time_table'){
    $flag = 1;
}

$select_session =  $db->select($time_table,"session_no",null,"training_dt = '".$session_date."' AND program_id = '".$prog_id."' ",null,null);
$select_session_res = $db->getResult() ;

if(empty($select_session_res)){
      $session_start_time = $_POST['start_time'];
      $session_end_time = date("H:i:s", strtotime($session_start_time)+60*60*1.25);
      $session_end_time = date("g:i A", strtotime($session_end_time));
    }
    else{
         $last_session_sql = "SELECT class_end_time  FROM $time_table WHERE session_no = (SELECT max(session_no) FROM $time_table WHERE  training_dt = '".$session_date."') 
         AND training_dt = '".$session_date."' AND program_id = '".$prog_id."' ";
         //echo $last_session_sql;
        $max_session =  $db->select_sql($last_session_sql);
        $max_session_res = $db->getResult() ;
        //print_r($max_session_res);
        foreach ($max_session_res as $session_time){
            $session_start_time = $session_time['class_end_time'] ;
        }
    
         $start_time=  date("H:i:s", strtotime($session_start_time)+60*60*1.25);
         $session_end_time = date("g:i A", strtotime($start_time));
    
    }   
     
      for($i=1;$i <= $session_no;$i++){

         $db->select($time_table,"*",null,"session_no = '".$i."'  AND training_dt = '".$session_date."' AND program_id = '".$prog_id."' ",null,null);
         $res = $db->getResult();
         //print_r($res);
         if($res)
         {
            foreach($res as $row){
                ?>
                    <form method="post" id="frm_timeTable_<?php echo $i ?>" class="session_frm"
                    style="background:#ffdeb533" >
                       
                        <div class="row">
                            
                            <div class="col-md-4">
                                <h4 style="background: #a17421;">Edit Session No - <?php echo $i; ?></h4>
                            </div>
                            <div class="col-md-5" >
                                <div id="alert_msg_<?php echo $i ?>" style="display:none" class="alert alert-success">Update Time Table Successfully</div>
                            </div>
                        </div>


                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Training Date</strong></label>

                                    <input type="date" class="form-control input-control" name="training_dt" id="training_dt"
                                        placeholder="Select Training Date" value=<?php echo $session_date ?>>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><strong> Period Type</strong></label>
                                    <select class="custom-select mr-sm-2 period_type input-control" name="period_type"
                                        id="<?php echo $i ?>">
                                        <option value="0">Select Period Type</option>
                                        <option value="1" <?php echo ($row['period_type']==1)?'selected':'' ?> > Session</option>
                                        <option value="2" <?php echo ($row['period_type']==2)?'selected':'' ?> > Break</option>
                                    </select>


                                </div>
                            </div>
                            <div class="col-md-3" id="break_fld_<?php echo $i ?>" style="display:<?php echo ($row['break_time']==0)?'none':'' ?>">
                                <div class="form-group">
                                    <label><strong> Break</strong></label>
                                    <select class="custom-select mr-sm-2 input-control" name="break_time" id="break_<?php echo $i ?>">

                                        <option value="0">Select Break</option>
                                        <option value="1" <?php echo ($row['break_time']==1)?'selected':'' ?>> Tea Break</option>
                                        <option value="2" <?php echo ($row['break_time']==2)?'selected':'' ?>> Lunch Break</option>

                                    </select>


                                </div>
                            </div>


                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong> Class Start Time</strong></label>
                                    <input type="text" class="form-control input-control class_start_time" id="class_start_time"
                                        name="class_start_time" value='<?php echo $row['class_start_time']; ?>' />
                                    <p id='start_time' style="display:none"></p>
                                    <span> <button type="button" id="verify_start" onclick="verify_class_time('start_time' )"
                                            class="btn btn-sm" style="background-color:#141664">Verify Class Time</button></span>

                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Class End Time</strong></label>
                                    <input type="text" class="form-control input-control class_end_time" name="class_end_time"
                                    value='<?php echo $row['class_end_time']; ?>' />
                                    <p id='end_time' style="display:none"></p>
                                    <span> <button type="button" id="verify_end" onclick="verify_class_time('end_time')" class="btn btn-sm"
                                            style="background-color:#141664">Verify Class Time</button></span>
                                </div>

                            </div>

                        </div>
                        <div id="class_time_<?php echo $i ?>" style="display:<?php echo ($row['break_time']!=0)?'none':'' ?>">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>Session Type</strong></label>
                                        <div class="form-check form-check-inline" style="margin-left: 20px;">
                                            <input class="form-check-input " type="radio" name="session_type" id="ClassRoom" value="1"
                                            <?php echo ($row['session_type']==1)?'checked':'' ?> >
                                            <label class="form-check-label" for="Inhouse" style="padding-left: 5px;">ClassRoom Study</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="session_type" id="other" value="2" 
                                            <?php echo ($row['session_type']==2)?'checked':'' ?> >
                                            <label class="form-check-label" for="Visiting" style="padding-left: 5px;">Other</label>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6 class_room" style="display: <?php echo ($row['session_type']==2)?'none':'' ?> ">
                                    <div class="form-group">
                                        <label><strong>Faculty Type</strong></label>
                                        <div class="form-check form-check-inline" style="margin-left: 20px;">
                                            <input class="form-check-input" type="radio" name="faculty" id="<?php echo $i ?>" value="1"
                                            <?php echo ($row['faculty_type']==1)?'checked':'' ?>>
                                            <label class="form-check-label" for="Inhouse" style="padding-left: 5px;">Inhouse Faculty</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="faculty" id="<?php echo $i ?>" value="2"
                                            <?php echo ($row['faculty_type']==2)?'checked':'' ?>>
                                            <label class="form-check-label" for="Visiting" style="padding-left: 5px;">Visiting
                                                Faculty</label>
                                        </div>

                                    </div>
                                    <select class="custom-select input-control mr-sm-6 faculty_id_div inhouse" name="faculty_id[]"
                                        multiple="multiple" id="faculty_id_<?php echo $i ?>" style="width:400px">
                                       
                                       <?php
                                      
                                         $db->select('tbl_faculty_master',"id,name",null,"role = ".$row['faculty_type'],null,null);
                                         $res1 = $db->getResult();
                                         
                                           echo '<option>Select Faculty</option>';
                                           foreach($res1 as $row1){
                                             ?>
                                              <option  value="<?php echo $row1['id'] ?>" <?php echo ($row['faculty_id']==$row1['id'])?'selected':'' ?>><?php echo $row1['name'] ?></option>
                                             <?php
                                           
                                            
                                             
                                           }
                                       
                                       ?>
                                    </select>
                                    <p class="faculty_msg text-danger"></p>
                                </div>

                                <div class="col-md-6 ">
                                    <div class="others"  style="display: <?php echo ($row['session_type']==1)?'none':'' ?> ">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><strong>Select Other
                                                            Class</strong></label>
                                                    <select class="custom-select mr-sm-2 input-control" name="other_class" id="other_class">
                                                        <option selected value="0">Select Other
                                                            Class</option>
                                                        <?php 
                                                                                            
                                                                                            $count = 0;
                                                                                            $db->select('other_topic',"*",null,null,null,null);
                                                                                            // print_r( $db->getResult());
                                                                                            foreach($db->getResult() as $row5){
                                                                                                //print_r($row);
                                                                                                $count++
                                                                                        ?>
                                                        <option value="<?php echo $row5['id'] ?>" <?php echo ($row['other_class']==$row5['id'])?'selected':'' ?>>
                                                            <?php echo $row5['name'] ?>
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
                                                    <textarea class="form-control input-control" name="class_remark" id="class_remark"
                                                        placeholder="Remark for Other Class" rows="3"
                                                        style="border: 1px solid #e3e3e3;border-radius:5px;"><?php echo $row['class_remark'] ?>  </textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><strong>No of Session</strong></label>
                                                    <input type="text" class="form-control input-control" placeholder="Enter No of Session"
                                                        name="no_of_session" id="no_of_session" value = <?php echo $row['no_of_session'] ?>>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <!-- class room -->
                               <div class="class_room" style="display: <?php echo ($row['session_type']==2)?'none':'' ?> ">
                                 <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><strong>Term</strong></label>
                                            <select class="custom-select mr-sm-2" name="term_id" class="term_id_<?php echo $i ?>" id="<?php echo $i ?>">
                                                <option selected value="0">Select Term</option>
                                                <?php 
                                                                                        $db = new Database();
                                                                                        $count = 0;
                                                                                        $term_sql = "SELECT id,term FROM `tbl_term_master` WHERE syllabus_id = (SELECT syllabus_id FROM `tbl_program_master` WHERE id = '$prog_id')";
                                                                                        $db->select_sql($term_sql);
                                                                                        // print_r( $db->getResult());
                                                                                        foreach($db->getResult() as $row2){
                                                                                            //print_r($row);
                                                                                            $count++
                                                                                        ?>
                                                <option value="<?php echo $row2['id'] ?>" <?php echo ($row['term_id']==$row2['id'])?'selected':'' ?>>
                                                    <?php echo $row2['term'] ?>
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
                                            <select class="custom-select mr-sm-2" name="paper_id"  id="paper_id_<?php echo $i ?>">
                                                <option selected value="0">Select Paper</option>
                                                <?php 
                                                                                        $db = new Database();
                                                                                      
                                                                                        $paper_sql = "SELECT * FROM `tbl_paper_master` WHERE term_id =".$row['term_id'];
                                                                                        $db->select_sql($paper_sql);
                                                                                        // print_r( $db->getResult());
                                                                                        foreach($db->getResult() as $row3){
                                                                                            //print_r($row);
                                                                                           
                                                                                        ?>
                                                <option value="<?php echo $row3['id'] ?>" <?php echo ($row['paper_id']==$row3['id'])?'selected':'' ?>>
                                                    <?php echo $row3['title'].'-'.$row3['paper_code']; ?>
                                                </option>

                                                <?php 
                                                                            }
                                                                            ?>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <!-- <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label><strong>Sub-Topic </strong></label>
                                                                                    <select class="custom-select mr-sm-2" id="subject_id"
                                                                                        name="subject_id">
                                                                                        <option selected value="0">Select Sub-Topic
                                                                                        </option>

                                                                                    </select>
                                                                                </div>
                                                                            </div> -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><strong> Topic</strong></label>
                                            <textarea class="form-control input-control" name="paper_covered"
                                        id="paperCovered_<?php echo $i ?>" placeholder="Enter Topic" rows="3"
                                        style="border: 1px solid #e3e3e3;border-radius:5px;background-color: #fff;"><?php echo trim($row['paper_covered']) ?></textarea>
                                   
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                       

                        <div class="row">
                            <div class="col-md-12">
                                <div class="btn btn-primary float-right" onclick="addSession(<?php echo $i ?>,<?php echo $trng_type ?>,showMsg)">Update</div>
                            </div>
                        </div>
                        

                        <!-- end class room -->
                        <input type="hidden" name="trng_type" value="<?php echo $trng_type ?>">
                        <input type="hidden" name="session_no" value="<?php echo $i ?>">
                        <input type="hidden"  id="update_id_<?php echo $i ?>" value="<?php echo $row['id'] ?>">
                    </form>
             <?php
             }
         }
         else{
            ?>

            <form method="post" id="frm_timeTable_<?php echo $i ?>" class="session_frm">
                <input type="hidden" name="program_id" value="<?php echo $_POST['prog_id'] ?>" />
                <input type="hidden" name="table_range_id" value="<?php echo $_POST['tt_range_id'] ?>" />
                <div class="row">
                    <div class="col-md-4">
                       <h4>Add Session No - <?php echo $i; ?></h4>
                    </div>

                    <div class="col-md-4">
                        <div id="alert_msg_<?php echo $i ?>"  style="display:none"  class="alert alert-success">Added Time Table Successfully</div>
                    </div>
                </div>


                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><strong>Training Date</strong></label>

                            <input type="date" class="form-control input-control" name="training_dt" id="training_dt"
                                placeholder="Select Training Date" value=<?php echo $session_date ?>>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><strong> Period Type</strong></label>
                            <select class="custom-select mr-sm-2 period_type input-control" name="period_type"
                                id="<?php echo $i ?>">
                                <option value="0">Select Period Type</option>
                                <option value="1" selected> Session</option>
                                <option value="2"> Break</option>
                            </select>


                        </div>
                    </div>
                    <div class="col-md-3" id="break_fld_<?php echo $i ?>" style="display:none">
                        <div class="form-group">
                            <label><strong> Break</strong></label>
                            <select class="custom-select mr-sm-2 input-control" name="break" id="break_<?php echo $i ?>">

                                <option value="0">Select Break</option>
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
                            <input type="text" class="form-control input-control class_start_time_<?php echo $i ?>" id="class_start_time"
                                name="class_start_time" value='<?php echo $session_start_time; ?>' />
                            <p id='start_time' style="display:none"></p>
                            <span> <button type="button" id="verify_start" onclick="verify_class_time('start_time' )"
                                    class="btn btn-sm" style="background-color:#141664">Verify Class Time</button></span>

                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><strong>Class End Time</strong></label>
                            <input type="text" class="form-control input-control class_end_time_<?php echo $i ?>" name="class_end_time"
                                value="<?php echo $session_end_time; ?>" />
                            <p id='end_time' style="display:none"></p>
                            <span> <button type="button" id="verify_end" onclick="verify_class_time('end_time')" class="btn btn-sm"
                                    style="background-color:#141664">Verify Class Time</button></span>
                        </div>

                    </div>

                </div>
                <div id="class_time_<?php echo $i ?>">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Session Type</strong></label>
                                <div class="form-check form-check-inline" style="margin-left: 20px;">
                                    <input class="form-check-input " type="radio" name="session_type" id="ClassRoom" value="1"
                                        checked>
                                    <label class="form-check-label" for="Inhouse" style="padding-left: 5px;">ClassRoom Study</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="session_type" id="other" value="2">
                                    <label class="form-check-label" for="Visiting" style="padding-left: 5px;">Other</label>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 class_room" >
                            <div class="form-group">
                                <label><strong>Faculty Type</strong></label>
                                <div class="form-check form-check-inline" style="margin-left: 20px;">
                                    <input class="form-check-input" type="radio" name="faculty" id="<?php echo $i ?>" value="1">
                                    <label class="form-check-label" for="Inhouse" style="padding-left: 5px;">Inhouse Faculty</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="faculty" id="<?php echo $i ?>" value="2">
                                    <label class="form-check-label" for="Visiting" style="padding-left: 5px;">Visiting
                                        Faculty</label>
                                </div>

                            </div>
                            <select class="custom-select input-control mr-sm-6 faculty_id_div inhouse" name="faculty_id[]"
                                multiple="multiple" id="faculty_id_<?php echo $i ?>" style="width:400px">
                                <option selected value="0">Select Faculty</option>

                            </select>
                            <p class="faculty_msg text-danger"></p>
                        </div>

                        <div class="col-md-6 ">
                            <div class="others" style="display:none">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><strong>Select Other
                                                    Class</strong></label>
                                            <select class="custom-select mr-sm-2 input-control" name="other_class" id="other_class">
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
                                            <textarea class="form-control input-control" name="class_remark" id="class_remark"
                                                placeholder="Remark for Other Class" rows="3"
                                                style="border: 1px solid #e3e3e3;border-radius:5px;"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><strong>No of Session</strong></label>
                                            <input type="text" class="form-control input-control" placeholder="Enter No of Session"
                                                name="no_of_session" id="no_of_session">
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
                                            <select class="custom-select mr-sm-2" name="term_id" class="term_id_<?php echo $i ?>" id="<?php echo $i ?>">
                                                <option selected value="0">Select Term</option>
                                                <?php 
                                                                                        $db = new Database();
                                                                                        $count = 0;
                                                                                        $term_sql = "SELECT id,term FROM `tbl_term_master` WHERE syllabus_id = (SELECT syllabus_id FROM `tbl_program_master` WHERE id = '$prog_id')";
                                                                                        $db->select_sql($term_sql);
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
                                            <select class="custom-select mr-sm-2" name="paper_id" id="paper_id_<?php echo $i ?>">
                                                <option selected value="0">Select Paper</option>

                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <!-- <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label><strong>Sub-Topic </strong></label>
                                                                                    <select class="custom-select mr-sm-2" id="subject_id"
                                                                                        name="subject_id">
                                                                                        <option selected value="0">Select Sub-Topic
                                                                                        </option>

                                                                                    </select>
                                                                                </div>
                                                                            </div> -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><strong> Topic</strong></label>
                                            <textarea class="form-control" name="paper_covered" id="paper_covered"
                                                placeholder="Enter Related Topic" rows="3"
                                                style="border: 1px solid #e3e3e3;border-radius:5px;background-color: #fff;"></textarea>
                                        </div>
                                    </div>
                                </div>
                    
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn btn-primary float-right" onclick="addSession(<?php echo $i ?>,<?php echo $trng_type ?>,showMsg)">Save</div>
                    </div>
                </div>
                <!-- end class room -->
                <input type="hidden" name="trng_type" value="<?php echo $trng_type ?>">
                <input type="hidden" name="session_no" value="<?php echo $i ?>">
                <input type="hidden"  id="update_id_<?php echo $i ?>">
            </form>

<?php
         }
         
           
      }



?>

<script>
    $('select[name="term_id"]').on('change', function(){
        let id = $(this).attr('id');
        var term_id = $(this).val();
          
        
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
                    $('#paper_id_'+id).html(res);
                }
            })
    })

    //  $('#term_id').on('click', function() {
    //         var term_id = $(this).val();
    //         // alert(term_id);

    //         $.ajax({
    //             type: "POST",
    //             url: "ajax_timetable.php",

    //             data: {
    //                 term_id: term_id,
    //                 table: "tbl_paper_master",
    //                 action: "select_paper"
    //             },
    //             success: function(res) {
    //                 console.log(res);
    //                 $('#paper_id').html(res);
    //             }
    //         })

    //     })
</script>