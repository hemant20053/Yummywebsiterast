<?php
session_start();

$conn = new mysqli("localhost", "root", "", "yummywebsite");

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

if (!isset($_SESSION['verified'])) {

    die("Unauthorized");

}

if (isset($_POST['change'])) {

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $email = $_SESSION['email'];

    $sql = "UPDATE admin_signup SET pass=? WHERE email=?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ss", $password, $email);

    $stmt->execute();

    session_destroy();

    echo "Password Changed Successfully.";

    echo "<br><a href='login.php'>Login Now</a>";

}

?>

<!DOCTYPE html>

<html>

<head>

    <title>Reset Password</title>

</head>

<body>

    <form method="POST">

        <input type="password" name="password" placeholder="New Password" required>

        <br><br>

        <button name="change">

            Update Password

        </button>

    </form>

</body>

</html>