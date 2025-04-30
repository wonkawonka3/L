<?php
session_start();

$servername = "localhost";    
$dbUsername = "root";         
$dbPassword = "";             
$dbname     = "hotel_management"; 

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);


    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND role = 'admin' LIMIT 1");
    if (!$stmt) {
        die("SQL error: " . $conn->error);
    }
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $adminRow = $result->fetch_assoc();

        if ($password === $adminRow['password']) {
            $_SESSION['admin_logged_in'] = true;
            unset($_SESSION['user_id']); 

            header("Location: admin_dashboard.php");
            exit;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "Admin not found or invalid username.";
    }

    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background: #0f172a;
      position: relative;
    }
    .login-container {
      position: relative;
      width: 350px;
      padding: 50px;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 20px;
      backdrop-filter: blur(10px);
      box-shadow: 0 10px 30px rgba(0, 255, 255, 0.3);
      text-align: center;
      animation: tiltEffect 5s infinite alternate ease-in-out;
    }
    @keyframes tiltEffect {
      from {
        transform: rotateX(5deg) rotateY(-5deg);
      }
      to {
        transform: rotateX(-5deg) rotateY(5deg);
      }
    }
    .login-container h2 {
      color: white;
      margin-bottom: 20px;
      font-weight: 500;
    }
    .input-box {
      position: relative;
      margin: 15px 0;
    }
    .input-box input {
      width: 100%;
      padding: 12px 15px;
      background: rgba(0, 255, 255, 0.1);
      font-size: 16px;
      transition: 0.3s;
      text-align: center;
      border: none;
      outline: none;
      color: white;
      border-radius: 30px;
      border: 1px solid transparent;
    }
    .input-box input:focus {
      background: rgba(255, 255, 255, 0.5);
      border: 1px solid #00ffff;
      transform: scale(1.05);
    }
    .input-box i {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: white;
    }
    .btn {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 30px;
      background: linear-gradient(13deg, #00f2ff, #6a11cb);
      color: white;
      font-size: 14px;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s;
      position: relative;
      overflow: hidden;
    }
    .btn::before {
      content: '';
      position: absolute;
      width: 100%;
      height: 100%;
      background: rgba(255, 255, 255, 0.3);
      top: 0;
      left: -100%;
      transition: 0.4s;
    }
    .btn:hover {
      background: linear-gradient(13deg, #00f2ff, #6a11cb);
      box-shadow: 0 0 15px #00f2ff;
    }
    .error {
      color: #ff6b6b;
      margin-bottom: 15px;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Admin Login</h2>
    <?php if(isset($error)) { echo "<p class='error'>$error</p>"; } ?>
    <form method="POST" action="admin_login.php">
      <div class="input-box">
        <input type="text" name="username" placeholder="Username" required>
        <i class="fas fa-user"></i>
      </div>
      <div class="input-box">
        <input type="password" name="password" placeholder="Password" required>
        <i class="fas fa-lock"></i>
      </div>
      <button type="submit" class="btn">Login as Admin</button>
      <button type="button" class="btn" onclick="window.location.href='index.php'">Home Page</button>
    </form>
  </div>
</body>
</html>
