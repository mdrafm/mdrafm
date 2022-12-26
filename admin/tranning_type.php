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
                    <div class="col-md-4">
                    <div id="alert_msg" class="alert alert-success">added successfully</div>
                    </div>
                    <div class="col-md-6">
                        <!-- Modal -->
                        <div class="modal fade" id="termModal" tabindex="-1" aria-labelledby="termModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="termModalLabel">Tranning Type</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                    <form method="post" id="frm_tranning">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong> Type</strong></label>
                                                <input type="text" class="form-control" name="type" id="type"
                                                    placeholder="Enter Tranning Type">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong> Tranning Duration</strong></label>
                                                <input type="text" class="form-control" name="duration" id="duration" placeholder="Tranning Duration">
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="update_id" >

                                    
                                </form>
                                    </div>
                                    <div class="modal-footer">

                                        <button type="submit" class="btn btn-primary" name="submit" value="Save" id="save"
                                            onclick="add('type','frm_tranning','tbl_training_type')">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-2">
                        <input type="button" class="btn btn-primary" data-toggle="modal" data-target="#termModal"
                            value="Add New">
                    </div>
                </div>
                <div class="row">
                    <table id="term" class="table table-striped table-bordered" style="width:65%;margin: 20px auto">
                        <thead>
                            <tr>
                                <th style="width:75px;">Sl No</th>
                                <th style="text-align:center;">Tranning Type</th>
                                <th style="text-align:center;">Duration</th>
                                <!-- <th>Date</th> -->
                                <th style="text-align:center;width: 8rem;">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                             <?php 
                               
                               $db = new Database();
                               $count = 0;
                               $db->select('tbl_training_type',"*",null,'status = 1',null,null);
                              // print_r( $db->getResult());
                               foreach($db->getResult() as $row){
                                  // print_r($row);
                                   $count++
                                   ?>
                                   <tr>
                                        <td><?php echo $count; ?></td>
                                        <td style="text-align:center;">
                                         <?php echo $row['type']; ?> 
                                       </td>
                                        <td style="text-align:center;"><?php echo $row['duration']; ?> </td>
                                        <td style="text-align:center;">
                                            <a href="#" style="color:#4164b3" class="edit" id="<?php echo $row['id']; ?>" onclick="edit(this.id)" ><i class="far fa-edit "
                                                    style="font-size:1.5rem;" ></i></a> &nbsp;
                                            <!-- <a href="#" style="color:#e50c0c" id="<?php echo $row['id']; ?>" onclick="cnfBox(<?php echo $row['id']; ?>)" ><i class="far fa-trash-alt "
                                                    style="font-size:1.5rem;"></i></i></a> -->
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
    
function add(str,frm,tbl){
    
 
    var update_id = $('#update_id').val();
  
    $.ajax({
        type: "POST",
        url: "ajax_master.php",
        
        data:  $('#'+frm).serialize() + '&'+$.param({ 'action': 'add','table':tbl,'update_id': update_id}),
        success: function(res) {
            console.log(res);
            let elm = res.split('#');
            if (elm[0] == "success") {
                sessionStorage.message =  str +' '+ elm[1]; 
                sessionStorage.type = "success";
                location.reload();
            }
        }
    })

}
function edit(id){
  
    $.ajax({
        type: "POST",
        url: "ajax_master.php",
        dataType:"json",
        data: {
            action: "edit",
            table:"tbl_training_type",
            edit_id: id
           
        },
        success: function(res) {
            console.log(res);
            res.map((data)=>{
             
               $('#update_id').val(data.id);
               $('#type').val(data.type);
               $('#duration').val(data.duration);
              
               $('#save').html('Update');
               $('#save').attr('id','update');
               $('#termModal').modal('show');
            }
               
            )
            
        }
    })
}

function cnfBox(id){
    //alert(id);
    $('#m_footer').empty();
    var html = `<input type="button" class="btn btn-danger btn-dlt" value="Delete" onclick="delete_record(${id},'tbl_training_type')" />`;
    $('#m_footer').append(html);
    $('#cnfModal').modal('show');
}

function delete_record(id,tbl) {
    
    $.ajax({
        type: "POST",
        url: "ajax_master.php",
        data: {
           
            action: "delete",
            id:id,
            table:tbl
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

</script>