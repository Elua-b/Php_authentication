<?php
include 'config.php';
if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $pass= $_POST['password'];
    $cpass= $_POST['cpassword']; 
    $image= $_FILES['image']['name'];
    $image_size= $_FILES['image']['size'];
    $image_tmp_name= $_FILES['image']['tmp_name'];
    $image_folder= 'uploaded_img/'.$image;
    
    $select =mysqli_query($conn,"SELECT * FROM `cred_table` WHERE email='$email'");
    
    if(mysqli_num_rows($select)>0){
        $message[]='user already exist';
    
    }else{
        
        if($pass != $cpass){
           $message[]='confirm password does not match';
        }
        else if($image_size>2000000){
            $message[]='the image is too large';
        }
        else{
            $insert=mysqli_query($conn,"INSERT INTO `cred_table`(name,email,password,image) VALUES('$name','$email','$pass','$image')") or die(mysqli_error($conn));
            if($insert){
                echo "reached";
                move_uploaded_file($image_tmp_name,$image_folder);
                
                $message[]='registered successfullu!';
                header('location:login.php');
            }
            else{
                $message[]='registration failed!';
            }
        }
    }

}
else{
    echo "error";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
<div class="form-container">
   

   <form action="" method="POST" enctype="multipart/form-data">
   <h3>register now</h3>
   <?php 
    if(isset($message)){
        foreach($message as $message){
            echo '<div class="message" ">'.$message.'</div>';
        }
    }
    ?>
       <input type="text" name="name" placeholder="Enter the username" class="box" required>
       <input type="email" name="email" placeholder="enter email" class="box" required >
       <input type="password" name="password" placeholder="enter password" class="box" required>
       <input type="password" name="cpassword" placeholder="confirm password" class="box" required>
       <input type="file" name="image" accept="image/jpeg,image/jpg,image/png" class="box" required>
       <input type="submit" value="register now" name="submit"  class="btn" >
       <p>already have an account? <a href="login.php">login now</a></p>
   </form> 
</div>
</body>
</html>