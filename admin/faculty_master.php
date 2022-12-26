<?php
 include('../config.php');
  print_r($_POST);
if(isset($_POST['save'])  ){
       $name = $_POST['name'];
       $role = $_POST['role'];
       $desig = $_POST['Desig'];

      $cadre = $_POST['cadre'];
      $qlftn = $_POST['qlftn'];
      $phone = $_POST['phone'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $address = $_POST['address'];

      $filename = strtolower(basename($_FILES['photo']['name']));
      $ext = substr($filename, strrpos($filename, '.') + 1);
      echo  $filename;
      $md_referenceno= gen_uuid();
      $ext=".".$ext;
      $new_filename = '../images/staff/'. $md_referenceno . $ext;
      $image = $md_referenceno . $ext;
      if(move_uploaded_file($_FILES['photo']['tmp_name'],$new_filename))
                         {
                          
                           
                           
                            $sql = "INSERT INTO `tbl_faculty_master` ( `role`, `name`, `desig`,`address`, `cader`, `qulftn`, `phone`, `email`, `image`) 
                                                             VALUES ( '$role', '$name', '$desig','$address', '$cadre', '$qlftn', '$phone', '$email', '$image');";
                            $query_insert = mysqli_query($db,$sql);

                            if($query_insert)
                                          {
                                             echo "Success";
                                             header("Location: faculty_master.php");
                                             exit;
                                          }
                                          else{
                                            echo("Error description: " . $mysqli -> error);
                                            exit;
                                          }
                              exit();
                            
                         }
    else{
        $sql = "INSERT INTO `tbl_faculty_master` ( `role`, `name`, `desig`, `cader`, `qulftn`, `phone`, `email`) 
        VALUES ( '$role', '$name', '$desig', '$cadre', '$qlftn', '$phone', '$email');";
                $query_insert = mysqli_query($db,$sql);

                if($query_insert)
                {
                echo "Success";
                header("Location: faculty_master.php");
                exit;
                }
                else{
                echo("Error description: " . $mysqli -> error);
                exit;
                }
                exit();
    }






}


function gen_uuid() 
   { 
         $s = strtoupper(md5(uniqid(date("YmdHis"),true))); 
          $guidText = 
          substr($s,0,4) . '-' . 
          substr($s,4,4)."-" ; 
          $date=date("his");
        return "mdrafm-".$guidText.$date;
     }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<form method="post" enctype="multipart/form-data" style="width:500px;height: 400px;margin:0 33%" >
<div class="mb-3">
    <label  class="form-label">Role</label>
    <select name="role" id="" class="form-control">
        <option value="4">out source staff</option>
        <option value="3">Regular staff</option>
        <option value="2">Guiest</option>
        <option value="1">in house</option>
       
    </select>
   
  </div>
  <div class="mb-3">
    <label  class="form-label">Name</label>
    <input type="text" class="form-control" name="name" >
   
  </div>
  <div class="mb-3">
    <label  class="form-label">Desig</label>
    <input type="text" class="form-control" name= "Desig" >
   
  </div>
  <div class="mb-3">
    <label  class="form-label">Address</label>
    <input type="text" class="form-control" name= "address" >
   
  </div>
  <!-- <div class="mb-3">
    <label  class="form-label">Cadre</label>
    <input type="text" class="form-control" name="cadre" >
   
  </div>
  <div class="mb-3">
    <label  class="form-label">Qualificación</label>
    <input type="text" class="form-control" name="qlftn" >
   
  </div> -->
  <div class="mb-3">
    <label  class="form-label">phone</label>
    <input type="text" class="form-control" name="phone" >
   
  </div>
  
  <div class="mb-3">
    <label  class="form-label">Email</label>
    <input type="text" class="form-control" name="email" >
   
  </div>
  <div class="mb-3">
    <label  class="form-label">photo</label>
    <input type="file" class="form-control" name="photo" >
   
  </div>
  <button type="submit" class="btn btn-primary" name="save">Submit</button>
</form>
</body>
</html>