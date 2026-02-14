<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eco_cycle";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

if (isset($_GET['id'])) {
    try {
        // First get the product to get its image path
        $stmt = $conn->prepare("SELECT image_url FROM products WHERE id = :id");
        $stmt->bindParam(':id', $_GET['id']);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        // Delete the product
        $stmt = $conn->prepare("DELETE FROM products WHERE id = :id");
        $stmt->bindParam(':id', $_GET['id']);
        $stmt->execute();

        // If product was found and had an image, try to delete the image file
        if ($product && $product['image_url'] && file_exists($product['image_url'])) {
            unlink($product['image_url']);
        }

        header("Location: products.php");
        exit();
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    header("Location: products.php");
    exit();
}
?> 