<?php 
include('includes/connect.php');
include('function/function.php');

//var_dump($_SESSION);
?>
<!DOCTYPE html>
<html>
<head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-KJS5SC34YS"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-KJS5SC34YS');
</script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="view.css">
<!-- <link rel="stylesheet" href="style.css"> -->
<style>

  /* Ensure cards are displayed in a horizontal line */
  
  .ad {
  color: white;
  background-color:rgb(198, 212, 0);
  padding: 10px ;
  text-decoration: none;
  border-radius: 5px;
  /* display: inline-block; */
  transition: background-color 0.3s ease;
}
.add {
  color: white;
  background-color:rgb(198, 212, 0);
  padding: 10px;
  text-decoration: none;
  border-radius: 5px;
  display: inline-block;
  transition: background-color 0.3s ease;
}

</style>

</head>
<body>
<!-- top nav -->
<div class="topnav" id="myTopnav">
  <h3>
    <a href="/" class="active">Home</a>
    <?php if(!isset($_SESSION['username'])) { ?>
      <a href='user/login.php'>Login</a>
    <?php } else { ?>
      <a href='user/logout'>Logout</a>
      <a href='user/profile' style='float:right;'>
        <img src='profile.jpg' style='width: 70px; margin-bottom:10px; float:right;'>
      </a>
    <?php } ?>
  </h3>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>

  <h3>
    <a href="user/cart"><i style="color:black; font-size:30px; " class="fa">&#xf07a;</i>Total Items: <?php cart_item(); ?> Total Price: <?php total_cart_price(); ?></a>
  </h3>
  <form action="search.php" method='get' style="float:right;">
    <input type="search" name="search_data" placeholder="Search" aria-label="Search" required>
    <input type="submit" value="Search" name="search_data_prod">
  </form>
</div>

<?php cart(); ?>


<?php if(!isset($_SESSION['username'])){
                echo "<center><h1>Welcome Guest</h1>";
            }else{
              echo "<center><h2>We are Deliver your product in 30 minutes.</h2>";
        echo "
        <center><h1>Welcome ".$_SESSION['username']."</h1>";}?>


<!-- cards -->
<div class='row'> <!-- Start the row container -->
 <?php 
  if($_GET['view']) {
    $view=$_GET['view'];
      $select_prod = "SELECT * FROM product  where product_title ='$view'";
      $result_prod = mysqli_query($con, $select_prod);
      
      while($row = mysqli_fetch_assoc($result_prod)){
        $product_title = $row['product_title'];
        $product_price = $row['product_price'];
        $product_id = $row['product_id'];
        $img = $row['img'];

        echo "
                <img src='$img' class='card-img-top' alt='$product_title'>
                  <div class='card-body'>
                  <h2>Generic brands</h2>
                    <h3 class='card-title'>$product_title</h3>
                    <p class='card-text'>₹$product_price</p>
                    <a href='index?add-to-cart=$product_id' class='add'>Add to Cart</a>
              </div>";
      }
  
  }
  ?>
</div> <!-- Close the row container -->

<?php $ip = getIPAddress(); ?>

<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>              

<?php include('footer.php'); ?>
                   
               </body>
</html>
