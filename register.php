<?php 
session_start();
include 'connect.php';

if(isset($_POST['signUp'])){
    $firstName=$_POST['fName'];
    $lastName=$_POST['lName'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password=md5($password);

     $checkEmail="SELECT * From users where email='$email'";
     $result=$conn->query($checkEmail);
     if($result->num_rows>0){
        $_SESSION['error'] = "Email Address Already Exists!";
        header("Location: index.php");
        exit();
     }
     else{
        $insertQuery="INSERT INTO users(fName, lName, email, password)
                       VALUES ('$firstName','$lastName','$email','$password')";
            if($conn->query($insertQuery)==TRUE){
                $_SESSION['success'] = "Registration successful! Please login.";
                header("Location: index.php");
                exit();
            }
            else{
                $_SESSION['error'] = "Error: " . $conn->error;
                header("Location: index.php");
                exit();
            }
     }
}

if(isset($_POST['signIn'])){
   $email=$_POST['email'];
   $password=$_POST['password'];
   $password=md5($password);
   
   $sql="SELECT * FROM users WHERE email='$email' and password='$password'";
   $result=$conn->query($sql);
   if($result->num_rows>0){
    $row=$result->fetch_assoc();
    $_SESSION['email'] = $row['email'];
    $_SESSION['fName'] = $row['fName'];
    $_SESSION['lName'] = $row['lName'];
    $_SESSION['is_admin'] = $row['is_admin'];
    $_SESSION['success'] = "Login successful!";
    
    // Redirect to home.php instead of home.html
    header("Location: home.php");
    exit();
   }
   else{
    $_SESSION['error'] = "Incorrect Email or Password";
    header("Location: index.php");
    exit();
   }
}
?>