<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flower Shop</title>
     <style>
        /* Shop Section Styles */
        #shop {
            margin: 20px;
            font-family: Arial, sans-serif;
        }

        #flower-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .flower-item {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            transition: transform 0.3s;
        }

        .flower-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .flower-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
        }

        .flower-item p {
            margin: 10px 0;
        }

        .add-to-wishlist-btn {
            background-color:rgb(119, 152, 120);
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        /* New Styles for Favorite Button */
        .favorite-btn {
            background: none;
            border: none;
            font-size: 24px; /* Make the heart visible */
            cursor: pointer;
            color: #ccc; /* Default grey for not favorited */
            margin-left: 10px; /* Space it out from the wishlist button */
            vertical-align: middle;
            transition: color 0.2s ease-in-out; /* Smooth color change */
        }

        .favorite-btn.favorited {
            color: #ff0000; /* Red when favorited */
        }

        .add-to-wishlist-btn:hover {
            background-color: #45a049;
        }

        /* Wishlist Section Styles */
        #flower-wishlist {
            margin: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            font-family: Arial, sans-serif;
        }

        .wishlist-items h3 {
            color: #333;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }

        #flowerWishlist {
            list-style: none;
            padding: 0;
        }

        .wishlist-item {
            background: white;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
        }

        .wishlist-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
            margin-right: 15px;
        }

        .remove-btn {
            background:rgba(183, 63, 194, 0.67);
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            margin-left: auto;
        }

        #clearWishlistBtn {
            background: #555;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 15px;
        }
        .confirmation {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: #4CAF50;
            color: white;
            padding: 12px 24px;
            border-radius: 4px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            opacity: 0;
            transition: opacity 0.3s;
            z-index: 1000;
        }

        
        footer {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            padding: 25px 0;
            text-align: center;
            margin-top: 40px;
            border-top: 1px solid rgba(255, 255, 255, 0.3);
            position: relative;
            overflow: hidden;
            font-family: 'Comic Sans MS', cursive, sans-serif;
        }

        footer p {
            color: #e75480; Soft pink
            font-size: 16px;
            margin: 0;
            position: relative;
            z-index: 2;
            text-shadow: 1px 1px 1px rgba(255, 255, 255, 0.8);
        }
        .footer-ln {
            border: 1px solid #e75480; /* Soft pink */
            
        }
        /* Add this to your CSS file */
header {
    /* Your existing styles */
    background-color: rgba(202, 139, 149, 0.8);
    color: white;
    padding: 20px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    
    /* New transition properties */
    transition: all 0.5s ease-in-out;
    transform-origin: top;
}

header:hover {
    animation: headerBounce 0.8s ease;
    background-color: rgba(202, 139, 149, 0.95); /* Slightly more opaque on hover */
}

@keyframes headerBounce {
    0%, 100% {
        transform: scale(1);
    }
    30% {
        transform: scale(1.02) translateY(-3px);
    }
    70% {
        transform: scale(0.98) translateY(2px);
    }
}

header h1 {
    transition: all 0.3s ease;
    display: inline-block;
}

header:hover h1 {
    animation: textWiggle 0.5s ease;
    text-shadow: 0 0 8px rgba(255, 255, 255, 0.5);
}

@keyframes textWiggle {
    0%, 100% {
        transform: rotate(0deg);
    }
    25% {
        transform: rotate(-1deg);
    }
    75% {
        transform: rotate(1deg);
    }
    
}
/* Add these to your existing CSS */
nav ul {
    /* Your existing styles */
    background-color: rgba(131, 96, 113, 0.8);
    list-style: none;
    padding: 10px 0;
    text-align: center;
    margin: 0;
    box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    
    /* New transition */
    transition: all 0.4s ease-out;
}

nav ul:hover {
    background-color: rgba(131, 96, 113, 0.95);
    box-shadow: 0 4px 12px rgba(0,0,0,0.25);
}

nav ul li {
    display: inline;
    margin: 0 15px;
    position: relative;
    transition: transform 0.3s ease;
}

nav ul li:hover {
    transform: translateY(-2px);
}

