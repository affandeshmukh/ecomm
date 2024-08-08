<?php 
include('../includes/connect.php');
// session_start();

// if(!isset($_SESSION['name'])){
//     echo "<script>window.open('login.php','_self')</script>";
//     exit();
// }

if(isset($_POST['toggle_status'])){
    $card_id = intval($_POST['card_id']);
    
    // Fetch current status and stock
    $query = "SELECT `status`, `stock` FROM `product` WHERE `product_id`=$card_id";
    echo "Query: " . $query . "<br>"; // Debugging line
    $result = mysqli_query($con, $query);
    
    if (!$result) {
        die('Error executing query: ' . mysqli_error($con));
    }
    
    $row = mysqli_fetch_assoc($result);
    
    if ($row) {
        // Determine new status based on stock
        $new_status = ($row['stock'] > 0) ? 'enabled' : 'disabled';
        
        // Update status
        $update_query = "UPDATE `product` SET `status`='$new_status' WHERE `product_id`=$card_id";
        echo "Update Query: " . $update_query . "<br>"; // Debugging line
        $update_result = mysqli_query($con, $update_query);
        
        if (!$update_result) {
            die('Error updating status: ' . mysqli_error($con));
        }
        
        echo "<script>window.open('in.php','_self')</script>";
    } else {
        echo "<script>alert('Card not found');</script>";
    }
}
?>
