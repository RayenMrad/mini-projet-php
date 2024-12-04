<?php
// You can include any PHP code here if needed for functionality (e.g., authentication, session handling, etc.)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Location App</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom styling for the page */
        body {
            background-color: #f0f4f8;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Navbar styles */
        .navbar {
            background-color: #23272b;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .navbar-brand {
            font-size: 2rem;
            color: #ff7b00;
            font-weight: bold;
            text-transform: uppercase;
        }
        .navbar-nav .nav-link {
            color: #fff;
            font-size: 1.1rem;
            padding: 12px 20px;
        }
        .navbar-nav .nav-link:hover {
            background-color: #ff7b00;
            color: #fff;
            border-radius: 5px;
        }

        /* Hero Section with Background */
        .hero-section {
            background: linear-gradient(45deg, #ff7b00, #ff477e);
            color: white;
            text-align: center;
            padding: 100px 30px;
            background-size: cover;
            background-position: center;
            border-bottom: 5px solid #f8f9fa;
            animation: fadeIn 2s ease-out;
        }
        .hero-section h1 {
            font-size: 4rem;
            font-weight: 800;
            margin-bottom: 20px;
            animation: bounceIn 2s;
        }
        .hero-section p {
            font-size: 1.5rem;
            margin-top: 15px;
            animation: fadeInUp 2s;
        }

        /* Button Styles */
        .login-btn, .sign-in-btn {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 14px 30px;
            font-size: 1.2rem;
            border-radius: 50px;
            margin: 10px 20px;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .login-btn:hover, .sign-in-btn:hover {
            background-color: #218838;
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.2);
            transform: translateY(-5px);
        }

        .card {
            margin-top: 50px;
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            padding: 30px;
            text-align: center;
        }
        .card-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 20px;
        }
        .card-body p {
            font-size: 1.2rem;
            color: #555;
            margin-bottom: 30px;
        }

        /* Animations */
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        @keyframes bounceIn {
            0% { transform: translateY(-100px); opacity: 0; }
            60% { transform: translateY(20px); opacity: 1; }
            100% { transform: translateY(0); }
        }

        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        /* Footer */
        footer {
            background-color: #23272b;
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 1rem;
            position: absolute;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="#">CarLocator</a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="signin.php">Sign In</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Hero Section -->
<div class="hero-section">
    <h1>Welcome to CarLocator</h1>
    <p>Your car's location, now at your fingertips. Track it, anywhere, anytime.</p>
</div>

<!-- Main Content -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Get Started with CarLocator</h3>
                    <p>Login to access your dashboard or sign up to create a new account.</p>
                    <div>
                        <a href="login.php" class="btn login-btn">Login</a>
                        <a href="signin.php" class="btn sign-in-btn">Sign In</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer>
    <p>&copy; 2024 CarLocator. All rights reserved.</p>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
