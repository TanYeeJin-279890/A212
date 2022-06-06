<?php
include_once("dbconnect.php");
if (isset($_GET['submit'])) {
    $operation = $_GET['submit'];
    if ($operation == 'search') {
        $search = $_GET['search'];
        $sqltutors = "SELECT * FROM tbl_tutors WHERE tutor_name LIKE '%$search%'";
    }
} else {
    $sqltutors = "SELECT * FROM tbl_tutors";
}

$results_per_page = 10;
if (isset($_GET['pageno'])) {
    $pageno = (int)$_GET['pageno'];
    $page_first_result = ($pageno - 1) * $results_per_page;
} else {
    $pageno = 1;
    $page_first_result = 0;
}


$stmt = $conn->prepare($sqltutors);
$stmt->execute();
$number_of_result = $stmt->rowCount();
$number_of_page = ceil($number_of_result / $results_per_page);
$sqltutors = $sqltutors . " LIMIT $page_first_result , $results_per_page";
$stmt = $conn->prepare($sqltutors);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();

$conn = null;


function truncate($string, $length, $dots = "...")
{
    return (strlen($string) > $length) ? substr($string, 0, $length - strlen($dots)) . $dots : $string;
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
    <title>Tutors Page</title>

</head>

<body>
    <!-- Sidebar -->
    <div class="w3-sidebar w3-bar-block" style="display:none" id="mySidebar">
        <button onclick="w3_close()" class="w3-bar-item w3-button w3-large">Close &times;</button>
        <a href="index.php" class="w3-bar-item w3-button">Courses</a>
        <a href="tutor.php" class="w3-bar-item w3-button">Tutors</a>
        <a href="#" class="w3-bar-item w3-button">My Profile</a>
        <a href="#" class="w3-bar-item w3-button">My Subscription</a>
        <a href="#" class="w3-bar-item w3-button">Customer Service</a>

    </div>

    <div class="w3-red">
        <div>
            <button class="w3-button w3-red w3-xlarge" onclick="w3_open()">☰</button>
            <h3>Awesome Tutors</h3>
        </div>

    </div>
    <div class="w3-card w3-container w3-padding w3-margin w3-round">
        <h3>Tutor Search</h3>
        <form>
            <div style="padding-right:4px">
                <p><input class="w3-input w3-block w3-round w3-border" type="search" name="search" placeholder="Enter search term" /></p>
            </div>
            <button class="w3-button w3-red w3-round w3-right" type="submit" name="submit" value="search">search</button>
        </form>

    </div>
    <div class="w3-grid-template w3-center">
        <?php
        //join subject table
        $i = 0;
        foreach ($rows as $tutors) {
            $i++;
            $tutorid = $tutors['tutor_id'];
            $tutorsname = truncate($tutors['tutor_name'], 50);
            $tutorsemail = $tutors['tutor_email'];
            $tutorsdesc = truncate($tutors['tutor_description'], 60);
            $tutorsphone = $tutors['tutor_phone'];

            echo "<a href='tutor.php?tutor_id=$tutorid' style='text-decoration: none;'> 
            <div class='w3-card-4 w3-round' style='text-align:justify'>";
            echo "<img class='w3-image' src=../assets/tutors/$tutorid.jpg"
                . " style='width:100%;height:300px;'><hr>";
            echo "<div class='w3-container'>
            <p><b>Name:</b><br> $tutorsname<br>
            <b>Phone No.:</b><br> $tutorsphone<br>
            <b>Email:</b><br> $tutorsemail<br>
            <p><b>Descriptions:</b><br> $tutorsdesc<br>
            </p></p>
            </div></div></a>";
        }
        ?>
    </div>
    <br>

    <!-- wanted to have more fancy design for pagination -->
    <?php
    $num = 1;
    if ($pageno == 1) {
        $num = 1;
    } else if ($pageno == 2) {
        $num = ($num) + 10;
    } else {
        $num = $pageno * 10 - 9;
    }
    echo "<div class='pagination'>";
    for ($page = 1; $page <= $number_of_page; $page++) {
        echo '<a href = "index.php?pageno=' . $page . '"
        id="page" style="text-decoration: none" onclick="pageFunc()">&nbsp&nbsp' . $page . ' </a>';
    }
    echo "</div>";
    ?>


    <div class="w3-container w3-row" style="width:40px;height:50px;"></div>

    <footer class="w3-footer w3-center w3-bottom w3-red">My Tutor</footer>

</body>

</html>