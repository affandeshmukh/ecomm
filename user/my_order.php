<?php 
include('../includes/connect.php');
include('../function/function.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-KJS5SC34YS"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-KJS5SC34YS');
</script>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body {
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
  }
  
  .topnav {
    overflow: hidden;
    background-color: rgb(198, 212, 0);
  }
  
  .topnav a {
    float: left;
    display: block;
    color: #f2f2f2;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
  }
  
  
  .topnav a:hover {
    
    color: rgb(255, 251, 0);
  }
  
  .topnav a {
    background-color: rgb(198, 212, 0)D;
    color: white;
  }
  
  .topnav .icon {
    display: none;
  }
  
  @media screen and (max-width: 600px) {
    .topnav a:not(:first-child) {display: none;}
    .topnav a.icon {
      float: right;
      display: block;
    }
  }
  
  @media screen and (max-width: 600px) {
    .topnav.responsive {position: relative;}
    .topnav.responsive .icon {
      position: absolute;
      right: 0;
      top: 0;
    }
    .topnav.responsive a {
      float: none;
      display: block;
      text-align: left;
    }
  }
  /* order box */
  .order-container {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    padding: 20px;
  }

  .order-box {
    background-color: white;
    border: 2px solid black;
    padding: 20px;
    box-sizing: border-box;
    margin-left:-10px;
  }

  @media (max-width: 768px) {
    .order-container {
      grid-template-columns: repeat(2, 1fr);
    }
    .order-box {
      background-color: white;
      border: 2px solid black;
      padding: 20px;
      box-sizing: border-box;
      margin-left:-25px;
      width: 190px;
    }
  }

  .order-box img {
    width: 50px;
    display: block;
    margin: 0 auto 20px auto;
  }

  .order-box h1, .order-box h2, .order-box h3 {
    text-align: center;
  }

  .order-box h1 {
    margin-top: -20px;
  }

  .order-box h2 {
    margin-top: -20px;
  }
</style>
</head>
<body>
<!-- top nav -->
<div class="topnav" id="myTopnav">
  <h3>
    <a href="/" class="active">Home</a>
    <?php if(!isset($_SESSION['username'])) { ?>
      <a href='user/login'>Login</a>
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
<?php 
if(!isset($_SESSION['username'])){
   echo "<li class='nav-item'><a class='nav-link' href='user/login'>login</a></li>";
} else {
    $username = $_SESSION['username'];
    $get = "SELECT * FROM `user` WHERE username = '$username' ";
    $result = mysqli_query($con, $get);

    if ($result) {
        $row_fetch = mysqli_fetch_assoc($result);
        $user_id = $row_fetch['user_id'];

        $detail = "SELECT * FROM `user_order` WHERE user_id = $user_id ORDER BY order_id DESC";
        $result = mysqli_query($con, $detail);

        if ($result) {
            echo "<div class='order-container' '>";

            while ($row = mysqli_fetch_assoc($result)) {
                $order = $row['order_id'];
                $product_title = $row['product_title'];
                $quantity = $row['quantity'];
                $amount = $row['amount'];
                $bill = $row['bill'];
                $order_date = $row['order_date'];
                $img = $row['img'];
                $status = $row['status']; 

              

                echo "<div class='order-box' style=''>
                
                <h3 style='margin-top:-10px;'>Title</h3>
                <h3>$product_title</h3>
                <img src='$img' style='width:150px;'>
                <h3>Price: $amount</h3> 
                <h3>Quantity: $quantity</h3>
                <h3>Order Date: $order_date</h3>
                <h5>Bill: $bill</h5>
                <h3>Status: $status</h3>
                </div>";
            }

            echo "</div>";
        } else {
            echo "Error fetching user orders: " . mysqli_error($con);
        }
    } else {
        echo "Error fetching user details: " . mysqli_error($con);
    }
}
?><?php include('../footer.php'); ?>

</body>
</html>
