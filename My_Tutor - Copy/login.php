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
        $_SESSION["email"] = $email;
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
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: white;
        }

        .bg {
            background-color: white;
            height: 100%;
            background-position: center;
            background-size: cover;
        }


        /* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 600px) {
            .column {
                flex: 100%;
                max-width: 100%;
            }
        }
    </style>

</head>


<!--cookies = Without cookies, you’d have to login again after you leave a site or rebuild your shopping cart if you accidentally close the page. -->

<body onload="loadCookies()">
    <header class="w3-header w3-red w3-center w3-padding">
        <h2><b>My Tutor Websites(JomStudy)</b></h2>
    </header>
    <div class="bg">
        <div class="w3-center w3-container w3-padding-64 w3-margin">
            <div class="w3-center w3-card w3-left w3-padding w3-margin-32" style="width: 1000px;margin:auto;text-align:center;">
                <div style="text-align: center;">
                    <h2 style="color:Tomato; font-size:50px;"><b>Login Form</b></h2>
                </div><br>
                <form name="loginForm" action="login.php" method="post">
                    <p style="text-align:left;font-size: 25px ">
                        <label style="color:Tomato;"><b>Email</b></label>
                        <input class="w3-input w3-round w3-border" type="email" name="email" id="idemail" placeholder="Your email" required>
                    </p>
                    <p style="text-align:left;font-size: 25px ">
                        <label style="color:Tomato;"><b>Password</b></label>
                        <input class="w3-input w3-round w3-border" type="password" name="password" id="idpass" placeholder="Your password" required>
                    </p>
                    <p style="text-align:left;">
                        <input class="w3-check" name="rememberme" type="checkbox" id="idremember" onclick="rememberMe()">
                        <label>Remember Me</label>
                    </p>
                    <p style="text-align:center;font-size: 25px ">
                        <input type="button" class="w3-btn w3-red" name=" signin" value="Sign In">
                    </p>

                    <div style=color:blue;><a href="register1.php">Not yet registered? Click Me!</a></div>

                </form>
            </div>
        </div>
    </div>

</body>

</html>