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
                                        <h5 class="modal-title" id="termModalLabel">In-house Faculty Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" id="frm_faculty" enctype="multipart/form-data">

                                            <div class="row">

                                                <div class="col-md-5">
                                                    <label class="form-label">Name</label>
                                                    <input type="text" class="form-control" id="name" name="name">
                                                    <small></small>
                                                </div>
                                                <div class="col-md-5">
                                                    <label class="form-label">Designation</label>
                                                    <input type="text" class="form-control" id="desig" name="desig">
                                                    <small></small>

                                                </div>
                                            </div>
                                            <div class="row">
                                               
                                                <div class="col-md-5">
                                                    <label class="form-label">Cadre</label>
                                                    <input type="text" class="form-control" id="cadre" name="cader">
                                                    <small></small>

                                                </div>
                                                <div class="col-md-5">
                                                    <label class="form-label">Qualificación</label>
                                                    <input type="text" class="form-control" id="qlftn" name="qulftn">
                                                    <small></small>

                                                </div>
                                            </div>
                                            <div class="row">
                                                
                                                <div class="col-md-5">
                                                    <label class="form-label">phone</label>
                                                    <input type="text" class="form-control" id="phone" name="phone">
                                                    <small></small>

                                                </div>
                                                <div class="col-md-5">
                                                    <label class="form-label">Email</label>
                                                    <input type="text" class="form-control" id="email" name="email">
                                                    <small></small>

                                                </div>
                                            </div>

                                            <div class="row">
                                               
                                                <div class="col-md-5" id="img">
                                                    <label class="form-label">photo</label>
                                                    <input type="file" class="form-control" name="photo" id="photo">


                                                </div>
                                                <div class="col-md-5" id="img_edit" style="display:none">
                                                <label class="form-label">photo</label> <br>
                                                    <a href="#" target="_blank" id="img_name" > view image</a>
                                                    <a href="#" class="remove" id=""  onclick = "remove(this.id)" > <img src="../images/cross.png" /></a>
                                                 </div>

                                                <input type="hidden" name="action" id="action" value="add_faculty">
                                                <input type="hidden" name="update_id" id = "update_id" value = 0 >
                                                <input type="hidden" name="role" value="1">
                                            </div>

                                            <button type="submit" class="btn btn-primary" name="save"
                                                id="save">Save</button>
                                        </form>

                                    </div>
                                    <div class="modal-footer">

                                        <!-- <button type="submit" class="btn btn-primary" name="submit" value="Save"
                                            id="save"
                                            onclick="add('Faculty','frm_faculty','tbl_faculty_master')">Save</button> -->
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
                                        <h4 class="card-title">Inhouse Faculty</h4>
                                    </div>
                                    <div class="col-md-6"></div>
                                    <div class="col-md-2">
                                        <input type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#termModal" value="Add New">
                                    </div>
                                </div>


                            </div>
                            <div class="card-body">
                                <div id="term2" class=" table table-responsive table-striped table-hover"
                                    style="width:95%;margin:0px auto">
                                    <table class=" term table">
                                        <thead class="" style="background: #315682;color:#fff;font-size: 11px;">

                                            <th style="">Sl No</th>

                                            <th style="text-align:center;">Name</th>
                                            <th style="text-align:center;">Designation</th>
                                            <th style="text-align:center;">Contact No</th>
                                            <th style="text-align:center;">Email</th>

                                            <th style="text-align:center;">Action</th>

                                        </thead>
                                        <tbody>
                                            <?php 
                               
                               $db = new Database();
                               $count = 0;
                               $db->select('tbl_faculty_master',"*",null,'role= 1',null,null);
                              // print_r( $db->getResult());
                               foreach($db->getResult() as $row){
                                   //print_r($row);
                                   $count++
                                   ?>
                                            <tr>
                                                <td><?php echo $count; ?></td>
                                                <td><?php echo $row['name'] ?> </td>
                                                <td><?php echo $row['desig'] ?> </td>
                                                <td><?php echo $row['phone'] ?> </td>
                                                <td><?php echo $row['email'] ?> </td>
                                                <td style="text-align:center;width: 100px;">


                                                    <a href="#" style="color:#4164b3" class="edit"
                                                        id="<?php echo $row['id']; ?>" onclick="edit(this.id)"><i
                                                            class="far fa-edit " style="font-size:1.5rem;"></i></a>
                                                    &nbsp;
                                                    <label class="switch">
                                                        <input type="checkbox" id=<?php echo $row['id']; ?>
                                                            class="chk_<?php echo $row['id']; ?>"
                                                            <?php echo ($row['status'] == 1)?'checked':'' ?>>
                                                        <span class="slider round"
                                                            id="status_<?php echo $row['id']; ?>">
                                                            <?php echo ($row['status'] == 1)?'active':'inactive' ?></span>

                                                    </label>

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
                        <h5 class="modal-title" id="m_title" style="text-align:center;">Delete Faculty Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="warning">

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
const nameE1 = document.querySelector('#name');
const desigE1 = document.querySelector('#desig');

const cadreE1 = document.querySelector('#cadre');
const qlftnE1 = document.querySelector('#qlftn');
const phoneE1 = document.querySelector('#phone');
const emailE1 = document.querySelector('#email');

$('input[type="checkbox"]').click(function() {


    id = $(this).attr('id');

    if ($(this).is(':checked')) {

        $(`#status_${id}`).text('active');
        cnfBox(id, 'active');
    } else {
        cnfBox(id, 'inactive')
        $(`#status_${id}`).text('inactive');
    }

})

$('#term_id').on('change', function() {
    var term_id = $(this).val();
    // alert(term_id);

    $.ajax({
        type: "POST",
        url: "ajax_master.php",

        data: {
            term_id: term_id,
            table: "tbl_paper_master",
            action: "select"
        },
        success: function(res) {
            //console.log(res);
            $('#paper_id').html(res);
        }
    })

})
$('#frm_faculty').on('submit', function(e) {
    e.preventDefault();
    
    let isFormValid ;
    let update_id =  $('#update_id').val();
    console.log(update_id);

    // validate forms
    let isNameValid = checkTextField(nameE1),
        isDesigE1Valid = checkTextField(desigE1),
        isCaderValid = checkTextField(cadreE1),
        isQlftnValid = checkTextField(qlftnE1),
        isPhoneValid = checkPhone(phoneE1),
        isEmailE1Valid = checkEmail(emailE1);
    
        if(update_id == 0){
            isFormValid = isNameValid &&
            isDesigE1Valid &&
            isCaderValid &&
            isQlftnValid &&
            isPhoneValid &&
            isEmailE1Valid;
        }else{
            isFormValid = isNameValid &&
            isDesigE1Valid &&
            isCaderValid &&
            isQlftnValid ;
           
        }
    

    if (isFormValid) {
        $.ajax({
            type: "POST",
            url: "ajax_master.php",

            data: new FormData(this),
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            success: function(res) {
                console.log(res);
                let elm = res.split('#');
            if (elm[0] == "success") {
                sessionStorage.message = 'Faculty' + ' ' + elm[1];
                sessionStorage.type = "success";
                location.reload();
            }
            else{
                sessionStorage.message = 'Faculty' + ' ' + elm[1];
                sessionStorage.type = "error";
                location.reload();
            }

            }
        })
    }

    //$('#frm_faculty').submit();

})



function edit(id) {

    $('#img').hide();
//alert(id);
    $.ajax({
        type: "POST",
        url: "ajax_master.php",
        dataType: "json",
        data: {
            action: "edit",
            table: "tbl_faculty_master",
            edit_id: id

        },
        success: function(res) {
            console.log(res);
            res.map((data) => {

                    if(data.image == ''){
                        $('#img').show();
                        $('#img_edit').hide();
                    }
                    else{
                        $('#img').hide();
                        $('#img_edit').show();
                    }

                    $('#update_id').val(data.id);
                    $('#name').val(data.name);
                    $('#desig').val(data.desig);
                    $('#qlftn').val(data.qulftn);
                    $('#cadre').val(data.cader);

                    $('#phone').val(data.phone);
                    $('#email').val(data.email);
                    $('a#img_name').attr('href',`../images/faculty/${data.image}`);
                    $('a.remove').attr('id',data.id);
                    $('#action').val('edit_faculty');
                    
                    $('#save').html('Update');
                    $('#save').attr('id', 'update');
                    $('#termModal').modal('show');
                }

            )

        }
    })
}

function cnfBox(id, status) {
    //alert(id);
    console.log(status);
    let title = (status == 'active') ? 'Active Record' : 'Inactive Record';

    $('#m_footer').empty();
    $('#m_title').empty();
    $('#m_body').empty();

    $('#m_title').append(title);
    $('#m_body').append(`Are you sure you want to ${status} this Record? `);

    var html =
        `<input type="button" class="btn btn-danger btn-dlt" value= "Accept" onclick="delete_record(${id},'${status}','tbl_faculty_master')" />`;
    $('#m_footer').append(html);
    $('#cnfModal').modal('show');
}

function delete_record(id, status, tbl) {
    let sts = status;
    let status_value = (status == 'active') ? '1' : '0';
    $.ajax({
        type: "POST",
        url: "ajax_master.php",
        data: {

            action: "ch_active",
            id: id,
            status_value: status_value,
            table: tbl
        },
        success: function(res) {
            console.log(res);
            if (res == "success") {
                sessionStorage.message = `record ${sts} successfully`;
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


function remove(id){
    //alert(id);
    $.ajax({
        type:'POST',
        url:'ajax_master.php',
        data:{action:"remove_image",id:id},
        success: function(res){
            console.log(res);
            let elm = res.split('#');
            //console.log(elm[0]);
            if (elm[0] == "success") {
                //print_r$("#email_div").load(" #email_div");
                //location.reload();
                $('#img').show();
                $('#img_edit').hide();

            }
        }
    })
}
</script>