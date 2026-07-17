<?php

session_start();

$conn = new mysqli("localhost", "root", "", "yummywebsite");

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$email = mysqli_real_escape_string($conn, $_POST['email']);

$sql = "SELECT * FROM admin_signup WHERE email=?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 0) {

    die("Email not found.");

}

$otp = rand(100000, 999999);

$_SESSION['otp'] = $otp;
$_SESSION['email'] = $email;
$_SESSION['otp_time'] = time();

$mail = new PHPMailer(true);

try {

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;

    $mail->Username = 'hs4754115@gmail.com';
    $mail->Password = 'xilx pdyz tqyp zkmy';

    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('yourgmail@gmail.com', 'Yummy Website');

    $mail->addAddress($email);

    $mail->isHTML(true);

    $mail->Subject = 'Password Reset OTP';

    $mail->Body = "

<h2>Password Reset</h2>

<h1>$otp</h1>

<p>OTP Valid for 5 Minutes.</p>

";

    $mail->send();

    header("Location: verify_otp.php");

} catch (Exception $e) {

    echo $mail->ErrorInfo;

}