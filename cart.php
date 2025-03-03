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
        <br><br><br><br><h1>Your Cart</h1>
    </header>
    
    <main>
        <div>
            <table id="cart-table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="cart-items">
                    <!-- Cart items will appear here -->
                </tbody>
            </table>

            <button id="checkout" class="btn btn-success" disabled>Proceed to Checkout</button>
        </div>
    </main>

    <script>
        // Function to load items from the cart
        function loadCart() {
            const cart = JSON.parse(localStorage.getItem("cart")) || [];
            const cartContainer = document.getElementById("cart-items");
            const cartCount = document.getElementById("cart-count");

            // If the cart is empty, show a message
            if (cart.length === 0) {
                cartContainer.innerHTML = "<tr><td colspan='5'>Your cart is empty.</td></tr>";
                document.getElementById("checkout").disabled = true; // Disable checkout if the cart is empty
                cartCount.textContent = 0;
                return;
            }

            // Clear any previous content
            cartContainer.innerHTML = "";

            // Display all items in the cart
            cart.forEach((item, index) => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${item.name}</td>
                    <td>${item.quantity}</td>
                    <td>$${item.price}</td>
                    <td>$${(item.price * item.quantity).toFixed(2)}</td>
                    <td><button class="remove-btn" onclick="removeItem(${index})">Remove</button></td>
                `;
                cartContainer.appendChild(row);
            });

            // Update cart count
            const totalItems = cart.reduce((acc, item) => acc + item.quantity, 0);
            cartCount.textContent = totalItems;

            // Enable checkout if the cart has items
            document.getElementById("checkout").disabled = false;
        }

        // Function to remove an item from the cart
        function removeItem(index) {
            let cart = JSON.parse(localStorage.getItem("cart")) || [];
            cart.splice(index, 1); // Remove the item at the given index
            localStorage.setItem("cart", JSON.stringify(cart));
            loadCart(); // Reload the cart after item is removed
        }

        // Checkout button handler
        document.getElementById("checkout").addEventListener("click", function() {
            window.location.href = "payments.php";
        });

        // Load the cart when the page loads
        loadCart();
    </script>
</body>
</html>
