<?php
    session_start();
    if (!isset($_SESSION['SESSION_EMAIL'])) {
        header("Location: index.php");
        die();
    }

    include 'config.php';

    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL']}'");
    ?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Profile</title>
	<link rel="stylesheet" href="styles.css">

</head>
<body>
	<?php include('header.php')?>

	<div class="cont_profile">
	<?php
    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);

        echo "<h2>Welcome, " . $row['first_name'] . "</h2>";

    }

    ?>
    </div>

</body>
</html>
