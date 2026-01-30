<?php
    session_start();
    include("connect.php");
    $profile = $_SESSION['Username'];
    if ($profile == True) {

    } else {
        header("Location:index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uni-Hostel Hub</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>

    <!-- Header Section -->
    <header>
        <h1>Uni-Hostel Hub</h1>
        <nav class="nav-bar">
            <a href="home.php">Home</a>
            <a href="gatepass.php">Gate-Pass</a>
            <a href="food.php">Mess-Menu</a>
            <a href="contact.php">Contact-Us</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="user-info">
            <img src="media/profile.gif" class="profile-pic">
            <h2>
                <?php
                    $username = $_SESSION['Username']; 
                    $check = "SELECT * FROM signup WHERE StudentID='$username'";
                    $data = mysqli_query($conn, $check);
                    $result = mysqli_fetch_assoc($data);
                    echo $result['Name'];
                ?>
            </h2>
            <p>
                <?php
                $username = $_SESSION['Username']; 
                $check = "SELECT * FROM signup WHERE studentID='$username'";
                $data = mysqli_query($conn, $check);
                    $result = mysqli_fetch_assoc($data);
                    echo $result['Email'];
                ?>
            </p>
        </div>

        <h3 class="help-text">How can we help you?</h3>

        <div class="quick-links-container">
            <div class="quick-link">
                <img src="media/gate.jpg" alt="Image 1">
                <h2>Gate Pass</h2>
                <p>Gate Pass for Student Entry, Exit, and Campus Leave Requests</p>
                <a href="gatepass.php">Apply Here</a>
            </div>

            <div class="quick-link">
                <img src="media/history.jpeg" alt="Image 1">
                <h2>Activity History</h2>
                <p>Check all the recent gata pass history</p>
                <a href="history.php">Click here</a>
            </div>
    
            <div class="quick-link">
                <img src="media/payment.jpeg" alt="Image 2">
                <h2>Payment Reciept</h2>
                <p>Secure Payment Receipt</p>
                <a href="#">View Records</a>
            </div>

            <div class="quick-link">
                <img src="media/checkout.jpeg" alt="Image 2">
                <h2>Hostel Checkout</h2>
                <p>Ensure your stay is safe with emergency contact details and security features.</p>
                <a href="#">View Safety Guide</a>
            </div>

            <div class="quick-link">
                <img src="media/book.jpeg" alt="Image 2">
                <h2>New Semester Allotment</h2>
                <p>Only limited number of rooms are available which will be allotted on first come first serve basis
                    based upon the date and time of registration. The room will be allotted after physical verification
                    of documents.</p>
                <a href="#">Book here</a>
            </div>

            <div class="quick-link">
                <img src="media/menu.jpeg" alt="Image 2">
                <h2>Food Menu</h2>
                <p>Be ready to click tasty food...</p>
                <a href="food.php">Check Menu</a>
            </div>

            <div class="quick-link">
                <img src="media/contact.jpeg" alt="Image 2">
                <h2>Contact Us</h2>
                <p>Ensure your stay is safe with emergency contact details and security features.</p>
                <a href="contact.php">Click here for details</a>
            </div>

            <div class="quick-link">
                <img src="media/maintenance.jpg" alt="Image 2">
                <h2>Maintenance Requests</h2>
                <p>If any of the materials are broken then inform here</p>
                <a href="maintenance_requests.php">Report Here</a>
            </div>

            <div class="quick-link">
                <img src="media/medical.jpeg" alt="Image 2">
                <h2>Medical leave apply</h2>
                <p>If you are not feeling good then you can apply for medical help to access the services from admin</p>
                <a href="medical_leave.php">Apply Here</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Uni-Hostel Hub</p>
    </footer>

</body>
</html>
