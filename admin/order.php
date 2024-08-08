<style>
/* Reset some default styles */
body, h1, h2, h3, p, ul, ol, li, figure, figcaption, blockquote, dl, dd {
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    padding: 20px;
}

.container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
    max-width: 1200px;
    margin: 0 auto;
}

.order-card {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.order-info p {
    margin-bottom: 10px;
    font-size: 16px;
    color: #333;
}

.order-info p strong {
    color: #000;
}

.order-image {
    margin-top: 20px;
    border-radius: 8px;
    overflow: hidden;
}

.order-image img {
    width: 100%;
    height: auto;
    display: block;
    object-fit: cover;
}
</style>
<div class="container">
    <?php
    include('../includes/connect.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Handle form submission to update order status
        $order_id = $_POST['order_id'];
        $status = $_POST['status'];

        // Update order status in the database
        $sql = "UPDATE user_order SET status = ? WHERE order_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("si", $status, $order_id);

        if ($stmt->execute()) {
            echo "Order status updated successfully!";
        } else {
            echo "Error updating order status: " . $stmt->error;
        }

        $stmt->close();
    }

    // Display orders
    $select = "SELECT * FROM user_order ORDER BY order_date DESC";
    $query = mysqli_query($con, $select);

    while ($row = mysqli_fetch_assoc($query)) {
        $orderid = $row['order_id'];
        $user_id = $row['user_id'];
        $amount = $row['amount'];
        $bill = $row['bill'];
        $total_products = $row['total_products'];
        $order_date = $row['order_date'];
        $status = $row['status'];
        $user_address = $row['user_address'];
        $user_mobile = $row['user_mobile'];
        $product_title = $row['product_title'];
        $quantity = $row['quantity'];
        $img = $row['img'];
        $colony = $row['colony'];
        $username = $row['username'];

        // Check if the status is 'Delivered'
        $isDelivered = $status == 'Delivered';

        echo "
        <div class='order-card'>
            <div class='order-info'>
                <p><strong>Name:</strong> $username</p>
                <p><strong>Order ID:</strong> $orderid</p>
                <p><strong>User ID:</strong> $user_id</p>
                <p><strong>Amount:</strong> $amount</p>
                <p><strong>Bill:</strong> $bill</p>
                <p><strong>Total Products:</strong> $total_products</p>
                <p><strong>Order Date:</strong> $order_date</p>
                <p><strong>User Address:</strong> $user_address</p>
                <p><strong>User Mobile:</strong> $user_mobile</p>
                <p><strong>Product Title:</strong> $product_title</p>
                <p><strong>Quantity:</strong> $quantity</p>
                <p><strong>Colony:</strong> $colony</p>
                <p><strong>Status:</strong> $status</p>
            </div>
            <div class='order-image'>
                <img src='$img' alt='Product Image'>
            </div>
            <form action='' method='POST'>
                <input type='hidden' name='order_id' value='$orderid'>
                <label for='status'>Update Status:</label>
                <select name='status' id='status'".($isDelivered ? ' disabled' : '').">
                    <option value='Pending'".($status == 'Pending' ? ' selected' : '').">Pending</option>
                    <option value='Processing'".($status == 'Processing' ? ' selected' : '').">Processing</option>
                    <option value='Shipped'".($status == 'Shipped' ? ' selected' : '').">Shipped</option>
                    <option value='Delivered'".($status == 'Delivered' ? ' selected' : '').">Delivered</option>
                    <option value='Cancelled'".($status == 'Cancelled' ? ' selected' : '').">Cancelled</option>
                </select>
                <button type='submit'".($isDelivered ? ' disabled' : '').">Update Status</button>
            </form>
        </div>";
    }

    $con->close();
    ?>
</div>
