<?php
session_start();

// अगर login session हो तो यहाँ check करें
// if(!isset($_SESSION['admin']))
// {
//     header("Location: adminlog.php");
//     exit();
// }

$conn = new mysqli("localhost", "root", "", "yummywebsite");

if ($conn->connect_error) {
    die("Connection Failed : " . $conn->connect_error);
}

// Total Bookings
$total = $conn->query("SELECT COUNT(*) as total FROM yummywebbtb")->fetch_assoc()['total'];

// Latest Bookings
$result = $conn->query("SELECT * FROM yummywebbtb ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <title>Restaurant Admin Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
        body {
            background: #f4f6f9;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background: #212529;
            position: fixed;
            padding-top: 20px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 15px;
        }

        .sidebar a:hover {
            background: #0d6efd;
        }

        .content {
            margin-left: 260px;
            padding: 20px;
        }

        .card {
            border: none;
            box-shadow: 0 0 10px rgba(0, 0, 0, .1);
        }

        table {
            background: white;
        }
    </style>

</head>

<body>

    <div class="sidebar">

        <h3 class="text-center text-white">
            🍽 Restaurant
        </h3>

        <hr class="text-white">

        <a href="#"><i class="fa fa-home"></i> Dashboard</a>

        <a href="#"><i class="fa fa-calendar"></i> Bookings</a>

        <a href="#"><i class="fa fa-user"></i> Customers</a>

        <a href="logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>

    </div>

    <div class="content">

        <h2>
            Restaurant Admin Dashboard
        </h2>

        <div class="row mt-4">

            <div class="col-md-4">

                <div class="card bg-primary text-white">

                    <div class="card-body">

                        <h5>Total Bookings</h5>

                        <h2>
                            <?php echo $total; ?>
                        </h2>

                    </div>

                </div>

            </div>

        </div>

        <div class="mt-4">

            <input type="text" class="form-control" id="search" placeholder="Search Customer...">

        </div>

        <div class="table-responsive mt-3">

            <table class="table table-bordered table-hover" id="bookingTable">

                <thead class="table-dark">

                    <tr>

                        <th>ID</th>

                        <th>Name</th>

                        <th>Email</th>

                        <th>Phone</th>

                        <th>Date</th>

                        <th>Time</th>

                        <th>Persons</th>

                        <th>Message</th>

                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                    <?php

                    while ($row = $result->fetch_assoc()) {

                        ?>

                        <tr>

                            <td>
                                <?= $row['id']; ?>
                            </td>

                            <td>
                                <?= $row['fulname']; ?>
                            </td>

                            <td>
                                <?= $row['emaildt']; ?>
                            </td>

                            <td>
                                <?= $row['phonenum']; ?>
                            </td>

                            <td>
                                <?= $row['date']; ?>
                            </td>

                            <td>
                                <?= $row['time']; ?>
                            </td>

                            <td>
                                <?= $row['pnumber']; ?>
                            </td>

                            <td>
                                <?= $row['message']; ?>
                            </td>

                            <td>

                                <a href="admedit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">

                                    <i class="fa fa-edit"></i>

                                </a>

                                <a href="delete_booking.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Delete Booking?')">

                                    <i class="fa fa-trash"></i>

                                </a>

                            </td>

                        </tr>

                        <?php
                    }
                    ?>

                </tbody>

            </table>

        </div>

    </div>

    <script>

        document.getElementById("search").addEventListener("keyup", function () {

            let value = this.value.toLowerCase();

            let rows = document.querySelectorAll("#bookingTable tbody tr");

            rows.forEach(function (row) {

                row.style.display = row.innerText.toLowerCase().includes(value) ? "" : "none";

            });

        });

    </script>

</body>

</html>