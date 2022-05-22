<?php


include_once("dbconnect.php");

if (isset($_POST['register'])) {

    if (!(isset($_POST["name"]) || isset($_POST["email"]) || isset($_POST["phone"]) || isset($_POST["password"]) || isset($_POST["address"]))) {
        echo "<script> alert('Please fill in all required information')</script>";
        echo "<script> window.location.replace('register1.php')</script>";
    } else {
        if (file_exists($_FILES["fileToUpload"]["tmp_name"]) || is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])) {

            $name = $_POST["name"];
            $address = $_POST["address"];
            $password = $_POST["password"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];

            echo  "$name, $address, $password, $email,$phone";

            $sqlregister = "INSERT INTO `tbl_register`( `user_name`, `user_address`, `user_password`, `user_email`, `user_phone`) VALUES('$name', '$address', '$password', '$email', '$phone')";
            try {
                $conn->exec($sqlregister);
                uploadImage($icno);
                echo "<script>alert('Registration successful')</script>";
                echo "<script>window.location.replace('login.html')</script>";
            } catch (PDOException $e) {
                echo "<script>alert('Registration failed')</script>";
                echo "<script>window.location.replace('register1.php')</script>";
            }
        } else {

            $name = $_POST["name"];
            $address = $_POST["address"];
            $citizenship = $_POST["password"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $sqlregister = "INSERT INTO `tbl_register`( `name`, `address`, `password`, `email`, `phone`) VALUES( '$name', '$address', '$password', '$email', '$phone')";
            try {
                $conn->exec($sqlregister);
                echo "<script>alert('Registration successful')</script>";
                echo "<script>window.location.replace('login.html')</script>";
            } catch (PDOException $e) {
                echo "<script>alert('Registration failed')</script>";
                echo "<script>window.location.replace('register.php')</script>";
            }
        }
    }
}


function uploadImage($email)
{
    $target_dir = "My_Tutor/user/res/image/user/";
    $target_file = $target_dir . $email . ".png";
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Registration Page</title>


    <style>
        body {
            background-color: LavenderBlush;
            
        }

        .header {
            overflow: hidden;
            background-color: red;
            padding: 20px 10px;
        }

        /* Create two unequal columns that floats next to each other */
        .column {
            float: left;
            padding: 10px;
            height: 300px;

        }

        .left {
            width: 30%;
        }

        .right {
            width: 70%;
           
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
            <b>My Tutor Websites</b>
        </div>
    </div>

    <div class="w3-container w3-card w3-padding w3-margin">
        <div class="w3-content w3-margin">
            <div class="column left">
                <img src="Capture.PNG" style="max-width: 115%; height:auto;">
            </div>

            <div class="column right w3-padding-20" style="display:flex; justify-content: center">
                <form style="margin: auto; width: 220px;" action="register1.php" method="post" enctype="multipart/form-data" onsubmit="return confirm('Are you sure to register?')">
                    <div class="w3-container w3-card w3-padding w3-margin" style="width:600px;margin:auto;text-align:left;">

                        <h2 style="text-align:center;font-weight:bold;">Registration Form</h2>

                        <div class="w3-container w3-center">
                            <img class="imgselection" src="../user/res/image/userpic.png" style="width:30%"><br>
                            <div>
                                <h4>Upload your Profile Image</h4><br>
                            </div>
                            <input type="file" onchange="previewFile()" name="fileToUpload" id="fileToUpload"><br>
                        </div>

                        <div>
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
                                <input class="w3-input w3-round w3-border" type="text" name="password" placeholder="Your Password" required>
                            </p>

                            <p>
                                <label><b>Re-enter Password</b></label>
                                <input class="w3-input w3-round w3-border" type="text" name="repassword" placeholder="Your Password" required>
                            </p>

                            <p>
                                <label><b>Phone</b></label>
                                <input class="w3-input w3-round w3-border" type="text" name="phone" placeholder="Your Phone No." required>
                            </p>

                            <p>
                                <label><b>Address</b></label>
                                <input class="w3-input w3-round w3-border" type="text" name="address" placeholder="Your Home Address" required>
                            </p>
                            <br>
                            <p style="text-align: center;">
                                <input class="w3-button w3-red w3-round w3-padding-20" type="register" name="register" value="Register">
                            </p>
                        </div>

                    </div>
                </form>
            </div>

        </div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <p style="text-align: right;">Jean(2022)</p>
 </div>


</body>

</html>