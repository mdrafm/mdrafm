<?php

  include 'database.php';
  $db = new Database();

   //dependent select options for major subject
 if( isset($_POST['action']) && $_POST['action'] == 'other_class'){
   
   echo $other_class_id = $_POST['other_class'];
   
    $table = $_POST['table'];
    
    $db->select($table,"*",null,null,null,null);
    $res = $db->getResult();
   
    if($res){
       
       
        foreach($res as $row1){
           
         
           ?>
               <option value = <?php echo $row1['id'] ?> <?php if ( $row1['id'] == $other_class_id ){ echo 'selected';}  ?> > <?php echo $row1['name'] ?> </option>
           <?php
        }
      
    }
    else{
        //print_r($db->getResult());
        echo '<option>Paper Not Found</option>';
    }
 
}

  //select topic in subject master 

  if( isset($_POST['action']) && $_POST['action'] == 'select_topic_sub'){
    //print_r($frm_data);
   
    $subject_id = $_POST['subject_id'];
    $table = $_POST['table'];
    
    $db->select($table,"*",null,"subject_id =".$subject_id,null,null);
    $res = $db->getResult();
    
    if($res){
        echo '<option >Select Topic</option>';
       
        foreach($res as $row1){

            echo '<option value="'.$row1['id'].'">'.$row1['topic'].'</option>';
           
        }
      
    }
    else{
        //print_r($db->getResult());
        echo '<option>Topic Not Found</option>';
    }
 
}

   //dependent select options for major subject
   if( isset($_POST['action']) && $_POST['action'] == 'select_paper'){
   
     $term_id = $_POST['term_id'];
     $paper_id = $_POST['paper_id'];
     $table = $_POST['table'];
     
     $db->select($table,"DISTINCT term_id",null,"term_id =".$term_id,null,null);
     $res = $db->getResult();
    
     if($res){
       echo '<option>Select Paper</option>';
       foreach($res as $row){
         $db->select('tbl_paper_master',"*",null,'term_id='.$row['term_id'],null,null);
         foreach($db->getResult() as $row1){
          
               ?>
               <option value = <?php echo $row1['id'] ?> <?php if ( $row1['id'] == $paper_id ){ echo 'selected';}  ?> > <?php echo $row1['title'].'-'.$row1['paper_code'] ?> </option>
             <?php
         }
         
       }
     }
     else{
       
       echo '<option>Paper Not Found</option>';
     }
    
   }
   if( isset($_POST['action']) && $_POST['action'] == 'select_term_edit'){
   
    $term_id = $_POST['term_id'];
    $syllabus_id = $_POST['syllabus_id'];
    $table = $_POST['table'];
    
    $db->select($table,"DISTINCT term_id",null,"syllabus_id =".$syllabus_id,null,null);
    $res = $db->getResult();
   
    if($res){

      echo '<option value="0">Select Term</option>';
      foreach($res as $row){
       // print_r($row);
        $db->select('tbl_term_master',"*",null,'id='.$row['term_id'],null,null);
        foreach($db->getResult() as $row1){
          //print_r($row1);
              ?>
              <option value = <?php echo $row1['id'] ?> <?php if ( $row1['id'] == $term_id ){ echo 'selected';}  ?> > <?php echo $row1['term'] ?> </option>
            <?php
        }
        
      }
    }
    else{
      
      echo '<option>Term Not Found</option>';
    }
   
  }

  if( isset($_POST['action']) && $_POST['action'] == 'select_paper_edit'){
   
    $id = $_POST['id'];
    $paper_id = $_POST['paper_id'];
    $table = $_POST['table'];
    
    $db->select($table,"DISTINCT term_id",null,"id =".$id,null,null);
    $res = $db->getResult();
   
    if($res){
      echo '<option value = "0">Select Paper</option>';
      foreach($res as $row){
        $db->select('tbl_paper_master',"*",null,'status = 1 AND term_id ='.$row['term_id'],null,null);
        foreach($db->getResult() as $row1){
         //print_r($row1);
              ?>
              <option value = <?php echo $row1['id'] ?> <?php if ( $row1['id'] == $paper_id ){ echo 'selected';}  ?> > <?php echo $row1['title'].'-'.$row1['paper_code'] ?> </option>
            <?php
        }
        
      }
    }
    else{
      
      echo '<option>Paper Not Found</option>';
    }
   
  }

 if( isset($_POST['action']) && $_POST['action'] == 'select_subject'){
   
    $paper_id = $_POST['paper_id'];
    // $sub_id = $_POST['sub_id'];
    
   
    $table = $_POST['table'];
    
    $db->select($table,"*",null,"paper_id =".$paper_id,null,null);
    $res = $db->getResult();
     
    if($res){
        echo '<option>Select Subject</option>';
       
        foreach($res as $row1){
           //print_r($row1);
         
           ?>
               <option value = <?php echo $row1['id'] ?>  > <?php echo ($row1['descr'] =='')?'Subject Not Found':$row1['descr'] ?> </option>
           <?php
        }
      
    }
    else{
        //print_r($db->getResult());
        echo '<option>Subject Not Found</option>';
    }
 
}

