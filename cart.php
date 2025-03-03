<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
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
    </header><br><br>
     <div><br>
    <h1>Your Cart</h1>
    <div id="cart-items"></div>
    <button id="checkout" class="btn btn-success">Proceed to Checkout</button>
</div>
    <script>
        function loadCart() {
            const cart = JSON.parse(localStorage.getItem("cart")) || [];
            const cartContainer = document.getElementById("cart-items");

            if (cart.length === 0) {
                cartContainer.innerHTML = "<p>Your cart is empty.</p>";
                return;
            }

            cartContainer.innerHTML = "";
            cart.forEach((item, index) => {
                const itemElement = document.createElement("div");
                itemElement.innerHTML = `<p>${item.name} - $${item.price} 
                    <button onclick="removeItem(${index})">Remove</button></p>`;
                cartContainer.appendChild(itemElement);
            });
        }

        function removeItem(index) {
            let cart = JSON.parse(localStorage.getItem("cart")) || [];
            cart.splice(index, 1); // Remove item at given index
            localStorage.setItem("cart", JSON.stringify(cart));
            loadCart(); // Reload the cart
        }

        document.getElementById("checkout").addEventListener("click", function() {
            alert("Proceeding to checkout! (Feature can be added later)");
        });

        loadCart();
    </script>
</body>
</html>
