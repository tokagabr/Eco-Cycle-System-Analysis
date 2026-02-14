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
}

$product = null;
$message = '';

// Get product details if product_id is provided
if (isset($_GET['product_id'])) {
    try {
        $stmt = $conn->prepare("SELECT * FROM products WHERE id = :id AND status = 'active'");
        $stmt->bindParam(':id', $_GET['product_id']);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$product) {
            header("Location: products.php");
            exit();
        }
    } catch(PDOException $e) {
        $message = "Error: " . $e->getMessage();
    }
} else {
    header("Location: products.php");
    exit();
}

// Handle order submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Validate quantity
        $quantity = intval($_POST['quantity']);
        if ($quantity <= 0 || $quantity > $product['stock']) {
            throw new Exception("Invalid quantity selected.");
        }

        // Calculate total price
        $total_price = $quantity * $product['price'];

        // Insert order into database
        $stmt = $conn->prepare("INSERT INTO orders (product_id, quantity, total_price, customer_name, email, phone, address, status, created_at) 
                               VALUES (:product_id, :quantity, :total_price, :customer_name, :email, :phone, :address, 'pending', NOW())");
        
        $stmt->bindParam(':product_id', $product['id']);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':total_price', $total_price);
        $stmt->bindParam(':customer_name', $_POST['customer_name']);
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':phone', $_POST['phone']);
        $stmt->bindParam(':address', $_POST['address']);
        
        $stmt->execute();

        // Update product stock
        $new_stock = $product['stock'] - $quantity;
        $stmt = $conn->prepare("UPDATE products SET stock = :stock WHERE id = :id");
        $stmt->bindParam(':stock', $new_stock);
        $stmt->bindParam(':id', $product['id']);
        $stmt->execute();

        $message = "Order placed successfully!";
        header("Location: order_confirmation.php?order_id=" . $conn->lastInsertId());
        exit();
    } catch(Exception $e) {
        $message = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE HTML>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Eco Cycle - Place Order</title>
    <meta name="description" content="Eco Cycle - Place your order for eco-friendly products">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/fav-icon/logo.png">
    <!-- bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css" media="all">
    <!-- font-awesome CSS -->
    <link rel="stylesheet" href="assets/css/all.min.css" type="text/css" media="all">
    <!-- theme-default CSS -->
    <link rel="stylesheet" href="assets/css/theme-default.css" type="text/css" media="all">
    <!-- meanmenu CSS -->
    <link rel="stylesheet" href="assets/css/meanmenu.min.css" type="text/css" media="all">
    <!-- bootstrap icons -->
    <link rel="stylesheet" href="assets/css/bootstrap-icons.css" type="text/css" media="all">
    <!-- Style CSS -->
    <link rel="stylesheet" href="assets/css/home.css" type="text/css" media="all">
    <!-- responsive CSS -->
    <link rel="stylesheet" href="assets/css/responsive.css" type="text/css" media="all">
    <style>
        .order-section {
            padding: 80px 0;
        }
        .order-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 30px;
        }
        .product-summary {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            padding: 20px;
            margin-bottom: 30px;
        }
        .product-image {
            width: 150px;
            height: 150px;
            object-fit: contain;
            margin-bottom: 15px;
        }
        .order-form {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            padding: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-label {
            font-weight: 600;
            margin-bottom: 8px;
        }
        .form-control {
            border-radius: 5px;
            padding: 10px 15px;
        }
        .btn-submit {
            background-color: #1d42d9;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            width: 100%;
        }
        .btn-submit:hover {
            background-color: #1733a9;
        }
        .alert {
            margin-bottom: 20px;
        }
        .product-details {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .product-info {
            flex: 1;
        }
        .product-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 10px;
        }
        .product-price {
            font-size: 1.2rem;
            color: #1d42d9;
            font-weight: 600;
        }
        .product-stock {
            color: #28a745;
            margin-top: 5px;
        }
        @media (max-width: 768px) {
            .product-details {
                flex-direction: column;
                text-align: center;
            }
            .product-image {
                margin: 0 auto 15px;
            }
        }
    </style>
</head>

<body>
    <!-- Header Area -->
    <?php include 'header.php'; ?>

    <!-- Order Section -->
    <section class="order-section">
        <div class="container">
            <div class="order-container">
                <div class="section-title text-center">
                    <h1>Place Your Order</h1>
                    <p>Complete your order for eco-friendly products</p>
                </div>

                <?php if($message): ?>
                <div class="alert alert-info"><?php echo $message; ?></div>
                <?php endif; ?>

                <div class="product-summary">
                    <div class="product-details">
                        <img src="/<?php echo htmlspecialchars($product['image_url']); ?>" 
                             alt="<?php echo htmlspecialchars($product['name']); ?>" 
                             class="product-image"
                             onerror="this.src='/assets/images/products/placeholder.png'">
                        <div class="product-info">
                            <div class="product-title"><?php echo htmlspecialchars($product['name']); ?></div>
                            <div class="product-desc"><?php echo htmlspecialchars($product['description']); ?></div>
                            <div class="product-price">$<?php echo number_format($product['price'], 2); ?></div>
                            <div class="product-stock">Available Stock: <?php echo $product['stock']; ?> units</div>
                        </div>
                    </div>
                </div>

                <div class="order-form">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?product_id=" . $_GET['product_id']); ?>" method="POST">
                        <div class="form-group">
                            <label class="form-label">Quantity</label>
                            <input type="number" name="quantity" class="form-control" min="1" max="<?php echo $product['stock']; ?>" value="1" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="customer_name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Phone Number</label>
                            <input type="tel" name="phone" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Delivery Address</label>
                            <textarea name="address" class="form-control" rows="3" required></textarea>
                        </div>

                        <button type="submit" class="btn-submit">Place Order</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Area -->
    <?php if (file_exists('footer.php')) include 'footer.php'; ?>

    <!-- Scripts -->
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/meanmenu.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html> 