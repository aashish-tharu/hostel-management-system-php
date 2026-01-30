<?php
session_start();
include("connect.php");

// Check if user is logged in
if (!isset($_SESSION['Username'])) {
    header("Location: index.php");
    exit();
}

// Validate and process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Validate required fields
        $required = ['room_no', 'issue_type', 'description', 'urgency'];
        foreach ($required as $field) {
            if (empty($_POST[$field])) {
                throw new Exception("All fields are required");
            }
        }

        // Sanitize inputs
        $student_id = $conn->real_escape_string($_SESSION['Username']);
        $room_no = $conn->real_escape_string($_POST['room_no']);
        $issue_type = $conn->real_escape_string($_POST['issue_type']);
        $description = $conn->real_escape_string($_POST['description']);
        $urgency = $conn->real_escape_string($_POST['urgency']);

        // Prepare and execute query
        $stmt = $conn->prepare("INSERT INTO maintenance_requests 
                              (student_id, room_no, issue_type, description, urgency) 
                              VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $student_id, $room_no, $issue_type, $description, $urgency);
        
        if ($stmt->execute()) {
            header("Location: maintenance.php?success=Request+submitted+successfully");
        } else {
            throw new Exception("Database error: " . $stmt->error);
        }
    } catch (Exception $e) {
        header("Location: maintenance.php?error=" . urlencode($e->getMessage()));
    }
    exit();
}

// If not POST request, redirect
header("Location: maintenance.php");