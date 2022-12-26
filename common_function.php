<?php
 //include required phpmailer files
 include './PHPMailer/PHPMailer.php';
 include './PHPMailer/SMTP.php';
 include './PHPMailer/Exception.php';
 // Define name spaces
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
 use PHPMailer\PHPMailer\Exception;

  
  function send_email($send_mail,$otp,$subject){

     // create instance of phpmailer
     $mail = new PHPMailer();
     // set mailer to use smtp
     $mail->isSMTP();
     //define smtp host
     $mail->Host = "apps.odishaone.gov.in";
     
     //set type of encryption(ssl/tls)
     $mail-> Port = "25";

     //enable smtp authentication
     $mail->SMTPAuth ="true";
     $mail->SMTPSecure = "tls";
     //set gmail Username
     $mail->Username = "mdrafm@odishaone.gov.in";
     //set gmail password
     $mail->Password = "FHJ89#$@!31&&Q";

     //set email body
     $mail->Subject = "Test Email Using PHPmailer";
     //Set sender email
     $mail->setFrom("mdrafm@odishaone.gov.in");
     //$mail->FromName = "MDRAFM";
     //$mail->SMTPDebug  = 2;


     //Enable HTML
     $mail->isHTML(true);
     //Unescape the string values in the JSON array
     $mail->Subject = $subject;
     $mail->Body ="<br><h3>MDRAFM Reset Password OTP</h3> </br><p>OTP: <strong>$otp<p>";
     //add recipients
     $mail->addAddress($send_mail , 'MDRAFM');
     //finaly send emailHelp
     
     if($mail->Send()){
         
         return "success";
     }else{
         echo "Error";
     }
     //Closing emtp Connections
     $mail->smtpClose();



  }

?>