<?php
session_start();
include("connect.php");
if (!isset($_SESSION['Username'])) {
    header("Location: index.php");
    exit();
}

// Initialize variables
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {

        // Sanitize inputs
        $name = $conn->real_escape_string($_POST['name']);
        $student_id = $conn->real_escape_string($_POST['student_id']);
        $symptoms = $conn->real_escape_string($_POST['symptoms']);
        $leave_from = $conn->real_escape_string($_POST['leave_from']);
        $leave_to = $conn->real_escape_string($_POST['leave_to']);
        $doctor_help = $conn->real_escape_string($_POST['doctor_help']);
        $ambulance = $conn->real_escape_string($_POST['ambulance']);

        // Insert into database
        $stmt = $conn->prepare("INSERT INTO medical_requests 
                              (student_id, full_name, symptoms, leave_from, leave_to, 
                               doctor_help, ambulance, attachment_path) 
                              VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", 
            $student_id,
            $name,
            $symptoms,
            $leave_from,
            $leave_to,
            $doctor_help,
            $ambulance,
            $attachment_path
        );

        if ($stmt->execute()) {
            $success = "Medical leave request submitted successfully!";
        } else {
            throw new Exception("Database error: " . $stmt->error);
        }

    } catch (Exception $e) {
        $error = $e->getMessage();
    } finally {
        // Close statement
        if (isset($stmt)) {
            $stmt->close();
        }
    }

    // Redirect with status
    $redirect_url = "medical_leave.php?" . ($error ? "error=" . urlencode($error) : "success=" . urlencode($success));
    header("Location: $redirect_url");
    exit();
}

// If not POST request, redirect
header("Location: medical.php");