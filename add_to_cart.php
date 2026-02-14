<?php
session_start();
if (!isset($_POST['product_id'])) {
    header('Location: products.php');
    exit();
}
$product_id = intval($_POST['product_id']);
$quantity = isset($_POST['quantity']) ? max(1, intval($_POST['quantity'])) : 1;

// Connect to DB
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eco_cycle";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = :id AND status = 'active'");
    $stmt->bindParam(':id', $product_id);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($product) {
        $cart_item = [
            'id' => $product['id'],
            'name' => $product['name'],
            'price' => $product['price'],
            'quantity' => $quantity
        ];
        if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
        // Check if already in cart
        $found = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] == $product['id']) {
                $item['quantity'] += $quantity;
                $found = true;
                break;
            }
        }
        if (!$found) {
            $_SESSION['cart'][] = $cart_item;
        }
        // AJAX response
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
            header('Content-Type: application/json');
            echo json_encode(['success' => true]);
            exit();
        }
    }
} catch (PDOException $e) {
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
        header('Content-Type: application/json');
        echo json_encode(['success' => false]);
        exit();
    }
}
header('Location: products.php');
exit(); 