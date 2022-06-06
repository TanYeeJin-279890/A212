<?php

if (isset($_POST['submit'])) {
    include 'dbconnect.php';
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $sqllogin = "SELECT * FROM tbl_register WHERE user_email = '$email' AND user_password = '$pass'";
    $stmt = $conn->prepare($sqllogin);
    $stmt->execute();
    $number_of_rows = $stmt->rowCount();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $rows = $stmt->fetchAll();

    if ($number_of_rows  > 0) {
        foreach ($rows as $user) {
            $name = $user['customer_name'];
            $phone = $user['customer_phone'];
        }
        session_start();
        $_SESSION["sessionid"] = session_id();
        $_SESSION["email"] = $email;
        $_SESSION["name"] = $name;
        $_SESSION["phone"] = $phone;
        echo "<script>alert('Login Success');</script>";
        echo "<script> window.location.replace('basic.php')</script>";
    } else {
        echo "<script>alert('Login Failed');</script>";
        echo "<script>alert('Please do register if you are new user');</script>";
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
    <script src="../js/login.js" defer></script>
    <link rel="stylesheet" href="../css/w3.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
            background-repeat: no-repeat;
            background-size: cover;
        }

        /* Slideshow */
        .slide {
            display: none;
        }

        img {
            vertical-align: middle;
            width: 50px,
        }

        .slideshowpic {
            max-width: auto;
            position: relative;
            margin: auto;
        }

        /* Fading animation */
        .fading {
            animation-name: fade;
            animation-duration: 1.5s;
        }

        @keyframes fade {
            from {
                opacity: .4
            }

            to {
                opacity: 1
            }
        }

        /* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 600px) {
            .row {
                flex: 100%;
                max-width: 100%;
            }
        }
    </style>

</head>


<!--cookies = Without cookies, you’d have to login again after you leave a site or rebuild your shopping cart if you accidentally close the page. -->

<body onload="loadCookies()">
    <header class="w3-header w3-red w3-center w3-padding">
        <h2><b>My Tutor Websites</b></h2>
    </header>
    <div class="bg">
        <div class=" w3-container w3-padding-64 w3-margin">
            <div class="w3-row w3-border">
                <div class="w3-card w3-half w3-center">
                    <div class="slideshowpic">
                        <div class="slide fading">
                            <img src="../assets/courses/1.png" style="width:100%;height:600px">
                        </div>
                        <div class="slide fading">
                            <img src="../assets/courses/3.png" style="width:100%;height:600px">
                        </div>

                    </div>
                </div>
                <script>
                    let slideIndex = 0;
                    showSlides();

                    function showSlides() {
                        let i;
                        let slides = document.getElementsByClassName("slide");
                        for (i = 0; i < slides.length; i++) {
                            slides[i].style.display = "none";
                        }
                        slideIndex++;
                        if (slideIndex > slides.length) {
                            slideIndex = 1
                        }
                        slides[slideIndex - 1].style.display = "block";
                        setTimeout(showSlides, 2000); // Change image every 2 seconds
                    }
                </script>

                <div class="w3-container w3-card w3-half w3-center" style="width: 50%; height: 600px;margin:auto;text-align:left;">
                    <div style="text-align: center;">
                        <h2 style="color:Tomato; font-size:50px;"><b>Login Form</b></h2>
                    </div><br>
                    <form name="loginForm" action="login.php" method="post">
                        <p style="text-align:left;font-size: 25px; padding-left: 64px;padding-right: 64px;">
                            <label style="color:Tomato;"><b>Email</b></label>
                            <input class="w3-input w3-round w3-border" type="email" name="email" id="idemail" placeholder="Your email" required>
                        </p>
                        <p style="text-align:left;font-size: 25px; padding-left: 64px;padding-right: 64px;">
                            <label style="color:Tomato;"><b>Password</b></label>
                            <input class="w3-input w3-round w3-border" type="password" name="password" id="idpass" placeholder="Your password" required>
                        </p>
                        <p style="text-align:left;padding-left: 64px;padding-right: 64px;">
                            <input class="w3-check" name="rememberme" type="checkbox" id="idremember" onclick="rememberMe()">
                            <label>Remember Me</label>
                        </p>
                        <div class="row">
                                <p style="text-align: center;padding-left: 64px;padding-right: 64px;">
                                    <input class="w3-btn w3-red w3-round w3-padding-20" type="submit" name="submit" id="login" value="Login">
                                </p>
                        </div>

                        <div style=color:blue;><a href="php/register1.php">Not yet registered? Click Me!</a></div>

                    </form>
                </div>

            </div>

        </div>
    </div>
    <div id="cookieNotice" class="w3-container w3-padding-64 w3-margin">
        <div class="w3-left w3-middle w3-white">
            <h4><b>Cookie Consent</b></h4>
            <p>This website uses cookies or similar technologies, to enhance your
                browsing experience and provide personalized recommendations.
                By continuing to use our website, you agree to our
                <a style="color:#115cfa;" href="/privacy-policy">Privacy Policy</a>
            </p>
            <div class="w3-button">
                <button style="border-radius: 10px;" onclick="acceptCookieConsent();">Accept</button>
            </div>
        </div>
    </div>
    <footer class="w3-footer w3-center w3-bottom w3-red">
        <p>My Tutor Websites</p>
    </footer>
</body>
<script>
    let cookie_consent = getCookie("user_cookie_consent");
    if (cookie_consent != "") {
        document.getElementById("cookieNotice").style.display = "none";
    } else {
        document.getElementById("cookieNotice").style.display = "block";
    }
</script>


</html>