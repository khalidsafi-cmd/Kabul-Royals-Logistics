<?php
session_start();
if (!isset($_SESSION['admin'])) { 
    header("Location: ../login.php"); 
    exit; 
}

require '../config/db.php';

$error = ""; // Variable to store error messages
$success = ""; // Variable to store success messages

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $requirements = trim($_POST['requirements']);

    if (empty($title) || empty($description) || empty($requirements)) {
        $error = "All fields are required.";
    } else {
        // Insert the job into the database
        try {
            $stmt = $pdo->prepare("INSERT INTO careers (title, description, requirements) VALUES (?, ?, ?)");
            $stmt->execute([$title, $description, $requirements]);
            $success = "Job added successfully!";
        } catch (PDOException $e) {
            $error = "Failed to add job: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Job</title>
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
    <h2>Add Job</h2>

    <!-- Display error or success messages -->
    <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <?php if (!empty($success)): ?>
        <p class="success"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <form method="POST">
        <label for="title">Job Title:</label>
        <input type="text" name="title" id="title" placeholder="Job Title" required>

        <label for="description">Job Description:</label>
        <textarea name="description" id="description" placeholder="Job Description" rows="5" required></textarea>

        <label for="requirements">Requirements:</label>
        <textarea name="requirements" id="requirements" placeholder="Requirements" rows="5" required></textarea>

        <button type="submit">Add Job</button>
    </form>

    <p><a href="dashboard.php">Back to Dashboard</a></p>
</body>
</html>