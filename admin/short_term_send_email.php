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
// echo 1;
// print_r($_POST);
// exit;

$subject = $_POST['subject'];
$email_body = $_POST['email_body'];
$program_id = $_POST['program_id'];


  $tableData = stripcslashes($_POST['tableData']);
 
  // Decode the JSON array
  $tableData = json_decode($tableData,TRUE);
  

foreach ($tableData as $row) {
    if($row['send'] == 1){

    // print_r($row);
    // exit;
     $name = $row['name'];
     $newstring = substr($row['phone'], 5);
     $usename = trim($row['phone']);
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
     $mail->Username = "mdrafm.fin@gmail.com";
     //set gmail password
     $mail->Password = "dzqcpwqjlwrkvbgj";

     //set email body
     $mail->Subject = "Test Email Using PHPmailer";
     //Set sender email
     $mail->setFrom("mdrafm.fin@gmail.com");
     $mail->FromName = "MDRAFM";
     //$mail->SMTPDebug  = 2;

     

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
        //echo $pass;
	    //echo $username;
         $username = $usename;
        
        
         $email =$row['email'];
         //echo $pass; exit;
         
         $db->update('tbl_dept_trainee_registration',["mail_status"=> 1],'id='.$row['trnee_id']);
      
         $res = $db->getResult();
         //print_r($res);
         if($res){
              $db->select('tbl_user','*',null,'username = "'.$username.'" ',null,null);
              $res = $db->getResult();

              if($res){
                foreach($res as $row){
                  $db->update('tbl_user',['password'=>$encryptedpass,'status'=>1],"id=".$row['id']);
                  $res1= $db->getResult();
                  if($res1[0]==1){
                    echo "success";
                  }
                 }
              }
              else{
                $insert_sql = "INSERT INTO tbl_user (roll_id,username,name,email,password) VALUES ( 4,'$username','$name','$email','$encryptedpass' ) " ;
                $db->insert_sql($insert_sql);
              }
         }else{
           echo "Error";
         }
          echo 'success#';
     }else{
         echo "Error";
     }
     //Closing emtp Connections
     $mail->smtpClose();
    }
}

?>