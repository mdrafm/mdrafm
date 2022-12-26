<div class="sidebar" data-color="blue">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->

    <div class="logo">
        <a href="#" class="simple-text logo-mini">
            <img src="../images/logo-Copy.png" alt="logo" style="margin-top: -10px;" />
        </a>

        <a href="#" class="simple-text logo-normal">
            MDRAFM
        </a>

    </div>

    <div class="sidebar-wrapper" id="sidebar-wrapper">

        <ul class="nav">

            <li class="active ">
                <a href="dashboard.php">

                    <i class="now-ui-icons design_app"></i>

                    <p>Faculty</p>
                </a>
            </li>
            <?php
                // print_r($_SESSION);
               if($_SESSION['username'] == "admin" || $_SESSION['username'] == "admin2" || $_SESSION['username'] == "admin3"  ){
                 ?>
            <!-- master start -->
            <li>

                <a data-toggle="collapse" href="#master">

                    <i class="now-ui-icons users_single-02"></i>

                    <p>
                        Syllabus & Courses <b class="caret"></b>
                    </p>
                </a>

                <div class="collapse " id="master" style="margin-left: 35px;">
                    <ul class="nav">
                        <li>
                            <a href="tranning_type.php">
                                <span class="sidebar-normal">Tranning Type</span>
                            </a>
                        </li>
                        <li>
                            <a href="syllabus.php">
                                <span class="sidebar-normal">Syllabus Master</span>
                            </a>
                        </li>

                        <li>
                            <a href="term_master.php">
                                <span class="sidebar-normal">Term Master</span>
                            </a>
                        </li>
                        <li>
                            <a href="paper_master.php">
                                <span class="sidebar-normal">Paper Master</span>
                            </a>
                        </li>
                        <li>
                            <a href="detail_syllabus_master.php">
                                <span class="sidebar-normal">Detail Syllabus Master</span>
                            </a>
                        </li>
                        <li>
                            <a href="field_visit.php">
                                <span class="sidebar-normal">Field Visit</span>
                            </a>
                        </li>
                        <li>
                            <a href="subject_master.php">
                                <span class="sidebar-normal">Subject Master</span>
                            </a>
                        </li>
                        <li>
                            <a href="topic_master.php">
                                <span class="sidebar-normal">Topic Master</span>
                            </a>
                        </li>

                        <li>
                            <a href="detail_topic_master.php">
                                <span class="sidebar-normal">Detail Topic Master</span>
                            </a>
                        </li>

                        <li>
                            <a href="mid_term_paper_master.php">
                                <span class="sidebar-normal"> Medium Term Paper Master</span>
                            </a>
                        </li>
                        <li>
                            <a href="mid_term_syllabus.php">
                                <span class="sidebar-normal"> Medium Term Syllabus Master</span>
                            </a>
                        </li>

                        <li>
                            <a href="syllabus_view.php">

                                <span class="sidebar-normal"> View Syllabus </span>
                            </a>
                        </li>
                        <li>
                            <a href="course_index.php">

                                <span class="sidebar-normal"> Course Index </span>
                            </a>
                        </li>

                        <!-- <li >
                            <a href="tranning_calendar.php">
                            
                            <span class="sidebar-normal">Tranning Calendar</span>
                            </a>
                         </li> -->

                    </ul>
                </div>


            </li>



            <!-- master end -->

            <!-- Time table -->
            <li>
                <a data-toggle="collapse" href="#timeTable">

                    <i class="now-ui-icons users_single-02"></i>

                    <p>
                        Time Table <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="timeTable" style="margin-left: 35px;">
                    <ul class="nav">
                        <li>
                            <a href="time_table.php">
                                <span class="sidebar-normal">Long Term </span>
                            </a>
                            <a href="mid_time_table.php">
                                <span class="sidebar-normal">Medium Term </span>
                            </a>
                            <a href="short_time_table.php">
                                <span class="sidebar-normal">Short Term </span>
                            </a>

                        <li>
                    </ul>
                </div>

            </li>
            <!-- End time table -->
            <!-- faculty master -->
            <li>
                <a data-toggle="collapse" href="#faculty">

                    <i class="now-ui-icons users_single-02"></i>

                    <p>
                        Faculty Master<b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="faculty" style="margin-left: 35px;">
                    <ul class="nav">
                        <li>
                            <a href="inHouseFaculty.php">
                                <span class="sidebar-normal">Inhouse Faculty </span>
                            </a>
                            <a data-toggle="collapse" href="#guest_faculty">
                                <p>
                                    Guest Faculty<b class="caret"></b>
                                </p>

                            </a>
                            <div class="collapse " id="guest_faculty" style="margin-left: 35px;">
                                <ul class="nav">
                                    <li>
                                        <a href="guest_faculty_info.php">
                                            <span class="sidebar-normal">Faculty Master</span>
                                        </a>
                                        <a href="guest_faculty_paper.php">
                                            <span class="sidebar-normal">Paper Master</span>
                                        </a>
                                        <a href="guest_faculty_subject.php">
                                            <span class="sidebar-normal">Subject Master</span>
                                        </a>
                                        <a href="assign_subjecToFaculty.php">
                                            <span class="sidebar-normal">assign Subject to faculty</span>
                                        </a>
                                        <a href="view_guest_faculty.php">
                                            <span class="sidebar-normal">View</span>
                                        </a>

                                    </li>
                                </ul>
                            </div>

                        <li>
                    </ul>
                </div>

            </li>
            <li>
                <a href="manage_user.php">

                    <i class="now-ui-icons users_single-02"></i>

                    <p>
                        Manage User
                    </p>
                </a>
            </li>
            <!-- faculty master -->
            <?php
               }
           
           ?>

            <?php
                    
                    if($_SESSION['username'] == "mdrafm_fin" ){
                 ?>
            <!-- Form 1 process -->
            <li>

                <a data-toggle="collapse" href="#form1">

                    <i class="now-ui-icons users_single-02"></i>

                    <p>
                       Trainee Registration<b class="caret"></b>
                    </p>
                </a>

                <div class="collapse " id="form1" style="margin-left: 35px;">
                    <ul class="nav">
                        <li>
                            <a href="new_batch.php">
                                <!-- <span class="sidebar-mini-icon">NF</span> -->
                                <span class="sidebar-normal"> Batch </span>
                            </a>
                        </li>

                        <!-- <li>
                            <a href="new_form_one.php">
                               
                                <span class="sidebar-normal"> Newly Recruited </span>
                            </a>
                        </li> -->

                    </ul>
                </div>

            </li>

            <!-- end Form 1 process -->
            <?php } ?>

            <?php
                    
                    if( $_SESSION['username'] == "prog_sec" ){
                 ?>
            <li>

                <a data-toggle="collapse" href="#Program">

                    <i class="now-ui-icons users_single-02"></i>

                    <p>
                        Tranning Program <b class="caret"></b>
                    </p>
                </a>

                <div class="collapse " id="Program" style="margin-left: 35px;">
                    <ul class="nav">

                        <li>
                            <a href="program_master.php">
                                <!-- <span class="sidebar-mini-icon">FL</span> -->
                                <span class="sidebar-normal">Long Term Program</span>
                            </a>
                        </li>
                        <li>
                            <a href="mid_term_program.php">
                                <!-- <span class="sidebar-mini-icon">FL</span> -->
                                <span class="sidebar-normal">Mid Term Program</span>
                            </a>
                        </li>
                        <li>
                            <a href="short_term_program.php">
                                <!-- <span class="sidebar-mini-icon">FL</span> -->
                                <span class="sidebar-normal">Short Term Program</span>
                            </a>
                        </li>



                    </ul>
                </div>

            </li>
            <li>

                <a data-toggle="collapse" href="#tranning">

                    <i class="now-ui-icons users_single-02"></i>

                    <p>
                        tranning <b class="caret"></b>
                    </p>
                </a>

                <div class="collapse " id="tranning" style="margin-left: 35px;">
                    <ul class="nav">

                        <li>
                            <a href="new_recruit_list.php">
                                <span class="sidebar-normal"> Newly Recruited List </span>
                            </a>
                        </li>
                        <li>
                            <a href="e-mail_document.php">
                                <span class="sidebar-normal"> Upload Documents for e-mail </span>
                            </a>
                        </li>
                        <li>
                            <a href="initiate_trng_program.php">
                                <span class="sidebar-normal"> Initiate Training Program </span>
                            </a>
                        </li>

                    </ul>
                </div>

            </li>

            <li>
                <a data-toggle="collapse" href="#timeTable">

                    <i class="now-ui-icons users_single-02"></i>

                    <p>
                        Time Table <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="timeTable" style="margin-left: 35px;">
                    <ul class="nav">
                        <li>
                            <a href="time_table.php">

                                <span class="sidebar-normal">Long Term </span>
                            </a>
                            <a href="mid_time_table.php">

                                <span class="sidebar-normal">Medium Term </span>
                            </a>
                            <a href="short_time_table.php">

                                <span class="sidebar-normal">Short Term </span>
                            </a>

                        <li>
                    </ul>
                </div>

            </li>
            <li>
                <a data-toggle="collapse" href="#content">

                    <i class="now-ui-icons users_single-02"></i>

                    <p>
                        Content Master <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="content" style="margin-left: 35px;">
                    <ul class="nav">
                        <li>
                            <a href="otherProgram.php">

                                <span class="sidebar-normal">Ongoing Program</span>
                            </a>
                            <a href="news.php">

                                <span class="sidebar-normal">News </span>
                            </a>
                            <a href="notification_master.php">

                                <span class="sidebar-normal">Notification </span>
                            </a>
                            <a href="otherEvents_master.php">

                                <span class="sidebar-normal"> Other Events </span>
                            </a>

                        <li>
                    </ul>
                </div>

            </li>

            <li>
                <a href="faculty_wise_class_list.php">
                    <i class="now-ui-icons users_single-02"></i>
                    <span class="sidebar-normal">Faculty Wise Classes </span>
                </a>
            </li>

            <?php } ?>

            <?php
                    
                    if( $_SESSION['username'] == "tranning_incharge" ){
                        ?>

            <?php
                    }
            ?>

            <?php
                    
                    if( $_SESSION['username'] == "director" ){
                 ?>
            <li>

                <a data-toggle="collapse" href="#Program">

                    <i class="now-ui-icons users_single-02"></i>

                    <p>
                        Tranning Program <b class="caret"></b>
                    </p>
                </a>

                <div class="collapse " id="Program" style="margin-left: 35px;">
                    <ul class="nav">

                        <li>
                            <a href="program_list.php">
                                <!-- <span class="sidebar-mini-icon">FL</span> -->
                                <span class="sidebar-normal">Long Program List</span>
                            </a>
                        </li>
                        <li>
                            <a href="mid_program_list.php">
                                <!-- <span class="sidebar-mini-icon">FL</span> -->
                                <span class="sidebar-normal">Medium Program List</span>
                            </a>
                        </li>
                        <li>
                            <a href="short_program_list.php">
                                <!-- <span class="sidebar-mini-icon">FL</span> -->
                                <span class="sidebar-normal">Short Program List</span>
                            </a>
                        </li>



                    </ul>
                </div>

            </li>

            <li>
                <a data-toggle="collapse" href="#timeTable">

                    <i class="now-ui-icons users_single-02"></i>

                    <p>
                        Time Table <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="timeTable" style="margin-left: 35px;">
                    <ul class="nav">
                        <li>
                            <a href="long_time_table_review.php">

                                <span class="sidebar-normal">Long Term </span>
                            </a>
                            <a href="mid_time_table_review.php">

                                <span class="sidebar-normal">Medium Term </span>
                            </a>
                            <a href="short_time_table_review.php">

                                <span class="sidebar-normal">Short Term </span>
                            </a>
                            <a href="approveModified_TimeTable.php">

                                <span class="sidebar-normal">Revised Time Table </span>
                            </a>
                        <li>
                    </ul>
                </div>

            </li>


            <?php } ?>



            <?php
                    //print_r( $_SESSION['roll_id']);
                    $roll_id = explode(',',$_SESSION['roll_id']);
                    foreach($roll_id as $roll){
                        //print_r($roll);
                        echo '<br>';
                        switch ($roll) {
                            case '8':
                                
                               ?>
            <li>

                <a data-toggle="collapse" href="#Program">

                    <i class="now-ui-icons users_single-02"></i>

                    <p>
                        Tranning Program <b class="caret"></b>
                    </p>
                </a>

                <div class="collapse " id="Program" style="margin-left: 35px;">
                    <ul class="nav">

                        <li>
                            <a href="cd_program_list.php">
                                <!-- <span class="sidebar-mini-icon">FL</span> -->
                                <span class="sidebar-normal">Program List</span>
                            </a>
                        </li>



                    </ul>
                </div>

                <a data-toggle="collapse" href="#approval">

                    <i class="now-ui-icons users_single-02"></i>

                    <p>
                        Time table Approval <b class="caret"></b>
                    </p>
                </a>

                <div class="collapse " id="approval" style="margin-left: 35px;">
                    <ul class="nav">

                        <li>
                            <a href="courseDir_timeTable.php">

                                <span class="sidebar-normal"> Time Table </span>
                            </a>
                        </li>
                        <li>
                            <a href="modify_time_table.php">

                                <span class="sidebar-normal">Modify Time Table </span>
                            </a>
                        </li>

                    </ul>
                </div>
                <a href="trainee_feedBack.php">

                    <i class="now-ui-icons users_single-02"></i>

                    <p>
                        Trainee Feedback
                    </p>
                </a>

                <!-- <a href="faculty_attendance.php">

                    <i class="now-ui-icons users_single-02"></i>

                    <p>
                        Faculty Attendance
                    </p>
                </a> -->

                <a data-toggle="collapse" href="#attendance_co">

                    <i class="now-ui-icons users_single-02"></i>

                    <p>
                        Attendance <b class="caret"></b>
                    </p>
                </a>

                <div class="collapse " id="attendance_co" style="margin-left: 15px;">
                    <ul class="nav">

                        <li>
                            <a href="faculty_attendance.php">
                                <i class="now-ui-icons users_single-02"></i>
                                <span class="sidebar-normal"> Take Attendance </span>
                            </a>
                        </li>
                        <li>
                            <a href="view_attendance.php">
                                <i class="now-ui-icons users_single-02"></i>
                                <span class="sidebar-normal"> View Attendance </span>
                            </a>
                        </li>


                    </ul>
                </div>

            </li>
            <?php
                                break;
                                
                            case '9':
                                ?>
            <li>

                <a data-toggle="collapse" href="#attendance">

                    <i class="now-ui-icons users_single-02"></i>

                    <p>
                        Attendance <b class="caret"></b>
                    </p>
                </a>

                <div class="collapse " id="attendance" style="margin-left: 35px;">
                    <ul class="nav">

                        <li>
                            <a href="attendance.php">
                                <!-- <span class="sidebar-mini-icon">NF</span> -->
                                <span class="sidebar-normal"> Take Attendance </span>
                            </a>
                        </li>


                    </ul>
                </div>

            </li>
            <?php
                                break;

                            case '4':

                             $sql = "SELECT program_id,trng_type FROM `tbl_dept_trainee_registration` WHERE phone= '".$_SESSION['username']."'
                                     UNION SELECT program_id,trng_type FROM `tbl_new_recruite` WHERE phone='".$_SESSION['username']."'
                                     UNION SELECT program_id,trng_type FROM `tbl_mid_trainee_registration` WHERE phone='".$_SESSION['username']."' ";
                                     //echo $sql;

                                  $db->select_sql($sql);
                                  $prog_id = 0;
                                  $trng_type = 0;
                               // $db->select("tbl_dept_trainee_registration","program_id",null,"phone = ",null,null);
                                 $res = $db->getResult();
                                 foreach($res as $row){
                                    //print_r($row);
                                    $prog_id = $row['program_id'];
                                    $trng_type = $row['trng_type'];
                                 }

                                 switch ($trng_type) {
                                    case '1':
                                        ?>
                                            <li>

                                                <li>
                                                    <a href="new_form_one.php">
                                                        <span class="sidebar-normal" style="color:#fff"> Registration </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="form_one_view.php">
                                                        <span class="sidebar-normal" style="color:#fff"> View Details </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="view_tranning_doc.php">
                                                        <span class="sidebar-normal" style="color:#fff"> View Tranning Documents </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="cls_feedback.php">
                                                        <span class="sidebar-normal" style="color:#fff">Feedback</span>
                                                    </a>
                                                </li>

                                            </li>
                                        <?php
                                        break;
                                    case '5':
                                        ?>
                                            <li>

                                                
                                                <li>
                                                    <a href="view_sponsored_tranning_doc.php">
                                                        <span class="sidebar-normal" style="color:#fff"> View Tranning Documents </span>
                                                    </a>
                                                </li>
                                                
                                                <!-- <li>
                                                    <a href="view_tranning_doc.php">
                                                        <span class="sidebar-normal" style="color:#fff"> Time Table </span>
                                                    </a>
                                                </li> -->
                                                <!-- <li>
                                                    <a href="cls_feedback.php">
                                                        <span class="sidebar-normal" style="color:#fff">Feedback</span>
                                                    </a>
                                                </li> -->

                                            </li>                                          
                                        <?php
                                    default:
                                        # code...
                                        break;
                                 }
                               ?>

            <?php
                                break;
                            case '10':
                                ?>
            <li>

                <a data-toggle="collapse" href="#Program">

                    <i class="now-ui-icons users_single-02"></i>

                    <p>
                        Tranning Program <b class="caret"></b>
                    </p>
                </a>

                <div class="collapse " id="Program" style="margin-left: 35px;">
                    <ul class="nav">

                        <li>
                            <a href="incharge_program_list.php">
                                <!-- <span class="sidebar-mini-icon">FL</span> -->
                                <span class="sidebar-normal">Long Program List</span>
                            </a>
                        </li>
                        <li>
                            <a href="incharge_mid_program_list.php">
                                <!-- <span class="sidebar-mini-icon">FL</span> -->
                                <span class="sidebar-normal">Medium Program List</span>
                            </a>
                        </li>
                        <li>
                            <a href="incharge_short_program_list.php" class="program_list">
                                <!-- <span class="sidebar-mini-icon">FL</span> -->
                                <span class="sidebar-normal">Short Program List</span>
                            </a>
                        </li>



                    </ul>
                </div>

            </li>
            <li>
                <a href="close_program.php">
                    <i class="now-ui-icons users_single-02"></i>
                    <span class="sidebar-normal">Close Program </span>
                </a>
            </li>
            <?php
                          break;
                          case '12':
                            ?>
            <li class="active ">
                <hr style="width: 90%;border-top: 2px solid rgb(135 167 169);">
                <a href="dashboard.php">

                    <i class="now-ui-icons design_app"></i>

                    <p>CoOrdinating Officer</p>
                </a>

            </li>
            <li>


                <a data-toggle="collapse" href="#regist">

                    <i class="now-ui-icons users_single-02"></i>

                    <p>
                        Registration <b class="caret"></b>
                    </p>
                </a>

                <div class="collapse " id="regist" style="margin-left: 35px;">
                    <ul class="nav">

                        <li>
                            <a href="assign_programs.php">

                                <span class="sidebar-normal">Assign Programs </span>
                            </a>
                        </li>


                    </ul>
                </div>
            <li>
                <a href="sponsored_co_time_table.php">
                    <i class="now-ui-icons users_single-02"></i>
                    <span class="sidebar-normal">Time Table </span>
                </a>
            </li>

            </li>
            <?php
                            default:
                                # code...
                                break;
                        }
                    }
                    if( $_SESSION['roll_id'] == "8" ){
                 ?>

            <?php } ?>

            <?php
                    //print_r($_SESSION);
                    if($_SESSION['roll_id'] == "10" ){
                 ?>


            <?php } ?>

            <!-- user registration -->
            <?php
                    //print_r($_SESSION);
                    if($_SESSION['roll_id'] == "11" ){
                 ?>

            <li>

            <li>
                <a href="trainee_registration.php">
                    <span class="sidebar-normal" style="color:#fff">Trainee Registration </span>
                </a>
            </li>
            <li>
                <a href="sponsored_time_table.php">
                    <span class="sidebar-normal" style="color:#fff">Time Table </span>
                </a>
            </li>
            <li>
                <a href="sponsored_attandance.php">
                    <span class="sidebar-normal" style="color:#fff">Take Attendance</span>
                </a>
            </li>
            <li>
                <a href="upload_course_material.php">
                    <span class="sidebar-normal" style="color:#fff">Upload Document</span>
                </a>
            </li>
            <li>
                <a href="sponsored_attandance_report.php">
                    <span class="sidebar-normal" style="color:#fff">Attendance Report</span>
                </a>
            </li>

            </li>

            <?php } ?>
            <!-- <li>

                <a href="registration.php">

                    <i class="now-ui-icons users_single-02"></i>

                    <p>Registration</p>
                </a>

            </li> -->


        </ul>
    </div>
</div>