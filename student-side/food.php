<?php
session_start();
include("connect.php");
$profile = $_SESSION['Username'];
    if ($profile == True) {

    } else {
        header("Location:index.php");
    }
$sql = "SELECT * FROM food";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Food Menu</title>
    <link rel="stylesheet" href="food.css">
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
        .note {
            margin-top: 20px;
            padding: 15px;
            background-color: #f4f4f4;
            border: 1px solid #ddd;
        }
        .note h1 {
            margin-bottom: 10px;
        }
        .note h6 {
            margin: 5px 0;
        }


        .food-containerr {
    background: white;
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
    text-align: center;
}

.food-containerrr h2 {
    font-size: 100px;
    color: red;
    margin-bottom: -20px;
}

.logo h3 {
    font-size: 18px;
    color: #666;
    margin-bottom: 20px;
}

.input-group {
    display: flex;
    align-items: center;
    background: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 10px;
    margin-bottom: 15px;
}

.input-group i, .input-group textarea {
    color: #666;
    margin-right: 10px;
}

.input-group input, .input-group textarea {
    flex: 1;
    border: none;
    background: transparent;
    font-size: 16px;
    outline: none;
    text-align: center;
}

.btn {
    width: 100%;
    padding: 15px;
    background: red;
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 18px;
    font-weight: bold;
    cursor: pointer;
    margin-top: 10px;
}

.liner-food-review {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 50px;
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
            <a href="contact.php">Contact-Us</a>
        </nav>
    </header>

    <div class="food-container">
        <h2 class="food-title">Food Menu</h2>
        <div class="food-table">
            <table>
                <thead>
                    <tr>
                        <th>Days</th>
                        <th>Breakfast</th>
                        <th>Lunch</th>
                        <th>Evening Tea & Snacks</th>
                        <th>Dinner</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row['day'] . "</td>
                                    <td>" . $row['breakfast'] . "</td>
                                    <td>" . $row['lunch'] . "</td>
                                    <td>" . $row['evening'] . "</td>
                                    <td>" . $row['dinner'] . "</td>
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

    <div class="liner-food-review">
    <div class="food-containerr">
    <h2 class="food-title">Food Reviews</h2>
    <form action="submit_review.php" method="post" class="review-form">
        <div class="input-group">
            <label for="student_id">Student ID:</label>
            <input type="text" name="student_id" id="student_id" placeholder="Enter your Student ID" required>
        </div>
        <div class="input-group">
            <label for="rating">Rating (1-5):</label>
            <input type="number" name="rating" id="rating" min="1" max="5" placeholder="Rate food (1-5)" required>
        </div>
        <div class="input-group">
            <label for="review">Review:</label>
            <textarea name="review" id="review" placeholder="Write your review..." required></textarea>
        </div>
        <button type="submit" class="btn">Submit Review</button>
    </form>
</div>



<div class="food-containerr">
    <h2 class="food-title">Leave a Message</h2>
    <form action="submit_message.php" method="post" class="message-form">
        <div class="input-group">
            <label for="student_id">Student ID:</label>
            <input type="text" name="student_id" id="student_id" placeholder="Enter your Student ID" required>
        </div>
        <div class="input-group">
            <label for="message">Message:</label>
            <textarea name="message" id="message" placeholder="Write your message..." required></textarea>
        </div>
        <button type="submit" class="btn">Send Message</button>
                        </form>
                    </div>

                </div>

    <div class="note">
        <h1>Please Note the following Points</h1>
        <nav class="note-bar">
            <h6>Menu subject to change on non-availability of items or any other unusual circumstance</h6>
            <h6>Sick Meal Khichadi will be provided on the basis of the sick meal slip signed and stamped by the respective hostel warden</h6>
            <h6>"/" indicates that items will be served as per the non-availability on the alternative week</h6>
            <h6>Paneer Dish and Paita Curd will be served on the refilling basis</h6>
        </nav>
    </div>

    <div class="food-container">
        <h2 class="food-title">Mess Timing</h2>
        <div class="food-table">
            <table>
                <thead>
                    <tr>
                        <th>-</th>
                        <th>Mess Timing</th>
                        <th>Saturday, Sunday & Holiday</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Breakfast</td>
                        <td>07:30 AM TO 08:50 AM</td>
                        <td>08:00 AM TO 9:30 AM</td>
                    </tr>
                    <tr>
                        <td>Lunch</td>
                        <td>11:45 AM TO 02:00 PM</td>
                        <td>12:00 PM TO 2:00 PM</td>
                    </tr>
                    <tr>
                        <td>Evening Tea & Snacks</td>
                        <td>04:15 PM TO 05:00 PM</td>
                        <td>04:15 PM TO 05:00 PM</td>
                    </tr>
                    <tr>
                        <td>Dinner</td>
                        <td>07:30 PM TO 08:50 PM</td>
                        <td>07:30 PM TO 08:50 PM</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>



</body>
</html>

<?php
$conn->close();
?>