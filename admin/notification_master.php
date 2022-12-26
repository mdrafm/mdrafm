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


                <div class="row">
                    <div class="col-md-12">
                   
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="card-title">Notification </h4>
                                    </div>

                                </div>


                            </div>
                            <div class="card-body">
                            <form id="program" method="post" enctype="multipart/form-data">
                                <div class="row" style="margin-top:20px;">
                                   <div class="col-md-12">
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label style="padding: 25px;"><strong>Title</strong></label>
                                            </div>
                                            <div class="col-md-7">
                                               <!-- <input type="text" class="form-control" name='title' placeholder="Enter Title" /> -->
                                               <textarea class="form-control"
                                                    name="title" id="title"
                                                    placeholder="Enter Title"
                                                    rows="3"
                                                    style="border: 1px solid rgb(79 67 67);border-radius:5px;">
                                                </textarea>
                                               
                                            </div>


                                        </div>
                                    </div>
                                 <div class="col-md-12">
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label style="padding: 25px;"><strong>Description</strong></label>
                                            </div>
                                            <div class="col-md-7">
                                                     <div class="form-group">
                                                            
                                                            <div class="form-check form-check-inline"
                                                                style="margin-left: 20px;">
                                                                <input class="form-check-input" type="radio"
                                                                    name="descr_type" id="ClassRoom" value="1"
                                                                    checked>
                                                                <label class="form-check-label" for="Inhouse"
                                                                    style="padding-left: 5px;">Type Text
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="descr_type" id="other" value="2">
                                                                <label class="form-check-label" for="Visiting"
                                                                    style="padding-left: 5px;">Upload File</label>
                                                            </div>
                                                            
                                                        </div>

                                                 <textarea class="form-control"
                                                    name="descr" id="descr"
                                                    placeholder="Enter Program description"
                                                    rows="3"
                                                    style="border: 1px solid rgb(79 67 67);border-radius:5px; ">
                                                 </textarea>

                                                  <div class="col-md-6" style="display:none" id="descr_doc_div">
                                                        <div class="row">
                                                            <input type="file" name="descr" id="descrDoc" class="form-control"
                                                            style="opacity: 1;position: unset;height: 85%;border-radius: 5px;">
                                                            <!-- <input type="button" class="btn btn-info btn_sm" id="descr_doc_btn"
                                                            onclick="upload_descr_doc('descr_doc')" value="Upload"> -->
                                                        </div>
                                                    
                                                    </div>
                                                    <div id="show_dscr"></div>
                                                
                                            </div>


                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label style="padding: 25px;"><strong>Active Date</strong></label>
                                            </div>
                                            <div class="col-md-4">
                                               <input type="date" class="form-control" name="active_dt" id="active_dt" />
                                                
                                            </div>


                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label style="padding: 25px;"><strong>In-Active Date</strong></label>
                                            </div>
                                            <div class="col-md-4">
                                               <input type="date" class="form-control" name="in_active_dt" id="in_active_dt" />
                                                
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                    <div class="col-md-2" style="float:right">
                                        <input type="button" class="btn btn-primary" id="save" value="Add" 
                                        onclick="add('Other Program','program','tbl_notification')"
                                        style="margin-top: 0px " />
                                    </div>
                                   
                                </form>
                                <input type="hidden" name="update_id" id="update_id" />
                            </div>
                        </div>
                       
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12">

                        <div class="card">
                           
                            <div class="card-body">
                            <div id="term2" class=" table table-responsive table-striped table-hover" style="width:85%;margin:0px auto" >
                                    <table class=" term table">
                                        <thead class="" style="background: #315682;color:#fff;font-size: 11px;">

                                            <th style="">Sl No</th>
                                            <th style="text-align:center;">Title</th>
                                            <th style="text-align:center;">Active Date</th>
                                            <th style="text-align:center;">In-Active Date</th>
                                            <th style="text-align:center;">New</th>
                                            <th style="text-align:center;">Action</th>


                                        </thead>
                                        <tbody>
                                            <?php 
                               
                              
                               $count = 0;
                               $db->select('tbl_notification',"*",null,null,null,null);
                              // print_r( $db->getResult());
                               foreach($db->getResult() as $row){
                                   //print_r($row);
                                   $count++
                                   ?>
                                            <tr>
                                                <td><?php echo $count; ?></td>
                                                <td style="text-align:center;"><?php echo $row['title'] ?></td>
                                                <td style="text-align:center;"><?php echo date("d-m-Y", strtotime($row['active_dt'])) ?></td>
                                                <td style="text-align:center;"><?php echo date("d-m-Y", strtotime($row['in_active_dt'])) ?></td>
                                                <td style="text-align:center;">
                                                <input class="new_show_<?php echo $row['id'] ?>" id="<?php echo $row['id'] ?>" type="checkbox" <?php echo ($row['new']== 1)?'checked':'' ?>
                                                 value = "<?php echo $row['new'] ?>"
                                                >
                                                </td>
                                                <td style="text-align:center;">
                                                <a href="#" style="color:rgb(32 157 35)" id="<?php echo $row['id']; ?>"
                                                            onclick="view(<?php echo $row['id']; ?>)"><i
                                                                class="far fa-file-alt "
                                                                style="font-size:1.5rem;"></i></i></a>&nbsp;
                                                <a href="#" style="color:#4164b3" class="edit"
                                                            id="<?php echo $row['id']; ?>" onclick="edit(this.id)"><i
                                                                class="far fa-edit " style="font-size:1.5rem;"></i></a>
                                                        
                                                       <br>

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
            <div class="modal-content"  style="width:100%; margin:20px -80px">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="m_title" style="text-align:center;">Remove Document </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="warning">
                            <p>Are you sure you want to remove this document?</p>
                            <p class="text-warning"><small>This action cannot be undone.</small></p>
                        </div>
                        <p id="m_body"></p>
                    </div>
                    <div class="modal-footer" id="m_footer">
                      

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- view Modal Modal HTML -->
    <div id="viewModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content"  style="width:100%; margin:20px -80px">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="m_title" style="text-align:center;"> View Detail </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <!-- <div class="warning">
                            <p>Are you sure you want to remove this document?</p>
                            <p class="text-warning"><small>This action cannot be undone.</small></p>
                        </div> -->
                        <div id="m_body_view"></div>
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
$('#active_dt').on('change', function(){
   let active_dt = $('#active_dt').val();
   let in_active_dt = $('#in_active_dt').val();

   let active = new Date(active_dt);
   let in_active = new Date(in_active_dt);

   let now = new Date();
    if(active < now){
        alert('Previous date not allowed ');
    }
    if(  in_active < active  ){
        alert('In-active date must be greater than active date ');
    }
    //alert(active);
})
$('input[name="descr_type"]').click(function() {
    if ($(this).is(':checked')) {
        //alert($(this).val());
        let id = $(this).val();
        if (id == 2) {
            $('#descr').hide();
            $('#descr').val('');
            $('#descr_doc_div').show();
        } else {
            $('#descr').show();
            $('#descrDoc').val('');
            $('#descr_doc_div').hide();
        }

    }
})


  $('input[type="checkbox"]').on('change', function() {

      //var checkedValue = $(this).prop('checked');
         var id =     $(this).prop('id');  
         //var new = $(this).val();
           var new_msg = $('.new_show_'+id).val();
         //alert(new_msg);

         $.ajax({
             type: "POST",
             url:"ajax_otherProgram.php",
             data:{'action':'update_new','update_id':id,'tbl':'tbl_notification','new_value':new_msg},
             success: function(res) {
                    console.log(res);
                    let elm = res.split('#');
                    if (elm[0] == "success") {
                       
                        location.reload();
                    }
                }
         })

    });

function add(str, frm, tbl) {

    var update_id = $('#update_id').val();
    var desc_file = $('#descrDoc')[0].files;
    var title = $('#title').val();
    var descr = $('#descr').val();
    var active_dt = $('#active_dt').val();
    var in_active_dt = $('#in_active_dt').val();


     console.log(desc_file);
   // var form_data = new FormData();                  
    //form_data.append('file', desc_file);

    var fd = new FormData();
    fd.append('file',desc_file[0]);
    fd.append('action','upload_doc');
    fd.append('title',title);
    fd.append('descr',descr);
    fd.append('active_dt',active_dt);
    fd.append('in_active_dt',in_active_dt);
    fd.append('update_id',update_id);
    fd.append('tbl','tbl_notification');
   

    // form_data.append("file", document.getElementById('descr_doc').files[0]);
    // form_data.append("action", "upload_ppt_doc");
    //console.log(form_data);
    $.ajax({
        type: "POST",
        url: "ajax_otherProgram.php",

        data: fd,
        contentType: false,
              processData: false,
        success: function(res) {
            console.log(res);
            let elm = res.split('#');
            if (elm[0] == "success") {
                sessionStorage.message = str + ' ' + elm[1];
                sessionStorage.type = "success";
                location.reload();
            }
        }
    })

}

function edit(id) {
    $('#show_dscr').html('');
$.ajax({
    type: "POST",
    url: "ajax_master.php",
    dataType: "json",
    data: {
        action: "edit",
        table: "tbl_notification",
        edit_id: id

    },
    success: function(res) {
        console.log(res);
        res.map((data) => {

               // $('#update_id').val(data.id);
                $('#title').val(data.title);
                if(data.descr == ''){
                    $('#other').prop('checked', true);
                    $('#descr').hide();
                    $('#descr_doc_div').hide();

                    $('#show_dscr').html(`<a href= '../doc/ongoing/${data.descr_doc}' target="_blank" >document <img src="../images/document_pdf.png" /></a>
                                    <a href="#" class="remove" id= ${data.id}  onclick = "cnfBox(this.id)" > <img src="../images/cross.png" /></a>`)
                }
                else{
                    $('#ClassRoom').prop('checked', true);
                    $('#descr').show();
                    $('#descr').val(data.descr);
                }
                if(data.descr_doc == ''){
                    $('#descr_doc_div').show();
                    $('#show_dscr').hide();
                    $('#descr_doc_div').hide();
                }
                $('#active_dt').val(data.active_dt);
                $('#in_active_dt').val(data.in_active_dt);
                $('#update_id').val(data.id);
                $('#save').val('Update');
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
        `<input type="button" class="btn btn-danger btn-dlt" value="Remove" onclick="remove_doc(${id},'tbl_new_recruite')" />
        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">`;
    $('#m_footer').append(html);
    $('#cnfModal').modal('show');
}

function remove_doc(id){
    $.ajax({
        type: "POST",
        url: "ajax_otherProgram.php",
        data: {

            action: "remove_doc",
            id: id,
            table: 'tbl_notification'
        },
        success: function(res) {
            console.log(res);
            if (res == "success") {
                $('#descr_doc_div').show();
            }
        }
    })
}

function view(id){
    $('#m_body').html('');
    $.ajax({
        type: "POST",
        url: "ajax_otherProgram.php",
        data: {

            action: "view",
            id: id,
            table: 'tbl_notification'
        },
        success: function(res) {
            console.log(res);
            $('#m_body_view').html(res);
            $('#viewModal').modal('show');
        }
    })
}

</script>