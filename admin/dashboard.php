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
    <style>
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
        a {
            text-decoration: none;
            color: blue;
        }
        a:hover {
            text-decoration: underline;
        }
        .summary {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Welcome, <?= htmlspecialchars($_SESSION['admin']) ?></h1>
    <p>
        <a href="add-job.php">Add New Job</a> | 
        <a href="view-applications.php">View Applications (<?= $totalApplications ?>)</a> | 
        <a href="logout.php">Logout</a>
    </p>

    <h2>All Careers</h2>
    <?php if (count($careers) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Requirements</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($careers as $job): ?>
                    <tr>
                        <td><?= htmlspecialchars($job['title']) ?></td>
                        <td><?= htmlspecialchars($job['description']) ?></td>
                        <td><?= htmlspecialchars($job['requirements']) ?></td>
                        <td>
                            <a href="edit-job.php?id=<?= $job['id'] ?>">Edit</a> | 
                            <a href="delete-job.php?id=<?= $job['id'] ?>" onclick="return confirm('Are you sure you want to delete this job?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No job postings found.</p>
    <?php endif; ?>
</body>
</html>