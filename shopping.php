<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping</title>
    <script defer src="script.js"></script>
    <link rel="stylesheet" href="mainstyles.css">
</head>
<body>
    <header>
        <nav>
            <div class="left-item"> 
                <img src="images/logo3.png" alt="Behind The Counter" width="250" height="150">
            </div>
            <div class="center-items">
                <a href="page.php">Home</a>
                <a href="about.php">About Us</a>
                <a href="shopping.php">Shopping</a>
                <a href="delivery.php">Delivery</a>
                <a href="cart.php">
                    <div class="icon-cart">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
                        </svg>
                        <span id="cart-count">0</span>
                    </div>
                </a>

                <?php if (isset($_SESSION['user'])): ?>
                    <a href="logout.php">Log Out</a>
                <?php else: ?>
                    <a href="signup.html">Sign Up</a>
                    <a href="signin.html">Sign In</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <h1>Product List</h1>
    
    <main>
        <h2>Product List</h2>
        <div class="listProduct">
            <div class="item">
                <img src="images/blender.jpg" alt="Blender">
                <h2>Blender</h2>
                <div class="price">$40</div>
                <button class="addToCart" data-name="Blender" data-price="40">Add to cart</button>
            </div>
            <div class="item">
                <img src="images/toaster.png" alt="Toaster">
                <h2>Toaster</h2>
                <div class="price">$60</div>
                <button class="addToCart" data-name="Toaster" data-price="60">Add to cart</button>
            </div>
            <div class="item">
                <img src="images/coffee.png" alt="Coffee">
                <h2>Coffee</h2>
                <div class="price">$50</div>
                <button class="addToCart" data-name="Coffee" data-price="50">Add to cart</button>
            </div>
            <div class="item">
                <img src="images/knife.png" alt="Knife">
                <h2>Knife</h2>
                <div class="price">$20</div>
                <button class="addToCart" data-name="Knife" data-price="20">Add to cart</button>
            </div>
        </div>
    </main>
</body>
</html>