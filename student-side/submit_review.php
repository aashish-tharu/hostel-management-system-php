<?php 
    include("connect.php");

    $id = $_POST['student_id'];
    $rating = $_POST['rating'];
    $review = $_POST['review'];

    $insertQuery = "INSERT INTO foodreviews(studentID, Rating, Review)
    VALUES ('$id','$rating','$review')";
    if($conn->query($insertQuery)==TRUE){
        echo "Submitted.";
        header("location: home.php");
    }
    else{
        echo "Error:".$conn->error;
    }
?>