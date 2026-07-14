<?php
$conn = new mysqli("localhost", "root", "", "yummywebsite");

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

$id = $_POST['id'];
$fulname = $_POST['fulname'];
$emaildt = $_POST['emaildt'];
$phonenum = $_POST['phonenum'];
$date = $_POST['date'];
$time = $_POST['time'];
$pnumber = $_POST['pnumber'];
$message = $_POST['message'];

$stmt = $conn->prepare("UPDATE yummywebbtb SET
    fulname=?,
    emaildt=?,
    phonenum=?,
    `date`=?,
    `time`=?,
    pnumber=?,
    `message`=?
    WHERE id=?");

$stmt->bind_param(
    "ssissisi",
    $fulname,
    $emaildt,
    $phonenum,
    $date,
    $time,
    $pnumber,
    $message,
    $id
);

if ($stmt->execute()) {
    echo "<script>
            alert('Booking Updated Successfully');
            window.location='dashboard.php';
          </script>";
} else {
    echo "Error : " . $stmt->error;
}
?>