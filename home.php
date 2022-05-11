<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
     header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="register.css">
</head>

<body>
    <div class="container">
        <div class="profile">
            <?php
            $select = mysqli_query($conn, "SELECT * FROM `cred_table` WHERE id='$user_id'")
                or die('query failed');
            if (mysqli_num_rows($select) > 0) {
                $fetch = mysqli_fetch_assoc($select);
            }
            if($fetch['image']==''){
                echo '<img src="images/download.png">';
            }
            else{
                echo '<img src="uploadded_img/'.$fetch['image'].'">';
            }

            ?>
            <h3><?php echo $fetch['name']; ?></h3>
            <a href="update_profile.php" class="btn">update profile</a>
            <a href="home.php?logout=<?php echo $user_id; ?>" class="delete-btn">logout</a>
            <p>new <a href="login.php">login</a>or <a href="register.php">register</a></p>
        </div>
    </div>
</body>

</html>