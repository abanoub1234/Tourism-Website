<?php
include 'config.php';
session_start();
$userId = $_SESSION['user_id'];
if (!isset($userId)) {
    header('location:login.php');
}

if (isset($_GET['logout'])) {
    unset($userId);
    session_destroy();
    header('location:login.php');
}

if (isset($_GET['areaId'])) {
    $areaId = $_GET['areaId'];

    if (isset($_POST['submit'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $productDescription = mysqli_real_escape_string($conn, $_POST['productDescription']);
        $productPrice = mysqli_real_escape_string($conn, $_POST['productPrice']);
        $image = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'images/' . $image;

        if ($image_size > 2000000) {
            $message[] = 'Image size is too large!';
        } else {
            $update1 = mysqli_query($conn, "UPDATE areas SET name='$name', areaDes='$productDescription', image='$image', price='$productPrice' WHERE id='$areaId'") or die('Query failed');

            if ($update1) {
                move_uploaded_file($image_tmp_name, $image_folder);
                header('location:areas.php');
                $message1[] = 'Tourist area has been successfully updated';
            } else {
                $message[] = 'Failed to update the tourist area';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Tourist Areas in KSA</title>
    <style>
        body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
    background: linear-gradient(to bottom, #f8fcff, #e9f3f7);
    color: #222;
    line-height: 1.6;
}

header {
    background: #0d6efd;
    color: white;
    padding: 30px 20px;
    text-align: center;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    border-bottom-left-radius: 20px;
    border-bottom-right-radius: 20px;
}

nav ul {
    list-style: none;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    padding: 0;
    margin-top: 15px;
}

nav ul li {
    margin: 0 15px;
}

nav ul li a {
    color: #fff;
    text-decoration: none;
    font-weight: 500;
    font-size: 17px;
    padding: 8px 14px;
    border-radius: 6px;
    transition: background 0.3s, color 0.3s;
}

nav ul li a:hover {
    background-color: #ffc107;
    color: #0d6efd;
}

main {
    padding: 30px;
    max-width: 1000px;
    margin: 40px auto;
    background-color: #ffffff;
    border-radius: 16px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.07);
}

form {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

label {
    font-weight: 600;
    color: #333;
}

input,
textarea {
    padding: 12px 15px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 16px;
    transition: border-color 0.3s;
}

input:focus,
textarea:focus {
    border-color: #0d6efd;
    outline: none;
}

input[type="file"] {
    padding: 6px;
}

button {
    padding: 12px 20px;
    background-color: #0d6efd;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #084298;
}

.message, .message1 {
    padding: 12px;
    border-radius: 8px;
    text-align: center;
    font-size: 16px;
    font-weight: bold;
    margin: 15px 0;
}

.message {
    background-color: #dc3545;
    color: #fff;
}

.message1 {
    background-color: #198754;
    color: #fff;
}

footer {
    background-color: #0d6efd;
    color: white;
    text-align: center;
    padding: 16px 0;
    margin-top: 40px;
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
}

    </style>
</head>
<body>
    <header>
        <h1>Tourist Areas in KSA</h1>
        <nav>
            <ul>
                <li><a href="home.php"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="areas.php"><i class="fas fa-map-marked-alt"></i> Tourist Areas</a></li>
                <li><a href="register.php"><i class="fas fa-user-plus"></i> Register</a></li>
                <li><a href="about.php"><i class="fas fa-info-circle"></i> About Us</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <form action="" method="post" enctype="multipart/form-data">
            <?php
            if (isset($message)) {
                foreach ($message as $msg) {
                    echo '<div class="message">' . $msg . '</div>';
                }
            } elseif (isset($message1)) {
                foreach ($message1 as $msg1) {
                    echo '<div class="message1">' . $msg1 . '</div>';
                }
            }
            ?>
            <h2 style="text-align: center;color: #117a8b">Edit a Tourist Area</h2>
            <label for="productImage">Tourist Area Image:</label>
            <input type="file" name="image" id="productImage" required>
            <label for="productName">Tourist Area Name:</label>
            <input type="text" name="name" id="productName" placeholder="Enter Tourist Area Name" required>
            <label for="productDescription">Tourist Area Description:</label>
            <textarea name="productDescription" id="productDescription" placeholder="Enter Tourist Area Description" required></textarea>
            <label for="productPrice">Tourist Area Price (SAR):</label>
            <input type="number" name="productPrice" id="productPrice" placeholder="Enter Tourist Area Price" required>
            <button onclick="return confirm('Are you sure you want to update?')" type="submit" name="submit">Update Area</button>
        </form>
    </main>
    <footer>
       <h2 style="color: #fff;">Tourist Areas in KSA</h2>
    </footer>
</body>
</html>
