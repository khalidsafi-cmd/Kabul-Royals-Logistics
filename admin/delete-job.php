<?php
session_start();
if (!isset($_SESSION['admin'])) { 
    header("Location: ../login.php"); 
    exit; 
}

require '../config/db.php';

// Check if the job ID is provided in the URL
if (isset($_GET['id'])) {
    $job_id = intval($_GET['id']); // Sanitize the ID

    // Prepare and execute the delete query
    $stmt = $pdo->prepare("DELETE FROM careers WHERE id = ?");
    $stmt->execute([$job_id]);

    // Redirect back to the dashboard after deletion
    header("Location: dashboard.php");
    exit;
} else {
    // Redirect to the dashboard if no ID is provided
    header("Location: dashboard.php");
    exit;
}
?>