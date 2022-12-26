<?php
 //include required phpmailer files
 
 include 'email.php';

 
 if ( isset($_POST['action']) && $_POST['action'] == 'inservice_email'){

    $subject = $_POST['subject'];
    $email_body = $_POST['email_body'];
    $traine_id = $_POST['traine_id'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $name = $_POST['name'];

    $newstring = substr($phone, -5);
    $pass = "Mdrafm@".$newstring;
    $psw = trim($pass);

    send_email($email,$subject,$email_body,$phone,$psw,$traine_id,$name);

    

 }
 

?>