<?php
session_start();
if (!isset($_SESSION['admin'])) { 
    header("Location: ../login.php"); 
    exit; 
}

require '../config/db.php';

$error = "";
$success = "";

// Check if the job ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$job_id = intval($_GET['id']);

// Fetch job details
$stmt = $pdo->prepare("SELECT * FROM careers WHERE id = ?");
$stmt->execute([$job_id]);
$job = $stmt->fetch();

if (!$job) {
    header("Location: dashboard.php");
    exit;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $requirements = trim($_POST['requirements']);

    if (empty($title) || empty($description) || empty($requirements)) {
        $error = "All fields are required.";
    } else {
        try {
            $stmt = $pdo->prepare("UPDATE careers SET title = ?, description = ?, requirements = ? WHERE id = ?");
            $stmt->execute([$title, $description, $requirements, $job_id]);
            $success = "Job updated successfully!";
        } catch (PDOException $e) {
            $error = "Failed to update job: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Job</title>

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

<link rel="icon" type="image/x-icon" href="img/favicon.png">

<style>
body {
    font-family: 'Poppins', Arial, sans-serif;
    background-color: #fce6ddff;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
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

.job-card {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(8px);
    padding: 30px 25px;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    margin-bottom: 30px;
    border: 1px solid rgba(255,255,255,0.2);
}

.job-card h3 {
    color: #FF4800;
    margin-bottom: 15px;
    font-size: 1.8rem;
    text-align: center;
}

.form-group {
    margin-bottom: 20px;
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

@media (max-width: 600px) {
    .job-card {
        padding: 20px 15px;
    }

    h1 {
        font-size: 2rem;
    }

    input, textarea, button {
        font-size: 1rem;
        padding: 12px;
    }
}
</style>
</head>

<body>

<a href="dashboard.php" class="back-btn"><i class="fas fa-arrow-left"></i></a>

<div class="container">
    <h1>Edit Job</h1>

    <div class="job-card">
        <?php if (!empty($error)): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <h3>Job Details</h3>
        <form method="POST">
            <div class="form-group">
                <label for="title">Job Title</label>
                <input type="text" name="title" id="title" value="<?= htmlspecialchars($job['title']) ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Job Description</label>
                <textarea name="description" id="description" rows="3" required><?= htmlspecialchars($job['description']) ?></textarea>
            </div>

            <div class="form-group">
                <label for="requirements">Requirements</label>
                <textarea name="requirements" id="requirements" rows="3" required><?= htmlspecialchars($job['requirements']) ?></textarea>
            </div>

            <button type="submit">Update Job</button>
        </form>
    </div>
</div>

            <script src="../js/main.js"></script>
</body>
</html>
