<?php

$funame = $_POST['fulname'];
$emaildata = $_POST['emaildt'];
$phonenum = $_POST['phonenum'];
$date = $_POST['date'];
$time = $_POST['time'];
$peonum = $_POST['pnumber'];
$message = $_POST['message'];


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "yummywebsite";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO yummywebbtb (fulname, emaildt, phonenum, `date`, `time`, pnumber, `message`)
VALUES ('$funame', '$emaildata', '$phonenum','$date','$time', '$peonum', '$message')";

if (mysqli_query($conn, $sql)) {
    header("Location: indexwelcome.html");
    exit;
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>