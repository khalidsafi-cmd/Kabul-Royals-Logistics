<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}

require '../config/db.php';

// Fetch all job postings
$careers = $pdo->query("SELECT * FROM careers")->fetchAll();

// Fetch the total number of applications
$totalApplications = $pdo->query("SELECT COUNT(*) AS total FROM applications")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard</title>

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', Arial, sans-serif;
        background-color: #fce6ddff;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 1200px;
        margin: 50px auto;
        padding: 0 20px;
    }

    h1 {
        color: #FF4800;
        text-align: center;
        margin-bottom: 30px;
        font-size: 2.5rem;
    }

    .summary {
        text-align: center;
        margin-bottom: 40px;
    }

    .summary a {
        display: inline-block;
        margin: 0 10px;
        padding: 12px 20px;
        background-color: #FF4800;
        color: #fff;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 600;
        transition: background 0.3s ease;
    }

    .summary a:hover {
        background-color: #e63d00;
    }

    .job-card {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(8px);
        padding: 25px 20px;
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        margin-bottom: 25px;
        border: 1px solid rgba(255,255,255,0.2);
    }

    .job-card h3 {
        color: #FF4800;
        margin-bottom: 10px;
        font-size: 1.8rem;
    }

    .job-card h4 {
        margin-bottom: 15px;
        font-size: 1.2rem;
        color: #333;
    }

    .job-card p {
        margin-bottom: 10px;
        color: #222;
    }

    .job-card .actions {
        margin-top: 15px;
    }

    .job-card .actions a {
        display: inline-block;
        padding: 10px 20px;
        margin-right: 10px;
        background-color: #FF4800;
        color: #fff;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 600;
        transition: background 0.3s ease;
    }

    .job-card .actions a.delete {
        background-color: #FF4800;
    }

    .job-card .actions a:hover {
        background-color: #e63d00;
    }

    @media (max-width: 600px) {
        .job-card {
            padding: 20px 15px;
        }
        .summary a {
            margin: 5px 0;
            display: block;
        }
    }
</style>
</head>
<body>

<div class="container">
    <h1>Welcome, <?= htmlspecialchars($_SESSION['admin']) ?></h1>

    <div class="summary">
        <a href="add-job.php"><i class="fas fa-plus"></i> Add New Job</a>
        <a href="view-applications.php"><i class="fas fa-file-alt"></i> View Applications (<?= $totalApplications ?>)</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <?php if (count($careers) > 0): ?>
        <?php foreach ($careers as $job): ?>
            <div class="job-card">
                <h3>Job Posting</h3>
                <h4><?= htmlspecialchars($job['title']) ?></h4>
                <p><strong>Description:</strong> <?= htmlspecialchars($job['description']) ?></p>
                <p><strong>Requirements:</strong> <?= htmlspecialchars($job['requirements']) ?></p>
                <div class="actions">
                    <a href="edit-job.php?id=<?= $job['id'] ?>"><i class="fas fa-edit"></i> Edit</a>
                    <a href="delete-job.php?id=<?= $job['id'] ?>" class="delete" onclick="return confirm('Are you sure you want to delete this job?')"><i class="fas fa-trash-alt"></i> Delete</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p style="text-align:center;">No job postings found.</p>
    <?php endif; ?>
</div>

</body>
</html>
