<!DOCTYPE html>
<html lang="en">


<head>
    <?php 
    
    include('header_link.php');
    include('../config.php');
    include 'database.php';
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
                                        <h5 class="modal-title" id="termModalLabel">Detail Syllabus</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                    <form method="post" id="frm_dtl_syllabus">
                                        <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong>Syllabus</strong></label>
                                                        <select class="custom-select mr-sm-2" id="syllabus_id"
                                                            name="syllabus_id">
                                                            <option value = '0' selected>Select Syllabus</option>
                                                            <?php 
                                                      $db = new Database();
                                                      $count = 0;
                                                      $db->select('tbl_sylabus_master',"*",null,"status = 1",null,null);
                                                  
                                                      foreach($db->getResult() as $row){
                                                        
                                                          $count++
                                                   ?>
                                                            <option value="<?php echo $row['id'] ?>">
                                                                <?php echo $row['descr'] ?>
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
                                                        <label><strong>Term</strong></label>
                                                        <select class="custom-select mr-sm-2" id="term_id"
                                                            name="term_id">
                                                            <option value = '0' selected>Select Term</option>
                                                           
                                                        </select>
                                                        <small></small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong>Paper Code</strong></label>
                                                        <select class="custom-select mr-sm-2" id="paper_id"
                                                            name="paper_id">
                                                            <option value = '0' selected>Select Paper</option>
                                                            
                                                        </select>
                                                        <small></small>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong>No of Session</strong></label>
                                                        <input type="text" class="form-control" name="session_no" id="session_no"
                                                            placeholder="Enter No Of session" required>
                                                            <small></small>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong>Total Mark</strong></label>
                                                        <input type="text" class="form-control" name="total_mark" id="total_mark"
                                                            placeholder="Enter total_mark" required>
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
                                            onclick="add('Detail Sullabus','frm_dtl_syllabus','tbl_dtl_syllabus_master')">Save</button>
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

                               <div class="row">
                                    <div class="col-md-4">  
                                    <h4 class="card-title">Detail Syllabus master</h4>
                                    </div>
                                    <div class="col-md-6"></div>
                                    <div class="col-md-2">
                                    <input type="button" class="btn btn-primary" data-toggle="modal" data-target="#termModal"
                                       value="Add New">
                                    </div>
                                </div>
                              

                            </div>
                            <div class="card-body">
                                <div id="term2" class=" table table-responsive table-striped table-hover" style="width:95%;margin:0px auto" >
                                    <table class=" term table">
                                        <thead class="" style="background: #315682;color:#fff;font-size: 11px;">

                                            <th style="">Sl No</th>
                                            <th style="text-align:center;">Syllabus</th>
                                            <th style="text-align:center;">Term</th>
                                            <th style="text-align:center;">Paper Code</th>
                                            <th style="text-align:center;">No Of Session </th>
                                            <th style="text-align:center;">Total Mark </th>
                                            <th style="text-align:center;">Action</th>



                                        </thead>
                                        <tbody>
                                            <?php 
                               
                               $db = new Database();
                               $count = 0;
                               $db->select('tbl_dtl_syllabus_master',"*",null,'status = 1',null,null);
                              // print_r( $db->getResult());
                               foreach($db->getResult() as $row){
                                   //print_r($row);
                                   $count++
                                   ?>
                                            <tr>
                                                <td><?php echo $count; ?></td>
                                                <td style="text-align:center;">
                                                    <?php 
                                                        $db->select_one('tbl_sylabus_master',"descr",$row['syllabus_id']);
                                                        
                                                        foreach($db->getResult() as $row1){
                                                            echo $row1['descr'];
                                                        }
                                                                
                                                                
                                                     ?>
                                                 </td>
                                                <td style="text-align:center;">
                                                    <?php 
                                                        $db->select_one('tbl_term_master',"term",$row['term_id']);
                                                        
                                                        foreach($db->getResult() as $row1){
                                                            echo $row1['term'];
                                                        }
                                                                
                                                                
                                                     ?>
                                                 </td>

                                                <td>
                                                    <?php
                                                        $db->select_one('tbl_paper_master',"paper_code,title",$row['paper_id']);
                                                        
                                                        foreach($db->getResult() as $row1){
                                                            echo $row1['paper_code'] .' - '. $row1['title'];
                                                        }
                                                    ?>
                                                 </td>
                                                <td style="text-align:center;"><?php echo $row['session_no']; ?> </td>
                                                <td><?php echo $row['total_mark']; ?> </td>


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
                        <h5 class="modal-title" id="m_title" style="text-align:center;">Delete Deatail Syllabus/h5>
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
    
    const syllabusEl = document.querySelector('#syllabus_id');
    const termE1 = document.querySelector('#term_id');
    const paperE1 = document.querySelector('#paper_id');
    const sessionE1 = document.querySelector('#session_no');
    const TotalMarkE1 = document.querySelector('#total_mark');

    $('#syllabus_id').on('change', function() {
    var syllabus_id = $(this).val();
    // alert(term_id);

    $.ajax({
        type: "POST",
        url: "ajax_master.php",

        data: {
            syllabus_id: syllabus_id,
            table: "tbl_term_master",
            action: "select_term"
        },
        success: function(res) {
            console.log(res);
            $('#term_id').html(res);
        }
    })

})


function add(str, frm, tbl) {

     // validate forms
    let isSyllabusValid = checkDropdown(syllabusEl),
        isTermValid =  checkDropdown(termE1),
        isPaperValid =  checkDropdown(paperE1),
        isSessionValid = checkTextField(sessionE1),
        isTotalMarkValid = checkTextField(TotalMarkE1);

    let isFormValid = isSyllabusValid &&
                        isTermValid &&
                        isPaperValid &&
                        isSessionValid &&
                        isTotalMarkValid;

    var update_id = $('#update_id').val();
   if( isFormValid){
        $.ajax({
            type: "POST",
            url: "ajax_master.php",

            data: $('#' + frm).serialize() + '&' + $.param({
                'action': 'add',
                'table': tbl,
                'update_id': update_id
            }),
            success: function(res) {
               // console.log(res);
                let elm = res.split('#');
                if (elm[0] == "success") {
                    sessionStorage.message = str + ' ' + elm[1];
                    sessionStorage.type = "success";
                    location.reload();
                }
            }
        })
   }
    

}

function edit(id) {

$.ajax({
    type: "POST",
    url: "ajax_master.php",
    dataType: "json",
    data: {
        action: "edit",
        table: "tbl_dtl_syllabus_master",
        edit_id: id

    },
    success: function(res) {
        console.log(res);
        res.map((data) => {

                $('#update_id').val(data.id);
                $('#syllabus_id').val(data.syllabus_id);
                //$('#term_id').val(data.term_id);
                $('#paper_id').val(data.paper_id);
                $('#session_no').val(data.session_no);
                $('#total_mark').val(data.total_mark);
                
                $.ajax({
                        type: "POST",
                        url: "ajax_edit_master.php",
                        data: {
                            term_id: data.term_id,
                            syllabus_id: data.syllabus_id,
                            table: "tbl_paper_master",
                            action: "select_term_edit"
                        },
                        success: function(res){
                            //console.log(res);
                            $('#term_id').html(res);
                             
                                    $.ajax({
                                        type: "POST",
                                        url: "ajax_edit_master.php",
                                        data: {
                                            paper_id: data.paper_id,
                                            id: data.id,
                                            table: "tbl_dtl_syllabus_master",
                                            action: "select_paper_edit"
                                        },
                                        success: function(res){
                                            console.log(res);
                                            $('#paper_id').html(res);
                                        }
                                    });
                        }
                    });

                $('#save').html('Update');
                $('#save').attr('id', 'update');
                $('#termModal').modal('show');
            }

        )

    }
})
}

function cnfBox(id) {
    //alert(id);
    $('#m_footer').empty();
    var html =
        `<input type="button" class="btn btn-danger btn-dlt" value="Delete" onclick="delete_record(${id},'tbl_dtl_syllabus_master')" />`;
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
</script>