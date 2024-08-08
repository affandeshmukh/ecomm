<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    width: 80%;
    margin: 0 auto;
    padding: 20px;
}

h1 {
    text-align: center;
    color: #333;
}

.orders {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

.order-card {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 20px;
    width: 300px;
    text-align: center;
}

.order-card img.product-image {
    max-width: 100%;
    height: auto;
    border-bottom: 1px solid #ddd;
    margin-bottom: 15px;
}

.order-card h2 {
    margin-top: 0;
    color: #007bff;
}

.order-card p {
    margin: 5px 0;
}
</style>

<?php
include('../includes/connect.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];
    
    $update = "UPDATE user_order SET status = '$status' WHERE order_id = '$order_id'";
    $update_query = mysqli_query($con, $update);
    
    if ($update_query) {
        echo "<script>alert('Order status updated successfully');</script>";
    } else {
        echo "<script>alert('Failed to update order status');</script>";
    }
}

$select = "SELECT * FROM user_order WHERE colony = 'bhadkal gate'";
$query = mysqli_query($con, $select);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Orders for Kaziwada</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Delivery Orders for Kaziwada</h1>
        <div class="orders">
            <?php
            while ($row = mysqli_fetch_assoc($query)) {
                $order_id = $row['order_id'];
                $username = $row['username'];
                $title = $row['product_title'];
                $amount = $row['amount'];
                $address = $row['user_address'];
                $mob = $row['user_mobile'];
                $colony = $row['colony'];
                $image = $row['img']; // Assuming the image field is named 'product_image'
                $status = $row['status'];
                $isDelivered = $status == 'Delivered';
                ?>
                <div class="order-card">
                    <img src="<?php echo $image; ?>" alt="<?php echo $title; ?>" class="product-image">
                    <h2><?php echo $username; ?></h2>
                    <p><strong>Product:</strong> <?php echo $title; ?></p>
                    <p><strong>Amount:</strong> <?php echo $amount; ?></p>
                    <p><strong>Address:</strong> <?php echo $address; ?></p>
                    <p><strong>Mobile:</strong> <?php echo $mob; ?></p>
                    <p><strong>Colony:</strong> <?php echo $colony; ?></p>
                    <p><strong>Status:</strong> <?php echo $status; ?></p>
                    <form action="" method="POST">
                        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                        <label for="status">Update Status:</label>
                        <select name="status" id="status" <?php echo $isDelivered ? 'disabled' : ''; ?>>
                            <option value="Pending" <?php echo $status == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                            <option value="Processing" <?php echo $status == 'Processing' ? 'selected' : ''; ?>>Processing</option>
                            <option value="Shipped" <?php echo $status == 'Shipped' ? 'selected' : ''; ?>>Shipped</option>
                            <option value="Delivered" <?php echo $status == 'Delivered' ? 'selected' : ''; ?>>Delivered</option>
                            <option value="Cancelled" <?php echo $status == 'Cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                        </select>
                        <button type="submit" <?php echo $isDelivered ? 'disabled' : ''; ?>>Update Status</button>
                    </form>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</body>
</html>
