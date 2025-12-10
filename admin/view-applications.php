<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}

require '../config/db.php';

try {
    // Fetch all applications with job details
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
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .actions a {
            margin-right: 10px;
            text-decoration: none;
            color: blue;
        }
        .actions a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Applications</h1>
    <p><a href="dashboard.php">Back to Dashboard</a></p>

    <?php if (count($applications) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Applicant Name</th>
                    <th>Email</th>
                    <th>Job Title</th>
                    <th>Applied At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($applications as $application): ?>
                    <tr>
                        <td><?= htmlspecialchars($application['id']) ?></td>
                        <td><?= htmlspecialchars($application['name']) ?></td>
                        <td><?= htmlspecialchars($application['email']) ?></td>
                        <td><?= htmlspecialchars($application['job_title']) ?></td>
                        <td><?= htmlspecialchars($application['created_at']) ?></td>
                        <td class="actions">
                            <a href="view-application-details.php?id=<?= $application['id'] ?>">View Details</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No applications found.</p>
    <?php endif; ?>
</body>
</html>