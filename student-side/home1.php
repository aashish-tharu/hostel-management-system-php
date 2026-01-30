
<?php
    session_start();
    include("connect.php");
    $profile = $_SESSION['Username'];
    if ($profile == True) {

    } else {
        header("Location:index.php");
    }
?>

<html>

<head>
    <title>Home-Chitkara University</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>
    <div class="header">
        <div class="logo">
            <img src="https://www.chitkara.edu.in/chitkara-university-logo.png" alt="Logo">
        </div>
        <div class="importantlink">
            <a href="#">Home</a>
            <a href="#">Gatepass</a>
            <a href="#">Non-Disciplinary Action</a>
            <a href="#">Hostel Checkout</a>
            <a href="#">Change Password</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
    <div class="profile">

    <div class="image-profile-div">
        <img src = "https://png.pngtree.com/png-vector/20241123/ourmid/pngtree-profile-picture-icon-hijab-girl-cute-vector-png-image_14543498.png" height="100px" widht="100px" style="background-color: transparent">
    </div>
    <div class="profile-detais">
        <h4>
    <?php
    echo "Hi ";
    $username = $_SESSION['Username']; 
    $check = "SELECT * FROM signup WHERE StudentID='$username'";
    $data = mysqli_query($conn, $check);
        $result = mysqli_fetch_assoc($data);
            echo $result['Name'];
    ?>
    <h4>
    <?php
    $username = $_SESSION['Username']; 
    $check = "SELECT * FROM signup WHERE studentID='$username'";
    $data = mysqli_query($conn, $check);
        $result = mysqli_fetch_assoc($data);
            echo $result['Email'];
    ?>
    </h4>
    </h4>
</div>


    

    </div>
        <div class="body">
            <div class="gatepass">
                <h1>Gate Pass</h1>
                <p>Gate Pass for Students Leave, In & Out Campus Request</p>
            </div>
            <div class="payment">
                <h1>Payment Reciept</h1>
                <p>Payment Transaction Receipt</p>
            </div>
            <div class="non-disciplinary">
                <h1>Non-Disciplinary Action</h1>
                <p>Extra Dues for Non-Disciplinary Action</p>
            </div>
            <div class="new-semester">
                <h1>New Semester Allotment</h1>
                <p>Only limited number of rooms are available which will be allotted on first come first serve basis
                    based upon the date and time of registration. The room will be allotted after physical verification
                    of documents.</p>
            </div>
            <div class="hostel-checkout">
                <h1>Hostel Checkout</h1>
                <p>Hostel Checkout</p>
            </div>
            <div class="complaint">
                <h1>Complaint</h1>
                <p>Complaint</p>
            </div>
            <div class="admission-form">
                <h1>Admission Form</h1>
                <p>Admission Form</p>
            </div>
        </div>
    </div>
</body>

</html>