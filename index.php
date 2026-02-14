<!DOCTYPE html>
<html>

<head>
	<title>Eco Cycle - Login/Sign </title>
	    <!-- Main Style CSS -->
    <link rel="stylesheet" href="assets/css/login.css" type="text/css" media="all">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="slide navbar style.css">
</head>
<body>
	<?php
	session_start();
	if(isset($_SESSION['error'])) {
		echo '<div style="position: fixed; top: 20px; left: 50%; transform: translateX(-50%); background: #ff4444; color: white; padding: 10px 20px; border-radius: 5px; z-index: 1000;">' . $_SESSION['error'] . '</div>';
		unset($_SESSION['error']);
	}
	if(isset($_SESSION['success'])) {
		echo '<div style="position: fixed; top: 20px; left: 50%; transform: translateX(-50%); background: #4CAF50; color: white; padding: 10px 20px; border-radius: 5px; z-index: 1000;">' . $_SESSION['success'] . '</div>';
		unset($_SESSION['success']);
	}
	?>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
			     <form method="post" action="register.php">
					<label for="chk" aria-hidden="true">Sign up</label>
					<input type="text" name="fName" placeholder="First name" required="">
					<input type="text" name="lName" placeholder="Last name" required="">
					<input type="email" name="email" placeholder="Email" required="">
					<input type="password" name="password" placeholder="Password" required="">
					<button type="submit" name="signUp">Sign up</button>
				</form>
			</div>

			<div class="login">
			<form method="post" action="register.php">
					<label for="chk" aria-hidden="true">Login</label>
					<input type="email" name="email" placeholder="Email" required="">
					<input type="password" name="password" placeholder="Password" required="">
					<button type="submit" name="signIn">Login</button>
				</form>
			</div>
	</div>
	<script src="script.js"></script>
</body>
</html>