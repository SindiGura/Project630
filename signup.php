<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $mailing_address = $_POST["mailing_address"];
    $phone_number = $_POST["phone_number"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Secure password

    $sql = "INSERT INTO users (full_name, email, mailing_address, phone_number, password) 
            VALUES ('$full_name', '$email', '$mailing_address', '$phone_number', '$password')";

if ($conn->query($sql) === TRUE) {
    header("Location: signin.html?signup=success");
    exit();
}
else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
