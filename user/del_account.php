<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

include('../includes/connect.php');
include('../function/function.php');

if(isset($_GET['del'])) {
    $del_id = $_GET['del'];
    
    // Check if user is logged in
    if(isset($_SESSION['username'])) {
        $username = $_SESSION['username'];

        $select_user_id = "SELECT user_id FROM user WHERE username = '$username'";
        $result_user_id = mysqli_query($con, $select_user_id);
        
        if(mysqli_num_rows($result_user_id) > 0) {
            $row = mysqli_fetch_assoc($result_user_id);
            $user_id = $row['user_id'];

            // Get the IP address of the user
            $ip_address = getIPAddress();

            // Delete from cart_info using ip_address
            $del_cart_info = "DELETE FROM `cart_info` WHERE ip_address = '$ip_address'";
            $result_cart_info = mysqli_query($con, $del_cart_info);

            // Delete from user_order using user_id
            $del_order_info = "DELETE FROM `user_order` WHERE user_id = $user_id";
            $result_order_info = mysqli_query($con, $del_order_info);

            // Delete from user table using user_id
            $del_user = "DELETE FROM `user` WHERE user_id = $user_id";
            $result_user = mysqli_query($con, $del_user);

            if($result_user) {
                // Destroy the session and redirect to logout
                session_destroy();
                echo "<script>window.open('logout.php','_self')</script>";
            } else {
                echo "Error: " . mysqli_error($con);
            }
        } 
    } 
}

// Close the database connection
mysqli_close($con);
?>
