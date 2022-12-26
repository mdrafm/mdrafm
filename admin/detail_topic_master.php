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


            <div class="content" style="margin-top: 20px;">
               <div class="row" >
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header">
                              
                                <h4 class="card-title">Detail Topic Master Syllabus Wise </h4>

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
                                         </div>
                                           
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                            
                                             <input type="button" class="btn btn-primary"  value="View" onclick="viewDetailTopictMaster()" style="margin-top: 20px;">
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
                    
                    
                </div>
                <div class="row" id="show_detail_topic_master">
                    

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
                        <h5 class="modal-title" id="m_title" style="text-align:center;">Delete Detail Topic</h5>
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
    let paperE1 = document.querySelector('#paper_id');
    let TopicE1 = document.querySelector('#topic');
    let DtlTopicE1 = document.querySelector('#dtl_topic');

    
 function viewDetailTopictMaster(){
     let syllabus_id = $('#syllabus_id').val();

     $.ajax({
        type: "POST",
        url: "ajax_fetch_master_data.php",

        data: {action:"view_detail_topic_master",syllabus_id:syllabus_id},
        success: function(res) {
            console.log(res);
            $('#show_detail_topic_master').html(res);
           

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

                            $('#subject_id').on('change', function() {
                                var subject_id = $(this).val();
                                //alert(paper_id);
                                console.log(123);
                                $.ajax({
                                    type: "POST",
                                    url: "ajax_edit_master.php",

                                    data: {
                                        subject_id: subject_id,
                                        table: "tbl_topic_master",
                                        action: "select_topic_sub"
                                    },
                                    success: function(res) {
                                        console.log(res);
                                        $('#topic').html(res);
                                    }
                                })

                            })

                            $('#topic').on('change', function() {
                                let topic = $('#topic').val();

                                if(topic == 0){
                                    alert('Please select a Subject');
                                }
                            })
                        }
                    })

            })

            
           

            $('#detailTopicTbl').DataTable();
             paperE1 = document.querySelector('#paper_id');
             TopicE1 = document.querySelector('#topic');
             DtlTopicE1 = document.querySelector('#dtl_topic');
        }
    })

 }




function add(str, frm, tbl) {

      // validate forms
    let isPaperValid =  checkDropdown(paperE1),
        isTopicValid = checkDropdown(TopicE1),
        isDtlTopicValid = checkTextField(DtlTopicE1);

    let isFormValid =    isPaperValid &&
                         isDtlTopicValid &&
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
                
                    viewDetailTopictMaster();
                    showMessage();
            }
        }
    })
    }
    

}

function edit(id) {

    $.ajax({
        type: "POST",
        url: "ajax_edit_master.php",
        dataType: "json",
        data: {
            action: "sub_edit",
            table: "tbl_detail_topic_master",
            edit_id: id

        },
        success: function(res) {
            console.log(res);
            res.map((data) => {

                    $('#update_id').val(data.id);
                    $('#paper_id').val(data.paper_id);
                   
                    $('#dtl_topic').val(data.dtl_topic);
                    var paper = $('#paper_id').val();
                    $.ajax({
                        type: "POST",
                        url: "ajax_edit_master.php",

                        data: {
                            mjr_id: data.mjr_id,
                            paper_id: paper,
                            table: "tbl_subject_master",
                            action: "select_subject_edit"
                        },
                        success: function(res) {
                            console.log(res);
                            $('#subject_id').html(res);
                            mjr_sub = $('#subject_id').val();
                           

                            $.ajax({
                                type: "POST",
                                url: "ajax_edit_master.php",

                                data: {
                                    topic_id: data.top_id,
                                    mjr_sub_id: mjr_sub,
                                    table: "tbl_topic_master",
                                    action: "select_topic"
                                },
                                success: function(res) {
                                    console.log(res);
                                    $('#topic').html(res);


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
        `<input type="button" class="btn btn-danger btn-dlt" value="Delete" onclick="delete_record(${id},'tbl_detail_topic_master')" />`;
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
                
                    viewDetailTopictMaster();
                    showMessage();
            }
        }
    })
}

</script>