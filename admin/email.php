<?php
 //include required phpmailer files
 include '../PHPMailer/PHPMailer.php';
 include '../PHPMailer/SMTP.php';
 include '../PHPMailer/Exception.php';
 include 'database.php';
 
 // Define name spaces
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
 use PHPMailer\PHPMailer\Exception;

  
  function send_email($trainee_email,$subject,$email_body,$username,$password,$traine_id,$name){

     // create instance of phpmailer
     $mail = new PHPMailer();
     // set mailer to use smtp
     $mail->isSMTP();
     //define smtp host
     $mail->Host = "smtp.gmail.com";
     //enable smtp authentication
     $mail->SMTPAuth ="true";
     //set type of encryption(ssl/tls)
     $mail-> Port = "587";
     //set gmail Username
     $mail->Username = "smruti.ranjan.leepu@gmail.com";
     //set gmail password
     $mail->Password = "bajwmhivsjxwjisb";

     //Set sender email
     $mail->setFrom("smruti.ranjan.leepu@gmail.com");
     $mail->FromName = "MDRAFM";
     //$mail->SMTPDebug  = 2;


     //Enable HTML
     $mail->isHTML(true);
     //Unescape the string values in the JSON array
     $mail->Subject = $subject;
     $mail->Body =$email_body."<br><h3>MDRAFM Login</h3> </br><p>User name: <strong>$username</strong><p></br><p>Password: <strong>$password</strong><p>";
     //add recipients
     $mail->addAddress($trainee_email , 'MDRAFM');
     //finaly send emailHelp
     
     if($mail->Send()){
        $db = new Database();
         echo "success";
         $db->update('tbl_new_recruite',["email_status"=> 1],'id='.$traine_id);
    
            $encryptedpass = password_hash($password,PASSWORD_BCRYPT);
            $res = $db->getResult();
            //print_r($res);
            if($res){
            // $db->insert('tbl_user', ['roll_id'=> 4 ,'username'=>$username,'name'=>$row['name'],'email'=>$row['email'],'password'=>$encryptedpass]);
            $insert_sql = "INSERT INTO tbl_user (roll_id,username,name,email,password) VALUES ( 4,'$username','$name','$trainee_email','$encryptedpass' ) " ;
            $db->insert_sql($insert_sql);
            //print_r( $db->getResult());
            echo "success,";
            }else{
            echo "Error- ".$trainee_email.",";
            }
     }else{
         echo "Error- ".$trainee_email.",";
     }
     //Closing emtp Connections
     $mail->smtpClose();



  }

?>