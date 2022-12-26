<?php
    include 'database.php';
    $db = new Database();

    $prev_psw = $_POST['prev_psw'];
    $user_id = $_POST['user_id'];
    $password = $_POST['new_psw'];
 
    $encryptedpass = password_hash($password,PASSWORD_BCRYPT);

    $db->select('tbl_user',"password",null,'id ='."'$user_id'",null,null);
	$res = $db->getResult();

	foreach($res as $row){
       //echo $row['password'];
        $validPassword = password_verify($prev_psw,$row['password']);
       
        if(!$validPassword){
            echo "error#Previous password not matched";
        }
        else{

            $db->update('tbl_user', [ "password" => $encryptedpass ],'id='.$user_id);

            $res = $db->getResult();
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