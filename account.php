<?php
session_start();
?>
<!DOCTYPE HTML>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Eco Cycle - Account</title>
    <meta name="description" content="Eco Cycle - View and manage your account information">
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
        .account-section {
            padding: 80px 0;
        }
        .account-card {
            background: #fff;
            border-radius: 10px;
            padding: 30px;
            margin: 0 auto;
            max-width: 500px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        .account-title {
            margin-bottom: 20px;
        }
        .account-info {
            font-size: 1.1rem;
            color: #333;
        }
    </style>
</head>

<body>
    <!-- Header Area -->
    <?php include 'header.php'; ?>

    <!-- Account Section -->
    <section class="account-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title center">
                        <h1>Account</h1>
                        <p>View and manage your account information</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="account-card">
                        <h3 class="account-title">Account Details</h3>
                        <?php
                        if(isset($_SESSION['email'])) {
                            echo '<div class="account-info">';
                            echo '<strong>Name:</strong> ' . htmlspecialchars($_SESSION['fName']) . '<br>';
                            echo '<strong>Email:</strong> ' . htmlspecialchars($_SESSION['email']) . '<br>';
                            // Add more account info here if available
                            echo '</div>';
                        } else {
                            echo '<div class="account-info">Please log in to view your account details.<br><a href="index.php" class="btn btn-primary mt-3">Login</a></div>';
                        }
                        ?>
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