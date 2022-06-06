<?php

session_start();
if (isset($_SESSION['sessionid'])) {
    $user_email = $_SESSION['email'];
    $user_name = $_SESSION['name'];
    $user_phone = $_SESSION['phone'];
    //$carttotal = 0;
} else {
    $user_email = "guest@slumberjer.com";
    // $carttotal = 0;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../js/function.js" defer></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="../css/style.css" />
    <title>MainPage</title>

    <style>
        @media screen and (max-width: 500px) {
            .icon {
                display: none !important;
            }
        }
    </style>

    <script>
        function myFunction() {
            var x = document.getElementById("idnavbar");
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
            } else {
                x.className = x.className.replace(" w3-show", "");
            }
        }
    </script>
    </style>

</head>


<body>
    <div>
        <header class="w3-container" style="background-color: LavenderBlush;">
            <h3><b>Main Page</b></h3>
        </header>
        <!-- bar -->
        <div>
            <div class="w3-bar w3-red">
                <a href="index.php" class="w3-bar-item w3-button w3-hide-small w3-left">Courses</a>
                <a href="tutor.php" class="w3-bar-item w3-button w3-hide-small w3-left">Tutors</a>
                <a href="#" class="w3-bar-item w3-button w3-hide-small w3-left">Subscription</a>
                <a href="#" class="w3-bar-item w3-button w3-hide-small w3-left">My Profile</a>
                <a href="login.php" class="w3-right"><i class="icon fa fa-user" style="font-size:32px;padding:8px;"></i></a>
                <a href="javascript:void(0)" class="w3-bar-item w3-button w3-hide-large w3-hide-medium w3-left" onclick="myFunction()">&#9776</a>

            </div>

            <div id="idnavbar" class="w3-bar-block w3-hide w3-hide-large w3-hide-medium">
                <a href="index.php" class="w3-bar-item w3-button w3-left">Courses</a>
                <a href="tutor.php" class="w3-bar-item w3-button w3-left">Tutors</a>
                <a href="#" class="w3-bar-item w3-button w3-left">Subscription</a>
                <a href="#" class="w3-bar-item w3-button w3-left">My Profile</a>
                <a href="login.php" class="w3-bar-item w3-button w3-left">Login</a>
            </div>
        </div>

    </div>

    <footer class="w3-footer w3-center w3-bottom w3-red">My Tutor</footer>

</body>

</html>