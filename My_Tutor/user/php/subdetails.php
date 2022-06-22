<?php

include_once("dbconnect.php");
if (isset($_GET['sid'])) {
    $sid = $_GET['sid'];
    $sqlsubdetails = "SELECT tbl_subjects.subject_id, tbl_subjects.subject_name, tbl_subjects.subject_description,  tbl_subjects.subject_price, tbl_subjects.subject_sessions, tbl_subjects.subject_rating,tbl_tutors.tutor_name, tbl_tutors.tutor_id FROM tbl_subjects 
    INNER JOIN tbl_tutors ON tbl_subjects.tutor_id = tbl_tutors.tutor_id WHERE subject_id = '$sid'";
    $stmt = $conn->prepare($sqlsubdetails);
    $stmt->execute();
    $number_of_result = $stmt->rowCount();
    if ($number_of_result > 0) {
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rows = $stmt->fetchAll();
    } else {
        echo "<script>alert('Subject not found.');</script>";
        echo "<script> window.location.replace('index.php')</script>";
    }
} else {
    echo "<script>alert('Page Error.');</script>";
    echo "<script> window.location.replace('index.php')</script>";
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


    <style>
        .row {
            text-align: center;
            vertical-align: middle;
            display: flex;
        }

        /* Create three equal columns that sits next to each other */
        .column {
            flex: 50%;
            padding: 3px;
        }
    </style>

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
            <div class="w3-col" style="width:50px"><button class="w3-button w3-red w3-xlarge" onclick="w3_open()">&#9776;</button></div>
            <div class="w3-col w3-center" style="width:250px">
                <h3><b>Interesting Courses</b></h3>
            </div>
            <div class="w3-rest"><a href="login.php" class="w3-right"><i class="fa fa-user" style="font-size:32px;padding:10px;"></i></a></div>
        </div>

    </div>

    <div class="w3-center">
        <?php
        $i = 0;
        foreach ($rows as $subjects) {
            $i++;
            $subid = $subjects['subject_id'];
            $subname = $subjects['subject_name'];
            $subdesc = $subjects['subject_description'];
            $subsess = $subjects['subject_sessions'];
            $subprice = number_format((float)$subjects['subject_price'], 2, '.', '');
            $subrate = $subjects['subject_rating'];
            $tutorname = $subjects['tutor_name'];
            $tutorid = $subjects['tutor_id'];

            echo "<a href='subdetails.php?sid=$subid' style='text-decoration: none;'>
            <div class='w3-card w3-round' style='font-family: cursive'><h2 style='font-family: Impact'><b>$subname</b></h2>";

            echo "
            <div class='row'>
            <div class='column'>
            <img class='w3-image' src=../assets/courses/$subid.png"
                . " style='width:100%;height:auto'><hr></div>
                <div class='column'>
                <img class='w3-image' src=../assets/tutors/$tutorid.jpg"
                . " style='width:50%;height:auto'><hr></div></div>";
            echo "<div class='text w3-container' style='text-align:justify;'>
            <p style='font-size:20px'><b>Tutor Name:</b> $tutorname<br>
            <p style='font-size:20px'><b>Descriptions:</b> $subdesc<br>
            <b style='font-size:24px; color:red;'>Price: RM $subprice<br></b>
            <b>Session:</b>     $subsess<br>
            <b>Ratings:</b>      $subrate</p><br><br>
            </div>
            
            </div></a>
            ";
        }
        ?>

    </div>

    <footer class="w3-footer w3-center w3-bottom w3-red">My Tutor</footer>

</body>

</html>