<?php
session_start();

$conn = new mysqli("localhost", "root", "", "yummywebsite");

if ($conn->connect_error) {
    die("Connection Failed : " . $conn->connect_error);
}

$email = $_POST['email'];
$pass = $_POST['pass'];

$stmt = $conn->prepare("SELECT * FROM admin_signup WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 1) {

    $row = $result->fetch_assoc();

    // Verify Hashed Password
    if (password_verify($pass, $row['pass'])) {

        $_SESSION['admin_id'] = $row['id'];
        $_SESSION['admin_name'] = $row['fname'];

        header("Location: dashboard.php");
        exit();

    } else {

        echo "Wrong Password";

    }

} else {

    echo "Email Not Found";

}
?>