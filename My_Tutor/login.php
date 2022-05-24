<?php

if (isset($_POST['signin'])) {
    include 'dbconnect.php';
    $email = $_POST['email'];
    $pass = sha1($_POST['password']);
    $sqllogin = "SELECT * FROM tbl_register WHERE user_email = '$email' AND user_password = '$pass'";
    $stmt = $conn->prepare($sqllogin);
    $stmt->execute();
    $number_of_rows = $stmt->fetchColumn();
    
    if ($number_of_rows  > 0) {
        session_start();
        $_SESSION["sessionid"] = session_id();
        $_SESSION["email"] = $email ;
        echo "<script>alert('Login Success');</script>";
        echo "<script> window.location.replace('dashboard.php')</script>";
    } else {
        echo "<script>alert('Login Failed');</script>";
        echo "<script> window.location.replace('login.php')</script>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" href="css/style.css">

    <style>
        @media screen and (max-width: 600px) {
            div.image {
                display: none;
            }
        }
    </style>

</head>


<!--cookies = Without cookies, you’d have to login again after you leave a site or rebuild your shopping cart if you accidentally close the page. -->
<body onload="loadCookies()">
    <header class="w3-header w3-red w3-center w3-padding-24">
        <h2><b>My Tutor Websites</b></h2>
    </header>



    <!-- Left Column -->
    <div class="w3-third">
        <div class="image">
            <div class="w3-display-container ">
                <img src="Capture.PNG" alt="Person" style="max-width: 100%; height:auto;">
            </div>
        </div>
    </div>
    <!--End left content-->

    <div class="w3-twothird">
        <div class="right w3-container w3-card w3-padding-32 w3-margin"
            style="width: 600px;margin:auto;text-align:left;">
            <div style="text-align: center;">
                <h3 style="color:Tomato;"><b>Login Form</b></h3>
            </div>
            <form name="loginForm" action="login.php" method="post">
            <p>
                <label><b>Email</b></label>
                <input class="w3-input w3-round w3-border" type="email" name="email" id="idemail"
                    placeholder="Your email" required>
            </p>
            <p>
                <label><b>Password</b></label>
                <input class="w3-input w3-round w3-border" type="password" name="password" id="idpass"
                    placeholder="Your password" required>
            </p>
            <p>
                <input class="w3-check" name="rememberme" type="checkbox" id="idremember" onclick="rememberMe()">
                <label>Remember Me</label>
            </p>
            <p>
                <input type="button" class="w3-btn w3-red" name="signin" value="Sign Up">
            </p>

            <div><a href="php/register1.php">Not yet registered? Click Me!</a></div>
            
            </form>
        </div>
    </div>

</body>

</html>