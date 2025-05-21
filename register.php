<?php
include 'config.php';
session_start();

$message = [];
$message1 = [];

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'images/' . $image;

    $select = mysqli_query($conn, "SELECT * FROM `user` WHERE email = '$email'") or die('Query failed');

    if (mysqli_num_rows($select) > 0) {
        $message[] = 'User already exists';
    } else {
        if ($password != $cpassword) {
            $message[] = 'Confirm password does not match!';
        } elseif ($image_size > 2000000) {
            $message[] = 'Image size is too large!';
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $insert = mysqli_query($conn, "INSERT INTO `user`(name, email, password, image) VALUES('$name', '$email', '$hashed_password', '$image')") or die('Query failed');

            if ($insert) {
                move_uploaded_file($image_tmp_name, $image_folder);
                $message1[] = 'Registration is successful!';
            } else {
                $message[] = 'Registration failed!';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Tourist Areas in KSA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0; padding: 0; box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #0093E9, #80D0C7);
            color: #333;
        }

        header {
            background: #006994;
            padding: 20px 0;
            text-align: center;
        }

        nav ul {
            list-style-type: none;
            display: flex;
            justify-content: center;
            gap: 30px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 30px;
            transition: 0.3s;
        }

        nav ul li a:hover {
            background-color: #00A6FB;
        }

        .form-container {
            max-width: 600px;
            margin: 80px auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
            position: relative;
        }

        h2 {
            text-align: center;
            color: #006994;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            color: #006994;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="file"] {
            width: 100%;
            padding: 12px;
            margin-top: 6px;
            border: 2px solid #0093E9;
            border-radius: 10px;
        }

        input:focus {
            border-color: #006994;
            outline: none;
        }

        .message, .message1 {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
            text-align: center;
            font-weight: bold;
        }

        .message {
            background: #ff4d4d;
            color: white;
        }

        .message1 {
            background: #2ecc71;
            color: white;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #0093E9;
            color: white;
            font-size: 18px;
            border: none;
            border-radius: 10px;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        button:hover {
            background-color: #006994;
        }

        footer {
            background: #006994;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 60px;
        }

        .shape, .shape2 {
            position: absolute;
            border-radius: 50%;
            z-index: -1;
        }

        .shape {
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            top: -60px;
            left: -60px;
        }

        .shape2 {
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.15);
            bottom: -40px;
            right: -40px;
        }

        @media (max-width: 768px) {
            .form-container {
                margin: 40px 20px;
                padding: 30px;
            }
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="home.php"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="areas.php"><i class="fas fa-map-marked-alt"></i> Tourist Areas</a></li>
                <li><a href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a></li>
            </ul>
        </nav>
    </header>

    <div class="form-container">
        <h2>User Registration</h2>

        <?php
        if (!empty($message)) {
            foreach ($message as $msg) {
                echo '<div class="message">' . $msg . '</div>';
            }
        } elseif (!empty($message1)) {
            foreach ($message1 as $msg1) {
                echo '<div class="message1">' . $msg1 . '</div>';
            }
        }
        ?>

        <form id="registerForm" action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="image">Upload Your Image:</label>
                <input type="file" name="image" id="image" required>
            </div>

            <div class="form-group">
                <label for="name">Your Name:</label>
                <input type="text" name="name" id="name" placeholder="Enter full name" required>
            </div>

            <div class="form-group">
                <label for="email">Your Email:</label>
                <input type="email" name="email" id="email" placeholder="Enter email address" required>
            </div>

            <div class="form-group">
                <label for="password">Your Password:</label>
                <input type="password" name="password" id="password" placeholder="Enter password" required>
            </div>

            <div class="form-group">
                <label for="cpassword">Confirm Password:</label>
                <input type="password" name="cpassword" id="cpassword" placeholder="Re-enter password" required>
            </div>

            <button type="submit" name="submit">Register</button>
        </form>

        <div class="shape"></div>
        <div class="shape2"></div>
    </div>

    <footer>
    <h2 style="color: #fff;">Tourist Areas in KSA</h2>
</footer>


    <script>
        function validateForm() {
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;
            const cpassword = document.getElementById('cpassword').value;
            const image = document.getElementById('image').files[0];

            if (!name || !email || !password || !cpassword || !image) {
                alert("Please fill in all fields.");
                return false;
            }

            const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
            if (!emailPattern.test(email)) {
                alert("Please enter a valid email address.");
                return false;
            }

            if (password.length < 6) {
                alert("Password must be at least 6 characters.");
                return false;
            }

            if (password !== cpassword) {
                alert("Passwords do not match.");
                return false;
            }

            const allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
            if (!allowedExtensions.exec(image.name)) {
                alert("Invalid image file. Only JPG, PNG, and GIF allowed.");
                return false;
            }

            if (image.size > 2000000) {
                alert("Image size must be less than 2MB.");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
