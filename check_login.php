<?php
session_start();

// Database Connection
$conn = new mysqli("localhost", "root", "", "yummywebsite");

// Check Connection
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

// Check if form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $password = trim($_POST['pass']);

    // Find user by email
    $stmt = $conn->prepare("SELECT * FROM admin_signup WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {

        $row = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $row['pass'])) {

            // Store Session
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['admin_name'] = $row['fname'];
            $_SESSION['admin_email'] = $row['email'];

            header("Location: dashboard.php");
            exit();

        } else {

            echo "<script>
                    alert('Invalid Password');
                    window.location='admin.html';
                  </script>";
        }

    } else {

        echo "<script>
                alert('Email not found');
                window.location='admin.html';
              </script>";
    }

    $stmt->close();
}

$conn->close();
?>