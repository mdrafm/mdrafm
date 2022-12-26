<?php

  include 'database.php';
  $db = new Database();

  
 if ( isset($_POST['action']) && $_POST['action'] == 'view_subject_master'){
    $syllabus_id = $_POST['syllabus_id'];

    ?>

<!-- Modal -->
<div class="modal fade" id="termModal" tabindex="-1" aria-labelledby="termModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="width:200%; margin:20px -150px">
            <div class="modal-header">
                <h5 class="modal-title" id="termModalLabel">Subject Master</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="post" id="frm_mjrSub">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Paper Code</strong></label>
                                <select class="custom-select mr-sm-2" id="paper_id" name="paper_id">
                                    <option value="0" selected>Select Paper</option>
                                    <?php 
                                                                  
                                                                   $count = 0;
                                                                   $db->select('tbl_paper_master',"*",null,"status = 1 AND syllabus_id ='$syllabus_id' ",null,null);
                                                                   // print_r( $db->getResult());
                                                                   foreach($db->getResult() as $row){
                                                                       //print_r($row);
                                                                       $count++
                                                               ?>
                                    <option value="<?php echo $row['id'] ?>">
                                        <?php echo $row['paper_code'] .' - '.$row['title']; ?>
                                    </option>

                                    <?php 
                                                                   }
                                                            ?>
                                </select>
                                <small></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Description</strong></label>
                                <textarea class="form-control" name="descr" id="descr" placeholder="Enter  Description"
                                    rows="3" style="border: 1px solid #e3e3e3;border-radius:5px;"></textarea>

                                <input type="hidden" id="update_id">
                            </div>
                        </div>

                    </div>

                </form>
            </div>
            <div class="modal-footer">

                <button type="submit" class="btn btn-primary" name="submit" value="Save" id="save"
                    onclick="add('Subject','frm_mjrSub','tbl_subject_master')">Save</button>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">

    <div class="card">
        <div class="card-header">

            <div class="row">
                <div class="col-md-4">
                    <h4 class="card-title">Subject Master</h4>
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-2">
                    <input type="button" class="btn btn-primary" data-toggle="modal" data-target="#termModal" 
                        value="Add New">
                </div>
            </div>


        </div>
        <div class="card-body">
            <div id="term2" class=" table table-responsive table-striped table-hover" style="width:85%;margin:0px auto">
                <table class=" term table" id="subject">
                    <thead class="" style="background: #315682;color:#fff;font-size: 11px;">

                        <th style="">Sl No</th>
                        <th style="text-align:center;">Paper code</th>
                        <th style="text-align:center;">Description</th>
                        <th style="text-align:center;">Action</th>
                    </thead>
                    <tbody>
                        <?php 
                 
               
                 $count = 0;
                 $db->select('tbl_subject_master',"s.id,p.paper_code,p.title,s.descr"," s JOIN `tbl_paper_master` p on s.paper_id = p.id",'s.status = 1 AND p.syllabus_id ='.$syllabus_id,null,null);
                 // print_r( $db->getResult());
                 foreach($db->getResult() as $row){
                    // print_r($row);
                     $count++
                     ?>
                        <tr>
                            <td><?php echo $count; ?></td>

                            <td>
                                <?php
                                           echo $row['paper_code'] .' - '. $row['title'];
                                       ?>

                            </td>
                            <td><?php echo $row['descr']; ?> </td>



                            <td style="text-align:center;">


                                <a href="#" style="color:#4164b3" class="edit" id="<?php echo $row['id']; ?>"
                                    onclick="edit(this.id)"><i class="far fa-edit " style="font-size:1.5rem;"></i></a>
                                &nbsp;
                                <a href="#" style="color:#e50c0c" id="<?php echo $row['id']; ?>"
                                    onclick="cnfBox(<?php echo $row['id']; ?>)"><i class="far fa-trash-alt "
                                        style="font-size:1.5rem;"></i></i></a><br>

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
<?php
}

if ( isset($_POST['action']) && $_POST['action'] == 'view_topic_master'){
    $syllabus_id = $_POST['syllabus_id'];
    

    ?>

            <!-- Modal -->
            <div class="modal fade" id="termModal" tabindex="-1" aria-labelledby="termModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content" style="width:200%; margin:20px -150px">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="termModalLabel">Topic Master</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                    <form method="post" id="frm_topic">
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label><strong>Paper Code</strong></label>
                                                        <select class="custom-select mr-sm-2" id="paper_id"
                                                            name="paper_id">
                                                            <option value = "0" selected>Select Paper</option>
                                                            <?php 
                                                                   
                                                                    $count = 0;
                                                                    $db->select('tbl_paper_master',"*",null,"status = 1 AND syllabus_id ='$syllabus_id'",null,null);
                                                                    // print_r( $db->getResult());
                                                                    foreach($db->getResult() as $row){
                                                                        //print_r($row);
                                                                        $count++
                                                                ?>
                                                                            <option value="<?php echo $row['id'] ?>">
                                                                                <?php echo $row['paper_code'] .' - '.$row['title']; ?>
                                                                            </option>

                                                                            <?php 
                                                                    }
                                                             ?>
                                                        </select>
                                                        <small></small>
                                                    </div>
                                                </div>
                                            </div>
                                               <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label><strong>Subject</strong></label>
                                                        <select class="custom-select mr-sm-2" id="subject_id"
                                                            name="subject_id">
                                                            <option selected>Select Subject</option>
                                                            
                                                        </select>
                                                        <small></small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong>Topic</strong></label>
                                                        <input type="text" class="form-control" name="topic" id="topic"
                                                            placeholder="Enter Topic" required>
                                                            <small></small>
                                                      
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong>No of Session</strong></label>
                                                        <input type="text" class="form-control" name="session_no" id="session_no"
                                                            placeholder="Enter No of Session" required>
                                                            <small></small>
                                                        
                                                    </div>
                                                </div>

                                            </div>
                                            <input type="hidden" id="update_id">
                                        </form>
                                    </div>
                                    <div class="modal-footer">

                                        <button type="submit" class="btn btn-primary" name="submit" value="Save"
                                            id="save"
                                            onclick="add('Topic','frm_topic','tbl_topic_master')">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                            <div class="row">
                                    <div class="col-md-4">  
                                    <h4 class="card-title">Topic  Master</h4>
                                    </div>
                                    <div class="col-md-6"></div>
                                    <div class="col-md-2">
                                    <input type="button" class="btn btn-primary" data-toggle="modal" data-target="#termModal"
                            value="Add New">
                                    </div>
                                </div>
                               

                            </div>

                            <div class="card-body">
                                <div id="top" class=" table table-responsive table-striped table-hover" style="width:95%;margin:0px auto" >
                                    <table class="table" id="topicTbl">
                                        <thead class="" style="background: #315682;color:#fff;font-size: 11px;">

                                            <th style="">Sl No</th>

                                            <th style="text-align:center;">Paper code</th>
                                            <th style="text-align:center;">Subject</th>
                                            <th style="text-align:center;">Topic</th>
                                            <th style="text-align:center;">No of Session</th>
                                            <th style="text-align:center;">Action</th>



                                        </thead>
                                        <tbody>
                                            <?php 
                               
                                                $db = new Database();
                                                $count = 0;
                                                $db->select('tbl_topic_master',"t.id,t.session_no, p.paper_code,p.title ,sub.descr,t.topic"," t JOIN `tbl_subject_master` sub ON t.subject_id = sub.id JOIN `tbl_paper_master` p ON t.paper_id = p.id","p.syllabus_id = '$syllabus_id' AND t.status = 1 AND sub.status = 1 AND p.status = 1",null,null);
                                                // print_r( $db->getResult());
                                                foreach($db->getResult() as $row){
                                                    //print_r($row);
                                                    $count++
                                                    ?>
                                            <tr>
                                                <td><?php echo $count; ?></td>
                                                <td style="text-align:center;">
                                                <?php
                                                        echo $row['paper_code'] .' - '. $row['title'];
                                                    ?>
                                                
                                                </td>
                                                <td>
                                                <?php
                                                        echo $row['descr'];
                                                    ?>
                                                
                                                </td>
                                                <td><?php echo $row['topic']; ?> </td>
                                                <td style="text-align:center;"><?php echo $row['session_no']; ?> </td>

                                                    <td style="text-align:center;">

                                                        <a href="#" style="color:#4164b3" class="edit"
                                                            id="<?php echo $row['id']; ?>" onclick="edit(this.id)"><i
                                                                class="far fa-edit " style="font-size:1.5rem;"></i></a>
                                                        &nbsp;
                                                        <a href="#" style="color:#e50c0c" id="<?php echo $row['id']; ?>"
                                                            onclick="cnfBox(<?php echo $row['id']; ?>)"><i
                                                                class="far fa-trash-alt "
                                                                style="font-size:1.5rem;"></i></i></a><br>

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
    <?php

}

if ( isset($_POST['action']) && $_POST['action'] == 'view_detail_topic_master'){
    $syllabus_id = $_POST['syllabus_id'];
    
    ?>
         <!-- Modal -->
                       <div class="modal fade" id="termModal" tabindex="-1" aria-labelledby="termModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content" style="width:200%; margin:20px -150px">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="termModalLabel">Detail Topic</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <form method="post" id="frm_mjrSub">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong>Paper Code</strong></label>
                                                        <select class="custom-select mr-sm-2" id="paper_id"
                                                            name="paper_id">
                                                            <option value="0" selected>Select Paper</option>
                                                            <?php 
                                                                   
                                                                    $count = 0;
                                                                    $db->select('tbl_paper_master',"*",null,"syllabus_id =".$syllabus_id,null,null);
                                                                    // print_r( $db->getResult());
                                                                    foreach($db->getResult() as $row){
                                                                        //print_r($row);
                                                                        $count++
                                                                ?>
                                                            <option value="<?php echo $row['id'] ?>">
                                                                <?php echo $row['paper_code'] .' - '.$row['title']; ?>
                                                            </option>

                                                            <?php 
                                                                    }
                                                             ?>
                                                        </select>
                                                        <small></small>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong>Subject</strong></label>
                                                        <select class="custom-select mr-sm-2" id="subject_id"
                                                            name="subject_id">
                                                            <option selected>Select subject</option>

                                                        </select>
                                                        <small></small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong>Topic</strong></label>
                                                        <select class="custom-select mr-sm-2" id="topic"
                                                            name="topic_id">
                                                            <option value = "0" selected>Select Topic</option>

                                                        </select>
                                                        <small></small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong>Detail Topic</strong></label>
                                                        <textarea class="form-control" name="dtl_topic"
                                                            id="dtl_topic" placeholder="Enter  Description" rows="3"
                                                            style="border: 1px solid #e3e3e3;border-radius:5px;"></textarea>
                                                            <small></small>
                                                        <input type="hidden" id="update_id">
                                                    </div>
                                                </div>

                                            </div>

                                        </form>
                                    </div>
                                    <div class="modal-footer">

                                        <button type="submit" class="btn btn-primary" name="submit" value="Save"
                                            id="save"
                                            onclick="add('Subject','frm_mjrSub','tbl_detail_topic_master')">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                              <div class="row">
                                    <div class="col-md-4">  
                                    <h4 class="card-title"> Detail Topic</h4>
                                    </div>
                                    <div class="col-md-6"></div>
                                    <div class="col-md-2">
                                    <input type="button" class="btn btn-primary" data-toggle="modal" data-target="#termModal"
                                     value="Add New">
                                    </div>
                                </div>
                               

                            </div>
                            <div class="card-body">
                                <div id="term2" class=" table table-responsive table-striped table-hover"
                                    style="width:95%;margin:0px auto">
                                    <table class=" term table" id="detailTopicTbl">
                                        <thead class="" style="background: #315682;color:#fff;font-size: 11px;">

                                            <th style="">Sl No</th>
                                            <th style="text-align:center;">Paper Code</th>
                                            <th style="text-align:center;">Subject</th>
                                            <th style="text-align:center;">Topic</th>
                                            <th style="text-align:center;">Detail Topic</th>

                                            <th style="text-align:center;">Action</th>



                                        </thead>
                                        <tbody>
                                            <?php 
                              
                               $count = 0;
                               $db->select('tbl_detail_topic_master',"p.paper_code,p.title ,sub.descr,t.topic,dt.dtl_topic,dt.id"," dt JOIN  `tbl_topic_master` t ON dt.topic_id = t.id JOIN `tbl_subject_master` sub ON t.subject_id = sub.id JOIN `tbl_paper_master` p ON t.paper_id = p.id","p.syllabus_id = '$syllabus_id' AND t.status = 1 AND sub.status = 1 AND p.status = 1 AND dt.status = 1",null,null);
                              // print_r( $db->getResult());
                               foreach($db->getResult() as $row){
                                   //print_r($row);
                                   $count++
                                   ?>
                                            <tr>
                                                <td><?php echo $count; ?></td>
                                                <td style="text-align:center;">
                                                    <?php 
                                                        echo $row['paper_code'] .' - '. $row['title'];
                                                   
                                                   ?>
                                                </td>
                                                <td style="text-align:center;">
                                                    <?php 
                                                       echo $row['descr'];
                                                                
                                                                
                                                     ?>
                                                </td>
                                                <td style="text-align:center;">
                                                    <?php 
                                                         echo $row['topic'];
                                                                
                                                                
                                                     ?>
                                                </td>
                                                <td style="text-align:center;"><?php echo $row['dtl_topic']; ?> </td>

                                                <td style="text-align:center;">


                                                    <a href="#" style="color:#4164b3" class="edit"
                                                        id="<?php echo $row['id']; ?>" onclick="edit(this.id)"><i
                                                            class="far fa-edit " style="font-size:1.5rem;"></i></a>
                                                    &nbsp;
                                                    <a href="#" style="color:#e50c0c" id="<?php echo $row['id']; ?>"
                                                        onclick="cnfBox(<?php echo $row['id']; ?>)"><i
                                                            class="far fa-trash-alt "
                                                            style="font-size:1.5rem;"></i></i></a><br>

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
    <?php
}

?>

<!-- msgBox Modal Modal HTML -->
<div id="cnfModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title" id="m_title" style="text-align:center;">Delete Subject</h5>
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