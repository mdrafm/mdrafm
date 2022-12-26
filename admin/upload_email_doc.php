<?php
 include 'database.php';
 $db = new Database();
  // print_r($_POST);
  // print_r($_FILES);
  // exit;
if (isset($_POST['action']) && $_POST['action'] == 'email_div'){
     $program_id = $_POST['program_id'];

     ?>
       <!-- Nav pills -->
            <ul class="nav nav-pills" role="tablist" id="doc_nav"
                style="margin-top:20px;display:none;">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="pill" href="#home">Documents</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#menu1">Upload Documents</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#menu2">tab3</a>
                </li> -->
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div id="home" class="container tab-pane active"><br>
                    <?php
                        $db->select('tbl_email_doc',"*",null,"program_id =".$program_id,null,null);
                        foreach($db->getResult() as $row){
                            
                            $file_path_latter = ($row['latter'] != "")? "email_doc/".$row['latter']:"Not Uploaded";
                            $file_path_anx1 = ($row['anx1'] != "")? "email_doc/".$row['anx1']:"Not Uploaded";
                            $file_path_anx2 = ($row['anx2'] != "")? "email_doc/".$row['anx2']:"Not Uploaded";
                            $file_path_anx3 = ($row['anx3'] != "")? "email_doc/".$row['anx2']:"Not Uploaded";
                            ?>
                            <div class=" table table-responsive table-striped table-hover" style="width:65%;">
                                <table class=" term table">
                                  <thead class="" style="background: #315682;color:#fff;font-size: 11px;">
                                            <th style="">Sl No</th>
                                            <th style="text-align:center;">Latter</th>
                                            <th style="text-align:center;">Annexure 1</th>
                                            <th style="text-align:center;">Annexure 2</th>
                                            <th style="text-align:center;">Annexure 3</th>
                                  </thead>
                                  <tbody>
                                      <td style="text-align:center;">1</td>

                                      <td style="text-align:center;">
                                       <a href="<?php echo $file_path_latter; ?>" target="_blank" > <?php echo ($row['latter'] == '')? " Latter Not Found" : "Latter" ?></a>
                                      </td>
                                      <td style="text-align:center;">
                                       <a href="<?php echo $file_path_anx1; ?>" target="_blank" > <?php echo ($row['anx1'] == '')? " File Not Found" : "Annexure 1" ?></a>
                                      </td>
                                      <td style="text-align:center;">
                                       <a href="<?php echo $file_path_anx2; ?>" target="_blank" >  <?php echo ($row['anx2'] == '')? " File Not Found" : "Annexure 2" ?></a>
                                      </td>
                                      <td style="text-align:center;">
                                       <a href="<?php echo $file_path_anx3; ?>" target="_blank" >  <?php echo ($row['anx3'] == '')? " File Not Found" : "Annexure 3" ?></a>
                                      </td>
                                  </tbody>
                                </table>
                           </div>
                            <?php
                        }
                    ?>
                </div>
                <!-- menue 2 -->
                <div id="menu1" class="container tab-pane fade">
                    <form method="post" enctype="multipart/form-data">
                        <div class="row" style="margin-top:50px;">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label id="latter_name"><strong>Latter</strong></label>
                                    </div>
                                    <?php
                                        $db->select('tbl_email_doc',"*",null,"program_id =".$program_id,null,null);
                                        $res = $db->getResult();
                                        if($res){
                                            foreach($res as $row){
                                                //print_r($row);
                                                if($row['latter'] != '' ){
                                                    $file_path_latter = "email_doc/".$row['latter'];
                                                   ?>
                                                     <div class="col-md-7" id="latter_doc">
                                                        <a href="<?php echo $file_path_latter; ?>" target="_blank" >latter <img src="../images/document_pdf.png" /></a>
                                                        <a href="#" class="remove" id="<?php echo $row['id'] ?>"  onclick = "remove(this.id,'latter')" > <img src="../images/cross.png" /></a>
                                                     </div>
                                                     <div class="col-md-2" style="margin-top:-10px;">
                                                       
                                                        <input type="button" class="btn btn-info" id="latter_btn" style="display:none;"
                                                            onclick="upload_email_doc('latter')" value="Upload">
                                                       
                                                    </div>
                                                   <?php
                                                }
                                                else{
                                                    ?>
                                                     <div class="col-md-7" id="latter_doc">
                                                            <div class="col-md-9">
                                                                <input type="file" name="latter" id="latter"
                                                                    class="form-control"
                                                                    style="opacity: 1;position: unset;height: 85%;border-radius: 5px;">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div id="latter_view"></div>
                                                            </div>
                                                            
                                                     </div>
                                                     <div class="col-md-2" style="margin-top:-10px;">
    
                                                                <input type="button" class="btn btn-info"
                                                                onclick="upload_email_doc('latter')" value="Upload">
                                                            </div>
                                                    <?php
                                                }
                                            }
                                        }else{
                                             
                                            ?>
                                                     <div class="col-md-7" id="latter_doc">
                                                            <div class="col-md-9">
                                                                <input type="file" name="latter" id="latter"
                                                                    class="form-control"
                                                                    style="opacity: 1;position: unset;height: 85%;border-radius: 5px;">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div id="latter_view"></div>
                                                            </div>
                                                            
                                                     </div>
                                                     <div class="col-md-2" style="margin-top:-10px;">
    
                                                                <input type="button" class="btn btn-info"
                                                                onclick="upload_email_doc('latter')" value="Upload">
                                                            </div>
                                                    <?php
                                        }
                                        
                                    ?>
                                   
                                   
                                    

                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top:10px;">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label id="latter_name"><strong>Annexure 1</strong></label>
                                    </div>
                                    <?php
                                        $db->select('tbl_email_doc',"*",null,"program_id =".$program_id,null,null);
                                        foreach($db->getResult() as $row){
                                            //print_r($row);
                                            if($row['anx1'] != '' ){
                                                $file_path_latter = "email_doc/".$row['anx1'];
                                               ?>
                                                 <div class="col-md-7" id="latter_doc">
                                                    <a href="<?php echo $file_path_latter; ?>" target="_blank" >Annexure 1 <img src="../images/document_pdf.png" /></a>
                                                    <a href="#" class="remove" id="<?php echo $row['id'] ?>"  onclick = "remove(this.id,'anx1')" > <img src="../images/cross.png" /></a>
                                                 </div>
                                                 <div class="col-md-2" style="margin-top:-10px;">
                                                   
                                                    <input type="button" class="btn btn-info" id="latter_btn" style="display:none;"
                                                        onclick="upload_email_doc('anx1')" value="Upload">
                                                   
                                                </div>
                                               <?php
                                            }
                                            else{
                                                ?>
                                                 <div class="col-md-7" id="latter_doc">
                                                        <div class="col-md-9">
                                                            <input type="file" name="anx1" id="anx1"
                                                                class="form-control"
                                                                style="opacity: 1;position: unset;height: 85%;border-radius: 5px;">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div id="latter_view"></div>
                                                        </div>
                                                        
                                                 </div>
                                                 <div class="col-md-2" style="margin-top:-10px;">

                                                            <input type="button" class="btn btn-info"
                                                            onclick="upload_email_doc('anx1')" value="Upload">
                                                        </div>
                                                <?php
                                            }
                                        }
                                    ?>
                                   
                                   
                                    

                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top:50px;">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label id="latter_name"><strong>Annexure 2</strong></label>
                                    </div>
                                    <?php
                                        $db->select('tbl_email_doc',"*",null,"program_id =".$program_id,null,null);
                                        foreach($db->getResult() as $row){
                                            //print_r($row);
                                            if($row['anx2'] != '' ){
                                                $file_path_latter = "email_doc/".$row['anx2'];
                                               ?>
                                                 <div class="col-md-7" id="latter_doc">
                                                    <a href="<?php echo $file_path_latter; ?>" target="_blank" >anx2 <img src="../images/document_pdf.png" /></a>
                                                    <a href="#" class="remove" id="<?php echo $row['id'] ?>"  onclick = "remove(this.id,'anx2')" > <img src="../images/cross.png" /></a>
                                                 </div>
                                                 <div class="col-md-2" style="margin-top:-10px;">
                                                   
                                                    <input type="button" class="btn btn-info" id="latter_btn" style="display:none;"
                                                        onclick="upload_email_doc('anx2')" value="Upload">
                                                   
                                                </div>
                                               <?php
                                            }
                                            else{
                                                ?>
                                                 <div class="col-md-7" id="latter_doc">
                                                        <div class="col-md-9">
                                                            <input type="file" name="anx2" id="anx2"
                                                                class="form-control"
                                                                style="opacity: 1;position: unset;height: 85%;border-radius: 5px;">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div id="latter_view"></div>
                                                        </div>
                                                        
                                                 </div>
                                                 <div class="col-md-2" style="margin-top:-10px;">

                                                            <input type="button" class="btn btn-info"
                                                            onclick="upload_email_doc('anx2')" value="Upload">
                                                        </div>
                                                <?php
                                            }
                                        }
                                    ?>
                                   
                                   
                                    

                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top:50px;">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label id="latter_name"><strong>Annexure 3</strong></label>
                                    </div>
                                    <?php
                                        $db->select('tbl_email_doc',"*",null,"program_id =".$program_id,null,null);
                                        foreach($db->getResult() as $row){
                                            //print_r($row);
                                            if($row['anx3'] != '' ){
                                                $file_path_latter = "email_doc/".$row['anx3'];
                                               ?>
                                                 <div class="col-md-7" id="latter_doc">
                                                    <a href="<?php echo $file_path_latter; ?>" target="_blank" >anx3 <img src="../images/document_pdf.png" /></a>
                                                    <a href="#" class="remove" id="<?php echo $row['id'] ?>"  onclick = "remove(this.id,'anx3')" > <img src="../images/cross.png" /></a>
                                                 </div>
                                                 <div class="col-md-2" style="margin-top:-10px;">
                                                   
                                                    <input type="button" class="btn btn-info" id="latter_btn" style="display:none;"
                                                        onclick="upload_email_doc('anx3')" value="Upload">
                                                   
                                                </div>
                                               <?php
                                            }
                                            else{
                                                ?>
                                                 <div class="col-md-7" id="latter_doc">
                                                        <div class="col-md-9">
                                                            <input type="file" name="anx3" id="anx3"
                                                                class="form-control"
                                                                style="opacity: 1;position: unset;height: 85%;border-radius: 5px;">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div id="latter_view"></div>
                                                        </div>
                                                        
                                                 </div>
                                                 <div class="col-md-2" style="margin-top:-10px;">

                                                            <input type="button" class="btn btn-info"
                                                            onclick="upload_email_doc('anx3')" value="Upload">
                                                        </div>
                                                <?php
                                            }
                                        }
                                    ?>
                                   
                                   
                                    

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
               
            </div>
     <?php
}

