<?php

if (isset($_POST['register'])) {
    include_once("dbconnect.php");

    if (!(isset($_POST["name"]) || isset($_POST["email"]) || isset($_POST["phone"]) || isset($_POST["password"]) || isset($_POST["address"]))) {
        echo "<script> alert('Please fill in all informations')</script>";
        echo "<script> window.location.replace('register1.php')</script>";
    } else {
        if (file_exists($_FILES["fileToUpload"]["tmp_name"]) || is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])) {

            $name = $_POST["name"];
            $address = $_POST["address"];
            $password = sha1($_POST["password"]);
            $email = $_POST["email"];
            $phone = $_POST["phone"];

            echo  "$name, $address, $password, $email,$phone";

            $sqlregister = "INSERT INTO `tbl_register`( `user_name`, `user_address`, `user_password`, `user_email`, `user_phone`) VALUES('$name', '$address', '$password', '$email', '$phone')";
            try {
                $conn->exec($sqlregister);
                uploadImage($icno);
                echo "<script>alert('Registration successful')</script>";
                echo "<script>window.location.replace('../login.php')</script>";
            } catch (PDOException $e) {
                echo "<script>alert('Registration failed')</script>";
                echo "<script>window.location.replace('register1.php')</script>";
            }
        } else {

            $name = $_POST["name"];
            $address = $_POST["address"];
            $password = sha1($_POST["password"]);
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $sqlregister = "INSERT INTO `tbl_register`( `name`, `address`, `password`, `email`, `phone`) VALUES( '$name', '$address', '$password', '$email', '$phone')";
            try {
                $conn->exec($sqlregister);
                echo "<script>alert('Registration successful')</script>";
                echo "<script>window.location.replace('../login.php')</script>";
            } catch (PDOException $e) {
                echo "<script>alert('Registration failed')</script>";
                echo "<script>window.location.replace('register1.php')</script>";
            }
        }
    }
}


function uploadImage($email)
{
    $target_dir = "../res/image/user/";
    $target_file = $target_dir . $email . ".png";
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="../js/function.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/w3.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Registration Page</title>


    <style>
        body {
            background-color: LavenderBlush;

        }

        /* provide slide show background */
        #SlideShow_bg {
            width: 100%;
            height: 100vh;
            opacity: 0.8;
            background-position: bottom center;
            background-size: cover;
            background-repeat: no-repeat;
            backface-visibility: hidden;
            animation: slideShow 8s linear infinite 0s;
            animation-timing-function: ease-in-out;
            background-image: url('../res/image/tutor_course/Slide1.png');

        }

        @keyframes slideShow {
            0% {
                background-image: url('../res/image/tutor_course/Slide1.png');
            }

            20% {
                background-image: url('../res/image/tutor_course/Slide2.png');
            }

            40% {
                background-image: url('../res/image/tutor_course/Slide3.png');
            }

            60% {
                background-image: url('../res/image/tutor_course/Slide4.png');
            }

            80% {
                background-image: url('../res/image/tutor_course/Slide5.png');
            }

            100% {
                background-image: url('../res/image/tutor_course/Slide6.png');
            }
        }

        .header {
            overflow: hidden;
            background-color: red;
            padding: 20px 10px;
        }

        .label {
            color: black;
        }

        .column {


            float: center;
            padding: 5px;
            height: 300px;


        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;


        }
    </style>

</head>

<body>
    <div class="header">
        <div style="color:white;text-align:center;">
            <h1><b>My Tutor Websites</b></h1>
        </div>
    </div>

    <div id="SlideShow_bg">

        <div class="w3-content">
            <div class="column w3-padding-30" style="display:flex; justify-content: center">
                <form action="register1.php" method="post" enctype="multipart/form-data" onsubmit=" return confirmDialog()">
                    <div class="w3-container w3-card w3-padding w3-margin" style="width:600px;margin:auto;text-align:left;background-color: lavenderBlush;">

                        <h2 style="text-align:center;font-weight:bold;">Registration Form</h2>

                        <div class="w3-container w3-center ">
                            <img class="imgselection" src="../res/image/userpic.png" style="width:30%"><br>
                            <div>
                                <h4>Upload your Profile Image</h4><br>
                            </div>
                            <input type="file" onchange="previewFile()" name="fileToUpload" id="fileToUpload"><br>
                        </div>

                        <div class="label">
                            <p>
                                <label><b>Name</b></label>
                                <input class="w3-input w3-round w3-border" type="text" name="name" placeholder="Your Name" required>

                            </p>

                            <p>
                                <label><b>Email</b></label>
                                <input class="w3-input w3-round w3-border" type="text" name="email" placeholder="Your Email Address" required>
                            </p>

                            <p>
                                <label><b>Password</b></label>
                            <div class="input-icon">

                                <input class="w3-input w3-round w3-border" type="password" name="password" id="Mypassword" placeholder="Your Password" id="password" required>
                                <input class="w3-btn w3-round w3-border" type="checkbox" name="password" id="password" value="pass" onclick="showPass()" required>
                                <label for="password">Show Password</label>

                            </div>
                            </p>
                           

                            <p>
                                <label><b>Re-enter Password</b></label>
                            <div class="input-icon">

                                <input class="w3-input w3-round w3-border" type="password" name="repassword" id="Mypassword" placeholder="Enter Again your Password" id="password" required>

                            </div>
                            </p>
                            <script>
                                function showPass() {
                                    var x = document.getElementById("Mypassword");
                                    if (x.type === "password") {
                                        x.type = "text";
                                    } else {
                                        x.type = "password";
                                    }
                                }
                            </script>


                            <p>
                                <label><b>Phone</b></label>
                                <input class="w3-input w3-round w3-border" type="text" name="phone" placeholder="Your Phone No." required>
                            </p>

                            <p>
                                <label><b>Address</b></label>
                                <input class="w3-input w3-round w3-border" type="text" name="address" placeholder="Your Home Address" required>
                            </p>
                            <br>
                            <div class="row">
                                <p style="text-align: center;">
                                    <input class="w3-btn w3-red w3-round w3-padding-20" type="submit" name="register" value="Register">
                                </p>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>