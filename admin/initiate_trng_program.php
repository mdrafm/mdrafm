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
                                        <h4 class="card-title">Assign  Tranning Program  in Batch And Email </h4>
                                    </div>

                                </div>


                            </div>
                            <div class="card-body">
                                <div class="row" style="margin-top:20px;">
                                   <div class="col-md-5">
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label><strong>Select Program</strong></label>
                                            </div>
                                            <div class="col-md-7">
                                                <select class="custom-select mr-sm-2" name="program" id="prgram_id">
                                                    <option value="0" selected>Select Program</option>
                                                    <?php 
                                                        
                                                        $count = 0;
                                                        $db->select('tbl_program_master',"*",null," status ='approve'",null,null);
                                                        // print_r( $db->getResult());
                                                        foreach($db->getResult() as $row){
                                                            //print_r($row);
                                                            $count++
                                                        ?>
                                                    <option value="<?php echo $row['id'] ?>">
                                                        <?php echo $row['prg_name'] ?>
                                                    </option>

                                                    <?php 
                                                        }
                                                        ?>
                                                </select>
                                            </div>


                                        </div>
                                    </div>
                                <div class="col-md-5">
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label><strong>Select batch</strong></label>
                                            </div>
                                            <div class="col-md-7">
                                                <select class="custom-select mr-sm-2" name="batch" id="batch_id">
                                                    <option selected>Select Batch</option>
                                                    <?php 
                                                        
                                                        $count = 0;
                                                        //$db->select('tbl_batch_master',"*",null,null,null,null);
                                                        $sql = "SELECT DISTINCT(batch_id) as batch_id, b.batch_name,b.mail_status,b.batch_year FROM `tbl_new_recruite` n
                                                                  JOIN `tbl_batch_master`b ON n.batch_id = b.id 
                                                                  WHERE n.fin_status=1 AND b.mail_status !=1 AND b.program_id = 0";
                                                        $db->select_sql($sql);
                                                        // print_r( $db->getResult());
                                                        foreach($db->getResult() as $row){
                                                            //print_r($row);
                                                            $count++
                                                        ?>
                                                    <option value="<?php echo $row['batch_id'] ?>">
                                                        <?php echo $row['batch_name'].' - '.$row['batch_year'] ?>
                                                    </option>

                                                    <?php 
                                                        }
                                                        ?>
                                                </select>
                                            </div>


                                        </div>
                                    </div>
                                   
                                  
                                    <div class="col-md-2">
                                        <input type="button" class="btn btn-primary" id="save" value="Add" onclick="add_program()" style="margin-top: 0px" />
                                    </div>
                                </div>
                                
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
                                            <th style="text-align:center;">Program Name</th>
                                            <th style="text-align:center;">Batch Name</th>
                                            <th style="text-align:center;">Tranee List</th>
                                            <th style="text-align:center;">Mail Draft</th>
                                            <th style="text-align:center;">Action</th>


                                        </thead>
                                        <tbody>
                                            <?php 
                               
                              
                               $count = 0;
                               $db->select('tbl_batch_master',"*",null,"program_id !='' ",null,null);
                              // print_r( $db->getResult());
                               foreach($db->getResult() as $row){
                                   //print_r($row);
                                   $count++
                                   ?>
                                            <tr>
                                                <td><?php echo $count; ?></td>
                                               
                                                <td>
                                                   
                                                    <?php 
                                                        $db->select_one('tbl_program_master',"prg_name",$row['program_id']);
                                                        
                                                        foreach($db->getResult() as $row1){
                                                            echo $row1['prg_name'];
                                                        }
                                                                
                                                                
                                                     ?>
                                                </td>
                                                <td style="text-align:center;"><?php echo $row['batch_name'].' - '.$row['batch_year'] ?></td>
                                                <td style="text-align:center;">
                                                   <input type="text" class="btn " style="background:#3292a2"
                                                        name="send" onclick="traneeList(<?php echo $row['id']; ?>)" value="View Tranee List" />
                                                </td>
                                                <td> 
                                                    <?php
                                                      if($row['mail_status'] == 1){
                                                        ?>
                                                          <input type="text" class="btn " style="background:rgb(4 71 147);"  value="Email Already Sent" />
                                                        
                                                          <?php
                                                      }
                                                      else{
                                                          ?>
                                                          <input type="text" class="btn " style="background:#3292a2"
                                                        name="send" onclick="email_draft(<?php echo $row['program_id']; ?>,<?php echo $row['id']; ?>)" value="Email" />
                                                          <?php
                                                      }
                                                    ?>
                                                    
                                                </td>
                                                <td style="text-align:center;">

                                                    <a href="#" style="color:#4164b3; display: <?php echo ($row['mail_status'] == 1)?'none':'' ?>" class="edit"
                                                        id="<?php echo $row['id']; ?>" onclick="edit(this.id)"><i
                                                            class="far fa-edit " style="font-size:1.5rem;"></i></a>
                                                    &nbsp;
                                                    

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
            <div class="modal-content"  style="width:200%; margin:20px -150px">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="m_title" style="text-align:center;">Tranee List </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        
                        <div id="m_body"></div>
                    </div>
                    <div class="modal-footer" id="m_footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- msgBox Modal Modal HTML -->
    <div id="emailModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content"  style="width:130%; margin:120px -60px">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="m_title" style="text-align:center;">Email Login Credentials to Tranee </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                            <div class="form-group">
                                <label> Subject :   </label>
                                <input type="text" class="form-control col-sm-8" name="subject" id="subject"  placeholder="Enter subject">
                                                           
                            </div>
                             <div class="form-group">
                                <label> Email Content :   </label>
                                <textarea  class="form-control" name="email_body" id="email_body" rows="5" style="border: 1px solid black;max-height: 140px;" ></textarea>
                            </div>
                            <div class="form-group">
                            <label> Attachments :   </label>
                            <div id="attatchment"></div>
                            </div>
                       
                    </div>
                    <div class="modal-footer" id="mailbtn">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- msgBox Modal Modal HTML -->
    <div id="viewTraneeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content"  style="width:175%; margin:120px -60px">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="m_title" style="text-align:center;">Tranee list </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                            
                            <div id="view_tranee"></div>
                        
                       
                    </div>
                    <div class="modal-footer" id="mailbtn">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="button" class="btn btn-success" value="Save" onclick="save_tranee()" />

                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include('common_script.php') ?>

</body>

</html>

<script type="text/javascript">
    function email_draft(program_id,batch_id){
      
       $('#attatchment').html('');
       $('#mailbtn').html('');
        $.ajax({
            type: 'POST',
            url:"ajax_master.php",
            data: { action: "email_docs",program_id:program_id},
            success: function(res){
                console.log(res);
                $('#attatchment').html(res);
                var html =
                `<input type="button" class="btn btn-info btn-dlt" value="send mail" onclick="send_mail(${batch_id},${program_id})" /> <br>
                <div class="loader">
                  <img src="assets/img/loader.gif" alt="Loading" style="width: 300px;height: 90px;"/>
                </div>`;
                $('#mailbtn').append(html);
                $('#emailModal').modal('show');
            }

        });
    }

    function send_mail(batch_id,program_id){
        if(confirm('Are you sure you want to send email')){
              let subject = $('#subject').val();
              let email_body = $('#email_body').val();

            $.ajax({
                type: "POST",
                url: "send_mail.php",

                data:{subject:subject,email_body:email_body,batch_id:batch_id,program_id:program_id},
                beforeSend: function(){
                  $('.loader').show();
                //  $('#send_email').prop('disabled', true);
                },
                success: function(res) {
                console.log(res);
                 sessionStorage.message = "Email sent successfully";
                 sessionStorage.type = "success";
                 //location.reload();
                }
            })
        }else{
            return false;
        }
    }

function add_program(){
    
    let  prgram_id = $('#prgram_id').val();
    let  batch_id = $('#batch_id').val();

    $.ajax({
        type: "POST",
        url:"ajax_master.php",
        data: {action:"add_prgram_batch",program_id:prgram_id,batch_id:batch_id},
        success: function(res) {
            //console.log(res);
            if(res == 'success'){
                location.reload();
            }
        }
    })
}


function edit(id) {

$.ajax({
    type: "POST",
    url: "ajax_master.php",
    dataType: "json",
    data: {
        action: "edit",
        table: "tbl_batch_master",
        edit_id: id

    },
    success: function(res) {
        console.log(res);
        res.map((data) => {

               // $('#update_id').val(data.id);
                $('#batch_id').val(data.id);

                $('#prgram_id').val(data.program_id);
               
                $('#save').val('Update');
                $('#save').attr('id', 'update');
                $('#termModal').modal('show');
            }

        )

    }
})
}

function traneeList(id){

    $.ajax({
            type: 'POST',
            url:"ajax_search.php",
            data: { action: "tranee_list",batch_id:id},
            success: function(res){
                console.log(res);
                $('#view_tranee').html(res);
               
                $('#viewTraneeModal').modal('show');

                $("#checkAll").click(function(){
                // alert(123);
                $('input:checkbox').not(this).prop('checked', this.checked);
            });

            $('input[type="checkbox"]').on('change', function() {
                var checkedValue = $(this).prop('checked');
                // uncheck sibling checkboxes (checkboxes on the same row)
                $(this).closest('tr').find('input[type="checkbox"]').each(function() {
                    $(this).prop('checked', false);
                });
                $(this).prop("checked", checkedValue);

            });
            }

        });
}

function save_tranee(){
   
    TableData = storeTblValues();
    TableData = JSON.stringify(TableData);
    console.log(storeTblValues());

    $.ajax({
        url: 'ajax_trainee.php',
        type: "POST",
        data: {
            'tableData': TableData,
            'action':'select_tranee_Email'           
        },

        success: function(data) {
            let elm = data.split('#');
            if(elm[0] == 'success'){
                location.reload();
            }
        }
    });
}

function storeTblValues() {
    var TableData = new Array();
    $('#tranee_tbl tr').each(function(row, tr) {
        TableData[row] = {
           
            "trnee_id": $(tr).find('#tranee_id').val(),
            "send": ($(tr).find('input[type="checkbox"]:checked').val() == 1)?"1":"0",

        }
    });
    TableData.shift(); // first row will be empty - so remove
    return TableData;
}
</script>