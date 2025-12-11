<?php
require 'config/db.php';

$error = ""; 
$success = ""; 

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $job_id = intval($_POST['job_id']);
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $resume = trim($_POST['resume']);

    if (empty($name) || empty($email) || empty($resume)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } else {
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

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', Arial, sans-serif;
        background-color: #ffe3d8ff;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        position: relative; /* Fix back icon */
    }

    /* Back button */
    a.position-fixed {
        position: fixed;
        top: 20px;
        left: 20px;
        z-index: 1000;
        font-size: 2.2rem;
        color: #FF4800;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    a.position-fixed:hover {
        color: #e63d00;
    }

    .application-card {
        background: #fff;
        padding: 50px 40px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.25);
        width: 100%;
        max-width: 600px;
        box-sizing: border-box;
    }

    .application-card h2 {
        text-align: center;
        color: #FF4800;
        margin-bottom: 30px;
        font-size: 2rem;
    }

    .form-group {
        margin-bottom: 25px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-size: 1.1rem;
    }

    input, textarea {
        width: 100%;
        padding: 15px 12px;
        font-size: 1.1rem;
        border: 1px solid #ccc;
        border-radius: 8px;
        box-sizing: border-box;
    }

    button {
        width: 100%;
        padding: 15px;
        font-size: 1.2rem;
        background-color: #FF4800;
        color: #fff;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    button:hover {
        background-color: #e63d00;
    }

    .error, .success {
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 1.1rem;
        text-align: center;
    }

    .error {
        background-color: #dc3545;
        color: #fff;
    }

    .success {
        background-color: #28a745;
        color: #fff;
    }

    @media (max-width: 500px) {
        .application-card {
            padding: 30px 20px;
        }

        .application-card h2 {
            font-size: 1.6rem;
        }

        input, textarea, button {
            font-size: 1rem;
            padding: 12px;
        }
    }
</style>
</head>
<body>
<!-- Back to Career button -->
<a href="career.php" class="position-fixed">
    <i class="fas fa-arrow-left"></i>
</a>

<div class="application-card">
    <h2>Apply for <?= htmlspecialchars($job['title']) ?></h2>

    <?php if (!empty($error)): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <div class="success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form action="apply.php?job_id=<?= $job['id'] ?>" method="POST">
        <input type="hidden" name="job_id" value="<?= $job['id'] ?>">

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" placeholder="Your Name" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="Your Email" required>
        </div>

        <div class="form-group">
            <label for="resume">Resume:</label>
            <textarea name="resume" id="resume" placeholder="Paste your resume here" rows="5" required></textarea>
        </div>

        <button type="submit">Submit Application</button>
    </form>
</div>

</body>
</html>
