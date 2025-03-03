<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user["password"])) {
            $_SESSION["user"] = [
                "id" => $user["id"],
                "full_name" => $user["full_name"],
                "email" => $user["email"],
                "mailing_address" => $user["mailing_address"],
                "phone_number" => $user["phone_number"]
            ];
            header("Location: dashboard.php");
            exit();
        } else {
            // Redirect with error message
            header("Location: signin.html?error=invalid");
            exit();
        }
    } else {
        // Redirect with error message
        header("Location: signin.html?error=invalid");
        exit();
    }
}

$conn->close();
?>
