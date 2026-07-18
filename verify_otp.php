<?php
session_start();

$conn = new mysqli("localhost", "root", "", "yummywebsite");

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

if (isset($_POST['verify'])) {

    $userotp = $_POST['otp'];

    if (time() - $_SESSION['otp_time'] > 300) {
        die("OTP Expired");
    }

    if ($userotp == $_SESSION['otp']) {

        $_SESSION['verified'] = true;

        header("Location: reset_password.php");

    } else {

        echo "Wrong OTP";

    }

}

?>

<!DOCTYPE html>

<html>

<head>

    <title>Verify OTP</title>

</head>

<body>

    <form method="POST">

        <input type="text" name="otp" placeholder="Enter OTP" required>

        <br><br>

        <button name="verify">

            Verify OTP

        </button>

    </form>

</body>

</html>