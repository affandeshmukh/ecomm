<?php 
include('includes/connect.php');
include('function/function.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Site</title>
    <link rel="stylesheet" href="research.css">
    <style>
  /* Ensure cards are displayed in a horizontal line */
  
</style>
</head>
<body>
    
<!-- top nav -->
<div class="topnav" id="myTopnav"> <h3>
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
  </a>                    <h3>
                        <a href="user/cart.php">Total Items:
                        <?php cart_item(); ?>  Total Price: ₹<?php total_cart_price();?></a></h3>      

                    
                    <form  action="search.php" method='get' style="float:right;">
                <input type="search" name="search_data" placeholder="Search" aria-label="Search" required>
                    <!-- <button class="btn btn-outline-success" type="submit">Search</button> -->
                    <input type="submit" value="Search" name="search_data_prod">
                </form>

</div>
    <?php cart();
         ?>
    <!-- third child -->
    
            <!-- products -->
            <?php 
            if(isset($_GET['search_data_prod'])){
                $user_search=$_GET['search_data'];
                $search_query="Select * from `product` where product_keywords like 
                '%$user_search%'";          
                $result_prod = mysqli_query($con, $search_query);
                $count = 0; // Counter to keep track of the number of cards

                echo "<div class='row g-0'>"; // Start the first row

                while($row_data = mysqli_fetch_assoc($result_prod)){
                    $product_title = $row_data['product_title'];
                    $product_price = $row_data['product_price'];
                    $product_id = $row_data['product_id'];
                    $img = $row_data['img'];

                    echo "<div class='col-md-3'>
                    <div class='card'>
                      <center><img src='$img' class='card-img-top' styele=' width: 500px;
                      height: 150px;'></center>
                      <div class='card-body'>
                        <h5 class='card-title'>$product_title</h5>
                        <p class='card-text'>₹$product_price</p>
                        <a href='index?add-to-cart=$product_id' class='add'>Add to Cart</a>
                        <a href='view.php?view=$product_id' class='view'>View More</a>
    
                      </div>
                    </div>
                  </div>";

                    $count++;
                    // If the counter is divisible by 3, close the current row and start a new one
                    if ($count % 3 == 0) {
                        echo "</div><div class='row g-0'>";
                    }
                }

                echo "</div>"; // Close the last row
            }
            ?>
        </div>
<!--  -->



<?php include('footer.php'); ?>











<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
