<!DOCTYPE html>
<html lang="en">


<head>
    <?php 
    
    include('header_link.php');
    include('../config.php');
    include 'database.php';
    $db = new Database();

    //dependent select options for major subject
 
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

               <div class="row"  style="margin-top:50px">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header">
                              
                                <h4 class="card-title">Topic Master Syllabus Wise </h4>

                            </div>
                            <div class="card-body">
                                <form id="frm_range">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                             <label><strong>Syllabus</strong></label>
                                             <select class="custom-select mr-sm-2" id="syllabus_id"
                                                            name="syllabus_id">
                                                            <option value="0" selected>Select Syllabus</option>
                                                            <?php 
                                                      $db = new Database();
                                                      $count = 0;
                                                      $db->select('tbl_sylabus_master',"*",null,"status = 1",null,null);
                                                     // print_r( $db->getResult());
                                                      foreach($db->getResult() as $row){
                                                          //print_r($row);
                                                          $count++
                                                     ?>
                                                            <option value="<?php echo $row['id'] ?>">
                                                                <?php echo $row['descr'] ?>
                                                            </option>

                                                            <?php 
                                                      }
                                                      ?>
                                                        </select>
                                         </div>
                                           
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                            
                                             <input type="button" class="btn btn-primary"  value="View" onclick="viewTopictMaster()" style="margin-top: 20px;">
                                            </div>
                                           
                                        </div>
                                       
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div id="alert_msg" class="alert alert-success">added successfully</div>
                    </div>
                    <div class="col-md-6">
                   

                    </div>
                    <div class="col-md-2">
                       
                    </div>
                </div>
                <div id ="show_topic_master">
                    

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

    <?php include('common_script.php') ?>

</body>

</html>

<script type="text/javascript">
  let paperE1;
  let sessionE1;
  let TopicE1;  

 function viewTopictMaster(){
     let syllabus_id = $('#syllabus_id').val();

     $.ajax({
        type: "POST",
        url: "ajax_fetch_master_data.php",

        data: {action:"view_topic_master",syllabus_id:syllabus_id},
        success: function(res) {
            console.log(res);
            $('#show_topic_master').html(res);
           

            $('#paper_id').on('change', function() {
                    var paper_id = $(this).val();
                   
                    $.ajax({
                        type: "POST",
                        url: "ajax_master.php",

                        data: {
                            action: "select_subject",
                            paper_id: paper_id,
                            table: "tbl_subject_master",
                        
                        },
                        success: function(res) {
                            console.log(res);
                            $('#subject_id').html(res);
                        }
                    })

            })

            $('#topicTbl').DataTable();
             paperE1 = document.querySelector('#paper_id');
             sessionE1 = document.querySelector('#session_no');
             TopicE1 = document.querySelector('#topic');
        }
    })

 }


function add(str, frm, tbl) {

     // validate forms
    let isPaperValid =  checkDropdown(paperE1),
        isSessionValid = checkTextField(sessionE1),
        isTopicValid = checkTextField(TopicE1);

    let isFormValid =    isPaperValid &&
                        isSessionValid &&
                        isTopicValid;

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
                console.log(res);
                let elm = res.split('#');
                if (elm[0] == "success") {
                    sessionStorage.message = str + ' ' + elm[1];
                    sessionStorage.type = "success";
                    $('.modal').remove();
                    $('.modal-backdrop').remove();
                    $('body').removeClass( "modal-open" );
                
                    viewTopictMaster();
                    showMessage();
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
        action: "frm_edit",
        table: "tbl_topic_master",
        edit_id: id

    },
    success: function(res) {
        console.log(res);
        res.map((data) => {

                $('#update_id').val(data.id);
                $('#paper_id').val(data.paper_id);
                $('#subject_id').html(`<option value="${data.sub_id}" >${data.descr}</option>`);
                $('#topic').val(data.topic);
                $('#session_no').val(data.session_no);
               
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
        `<input type="button" class="btn btn-danger btn-dlt" value="Delete" onclick="delete_record(${id},'tbl_topic_master')" />`;
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
            status_value:0,
            table: tbl
        },
        success: function(res) {
            console.log(res);
            if (res == "success") {
                sessionStorage.message = "record deleted successfully";
                sessionStorage.type = "success";
                $('.modal').remove();
                    $('.modal-backdrop').remove();
                    $('body').removeClass( "modal-open" );
                
                    viewTopictMaster();
                    showMessage();
            }
        }
    })
}


</script>