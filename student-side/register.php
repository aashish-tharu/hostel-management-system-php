<?php 

include 'connect.php';

if(isset($_POST['signUp'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $student=$_POST['StudentID'];
    $password=$_POST['password'];
    $hostelname=$_POST['hostelname'];
    $floor=$_POST['floorno'];
    $roomno=$_POST['roomno'];

    //email address exists check
     $checkEmail="SELECT * From signup where Email='$email'";
     $result=$conn->query($checkEmail);
     if($result->num_rows>0){
        echo "Email Address Already Exists !";
     }

     //username check exits check
     $checkusername="SELECT * From signup where StudentID='$student'";
     $result=$conn->query($checkusername);
     if($result->num_rows>0){
        echo "Username already Exists !";
     }

     else{
        $insertQuery="INSERT INTO signup(Name,Email,StudentID,Password,HostelName,Floor,Roomno)
                       VALUES ('$name','$email','$student','$password','$hostelname','$floor','$roomno')";
            if($conn->query($insertQuery)==TRUE){
                header("location: index.php");
            }
            else{
                echo "Error:".$conn->error;
            }
     }
}

if(isset($_POST['signIn'])){
    $sid=$_POST['signInID'];
    $password=$_POST['password'];
    
    $sql="SELECT * FROM signup WHERE StudentID='$sid' and Password='$password'";
    $data = mysqli_query($conn, $sql);
    $total = mysqli_num_rows($data);
    if($total>0){
        session_start();
        $_SESSION['Username'] = $sid;
        header("Location: home.php");
    }
    else{
     echo "Not Found, Incorrect Email or Password";
    }
 
 }
?>