<?php
session_start();
include("connect.php");

// Redirect if not logged in
if (!isset($_SESSION['Username'])) {
    header("Location: index.php");
    exit();
}

$student_id = $_SESSION['Username'];
$error = $success = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $room_no = $_POST['room_no'] ?? '';
    $issue_type = $_POST['issue_type'] ?? '';
    $description = $_POST['description'] ?? '';
    $urgency = $_POST['urgency'] ?? '';

    if ($room_no && $issue_type && $description && $urgency) {
        $stmt = $conn->prepare("INSERT INTO maintenance_requests (student_id, room_no, issue_type, description, urgency) 
                                VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $student_id, $room_no, $issue_type, $description, $urgency);
        if ($stmt->execute()) {
            $success = "Request submitted successfully!";
        } else {
            $error = "Database error: " . $stmt->error;
        }
    } else {
        $error = "All fields are required.";
    }
}

// Fetch user's requests
$stmt = $conn->prepare("SELECT * FROM maintenance_requests WHERE student_id = ? ORDER BY created_at DESC");
$stmt->bind_param("s", $student_id);
$stmt->execute();
$requests = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Room Maintenance Request</title>
    <link rel="stylesheet" href="food.css">
    <style>
        .request-container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 20px auto;
        }
        .error, .success {
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }
        .error { background: #ffeeee; color: red; }
        .success { background: #eeffee; color: green; }
        .input-group {
            margin-bottom: 15px;
        }
        .input-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .input-group input,
        .input-group select,
        .input-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .btn {
            background-color: red;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
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
            <a href="maintenance.php">Maintenance</a>
            <a href="contact.php">Contact-Us</a>
        </nav>
    </header>

    <div class="request-container">
        <h2>Room Maintenance Request</h2>
        
        <?php if ($success): ?><div class="success"><?= htmlspecialchars($success) ?></div><?php endif; ?>
        <?php if ($error): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>

        <form method="post">
            <div class="input-group">
                <label>Student ID:</label>
                <input type="text" value="<?= htmlspecialchars($student_id) ?>" readonly>
            </div>
            
            <div class="input-group">
                <label>Room Number:</label>
                <input type="text" name="room_no" required>
            </div>
            
            <div class="input-group">
                <label>Issue Type:</label>
                <select name="issue_type" required>
                    <option value="">Select issue</option>
                    <option value="Electrical">Electrical</option>
                    <option value="Plumbing">Plumbing</option>
                    <option value="Furniture">Furniture</option>
                    <option value="Cleaning">Cleaning</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            
            <div class="input-group">
                <label>Description:</label>
                <textarea name="description" rows="4" required></textarea>
            </div>
            
            <div class="input-group">
                <label>Urgency:</label>
                <select name="urgency" required>
                    <option value="Low">Low</option>
                    <option value="Medium" selected>Medium</option>
                    <option value="High">High</option>
                    <option value="Emergency">Emergency</option>
                </select>
            </div>
            
            <button type="submit" class="btn">Submit Request</button>
        </form>
    </div>

    <div class="request-container">
        <h2>Your Maintenance Requests</h2>
        
        <?php if (!empty($requests)): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Room No.</th>
                        <th>Issue Type</th>
                        <th>Description</th>
                        <th>Urgency</th>
                        <th>Status</th>
                        <th>Date Submitted</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($requests as $request): ?>
                        <tr>
                            <td><?= $request['id'] ?></td>
                            <td><?= htmlspecialchars($request['room_no']) ?></td>
                            <td><?= htmlspecialchars($request['issue_type']) ?></td>
                            <td><?= htmlspecialchars($request['description']) ?></td>
                            <td><?= htmlspecialchars($request['urgency']) ?></td>
                            <td><?= htmlspecialchars($request['status']) ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($request['created_at'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No maintenance requests found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
<?php $conn->close(); ?>
