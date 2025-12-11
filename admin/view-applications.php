<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}

require '../config/db.php';

try {
    $stmt = $pdo->query("
        SELECT applications.id, applications.name, applications.email, applications.resume, applications.created_at, careers.title AS job_title
        FROM applications
        JOIN careers ON applications.job_id = careers.id
        ORDER BY applications.created_at DESC
    ");
    $applications = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Error fetching applications: " . $e->getMessage());
}


?>




<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Applications</title>

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
    max-width: 1000px;
    margin: 50px auto;
    padding: 0 20px;
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

h1 {
    text-align: center;
    color: #FF4800;
    font-size: 2.5rem;
    margin-bottom: 30px;
}

.table-card {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(8px);
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    border: 1px solid rgba(255,255,255,0.2);
    margin-bottom: 30px;
}

.table-card h2 {
    color: #FF4800;
    text-align: center;
    margin-bottom: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid rgba(0,0,0,0.1);
}

th {
    background-color: rgba(255,255,255,0.2);
}

a.delete-btn {
    background-color: #FF4800;
    color: #fff;
    padding: 8px 12px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 0.95rem;
    transition: background 0.3s ease;
}

a.delete-btn:hover {
    background-color: #e63d00;
}

@media (max-width: 768px) {
    table, th, td {
        font-size: 0.9rem;
    }

    a.delete-btn {
        padding: 6px 10px;
        font-size: 0.85rem;
    }
}
</style>
</head>
<body>

<a href="dashboard.php" class="back-btn"><i class="fas fa-arrow-left"></i></a>

<div class="container">
    <div class="table-card">
        <h2>All Applications</h2>

        <?php if (count($applications) > 0): ?>
            <div style="overflow-x:auto;">
                <table>
                    <thead>
                        <tr>
                            <th>Applicant Name</th>
                            <th>Email</th>
                            <th>Job Title</th>
                            <th>Resume</th>
                            <th>Submitted At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($applications as $app): ?>
                            <tr>
                                <td><?= htmlspecialchars($app['name']); ?></td>
                                <td><?= htmlspecialchars($app['email']); ?></td>
                                <td><?= htmlspecialchars($app['job_title']); ?></td>
                              <td> 
    <?php if (!empty($app['resume'])): ?>
        <!-- Link to your application details page using the application ID -->
        <a href="view-application-details.php?id=<?= $app['id']; ?>" target="_blank">View Resume</a>
    <?php else: ?>
        N/A
    <?php endif; ?>
</td>

                                <td><?= htmlspecialchars($app['created_at']); ?></td>
                                <td>
                                    <a href="delete-application.php?id=<?= $app['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p style="text-align:center;">No applications found.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