nav ul li a {
    /* Your existing styles */
    color: white;
    text-decoration: none;
    padding: 10px 20px;
    display: inline-block;
    font-weight: bold;
    border-radius: 5px;
    transition: all 0.3s ease;
    
    /* New effects */
    position: relative;
    z-index: 1;
}

nav ul li a::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 20, 147, 0.8);
    border-radius: 5px;
    z-index: -1;
    transform: scaleX(0);
    transform-origin: right;
    transition: transform 0.4s cubic-bezier(0.65, 0, 0.35, 1);
}

nav ul li a:hover::before {
    transform: scaleX(1);
    transform-origin: left;
}

nav ul li a:hover {
    color: white;
    text-shadow: 0 0 5px rgba(255,255,255,0.5);
}

/* Flower petal decoration */
nav ul li::after {
    content: '🌸';
    position: absolute;
    top: -15px;
    left: 50%;
    transform: translateX(-50%) scale(0);
    transition: all 0.3s ease;
    opacity: 0;
}

nav ul li:hover::after {
    opacity: 1;
    transform: translateX(-50%) scale(1) rotate(15deg);
    animation: petalFall 1.5s ease-in-out infinite;
}

@keyframes petalFall {
    0%, 100% {
        transform: translateX(-50%) translateY(0) rotate(15deg);
    }
    50% {
        transform: translateX(-50%) translateY(8px) rotate(25deg);
    }
}
    </style> 

    </style> 
    <link rel="stylesheet" href="/flower_shop/edaproject.css">
</head>
<body>
    <header>
        <h1>Welcome to Our Flower Shop</h1>
    </header>
    <nav>
        <ul>
            <li><a href="/flower_shop/index.php">Home</a></li>
            <li><a href="#shop">Shop</a></li>
            <li><a href="./login/login.php">Login</a></li>
            <li><a href="./login/register.php">Register</a></li>
            <?php if (isset($_SESSION['email'])): ?>
                <li><a href="./login/logout.php">Logout</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <main id="home">
        <h2>Home</h2>
        <p>Discover our beautiful flowers and plants!</p>
        <div class="flower-gallery"></div>
    </main>

    <section id="shop">
        <h2>Shop</h2>
        <div id="flower-list"></div>
    </section>

    <section id="flower-wishlist">
        <h2>Your Flower Wishlist</h2>
        <div class="wishlist-items">
            <h3>My Saved Flowers:</h3>
            <ul id="flowerWishlist"></ul>
            <button id="clearWishlistBtn">Clear Wishlist</button>
        </div>
    </section>
    <section id="rate-us-section" style="margin: 20px; font-family: Arial, sans-serif;">
    <h2>Rate Us</h2>
    <div id="star-rating" style="font-size: 30px; cursor: pointer;">
        <span data-value="1">&#9734;</span>
        <span data-value="2">&#9734;</span>
        <span data-value="3">&#9734;</span>
        <span data-value="4">&#9734;</span>
        <span data-value="5">&#9734;</span>
    </div>
    <p id="current-rating" style="margin-top: 10px; font-size: 18px; color: #555;"></p>

    <!-- <hr class="footer-ln"> -->

    <footer>
        <p>&copy; 2024 Flower Shop. All rights reserved.</p>
        <p>Created with <span style="color: #e75480;">&#x2764;</span> by Eda </p>
    </footer>

</section>
   <script>
     const stars = document.querySelectorAll('#star-rating span');
  const ratingDisplay = document.getElementById('current-rating');
  let currentRating = 0;

  stars.forEach(star => {
    star.addEventListener('click', () => {
      currentRating = parseInt(star.getAttribute('data-value'));
      updateStars(currentRating);
      ratingDisplay.textContent = `You rated us ${currentRating} star${currentRating > 1 ? 's' : ''}.`;
    });

    star.addEventListener('mouseover', () => {
      const hoverValue = parseInt(star.getAttribute('data-value'));
      updateStars(hoverValue);
    });

    star.addEventListener('mouseout', () => {
      updateStars(currentRating);
    });
  });

  function updateStars(rating) {
    stars.forEach(star => {
      const value = parseInt(star.getAttribute('data-value'));
      star.innerHTML = value <= rating ? '&#9733;' : '&#9734;';
      
    });
  }
   </script>

    <script src="login/script.js"></script>
</body>
</html>