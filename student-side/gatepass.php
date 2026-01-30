<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gate Pass Application</title>
    <link rel="stylesheet" href="gatepass.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
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
            <h2 class="form-title">Apply for Gate Pass</h2>
            <form class="gatepass-form" method = "post" action = "store.php">
                <div class="form-group">
                    <label for="name" class="form-label">Full Name</label>
                    <input name = "name" type="text" id="name" class="form-input" placeholder="Enter your full name" required>
                </div>
                
                <div class="form-group">
                    <label for="id" class="form-label">Student ID</label>
                    <input name = "id" type="text" id="id" class="form-input" placeholder="Enter your student ID" required>
                </div>

                <div class="form-group">
                    <label for="reason" class="form-label">Reason for Leave</label>
                    <textarea name = "reason" id="reason" class="form-input form-textarea" placeholder="Specify your reason" required></textarea>
                </div>

                <div class="date-group">
                    <div class="date-time-group">
                        <div class="form-group">
                            <label for="date" class="form-label">Leave Date</label>
                            <input name = "date1" type="date" id="date" class="form-input" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="out-time" class="form-label">Departure Time</label>
                            <input name = "time1" type="time" id="out-time" class="form-input" required>
                        </div>
                    </div>
                
                    <div class="date-time-group">
                        <div class="form-group">
                            <label for="return" class="form-label">Return Date</label>
                            <input name = "date2" type="date" id="return" class="form-input" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="in-time" class="form-label">Return Time</label>
                            <input name = "time2" type="time" id="in-time" class="form-input" required>
                        </div>
                    </div>
                </div>

                <button type="submit" class="submit-btn" id = "applyhere">Submit Application</button>
            </form>
        </div>
    </main>

    <footer class="main-footer">
        <p class="footer-text">&copy; 2023 Uni-Hostel Hub. All rights reserved.</p>
    </footer>
</body>
</html>