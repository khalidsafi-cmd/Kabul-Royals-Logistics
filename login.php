<?php
session_start();
require 'config/db.php';

$error = "";

// Handle POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "Both username and password are required!";
        header("Location: login.php");
        exit;
    } else {
        $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
        $stmt->execute([$username]);
        $admin = $stmt->fetch();

        if ($admin && password_verify($password, $admin['password'])) {
            $_SESSION['admin'] = $username;
            header("Location: admin/dashboard.php");
            exit;
        } else {
            $_SESSION['error'] = "Invalid username or password!";
            header("Location: login.php");
            exit;
        }
    }
}

// Show error from session if exists
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Login</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="img/favicon.png">
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
            }

            .login-card {
                background: #fff;
                padding: 60px 40px;
                border-radius: 15px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.25);
                width: 100%;
                max-width: 480px;
                box-sizing: border-box;
            }

            .login-card h2 {
                text-align: center;
                margin-bottom: 40px;
                color: #FF4800;
                font-size: 2.5rem;
            }

            .form-group {
                margin-bottom: 25px;
            }

            label {
                display: block;
                margin-bottom: 8px;
                font-size: 1.1rem;
            }

            input {
                width: 100%;
                padding: 15px 12px;
                font-size: 1.2rem;
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

            .error {
                color: #fff;
                background-color: #dc3545;
                padding: 12px;
                margin-bottom: 25px;
                border-radius: 8px;
                text-align: center;
                font-size: 1.1rem;
                transition: opacity 0.3s ease;
            }

            @media (max-width: 500px) {
                .login-card {
                    padding: 40px 20px;
                }
                .login-card h2 {
                    font-size: 2rem;
                }
                input, button {
                    font-size: 1rem;
                    padding: 12px;
                }
            }
        </style>
</head>
<body>

<div class="login-card">
    <h2>Admin Login</h2>

    <?php if (!empty($error)): ?>
        <div class="error" id="errorMessage"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" placeholder="Username" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Password" required>
        </div>

        <button type="submit">Login</button>
    </form>
</div>

<script>
    // Hide error when user starts typing
    const errorDiv = document.getElementById('errorMessage');
    if (errorDiv) {
        const inputs = document.querySelectorAll('#username, #password');
        inputs.forEach(input => {
            input.addEventListener('input', () => {
                errorDiv.style.display = 'none';
            });
        });
    }
</script>

</body>
</html>
