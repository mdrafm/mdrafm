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
                                        <h5 class="modal-title" id="termModalLabel">Tranee Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <form method="post" id="frm_program">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong>Program</strong></label>
                                                        <select class="custom-select mr-sm-2" name="program_id"
                                                            id="program_id">
                                                            <option selected>Select Program</option>
                                                            <?php 
                                                                    $db = new Database();
                                                                    $count = 0;
                                                                    $db->select('tbl_program_master',"*",null,"trng_type = 2",null,null);
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
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong> Name</strong></label>
                                                        <input type="text" class="form-control" name="name" id="name"
                                                            placeholder="Enter Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong> Service No</strong></label>
                                                        <input type="text" class="form-control" name="service_No"
                                                            id="service_No" placeholder="Enter service Number">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong>Date Of Birth</strong></label>
                                                        <input type="date" class="form-control" name="dob" id="dob"
                                                            placeholder="Select DOB">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong>Sex</strong></label>
                                                        <select class="custom-select mr-sm-2" name="sex" id="sex">
                                                            <option selected>Select Sex</option>
                                                            <option value="1">Male</option>
                                                            <option value="0">Female</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong> Email</strong></label>
                                                        <input type="email" class="form-control" name="email" id="email"
                                                            placeholder=" Enter Email">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong> Phone</strong></label>
                                                        <input type="text" class="form-control" name="phone" id="phone"
                                                            placeholder=" Enter Phone Number">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label><strong> Address</strong></label>
                                                        <input type="text" class="form-control" name="address"
                                                            id="address" placeholder="Enter  Address">

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 pr-1">
                                                    <div class="form-group">
                                                        <!-- <label><strong>State</strong></label> -->
                                                        <input type="text" class="form-control" name="state" id="state"
                                                            placeholder="State">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 px-1">
                                                    <div class="form-group">
                                                        <!-- <label><strong>District</strong></label> -->
                                                        <input type="text" class="form-control" name="district"
                                                            id="district" placeholder="District">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 pl-1">
                                                    <div class="form-group">
                                                        <!-- <label><strong>Pin Code</strong></label> -->
                                                        <input type="number" class="form-control" name="pin" id="pin"
                                                            placeholder="PIN Code">
                                                    </div>
                                                </div>
                                            </div>



                                            <input type="hidden" id="update_id">
                                        </form>
                                    </div>
                                    <div class="modal-footer">

                                        <button type="submit" class="btn btn-primary" name="submit" value="Save"
                                            id="save"
                                            onclick="add('new tranee','frm_program','tbl_tranee_registration')">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-2">
                       
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header">
                               <div class="row">
                                    <div class="col-md-4">  
                                    <h4 class="card-title"> Mid Term Tranee List</h4>
                                    </div>
                                    <div class="col-md-6"></div>
                                    <div class="col-md-2">
                                     <input type="button" class="btn btn-primary" data-toggle="modal" data-target="#termModal"
                                     value="Add New">
                                    </div>
                                </div>
                               

                            </div>
                            <div class="card-body">
                                <div id="term2" class=" table table-responsive table-striped table-hover">

                                    <table class=" term table" id="tableid">
                                        <thead class="" style="background: #315682;color:#fff;font-size: 11px;">


                                            <th style="">Sl No</th>
                                            <th style="text-align:center;">Program</th>
                                            <th style="text-align:center;"> Name</th>
                                            <th style="text-align:center;"> Service Id</th>
                                            <th style="text-align:center;">Phone</th>
                                            <th style="text-align:center;">District</th>
                                            <th style="text-align:center;width: 8rem;">Action</th>
                                        </thead>
                                        <tbody>
                                            <?php 
                               
                                                
                                                $count = 0;
                                                $db->select('tbl_tranee_registration',"*",null,null,null,null);
                                                // print_r( $db->getResult());
                                                foreach($db->getResult() as $row){
                                                    //print_r($row);
                                                    $count++
                                                    ?>
                                            <tr>

                                                <td><?php echo $count; ?></td>
                                                <td style="text-align:center;">
                                                    <?php 
                                                        $db->select_one('tbl_program_master',"prg_name",$row['program_id']);
                                                        //print_r($db->getResult());
                                                    foreach($db->getResult() as $row1){
                                                        echo trim($row1['prg_name']);
                                                    }
                                                        //echo $row['trng_type']; 
                                                        ?>
                                                </td>
                                                <td style="text-align:center;"> <?php echo $row['name']?></td>
                                                <td style="text-align:center;"><?php echo $row['service_no']; ?> </td>

                                                <td style="text-align:center;"><?php echo $row['phone']; ?> </td>

                                                <td style="text-align:center;"><?php echo $row['district']; ?> </td>

                                                <td style="text-align:center;">
                                                    <!-- <input type="button" class="btn btn-primary" data-toggle="modal" data-target="#termModal"
                                           value="Add New"> -->
                                                    <a href="#" style="color:rgb(37 142 174);" data-toggle="modal"
                                                        data-target="#detailsModal_<?php echo $row['id']; ?>">
                                                        <i class="fas fa-file-alt  " style="font-size:1.5rem;"></i></a>
                                                    &nbsp;
                                                    <a href="#" style="color:#4164b3 ;"
                                                        class="edit_<?php echo $row['id']; ?>"
                                                        id="<?php echo $row['id']; ?>" onclick="edit(this.id)"><i
                                                            class="far fa-edit " style="font-size:1.5rem;"></i></a>
                                                    &nbsp;
                                                    <a href="#" style="color:#e50c0c" id="<?php echo $row['id']; ?>"
                                                        onclick="cnfBox(<?php echo $row['id']; ?>)"><i
                                                            class="far fa-trash-alt "
                                                            style="font-size:1.5rem;"></i></i></a><br>

                                                    <!--Tranee Detail Modal -->
                                                    <!-- <div id="detailsModal_<?php echo $row['id']; ?>" class="modal fade"> -->
                                                    <div id="detailsModal_<?php echo $row['id']; ?>" class="modal fade">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content" style="width:130%">
                                                                <form>
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="m_title"
                                                                            style="text-align:center;">Tranee Details
                                                                        </h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal"
                                                                            aria-hidden="true">&times;</button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="tranee_details">
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <div class="row">
                                                                                        <div class="col-md-2">
                                                                                            <label for="">Name: </label>
                                                                                        </div>
                                                                                        <div class="col-md-8">
                                                                                            <?php echo $row['name']?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <div class="row">
                                                                                        <div class="col-md-2">
                                                                                            <label for="">Sex: </label>
                                                                                        </div>
                                                                                        <div class="col-md-8">
                                                                                            <?php echo ($row['sex'] == 1)? "Male":"Femail" ?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div><br>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <div class="row">
                                                                                        <div class="col-md-2">
                                                                                            <label for="">Email:
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="col-md-10">
                                                                                            <?php echo $row['email'] ?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="row">
                                                                                        <div class="col-md-2">
                                                                                            <label for="">Phone:
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="col-md-8">
                                                                                            <?php echo $row['phone'] ?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div><br>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <div class="row">
                                                                                        <div class="col-md-2">
                                                                                            <label for="">Address:
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="col-md-10">
                                                                                            <p><?php echo $row['address'] .',<br>'.$row['district'].','.$row['state'].','.$row['pin'] ?>
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="modal-footer" id="ms_footer">
                                                                        <input type="button" class="btn btn-default"
                                                                            data-dismiss="modal" value="Cancel">

                                                                    </div>
                                                                </form>
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
                                      <input type="button" class="btn btn-primary" name="send_email" id="send_email"
                                        style="display:none" value="Send Email" />
                                        <div class="loader">
                                            <img src="assets/img/loader.gif" alt="Loading"
                                                style="width: 300px;height: 90px;float: right;" />
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

    <div class="fixed-plugin">
        <div class="dropdown show-dropdown">
            <a href="#" data-toggle="dropdown">
                <i class="fa fa-cog fa-2x"> </i>
            </a>
            <ul class="dropdown-menu">
                <li class="header-title"> Sidebar Background</li>
                <li class="adjustments-line">
                    <a href="javascript:void(0)" class="switch-trigger background-color">
                        <div class="badge-colors text-center">
                            <span class="badge filter badge-yellow" data-color="yellow"></span>
                            <span class="badge filter badge-blue" data-color="blue"></span>
                            <span class="badge filter badge-green" data-color="green"></span>
                            <span class="badge filter badge-orange active" data-color="orange"></span>
                            <span class="badge filter badge-red" data-color="red"></span>
                        </div>
                        <div class="clearfix"></div>
                    </a>
                </li>


            </ul>
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
var checkbox = $('table tbody input[type="checkbox"]');
checkbox.click(function() {
    //alert(this.value);
    var id = this.value;
    if (this.checked) {
        $('.edit_' + id).show();
        $('.send_' + id).show();
        $('#send_email').show();
    } else {
        $('.edit_' + id).hide();
        $('.send_' + id).hide();
        $('#send_email').hide();
    }

});
$('input.checkbox').not(this).prop('checked', false);

$('#send_email').click(function() {

    if (confirm('Are you sure you want to send email')) {
        var id = [];

        var TableData = [];

        $("input[type='checkbox']:checked").each(function() {
            id = $(this).val();
            var row = $(this).closest("tr")[0];

            TableData.push({
                "id": id,
                "name": row.cells[2].innerHTML,
                "program": row.cells[3].innerHTML.trim(),
                "email": row.cells[7].innerHTML,
                "phone": row.cells[8].innerHTML


            });


        });
        tabledata = JSON.stringify(TableData);

        if (id.length === 0) {
            alert("Please check atleast one checkbox  ");
        } else {
            $.ajax({
                type: "POST",
                url: "send_mail.php",

                data: "pTableData=" + tabledata,
                beforeSend: function() {
                    $('.loader').show();
                    $('#send_email').prop('disabled', true);
                },
                success: function(res) {
                    console.log(res);
                    sessionStorage.message = "Email sent successfully";
                    sessionStorage.type = "success";
                    location.reload();
                }
            })
        }
    } else {
        return false;
    }
})


function add(str, frm, tbl) {


    var update_id = $('#update_id').val();

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
            table: "tbl_new_recruite",
            edit_id: id

        },
        success: function(res) {
            console.log(res);
            res.map((data) => {

                    $('#update_id').val(data.id);
                    $('#trng_type').val(data.trng_type);

                    $('#f_name').val(data.f_name);
                    $('#l_name').val(data.l_name);
                    $('#program').val(data.program);
                    $('#dob').val(data.dob);
                    $('#category').val(data.category);
                    $('#sex').val(data.sex);
                    $('#email').val(data.email);
                    $('#phone').val(data.phone);
                    $('#roll_no').val(data.roll_no);
                    $('#district').val(data.district);


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
        `<input type="button" class="btn btn-danger btn-dlt" value="Delete" onclick="delete_record(${id},'tbl_tranee_registration')" />`;
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