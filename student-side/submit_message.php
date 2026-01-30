<?php 
    include("connect.php");

    $id = $_POST['student_id'];
    $message = $_POST['message'];

    $insertQuery = "INSERT INTO foodmessage(studentID, message) 
                    VALUES ('$id', '$message')";
    
    if($conn->query($insertQuery) === TRUE) {
        header("Location: home.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
?>