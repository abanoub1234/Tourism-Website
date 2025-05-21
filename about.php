<?php
include('config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJf2T8kC8k8pWi5G2kRyp9d7B6b23AX5c09z1h6kXkIXTT9hF9lkW4HLGFL5" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>About Us</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }

        header {
            background: #4c6ef5;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        header nav ul {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        header nav ul li {
            margin-right: 30px;
        }

        header nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            font-size: 18px;
            transition: color 0.3s ease;
        }

        header nav ul li a:hover {
            color: #ffcc00;
        }

        main {
            padding: 40px 20px;
        }

        .about-container, .contact-container {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 30px;
        }

        h1, h2 {
            color: #4c6ef5;
            text-align: center;
            margin-bottom: 20px;
        }

        .about-container p, .contact-container p {
            margin-bottom: 15px;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #4c6ef5;
            color: #fff;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        footer p {
            margin: 0;
        }

        @media (max-width: 768px) {
            header nav ul {
                flex-direction: column;
            }

            header nav ul li {
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>

<header>
    <nav class="container">
        <ul>
            <li><a href="home.php"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="areas.php"><i class="fas fa-map-marked-alt"></i> Tourist Areas</a></li>
            <li><a href="about.php"><i class="fas fa-info-circle"></i> About Us</a></li>
            <li><a onclick="return confirm('Are you sure to log out?')" href="login.php?logout"><i class="fas fa-sign-in-alt"></i> Logout</a></li>
        </ul>
    </nav>
</header>

<main class="container">
    <section class="about-container">
        <h1>About Us</h1>
        <p>Welcome to our project! We are dedicated to providing the best services and connecting users with top tourist destinations in KSA.</p>
        <p>Our goal is to create seamless experiences through innovation, making it easier for users to discover and explore the most interesting places around.</p>
    </section>

    <section class="contact-container">
        <h2>Contact Us</h2>
        <p>We are here to assist you. If you have any questions or concerns, feel free to reach out:</p>
        <p><strong>Phone:</strong> +966 123 456 7890</p>
        <p><strong>Email:</strong> support@touristksa.com</p>
    </section>
</main>

<footer>
    <h2 style="color: #fff;">Tourist Areas in KSA</h2>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0v8FqPHOp6v9GJ5Fj4z3l2R51FQz5F0z6D3x3U1PBjKp5N5D" crossorigin="anonymous"></script>
</body>
</html>
