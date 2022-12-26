<?php
  include 'admin/database.php';
  include 'common_function.php';

  session_start();
       
  $db = new Database();

  if ( isset($_POST['action']) && $_POST['action'] == 'send_otp'){
     
      $username = $_POST['username'];
      $otp = $_POST['otp'];
      $db->select("tbl_user","*",null,"username = '".$username."' ",null,null);
      $res = $db->getResult();
    

      if($res){
         foreach($res as $row){
          
            //$otp = random_int(100000, 999999);
            $subject = "OTP for reset password for MDRAFM iTMS Login";
            $sent_mail =  send_email($row['email'],$otp,$subject);
            if($sent_mail == 'success'){
                $msg = "success#Enter OTP as received in Your email -". $row['email']."#".$otp;
                $session['otp'] = $otp;
            }else{
              $msg = "erroe#Email not Found";
            }
         }
      }else{
        $msg = "erroe#User not found";
      }

      echo $msg;

  }
    
  if ( isset($_POST['action']) && $_POST['action'] == 'reset_password'){

       $username = $_POST['username'];
       $new_psw = $_POST['new_psw'];
       $encryptedpass = password_hash($new_psw,PASSWORD_BCRYPT);

       $db->select("tbl_user","*",null,"status = 1 AND username = '".$username."' ",null,null);
       $res = $db->getResult();
 
       if($res){
          $db->update("tbl_user",['password'=>$encryptedpass], 'username ='.$username);
          $res1 = $db->getResult();
         
          if($res1[0]==1){
            echo "success#Password Updated Successfully";
          }
       }else{
         echo "erroe#User is Inactive";
       }

  }
?>