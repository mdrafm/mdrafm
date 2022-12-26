<!DOCTYPE html>
<html lang="en">


<head>
    <?php 
    
    include('header_link.php');
    include('../config.php');
    include 'database.php';
    $db = new Database();
    ?>

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


                <div class="row" style="margin-top:20px">
                    <div class="col-md-12">

                        <div class="card">

                            <div class="card-body">

                                <div class="row">

                                    <div id="class_tbl" class=" table table-responsive table-striped table-hover"
                                        style="width:95%;margin:0px auto">
                                        <table class=" term table" id="tableid">
                                          <thead class="" style="background: #315682;color:#fff;font-size: 11px;">
                                            <th style="">Sl No</th>
                                            <th style="text-align:center;">Training Date</th>
                                            <th style="text-align:center;">subject</th>
                                            <th style="text-align:center;">Document</th>
                                          </thead> 
                                          <tbody>
                                              <?php
                                              $count = 0;
                                              $sql = "SELECT td.doc_type,td.doc_name,st.program_id,st.training_dt,st.faculty_name,st.paper_covered FROM 
                                              `tbl_tranning_document` td JOIN `tbl_sponsored_time_table` st ON td.time_tbl_id = st.id
                                               WHERE td.trng_type = trng_type AND st.program_id=  $prog_id";

                                               $db->select_sql($sql);
                                               foreach($db->getResult() as $row ){
                                                   //print_r($row);
                                                   $count++;
                                                   ?>
                                                   <tr>
                                                        <td style="text-align:center;"><?php echo $count; ?></td>
                                                        <td style="text-align:center;"><?php echo $row['training_dt'] ?></td>
                                                        <td style="text-align:center;"><?php echo $row['paper_covered'] ?></td>
                                                       
                                                        <td style="text-align:center;">
                                                            <?php 
                                                               $doc_list = explode(',',$row['doc_name']);
                                                               //print_r($doc_list);
                                                                $num = 0;
                                                               foreach($doc_list as $doc){
                                                                $num++;
                                                                  ?>
                                                                    <a href="<?php echo "course_material/".$doc; ?>" target="_blank" > <img src="../images/document_pdf.png" />
                                                                     Document <?php echo $num; ?> 
                                                                    </a> </br>
                                                                  <?php
                                                               }
                                                             ?>
                                                        
                                                          
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

    </div>

    <!-- msgBox Modal Modal HTML -->
    <div id="viewTraneeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content" style="width:160%; margin:120px -60px">
                <form id="attandance">
                    <div class="modal-header">
                        <h5 class="modal-title" id="m_title" style="text-align:center;">Attandance </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">

                        <div id="view_tranee"></div>


                    </div>
                    <div class="modal-footer" id="mailbtn">
                        <input type="button" class="btn btn-success" value="Save" onclick="save_attendance()" />
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel" />

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- msgBox Modal Modal HTML -->
    <div id="pptModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="m_title" style="text-align:center;">Upload PPT</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="file" name="ppt_doc" id="ppt_doc" class="form-control"
                                    style="opacity: 1;position: unset;height: 85%;border-radius: 5px;">
                            </div>
                            <div class="col-md-6" id="upload_btn">
                               
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" id="m_footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">

                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="ppfModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="m_title" style="text-align:center;">Upload PDF</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="file" name="pdf_doc" id="pdf_doc" class="form-control"
                                    style="opacity: 1;position: unset;height: 85%;border-radius: 5px;">
                            </div>
                            <div class="col-md-6" id="upload_btn_pdf">
                               
                            </div>
                        </div>
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
