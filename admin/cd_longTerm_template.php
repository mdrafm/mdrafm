<?php include 'database.php'; ?>
<table class=" term table">
                                        <thead class="" style="background: #315682;color:#fff;font-size: 11px;">

                                            <th style="width:50px;">Sl No</th>
                                            <th style="text-align:center;">Programm Name</th>
                                            <th style="text-align:center;">Tranning Type</th>
                                            <th style="text-align:center;">Provisanal Start Date</th>
                                            <th style="text-align:center;">Action</th>

                                        </thead>
                                        <tbody>
                                            <?php 
                               
                               $db = new Database();
                               $count = 0;
                               $username = $_POST['username'];
                               //$db->select('tbl_program_master',"*",null,null,null,null);
                            //    $sql = "SELECT p.id,p.prg_name,t.type,s.descr as syallbus,f.name as course_dir,p.provisonal_Sdate,p.provisonal_Edate,p.dt_publication,p.dt_completion,p.status 
                            //                 FROM `tbl_program_master` p JOIN `tbl_training_type` t 
                            //                 ON p.trng_type=t.id
                            //                 JOIN `tbl_sylabus_master` s 
                            //                 ON p.syllabus_id=s.id
                            //                 JOIN `tbl_faculty_master` f
                            //                 ON p.course_director = f.id 
                            //                 WHERE p.status != 'draft'  AND f.name = '".$_SESSION['name']."'";
                                $sql = "SELECT x.id,t.id as trngType_id,t.type,x.prg_name,fm.name as asst_cd,x.provisonal_Sdate,x.provisonal_Edate 
                                      FROM (SELECT * from `tbl_program_master`  WHERE course_director = 
                                      (SELECT f.id as co_dir_id FROM `tbl_user` u JOIN `tbl_faculty_master` f ON u.username=f.phone WHERE u.username='".$username."')) x 
                                      JOIN `tbl_training_type` t ON x.trng_type=t.id 
                                      JOIN `tbl_faculty_master` fm ON x.asst_course_director = fm.id";
                                $db->select_sql($sql);             
                              // print_r( $db->getResult());
                               foreach($db->getResult() as $row){
                                   //print_r($row); 
                                   $tbl = "";
                                //    if($row['trng_type']==1){
                                //        $tbl = 'tbl_sylabus_master';
                                //    }
                                   $count++
                                   ?>
                                            <tr>
                                                <td><?php echo $count; ?></td>
                                                <td style="text-align:center;"><?php echo $row['prg_name']; ?> </td>
                                                <td style="text-align:center;"><?php echo $row['type']; ?> </td>
                                                <td style="text-align:center;">
                                                    <?php echo date("d/m/Y", strtotime($row['provisonal_Sdate'])) ?>
                                                </td>

                                                <td style="text-align:center;">

                                                    <input type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#prgram_list_<?php echo $row['id'] ?>"
                                                        value="view">

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="prgram_list_<?php echo $row['id'] ?>"
                                                        tabindex="-1" aria-labelledby="termModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content"
                                                                style="width:200%; margin:20px -150px">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="termModalLabel">Program
                                                                        Detail</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <?php //sprint_r($row); ?>
                                                                    <div class="div">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="row">
                                                                                    <div class="col-md-5">
                                                                                        <label for="">Program Name:
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="col-md-7 text-left">
                                                                                        <?php echo $row['prg_name']?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">

                                                                                <div class="row">
                                                                                    <div class="col-md-4">
                                                                                        <label for="">Tranning Type:
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="col-md-8 text-left">
                                                                                        <?php echo $row['type']; ?>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div><br>
                                                                        <div class="row">
                                                                            <div class="col-md-6">

                                                                                <div class="row">
                                                                                    <div class="col-md-5">
                                                                                        <label for=""> Asst. Course
                                                                                            Director </label>:
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="col-md-7 text-left">
                                                                                        <?php echo $row['asst_cd']; ?>
                                                                                    </div>
                                                                                </div>

                                                                            </div>

                                                                            <div class="col-md-6"
                                                                                style="display:<?php echo ($row['trngType_id']==4 || $row['trngType_id']==3)?'none':'' ?>">
                                                                                <div class="row">
                                                                                    <div class="col-md-4">
                                                                                        <label for="">Syllabus:
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="col-md-8 text-left">
                                                                                        <?php echo $row['syallbus']?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div><br>

                                                                        <div class="row">
                                                                            <div class="col-md-6">

                                                                                <div class="row">
                                                                                    <div class="col-md-5">
                                                                                        <label for="">Provisonal Start
                                                                                            Date:
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="col-md-7 text-left">
                                                                                        <?php echo date("d/m/Y", strtotime($row['provisonal_Sdate']));  ?>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="row">
                                                                                    <div class="col-md-4">
                                                                                        <label for="">Provisonal End
                                                                                            Date:
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="col-md-8 text-left">
                                                                                        <?php echo  date("d/m/Y", strtotime($row['provisonal_Edate']));?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>


                                                                        <div class="row"
                                                                            style="display:<?php echo ($row['trngType_id']==4 || $row['trngType_id']==3)?'none':'' ?>">
                                                                            <div class="col-md-6">

                                                                                <div class="row">
                                                                                    <div class="col-md-5">
                                                                                        <label for="">Date of
                                                                                            Commencement for Self
                                                                                            Registration:
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="col-md-7 text-left">
                                                                                        <?php echo  date("d/m/Y", strtotime($row['dt_publication'])); ?>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="row">
                                                                                    <div class="col-md-4">
                                                                                        <label for="">Closing Date
                                                                                            of Self Registration:
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="col-md-8 text-left">
                                                                                        <?php echo date("d/m/Y", strtotime($row['dt_completion'])) ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">

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