<?php 
include 'database.php';
$db = new Database();
//include required phpmailer files
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';
require '../PHPMailer/Exception.php';
// Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$subject = $_POST['email_sub'];
$email_body = $_POST['email_content'];
$dept_email = $_POST['dept_email'];
$program_id = $_POST['id'];
$dept_name = $_POST['dept_name'];
$table = $_POST['table'];
     $username = $dept_email;
     $newstring = substr($dept_email,0, 5);
     $year = date("Y"); 
     $newstring = ucfirst($newstring);
     $pass = $newstring.'@'.$year;
     $psw = trim($pass);
    // echo $psw ;
    
     //exit;
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

     //set email body
     $mail->Subject = "Test Email Using PHPmailer";
     //Set sender email
     $mail->setFrom("smruti.ranjan.leepu@gmail.com");
     $mail->FromName = "MDRAFM";
     //$mail->SMTPDebug  = 2;


     //Enable HTML
     $mail->isHTML(true);
     //Unescape the string values in the JSON array
     $mail->Subject = $subject;
     $mail->Body = $email_body."<br><h3>MDRAFM Login</h3> </br><p>User name: <strong>$username</strong><p></br><p>Password: <strong>$psw</strong><p>";
     //add recipients
     $mail->addAddress($dept_email , 'MDRAFM');
     //finaly send emailHelp
     $encryptedpass = password_hash($psw,PASSWORD_BCRYPT);
     if($mail->Send()){
         
       
         $db->update($table,["mail_status"=> 1,"status"=>"approve"],'id='.$program_id);
        
         $res = $db->getResult();
        
         if($res){
          $db->select('tbl_user','*',null,'username = "'.$dept_email.'" ',null,null);
          $res = $db->getResult();

          if($res){
           foreach($res as $row){
            $db->update('tbl_user',['password'=>$encryptedpass],"id=".$row['id']);
            $res1= $db->getResult();
            if($res1[0]==1){
              echo "success";
            }
           }
          }else{
            $insert_sql = "INSERT INTO tbl_user (roll_id,username,name,email,password) VALUES ( 11,'$username','$dept_name','$dept_email','$encryptedpass' ) " ;
            $db->insert_sql($insert_sql);
          }

           
         }else{
           echo "Error";
         }

         echo "success";
     }else{
         echo "Error";
     }
     //Closing emtp Connections
     $mail->smtpClose();


?>