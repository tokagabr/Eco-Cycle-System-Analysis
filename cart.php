<?php
session_start();
if (isset($_GET['remove']) && isset($_SESSION['cart'][$_GET['remove']])) {
    unset($_SESSION['cart'][$_GET['remove']]);
    // Re-index the array to avoid gaps in keys
    $_SESSION['cart'] = array_values($_SESSION['cart']);
    header('Location: cart.php');
    exit();
}
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = 0;
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Your Cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <style>
        .cart-section { padding: 40px 0; }
        .cart-card { background: #fff; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); padding: 30px; max-width: 700px; margin: 0 auto; }
        .cart-title { font-size: 2rem; font-weight: 600; margin-bottom: 20px; }
        .cart-table { width: 100%; margin-bottom: 20px; }
        .cart-table th, .cart-table td { padding: 10px; text-align: left; }
        .cart-table th { background: #f8f8f8; }
        .cart-total { font-size: 1.2rem; font-weight: bold; text-align: right; margin-top: 10px; }
        .empty-cart { text-align: center; color: #888; padding: 40px 0; }
        .btn-checkout { background: #1d42d9; color: #fff; border: none; border-radius: 6px; padding: 12px 30px; font-size: 1.1rem; font-weight: 500; margin-top: 20px; display: block; width: 100%; }
        .btn-checkout:hover { background: #1733a9; }
        .remove-btn { color: #fff; background: #ff4444; border: none; border-radius: 4px; padding: 6px 12px; font-size: 0.95em; cursor: pointer; transition: background 0.2s; margin-left: 8px; }
        .remove-btn:hover { background: #c82333; }
        @media (max-width: 600px) { .cart-card { padding: 10px; } .cart-title { font-size: 1.2rem; } }
    </style>
</head>
<body>
<?php include 'header.php'; ?>
<section class="cart-section">
    <div class="cart-card">
        <div class="cart-title">Your Cart</div>
        <?php if (empty($cart)): ?>
            <div class="empty-cart">Your cart is empty.</div>
        <?php else: ?>
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart as $i => $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['name']); ?></td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td>EGP <?php echo $item['price']; ?></td>
                            <td>EGP <?php echo $item['price'] * $item['quantity']; $total += $item['price'] * $item['quantity']; ?></td>
                            <td>
                                <a href="cart.php?remove=<?php echo $i; ?>" class="remove-btn" onclick="return confirm('Remove this item from cart?');">
                                    <i class="fas fa-trash-alt"></i> Remove
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="cart-total">Total: EGP <?php echo $total; ?></div>
            <a href="orderform.html" class="btn-checkout">Proceed to Checkout</a>
        <?php endif; ?>
    </div>
</section>
<?php if (file_exists('footer.php')) include 'footer.php'; ?>
<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html> 