if (isset($_POST['action']) && $_POST['action'] == 'select_Email_attatch'){

     $prgram_id = $_POST['prgram_id'];

       $db->select('tbl_email_doc',"*",null,"program_id =".$prgram_id,null,null);
       $res =  $db->getResult();
       if($res){
            foreach($res as $row){
                if($row['latter'] !=''){
                    $file_path_latter = "email_doc/".$row['latter'];
                    ?>
                      <div class="col-md-7" id="latter_doc">
                          <div class="row">
                          <div class="col-md-5">
                            <a href="<?php echo $file_path_latter; ?>" target="_blank" >latter <img src="../images/document_pdf.png" /></a>
                          </div>
                          <div class="col-md-2">
                           <a href="#" class="remove" id="<?php echo $row['id'] ?>"  onclick = "remove(this.id,'latter')" > <img src="../images/cross.png" /></a>
                          </div>
                          </div>
                         
                         
                      </div>
                      <div class="col-md-2" style="margin-top:-10px;">
                        
                         <input type="button" class="btn btn-info" id="latter_btn" style="display:none;"
                             onclick="upload_email_doc('anx3')" value="Upload">
                        
                     </div><br>
                    <?php
                }else{
                    ?>
                    <div class="row">
                            <div class="col-md-2">latter</div>
                            <div class="col-md-5">
                                <input type="file" name="latter" id="latter" class="form-control"
                                style="opacity: 1;position: unset;height: 73%;border-radius: 5px;">
                            </div>
                            <div class="col-md-2">
                                <input type="button" class="btn btn-info btn-sm"
                                onclick="upload_email_doc('latter')" value="Upload">
                            </div>
                        </div>
                    <?php
                }
                if($row['anx1'] !=''){
                    $file_path_latter = "email_doc/".$row['anx1'];
                    ?>
                      <div class="col-md-7" id="latter_doc">
                      <div class="row">
                          <div class="col-md-5">
                            <a href="<?php echo $file_path_latter; ?>" target="_blank" >Annexure1 <img src="../images/document_pdf.png" /></a>
                          </div>
                          <div class="col-md-2">
                            <a href="#" class="remove" id="<?php echo $row['id'] ?>"  onclick = "remove(this.id,'anx1')" > <img src="../images/cross.png" /></a>
                          </div>
                      </div>
                        
                        
                      </div>
                      <div class="col-md-2" style="margin-top:-10px;">
                        
                         <input type="button" class="btn btn-info" id="latter_btn" style="display:none;"
                             onclick="upload_email_doc('anx1')" value="Upload">
                        
                     </div><br>
                    <?php
                }else{
                    ?>
                    <div class="row">
                            <div class="col-md-2">Annexure1</div>
                            <div class="col-md-5">
                                <input type="file" name="anx1" id="anx1" class="form-control"
                                style="opacity: 1;position: unset;height: 73%;border-radius: 5px;">
                            </div>
                            <div class="col-md-2">
                                <input type="button" class="btn btn-info btn-sm"
                                onclick="upload_email_doc('anx1')" value="Upload">
                            </div>
                        </div>
                    <?php
                }
                if($row['anx2'] !=''){
                    $file_path_latter = "email_doc/".$row['anx2'];
                    ?>
                      <div class="col-md-7" id="latter_doc">
                      <div class="row">
                        <div class="col-md-5">
                           <a href="<?php echo $file_path_latter; ?>" target="_blank" >Annexure2 <img src="../images/document_pdf.png" /></a>
                        </div>
                        <div class="col-md-2">
                           <a href="#" class="remove" id="<?php echo $row['id'] ?>"  onclick = "remove(this.id,'anx2')" > <img src="../images/cross.png" /></a>
                        </div>
                      </div>
                        
                        
                      </div>
                      <div class="col-md-2" style="margin-top:-10px;">
                        
                         <input type="button" class="btn btn-info" id="latter_btn" style="display:none;"
                             onclick="upload_email_doc('anx2')" value="Upload">
                        
                     </div><br>
                    <?php
                }else{
                    ?>
                    <div class="row">
                            <div class="col-md-2">Annexure2</div>
                            <div class="col-md-5">
                                <input type="file" name="anx2" id="anx2" class="form-control"
                                style="opacity: 1;position: unset;height: 73%;border-radius: 5px;">
                            </div>
                            <div class="col-md-2">
                                <input type="button" class="btn btn-info btn-sm"
                                onclick="upload_email_doc('anx2')" value="Upload">
                            </div>
                        </div>
                    <?php
                }



            }
       }else{
           ?>
             <div id="email_attatchment">
                    <form action="">
                        <div class="row">
                            <div class="col-md-2">latter</div>
                            <div class="col-md-5">
                                <input type="file" name="latter" id="latter" class="form-control"
                                style="opacity: 1;position: unset;height: 73%;border-radius: 5px;">
                            </div>
                            <div class="col-md-2">
                                <input type="button" class="btn btn-info btn-sm"
                                onclick="upload_email_doc('latter')" value="Upload">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Annexure 1</div>
                            <div class="col-md-5">
                                <input type="file" name="anx1" id="anx1" class="form-control"
                                style="opacity: 1;position: unset;height: 73%;border-radius: 5px;">
                            </div>
                            <div class="col-md-2">
                                <input type="button" class="btn btn-info btn-sm"
                                onclick="upload_email_doc('anx1')" value="Upload">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Annexure 2</div>
                            <div class="col-md-5">
                                <input type="file" name="anx2" id="anx2" class="form-control"
                                style="opacity: 1;position: unset;height: 73%;border-radius: 5px;">
                            </div>
                            <div class="col-md-2">
                                <input type="button" class="btn btn-info btn-sm"
                                onclick="upload_email_doc('anx2')" value="Upload">
                            </div>
                        </div>
                        
                    </form>
             </div>
           <?php
       }
       

}


 if (isset($_POST['action']) && $_POST['action'] == 'email_doc'){
   // print_r($_FILES);
    $type = $_POST['type'];
    $program_id = $_POST['program_id'];

     $filename = strtolower(basename($_FILES['file']['name']));
      $ext = substr($filename, strrpos($filename, '.') + 1);
     
      $md_referenceno= gen_uuid();
      $ext=".".$ext;
      $new_filename = 'email_doc/'. $md_referenceno . $ext;
      $doc_name = $md_referenceno . $ext;
      
      if(move_uploaded_file($_FILES['file']['tmp_name'],$new_filename)){
         
         $db->select('tbl_email_doc',"*",null,"program_id =".$program_id,null,null);
         $res =  $db->getResult();
         
         if( empty($res) ){
            $db->insert('tbl_email_doc', ['program_id'=>$program_id,$type=>$doc_name]);
           
            if($db->getResult()){
                echo "success#Document uploaded Successfully";
            }
            else{
              //print_r($db->getResult());
              echo "error#".$res[0];
            }
         }
         else{
            $db->update('tbl_email_doc', [$type=>$doc_name],'program_id ='.$program_id);
            if($db->getResult()){
                echo "success#Document uploaded Successfully";
            }
            else{
              //print_r($db->getResult());
              echo "error#".$res[0];
            }
         }
      }
 }

 if (isset($_POST['action']) && $_POST['action'] == 'remove_report'){
     $update_id = $_POST['id'];
     $field = $_POST['field'];

     $db->select('tbl_email_doc',"$field",null,"id =".$update_id,null,null);
      $res =  $db->getResult();
      foreach($res as $row1){
        //print_r($row1);exit;
          $file_path = "/mdrafm/admin/email_doc/".$row1[$field];
          $path = $_SERVER['DOCUMENT_ROOT'].$file_path;
          //echo $path;
          if($path)
            {
                unlink($path);
                $db->update('tbl_email_doc', [$field => "" ],'id='.$update_id);
                $res = $db->getResult();
                if($res){
                    echo "success#".$res[1];
                }
                else{
                    //print_r($db->getResult());
                    echo "error#".$res[0];
                }
            }
            else
            {
                echo "File Not Found";
                exit;
            }
      }
     
     

 }



 
function gen_uuid() 
{ 
      $s = strtoupper(md5(uniqid(date("YmdHis"),true))); 
       $guidText = 
       substr($s,0,4) . '-' . 
       substr($s,4,4)."-" ; 
       $date=date("his");
     return "mdrafm-".$guidText.$date;
  }

?>