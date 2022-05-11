<?php
include 'config.php';
if (isset($_POST['submit'])) {

    $email = $_POST['email'];
    $pass = $_POST['password'];

    $select = mysqli_query($conn, "SELECT * FROM `cred_table` WHERE email='$email' AND password='$pass'");

    if (mysqli_num_rows($select) > 0) {
        $row = mysqli_fetch_assoc($select);
        session_start();
        $_SESSION['user_id'] = $row['id'];
        header('location:home.php');
    } else {
        $message[] = 'incorrect email or password!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="register.css">
</head>

<body>
    <div class="form-container">


        <form action="" method="POST" enctype="multipart/form-data">

            <h3>Login now</h3>
            <?php
            if (isset($message)) {
                foreach ($message as $message) {
                    echo '<div class="message" ">' . $message . '</div>';
                }
            }
            ?>

            <input type="email" name="email" placeholder="enter email" class="box" required>
            <input type="password" name="password" placeholder="enter password" class="box" required>


            <input type="submit" value="register now" name="submit" class="btn">
            <p>don't have an account? <a href="register.php">register now</a></p>
        </form>
    </div>
</body>

</html>