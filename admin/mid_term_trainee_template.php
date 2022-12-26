<table class=" term table" id="tableid">
    <thead class="" style="background: #315682;color:#fff;font-size: 11px;">


        <th>Sl No</th>
      
        <th> Name</th>
        <th> HRMS Id</th>
        <th>Designation</th>
        <th>Place of Posting</th>
        <th>Email</th>
        <th style="text-align:center;">Phone</th>
        <th style="text-align:center;width: 8rem;">Action</th>
    </thead>
    <tbody>
        <?php


        $count = 0;


        $db->select('tbl_mid_trainee_registration', "t.id,p.prg_name,t.name,t.designation,t.hrms_id,t.office_name,t.email,t.phone", 
                  " t JOIN `tbl_short_program_master` p ON t.program_id = p.id", "t.program_id =" . $_POST['id'], null, null);
        // print_r( $db->getResult());
        foreach ($db->getResult() as $row) {
           // print_r($row);
            $count++
        ?>
            <tr>

                <td><?php echo $count; ?></td>
              
                <td > <?php echo $row['name']  ?></td>
                <td > <?php echo $row['hrms_id']  ?></td>
                <td > <?php echo $row['designation']  ?></td>
                <td > <?php echo $row['office_name']  ?></td>
                <td > <?php echo $row['email']  ?></td>
                <td style="text-align:center;"><?php echo $row['phone']; ?> </td>
              

                <td style="text-align:center;">
                  
                            <a href="#" data-toggle="modal"  data-target="#detailsModal_<?php echo $row['id']; ?>" style="color:#4164b3 ;">
                              <i class="far fa-edit " style="font-size:1.5rem;"></i>
                           </a>
                            
                    &nbsp;
                    <!-- <a href="#" style="color:#e50c0c"
                        id="<?php echo $row['id']; ?>"
                        onclick="cnfBox(<?php echo $row['id']; ?>)"><i
                            class="far fa-trash-alt "
                            style="font-size:1.5rem;"></i></i></a><br> -->

                    <!--Tranee Detail Modal -->
                   
                    <div id="detailsModal_<?php echo $row['id']; ?>" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content" style="width:150%">
                            <div class="modal-header">
                                    <h5 class="modal-title" id="m_title" style="text-align:center;">Edit Trainee details</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body">
                                 <form method="post" id="frm_newTranee_update_<?php echo $row['id'] ?>" style="width:90%">
                                
                               
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong> Name</strong></label>
                                                        <input type="text" class="form-control" name="name" id="name"
                                                            placeholder="Enter Name" value="<?php echo $row['name']; ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong> HRMS Id</strong></label>
                                                        <input type="text" class="form-control" name="hrms_id" id="hrms_id" placeholder="Enter HRMS Id"
                                                        value="<?php echo $row['hrms_id']; ?>"
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                               <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong>Designation</strong></label>
                                                        <input type="text" class="form-control" name="designation"
                                                            id="designation" placeholder="Enter Designation" 
                                                            value="<?php echo $row['designation']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong>Name of the Office</strong></label>
                                                        <input type="text" class="form-control" name="office_name"
                                                            id="office_name" placeholder="Enter Name of the Office" 
                                                            value="<?php echo $row['office_name']; ?>" >
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong> Email</strong></label>
                                                        <input type="email" class="form-control" name="email" id="email"
                                                            placeholder=" Enter Email" value="<?php echo $row['email']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong> Phone</strong></label>
                                                        <input type="text" class="form-control" name="phone" id="phone"
                                                            placeholder=" Enter Phone Number" value="<?php echo $row['phone']; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                     


                                            <input type="hidden" id="update_id" value="<?php echo $row['id']; ?>">
                                          
                                    
                                </form>
                                </div>
                                <div class="modal-footer" id="m_footer">
                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                    <button type="submit" class="btn btn-primary" name="submit" value="Save"
                                            id="save"
                                            onclick="update('new tranee','frm_newTranee_update','tbl_mid_trainee_registration',<?php echo $row['id']; ?>)">Update</button>
                                </div>
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