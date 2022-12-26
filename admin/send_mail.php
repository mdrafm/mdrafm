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

$subject = $_POST['subject'];
$email_body = $_POST['email_body'];
$program_id = $_POST['program_id'];
$latter = '';
$anx1 = '';
$anx2 = '';
$anx3='';
$file_path = "/mdrafm/admin/email_doc/";
$path = $_SERVER['DOCUMENT_ROOT'].$file_path;
$db->select('tbl_email_doc',"*",null,"program_id =".$program_id,null,null);

foreach($db->getResult() as  $value){
  //print_r($value);
  $latter = $path.$value['latter'];
  $anx1 = $path.$value['anx1'];
  $anx2 = $path.$value['anx2'];
  $anx3 = $path.$value['anx3'];
}
// echo $latter;
// exit;

$db->select('tbl_new_recruite',"*",null,"email_status = 1 AND batch_id =".$_POST['batch_id'],null,null);

foreach ($db->getResult() as $row) {

    //print_r($row);
     $name = $row['f_name'].' '.$row['l_name'];
     $newstring = substr($row['phone'], -5);
     $usename = $row['phone'];
     $pass = "Mdrafm@".$newstring;
     $psw = trim($pass);
     //echo $psw ;exit;
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
     $mail->SMTPDebug  = 1;

     //Attachments
     $mail->addAttachment($latter);         //Add attachments
     $mail->addAttachment($anx1, 'anx1');    //Optional name


     //Enable HTML
     $mail->isHTML(true);
     //Unescape the string values in the JSON array
     $mail->Subject = $subject;
     $mail->Body = $email_body."<br><h3>MDRAFM Login</h3> </br><p>User name: <strong>$usename</strong><p></br><p>Password: <strong>$pass</strong><p>";
     //add recipients
     $mail->addAddress($row['email'] , $name);
     //finaly send emailHelp
     $encryptedpass = password_hash($psw,PASSWORD_BCRYPT);
     if($mail->Send()){
         //echo "Email Sent..!";
        echo $pass;
	    //echo $username;
         $username = $usename;
        
        
         $email =$row['email'];
         //echo $pass; exit;
         $db->update('tbl_new_recruite',["program_id" =>$program_id,"mdrafm_status"=> 1],'id='.$row['id']);
         $db->update('tbl_batch_master',["mail_status"=> 1],'id='.$_POST['batch_id']);
         $db->update('tbl_email_doc',["status"=> 1],'program_id='.$program_id);
         $res = $db->getResult();
         print_r($res);
         if($res){
            // $db->insert('tbl_user', ['roll_id'=> 4 ,'username'=>$username,'name'=>$row['name'],'email'=>$row['email'],'password'=>$encryptedpass]);
            $insert_sql = "INSERT INTO tbl_user (roll_id,username,name,email,password) VALUES ( 4,'$username','$name','$email','$encryptedpass' ) " ;
            $db->insert_sql($insert_sql);
            //print_r( $db->getResult());
         }else{
           echo "Error";
         }
     }else{
         echo "Error";
     }
     //Closing emtp Connections
     $mail->smtpClose();
}

?>