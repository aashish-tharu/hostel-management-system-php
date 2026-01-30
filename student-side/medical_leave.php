<?php
session_start();
include("connect.php");
if (!isset($_SESSION['Username'])) {
    header("Location: index.php");
    exit();
}

$student_id = $_SESSION['Username'];
$error = $success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'] ?? '';
    $symptoms = $_POST['symptoms'] ?? '';
    $leave_from = $_POST['leave_from'] ?? '';
    $leave_to = $_POST['leave_to'] ?? '';
    $doctor_help = $_POST['doctor_help'] ?? '';
    $ambulance = $_POST['ambulance'] ?? '';
    
    $attachment_path = '';
    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === 0) {
        $upload_dir = "uploads/";
        $file_name = basename($_FILES["attachment"]["name"]);
        $target_file = $upload_dir . time() . "_" . $file_name;
        if (move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file)) {
            $attachment_path = $target_file;
        } else {
            $error = "File upload failed.";
        }
    }

    if ($full_name && $symptoms && $leave_from && $leave_to && $doctor_help && $ambulance) {
        $stmt = $conn->prepare("INSERT INTO medical_leaves (student_id, full_name, symptoms, leave_from, leave_to, doctor_help, ambulance, attachment_path) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $student_id, $full_name, $symptoms, $leave_from, $leave_to, $doctor_help, $ambulance, $attachment_path);
        if ($stmt->execute()) {
            $success = "Medical leave request submitted successfully!";
        } else {
            $error = "Database error: " . $stmt->error;
        }
    } else {
        $error = "All fields are required.";
    }
}

$stmt = $conn->prepare("SELECT * FROM medical_leaves WHERE student_id = ? ORDER BY submitted_at DESC");
$stmt->bind_param("s", $student_id);
$stmt->execute();
$leaves = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Medical Leave</title>
    <link rel="stylesheet" href="food.css">
    <style>
        .request-container { background: white; padding: 40px; border-radius: 15px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); max-width: 800px; margin: 20px auto; }
        .error, .success { padding: 10px; margin: 10px 0; border-radius: 5px; }
        .error { background: #ffeeee; color: red; }
        .success { background: #eeffee; color: green; }
        .input-group { margin-bottom: 15px; }
        .input-group label { display: block; margin-bottom: 5px; font-weight: bold; }
        .input-group input, .input-group select, .input-group textarea { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; }
        .btn { background-color: red; color: white; border: none; padding: 12px 20px; border-radius: 5px; cursor: pointer; width: 100%; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border: 1px solid #ddd; }
        th { background-color: #f4f4f4; }
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
        <h2>Medical Leave Form</h2>

        <?php if ($success): ?><div class="success"><?= htmlspecialchars($success) ?></div><?php endif; ?>
        <?php if ($error): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>

        <form method="post" enctype="multipart/form-data">
            <div class="input-group">
                <label>Student ID:</label>
                <input type="text" value="<?= htmlspecialchars($student_id) ?>" readonly>
            </div>
            <div class="input-group">
                <label>Full Name:</label>
                <input type="text" name="full_name" required>
            </div>
            <div class="input-group">
                <label>Symptoms:</label>
                <textarea name="symptoms" rows="3" required></textarea>
            </div>
            <div class="input-group">
                <label>Leave From:</label>
                <input type="date" name="leave_from" required>
            </div>
            <div class="input-group">
                <label>Leave To:</label>
                <input type="date" name="leave_to" required>
            </div>
            <div class="input-group">
                <label>Do you need doctor help?</label>
                <select name="doctor_help" required>
                    <option value="Yes">Yes</option>
                    <option value="No" selected>No</option>
                </select>
            </div>
            <div class="input-group">
                <label>Do you need an ambulance?</label>
                <select name="ambulance" required>
                    <option value="Yes">Yes</option>
                    <option value="No" selected>No</option>
                </select>
            </div>
            <div class="input-group">
                <label>Upload medical document (optional):</label>
                <input type="file" name="attachment" accept=".pdf,.jpg,.png">
            </div>
            <button type="submit" class="btn">Submit Medical Leave</button>
        </form>
    </div>

    <div class="request-container">
        <h2>Your Medical Leave Requests</h2>

        <?php if (!empty($leaves)): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Symptoms</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Doctor Help</th>
                        <th>Ambulance</th>
                        <th>Attachment</th>
                        <th>Status</th>
                        <th>Submitted At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($leaves as $leave): ?>
                        <tr>
                            <td><?= $leave['id'] ?></td>
                            <td><?= htmlspecialchars($leave['full_name']) ?></td>
                            <td><?= htmlspecialchars($leave['symptoms']) ?></td>
                            <td><?= htmlspecialchars($leave['leave_from']) ?></td>
                            <td><?= htmlspecialchars($leave['leave_to']) ?></td>
                            <td><?= htmlspecialchars($leave['doctor_help']) ?></td>
                            <td><?= htmlspecialchars($leave['ambulance']) ?></td>
                            <td>
                                <?php if ($leave['attachment_path']): ?>
                                    <a href="<?= htmlspecialchars($leave['attachment_path']) ?>" target="_blank">View</a>
                                <?php else: ?>
                                    N/A
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($leave['status']) ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($leave['submitted_at'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No medical leave requests submitted yet.</p>
        <?php endif; ?>
    </div>
</body>
</html>
<?php $conn->close(); ?>