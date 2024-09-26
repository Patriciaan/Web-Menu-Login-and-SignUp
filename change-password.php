<?php

$msg = "";

include 'config.php';

if (isset($_GET['reset'])) {
    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE code='{$_GET['reset']}'")) > 0) {
        if (isset($_POST['submit'])) {
            $password = mysqli_real_escape_string($conn, md5($_POST['password']));
            $confirm_password = mysqli_real_escape_string($conn, md5($_POST['confirm-password']));

            if ($password === $confirm_password) {
                $query = mysqli_query($conn, "UPDATE users SET password='{$password}', code='' WHERE code='{$_GET['reset']}'");

                if ($query) {
                    header("Location: index.php");
                }
            } else {
                $msg = "<div class='alert alert-danger'>Password and Confirm Password do not match.</div>";
            }
        }
    } else {
        $msg = "<div class='alert alert-danger'>Reset Link do not match.</div>";
    }
} else {
    header("Location: forgot-password.php");
}

?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Change Password</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords"
        content="Login Form" />
    <!-- //Meta tag Keywords -->

    <link rel="stylesheet" href="styles.css" type="text/css" media="all" />
    

</head>

<body>
    <div class="cont_log">
        <h2>Change Password</h2>
        <?php echo $msg; ?>
        <form action="" method="post">
            <label for="pass"><b>Create Password <span class="required">*</span></b></label>
            <input type="password" class="password" name="password" placeholder="Enter Your Password" required>

            <label for="pass2"><b>Retype Password <span class="required">*</span></b></label>
            <input type="password" class="confirm-password" name="confirm-password" placeholder="Enter Your Confirm Password" required>
            <button name="submit" class="loginbtn" type="submit" style = "width: 150px">Change Password</button>
        </form>
        <br>
             <h4>Back to <a href="index.php">Login</a>.</h4>

    </div>





    <script src="js/jquery.min.js"></script>
    <script>
        $(document).ready(function (c) {
            $('.alert-close').on('click', function (c) {
                $('.main-mockup').fadeOut('slow', function (c) {
                    $('.main-mockup').remove();
                });
            });
        });
    </script>

</body>

</html>