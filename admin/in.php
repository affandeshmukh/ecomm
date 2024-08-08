<?php 
include('../includes/connect.php');
// session_start();

// if(!isset($_SESSION['name'])){
//     echo "<script>window.open('login.php','_self')</script>";
//     exit();
// }

// Fetch all cards from the database
$query = "SELECT * FROM `product`";
$result = mysqli_query($con, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['name']; ?></h2>
    <div class="cards">
        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <div class="card <?php echo $row['status']; ?>">
                <h3><?php echo $row['product_title']; ?></h3>
                <p>Stock: <?php echo $row['stock']; ?></p>
                <form action="update_card.php" method="post">
                    <input type="hidden" name="card_id" value="<?php echo $row['product_id']; ?>">
                    <button type="submit" name="toggle_status">
                        <?php echo $row['status'] == 'enabled' ? 'Disable' : 'Enable'; ?>
                    </button>
                </form>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