if( isset($_POST['action']) && $_POST['action'] == 'select_subject_edit'){
   
  $paper_id = $_POST['paper_id'];
  $sub_id = $_POST['mjr_id'];
  
 
  $table = $_POST['table'];
  
  $db->select($table,"*",null,"paper_id =".$paper_id,null,null);
  $res = $db->getResult();
   
  if($res){
      echo '<option>Select Subject</option>';
     
      foreach($res as $row1){
         //print_r($row1);
       
         ?>
             <option value = <?php echo $row1['id'] ?> <?php if ( $row1['id'] == $sub_id ){ echo 'selected';}  ?> > <?php echo $row1['descr'] ?> </option>
         <?php
      }
    
  }
  else{
      //print_r($db->getResult());
      echo '<option>Paper Not Found</option>';
  }

}

if( isset($_POST['action']) && $_POST['action'] == 'select_topic'){
    //print_r($frm_data);
    $topic_id = $_POST['topic_id'];
    $subject_id = $_POST['mjr_sub_id'];
    $table = $_POST['table'];
    echo $topic_id;
    $db->select($table,"*",null,"subject_id =".$subject_id,null,null);
    $res = $db->getResult();
    
    if($res){
        echo '<option>Select Topic</option>';
       
        foreach($res as $row1){

           // echo '<option value="'.$row1['id'].'">'.$row1['topic'].'</option>';
           ?>
           <option value = <?php echo $row1['id'] ?> <?php if ( $row1['id'] == $topic_id ){ echo 'selected';}  ?> > <?php echo $row1['topic'] ?> </option>
           <?php
        }
      
    }
    else{
        //print_r($db->getResult());
        echo '<option>Topic Not Found</option>';
    }
 
}

// edit subject in time table 

if( isset($_POST['action']) && $_POST['action'] == 'select_detail_topic'){
    //print_r($frm_data);

    $topic_id = $_POST['topic_id'];
    $dtl_topic_id = $_POST['dtl_topic_id'];
    $table = $_POST['table'];
    
    $db->select($table,"*",null,"topic_id =".$topic_id,null,null);
    $res = $db->getResult();
    
    if($res){
        echo '<option>Select Subject</option>';
       
        foreach($res as $row1){
          //print_r($row1);
           // echo '<option value="'.$row1['id'].'">'.$row1['topic'].'</option>';
           ?>
           <option value = <?php echo $row1['id'] ?> <?php if ( $row1['id'] == $dtl_topic_id ){ echo 'selected';}  ?> > <?php echo $row1['dtl_topic'] ?> </option>
           <?php
        }
      
    }
    else{
        //print_r($db->getResult());
        echo '<option>Subject Not Found</option>';
    }
 
}


// fetch edit code
if( isset($_POST['action']) && $_POST['action'] == 'sub_edit'){

    
  $edit_id = $_POST['edit_id'];
  $table = $_POST['table'];
  
  $sql = "SELECT  sub.id,sub.paper_id,mjr.id as mjr_id,mjr.descr,top.id as top_id,top.topic,sub.dtl_topic FROM `tbl_detail_topic_master` sub , `tbl_subject_master` mjr , `tbl_topic_master` top 
          WHERE sub.subject_id = mjr.id AND sub.topic_id=top.id  AND sub.id = '".$edit_id."' ";
  $db->select_sql($sql);
  
   $res = $db->getResult();
   //print_r($res);
   echo json_encode($res);

}


 //dependent select options on edit
 if( isset($_POST['action']) && $_POST['action'] == 'select_edit'){
    //print_r($frm_data);
     $id = $frm_data['id'];
     $table = $frm_data['table'];
    
     $db->select($table,"*",null,"id =".$id,null,null);
     $res = $db->getResult();
     //print_r($res);
     if($res){
      
       foreach($res as $row){
        // echo '<option value="'.$row['id'].'">'.$row['title'].'</option>';
        echo $row['id'];
       }
     }
     else{
       //print_r($db->getResult());
       echo '<option>Paper Not Found</option>';
     }
    
   }

   if( isset($_POST['action']) && $_POST['action'] == 'tim_tbl_mjr_subject'){

   }


?>