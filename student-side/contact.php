<?php 
    session_start();
include("connect.php");
$profile = $_SESSION['Username'];
    if ($profile == True) {

    } else {
        header("Location:index.php");
    }

    $sql = "SELECT * FROM contact";
    $result = $conn->query($sql);
?>


<html>
    <head>
        <title>Food menu</title>
        <link rel = "stylesheet" href = "contact.css">
    </head>

    <body>
        <header>
            <h1>Uni-Hostel Hub</h1>
            <nav class="nav-bar">
                <a href="home.php">Home</a>
                <a href="gatepass.php">Gate-Pass</a>
                <a href="mess.php">Mess-Menu</a>
                <a href="contact.php">Contact-Us</a>
            </nav>
        </header>

        <div class="food-container">
            <h2 class="food-title">Contact-Details</h2>

            <div class="food-table">
                <table>
                    <thead>
                        <tr>
                            <th>S NO.</th>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Hostel</th>
                            <th>Office no.</th>
                            <th>Personal no.</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($result->num_rows > 0) {

                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row['sno'] . "</td>
                                    <td>" . $row['name'] . "</td>
                                    <td>" . $row['designation'] . "</td>
                                    <td>" . $row['hostel'] . "</td>
                                    <td>" . $row['mobile'] . "</td>
                                    <td>" . $row['personal'] . "</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No food menu available.</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="contact-container">
            <form action="message.php" method = "post" class="contact-left">
            <div class="contact-left-title">
               <h2>Get in touch</h2>
                <hr>
            </div>
            <input type="text" name="name" class="contact-inputs" id="" placeholder="Enter your name: " required>
            <input type="text" name="number" class="contact-inputs" id="" placeholder="Enter your ID: " required>
            <input type="text" name="email" class="contact-inputs" id="" placeholder="Enter your mobile: " required>
            <textarea name="message"  class="contact-inputs" placeholder="Your Message" required></textarea>
            <button type="submit">submit</button>
            </form>
        </div>
    </body>
</html>