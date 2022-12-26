<?php
include('../../admin/database.php');
$db = new Database();


if(isset($_POST['action']) && $_POST['action'] == 'add_case'){

//  print_r($_POST);
//  print_r($_FILES);
//  exit;  


 $petitioner_name = $_POST['petitioner_name'];
 $opposite_party = $_POST['opposite_party'];
 $party_name = $petitioner_name.' Versus '.$opposite_party;

 $court_name = $_POST['court_name'];

 $case_type = $_POST['case_type'];

 $case_no = $_POST['case_no'];

 $case_year = $_POST['case_year'];
 
 


 //exit;
 $order_date =  date('Y-m-d', strtotime($_POST['order_date'])); 

 $broad_area = '';

 $section_gst_act = '';
 $rule_gst_act = '';

 $court_judgement = $_POST['court_judgement'];
 $issue_in_case = $_POST['issue_in_case'];
 $govt_circular = $_POST['govt_circular'];

  
if(count($_POST['broad_area']) > 0){
   
    $broad_area = implode(',',$_POST['broad_area']);
}

if( isset($_POST['section_gst_act']) && count($_POST['section_gst_act']) > 0){
    $section_gst_act = implode(',',$_POST['section_gst_act']);
}
if( isset($_POST['rule_gst_act']) && count($_POST['rule_gst_act']) > 0){
    $rule_gst_act = implode(',',$_POST['rule_gst_act']);
}
    if($_FILES['case_file']['size'] > 0){
        $filename = strtolower(basename($_FILES['case_file']['name']));
        $ext = substr($filename, strrpos($filename, '.') + 1);
    
        $md_referenceno= gen_uuid();
        $ext=".".$ext;
        $upload_path = '../case_file/'. $md_referenceno . $ext;
        $file_name = $md_referenceno . $ext;

        $insert_sql = "INSERT INTO `tbl_gst_case_law` ( `party_name`,`petitioner_name`,`opposite_party`, `court_name`,  `order_date`, `broad_area`, `section_gst_act`, `rule_gst_act`, `govt_circular`, `issue_in_case`, `court_judgement`,`case_file`,`case_status`, `status`) 
                VALUES ( '".$party_name."','".$petitioner_name."','".$opposite_party."',  '".$court_name."',  '".$order_date."', '".$broad_area."', '".$section_gst_act."', '".$rule_gst_act."','".$govt_circular."', '".$issue_in_case."', '".$court_judgement."','".$file_name."','Draft', '1')";
    // echo $insert_sql;exit;
        $db->insert_sql($insert_sql);
        $res = $db->getResult();

        $last_id = $res[0];
        $cnt = count($case_type);
        
            for($i=0;$i<$cnt;$i++){
            // echo $i;
            $insert_ref_sql = "INSERT INTO `tbl_case_ref` (`id`, `case_id`, `case_type`, `case_no`, `case_year`) 
            VALUES (NULL,'".$last_id."','".$case_type[$i]."','".$case_no[$i]."' , '".$case_year[$i]."')";

              $db->insert_sql($insert_ref_sql);
              $res2 = $db->getResult();;
              //print_r($res2);
               // echo $case_type[$i].' , ';
            }

        if($res[0]>1){
        if(move_uploaded_file($_FILES['case_file']['tmp_name'],$upload_path)){
            echo "success#".$res[1];;
            
        }

        }else{
        
        echo "error#".$res[0];
        }
    }else{
        $insert_sql = "INSERT INTO `tbl_gst_case_law` ( `party_name`,`petitioner_name`,`opposite_party`, `court_name`,  `order_date`, `broad_area`, `section_gst_act`, `rule_gst_act`, `govt_circular`, `issue_in_case`, `court_judgement`,`case_status`, `status`) 
                VALUES ( '".$party_name."','".$petitioner_name."','".$opposite_party."',  '".$court_name."', '".$order_date."', '".$broad_area."', '".$section_gst_act."', '".$rule_gst_act."','".$govt_circular."', '".$issue_in_case."', '".$court_judgement."','Draft', '1')";
    // echo $insert_sql;exit;
        $db->insert_sql($insert_sql);
        $res = $db->getResult();
        $last_id = $res[0];
        $cnt = count($case_type);
        
            for($i=0;$i<$cnt;$i++){
            // echo $i;
            $insert_ref_sql = "INSERT INTO `tbl_case_ref` (`id`, `case_id`, `case_type`, `case_no`, `case_year`) 
            VALUES (NULL,'".$last_id."','".$case_type[$i]."','".$case_no[$i]."' , '".$case_year[$i]."')";

              $db->insert_sql($insert_ref_sql);
              $res2 = $db->getResult();;
             // print_r($res2);
               // echo $case_type[$i].' , ';
            }

        if($res[0]>1){
                echo "success#".$res[1];;

            }else{
            
            echo "error#".$res[0];
        }
    }
    

     
}

