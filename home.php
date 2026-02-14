<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Eco Cycle</title>
    <meta
      name="description"
      content="Eco Cycle - A smart recycling initiative that rewards you for collecting plastic waste. Join us in creating a greener future!"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Favicon -->
    <link
      rel="icon"
      type="image/png"
      sizes="32x32"
      href="assets/images/fav-icon/logo.png"
    />
    <!-- bootstrap CSS -->
    <link
      rel="stylesheet"
      href="assets/css/bootstrap.min.css"
      type="text/css"
      media="all"
    />
    <!-- font-awesome CSS -->
    <link
      rel="stylesheet"
      href="assets/css/all.min.css"
      type="text/css"
      media="all"
    />
    <!-- theme-default CSS -->
    <link
      rel="stylesheet"
      href="assets/css/theme-default.css"
      type="text/css"
      media="all"
    />
    <!-- meanmenu CSS -->
    <link
      rel="stylesheet"
      href="assets/css/meanmenu.min.css"
      type="text/css"
      media="all"
    />
    <!-- bootstrap icons -->
    <link
      rel="stylesheet"
      href="assets/css/bootstrap-icons.css"
      type="text/css"
      media="all"
    />
    <!-- Main Style CSS -->
    <link
      rel="stylesheet"
      href="assets/css/home.css"
      type="text/css"
      media="all"
    />
    <!--  Header&footer CSS -->
    <link
      rel="stylesheet"
      href="assets/css/Header&Footer"
      type="text/css"
      media="all"
    />
    <!-- responsive CSS -->
    <link
      rel="stylesheet"
      href="assets/css/responsive.css"
      type="text/css"
      media="all"
    />
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
    </style>
  </head>

  <body>
    <!-- Header Area -->
    <?php include 'header.php'; ?>

    <!-- Start Eco cycle text Area Home Three-->
    <section class="hero-area home-three">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <div class="hero-content">
              <h1>
                YOUR WASTE, OUR FUTURE<br />
                <span class="highlight">RECYCLE TODAY</span>
              </h1>
              <p>
                Your plastic waste can make a difference.<br />
                Drop it at our collection points.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Eco cycle Hero Area Home Three -->

    <!-- Start Eco cycle Hero Area Home Three-->
    <div class="hero-area home-three d-flex align-items-center">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-12 text-center">
            <div class="hero-content">
              <h2>From Waste to worth</h2>
            </div>
            <div class="ecocycle-button style-two">
              <a href="service.php">
                Our Eco Services <i class="bi bi-arrow-right"></i
              ></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--==================================================-->
    <!-- Start Eco cycle About Area Home Three-->
    <!--==================================================-->

    <div class="about-area home-three">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-5 col-md-12">
            <div class="about-thumb">
              <img
                src="assets/images/about-image.jpg"
                alt="About Image"
                style="width: 100%; border-radius: 10px"
              />
            </div>
          </div>
          <div class="col-lg-7 col-md-12">
            <div class="content-box-3d">
              <div class="section-title left">
                <h4><span>About</span> Company</h4>
                <h1>Transforming Waste into a</h1>
                <h1>Greener Tomorrow</h1>
              </div>
              <div class="about-content">
                <h3>Why Choose Us</h3>
                <p>
                  We make recycling easy and rewarding by partnering with
                  supermarkets, malls, and more. Your plastic waste turns into
                  valuable recycled materials, supporting a greener future while
                  earning rewards. Join us in making a difference!
                </p>
                <ul></ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- End ecocycle About Area Home Three-->
    <!--==================================================-->

    <!-- Footer Area -->
    <div class="footer-area home-six">
      <div class="container">
        <div class="row align-items-start">
          <div class="col-lg-4 col-md-6">
            <div class="footer-logo">
              <h2>Eco Cycle</h2>
            </div>
            <p class="footer-desc">
              We are a company focused on recycling plastic waste and promoting
              sustainability. Through partnerships with local businesses, we
              collect plastic and contribute to a cleaner, more sustainable
              future.
            </p>
            <div class="footer-social-icon">
              <ul>
                <li>
                  <a href="#"><i class="fab fa-facebook-f"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fab fa-twitter"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </li>
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
                  <li><a href="about.php">About Us</a></li>
                  <li><a href="home.php">Home</a></li>
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
                  <li>
                    <a href="service.php">Recycling Plastic Materials</a>
                  </li>
                  <li><a href="partner.php">Partnership Opportunities</a></li>
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
  </body>
</html> 