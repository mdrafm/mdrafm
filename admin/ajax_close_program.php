<?php
   include 'database.php';
   $db = new Database();

   if ( isset($_POST['action']) && $_POST['action'] == 'show_program_list'){
    
    $program_type = $_POST['program_type'];
    $toDay_dt = date("Y/m/d");
    $table = '';
    switch ($program_type) {
        case '4':
           $table = 'tbl_short_program_master';
            break;
        case '5':
            $table = 'tbl_short_program_master';
                break;
        default:
        $table = 'tbl_program_master';
            break;
    }

       ?>
       <?php
        $db->select($table,"*",null,"trng_type = '".$program_type."' AND end_date < '".$toDay_dt."'  AND active = 1 ",null,null ); 
        $res = $db->getResult();  
        if($res){

                
       ?>
<table class=" term table">
    <thead class="" style="background: #315682;color:#fff;font-size: 11px;">

        <th style="width:50px;">Sl No</th>
        <th style="text-align:center;">Programm Name</th>
        <th style="text-align:center;">Duration</th>
       
        <th style="text-align:center;">Action</th>
        
    </thead>
    <tbody>
        <?php 
                            
                              
                               $count = 0;
                              
                               foreach($res as $row){
                                  
                                   $tbl = "";
                                   $count++;
                                   $from_dt = $row['start_date'];
                                   $to_dt = $row['end_date'];
                                   $prg_name = $row['prg_name'];

                                   ?>
        <tr>
            <td><?php echo $count; ?></td>
            <td style="text-align:center;"><?php echo $row['prg_name']; ?> </td>
            <td style="text-align:center;">
                <?php echo date("d-m-Y", strtotime($row['start_date'])).' - '.date("d-m-Y", strtotime($row['start_date'])) ?>
            </td>
            
            <td style="text-align:center;">

                <input type="button" style="background: rgb(19 122 111);border: 0;
                                                                                padding: 5px;
                                                                                border-radius: 3px;
                                                                                color: #fff;"
                    onclick="ViewModal(<?php echo $row['id'] ?>,<?php echo $row['trng_type'] ?>)" value="view">
                <input type="button" style="background: #bb1b09;border: 0;
                                                                            padding: 5px;
                                                                            border-radius: 3px;
                                                                            color: #fff;"
                onclick="cnfBox(<?php echo $row['id'] ?>,<?php echo $row['trng_type'] ?>)" value="Close">
                <br>
           
                     

                <div class="modal fade" id="prgram_list_<?php echo $row['id'] ?>" tabindex="-1"
                    aria-labelledby="termModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content" style="width:130%; margin:20px -100px">
                            <div class="modal-header">
                                <h5 class="modal-title" id="termModalLabel"> Short
                                    Program
                                    Detail</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <?php //sprint_r($row); ?>
                                <form>
                                    <div class="div">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-4 text-left">
                                                        <label for="">Program Name:
                                                        </label>
                                                    </div>
                                                    <div class="col-md-8 text-left">
                                                        <?php echo $row['prg_name']?>
                                                    </div>
                                                </div>
                                            </div>

                                        </div><br>
                                       
                                        <div class="row">
                                            <div class="col-md-12">

                                                <div class="row">
                                                    <div class="col-md-4 text-left">
                                                        <label for="">
                                                            Start Date:
                                                        </label>
                                                    </div>
                                                    <div class="col-md-8 text-left">
                                                        <?php echo date("d-m-Y", strtotime($row1['provisonal_Sdate']))  ?>

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-4 text-left">
                                                        <label for=""> End
                                                            Date:
                                                        </label>
                                                    </div>
                                                    <div class="col-md-8 text-left">
                                                        <?php echo date("d-m-Y", strtotime($row1['provisonal_Edate']))  ?>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </form>
                            </div>
                         
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="shortTermModalSponsored_<?php echo $row['id'] ?>" tabindex="-1"
                    aria-labelledby="termModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content" style="width:200%; margin:20px -100px">
                            <div class="modal-header">
                                <h5 class="modal-title" id="termModalLabel"> Short Sponsored
                                    Program
                                    Detail</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <?php //sprint_r($row); ?>
                                <form>
                                    <div class="div">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6 text-left">
                                                        <label for="">Program Name:
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6 text-left">
                                                        <?php echo $row['prg_name']?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6 text-left">
                                                        <label for="">Hall Name:
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6 text-left">
                                                        <?php echo $row['hall_name']?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6 text-left">
                                                        <label for="">Department Name:
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6 text-left">
                                                        <?php echo $row['dept_name']?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6 text-left">
                                                        <label for="">Department Email:
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6 text-left">
                                                        <?php echo $row['dept_email']?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6 text-left">
                                                        <label for="">Tranning Start Date:
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6 text-left">
                                                        <?php echo  date("d/m/Y", strtotime($row['start_date'])) ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6 text-left">
                                                        <label for="">Tranning End Date:
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6 text-left">
                                                        <?php echo date("d/m/Y", strtotime($row['end_date'])) ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6 text-left">
                                                        <label for="">Coordinating Officer</label>

                                                    </div>
                                                    <div class="col-md-6 text-left">
                                                        <?php
                                                         $db->select_one('tbl_faculty_master','name',$row['course_co_officer']);
                                                         foreach($db->getResult() as $faculty){
                                                            echo $faculty['name'];
                                                         }
                                                        
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                       


                                    </div>
                                </form>
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
<?php
        }else{
            echo "<p class=' text-danger' >No Program Found To Close</p>";
        }

   }

   if ( isset($_POST['action']) && $_POST['action'] == 'close_program'){
      
      $program_id = $_POST['program_id'];
      $program_type = $_POST['program_type'];
      $table = $_POST['table'];
      $msg = array();
      $db->update($table,['active'=> 0],"id=".$program_id);
      $res = $db->getResult();
      if($res[0]==1){

        $db->select("tbl_dept_trainee_registration","phone",null," program_id = '".$program_id."'  AND trng_type = '".$program_type."' AND mdrafm_status = 1 ",null,null );             
                            
        foreach($db->getResult() as $row){
           
            $db->update('tbl_user',['status'=> 0],"username=".$row['phone']);
             $res1 = $db->getResult();
             if($res1[0]==1){
                array_push($msg,'success');
             }
        }
      }
     // print_r($msg);
      if(in_array('success',$msg)){
        echo "success";
      }

   }

?>