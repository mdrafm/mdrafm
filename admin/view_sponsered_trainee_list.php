<!DOCTYPE html>
<html lang="en">


<head>
    <?php 
    
    include('header_link.php');
    include('../config.php');
    include 'database.php';
    $db = new Database();
    
    ?>
    <style type="text/css">
    #menu1 {
        padding: 20px;
        border-radius: 5px;
        background-color: #f2efef;
        box-shadow: rgb(0 0 0 / 2%) 0px 1px 3px 0px, rgb(27 31 35 / 15%) 0px 0px 0px 1p
    }
    </style>
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
                                        <h4 class="card-title">Trainee List </h4>
                                    </div>
                                    <div class="col-md-6"></div>
                                    <!-- <div class="col-md-2">
                                    <input type="button" class="btn btn-primary" data-toggle="modal" data-target="#termModal"
                                     value="Add New">
                                    </div> -->
                                </div>


                            </div>
                            <div class="card-body">
                                <div>
                                  <button class="btn btn-danger float-right" onclick="ExportToExcel('xlsx')">Export to excel</button>
                                </div>
                           
                                <div id="term2" class=" table table-responsive table-striped table-hover"
                                    style="width:100%;margin:0px auto">
                                    <table class=" term table" id="traineeList">
                                        <thead class="" style="background: #315682;color:#fff;font-size: 11px;">


                                            <th>Sl No</th>

                                            <th>Name</th>
                                            <th>HRMS Id</th>
                                            <th>Designation</th>
                                            <th>Place of Posting</th>
                                            <th>Email</th>
                                            <th style="text-align:center;">Phone</th>
                                            <th style="text-align:center;width: 8rem;">Status</th>
                                        </thead>
                                        <tbody>
                                            <?php


        $count = 0;

        $porg_id = $_POST["id"];
        $trng_type = $_POST["trng_type"];
        if($trng_type == 5){
            $tbl_trainne_list = 'tbl_dept_trainee_registration';
        }else{
            $tbl_trainne_list = 'tbl_mid_trainee_registration';
        }

        $db->select($tbl_trainne_list, "*", null, " trng_type = '$trng_type' AND program_id =" . $porg_id, null, null);
                  
        // print_r( $db->getResult());
        foreach ($db->getResult() as $row) {
           // print_r($row);
            $count++
        ?>
                                            <tr>

                                                <td><?php echo $count; ?></td>

                                                <td> <?php echo $row['name']  ?></td>
                                                <td> <?php echo $row['hrms_id']  ?></td>
                                                <td> <?php echo $row['designation']  ?></td>
                                                <td> <?php echo $row['office_name']  ?></td>
                                                <td> <?php echo $row['email']  ?></td>
                                                <td style="text-align:center;"><?php echo $row['phone']; ?> </td>
                                                <td>
                                                    <?php
                                                    if($trng_type == 5){
            $reg_status = $row['mdrafm_status'];
        }else{
            $reg_status = $row['mail_status'];
        }
                                                       echo ($reg_status == 1)?'Registered':'Not Registered';
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

    
    
    <?php include('common_script.php') ?>

</body>

</html>

<script type="text/javascript">
function ExportToExcel(type, fn, dl) {
       var elt = document.getElementById('traineeList');
       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('TraineeList.' + (type || 'xlsx')));
    }

</script>