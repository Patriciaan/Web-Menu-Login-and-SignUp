<!-- Code by Brave Coder - https://youtube.com/BraveCoder -->

<?php
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    session_start();
    if (isset($_SESSION['SESSION_EMAIL'])) {
        header("Location: welcome.php");
        die();
    }

    //Load Composer's autoloader
    require 'vendor/autoload.php';

    include 'config.php';
    $msg = "";

    if (isset($_POST['submit'])) {
        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
        $middle = mysqli_real_escape_string($conn, $_POST['middle']);
        $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
        $Suffix = mysqli_real_escape_string($conn, $_POST['Suffix']);
        $date_of_birth = mysqli_real_escape_string($conn, $_POST['date_of_birth']);
        $mobile_number = mysqli_real_escape_string($conn, $_POST['mobile_number']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));
        $confirm_password = mysqli_real_escape_string($conn, md5($_POST['confirm-password']));
        $code = mysqli_real_escape_string($conn, md5(rand()));

        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE email='{$email}'")) > 0) {
            $msg = "<div class='alert alert-danger'>{$email} - This email address has been already exists.</div>";
        } else {
            if ($password === $confirm_password) {
                $sql = "INSERT INTO users (first_name, middle, last_name, Suffix, date_of_birth, mobile_number, email, password, code) VALUES ('{$first_name}', '{$middle}','{$last_name}', '{$Suffix}', '{$date_of_birth}', '{$mobile_number}', '{$email}', '{$password}', '{$code}')";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    echo "<div style='display: none;'>";
                    //Create an instance; passing `true` enables exceptions
                    $mail = new PHPMailer(true);

                    try {
                        //Server settings
                        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mail->Username   = 'anapatriciatojon86@gmail.com';                     //SMTP username
                        $mail->Password   = 'pwoe zlqs hmdo nakw';                               //SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                        //Recipients
                        $mail->setFrom('ana.tojon@neu.edu.ph');
                        $mail->addAddress($email);

                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = 'no reply';
                        $mail->Body    = 'Here is the verification link <b><a href="http://localhost/login/?verification='.$code.'">http://localhost/login/?verification='.$code.'</a></b>';

                        $mail->send();
                        echo 'Message has been sent';
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                    echo "</div>";
                    $msg = "<div class='alert alert-info'>We've send a verification link on your email address.</div>";
                } else {
                    $msg = "<div class='alert alert-danger'>Something wrong went.</div>";
                }
            } else {
                $msg = "<div class='alert alert-danger'>Password and Confirm Password do not match</div>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Signup Form</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords"
        content="Login Form" />
    <!-- //Meta tag Keywords -->

   

    <!--/Style-CSS -->
    <link rel="stylesheet" href="styles.css" >
    <!--//Style-CSS -->

   

</head>

<body>
<body class= signbody>
    <div class = headstyle>
	<?php include('menu.php')?>
</div>

<div class="cont_sign">
                        <h2>Register Now</h2>
                        <?php echo $msg; ?>
                        <form action="" method="post">
                            <label for="fname"><b>First Name <span class="required">*</span></b></label>
                            <input type="text" class="first_name" name="first_name" placeholder="First Name" value="<?php if (isset($_POST['submit'])) { echo $first_name; } ?>" required>

                            <label for="mname"><b>Middle Name</b></label>
                            <input type="text" class="middle" name="middle" placeholder="Middle Name" value="<?php if (isset($_POST['submit'])) { echo $middle; } ?>">

                            <label for="lname"><b>Last Name <span class="required">*</span></b></label>
                            <input type="text" class="last_name" name="last_name" placeholder="Last Name" value="<?php if (isset($_POST['submit'])) { echo $last_name; } ?>" required>

                            <label for="suf"><b>Suffix</b></label>
                            <input type="text" class="Suffix" name="Suffix" placeholder="Suffix" value="<?php if (isset($_POST['submit'])) { echo $Suffix; } ?>">

                            <label for="dob"><b>Date of Birth <span class="required">*</span></b></label>
                            <input type="date" class="date_of_birth" name="date_of_birth" placeholder="Date of Birth" value="<?php if (isset($_POST['submit'])) { echo $date_of_birth; } ?>" required>

                            <label for="number"><b>Mobile Number <span class="required">*</span></b></label>
                            <input type="text" class="mobile_number" name="mobile_number" placeholder="Mobile Number" value="<?php if (isset($_POST['submit'])) { echo $mobile_number; } ?>" required>

                            <label for="email"><b>Email Address <span class="required">*</span></b></label>
                            <input type="text" class="email" name="email" placeholder="Enter Your Email" value="<?php if (isset($_POST['submit'])) { echo $email; } ?>" required>

                            <label for="pass"><b>Create Password <span class="required">*</span></b></label>
                            <input type="password" class="password" id="password" name="password" placeholder="Enter Your Password" required>

                            <label for="pass2"><b>Retype Password <span class="required">*</span></b></label>
                            <input type="password" class="confirm-password" id="confirm-password" name="confirm-password" placeholder="Enter Your Confirm Password" style="margin-bottom: 2px;" required>
                            <input type="checkbox" onclick="togglePasswordVisibility()"> Show Password <br><br>

                            <button name="submit" class="signupbtn" type="submit" style="width: 100px;">Register</button>
                        </form>
                        <br>
                            <h3>Already have an account? <a href="index.php">Login</a>.</h3>
                            
<script>
function togglePasswordVisibility() {
  var passwordField = document.getElementById("password");
  var confirmPasswordField = document.getElementById("confirm-password"); // Assuming the confirm password field has an ID of "confirm-password"

  if (passwordField.type === "password") {
    passwordField.type = "text";
    if (confirmPasswordField) {
      confirmPasswordField.type = "text"; // Reveal confirm password field if it exists
    }
  } else {
    passwordField.type = "password";
    if (confirmPasswordField) {
      confirmPasswordField.type = "password"; // Hide confirm password field if it exists
    }
  }
}

</script>

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