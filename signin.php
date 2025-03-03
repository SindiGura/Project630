<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Use a prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify hashed password
        if (password_verify($password, $user["passcode"])) {
            $_SESSION["user"] = [
                "name" => $user["name"],
                "email" => $user["email"],
                "tel" => $user["tel"],
                "address" => $user["address"],
                "city_code" => $user["city_code"],
                "login_id" => $user["login_id"]
            ];

            // Redirect to dashboard after successful login
            header("Location: shopping.php");
            exit();
        } else {
            // Incorrect password, redirect with error
            header("Location: signin.html?error=invalid");
            exit();
        }
    } else {
        // No user found, redirect with error
        header("Location: signin.html?error=invalid");
        exit();
    }

    $stmt->close();
}

$conn->close();
?>