<?php
session_start();
if (!isset($_SESSION['admin'])) { 
    header("Location: ../login.php"); 
    exit; 
}

require '../config/db.php';

$error = ""; // Variable to store error messages
$success = ""; // Variable to store success messages

// Check if the job ID is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$job_id = intval($_GET['id']); // Sanitize the job ID

// Fetch the job details to pre-fill the form
$stmt = $pdo->prepare("SELECT * FROM careers WHERE id = ?");
$stmt->execute([$job_id]);
$job = $stmt->fetch();

if (!$job) {
    header("Location: dashboard.php");
    exit;
}

// Handle form submission for updating the job
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
    <h2>Edit Job</h2>

    <!-- Display error or success messages -->
    <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <?php if (!empty($success)): ?>
        <p class="success"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <form method="POST">
        <label for="title">Job Title:</label>
        <input type="text" name="title" id="title" value="<?= htmlspecialchars($job['title']) ?>" required>

        <label for="description">Job Description:</label>
        <textarea name="description" id="description" rows="5" required><?= htmlspecialchars($job['description']) ?></textarea>

        <label for="requirements">Requirements:</label>
        <textarea name="requirements" id="requirements" rows="5" required><?= htmlspecialchars($job['requirements']) ?></textarea>

        <button type="submit">Update Job</button>
    </form>

    <p><a href="dashboard.php">Back to Dashboard</a></p>
</body>
</html>
