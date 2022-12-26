<?php 

include 'database.php';
$db = new Database();


 //save and update
 if ( isset($_POST['action']) && $_POST['action'] == 'add'){
    
    $update_id =$_POST['update_id'];
    $descr = addslashes($_POST['header_content']);
    $heading = $_POST['heading'];
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
        $sql = "INSERT INTO tbl_course_index (heading,descr) VALUES('$heading','$descr')";
      // echo $sql ;
      // exit;
     $db->insert_sql($sql);
        //$db->insert($table, ['heading'=>$heading, 'descr'=>$descr]);

       $res = $db->getResult();
       //print_r($res);
      if($res){
          echo "success#".$res[1];
      }
      else{
        //print_r($db->getResult());
        echo "error#".$res[0];
      }
    }
    
}

?>