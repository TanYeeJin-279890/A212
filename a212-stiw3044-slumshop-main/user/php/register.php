<?php
if (isset($_POST['submit'])) {
    include_once("dbconnect.php");
    $operation = $_POST['submit'];
    $custName = addslashes($_POST['name']);
    $custEmail = addslashes($_POST['email']);
    $custPassword = sha1($_POST['password']);
    $custphone = $_POST['phone'];
    $custState = $_POST['state'];
    $custotp = rand(10000, 99999);
    $credit = 5;
    $custaddress = $_POST['address'];


    $sqlregister = "INSERT INTO `tbl_customer`( `cust_name`, `cust_email`, `cust_password`, `cust_phone`, `cust_state`, 
    `cust_del_add`, `cust_otp`, `cust_credit`) 
    VALUES ('$custName','$custEmail','$custPassword','$custphone','$custState',' $custaddress ',' $custotp','$credit')";
    try {
        $conn->exec($sqlregister);
        echo "<script>alert('Success')</script>";
        echo "<script>window.location.replace('login.php')</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Failed')</script>";
        echo "<script>window.location.replace('register.php')</script>";
    }
}


function sendmail($custEmail,$custotp){

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
    <script src="../js/menu.js"></script>
    <script src="../js/script.js"></script>

    <title>Welcome to SlumShop</title>
</head>

<body>
    <!-- Sidebar -->
    <div class="w3-sidebar w3-bar-block" style="display:none" id="mySidebar">
        <button onclick="w3_close()" class="w3-bar-item w3-button w3-large">Close &times;</button>
        <a href="index.php" class="w3-bar-item w3-button">My Dashboard</a>
        <a href="products.php" class="w3-bar-item w3-button">My Products</a>
        <a href="#" class="w3-bar-item w3-button">Customer</a>
        <a href="#" class="w3-bar-item w3-button">Orders</a>
        <a href="#" class="w3-bar-item w3-button">Reports</a>
        <a href="#" class="w3-bar-item w3-button">Logout</a>
    </div>

    <div class="w3-yellow">
        <button class="w3-button w3-yellow w3-xlarge" onclick="w3_open()">☰</button>
        <div class="w3-container">
            <h3>Registration Page</h3>

        </div>
    </div>
    <div class="w3-bar w3-yellow">
        <a href="products.php" class="w3-bar-item w3-button w3-right">Back</a>
    </div>
    <div class="w3-content w3-padding-32">
        <form class="w3-card w3-padding" action="register.php" method="post" enctype="multipart/form-data" onsubmit="return confirm('Are you sure?')">
            <div class="w3-container w3-yellow">
                <h3>Registration Form</h3>
            </div>
            <hr>
            <input type="hidden" name="prid" value="">
            <div class="w3-row">
                <div class="w3-half" style="padding-right:4px">
                    <p>
                        <label><b>User Name</b></label>
                        <input class="w3-input w3-border w3-round" name="name" type="text" required>
                    </p>
                </div>
                <div class="w3-half" style="padding-right:4px">
                    <p>
                        <label><b>User Email</b></label>
                        <input class="w3-input w3-border w3-round" name="email" type="text" value="" required>
                    </p>
                </div>
            </div>
            <div class="w3-row">
                <div class="w3-half" style="padding-right:4px">
                    <p>
                        <label><b>User Phone</b></label>
                        <input class="w3-input w3-border w3-round" name="phone" type="text" value="" required>
                    </p>
                </div>
                <div class="w3-half" style="padding-right:4px">
                    <p>
                        <label><b>User States</b></label>
                        <select class="w3-select w3-border w3-round" name="state">
                            <option value="Kedah">Kedah</option>
                            <option value="Melaka">Melaka</option>
                            <option value="Kuala Lumpur">Kuala Lumpur</option>
                            <option value="Selangor">Selangor</option>
                            <option value="Seremban">Seremban</option>
                            <option value="Perlis">Perlis</option>
                            <option value="Kuantan">Kuantan</option>
                        </select>
                    </p>
                </div>
            </div>
            <div class="w3-row">
                <div class="w3-half" style="padding-right:4px">
                    <p>
                        <label><b>User Password</b></label>
                        <input class="w3-input w3-border w3-round" name="password" type="password" value="" required>
                    </p>
                </div>
                <div class="w3-half" style="padding-right:4px">
                    <p>
                        <label><b>User Re-enter Password</b></label>
                        <input class="w3-input w3-border w3-round" name="productname" type="password" value="" required>
                    </p>
                </div>
            </div>
            <div class="w3-row">
                <p>
                    <label><b>User Address</b></label>
                    <textarea class="w3-input w3-border w3-round" rows="4" width="100%" name="address" required></textarea>
                </p>
            </div>
            <div class="w3-row">
                <div class="w3-half" style="padding-right:4px">
                    <p>
                        <input class="w3-check" name="agreebox" type="checkbox" value="Agree" required>
                        <label for="agreebox"> I Agree.</label><br>
                    </p>
                </div>
            </div>

            <div class="w3-row">
                <p>
                    <input class="w3-button w3-yellow w3-round w3-block w3-border" type="submit" name="submit" value="Register">
                </p>
            </div>
        </form>
    </div>

    <footer class="w3-footer w3-center w3-bottom w3-yellow">Slumshop</footer>

</body>

</html>