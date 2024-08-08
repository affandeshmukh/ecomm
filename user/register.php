<?php 
include('../includes/connect.php');
include('../function/function.php');
if(isset($_POST['reg'])){
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $user_address = $_POST['user_address'];
    $user_mobile = $_POST['user_mobile'];
    $user_ip = getIPAddress();
    $colony = $_POST['colony'];


    // Check if user already exists
    $select_query = "SELECT * FROM `user` WHERE user_email='$user_email' && user_mobile='$user_mobile' ";
    $result_select = mysqli_query($con, $select_query);
    $number = mysqli_num_rows($result_select);

    if($number > 0){
        echo "<script>alert('User already exists')</script>";
    } else {
        // Insert new user into database
        $insert_query = "INSERT INTO `user` (username, user_email, user_password, user_ip, user_address, user_mobile,colony) 
                         VALUES ('$username', '$user_email', '$user_password', '$user_ip', '$user_address', '$user_mobile','$colony')";
        $result = mysqli_query($con, $insert_query);
        
        if($result){
            // Automatically log the user in
            $_SESSION['username'] = $username;
            echo "<script>alert('Registration successful')</script>";
            

            // Check for items in cart
            $select_cart = "SELECT * FROM `cart_info` WHERE ip_address='$user_ip'";
            $result_cart = mysqli_query($con, $select_cart);
            $row_cart = mysqli_num_rows($result_cart);

            if ($row_cart > 0) {
                echo "<script>alert('You have some items in your cart')</script>";
                echo "<script>window.open('checkout.php', '_self')</script>";
            } else {
                echo "<script>window.open('../index.php', '_self')</script>";
            }
        }
    }
}
?>
<head><meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"></head>
   <link rel="stylesheet" href="reg.css">

<div class="container">
        <h2>Registration Form</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="user_email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="user_password" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <textarea id="address" name="user_address" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="mobile">Mobile</label>
                <input type="number" name="user_mobile" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;" required/>

            </div>
            <div class="form-group">
            <select name="colony" required>
    <option value="" >Select Colony</option>
    <?php
    $select="Select * from address";
    $result=mysqli_query($con,$select);
    while($row=mysqli_fetch_assoc($result)){
        $address=$row['address'];
        echo "    <option >$address</option>";
    }
?> </select>

</div>
            <div class="form-group">
                <button type="submit" name="reg">Submit</button>
            </div>
        </form>
    </div>