<table class=" term table" id="tableid">
    <thead class="" style="background: #315682;color:#fff;font-size: 11px;">


        <th>Sl No</th>
        <th style="text-align:center;">Program</th>
        <th style="text-align:center;"> Name</th>

        <th style="text-align:center;">Phone</th>
        <th style="text-align:center;">Status</th>
        <th style="text-align:center;width: 8rem;">Action</th>
    </thead>
    <tbody>
        <?php


        $count = 0;


        $db->select(
            'tbl_trainee_info',
            "a.user_id as id,b.program_id , b.f_name,b.l_name,b.phone,a.status,a.mdrafm_status",
            " a JOIN `tbl_new_recruite` b ON a.mobile = b.phone",
            " b.program_id =" . $_POST['id'],
            null,
            null
        );
        // print_r( $db->getResult());
        foreach ($db->getResult() as $row) {

            $count++
        ?>
            <tr>

                <td><?php echo $count; ?></td>
                <td style="text-align:center;">
                    <?php
                    $db->select_one('tbl_program_master', "prg_name", $row['program_id']);
                    //print_r($db->getResult());
                    foreach ($db->getResult() as $row1) {
                        echo trim($row1['prg_name']);
                    }
                    //echo $row['trng_type']; 
                    ?>
                </td>
                <td style="text-align:center;"> <?php echo $row['f_name'] . ' ' . $row['l_name']; ?></td>

                <td style="text-align:center;"><?php echo $row['phone']; ?>
                </td>

                <td style="text-align:center;">
                    <?php
                    if ($row['mdrafm_status'] == 0) {
                        switch ($row['status']) {
                            case '0':
                                echo "Pending";
                                break;
                            case '1':
                                echo "Submited";
                                break;
                            default:
                                # code...
                                break;
                        }
                    } else {
                        echo "Approved";
                    }


                    ?>
                </td>

                <td style="text-align:center;">
                    <!-- <input type="button" class="btn btn-primary" data-toggle="modal" data-target="#termModal"
                                              value="Add New"> -->
                    <!-- <input type="button" class="btn " style="background:#3292a2"
                                                        onclick="datapost('trainee_details.php',{phone: <?php echo $row['phone'] ?> })"
                                                        value="View Details" /> -->
                    <input type="button" class="btn " style="background:#3292a2" onclick="view_trainee_dtl( <?php echo $row['phone'] ?>,<?php echo $row['mdrafm_status'] ?>,<?php echo $row['id'] ?>)" value="View Details" />
                    &nbsp;
                    <!-- <a href="#" style="color:#4164b3 ;"
                                                                class="edit_<?php echo $row['id']; ?>"
                                                                id="<?php echo $row['id']; ?>"
                                                                onclick="edit(this.id)"><i class="far fa-edit "
                                                                    style="font-size:1.5rem;"></i></a>
                                                            &nbsp;
                                                            <a href="#" style="color:#e50c0c"
                                                                id="<?php echo $row['id']; ?>"
                                                                onclick="cnfBox(<?php echo $row['id']; ?>)"><i
                                                                    class="far fa-trash-alt "
                                                                    style="font-size:1.5rem;"></i></i></a><br> -->

                    <!--Tranee Detail Modal -->
                    <!-- <div id="detailsModal_<?php echo $row['id']; ?>" class="modal fade"> -->
                    <div id="detailsModal_<?php echo $row['id']; ?>" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content" style="width:130%">
                                <form>
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="m_title" style="text-align:center;">Tranee
                                            Details
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="tranee_details">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <label for="">Name:
                                                            </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <?php echo $row['name'] ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <label for="">Sex:
                                                            </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <?php echo ($row['sex'] == 1) ? "Male" : "Femail" ?>
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
                                                            <p><?php echo $row['address'] . ',<br>' . $row['district'] . ',' . $row['state'] . ',' . $row['pin'] ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer" id="ms_footer">
                                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">

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