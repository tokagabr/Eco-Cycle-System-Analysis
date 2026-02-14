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

// Function to get all products
function getAllProducts($conn) {
    try {
        $stmt = $conn->prepare("SELECT * FROM products WHERE status = 'active'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        return [];
    }
}

// Get products
$products = getAllProducts($conn);
?>
<!DOCTYPE HTML>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Eco Cycle - Eco Service</title>
    <meta name="description" content="Eco Cycle - A smart recycling initiative that rewards you for collecting plastic waste. Join us in creating a greener future!">
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

    <!--  Style CSS -->
    <link rel="stylesheet" href="assets/css/service.css" type="text/css" media="all">
    <link rel="stylesheet" href="assets/css/home.css" type="text/css" media="all">

    <!-- responsive CSS -->
    <link rel="stylesheet" href="assets/css/responsive.css" type="text/css" media="all">
    <style>
      .dropdown {
        position: relative;
        display: inline-block;
      }
      .dropdown-content {
        display: none;
        position: absolute;
        right: 0;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
        border-radius: 5px;
      }
      .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
      }
      .dropdown-content a:hover {
        background-color: #f1f1f1;
        border-radius: 5px;
      }
      .dropdown:hover .dropdown-content {
        display: block;
      }
      .user-name {
        color: #fff;
        cursor: pointer;
        padding: 10px 20px;
        background: #1d42d9;
        border-radius: 5px;
        text-decoration: none;
      }
      .user-name:hover {
        background: #1733a9;
      }
      /* Amazon-style product grid */
      .amazon-product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 32px;
        padding: 30px 0 10px 0;
      }
      .amazon-product-card {
        background: #fff;
        border: 1px solid #e3e3e3;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 18px 16px 16px 16px;
        transition: box-shadow 0.2s, transform 0.2s;
        min-height: 420px;
        position: relative;
      }
      .amazon-product-card:hover {
        box-shadow: 0 8px 24px rgba(0,0,0,0.16);
        transform: translateY(-4px) scale(1.02);
      }
      .amazon-product-image {
        width: 180px;
        height: 180px;
        object-fit: contain;
        margin-bottom: 14px;
        background: #fafafa;
        border-radius: 8px;
        border: 1px solid #eee;
        box-shadow: 0 1px 4px rgba(0,0,0,0.04);
      }
      .amazon-product-title {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 6px;
        color: #222;
        text-align: center;
        min-height: 48px;
      }
      .amazon-product-desc {
        font-size: 0.97rem;
        color: #555;
        margin-bottom: 10px;
        text-align: center;
        min-height: 40px;
      }
      .amazon-product-price {
        font-size: 1.3rem;
        font-weight: 700;
        color: #B12704;
        margin-bottom: 8px;
        text-align: center;
      }
      .amazon-product-stock {
        font-size: 0.97rem;
        color: #007600;
        margin-bottom: 12px;
        text-align: center;
      }
      .amazon-product-actions {
        display: flex;
        gap: 10px;
        width: 100%;
        margin-top: auto;
        justify-content: center;
      }
      .amazon-order-btn {
        background: linear-gradient(90deg,#57ff14 0%,#1fc901 100%);
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 10px 0;
        font-size: 1.05rem;
        font-weight: 600;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 50%;
        box-shadow: 0 2px 6px rgba(255,168,28,0.08);
        transition: background 0.2s, color 0.2s;
      }
      .amazon-order-btn:hover {
        background: linear-gradient(90deg,#57ff14 0%,#1fc901 100%);
        color: #111;
      }
      .amazon-cart-btn {
        background: linear-gradient(90deg,#1fc901 0%,#1fc901 100%);
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 10px 0;
        font-size: 1.05rem;
        font-weight: 600;
        text-decoration: none;
        display: block;
        width: 100%;
        box-shadow: 0 2px 6px rgba(96, 255, 28, 0.08);
        transition: background 0.2s, color 0.2s;
      }
      .amazon-cart-btn:hover {
        background: linear-gradient(90deg,#ff9900 0%,#ffa41c 100%);
        color: #fff;
      }
      .amazon-order-btn:disabled, .amazon-cart-btn:disabled {
        background: #eee;
        color: #aaa;
        cursor: not-allowed;
      }
      @media (max-width: 900px) {
        .amazon-product-grid {
          grid-template-columns: 1fr 1fr;
        }
      }
      @media (max-width: 600px) {
        .amazon-product-grid {
          grid-template-columns: 1fr;
        }
        .amazon-product-actions {
          flex-direction: column;
          gap: 8px;
        }
        .amazon-order-btn, .amazon-cart-btn {
          width: 100%;
        }
      }
    </style>
</head>

<body>
    <!-- Header Area -->
    <?php include 'header.php'; ?>


    <section class="hero-area home-three">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 text-center">
                    <div class="hero-content">
                        <h1>
                            Recycled Plastic for<br>
                            <a href="#" class="sparkly-text">
                                <svg viewBox="0 0 96 96" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M93.781 51.578C95 50.969 96 49.359 96 48c0-1.375-1-2.969-2.219-3.578 0 0-22.868-1.514-31.781-10.422-8.915-8.91-10.438-31.781-10.438-31.781C50.969 1 49.375 0 48 0s-2.969 1-3.594 2.219c0 0-1.5 22.87-10.406 31.781-8.908 8.913-31.781 10.422-31.781 10.422C1 45.031 0 46.625 0 48c0 1.359 1 2.969 2.219 3.578 0 0 22.873 1.51 31.781 10.422 8.906 8.911 10.406 31.781 10.406 31.781C45.031 95 46.625 96 48 96s2.969-1 3.562-2.219c0 0 1.523-22.871 10.438-31.781 8.913-8.908 31.781-10.422 31.781-10.422Z"
                                        fill="#000"
                                    />
                                </svg>
                                <svg viewBox="0 0 96 96" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M93.781 51.578C95 50.969 96 49.359 96 48c0-1.375-1-2.969-2.219-3.578 0 0-22.868-1.514-31.781-10.422-8.915-8.91-10.438-31.781-10.438-31.781C50.969 1 49.375 0 48 0s-2.969 1-3.594 2.219c0 0-1.5 22.87-10.406 31.781-8.908 8.913-31.781 10.422-31.781 10.422C1 45.031 0 46.625 0 48c0 1.359 1 2.969 2.219 3.578 0 0 22.873 1.51 31.781 10.422 8.906 8.911 10.406 31.781 10.406 31.781C45.031 95 46.625 96 48 96s2.969-1 3.562-2.219c0 0 1.523-22.871 10.438-31.781 8.913-8.908 31.781-10.422 31.781-10.422Z"
                                        fill="#000"
                                    />
                                </svg>
                                <svg viewBox="0 0 96 96" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M93.781 51.578C95 50.969 96 49.359 96 48c0-1.375-1-2.969-2.219-3.578 0 0-22.868-1.514-31.781-10.422-8.915-8.91-10.438-31.781-10.438-31.781C50.969 1 49.375 0 48 0s-2.969 1-3.594 2.219c0 0-1.5 22.87-10.406 31.781-8.908 8.913-31.781 10.422-31.781 10.422C1 45.031 0 46.625 0 48c0 1.359 1 2.969 2.219 3.578 0 0 22.873 1.51 31.781 10.422 8.906 8.911 10.406 31.781 10.406 31.781C45.031 95 46.625 96 48 96s2.969-1 3.562-2.219c0 0 1.523-22.871 10.438-31.781 8.913-8.908 31.781-10.422 31.781-10.422Z"
                                        fill="#000"
                                    />
                                </svg>
                                <svg viewBox="0 0 96 96" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M93.781 51.578C95 50.969 96 49.359 96 48c0-1.375-1-2.969-2.219-3.578 0 0-22.868-1.514-31.781-10.422-8.915-8.91-10.438-31.781-10.438-31.781C50.969 1 49.375 0 48 0s-2.969 1-3.594 2.219c0 0-1.5 22.87-10.406 31.781-8.908 8.913-31.781 10.422-31.781 10.422C1 45.031 0 46.625 0 48c0 1.359 1 2.969 2.219 3.578 0 0 22.873 1.51 31.781 10.422 8.906 8.911 10.406 31.781 10.406 31.781C45.031 95 46.625 96 48 96s2.969-1 3.562-2.219c0 0 1.523-22.871 10.438-31.781 8.913-8.908 31.781-10.422 31.781-10.422Z"
                                        fill="#000"
                                    />
                                </svg>
                                <svg viewBox="0 0 96 96" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M93.781 51.578C95 50.969 96 49.359 96 48c0-1.375-1-2.969-2.219-3.578 0 0-22.868-1.514-31.781-10.422-8.915-8.91-10.438-31.781-10.438-31.781C50.969 1 49.375 0 48 0s-2.969 1-3.594 2.219c0 0-1.5 22.87-10.406 31.781-8.908 8.913-31.781 10.422-31.781 10.422C1 45.031 0 46.625 0 48c0 1.359 1 2.969 2.219 3.578 0 0 22.873 1.51 31.781 10.422 8.906 8.911 10.406 31.781 10.406 31.781C45.031 95 46.625 96 48 96s2.969-1 3.562-2.219c0 0 1.523-22.871 10.438-31.781 8.913-8.908 31.781-10.422 31.781-10.422Z"
                                        fill="#000"
                                    />
                                </svg>

                                <span>3D Printing</span>
                                <span aria-hidden="true">3D Printing</span>
                            </a>
                        </h1>
                        <p>
                            We turn recycled plastic into high-quality 3D printing materials by blending it with advanced compounds<br>
                            Sustainable, strong, and flexible-ready for your creations
                        </p>
                    </div>
                </div>
            </div>
        </div>
 
    </section>

<!-- What We Do Section -->
<section class="what-we-do-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="section-title center">
                    <h1><img src="assets/images/home1/section-shape.png" alt="">What We Do</h1>
                    <h4>Turning Plastic Waste into Opportunities</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="single-what-we-do-box">
                    <h3>1. Collect Plastic Waste</h3>
                    <p>We partner with local businesses and communities to collect plastic waste, ensuring it doesn't end up in landfills or oceans.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-what-we-do-box">
                    <h3>2. Transform into 3D Materials</h3>
                    <p>Using advanced technology, we recycle the collected plastic into high-quality 3D printing materials that are sustainable and durable.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-what-we-do-box">
                    <h3>3. Promote Sustainability</h3>
                    <p>We empower creators and businesses to use eco-friendly materials, reducing their carbon footprint and supporting a greener future.</p>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Our Filament Section -->
<section class="our-filament-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="section-title center">
                    <h2>Our Filament</h2>
                </div>
            </div>
        </div>
        <div class="amazon-product-grid">
            <?php foreach($products as $product): ?>
                <div class="amazon-product-card">
                    <?php
                    // Set a default image
                    $img_url = 'assets\images\productsp';
                    // Manually assign images based on product ID or name
                    switch ($product['id']) {
                        case 1:
                            $img_url = 'assets\images\products\WH1-e1517570192578.jpg.webp';
                            break;
                        case 2:
                            $img_url = 'assets\images\products\PP-8000-Polypropylene-Granules-3-scaled.jpg';
                            break;
                            case 3:
                                $img_url = 'assets\images\products\633ffc87b7fc83793e495e6e-haosegd-5-colors-pla-filament-3d.jpg';
                                break;
                        // Add more cases as needed
                    }
                    ?>
                    <img src="<?php echo $img_url; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="amazon-product-image">
                    <div class="amazon-product-title"><?php echo htmlspecialchars($product['name']); ?></div>
                    <div class="amazon-product-desc"><?php echo htmlspecialchars($product['description']); ?></div>
                    <div class="amazon-product-price">$<?php echo number_format($product['price'], 2); ?></div>
                    <div class="amazon-product-stock">
                        <?php if($product['stock'] > 0): ?>
                            In Stock: <?php echo $product['stock']; ?> units
                        <?php else: ?>
                            Out of Stock
                        <?php endif; ?>
                    </div>
                    <?php if($product['stock'] > 0): ?>
                    <div class="amazon-product-actions">
                        <a href="orderform.html?product_id=<?php echo $product['id']; ?>" class="amazon-order-btn">Order Now</a>
                        <form action="add_to_cart.php" method="POST" class="ajax-add-to-cart" data-product-id="<?php echo $product['id']; ?>" style="width:50%">
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                            <button type="submit" class="amazon-cart-btn" data-product-id="<?php echo $product['id']; ?>">Add to Cart</button>
                        </form>
                    </div>
                    <div class="add-to-cart-msg" style="display:none;color:#28a745;font-weight:600;margin-top:6px;"></div>
                    <?php else: ?>
                        <button class="amazon-order-btn" disabled>Out of Stock</button>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!--==================================================-->
<!-- Strat Echofy Service Title Area Home Seven-->
<!--==================================================-->
<div class="services-title-area home-six home-seven">
	
					
				</p>
			</div>
		</div>
	</div>

  <!-- Footer Area -->
  <div class="footer-area home-six">
    <div class="container">
        <div class="row align-items-start">
            <div class="col-lg-4 col-md-6">
                <div class="footer-logo">
                    <h2>Eco Cycle</h2>
                </div>
                <p class="footer-desc">We are a company focused on recycling plastic waste and promoting sustainability. Through partnerships with local businesses, we collect plastic and contribute to a cleaner, more sustainable future.</p>
                <div class="footer-social-icon">
                    <ul>
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <div class="footer-widget-content">
                    <div class="footer-widget-title">
                        <h4>Quick Links</h4>
                    </div>
                    <div class="footer-widget-menu">
                        <ul>
                            <li><a href="about.html">About Us</a></li>
                            <li><a href="home.html">Home</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-widget-content">
                    <div class="footer-widget-title">
                        <h4>Our Services</h4>
                    </div>
                    <div class="footer-widget-menu">
                        <ul>
                            <li><a href="service.html">Recycling Plastic Materials</a></li>
                            <li><a href="partner.html">Partnership Opportunities</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-widget-content">
                    <div class="footer-widget-title">
                        <h4>Contact Us</h4>
                    </div>
                    <div class="footer-widget-menu contact">
                        <ul>
                            <li><strong>Phone:</strong> +20 123 456 7890</li>
                            <li><strong>Email Address:</strong> info@ecocycle.com</li>
                            <li><strong>Location:</strong> 123 Innovation St. Cairo</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="footer-bottom-area">
                    <div class="footer-bottom-content">
                        <p>Copyright 2025. All Rights Reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.ajax-add-to-cart').forEach(function(form) {
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      var formData = new FormData(form);
      fetch('add_to_cart.php', {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          // Update cart count
          fetch('cart_count.php')
            .then(res => res.json())
            .then(countData => {
              var cartCount = document.getElementById('cart-count');
              cartCount.textContent = countData.count;
              // Notification effect
              cartCount.style.background = '#28a745';
              setTimeout(() => { cartCount.style.background = '#ff9900'; }, 800);
            });
        }
      });
    });
  });
});
</script>
</body>
</html> 