<?php
require 'config/db.php';

$error = ""; // Variable to store error messages
$success = ""; // Variable to store success messages

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $job_id = intval($_POST['job_id']);
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $resume = trim($_POST['resume']);

    // Validate input
    if (empty($name) || empty($email) || empty($resume)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } else {
        // Insert the application into the database
        try {
            $stmt = $pdo->prepare("INSERT INTO applications (job_id, name, email, resume) VALUES (?, ?, ?, ?)");
            $stmt->execute([$job_id, $name, $email, $resume]);
            $success = "Application submitted successfully!";
        } catch (PDOException $e) {
            $error = "Failed to submit application: " . $e->getMessage();
        }
    }
}

// Check if the job ID is provided in the URL
if (!isset($_GET['job_id']) || empty($_GET['job_id'])) {
    die("Job not found.");
}

$job_id = intval($_GET['job_id']);
$job = $pdo->prepare("SELECT * FROM careers WHERE id = ?");
$job->execute([$job_id]);
$job = $job->fetch();

if (!$job) {
    die("Job not found in database.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for <?= htmlspecialchars($job['title']) ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .error {
            color: red;
        }
        .success {
            color: green;
        }
        form {
            max-width: 500px;
            margin: auto;
        }
        input, textarea, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Apply for <?= htmlspecialchars($job['title']) ?></h1>

    <!-- Display error or success messages -->
    <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <?php if (!empty($success)): ?>
        <p class="success"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <form action="apply.php" method="POST">
        <input type="hidden" name="job_id" value="<?= $job['id'] ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" placeholder="Your Name" required>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" placeholder="Your Email" required>
        <label for="resume">Resume:</label>
        <textarea name="resume" id="resume" placeholder="Paste your resume here" rows="5" required></textarea>
        <button type="submit">Submit Application</button>
    </form>
</body>
</html>