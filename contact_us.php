<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Hotel Maya</title>
    <style>
   
        body {
            background: linear-gradient(135deg, black, #f1f8e9);;
            font-family: 'Open Sans', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
        }


        .navbar {
            background-color: #003366 !important;
        }
        .navbar-brand, .nav-link {
            color: white !important;
        }
        .navbar-brand:hover, .nav-link:hover {
            color: #ffc107 !important;
        }
        .btn-outline-light {
            border-color: white;
            color: white;
        }
        .btn-outline-light:hover {
            background-color: white;
            color: #003366;
        }


        .hero {
            background-image: url('hotel.jpg');
            background-size: cover;
            background-position: center;
            height: 50vh;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
        }
        .hero-content {
            position: relative;
            z-index: 1;
            text-align: center;
        }

     
        .contact-section {
            padding: 60px 0;
            background-color: #fff;
        }
        .contact-info {
            background: linear-gradient(135deg, black, white);
            color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .contact-info h3 {
            margin-bottom: 20px;
            font-size: 1.75rem;
        }
        .contact-info p {
            margin-bottom: 15px;
            font-size: 1.1rem;
        }
        .contact-info i {
            margin-right: 10px;
            color: #ffc107;
        }

        .map-container {
            margin-top: 30px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 10%;
        }
        .map-container iframe {
            width: 100%;
            height: 300px;
            border: 0;
        }

    
        .footer {
            background-color: rgba(0,0 ,0 ,0.8); 
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: 20px;
           
        } 
        .footer a:hover {
            color: #ffc107;
        }
        .footer h5 {
            color: #ffc107;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">Hotel Maya</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php">Rooms</a></li>
                <li class="nav-item"><a class="nav-link" href="contact_us.php">Contact</a></li>
                <?php if ($isLoggedIn): ?>
                    <li class="nav-item"><a class="btn btn-danger ms-2" href="log_out.php">Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="btn btn-outline-light ms-2" href="login_.php">Login</a></li>
                   
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>


<section class="hero">
    <div class="hero-content">
        <h1 class="hero-title">Contact Us</h1>
        <p class="hero-subtitle">We're here to help you with any questions or concerns.</p>
    </div>
</section>


<div class="container">
    <div class="row g-4">
   
        <div class="col-lg-4">
            <div class="contact-info">
                <h3>Contact Information</h3>
                <p><i class="fas fa-map-marker-alt"></i> 123 Luxury Street, City, Country</p>
                <p><i class="fas fa-phone"></i> +123 456 7890</p>
                <p><i class="fas fa-envelope"></i> info@hotelmaya.com</p>
                <p><i class="fas fa-clock"></i> Mon - Sun: 24/7</p>
            </div>
        </div>

        
    <div class="map-container mt-5">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d439.2744663780518!2d120.94866291533941!3d15.301249256292868!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33972159dac840a9%3A0x89eb5c1043cafb8!2sRobinsons%20Movieworld%20Gapan!5e1!3m2!1sen!2sph!4v1741952037052!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>       
    </div>
</div>

<footer class="footer bg-dark text-white text-center py-4 mt-4">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <h5>Quick Links</h5>
        <ul class="list-unstyled">
          <li><a href="index.php" class="text-white">Home</a></li>
          <li><a href="#rooms" class="text-white">Rooms</a></li>
          <li><a href="contact_us.php" class="text-white">Contact</a></li>
          <li><a href="about_us.php" class="text-white">About Us</a></li>
        </ul>
      </div>
      <div class="col-md-4">
        <h5>Contact Us</h5>
        <p><i class="fas fa-phone"></i> +1 234 567 890</p>
        <p><i class="fas fa-envelope"></i> support@hotelmaya.com</p>
        <p><i class="fas fa-map-marker-alt"></i> Robinson Gapan</p>
      </div>
      <div class="col-md-4">
        <h5>Connect With Us</h5>
        <a href="https://facebook.com" target="_blank" class="text-white me-2"><i class="fab fa-facebook fa-lg"></i></a>
        <a href="https://twitter.com" target="_blank" class="text-white me-2"><i class="fab fa-twitter fa-lg"></i></a>
        <a href="https://instagram.com" target="_blank" class="text-white me-2"><i class="fab fa-instagram fa-lg"></i></a>
        <a href="https://linkedin.com" target="_blank" class="text-white"><i class="fab fa-linkedin fa-lg"></i></a>
        <div class="mt-3">
          <a href="admin_login.php" class="btn btn-secondary">Admin Login</a>
        </div>
      </div>
    </div>
    <hr class="bg-light">
    <p class="mb-0">© 2025 Hotel Maya. All rights reserved.</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>