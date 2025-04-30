<?php
session_start();
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "hotel_management";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$isUserLoggedIn  = isset($_SESSION['user_id']);
$isAdminLoggedIn = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;

$whereClauses = ["status = 'Available'"];
if (!empty($_GET['room_type'])) {
    $whereClauses[] = "room_type = '" . $conn->real_escape_string($_GET['room_type']) . "'";
}
if (!empty($_GET['min_price'])) {
    $whereClauses[] = "price >= " . (int)$_GET['min_price'];
}
if (!empty($_GET['max_price'])) {
    $whereClauses[] = "price <= " . (int)$_GET['max_price'];
}

$sql = "SELECT * FROM rooms WHERE " . implode(" AND ", $whereClauses);
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel Maya | Luxury Stay</title>
  <style>
    body {
      background: linear-gradient(135deg, black, #f1f8e9);
      font-family: 'Open Sans', sans-serif; 
      margin: 0;
      padding: 0;
    }
    .navbar {
      background: rgba(0, 0, 0, 0.7) !important;
    }
    .navbar-brand, .nav-link {
      color: #ffffff !important;
    }
    .navbar-brand:hover, .nav-link:hover {
      color: #ffc107 !important;
    }
    .hero {
      background-image: url('hotel.jpg');
      background-size: cover;
      background-position: center;
      height: 100vh;
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: #ffffff;
    }
    .hero::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.4);
    }
    .hero-content {
      position: relative;
      z-index: 1;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
    }
    .hero-title {
      font-size: 3rem;
      margin-bottom: 20px;
    }
    .hero-subtitle {
      font-size: 1.5rem;
      margin-bottom: 30px;
    }
    .card {
      transition: transform 0.3s, box-shadow 0.3s;
      border: none;
      border-radius: 10px;
      overflow: hidden;
      background: rgba(255, 255, 255, 0.9);
    }
    .card:hover {
      transform: scale(1.05);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }
    .card-img-top {
      height: 200px;
      object-fit: cover;
    }
    .card-body {
      color: #333;
    }
    .card-title {
      color: #003366;
    }
    .btn-dark {
      background: #003366;
      border: none;
    }
    .btn-dark:hover {
      background: #002244;
    }
    #rooms h2 {
      margin-top: 40px;
      margin-bottom: 20px;
      color: #ffffff;
      text-shadow: 1px 1px 3px rgba(0,0,0,0.5);
    }
    .footer {
      background: rgba(0, 0, 0, 0.8);
      color: #ffffff;
      text-align: center;
      padding: 20px 0;
      margin-top: 40px;
    }
    .footer a {
      color: #ffffff;
      text-decoration: none;
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
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Lato:wght@300;400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="#">Hotel Maya</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="rooms.html">Rooms</a></li>
        <li class="nav-item"><a class="nav-link" href="contact_us.php">Contact</a></li>
        <?php if ($isAdminLoggedIn): ?>
          <li class="nav-item"><a class="nav-link" href="admin_dashboard.php">Admin Dashboard</a></li>
          <li class="nav-item"><a class="btn btn-danger ms-2" href="log_out.php">Logout</a></li>
        <?php elseif ($isUserLoggedIn): ?>
          <li class="nav-item"><a class="btn btn-danger ms-2" href="log_out.php">Logout</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="btn btn-outline-light ms-2" href="user_login.php">Login</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<section class="hero" data-aos="fade-in">
  <div class="hero-content text-center">
    <h1 class="hero-title">Experience Luxury Redefined</h1>
    <p class="hero-subtitle">Your Perfect Getaway Awaits</p>
    <a href="#rooms" class="btn btn-secondary">Explore Rooms</a>
  </div>
</section>

<section id="rooms" class="container mt-4">
  <h2 class="text-center">Our Available Rooms</h2>
  <div class="row g-4">
    <?php while ($row = $result->fetch_assoc()) { ?>
      <div class="col-lg-4 col-md-6" data-aos="fade-up">
        <div class="card">
         
          <img src="<?= htmlspecialchars($row['image_path']) ?>" class="card-img-top" alt="<?= htmlspecialchars($row['room_type']) ?>">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($row['room_type']) ?></h5>
            <p>Room <?= htmlspecialchars($row['room_number']) ?></p>
            <p><i class="fas fa-bed"></i> <?= htmlspecialchars($row['beds']) ?> Beds</p>
            <p><i class="fas fa-users"></i> Guests: <?= htmlspecialchars($row['capacity']) ?></p>
            <h6 class="text-danger">$<?= htmlspecialchars($row['price']) ?>/night</h6>

            <a href="<?= ($isUserLoggedIn && !$isAdminLoggedIn) ? 'book_room.php?id=' . $row['id'] : 'login_.php' ?>" class="btn btn-dark w-100">
              <?= ($isUserLoggedIn && !$isAdminLoggedIn) ? "Book Now" : "Login to Book" ?>
            </a>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</section>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
  AOS.init();
</script>
</body>
</html>

<?php $conn->close(); ?>
