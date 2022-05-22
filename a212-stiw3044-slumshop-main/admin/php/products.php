<?php
session_start();
if (!isset($_SESSION['sessionid'])) {
    echo "<script>alert('Session not available. Please login');</script>";
    echo "<script> window.location.replace('login.php')</script>";
}
include_once("dbconnect.php");

if (isset($_GET['submit'])) {
    $operation = $_GET['submit'];
    if ($operation == 'delete') {
        $prid = $_GET['prid'];
        $sqldeletepr = "DELETE FROM `tbl_products` WHERE product_id = '$prid'";
        $conn->exec($sqldeletepr);
        echo "<script>alert('Product deleted')</script>";
    }
    if ($operation == 'search') {
        $search = $_GET['search'];
        $option = $_GET['option'];
        if ($option == "Select"){
            $sqlproduct = "SELECT * FROM tbl_products WHERE product_name LIKE '%$search%'";
        }else{
            $sqlproduct = "SELECT * FROM tbl_products WHERE product_type = '$option'";
        }
    }
}
//will change to other as might meet prob when doing for pagination
// if (!isset($sqlproduct)) {
//     $sqlproduct = "SELECT * FROM tbl_products";
// }

//will always display 10 items per page
$results_per_page =10;
if (isset($_GET['pageno'])) {
    $pageno = (int)$_GET['pageno'];//if with page no
    $page_first_result = ($pageno - 1) * $results_per_page;
    } else {
    $pageno = 1;//or else set the first page to 1
    $page_first_result = 0;
    }

$stmt = $conn->prepare($sqlproduct);
$stmt->execute();//small operation
$number_of_result = $stmt->rowCount();
$number_of_page = ceil($number_of_result / $results_per_page);//go to that certain page no
$sqlproduct = $sqlproduct . " LIMIT $page_first_result , $results_per_page";// limit on only load for particular product
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();//most memory consumption for server side

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../js/menu.js" defer></script>

    <title>Welcome to SlumShop</title>
</head>

<body>
    <!-- Sidebar -->
    <div class="w3-sidebar w3-bar-block" style="display:none" id="mySidebar">
        <button onclick="w3_close()" class="w3-bar-item w3-button w3-large">Close &times;</button>
        <a href="index.php" class="w3-bar-item w3-button">Dashboard</a>
        <a href="products.php" class="w3-bar-item w3-button">My Products</a>
        <a href="#" class="w3-bar-item w3-button">Customer</a>
        <a href="#" class="w3-bar-item w3-button">Orders</a>
        <a href="#" class="w3-bar-item w3-button">Reports</a>
        <a href="#" class="w3-bar-item w3-button">Logout</a>
    </div>

    <div class="w3-yellow">
        <button class="w3-button w3-yellow w3-xlarge" onclick="w3_open()">☰</button>
        <div class="w3-container">
            <h3>My Products</h3>
        </div>
    </div>
    <div class="w3-bar w3-yellow">
        <a href="newproduct.php" class="w3-bar-item w3-button w3-right">New Product</a>
    </div>
    <div class="w3-card w3-container w3-padding w3-margin w3-round">
        <h3>Product Search</h3>
        <form>
            <div class="w3-row">
                <div class="w3-half" style="padding-right:4px">
                    <p><input class="w3-input w3-block w3-round w3-border" type="search" name="search" placeholder="Enter search term" /></p>
                </div>
                <div class="w3-half" style="padding-right:4px">
                    <p> <select class="w3-input w3-block w3-round w3-border" name="option">
                            <option value="Select" selected>Select</option>
                            <option value="Bread">Bread</option>
                            <option value="Beverage">Beverage</option>
                            <option value="Condiment">Condiment</option>
                            <option value="Care Product">Care Product</option>
                            <option value="Canned Food">Canned Food</option>
                            <option value="Dairy">Dairy</option>
                            <option value="Dried Food">Dried Food</option>
                            <option value="Meat">Meat</option>
                            <option value="Snack">Snack</option>
                            <option value="Household">Household</option>F
                        </select>
                    </p>
                </div>
            </div>
            <button class="w3-button w3-yellow w3-round w3-right" type="submit" name="submit" value="search">search</button>
        </form>

    </div>
    <div class="w3-margin w3-border" style="overflow-x:auto;">
        <?php
        $i = 0;
        echo "<table class='w3-table w3-striped w3-bordered' style='width:100%'>
         <tr><th style='width:5%'>No</th><th style='width:30%'>Product Name</th><th style='width:10%'>Type</th><th style='width:10%'>Quantity</th><th style='width:10%'>Price</th><th>Status</th><th>Operations</th></tr>";
        foreach ($rows as $products) {
            $i++;
            $prid = $products['product_id'];
            $prname = $products['product_name'];
            $prdesc = $products['product_desc'];
            $prtype = $products['product_type'];
            $prqty = $products['product_qty'];
            $prprice = number_format((float)$products['product_price'], 2, '.', ''); // $products['product_price'];
            $prbc = $products['product_barcode'];
            $prdate = $products['product_date'];
            $prst = $products['product_status'];
            echo "<tr><td>$i</td><td>$prname</td><td>$prtype</td><td>$prqty</td><td>RM $prprice</td><td>$prst</td>
            <td><button class='btn'><a href='products.php?submit=delete&prid=$prid' class='fa fa-trash' onclick=\"return confirm('Are you sure?')\"></a></button>
            <button class='btn'><a href='updateproduct.php?submit=details&prid=$prid' class='fa fa-edit'></a></button></td></tr>";
        }
        echo "</table>";
        ?>
    </div>
    <br>

    <footer class="w3-footer w3-center w3-bottom w3-yellow">Slumshop</footer>

</body>

</html>