<?php 
include('../includes/connect.php');


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="reg.css">
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
<h2>Login</h2>
<div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="user_password" required>
            </div>
            
            <div class="form-group">
                <button type="submit" name="login">Submit</button>
            </div>    
            <h2>Create an account <a href="register.php">Register</a></h2>
    </form>
</body>
</html>
<?php
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $user_password = $_POST['user_password'];
    $user_ip = getIPAddress();


    // Query to select user by username
    $select_query = "SELECT * FROM `user` WHERE username='$username'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);

    // cart items
    $select_query_cart= "SELECT * FROM `cart_info` WHERE ip_address='$user_ip'";
    $select_cart=mysqli_query($con,$select_query_cart);
    $row_count_cart= mysqli_num_rows($select_cart);
    if($row_count > 0){
        $_SESSION['username']=$username;
        // Directly compare the input password with the stored password
        if($user_password == $row_data['user_password']){
            if($row_count==1 and $row_count_cart==0){
                $_SESSION['username']=$username;
                echo "<script>alert('Login successful');</script>";
                echo "<script>window.open('profile.php','_self')</script>";
            } else {
                $_SESSION['username']=$username;
                echo "<script>alert('Login successful');</script>";
                echo "<script>window.open('payment.php','_self')</script>";
            }
        } else {
            echo "<script>alert('Invalid password');</script>";
        }
    } else {
        echo "<script>alert('Invalid username');</script>";
    }
}
?>
