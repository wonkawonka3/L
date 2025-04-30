<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

$servername = "localhost";
$dbUser = "root";
$dbPass = "";
$dbname = "hotel_management";

$conn = new mysqli($servername, $dbUser, $dbPass, $dbname);
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = isset($_POST['name']) ? trim($_POST['name']) : null;
    $username = isset($_POST['username']) ? trim($_POST['username']) : null;
    $email    = isset($_POST['email']) ? trim($_POST['email']) : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;

    if (empty($name) || empty($username) || empty($email) || empty($password)) {
        die("All fields are required. Please fill out the form completely.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("ss", $email, $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->close();
        die("Username or Email already in use. Please choose a different one.");
    }
    $stmt->close();

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, username, email, password) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("ssss", $name, $username, $email, $hashedPassword);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        die("Error: " . $stmt->error);
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sign Up - Hotel Maya</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #e0f7fa, #f1f8e9);
      font-family: 'Poppins', sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .signup-card {
      background: white;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      max-width: 450px;
      width: 100%;
    }
    .card-header {
      background: darkgray;
      padding: 20px;
      text-align: center;
      color: black;
    }
    .card-header h3 {
      margin: 0;
      font-weight: 600;
    }
    .card-body {
      padding: 30px;
    }
    .form-label {
      font-weight: 500;
    }
    .form-control {
      border-radius: 50px;
      padding: 12px 15px;
      border: 2px solid #e0e0e0;
      transition: border-color 0.3s;
    }
    .form-control:focus {
      border-color: #00aaff;
      box-shadow: none;
    }
    .btn-custom {
      border-radius: 50px;
      font-weight: bold;
      padding: 12px;
      background: darkgrey;
      border: none;
      transition: background 0.3s ease;
      width: 100%;
    }
    .btn-custom:hover {
      background: darkgrey;
    }
    .text-center a {
      color: #00aaff;
      text-decoration: none;
      font-weight: 500;
    }
    .text-center a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="signup-card mx-auto">
      <div class="card-header">
        <h3>Sign Up</h3>
      </div>
      <div class="card-body">
        <form method="POST" action="register.php">
          <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Your full name" required>
          </div>
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" id="username" placeholder="Choose a username" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="you@example.com" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Create a password" required>
          </div>
          <button type="submit" class="btn btn-custom">Sign Up</button>
        </form>
        <p class="text-center mt-3">Already have an account? <a href="user_login.php">Login</a></p>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
