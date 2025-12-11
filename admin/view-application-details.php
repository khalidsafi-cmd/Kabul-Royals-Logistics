<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}

require '../config/db.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Application ID is required.");
}

$application_id = intval($_GET['id']);

try {
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

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

<link rel="icon" type="image/x-icon" href="img/favicon.png">

<style>
body {
    font-family: 'Poppins', Arial, sans-serif;
    background-color: #ffe3d8ff;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    min-height: 100vh;
    padding-top: 40px;
}

.details-card {
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.25);
    width: 90%;
    max-width: 900px;
    padding: 40px;
    box-sizing: border-box;
    margin-bottom: 40px;
}

.details-card h2 {
    text-align: center;
    color: #FF4800;
    margin-bottom: 30px;
    font-size: 2rem;
}

.detail-row {
    display: flex;
    flex-wrap: wrap;
    margin-bottom: 12px;
}

.detail-row strong {
    width: 180px;
    min-width: 150px;
    color: #333;
    font-weight: 600;
}

.detail-row span {
    flex: 1;
    word-break: break-word;
    font-size: 1.1rem;
}

.resume-block {
    background-color: #f5f5f5;
    padding: 15px;
    border-radius: 8px;
    max-height: 500px;
    overflow-y: auto;
    white-space: pre-wrap;
    word-wrap: break-word;
    font-family: monospace;
    font-size: 1.2rem;
    line-height: 1.5;
    margin-top: 5px;
}

a.back-btn {
    position: fixed;
    top: 20px;
    left: 20px;
    z-index: 999;
    font-size: 2.2rem;
    color: #FF4800;
    text-decoration: none;
}

a.back-btn:hover {
    color: #e63d00;
}

@media (max-width: 768px) {
    .details-card {
        width: 95%;
        padding: 30px 20px;
    }

    .details-card h2 {
        font-size: 1.8rem;
    }

    .detail-row span {
        font-size: 1rem;
    }

    .resume-block {
        font-size: 1rem;
    }
}

@media (max-width: 500px) {
    .details-card h2 {
        font-size: 1.6rem;
    }

    .resume-block {
        font-size: 0.95rem;
    }

    .detail-row strong {
        width: 140px;
    }
}
</style>
</head>
<body>

<a href="view-applications.php" class="back-btn">
    <i class="fas fa-arrow-left"></i>
</a>

<div class="details-card">
    <h2>Application Details</h2>

    <div class="detail-row">
        <strong>Application ID:</strong>
        <span><?= htmlspecialchars($application['id']) ?></span>
    </div>
    <div class="detail-row">
        <strong>Applicant Name:</strong>
        <span><?= htmlspecialchars($application['name']) ?></span>
    </div>
    <div class="detail-row">
        <strong>Email:</strong>
        <span><?= htmlspecialchars($application['email']) ?></span>
    </div>
    <div class="detail-row">
        <strong>Job Title:</strong>
        <span><?= htmlspecialchars($application['job_title']) ?></span>
    </div>
    <div class="detail-row">
        <strong>Resume:</strong>
        <div class="resume-block"><?= htmlspecialchars($application['resume']) ?></div>
    </div>
    <div class="detail-row">
        <strong>Applied At:</strong>
        <span><?= htmlspecialchars($application['created_at']) ?></span>
    </div>
</div>

</body>
</html>
