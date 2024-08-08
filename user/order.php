<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
include('../includes/connect.php');
include('../function/function.php');

?>

<?php 
if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
    
} else {
    die("Error: User ID is not set.");
}

// Getting total items and total items price
$user_ip = getIPAddress();
$total = 0;
$cart_query = "SELECT * FROM `cart_info` WHERE ip_address='$user_ip'";
$result_cart_price = mysqli_query($con, $cart_query);
$bill = mt_rand();
$status = 'Pending';
$count_products = mysqli_num_rows($result_cart_price);
$product_titles = [];

while($row_price = mysqli_fetch_array($result_cart_price)){
    $product_id = $row_price['product_id'];
    $select_products = "SELECT * FROM `product` WHERE product_id='$product_id'";
    $run_price = mysqli_query($con, $select_products);
    while ($row_product_price = mysqli_fetch_array($run_price)) {
        $product_price = $row_product_price['product_price'];
        $img = $row_product_price['img'];
        $total += $product_price;
        $product_titles[] = $row_product_price['product_title'];
    }
}

// Fetch user address and mobile
$username = $_SESSION['username'];
$select_user_id = "SELECT * FROM user WHERE username = '$username'";
$result_user_id = mysqli_query($con, $select_user_id);

if(mysqli_num_rows($result_user_id) > 0){
    $row = mysqli_fetch_assoc($result_user_id);
    $user_address = $row['user_address'];
    $user_mobile = $row['user_mobile'];
    $colony = $row['colony'];
    $username = $row['username'];



}

// Getting items from cart
$get_cart = "SELECT * FROM `cart_info` WHERE ip_address='$user_ip'";
$run_cart = mysqli_query($con, $get_cart);

while ($get_quantity = mysqli_fetch_array($run_cart)) {
    $quantity = $get_quantity['quantity'];
    $product_id = $get_quantity['product_id'];
    $select_products = "SELECT * FROM `product` WHERE product_id='$product_id'";
    $run_price = mysqli_query($con, $select_products);
    $row_product_price = mysqli_fetch_array($run_price);
    $product_price = $row_product_price['product_price'];
    $product_title = $row_product_price['product_title'];
    $img = $row_product_price['img'];


    if ($quantity == 0) {
        $quantity = 1;
        $subtotal = $product_price;
    } else {
        $quantity = $quantity;
        $subtotal = $product_price * $quantity;
    }

    // Insert into user_order
    $insert_query = "INSERT INTO `user_order` (user_id, amount, bill, total_products, order_date, status, user_address, user_mobile, product_title,quantity,img,colony,username)
    VALUES ($user_id, $subtotal, $bill, $count_products, NOW(), '$status', '$user_address', '$user_mobile', '$product_title',$quantity,'$img','$colony','$username')";
    $result_query = mysqli_query($con, $insert_query);

    // Order pending
    $insert_pending = "INSERT INTO `order_pending` (user_id, bill, product_id, quantity, status)
    VALUES ($user_id, $bill, $product_id, $quantity, '$status')";
    $result_pending = mysqli_query($con, $insert_pending);

    // Check if the queries were successful
    if (!$result_query || !$result_pending) {
        echo "<script>alert('There was an error processing your order.')</script>";
        die("Error: " . mysqli_error($con));
    }
}

// Empty cart
$empty_cart = "DELETE FROM `cart_info` WHERE ip_address='$user_ip'";
$result_delete = mysqli_query($con, $empty_cart);

if ($result_delete) {
    echo "<script>alert('Order submitted successfully')</script>";
    echo "<script>window.open('my_order.php', '_self')</script>";
} else {
    echo "<script>alert('There was an error emptying your cart.')</script>";
}
?>
