<?php
session_start();
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header('Location: products.php');
    exit();
}

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

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Handle file upload
        $target_dir = "assets/images/products/";
        $image_url = "";
        
        if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            
            // Check if image file is actual image
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false) {
                // Check file size (5MB max)
                if ($_FILES["image"]["size"] <= 5000000) {
                    // Allow certain file formats
                    if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg") {
                        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                            $image_url = $target_file;
                        }
                    }
                }
            }
        }

        // Prepare SQL and bind parameters
        $stmt = $conn->prepare("INSERT INTO products (name, description, price, stock, image_url, status) 
                               VALUES (:name, :description, :price, :stock, :image_url, :status)");
        
        $stmt->bindParam(':name', $_POST['name']);
        $stmt->bindParam(':description', $_POST['description']);
        $stmt->bindParam(':price', $_POST['price']);
        $stmt->bindParam(':stock', $_POST['stock']);
        $stmt->bindParam(':image_url', $image_url);
        $stmt->bindParam(':status', $_POST['status']);
        
        $stmt->execute();
        
        $message = "Product added successfully!";
        header("Location: products.php");
        exit();
    } catch(PDOException $e) {
        $message = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Eco Cycle - Add New Product</title>
    <meta name="description" content="Eco Cycle - Add new eco-friendly product">
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
        .add-product-section {
            padding: 80px 0;
        }
        .form-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 30px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
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
        }
        .btn-submit:hover {
            background-color: #1733a9;
        }
        .alert {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <!-- Header Area -->
    <?php include 'header.php'; ?>

    <!-- Add Product Section -->
    <section class="add-product-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h1>Add New Product</h1>
                        <p>Add a new eco-friendly product to your inventory</p>
                    </div>
                    
                    <?php if($message): ?>
                    <div class="alert alert-info"><?php echo $message; ?></div>
                    <?php endif; ?>

                    <div class="form-container">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="form-label" for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" required placeholder="Name">
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="4" required placeholder="Description"><?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''; ?></textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="price">Price</label>
                                <input type="number" name="price" id="price" class="form-control" step="0.01" min="0" value="<?php echo isset($_POST['price']) ? htmlspecialchars($_POST['price']) : ''; ?>" required placeholder="Price">
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="stock">Stock</label>
                                <input type="number" name="stock" id="stock" class="form-control" min="0" value="<?php echo isset($_POST['stock']) ? htmlspecialchars($_POST['stock']) : ''; ?>" required placeholder="Stock">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Product Image</label>
                                <input type="file" name="image" class="form-control" accept="image/*" required>
                                <small class="text-muted">Max file size: 5MB. Allowed formats: JPG, JPEG, PNG</small>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="btn-submit">Add Product</button>
                            </div>
                        </form>
                    </div>
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