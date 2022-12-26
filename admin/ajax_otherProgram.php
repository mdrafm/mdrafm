<?php
include 'database.php';
$db = new Database();

//   print_r($_POST);
//   print_r($_FILES);
//  exit;
$pos = array_search("action",array_keys($_POST));
$frm_data = array_splice($_POST,0,$pos);

if ( isset($_POST['action']) && $_POST['action'] == 'add'){
    
    $update_id =$_POST['update_id'];
    $frm_data['date'] = date('Y-m-d');
    
    $table = $_POST['table'];
     //update
    if ($update_id != '' ){
     
       $db->update($table, $frm_data,'id='.$update_id);
       $res = $db->getResult();
      
        if($res){
            echo "success#".$res[1];
        }
        else{
         
          echo "error#".$res[0];
        }
        
    }
    //add
    else{
        
    
        $db->insert($table, $frm_data);

       $res = $db->getResult();
       print_r($res);
      if($res){
          echo "success#".$res[1];
      }
      else{
       
        echo "error#".$res[0];
      }
    }
    
}

if ( isset($_POST['action']) && $_POST['action'] == 'update_new'){
     
    $update_id = $_POST['update_id'];
    $tbl = $_POST['tbl'];
    //$new_value =  ($_POST['new_value']== 1)?0:1;
    if($_POST['new_value']== 1){
        $new_value = 0;
    }
    else{
        $new_value = 1;
    }
    //echo $new_value;
    $db->update($tbl,['new'=>$new_value],'id ='.$update_id);
    $res = $db->getResult();
       //print_r($res);
      if($res){
          echo "success#".$res[1];
      }
      else{
       
        echo "error#".$res[0];
      }
}

