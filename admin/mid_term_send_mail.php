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

// print_r($_POST);
// exit;

    $subject = $_POST['subject'];
    $email_body = $_POST['email_body'];
    $traine_id = $_POST['traine_id'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $name = $_POST['name'];
$program_id = $_POST['program_id'];

$file_path = "/admin/email_doc/";
$path = $_SERVER['DOCUMENT_ROOT'].$file_path;

$latter = '';
$anx1 = '';
$anx2 = '';
$anx3='';

if( $_POST['latter'] != ''){
  $latter = $path.$_POST['latter'];
}
if( $_POST['anx1'] != ''){
  $anx1 = $path.$_POST['anx1'];
}
if( $_POST['anx2'] != ''){
  $anx2 = $path.$_POST['anx2'];
}
if( $_POST['anx3'] != ''){
  $anx3 = $path.$_POST['anx3'];
}


    // print_r($row);
    // exit;
     //$name = $row['name'];
     $newstring = substr($phone, -5);
     $usename = $phone;
     $pass = "Mdrafm@".$newstring;
     $psw = trim($pass);
     //echo $psw ;exit;
     // create instance of phpmailer
     $mail = new PHPMailer();
     // set mailer to use smtp
     $mail->isSMTP();
     //define smtp host
     $mail->Host = "apps.odishaone.gov.in";
     //enable smtp authentication
     $mail->SMTPAuth ="true";
     //set type of encryption(ssl/tls)
     $mail-> Port = "25";
     $mail->SMTPSecure = "tls";
     //set gmail Username
     $mail->Username = "mdrafm@odishaone.gov.in";
     //set gmail password
     $mail->Password = "FHJ89#$@!31&&Q";

     //set email body
     $mail->Subject = "Test Email Using PHPmailer";
     //Set sender email
     $mail->setFrom("mdrafm@odishaone.gov.in");
     $mail->FromName = "MDRAFM";
    // $mail->SMTPDebug  = 2;

     //Attachments
     if($latter != ''){
        $mail->addAttachment($latter,'Welcome Letter');  
    }
    if($anx1 != ''){
        $mail->addAttachment($anx1, 'Training Sechedule');
    }
    if($anx2 != ''){
      $mail->addAttachment($anx2, 'Nomination Letter');
  }
  if($anx3 != ''){
    $mail->addAttachment($anx3, 'anx1');
}
            //Add attachments
        //Optional name


     //Enable HTML
     $mail->isHTML(true);
     //Unescape the string values in the JSON array
     $mail->Subject = $subject;
     $mail->Body = $email_body."<br><h3>MDRAFM Login</h3> </br><p>User name: <strong>$usename</strong><p></br><p>Password: <strong>$pass</strong><p>";
     //add recipients
     $mail->addAddress($email , $name);
     //finaly send emailHelp
     $encryptedpass = password_hash($psw,PASSWORD_BCRYPT);
     if($mail->Send()){
         //echo "Email Sent..!";
        //echo $pass;
	    //echo $username;
         $username = trim($usename);

        // $email =$row['email'];
         //echo $pass; exit;
         
         $db->update('tbl_mid_trainee_registration',["mail_status"=> 1],'id='.$traine_id);
         $db->update('tbl_email_doc',["status"=> 1],'program_id='.$program_id);
         $res = $db->getResult();
         //print_r($res);
         if($res){
            // $db->insert('tbl_user', ['roll_id'=> 4 ,'username'=>$username,'name'=>$row['name'],'email'=>$row['email'],'password'=>$encryptedpass]);
            $insert_sql = "INSERT INTO tbl_user (roll_id,username,name,email,password) VALUES ( 4,'$username','$name','$email','$encryptedpass' ) " ;
            $db->insert_sql($insert_sql);
            //print_r( $db->getResult());
            echo "success";
         }else{
           echo "Error";
         }
     }else{
         echo "Error";
     }
     //Closing emtp Connections
     $mail->smtpClose();
   
?>