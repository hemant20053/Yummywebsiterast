<?php

$fname = $_POST['flname'];
$emaildata = $_POST['emaildata'];
$subject = $_POST['subject'];
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

$sql = "INSERT INTO yummyweb (flname, emaildata, `subject`, `message`)
VALUES ('$fname', '$emaildata', '$subject','$message')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>