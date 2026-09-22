<?php
session_start();
include("connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flower Shop</title>
    <link rel="stylesheet" href="/edaproject.css">
</head>
<body>
    <header>
        <h1>Welcome to Our Flower Shop</h1>
    </header>
    <nav>
        <ul>
            <li><a href="#home">Home</a></li>
            <li><a href="#shop">Shop</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
        </ul>
    </nav>
    <main id="home">
        <h2>Home</h2>
        <p>Discover our beautiful flowers and plants!</p>
        <div class="flower-gallery">
            <img src="/flowerbouqet1.jpg" alt="Flower 1" class="flower-image">
            <img src="/daisy.jpg" alt="Flower 2" class="flower-image">
            <img src="/roses.jpeg" alt="Flower 3" class="flower-image">
            <img src="/tulips.jpg" alt="Flower 3" class="flower-image">
        </div>

    </main>
    <section id="shop">
        <h2>Shop</h2>
        <div id="flower-list">
            <div class="flower-item">
                <img src="/flowerbouqet1.jpg" alt="Flower 1" class="flower-image">
                <p>Price: $25.00</p>
                <p class="description">A vibrant bouquet of mixed flowers.</p>
            </div>
            <div class="flower-item">
                <img src="/daisy.jpg" alt="Flower 2" class="flower-image">
                <p>Price: $15.00</p>
                <p class="description">Simple and elegant white daisies.</p>
            </div>
            <div class="flower-item">
                <img src="/roses.jpeg" alt="Flower 3" class="flower-image">
                <p>Price: $30.00</p>
                <p class="description">Classic red roses with a romantic touch.</p>
            </div>
            <div class="flower-item">
                <img src="/tulips.jpg" alt="Flower 4" class="flower-image">
                <p>Price: $20.00</p>
                <p class="description">Delicate pink tulips perfect for any occasion.</p>
            </div>
        </div>
    </section>
    <script src="script.js"></script>
</body>
</html>
