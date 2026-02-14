<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = $_POST['name'] ?? '';
    $email   = $_POST['email'] ?? '';
    $address = $_POST['address'] ?? '';
    $phone   = $_POST['phone'] ?? '';
    $payment = $_POST['payment'] ?? '';
    $cart_items = isset($_SESSION['cart']) ? json_encode($_SESSION['cart']) : '';

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "eco_cycle";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("INSERT INTO order_details (name, email, address, phone, payment_method, cart_items) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $address, $phone, $payment, $cart_items]);

        // Clear the cart after order
        unset($_SESSION['cart']);

        // Redirect or show success
        header("Location: home.php");
        exit();
    } catch(PDOException $e) {
        // Handle error
        header("Location: orderform.html?error=1");
        exit();
    }
}
?>