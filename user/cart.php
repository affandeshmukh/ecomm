<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php 
include('../includes/connect.php');
include('../function/function.php');


// Function to remove items from the cart
function removeItemFromCart($productId, $ipAddress, $con) {
    $delete_cart_info_query = "DELETE FROM `cart_info` WHERE product_id='$productId' AND ip_address='$ipAddress'";
    $run_delete_cart_info = mysqli_query($con, $delete_cart_info_query);

    
    return $run_delete_cart_info ;
}

if(isset($_POST['remove'])) {
    if(isset($_POST['remove_item'])) {
        $removeItems = $_POST['remove_item'];
        foreach($removeItems as $remove_id) {
            $removed = removeItemFromCart($remove_id, getIPAddress(), $con);
        }
    }
}

// Function to update item quantity in cart
function updateCartItemQuantity($productId, $ipAddress, $newQuantity, $con) {
    $update_query = "UPDATE `cart_info` SET quantity=$newQuantity WHERE product_id='$productId' AND ip_address='$ipAddress'";
    $run_update = mysqli_query($con, $update_query);
    return $run_update;
}

if(isset($_POST['update_cart'])) {
    if(isset($_POST['quantity']) && is_array($_POST['quantity'])) {
        foreach($_POST['quantity'] as $product_id => $new_quantity) {
            updateCartItemQuantity($product_id, getIPAddress(), $new_quantity, $con);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-KJS5SC34YS"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-KJS5SC34YS');
</script>
    <meta charset="utf-8">
    <title>E-commerce Website</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="car.css">

    <style>
        
/* Container for the form */
form[style="float:right;"] {
    display: flex;
    align-items: center;
    margin-right: 20px;
    margin-top:20px;
}

/* Search input field */
form[style="float:right;"] input[type="search"] {
    padding: 8px 12px;
    margin-right: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    width: 200px;
    transition: border-color 0.3s ease;
}

form[style="float:right;"] input[type="search"]:focus {
    border-color: #007BFF;
    outline: none;
}

/* Submit button */
form[style="float:right;"] input[type="submit"] {
    padding: 8px 16px;
    background-color: rgb(223 220 38);
    color: #fff;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

form[style="float:right;"] input[type="submit"]:hover {
    background-color: #0056b3;
}

    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
  
    </style>
</head>
<body>
    <!-- top nav -->
<div class="topnav" id="myTopnav">
  <h3>
    <a href="../index.php" class="active">Home</a>
    <?php if(!isset($_SESSION['username'])) { ?>
      <a href='login.php'>Login</a>
    <?php } else { ?>
      <a href='logout'>Logout</a>
      <a href='profile' style='float:right;'>
        <img src='profile.jpg' style='width: 70px; margin-bottom:10px; float:right;'>
      </a>
    <?php } ?>
  </h3>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
  <h3>
    <a href="cart">Total Items: <?php cart_item(); ?> Total Price: <?php total_cart_price(); ?></a>
  </h3>
  <form action="../search" method='get' style="float:right;">
    <input type="search" name="search_data" placeholder="Search" aria-label="Search" required>
    <input type="submit" value="Search" name="search_data_prod">
  </form>
</div>
<h3>Select Product for remove</h3>
    <div class="container cart-container">
        <div class="row">
            <form action="" method="post">
                <table class="table table-bordered text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Product Title</th>
                            <th>Product Image</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Remove</th>
                            <th colspan="2">Operation</th>
                        </tr>
                    </thead>
                   <tbody>
    <?php
    global $con;
    $get_ip_add = getIPAddress();
    $total = 0;
    $select_query = "SELECT * FROM `cart_info` WHERE ip_address='$get_ip_add'";
    $result_query = mysqli_query($con, $select_query);
    $result_count = mysqli_num_rows($result_query);
    if($result_count > 0) {
        while($row = mysqli_fetch_array($result_query)) {
            $product_id = $row['product_id'];
            $select_product = "SELECT * FROM `product` WHERE product_id='$product_id'";
            $result_product = mysqli_query($con, $select_product);
            while($row_price = mysqli_fetch_array($result_product)) {
                $product_price = $row_price['product_price'];
                $product_title = $row_price['product_title'];
                $img = $row_price['img'];
                $quantity = $row['quantity'];
                $product_total = $product_price * $quantity;
                $total += $product_total;
                $qqty=10;
                ?>
                <tr>
                    <td data-label="Product Title"><?php echo $product_title ?></td>
                    <td data-label="Product Image"><img src="<?php echo $img ?>" class="product-image"></td>
                    <td data-label="Quantity"><input type="text" maxlength="1" name="quantity[<?php echo $product_id ?>]" value="<?php echo $quantity; ?>" class="form-control w-50 mx-auto"></td>
                    
                    <td data-label="Total Price"><?php echo $product_total ?></td>
                    <td data-label="Remove"><input type="checkbox" name="remove_item[]" value="<?php echo $product_id ?>" ></td>
                    <td data-label="Operation">
                        <input type="submit" value="Quantity" name="update_cart" class="add">
                        <input type="submit" value="Remove" name="remove" class="add">
                    </td>
                </tr>
                <?php
            }
        }
    } else {
        echo "<tr><td colspan='6' class='add'>Your cart is empty.</td></tr>";
    }
    ?>
</tbody>

                </table>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <?php
                    $get_ip_add = getIPAddress();
                    $check=99;
                    $cart_query = "SELECT * FROM `cart_info` WHERE ip_address='$get_ip_add'";
                    $result = mysqli_query($con, $cart_query);
                    $result_count = mysqli_num_rows($result);
                    if ($result_count > 0) {
                        echo "<span class='subtotal'>Subtotal: <strong>$total</strong></span>";
                        echo "<div class='cart-buttons'>";
                        echo "<button class='add'><a href='/'>Continue Shopping</a></button>";
                        if($total>$check){
                        echo "<button class='add'><a href='checkout'>Checkout</a></button>";
                      }else{
                        echo "<button class='add' onclick='showAlert()'><a href='#'>Checkout</a></button>";
                      }
                        echo "</div>";
                    } else {
                        echo "<button class='add'><a href='/'>Continue Shopping</a></button>";
                    }
                    ?>
                </div>
            </form>
        </div>
    </div>
    <script>
function showAlert() {
    alert("Minimum order amount 99");
}
</script>
    <!-- Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <?php include('../footer.php'); ?>

</body>
</html>
