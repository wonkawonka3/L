<?php
session_start();

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "hotel_management";

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string(trim($_POST['username']));
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            unset($_SESSION['admin_logged_in']);
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    } else {
        $error = "No account found with that username.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - Hotel Maya</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <style>
    body {
      background: linear-gradient(135deg, #e0f7fa, #f1f8e9);
      font-family: 'Poppins', sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .login-card {
      background: white;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      max-width: 400px;
      width: 100%;
    }
    .login-header {
      background: darkgray;
      padding: 20px;
      text-align: center;
      color: black;
    }
    .login-header h3 {
      margin: 0;
      font-weight: 600;
    }
    .login-body {
      padding: 30px;
    }
    .form-label {
      font-weight: 500;
    }
    .form-control {
      border-radius: 50px;
      padding: 10px 15px;
    }
    .input-group-text {
      background-color: #e9f5ff;
      border: none;
      border-radius: 50px 0 0 50px;
    }
    .btn-primary {
      border-radius: 50px;
      font-weight: bold;
      padding: 10px 0;
      transition: background 0.3s ease;
    }
    .btn-primary:hover {
      background: #005bb5;
    }
    .toggle-btn {
      border-radius: 0 50px 50px 0;
      border: none;
      background: #e9f5ff;
    }
    .text-center a {
      color: #0066cc;
      text-decoration: none;
      font-weight: 500;
    }
    .text-center a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<div class="login-card">
  <div class="login-header">
    <h3>Login</h3>
  </div>
  <div class="login-body">
    <?php if ($error): ?>
      <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <form method="POST">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <div class="input-group">
          <span class="input-group-text"><i class="bi bi-person"></i></span>
          <input type="text" id="username" name="username" class="form-control" required>
        </div>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <div class="input-group">
          <span class="input-group-text"><i class="bi bi-lock"></i></span>
          <input type="password" id="password" name="password" class="form-control" required>
          <button class="btn toggle-btn" type="button" id="togglePassword" aria-label="Toggle password visibility">
            <i class="bi bi-eye"></i>
          </button>
        </div>
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="rememberMe">
        <label class="form-check-label" for="rememberMe">Remember Me</label>
      </div>
      <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
    <div class="text-center mt-3">
      <p>Don't have an account? <a href="register.php">Sign Up</a></p>
      <p><a href="forgot_password.php">Forgot Password?</a></p>
    </div>
  </div>
</div>

<script>
document.getElementById('togglePassword').addEventListener('click', function () {
  const passwordField = document.getElementById('password');
  const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
  passwordField.setAttribute('type', type);
  const icon = this.querySelector('i');
  icon.classList.toggle('bi-eye');
  icon.classList.toggle('bi-eye-slash');
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
