<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}

require '../config/db.php';

// Validate ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid request");
}

$application_id = intval($_GET['id']);

try {
    // Delete the application
    $stmt = $pdo->prepare("DELETE FROM applications WHERE id = ?");
    $stmt->execute([$application_id]);

    // Redirect back after delete
    header("Location: view-applications.php?deleted=1");
    exit;

} catch (PDOException $e) {
    die("Error deleting application: " . $e->getMessage());
}
?>
