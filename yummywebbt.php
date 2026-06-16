<?php

$funame = $_POST['fulname'];
$emaildata = $_POST['emaild'];
$phonenum = $_POST['phonenum'];
$date = $_POST['date'];
$time = $_POST['time'];
$phonenum = $_POST['pnumber'];
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

$sql = "INSERT INTO yummywebbtb (fulname, emaild, phonenum, date, time, pnumber, message)
VALUES ('$funame', '$emaildata', '$phonenum','$date','$time', '$phonenum', '$message')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>