<?php
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
            session_start();
            $_SESSION["user"] = [
                "id" => $user["id"],
                "full_name" => $user["full_name"],
                "email" => $user["email"],
                "mailing_address" => $user["mailing_address"],
                "phone_number" => $user["phone_number"]
            ];
            echo json_encode(["message" => "Login successful", "user" => $_SESSION["user"]]);
        } else {
            echo json_encode(["message" => "Invalid credentials"]);
        }
    } else {
        echo json_encode(["message" => "User not found"]);
    }
}

$conn->close();
?>
