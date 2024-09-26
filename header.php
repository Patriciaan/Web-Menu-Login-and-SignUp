<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Account Dropdown Menu Using Html CSS & Vanilla Javascript</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
</head> 
<body>
    <div class="action">
        <div class="profile" onclick="menuToggle();">
            <img src="female_user.png" alt="">
        </div>

        <div class="menu">
            <h3>
                User Account
                <div>
                    Coffee Connoisseur
                </div>
            </h3>
            <ul>
            <li>
                <span class="material-icons icons-size">account_circle</span> 
                <a href="#">My Profile</a>
            </li>
            
            <li>
                <span class="material-icons icons-size">email</span> 
                <a href="#">Update Email</a>
            </li>
            
            <li>
                <span class="material-icons icons-size">lock</span>
                <a href="#">Update Password</a>
            </li>
            
            <li>
                <span class="material-icons icons-size">person_pin</span> 
                <a href="#">Update My Personal Information</a>
            </li>
            
            <li>
                <span class="material-icons icons-size">exit_to_app</span> 
                <a href="logout.php">Logout</a>
            </li>

                
            </ul>
        </div>
    </div>
    <script>
        function menuToggle(){
            const toggleMenu = document.querySelector('.menu');
            toggleMenu.classList.toggle('active')
        }
    </script>
</body>
</html>
