<?php
require_once 'lib/db_connect.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $position = filter_input(INPUT_POST, 'position', FILTER_SANITIZE_STRING);
    $resume = $_FILES['resume']['name'];

    // Save the uploaded resume file
    $targetDir = "uploads/resumes/";
    $targetFile = $targetDir . basename($resume);
    move_uploaded_file($_FILES['resume']['tmp_name'], $targetFile);

    try {
        $stmt = $pdo->prepare("INSERT INTO careers (name, email, phone, position, resume) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $phone, $position, $resume]);
        $successMessage = "Your application has been submitted successfully!";
    } catch (PDOException $e) {
        $errorMessage = "Error submitting application: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>KRL Logistic Services</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Include Header -->
    <?php include 'components/header.php'; ?>

    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid mb-5">
        <div class="container text-center py-5">
            <h1 class="text-white display-3">Careers</h1>
            <div class="d-inline-flex align-items-center text-white">
                <p class="m-0"><a class="text-white" href="">Home</a></p>
                <i class="fa fa-circle px-3"></i>
                <p class="m-0">Careers</p>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Careers Start -->
    <div class="container mt-5">
        <h1 class="mb-4">Join Our Team</h1>
        <p>We are always looking for talented individuals to join our team. Please fill out the form below to apply for a position.</p>

        <?php if (isset($successMessage)): ?>
            <div class="alert alert-success"> <?php echo $successMessage; ?> </div>
        <?php elseif (isset($errorMessage)): ?>
            <div class="alert alert-danger"> <?php echo $errorMessage; ?> </div>
        <?php endif; ?>

        <form action="careers.php" method="POST" enctype="multipart/form-data" class="mt-4">
            <div class="mb-3">
                <label for="name" class="form-label">Full Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email Address:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number:</label>
                <input type="text" id="phone" name="phone" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="position" class="form-label">Position Applied For:</label>
                <input type="text" id="position" name="position" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="resume" class="form-label">Upload Resume:</label>
                <input type="file" id="resume" name="resume" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit Application</button>
        </form