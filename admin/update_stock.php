<?php 
include('../includes/connect.php');
// session_start();

// if(!isset($_SESSION['name'])){
//     echo "<script>window.open('login.php','_self')</script>";
//     exit();
// }

if(isset($_POST['update_stock'])){
    $card_id = $_POST['card_id'];
    $new_stock = $_POST['stock'];
    
    // Update stock level
    $update_query = "UPDATE `product` SET `stock`=$new_stock WHERE `id`=$card_id";
    mysqli_query($con, $update_query);
    
    echo "<script>window.open('in.php','_self')</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Stock</title>
</head>
<body>
    <h2>Update Stock</h2>
    <form action="" method="post">
        <label for="card_id">Card ID:</label>
        <input type="text" id="card_id" name="card_id" required>
        <label for="stock">Stock Quantity:</label>
        <input type="number" id="stock" name="stock" required>
        <button type="submit" name="update_stock">Update Stock</button>
    </form>
</body>
</html>
