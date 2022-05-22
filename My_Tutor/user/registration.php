<?php
include_once("dbconnect.php");

if (isset($_POST['Register'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    $phone = $_POST['phone'];
    $address = $_POST['address'];


    $sqlregistration = "INSERT INTO `tbl_register`(`user_name`, `user_email`,`user_password`, 
    `user_phone`, `user_address`) VALUES ('$name','$email','$password','$phone','$address')";

    try {
        $conn->exec($sqlregistration);
        if (file_exists($_FILES["fileToUpload"]["tmp_name"]) || is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])) {
            $last_id = $conn->lastInsertId();
            uploadImage($last_id);
            echo "<script>alert('Registration Success')</script>";
            echo "<script>window.location.replace('login.html')</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Registration Failed')</script>";
        echo "<script>window.location.replace('registration.php')</script>";
    }
}

function uploadImage($filename)
{
    $target_dir = "../res/image/user";
    $target_file = $target_dir . $filename . ".png";
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>

<body onload="loadCookies()">
    <header class="w3-header w3-yellow w3-center w3-padding-32">
        <h3>My Tutor Website</h3>
        <p>Registration Page</p>
    </header>

    <div style="display:flex; justify-content: center">
        <div class="w3-container w3-card w3-padding w3-margin" style="width:600px;margin:auto;text-align:left;">


            <form name="RegistrationForm" action="registration.php" method="post">

                <div class="w3-container w3-center">
                    <img class="imgselection" src="../user/res/image/userpic.png" style="width:50%"><br>
                    <div class="w3-tag w3-blue">
                        <p> Upload Profile Image</p>
                    </div>
                    <p> </p>
                    <input type="file" onchange="previewFile()" name="fileToUpload" id="fileToUpload"><br>



                </div>
                <div>
                    <p>
                        <label><b>Name</b></label>
                        <input class="w3-input w3-round w3-border" type="text" name="name" placeholder="Your Name" required>
                    </p>
                </div>
                <div>
                    <p>
                        <label><b>Email</b></label>
                        <input class="w3-input w3-round w3-border" type="text" name="email" placeholder="Your Email Address" required>
                    </p>
                </div>
                <div>
                    <p>
                        <label><b>Password</b></label>
                        <input class="w3-input w3-round w3-border" type="text" name="password" placeholder="Your Password" required>
                    </p>
                </div>
                <div>
                    <p>
                        <label><b>Re-enter Password</b></label>
                        <input class="w3-input w3-round w3-border" type="text" name="repassword" placeholder="Your Password" required>
                    </p>
                </div>
                <div>
                    <p>
                        <label><b>Phone</b></label>
                        <input class="w3-input w3-round w3-border" type="text" name="phone" placeholder="Your Phone No." required>
                    </p>
                </div>
                <div>
                    <p>
                        <label><b>Address</b></label>
                        <input class="w3-input w3-round w3-border" type="text" name="address" placeholder="Your Home Address" required>
                    </p>
                </div>

                <p>
                    <input class="w3-button w3-round w3-border w3-yellow" type="Register" name="Register" value="Insert">
                </p>

        </div>
        </form>
    </div>


</body>

</html>