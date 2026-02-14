<?php
session_start();
?>
<!-- Header Area -->
<div class="header-area home-three sticky" id="sticky-header">
  <div class="container-fluid">
    <div class="row align-items-center">
      <div class="col-lg-3">
        <div class="header-logo">
          <a href="home.php">
            <img src="assets/images/Photo/logo.png" alt="logo" />
          </a>
        </div>
      </div>
      <div class="col-lg-9">
        <div class="header-menu">
          <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="service.php">Eco Service</a></li>
            <li><a href="partner.php">Partner</a></li>
          </ul>
          <div class="header-button">
            <a href="cart.php" class="cart-link" style="position:relative;">
              <i class="fas fa-shopping-cart"></i>
              <span id="cart-count" style="position:absolute;top:-8px;right:-10px;background:#ff9900;color:#fff;font-size:0.9em;padding:2px 7px;border-radius:50%;font-weight:700;">
                <?php echo isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0; ?>
              </span>
            </a>
            <?php if(isset($_SESSION['email'])): ?>
              <div class="dropdown">
                <a class="user-name" href="#"><?php echo htmlspecialchars($_SESSION['fName']); ?></a>
                <div class="dropdown-content">
                  <a href="account.php">Account</a>
                  <a href="logout.php">Logout</a>
                </div>
              </div>
            <?php else: ?>
              <a href="index.php">Login/Sign up</a>
            <?php endif; ?>
            <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                <a href="add_product.php">Add Product</a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

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
  z-index: 1000;
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
  display: inline-block;
  margin-top: 0;
}

.user-name:hover {
  background: #1733a9;
}

.cart-icon {
  color: #fff;
  transition: color 0.2s;
  position: relative;
  display: inline-block;
  vertical-align: middle;
  margin-right: 10px;
}
.cart-badge {
  position: absolute;
  top: -8px;
  right: -8px;
  background: #ff9900;
  color: #fff;
  border-radius: 50%;
  padding: 2px 7px;
  font-size: 0.85em;
  font-weight: bold;
  z-index: 10;
  border: 2px solid #fff;
}
@media (max-width: 991px) {
  .cart-icon {
    font-size: 2em;
    margin-right: 16px;
  }
}
</style> 