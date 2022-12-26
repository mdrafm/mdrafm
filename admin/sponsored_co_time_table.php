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


            <div class="content">

                <div class="row" style="margin-top:50px">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"></h4>

                            </div>
                            <div class="card-body">
                                <div id="term2" class=" table table-responsive table-striped table-hover"
                                    style="width:95%;margin:0px auto">
                                    <table class=" term table">
                                        <thead class="" style="background: #315682;color:#fff;font-size: 11px;">

                                            <th>Sl No</th>
                                           
                                            <th style="text-align:center;">Program Name</th>
                                            <th style="text-align:center;">From Date</th>
                                            <th style="text-align:center;">To Date</th>
                                            <th style="text-align:center;">View</th>
                                            <th style="text-align:center;">Add Session</th>
                                            <th style="text-align:center;">Action</th>

                                        </thead>
                                        <tbody>
                                            <?php 
                               
                               $db = new Database();
                               $count = 0;
                               $sql = "SELECT * FROM `tbl_short_program_master` WHERE course_co_officer = (SELECT id FROM `tbl_faculty_master` WHERE phone = '".$_SESSION['username']."')";
                               $db->select_sql($sql);
                              // print_r( $db->getResult());
                               foreach($db->getResult() as $row){
                                   //print_r($row);
                                   $count++;
                                   $from_dt = $row['start_date'];
                                   $to_dt = $row['end_date'];
                                   $prg_name = $row['prg_name'];

                                   ?>
                                            <tr>
                                                <td><?php echo $count; ?></td>
                                                <td style="text-align:center;"><?php echo $row['prg_name']; ?> </td>
                                                <td style="text-align:center;"><?php echo date("d/m/Y", strtotime($row['start_date'])); ?> </td>
                                                <td style="text-align:center;"><?php echo date("d/m/Y", strtotime($row['end_date'])); ?> </td>
                                                <td style="text-align:center;">

                                                     <input type="button" class="btn " style="background:#3292a2"
                                                        name="send" onclick="datapost('view_sponsered_time_table.php',{id: <?php echo $row['id'] ?> ,prog_name:<?php echo "'$prg_name'"  ?>,from_dt:<?php echo "'$from_dt'"  ?>,to_dt:<?php echo "'$to_dt'" ?> })" value="View" /> 
                                                     
                                                    
                                                </td>
                                                <td style="text-align:center;">

                                                    <input type="button" class="btn " style="background:#3292a2"
                                                        name="send"
                                                        onclick="datapost('add_sponsored_time_table.php',{id: <?php echo $row['id'] ?> ,prog_name:<?php echo "'$prg_name'"  ?>,from_dt:<?php echo "'$from_dt'"  ?>,to_dt:<?php echo "'$to_dt'" ?> })"
                                                        value="Edit Session" />
                                                </td>

                                                <td style="text-align:center;">
                                                <?php
                                                       switch ($row['status']) {
                                                           case '0':
                                                               ?>

                                                    <a href="#" style="color:#4164b3" class="edit"
                                                        id="<?php echo $row['id']; ?>" onclick="edit(this.id)"><i
                                                            class="far fa-edit " style="font-size:1.5rem;"></i></a>
                                                    &nbsp;
                                                    <a href="#" style="color:#e50c0c" id="<?php echo $row['id']; ?>"
                                                        onclick="cnfBox(<?php echo $row['id']; ?>)"><i
                                                            class="far fa-trash-alt "
                                                            style="font-size:1.5rem;"></i></i></a><br>

                                                    <input type="button" class="btn " style="background:rgb(68 162 50);"
                                                        name="send" id="<?php echo $row['id']; ?>"
                                                        onclick="sendToApprove(this.id,'tbl_time_table_range')"
                                                        value="Send To Approve" />

                                                        <?php
                                                               break;
                                                               case '1':
                                                                   echo "Sent To Course Director For Approval";
                                                                   break;
                                                                case '2':
                                                                echo "Approved By Course Director ";
                                                                break;
                                                                case '3':
                                                                    echo " <p> ". $row['remark']." </p>";
                                                                    break;
                                                           
                                                           default:
                                                               # code...
                                                               break;
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


function add(str, frm, tbl) {


    var update_id = $('#update_id').val();
    //console.log(update_id);
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
            table: "tbl_time_table_range",
            edit_id: id

        },
        success: function(res) {
            console.log(res);
            res.map((data) => {

                    $('#update_id').val(data.id);
                    $('#program').val(data.program_id);

                    $('#from_dt').val(data.from_dt);
                    $('#to_dt').val(data.to_dt);
                    $('#type').val(data.type);
                    $('#tbl_id').val(data.id);
                    $('#prog_id').val(data.program_id)

                    $.ajax({
                        type: "POST",
                        url: "ajax_master.php",
                        data: {

                            action: "timeTable_date",
                            table_name: data.id

                        },
                        success: function(res) {
                            console.log(res);
                            $('#t_date').html(res);

                        }
                    })
                    
                    $('#day_wise').show();
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
        `<input type="button" class="btn btn-danger btn-dlt" value="Delete" onclick="delete_record(${id},'tbl_time_table_range')" />`;
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

function sendToApprove(id, tbl) {
    if (confirm(' You want to Send this Program to Course Director For Approval')) {
        $.ajax({
            type: "POST",
            url: "ajax_master.php",
            data: {

                action: "timeTable_approval",
                id: id,
                table: tbl
            },
            success: function(res) {
                console.log(res);
                if (res == "success") {
                    sessionStorage.message = " Successfully Send to Director for Approval";
                    sessionStorage.type = "success";
                    location.reload();
                }
            }
        })
    } else {
        return false;
    }
}

function datapost(path, params, method) {
    //alert(path);
    method = method || "post"; // Set method to post by default if not specified.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);
    for (var key in params) {
        if (params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);
            form.appendChild(hiddenField);
        }
    }
    document.body.appendChild(form);
    form.submit();
}
</script>