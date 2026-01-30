<?php
    session_start();
    include("connect.php");
    $profile = $_SESSION['Username'];
    if ($profile == True) {

    } else {
        header("Location:index.php");
    }
?>

<?php
// Database connection details
$servername = "localhost"; // Change this if your database is hosted elsewhere
$username = "root"; // Default username for localhost
$password = ""; // Default password for localhost (empty)
$dbname = "user"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the student ID from the session or query parameter
// For this example, let's assume the student ID is passed via a query parameter (e.g., history.php?id=123)
// $student_id = $_GET['username']; // Replace this with your actual method of identifying the user (e.g., session)

// SQL query to fetch gate pass history for the specific student
$sql = "SELECT * FROM gatepass WHERE student_id = '$profile'";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gate Pass History</title>
    <link rel="stylesheet" href="gatepass.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <header>
        <h1>Uni-Hostel Hub</h1>
        <nav class="nav-bar">
            <a href="home.php">Home</a>
            <a href="gatepass.php">Gate-Pass</a>
            <a href="food.php">Mess-Menu</a>
            <a href="#">Contact-Us</a>
        </nav>
    </header>

    <main class="main-content">
        <div class="form-container">
            <h2 class="form-title">Gate Pass History</h2>
            <?php
            if ($result->num_rows > 0) {
                echo "<table>
                        <tr>
                            <th>Name</th>
                            <th>Student ID</th>
                            <th>Reason</th>
                            <th>Leave Date</th>
                            <th>Departure Time</th>
                            <th>Return Date</th>
                            <th>Return Time</th>
                            <th>Status</th>
                            <th>Warden Name</th>
                            <th>Remark</th>
                        </tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row['name'] . "</td>
                            <td>" . $row['student_id'] . "</td>
                            <td>" . $row['reason'] . "</td>
                            <td>" . $row['leave_date'] . "</td>
                            <td>" . $row['departure_time'] . "</td>
                            <td>" . $row['return_date'] . "</td>
                            <td>" . $row['return_time'] . "</td>
                            <td>" . $row['statuss'] . "</td>
                            <td>" . $row['warden'] . "</td>
                            <td>" . $row['remark'] . "</td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No gate pass applications found.</p>";
            }
            ?>
        </div>
    </main>

    <footer class="main-footer">
        <p class="footer-text">&copy; 2023 Uni-Hostel Hub. All rights reserved.</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>