// fetch edit code
if( isset($_POST['action']) && $_POST['action'] == 'edit'){
    $edit_id = $_POST['edit_id'];
    $table = $_POST['table'];
   
    $db->select($table,"*",null,'id='.$edit_id,null,null);
    
     $res = $db->getResult();
     //print_r($res);
     echo json_encode($res);
   
 }
//remove file
 if(isset($_POST['action']) && $_POST['action'] == 'remove_case'){
    $case_id = $_POST['case_id'];
  

    $db->select("tbl_gst_case_law","case_file",null,"id = '".$case_id."' ",null,null);
    $result = $db->getResult();
    foreach($result as $case){
        $folder_path = "/mdrafm/gst_law/case_file/".$case['case_file'];
        $path =  $_SERVER["DOCUMENT_ROOT"].$folder_path;

        if($path){
            unlink($path);

            $db->update('tbl_gst_case_law', ["case_file" => "" ],'id='.$case_id);
             $res = $db->getResult();
             if($res){
                 echo "success#".$res[1];
             }
             else{
                 //print_r($db->getResult());
                 echo "error#".$res[0];
             }
        }else{
            echo "error#File Not Found";
        }
    }
 }

 // gst case 
 if(isset($_POST['action']) && $_POST['action'] == 'remove_case_ref'){
    $ref_id = $_POST['ref_id'];

    $db->delete('tbl_case_ref','id='.$ref_id);
    $res = $db->getResult();
    if($res){
        echo "success#";
    }
    else{
        //print_r($db->getResult());
        echo "error#".$res[0];
    }

 }

 if(isset($_POST['action']) && $_POST['action'] == 'update_case'){
    //  print_r($_POST);
    //  print_r($_FILES);
    //  exit;
    
    $petitioner_name = $_POST['petitioner_name'];
    $opposite_party = $_POST['opposite_party'];
    $party_name = $petitioner_name.' Versus '.$opposite_party;

     $court_name = $_POST['court_name'];

     $case_type = $_POST['case_type'];
     $update_id = $_POST['update_id'];
     $case_no = $_POST['case_no'];
     $ref_id = $_POST['ref_id'];
    
     $case_year = $_POST['case_year'];
    
     $order_date =  date('Y-m-d', strtotime($_POST['order_date'])); 
    
     $broad_area = '';
    
     $section_gst_act = '';
     $rule_gst_act = '';
    
     $court_judgement = $_POST['court_judgement'];
     $issue_in_case = $_POST['issue_in_case'];
     $govt_circular = $_POST['govt_circular'];
     
    
      
    if( isset($_POST['section_gst_act']) && count($_POST['broad_area']) > 0){
       
        $broad_area = implode(',',$_POST['broad_area']);
    }
    if( isset($_POST['section_gst_act']) && count($_POST['section_gst_act']) > 0){
        $section_gst_act = implode(',',$_POST['section_gst_act']);
    }
    if( isset($_POST['section_gst_act']) && count($_POST['rule_gst_act']) > 0){
        $rule_gst_act = implode(',',$_POST['rule_gst_act']);
    }

    //add new case ref No
    if( isset($_POST['new_case_no']) && count($_POST['new_case_no']) > 0 ){
        $new_case_type = $_POST['new_case_type'];
        $new_case_year = $_POST['new_case_year'];
        $new_case_no = $_POST['new_case_no'];

        $cnt = count($new_case_no);
        
            for($i=0;$i<$cnt;$i++){
            // echo $i;
            $insert_ref_sql = "INSERT INTO `tbl_case_ref` (`id`, `case_id`, `case_type`, `case_no`, `case_year`) 
            VALUES (NULL,'".$update_id."','".$new_case_type[$i]."','".$new_case_year[$i]."' , '".$new_case_no[$i]."')";

              $db->insert_sql($insert_ref_sql);
              $res3 = $db->getResult();
              if($res3){
                echo "success#";
              }
             // print_r($res2);
               // echo $case_type[$i].' , ';
            }


    }


    if($_FILES){

    if($_FILES['case_file']['size'] > 0){

        $filename = strtolower(basename($_FILES['case_file']['name']));
         $ext = substr($filename, strrpos($filename, '.') + 1);
        
         $md_referenceno= gen_uuid();
         $ext=".".$ext;
         $upload_path = '../case_file/'. $md_referenceno . $ext;
         $file_name = $md_referenceno . $ext;

         $db->update('tbl_gst_case_law',["party_name"=>$party_name,"petitioner_name"=>$petitioner_name,"opposite_party"=>$opposite_party,"court_name"=>$court_name,
         "order_date"=>$order_date,"broad_area"=> $broad_area,"rule_gst_act"=> $rule_gst_act,
         "section_gst_act"=> $section_gst_act,"issue_in_case"=> $issue_in_case,"court_judgement"=> $court_judgement,
         "govt_circular"=> $govt_circular,"case_file" =>$file_name,"case_status"=>"Draft"],'id='.$update_id);

         $res = $db->getResult();

         $cnt = count($ref_id);
        
         for($i=0;$i<$cnt;$i++){

           $db->update('tbl_case_ref',["case_type"=>$case_type[$i],"case_no"=>$case_no[$i],"case_year"=>$case_year[$i]],"id=".$ref_id[$i]);
           $res2 = $db->getResult();;
          
         }

        // print_r($res);
         if($res[0]==1){
            if(move_uploaded_file($_FILES['case_file']['tmp_name'],$upload_path)){
              echo "success#";
              
            }
    
         }else{
          
            echo "error1#";
         }


    }else{
        $db->update('tbl_gst_case_law',["party_name"=>$party_name,"petitioner_name"=>$petitioner_name,"opposite_party"=>$opposite_party,"court_name"=>$court_name,
        "order_date"=>$order_date,"broad_area"=> $broad_area,"rule_gst_act"=> $rule_gst_act,
        "section_gst_act"=> $section_gst_act,"issue_in_case"=> $issue_in_case,"court_judgement"=> $court_judgement,
        "govt_circular"=> $govt_circular,"case_status"=>"Draft"],'id='.$update_id);

        $ressult = $db->getResult();
        
        $cnt = count($ref_id);
        
         for($i=0;$i<$cnt;$i++){

           $db->update('tbl_case_ref',["case_type"=>$case_type[$i],"case_no"=>$case_no[$i],"case_year"=>$case_year[$i]],"id=".$ref_id[$i]);
           $res2 = $db->getResult();;
           
           if($res2[0]==1){
            echo "success#";

            }else{
            
                echo "error2#";
            }
         }

//print_r($ressult);
        if($ressult[0]==1){
            echo "success#";

        }else{
        
            echo "error2#";
        }
    }
}else{
    $db->update('tbl_gst_case_law',["party_name"=>$party_name,"petitioner_name"=>$petitioner_name,"opposite_party"=>$opposite_party,"court_name"=>$court_name,
    "order_date"=>$order_date,"broad_area"=> $broad_area,"rule_gst_act"=> $rule_gst_act,
    "section_gst_act"=> $section_gst_act,"issue_in_case"=> $issue_in_case,"court_judgement"=> $court_judgement,
    "govt_circular"=> $govt_circular,"case_status"=>"Draft"],'id='.$update_id);

     $ressult = $db->getResult();

     $cnt = count($ref_id);
        
         for($i=0;$i<$cnt;$i++){

           $db->update('tbl_case_ref',["case_type"=>$case_type[$i],"case_no"=>$case_no[$i],"case_year"=>$case_year[$i]],"id=".$ref_id[$i]);
           $res2 = $db->getResult();

           if($res2[0]==1){
            echo "success#";

            }else{
            
                echo "error2#";
            }
          
         }

     if($ressult[0]==1){
        echo "success#";

     }else{
      
        echo "error3#";
     }
}
    
       
    
         
    }

    
