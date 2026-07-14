<?php
$conn = new mysqli("localhost", "root", "", "yummywebsite");

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

// Get Booking ID
if (!isset($_GET['id'])) {
    die("Invalid Request");
}

$id = $_GET['id'];

// Fetch Booking Data
$stmt = $conn->prepare("SELECT * FROM yummywebbtb WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Booking Not Found");
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Booking</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#f4f6f9;">

    <div class="container mt-5">

        <div class="card shadow">

            <div class="card-header bg-warning text-dark">
                <h3>Edit Table Booking</h3>
            </div>

            <div class="card-body">

                <form action="update_booking.php" method="POST">

                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                    <div class="mb-3">
                        <label>Full Name</label>
                        <input type="text" class="form-control" name="fulname"
                            value="<?php echo htmlspecialchars($row['fulname']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" class="form-control" name="emaildt"
                            value="<?php echo htmlspecialchars($row['emaildt']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="phonenum" value="<?php echo $row['phonenum']; ?>"
                            required>
                    </div>

                    <div class="mb-3">
                        <label>Booking Date</label>
                        <input type="text" class="form-control" name="date" value="<?php echo $row['date']; ?>"
                            required>
                    </div>

                    <div class="mb-3">
                        <label>Booking Time</label>
                        <input type="text" class="form-control" name="time" value="<?php echo $row['time']; ?>"
                            required>
                    </div>

                    <div class="mb-3">
                        <label>Persons</label>
                        <input type="number" class="form-control" name="pnumber" value="<?php echo $row['pnumber']; ?>"
                            required>
                    </div>

                    <div class="mb-3">
                        <label>Message</label>
                        <textarea class="form-control" name="message"
                            rows="4"><?php echo htmlspecialchars($row['message']); ?></textarea>
                    </div>

                    <button class="btn btn-success">
                        Update Booking
                    </button>

                    <a href="dashboard.php" class="btn btn-secondary">
                        Back
                    </a>

                </form>

            </div>

        </div>

    </div>

</body>

</html>