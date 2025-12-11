<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}

require '../config/db.php';

// Check if the application ID is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Application ID is required.");
}

$application_id = intval($_GET['id']);

try {
    // Fetch the application details
    $stmt = $pdo->prepare("
        SELECT applications.id, applications.name, applications.email, applications.resume, applications.created_at, careers.title AS job_title
        FROM applications
        JOIN careers ON applications.job_id = careers.id
        WHERE applications.id = ?
    ");
    $stmt->execute([$application_id]);
    $application = $stmt->fetch();

    if (!$application) {
        die("Application not found.");
    }
} catch (PDOException $e) {
    die("Error fetching application details: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .details {
            max-width: 600px;
            margin: auto;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .details h2 {
            margin-bottom: 20px;
        }
        .details p {
            margin: 10px 0;
        }
        .details strong {
            display: inline-block;
            width: 150px;
        }
        a {
            text-decoration: none;
            color: blue;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="details">
        <h2>Application Details</h2>
        <p><strong>Application ID:</strong> <?= htmlspecialchars($application['id']) ?></p>
        <p><strong>Applicant Name:</strong> <?= htmlspecialchars($application['name']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($application['email']) ?></p>
        <p><strong>Job Title:</strong> <?= htmlspecialchars($application['job_title']) ?></p>
        <p><strong>Resume:</strong><br><?= nl2br(htmlspecialchars($application['resume'])) ?></p>
        <p><strong>Applied At:</strong> <?= htmlspecialchars($application['created_at']) ?></p>
        <p><a href="view-applications.php">Back to Applications</a></p>
    </div>
</body>
</html>