if(isset($_POST['action']) && $_POST['action'] == 'approval_case'){
    $case_id = $_POST['case_id'];
    $table = $_POST['table'];
 
    $db->update($table, ["case_status" => 'Pending' ],'id='.$case_id);
    $res = $db->getResult();
   // print_r($res);
    if($res){
        echo "success#".$res[1];
    }
    else{
        //print_r($db->getResult());
        echo "error#".$res[0];
    }
  }

      
if(isset($_POST['action']) && $_POST['action'] == 'final_approval_case'){
    $case_id = $_POST['case_id'];
    $table = $_POST['table'];
 
    $db->update($table, ["case_status" => 'Approved' ],'id='.$case_id);
    $res = $db->getResult();
   // print_r($res);
    if($res){
        echo "success#".$res[1];
    }
    else{
        //print_r($db->getResult());
        echo "error#".$res[0];
    }
  }
     
if(isset($_POST['action']) && $_POST['action'] == 'reject_case'){
    $case_id = $_POST['case_id'];
    $comments = $_POST['comments'];
    $table = $_POST['table'];
 
    $db->update($table, ["case_status" => 'Reject',"comments"=> $comments  ],'id='.$case_id);
    $res = $db->getResult();
   
    if($res){
        echo "success#".$res[1];
    }
    else{
        //print_r($db->getResult());
        echo "error#".$res[0];
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