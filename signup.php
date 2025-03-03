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
    $full_name = $_POST["name"];
    $email = $_POST["email"];
    $tel = $_POST["tel"];
    $address = $_POST["address"];
    $city_code = $_POST["city_code"];
    $login_id = $_POST["login_id"];
    $passcode = $_POST["passcode"];  // Using plain password (not hashed)

    $sql = "INSERT INTO users (name, email, tel, address, city_code, login_id, passcode) 
            VALUES ('$full_name', '$email', '$tel', '$address', '$city_code', '$login_id', '$passcode')";

    if ($conn->query($sql) === TRUE) {
        header("Location: signin.html?signup=success");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
