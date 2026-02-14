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

$order = null;
$product = null;

if (isset($_GET['order_id'])) {
    try {
        // Get order details
        $stmt = $conn->prepare("SELECT o.*, p.name as product_name, p.image_url 
                               FROM orders o 
                               JOIN products p ON o.product_id = p.id 
                               WHERE o.id = :order_id");
        $stmt->bindParam(':order_id', $_GET['order_id']);
        $stmt->execute();
        $order = $stmt->fetch();
        
        if (!$order) {
            header("Location: products.php");
            exit();
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    header("Location: products.php");
    exit();
}
?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Eco Cycle - Order Confirmation</title>
    <meta name="description" content="Eco Cycle - Your order has been confirmed">
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
        .confirmation-section {
            padding: 80px 0;
        }
        .confirmation-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 30px;
        }
        .confirmation-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            padding: 30px;
            text-align: center;
        }
        .success-icon {
            color: #28a745;
            font-size: 4rem;
            margin-bottom: 20px;
        }
        .order-details {
            margin-top: 30px;
            text-align: left;
        }
        .detail-row {
            display: flex;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        .detail-label {
            font-weight: 600;
            width: 150px;
            color: #666;
        }
        .detail-value {
            flex: 1;
            color: #333;
        }
        .btn-continue {
            background-color: #1d42d9;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
            font-weight: 600;
        }
        .btn-continue:hover {
            background-color: #1733a9;
            color: white;
        }
        .product-image {
            width: 100px;
            height: 100px;
            object-fit: contain;
            margin: 0 auto 20px;
        }
        @media (max-width: 768px) {
            .detail-row {
                flex-direction: column;
            }
            .detail-label {
                width: 100%;
                margin-bottom: 5px;
            }
        }
    </style>
</head>

<body>
    <!-- Header Area -->
    <?php include 'header.php'; ?>

    <!-- Confirmation Section -->
    <section class="confirmation-section">
        <div class="container">
            <div class="confirmation-container">
                <div class="confirmation-card">
                    <i class="fas fa-check-circle success-icon"></i>
                    <h1>Order Confirmed!</h1>
                    <p>Thank you for your order. Your order has been successfully placed.</p>
                    
                    <img src="<?php echo htmlspecialchars($order['image_url']); ?>" 
                         alt="<?php echo htmlspecialchars($order['product_name']); ?>" 
                         class="product-image"
                         onerror="this.src='assets/images/products/placeholder.png'">

                    <div class="order-details">
                        <div class="detail-row">
                            <div class="detail-label">Order ID:</div>
                            <div class="detail-value">#<?php echo str_pad($order['id'], 8, '0', STR_PAD_LEFT); ?></div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label">Product:</div>
                            <div class="detail-value"><?php echo htmlspecialchars($order['product_name']); ?></div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label">Quantity:</div>
                            <div class="detail-value"><?php echo $order['quantity']; ?> units</div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label">Total Amount:</div>
                            <div class="detail-value">$<?php echo number_format($order['total_price'], 2); ?></div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label">Customer Name:</div>
                            <div class="detail-value"><?php echo htmlspecialchars($order['customer_name']); ?></div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label">Email:</div>
                            <div class="detail-value"><?php echo htmlspecialchars($order['email']); ?></div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label">Phone:</div>
                            <div class="detail-value"><?php echo htmlspecialchars($order['phone']); ?></div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label">Delivery Address:</div>
                            <div class="detail-value"><?php echo htmlspecialchars($order['address']); ?></div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label">Order Date:</div>
                            <div class="detail-value"><?php echo date('F j, Y, g:i a', strtotime($order['created_at'])); ?></div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label">Status:</div>
                            <div class="detail-value">
                                <span class="badge bg-primary"><?php echo ucfirst($order['status']); ?></span>
                            </div>
                        </div>
                    </div>

                    <a href="products.php" class="btn-continue">Continue Shopping</a>
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