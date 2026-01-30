<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$id = $_POST['id'];
$reason = $_POST['reason'];
$leave_date = $_POST['date1'];
$departure_time = $_POST['time1'];
$return_date = $_POST['date2'];
$return_time = $_POST['time2'];
$status = "Pending";
$warden = "-";
$remark = "-";

$sql = "INSERT INTO gatepass (name, student_id, reason, leave_date, departure_time, return_date, return_time, statuss, warden, remark)
        VALUES ('$name', '$id', '$reason', '$leave_date', '$departure_time', '$return_date', '$return_time', '$status', '$warden', '$remark')";

if ($conn->query($sql) === TRUE) {
    echo "Gate pass application submitted successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>