
<!-- This file stores data from the security page to the data base -->

<?php 
    include("connect.php");

    $name = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $msg = $_POST['message'];

    $insertQuery="INSERT INTO message(name,id,number,message)
    VALUES ('$name','$number','$email','$msg')";
    if($conn->query($insertQuery)==TRUE){
        header("location: home.php");
    }
    else{
        echo "Error:".$conn->error;
    }
?>