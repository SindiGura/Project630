<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
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
    <br><br><br><br><h1>Payment</h1>
</header>

<main>
    <section class="payment-section">

        <div class="invoice-summary">
            <h3>Invoice Summary</h3><br>

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
            </div>

            <br><br>
            <p><strong>Delivery Fee:</strong> &nbsp; $25.00</p>
            <p><strong>Grand Total:</strong> &nbsp; <span id="grand-total">$0.00</span></p>
        </div>

        <div class="payment-form">
            <h3>Enter Your Payment Details</h3>

            <form id="payment-form" action="delivery.php" method="GET">
                <label for="card-holder-name">Cardholder Name:</label>
                <br>
                <input type="text" id="card-holder-name" name="card_holder_name" required>

                <label for="card-number">Card Number:</label>
                <br>
                <input type="text" id="card-number" name="card_number" placeholder="XXXX XXXX XXXX XXXX" required>

                <label for="expiry-date">Expiry Date:</label>
                <br>
                <input type="month" id="expiry-date" name="expiry_date" required>

                <label for="cvv">CVV:</label>
                <br>
                <input type="text" id="cvv" name="cvv" required>

                <label for="billing-address">Billing Address:</label>
                <br>
                <input type="text" id="billing-address" name="billing_address" placeholder="Enter your billing address" required>

                <button type="submit" class="submit-btn">Complete Payment</button>
            </form>
        </div>
    </section>
</main>

<script>
    // Function to load items from the cart
    function loadCart() {
        const cart = JSON.parse(localStorage.getItem("cart")) || [];
        const cartContainer = document.getElementById("cart-items");
        const cartCount = document.getElementById("cart-count");
        let grandTotal = 0;

        // If the cart is empty, show a message
        if (cart.length === 0) {
            cartContainer.innerHTML = "<tr><td colspan='5'>Your cart is empty.</td></tr>";
            cartCount.textContent = 0;
            document.getElementById("grand-total").textContent = "$0.00";
            return;
        }

        // Clear any previous content
        cartContainer.innerHTML = "";

        // Display all items in the cart
        cart.forEach((item, index) => {
            const itemTotal = item.price * item.quantity;
            grandTotal += itemTotal;

            const row = document.createElement("tr");
            row.innerHTML = ` 
                <td>${item.name}</td>
                <td>${item.quantity}</td>
                <td>$${item.price}</td>
                <td>$${itemTotal.toFixed(2)}</td>
                <td><button class="remove-btn" onclick="removeItem(${index})">Remove</button></td>
            `;
            cartContainer.appendChild(row);
        });

        // Update cart count
        const totalItems = cart.reduce((acc, item) => acc + item.quantity, 0);
        cartCount.textContent = totalItems;

        // Add delivery fee and update grand total
        const deliveryFee = 25.00;
        grandTotal += deliveryFee;
        document.getElementById("grand-total").textContent = "$" + grandTotal.toFixed(2);
    }

    // Function to remove an item from the cart
    function removeItem(index) {
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        cart.splice(index, 1); // Remove the item at the given index
        localStorage.setItem("cart", JSON.stringify(cart));
        loadCart(); // Reload the cart after item is removed
    }

    // Load the cart when the page loads
    loadCart();
</script>

</body>
</html>
