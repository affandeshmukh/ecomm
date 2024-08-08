<?php 
include('../includes/connect.php');
session_start();

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
                <label for="name">name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
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
    $name = $_POST['name']??'';
    $password = $_POST['password'] ?? '';


    // Query to select user by name
    $select_query = "SELECT * FROM `admin` WHERE name='$name'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);

    // // cart items
    // $select_query_cart= "SELECT * FROM `cart_info` WHERE ip_address='$user_ip'";
    // $select_cart=mysqli_query($con,$select_query_cart);
    // $row_count_cart= mysqli_num_rows($select_cart);
    if($row_count > 0){
        $_SESSION['name']=$name;
        // Directly compare the input password with the stored password
        if($password == $row_data['password']){
            if($row_count==1 and $row_count_cart==0){
                $_SESSION['name']=$name;
                echo "<script>window.open('dashboard.php','_self')</script>";
            } 
        } else {
            echo "<script>alert('Invalid password');</script>";
        }
    } else {
        echo "<script>alert('Invalid name');</script>";
    }
}
?>
