<?php
include 'config.php';
session_start();

if (isset($_POST['submit2'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = $_POST['password']; // no need to escape for password_verify

    $select1 = mysqli_query($conn, "SELECT * FROM `user` WHERE email = '$email'") or die('query failed');

    if (mysqli_num_rows($select1) > 0) {
        $row1 = mysqli_fetch_assoc($select1);

        if (password_verify($pass, $row1['password'])) {
            $_SESSION['user_id'] = $row1['id'];
            header('location:home.php');
            exit;
        } else {
            $message[] = 'Incorrect email or password!';
        }
    } else {
        $message[] = 'Incorrect email or password!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - Tourist Areas in KSA</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(to right, #6a11cb, #2575fc);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      color: #fff;
    }

    .login-container {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(12px);
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
      width: 100%;
      max-width: 400px;
    }

    .login-container h2 {
      text-align: center;
      margin-bottom: 30px;
      font-size: 28px;
    }

    .login-container input {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: none;
      border-radius: 10px;
      font-size: 16px;
    }

    .login-container input[type="submit"] {
      background-color: #ffd700;
      color: #333;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s;
    }

    .login-container input[type="submit"]:hover {
      background-color: #ffc300;
    }

    .error-message {
      color: #ffcccb;
      margin-bottom: 15px;
      text-align: center;
    }

    .login-container a {
      display: block;
      text-align: center;
      margin-top: 15px;
      color: #fff;
      text-decoration: underline;
    }
  </style>
</head>
<body>

<div class="login-container">
  <h2><i class="fas fa-user-lock"></i> Login</h2>

  <?php
  if (!empty($message)) {
      foreach ($message as $msg) {
          echo '<div class="error-message">' . $msg . '</div>';
      }
  }
  ?>

  <form id="loginForm" action="" method="post" onsubmit="return validateLoginForm()">
    <input type="email" name="email" id="email" placeholder="Enter Email" required>
    <input type="password" name="password" id="password" placeholder="Enter Password" required>
    <input type="submit" name="submit2" value="Login">
  </form>

  <a href="register.php">Don't have an account? Register</a>

  
</div>

<script>
  function validateLoginForm() {
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;

    if (!email || !password) {
      alert("Please fill in all fields.");
      return false;
    }

    const emailRegex = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    if (!emailRegex.test(email)) {
      alert("Please enter a valid email address.");
      return false;
    }

    if (password.length < 6) {
      alert("Password must be at least 6 characters.");
      return false;
    }

    return true;
  }
</script>

</body>
</html>
