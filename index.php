<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <link rel="stylesheet" href="i.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            <img src="logo.jpg" alt="Logo">
            <span>Bori Cars</span>
        </div>
        <div class="nav-buttons">
            <a href="sinscrire.php" class="btn">Sign In</a>
            <?php if (!isset($_SESSION['client_id'])): ?>
                <a href="login.php" class="btn">Login</a>
            <?php else: ?>
                <a href="logout.php" class="btn">Logout</a>
            <?php endif; ?>
        </div>
    </nav>

    <!-- Body Content -->
    <div class="content">
        <!-- Hero Section -->
        <section class="hero">
            <h1>Welcome to Bori Cars</h1>
            <p>Experience the future of services with us. Your satisfaction, our priority.</p>
            <button class="cta-btn">Explore More</button>
        </section>

        <!-- About Us Section -->
        <section class="about">
            <h2>About Us</h2>
            <p>We are dedicated to delivering excellence in every aspect of our services. From innovative solutions to top-notch support, we ensure your needs are met and expectations are exceeded.</p>
        </section>

        <!-- Services Section -->
        <section class="services">
            <h2>Our Services</h2>
            <div class="service-cards">
                <div class="service-card">
                    <img src="s1.jpg" alt="Service 1">
                    <h3>Service One</h3>
                    <p>Delivering excellence through innovation and creativity.</p>
                </div>
                <div class="service-card">
                    <img src="s2.jpg" alt="Service 2">
                    <h3>Service Two</h3>
                    <p>Focused on providing solutions tailored to your needs.</p>
                </div>
                <div class="service-card">
                    <img src="s3.jpg" alt="Service 3">
                    <h3>Service Three</h3>
                    <p>Quality you can trust, results you can see.</p>
                </div>
            </div>
        </section>

        <!-- Gallery Section -->
        <section class="gallery">
            <h2>Gallery</h2>
            <div class="gallery-grid">
                <img src="bmw.jpg" alt="Gallery Image 1">
                <img src="mercedes.jpg" alt="Gallery Image 2">
                <img src="audi.jpg" alt="Gallery Image 3">
                <img src="golf.jpg" alt="Gallery Image 4">
            </div>
        </section>
        <!-- FAQ Section -->
        <section class="faq">
            <h2>Frequently Asked Questions</h2>
            <div class="faq-item">
                <h3>What services do you offer?</h3>
                <p>We offer a wide range of services including software development, IT consulting, and cloud solutions.</p>
            </div>
            <div class="faq-item">
                <h3>How can I contact support?</h3>
                <p>You can reach us via email at support@mywebsite.com or call us at (123) 456-7890.</p>
            </div>
        </section>

        <!-- Call-to-Action Section -->
        <section class="cta">
            <h2>Ready to Get Started?</h2>
            <p>Join thousands of satisfied customers and elevate your experience with us.</p>
            <button class="cta-btn">Sign Up Now</button>
        </section>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 Bori Cars. All Rights Reserved.</p>
    </footer>
</body>
</html>