if( isset($_POST['action']) && $_POST['action'] == 'upload_doc'){
    // print_r($_POST);
    
    // exit;
    $title = trim($_POST['title']);
    $active_dt = $_POST['active_dt'];
    $in_active_dt = $_POST['in_active_dt'];
    $date = date('Y-m-d');
    $tbl = $_POST['tbl'];
    $update_id = $_POST['update_id'];
    if(isset($_POST['descr'])){
        $descr = trim($_POST['descr']);
    }
    if($_POST['update_id']==''){
        if(isset($_FILES['file'])){

            $filename = strtolower(basename($_FILES['file']['name']));
            $ext = substr($filename, strrpos($filename, '.') + 1);
           
            $md_referenceno= gen_uuid();
            $ext=".".$ext;
            $new_filename = '../doc/ongoing/'. $md_referenceno . $ext;
            $doc_name = $md_referenceno . $ext;
           
            if(move_uploaded_file($_FILES['file']['tmp_name'],$new_filename)){
          
               $db->insert_sql("INSERT INTO $tbl (`title`, `descr_doc`, `active_dt`, `in_active_dt`, `date`) 
                    VALUES ('$title', '$doc_name', '$active_dt', '$in_active_dt', '$date');");
               if($db->getResult()){
                   echo "success#Ongoing Program uploaded Successfully";
               }
               else{
                 //print_r($db->getResult());
                 echo "error#".$res[0];
               }
            }
        }else{
            $db->insert_sql("INSERT INTO $tbl (`title`, `descr`, `active_dt`, `in_active_dt`, `date`) 
                    VALUES ('$title', '$descr', '$active_dt', '$in_active_dt', '$date');");
               if($db->getResult()){
                   echo "success#Ongoing Program uploaded Successfully";
               }
               else{
                 //print_r($db->getResult());
                 echo "error#".$res[0];
               }
        }
    }else{

        if(isset($_FILES['file'])){

            $filename = strtolower(basename($_FILES['file']['name']));
            $ext = substr($filename, strrpos($filename, '.') + 1);
           
            $md_referenceno= gen_uuid();
            $ext=".".$ext;
            $new_filename = '../doc/ongoing/'. $md_referenceno . $ext;
            $doc_name = $md_referenceno . $ext;
           
            if(move_uploaded_file($_FILES['file']['tmp_name'],$new_filename)){
          
            //    $db->insert_sql("INSERT INTO $tbl (`title`, `descr_doc`, `active_dt`, `in_active_dt`, `date`) 
            //         VALUES ('$title', '$doc_name', '$active_dt', '$in_active_dt', '$date');");
            $db->update($tbl,['title'=>$title,'descr_doc'=>$doc_name,'active_dt'=>$active_dt,'in_active_dt'=>$in_active_dt,'date'=>$date],'id ='.$update_id);
               if($db->getResult()){
                   echo "success#Ongoing Program update Successfully";
               }
               else{
                 //print_r($db->getResult());
                 echo "error#".$res[0];
               }
            }
        }else{
            //   $db->insert_sql("INSERT INTO $tbl (`title`, `descr`, `active_dt`, `in_active_dt`, `date`) 
            //         VALUES ('$title', '$descr', '$active_dt', '$in_active_dt', '$date');");
              $db->update($tbl,['title'=>$title,'descr'=>$descr,'active_dt'=>$active_dt,'in_active_dt'=>$in_active_dt,'date'=>$date], 'id ='.$update_id);
               if($db->getResult()){
                   echo "success#Ongoing Program update Successfully";
               }
               else{
                 //print_r($db->getResult());
                 echo "error#".$res[0];
               }
        }
    }
    //print_r($_FILES['file']);
    
    
   
    
  }

  if( isset($_POST['action']) && $_POST['action'] == 'edit'){
  
    $edit_id = $_POST['edit_id'];
    $table = $_POST['table'];

    $db->select($table,"*",null,"id =".$edit_id,null,null);
     $res = $db->getResult();
     //print_r($res);
     echo json_encode($res);
  }

  if( isset($_POST['action']) && $_POST['action'] == 'remove_doc'){
  
    $remove_id = $_POST['id'];
    $table = $_POST['table'];
    
    $db->select($table,"descr_doc",null,"id =".$remove_id,null,null);
    $res =  $db->getResult();
    foreach($res as $row1){
        
        $file_path = "/mdrafm/doc/ongoing/".$row1['descr_doc'];
        $path = $_SERVER['DOCUMENT_ROOT'].$file_path;
        //  echo $path;
        //  exit;
        if($path)
            {
                unlink($path);
                $db->update($table,["descr_doc"=> ''],$remove_id);
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

  if( isset($_POST['action']) && $_POST['action'] == 'remove_img'){
  
    $remove_id = $_POST['id'];
    $new_photo = $_POST['new_photo'];
    $imgId = $_POST['imgId'];
    
    $table = $_POST['table'];
    
    
        
        $file_path = "/mdrafm/images/event_images/".$imgId;
        $path = $_SERVER['DOCUMENT_ROOT'].$file_path;
          //echo $path;
        //  exit;
        if($path)
            {
               
                unlink( $path );

                $db->update($table,["images"=> $new_photo], "id =".$remove_id);
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

  if( isset($_POST['action']) && $_POST['action'] == 'view'){

       $id = $_POST['id'];
       $table = $_POST['table'];
       $db->select($table,"*",null,"id =".$id,null,null);
       $res =  $db->getResult();
       foreach($res as $row){
        //print_r($row);
        ?>
          <div class="row">
              <div class="col-md-4">
                  <label for="title">Title</label>
              </div>
              <div class="col-md-8">
                  <div> <?php echo  $row['title'] ?> </div>
              </div>
          </div>
          <div class="row">
              <div class="col-md-4">
                  <label for="title">Description</label>
              </div>
              <?php
                  if($row['descr_doc']==''){
                      ?>
                        <div> <?php echo $row['descr']; ?> </div>
                      <?php
                  }else{
                      ?>
                        <a href= '../doc/ongoing/<?php echo $row['descr_doc']; ?>' target="_blank" >document <img src="../images/document_pdf.png" /></a>
                                 
                      <?php
                  }
              ?>
          </div>
        <?php
       }
  }

  if( isset($_POST['action']) && $_POST['action'] == 'eventImages'){
       $image_name = array();
       $event_id = $frm_data['update_id'];
      // print_r($frm_data);
    if(is_array($_FILES)) {
        foreach ($_FILES['evntsImage']['name'] as $name => $value){
            if(is_uploaded_file($_FILES['evntsImage']['tmp_name'][$name])) {

                $filename = strtolower(basename($_FILES['evntsImage']['name'][$name]));
                $ext = substr($filename, strrpos($filename, '.') + 1);
            
                $md_referenceno= gen_uuid();
                $ext=".".$ext;
                $targetPath = '../images/event_images/'. $md_referenceno . $ext;
                $doc_name = $md_referenceno . $ext;
             
                $sourcePath = $_FILES['evntsImage']['tmp_name'][$name];
               // $targetPath = "images/".$_FILES['evntsImage']['name'][$name];
               if(move_uploaded_file($sourcePath,$targetPath)) {
                    $image_name[] = $doc_name;
               }

            }
        }
    }
   // print_r($image_name);
    $image = implode(" , ",$image_name);

                 $db->select_one('tbl_other_event','images',$event_id);

                    foreach($db->getResult() as $row){
                        if($row['images'] == ''){
                            $db->update('tbl_other_event',["images"=>$image] ,'id='.$event_id);
                            
                            $res = $db->getResult();
                            
                                if($res){
                                    echo "success#".$res[1];
                                }
                                else{
                                
                                echo "error#".$res[0];
                                }
                        }
                        else{
                           
                            $new_image = $row['images'].','.$image;

                            $db->update('tbl_other_event',["images"=>$new_image] ,'id='.$event_id);
                            
                            $res = $db->getResult();
                            
                                if($res){
                                    echo "success#".$res[1];
                                }
                                else{
                                
                                echo "error#".$res[0];
                                }

                        }
                    }
  }
  
function gen_uuid() 
{ 
      $s = strtoupper(md5(uniqid(date("YmdHis"),true))); 
       $guidText =substr($s,0,4)."-".substr($s,4,4)."-" ;
       
       $date=date("his");
     return "mdrafm-".$guidText.$date;
  }

?>