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
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tourist Areas in KSA</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Inter', sans-serif;
    }

    body {
      background: linear-gradient(to right, #e0eafc, #cfdef3);
      color: #333;
      line-height: 1.6;
    }

    header {
      background: rgba(255, 255, 255, 0.25);
      backdrop-filter: blur(10px);
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1000;
      box-shadow: 0 8px 32px rgba(31, 38, 135, 0.2);
      padding: 20px 0;
    }

    nav ul {
      display: flex;
      justify-content: center;
      list-style: none;
      gap: 40px;
    }

    nav ul li a {
      text-decoration: none;
      color: #333;
      font-weight: 600;
      font-size: 18px;
      transition: all 0.3s ease;
    }

    nav ul li a:hover {
      color: #0077b6;
    }

    main {
      padding: 140px 40px 60px;
      max-width: 1200px;
      margin: auto;
    }

    .about {
      background: rgba(255, 255, 255, 0.5);
      border-radius: 20px;
      display: flex;
      gap: 40px;
      padding: 30px;
      margin-bottom: 60px;
      box-shadow: 0 12px 20px rgba(0, 0, 0, 0.1);
      flex-wrap: wrap;
    }

    .about p {
      font-size: 18px;
      color: #444;
      flex: 1;
    }

    .about img {
      max-width: 400px;
      border-radius: 20px;
      object-fit: cover;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
      transition: transform 0.3s ease;
    }

    .about img:hover {
      transform: scale(1.05);
    }

    .product-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 30px;
    }

    .product {
      background: rgba(255, 255, 255, 0.8);
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
      display: flex;
      flex-direction: column;
    }

    .product:hover {
      transform: translateY(-8px);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .product img {
      width: 100%;
      height: 220px;
      object-fit: cover;
    }

    .product h3 {
      font-size: 20px;
      color: #0077b6;
      padding: 15px 20px 5px;
    }

    .product p {
      padding: 0 20px 15px;
      color: #555;
      font-size: 16px;
    }

    .price {
      margin: 0 20px 20px;
      font-weight: bold;
      font-size: 18px;
      color: #38b000;
    }

    footer {
      background: linear-gradient(to right, #03045e, #0077b6);
      padding: 30px 20px;
      text-align: center;
      color: #fff;
      margin-top: 60px;
    }

    footer h1 {
      font-size: 24px;
    }

    footer p {
      font-size: 16px;
      margin-top: 10px;
      color: #e0e0e0;
    }

    @media (max-width: 768px) {
      .about {
        flex-direction: column;
        text-align: center;
      }

      .about img {
        max-width: 100%;
      }

      nav ul {
        flex-direction: column;
        gap: 20px;
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
      <li><a href="about.php"><i class="fas fa-info-circle"></i> About Us</a></li>
      <li><a href="login.php?logout" onclick="return confirm('Are you sure to log out?')"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
  </nav>
</header>

<main>
  <div class="about">
    <div>
      <p>Welcome to our tourist website dedicated to showcasing the beauty and wonders of Saudi Arabia. We offer a comprehensive guide to various tourist areas across the Kingdom.</p>
      <p>From historical landmarks to breathtaking landscapes, Saudi Arabia has something for every traveler. Discover it all with us.</p>
    </div>
    <img src="images/new.webp" alt="Tourist Saudi Arabia" />
  </div>

  <div class="product-grid">
  <div class="product">
    <img src="images/alula-rocks.webp" alt="AlUla Rocks" />
    <h3>AlUla Rock Formations</h3>
    <p>Home to breathtaking desert landscapes, ancient tombs, and dramatic rock formations carved by time.</p>
    <span class="price">Free</span>
  </div>

  <div class="product">
    <img src="images/farasan-islands.webp" alt="Farasan Islands" />
    <h3>Farasan Islands</h3>
    <p>A stunning archipelago in the Red Sea known for its clear waters, coral reefs, and marine biodiversity.</p>
    <span class="price">Free</span>
  </div>

  <div class="product">
    <img src="images/edge-of-the-world.webp" alt="Edge of the World" />
    <h3>Edge of the World</h3>
    <p>A spectacular cliff outside Riyadh offering panoramic views of an endless desert horizon.</p>
    <span class="price">Free</span>
  </div>

  <div class="product">
    <img src="images/jeddah-corniche.webp" alt="Jeddah Corniche" />
    <h3>Jeddah Waterfront</h3>
    <p>A modern promenade along the Red Sea featuring sculptures, parks, and views of the sea at sunset.</p>
    <span class="price">Free</span>
  </div>

  <div class="product">
    <img src="images/najran-fortress.webp" alt="Najran Fortress" />
    <h3>Najran Fortress</h3>
    <p>A historic mud-brick castle showcasing the architectural charm and heritage of southern Saudi Arabia.</p>
    <span class="price">Free</span>
  </div>

  <div class="product">
    <img src="images/taif-roses.webp" alt="Taif Roses" />
    <h3>Taif Rose Gardens</h3>
    <p>Famous for its fragrant roses and rosewater distilleries, Taif blooms with beauty in springtime.</p>
    <span class="price">Free</span>
  </div>

  <div class="product">
    <img src="images/hijaz-railway.webp" alt="Hijaz Railway" />
    <h3>Hijaz Railway Museum</h3>
    <p>An old Ottoman-era station turned museum that tells the story of Arabia’s historic train route.</p>
    <span class="price">Free</span>
  </div>
</div>

</main>

<footer>
  <h1>Tourist Areas in KSA</h1>
  <p>Explore the best places Saudi Arabia has to offer</p>
</footer>

</body>
</html>
