<?php

//print_r($_POST);

include 'database.php';
$db = new Database();

$session_date = $_POST['session_date'];
$prog_id = $_POST['prog_id'];
$prog_name = $_POST['prog_name'];

$today_dt = date("Y-m-d");

if ($session_date < $today_dt) {
    echo "error^Can not add session for past date";
    exit;
}

$select_session =  $db->select('tbl_sponsored_time_table', "session_no", null, "training_dt = '" . $session_date . "' AND program_id = '" . $prog_id . "' ", null, null);
$select_session_res = $db->getResult();

if (empty($select_session_res)) {
    $session_start_time = "10:15 AM";
    $session_end_time = "11:45 AM";
} else {
    $last_session_sql = "SELECT class_end_time  FROM tbl_sponsored_time_table WHERE session_no = (SELECT max(session_no) FROM tbl_sponsored_time_table WHERE  training_dt = '" . $session_date . "') 
     AND training_dt = '" . $session_date . "' AND program_id = '" . $prog_id . "' ";
    //echo $last_session_sql;
    $max_session =  $db->select_sql($last_session_sql);
    $max_session_res = $db->getResult();
    //print_r($max_session_res);
    foreach ($max_session_res as $session_time) {
        $session_start_time = $session_time['class_end_time'];
    }

    $start_time =  date("H:i:s", strtotime($session_start_time) + 60 * 60 * 1.25);
    $session_end_time = date("g:i A", strtotime($start_time));

    //echo $session_end_time;

}



?>
<form method="post" id="frm_timeTable">


    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label><strong>Training Date</strong></label>

                <input type="date" class="form-control" name="training_dt" id="training_dt" placeholder="Select Training Date" value=<?php echo $session_date ?>>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label><strong> Period Type</strong></label>
                <select class="custom-select mr-sm-2" name="period_type" id="period_type">
                    <option value="0">Select Period Type</option>
                    <option value="1"> Session</option>
                    <option value="2"> Break</option>
                </select>


            </div>
        </div>
        <div class="col-md-3" id="break_fld" style="display:none">
            <div class="form-group">
                <label><strong> Break</strong></label>
                <select class="custom-select mr-sm-2" name="break_time" id="break">

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
                <input type="text" class="form-control class_start_time" id="class_start_time" name="class_start_time" value='<?php echo $session_start_time; ?>' />
                <p id='start_time' style="display:none"></p>
                <span> <button type="button" id="verify_start" onclick="verify_class_time('start_time' )" class="btn btn-sm" style="background-color:#141664">Verify Class Time</button></span>

            </div>

        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label><strong>Class End Time</strong></label>
                <input type="text" class="form-control class_end_time" name="class_end_time" value="<?php echo $session_end_time; ?>" />
                <p id='end_time' style="display:none"></p>
                <span> <button type="button" id="verify_end" onclick="verify_class_time('end_time')" class="btn btn-sm" style="background-color:#141664">Verify Class Time</button></span>
            </div>

        </div>

    </div>
    <div id="class_time">
        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>Session Type</strong></label>
                    <div class="form-check form-check-inline" style="margin-left: 20px;">
                        <input class="form-check-input" type="radio" name="session_type" id="ClassRoom" value="1" checked>
                        <label class="form-check-label" for="Inhouse" style="padding-left: 5px;">ClassRoom Study</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="session_type" id="other" value="2">
                        <label class="form-check-label" for="Visiting" style="padding-left: 5px;">Other</label>
                    </div>

                </div>
            </div>
            <div class="col-md-6 class_room">
                <div class="form-group">
                    <label><strong>Faculty Name</strong></label>
                    <input type="text" class="form-control " name="faculty_name" id="faculty_name" placeholder="Faculty Name" />

                </div>

            </div>

            <div class="col-md-6 ">
                <div class="others" style="display:none">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Select Other
                                        Class</strong></label>
                                <select class="custom-select mr-sm-2" name="other_class" id="other_class">
                                    <option selected value="0">Select Other
                                        Class</option>
                                    <?php

                                    $count = 0;
                                    $db->select('other_topic', "*", null, null, null, null);
                                    // print_r( $db->getResult());
                                    foreach ($db->getResult() as $row) {
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
                                <textarea class="form-control" name="class_remark" id="class_remark" placeholder="Remark for Other Class" rows="3" style="border: 1px solid #e3e3e3;border-radius:5px;"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>No of Sessio</strong></label>
                                <input type="text" class="form-control" placeholder="Enter No of Session" name="no_of_session" id="no_of_session">
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <!-- class room -->
        <div class="class_room">

            <div class="row">
                <div class="col-md-6" id="gf_name" style="display: none">

                </div>

                <div class="col-md-6" id="other_subject">
                    <div class="form-group">
                        <label><strong>Subject</strong></label>
                        <textarea class="form-control" name="paper_covered" id="paper_covered" placeholder="Enter Other Subject" rows="3" style="border: 1px solid #e3e3e3;border-radius:5px;"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end class room -->
    <input type="hidden" name="program_id" value="<?php echo $_POST['id'] ?>">
    <input type="hidden" id="update_id" value="">
</form>