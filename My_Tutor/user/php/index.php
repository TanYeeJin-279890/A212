<?php

session_start();
if (isset($_SESSION['sessionid'])) {
    $user_email = $_SESSION['email'];
    $user_name = $_SESSION['name'];
    $user_phone = $_SESSION['phone'];
    //$carttotal = 0;
} else {
    $user_email = "guest@slumberjer.com";
    // $carttotal = 0;
}

include_once("dbconnect.php");
$sqltutor = "SELECT tbl_subjects.subject_id, tbl_subjects.subject_name, tbl_subjects.subject_description,  tbl_subjects.subject_price, tbl_subjects.subject_sessions, tbl_subjects.subject_rating,tbl_tutors.tutor_name, tbl_tutors.tutor_id FROM tbl_subjects 
INNER JOIN tbl_tutors ON tbl_subjects.tutor_id = tbl_tutors.tutor_id";

if (isset($_GET['submit'])) {
    $operation = $_GET['submit'];
    if ($operation == 'search') {
        $search = $_GET['search'];
        $sqlsubject = "SELECT * FROM tbl_subjects WHERE subject_name LIKE '%$search%'";
        
    }
} else {
    $sqlsubject = "SELECT * FROM tbl_subjects";
}

$results_per_page = 10;
if (isset($_GET['pageno'])) {
    $pageno = (int)$_GET['pageno'];
    $page_first_result = ($pageno - 1) * $results_per_page;
} else {
    $pageno = 1;
    $page_first_result = 0;
}


$stmt = $conn->prepare($sqltutor);
$stmt->execute();
$number_of_result = $stmt->rowCount();
$number_of_page = ceil($number_of_result / $results_per_page);
$sqltutor = $sqltutor . " LIMIT $page_first_result , $results_per_page";


$stmt = $conn->prepare($sqltutor);
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
    <title>Courses MainPage</title>

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
        <div class="w3-row">
            <div class="w3-col" style="width:50px"><button class="w3-button w3-red w3-xlarge" onclick="w3_open()">☰</button></div>
            <div class="w3-col w3-center" style="width:250px">
                <h3><b>Interesting Courses</b></h3>
            </div>
            <div class="w3-rest"><a href="login.php" class="w3-right"><i class="fa fa-user" style="font-size:32px;padding:10px;"></i></a></div>
        </div>

    </div>
    <div class="w3-card w3-container w3-padding w3-margin w3-round">
        <h3>Course Search</h3>
        <form>
            <div style="padding-right:4px">
                <p><input class="w3-input w3-block w3-round w3-border" type="search" name="search" placeholder="Enter search term" /></p>
            </div>
            <button class="w3-button w3-red w3-round w3-right" type="submit" name="submit" value="search">search</button>
        </form>
    </div>
    <div class="w3-grid-template w3-center">
        <?php
        $i = 0;
        foreach ($rows as $subjects) {
            $i++;
            $subid = $subjects['subject_id'];
            $tutorid = $subjects['tutor_id'];
            $tutorname = truncate($subjects['tutor_name'], 30);
            $subname = truncate($subjects['subject_name'], 20);
            $subdesc = truncate($subjects['subject_description'], 60);
            $subsess = $subjects['subject_sessions'];
            $subprice = number_format((float)$subjects['subject_price'], 2, '.', '');
            $subrate = $subjects['subject_rating'];
            echo "<a href='tutor.php?tutor_id=$tutorid' style='text-decoration: none;'> <div class='w3-card-4 w3-round'>
            <header class='w3-container w3-red'><h4><b>$subname</b></h4></header>";
            echo "<img class='w3-image' src=../assets/courses/$subid.png"
                . " style='width:100%;height:250px'><hr>";
            echo "<div class='w3-container'>
            <p style='font-size:16px'><b>Tutor:</b> $tutorname<br>
            <p style='font-size:16px'><b>Desc:</b> $subdesc<br>
            <b style='font-size:20px'>Price: RM $subprice<br></b>
            <b>Session:</b>     $subsess<br>
            <b>Ratings:</b>      $subrate</p></div>
            </div></a>";
        }
        ?>
    </div>
    <br>
    <div class="w3-center">
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
           if($page==$pageno){
            echo '<a href = "index.php?pageno=' . $page . '"
            id="page" style="color: red;background-color:LavenderBlush;">&nbsp&nbsp' . $page . ' </a>';
           }else{
            echo '<a href = "index.php?pageno=' . $page . '"
            id="page" style="color: black;">&nbsp&nbsp' . $page . ' </a>';
           }
        }
        echo "</div>";
        ?>
    </div>

    <div class="w3-container w3-row" style="width:40px;height:50px;"></div>

    <footer class="w3-footer w3-center w3-bottom w3-red">My Tutor</footer>

</body>

</html>