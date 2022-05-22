<?php


include_once("dbconnect.php");

    if (isset($_POST['submit'])) {

        if (!(isset($_POST["name"]) || isset($_POST["email"]) || isset($_POST["phone"]) || isset($_POST["password"]) || isset($_POST["address"]))) {
            echo "<script> alert('Please fill in all required information')</script>";
            echo "<script> window.location.replace('register.php')</script>";
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
                    echo "<script>window.location.replace('register.php')</script>";
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
    $target_dir = "My_Tutor(TanYeeJin_279890)/user/res/image/user/";
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
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="../js/login.js" defer></script>
</head>


<body >
    <header class="w3-header w3-blue w3-center w3-padding-32">
        <h3>My Tutor </h3>
        <p>Register Page</p>
    </header>

    <div class="w3-bar">
        <a href="login.html" class="w3-bar-item w3-button w3-right">Back</a>
    </div>


    <div class="w3-content w3-padding-32">
        <form class="w3-card w3-padding" action="register.php" method="post" enctype="multipart/form-data" onsubmit="return confirm('Are you sure?')">
            <div class="w3-container w3-blue-grey">
                <h3>Registration Form</h3>
            </div>

            <div class="w3-container w3-center">
                <img class="imgselection" src="../images/profile/2.jpg" style="width:50%"><br>
                <div class="w3-tag w3-blue">  <p> Upload Profile Image</p>  </div>
                <p> </p>
                        <input type="file" onchange="previewFile()" name="fileToUpload" id="fileToUpload"><br>
                     
                  
                       
            </div>
            <hr>

            <div class="w3-row">
                <div class="w3-half" style="padding-right:4px">
                    <p>
                        <label><b> Name</b></label>
                        <input class="w3-input w3-border w3-round" name="name" type="text" required>
                    </p>
                </div>
                <div class="w3-half" style="padding-right:4px">
                    <p>
                        <label><b>Email</b></label>
                        <input class="w3-input w3-border w3-round" name="email" type="text" required>
                    </p>
                </div>
            </div>
           
            <div class="w3-row">
                <div class="w3-half" style="padding-right:4px">
                    <p>
                        <label><b>Phone Number</b></label>
                        <input class="w3-input w3-border w3-round" name="phone" type="number" required>
                    </p>
                </div>
                <div class="w3-half" style="padding-right:4px">
                    <p>
                        <label><b>Password</b></label>
                        <input class="w3-input w3-border w3-round" name="password" type="text" step="any" required>
                    </p>
                </div>
               

                <p>
                <label><b>Home Address</b></label>
                <textarea class="w3-input w3-border w3-round" rows="4" width="100%" name="address" required></textarea>
            </p>
                <p>
                    <input class="w3-button w3-blue-grey w3-round w3-block w3-border w3-padding-20" type="submit" name="submit" value="Insert">
                </p>
            </div>
        </form>
    </div>
  
    <footer class="w3-footer w3-center w3-blue w3-bottom">
        <p>My Tutor</p>
    </footer>

</body>


</html>