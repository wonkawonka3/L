<?php
$roomId = $_GET['id'] ?? ''; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Elegant Booking | Hotel Maya</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Google Fonts for Modern Elegance -->
  <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700&family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
  <style>
    /* Global Styles */
    body {
      font-family: 'Montserrat', sans-serif;
      background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
      color: #333;
      margin: 0;
      padding: 0;
    }
    h1, h2, h3, .brand {
      font-family: 'Merriweather', serif;
    }
    /* Booking Container */
    .booking-container {
      max-width: 500px;
      background: #fff;
      margin: 100px auto;
      padding: 50px 40px;
      border-radius: 15px;
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
      position: relative;
      overflow: hidden;
    }
    .booking-container::before {
      content: "";
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle, rgba(166,124,82,0.15), transparent 70%);
      transform: rotate(45deg);
    }
    .booking-container:hover {
      transform: translateY(-5px);
      transition: transform 0.3s ease;
    }
    .booking-container h1 {
      text-align: center;
      margin-bottom: 30px;
      color: #2c3e50;
      font-weight: 700;
      position: relative;
      z-index: 1;
    }
    /* Form Styles */
    form label {
      margin-bottom: 5px;
      font-weight: 500;
      color: #2c3e50;
      position: relative;
      z-index: 1;
    }
    form .form-control {
      border-radius: 8px;
      padding: 12px 15px;
      border: 1px solid #ddd;
      transition: border-color 0.3s, box-shadow 0.3s;
      position: relative;
      z-index: 1;
      background: #fdfdfd;
    }
    form .form-control:focus {
      border-color: #a67c52;
      box-shadow: 0 0 10px rgba(166,124,82,0.3);
      outline: none;
    }
    /* Custom Button Styles */
    button[type="submit"] {
      width: 100%;
      background: #a67c52;
      color: #fff;
      border: none;
      padding: 14px;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: 500;
      cursor: pointer;
      transition: background 0.3s ease, transform 0.3s ease;
      margin-top: 20px;
      position: relative;
      z-index: 1;
    }
    button[type="submit"]:hover {
      background: #8e6b43;
      transform: scale(1.02);
    }
    button[type="submit"]:active {
      transform: scale(0.98);
    }
    /* Input Group Margin */
    .mb-3 {
      position: relative;
      z-index: 1;
    }
  </style>
</head>
<body>
  <div class="booking-container">
    <h1>Reserve Your Stay</h1>
    <form action="process_booking.php" method="POST">
      <input type="hidden" name="room_id" value="<?php echo htmlspecialchars($roomId); ?>">
      
      <div class="mb-3">
        <label for="name" class="form-label">Your Name:</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="John Doe" required>
      </div>
      
      <div class="mb-3">
        <label for="email" class="form-label">Your Email:</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="example@mail.com" required>
      </div>
      
      <div class="mb-3">
        <label for="phone" class="form-label">Phone Number:</label>
        <input type="text" class="form-control" id="phone" name="phone" placeholder="(123) 456-7890" required>
      </div>
      
      <button type="submit">Confirm Booking</button>
    </form>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
