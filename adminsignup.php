<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("localhost", "root", "", "yummywebsite");

if ($conn->connect_error) {
    die("Connection Failed : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $email = trim($_POST['email']);
    $pass = trim($_POST['pass']);

    $image = "";

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {

        $image = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];

        move_uploaded_file($tmp, "uploads/" . $image);

    } else {
        die("Please select an image.");
    }

    // Check Email Already Exists
    $check = $conn->prepare("SELECT id FROM admin_signup WHERE email=?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {

        echo "<script>
        alert('Email already exists');
        window.location='signup.html';
        </script>";

        exit();

    }

    // Password Hash
    $hash = password_hash($pass, PASSWORD_DEFAULT);

    // Insert Data
    $stmt = $conn->prepare("INSERT INTO admin_signup(fname,lname,email,pass,image) VALUES(?,?,?,?,?)");

    $stmt->bind_param("sssss", $fname, $lname, $email, $hash, $image);

    if ($stmt->execute()) {

        echo "<script>
        alert('Signup Successful');
        window.location='admin.html';
        </script>";

    } else {

        echo "Error : " . $stmt->error;

    }

    $stmt->close();
}

$conn->close();
?>