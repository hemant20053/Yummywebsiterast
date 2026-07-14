<?php
// Database Connection
$conn = new mysqli("localhost", "root", "", "yummywebsite");

// Check Connection
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

// Check ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid Request");
}

$id = intval($_GET['id']);

// Delete Query
$stmt = $conn->prepare("DELETE FROM yummywebbtb WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {

    echo "<script>
            alert('Booking Deleted Successfully!');
            window.location='dashboard.php';
          </script>";

} else {

    echo "<script>
            alert('Error deleting booking!');
            window.location='dashboard.php';
          </script>";

}

$stmt->close();
$conn->close();
?>