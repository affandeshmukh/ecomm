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

<link rel="stylesheet" href="style.css">
<!-- <link rel="stylesheet" href="style.css"> -->
<style>

  /* Ensure cards are displayed in a horizontal line */
  

  
.add {
  color: white;
  background-color:rgb(198, 212, 0);
  padding: 10px;
  text-decoration: none;
  border-radius: 5px;
  display: inline-block;
  transition: background-color 0.3s ease;
  margin-bottom: 20px; 

}
/* Container for the form */
form[style="float:right;"] {
    display: flex;
    align-items: center;
    margin-right: 20px;
    margin-top:20px;
    margin-bottom:20px;
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
.con{
  background-color:rgb(198, 212, 0);
margin:0px;
  padding:0px;
  margin-top:-50px;

}
.con a {
  font-family: Arial, Helvetica, sans-serif;

  display: block;
  color: #f2f2f2;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 39px;
}

 /* Grid styles */
 .grid-container {
       display: grid;
       grid-template-columns: repeat(3, 1fr);
       grid-gap: 10px;
       margin-bottom: 20px;
     }

     .grid-item {
       background-color: #f2f2f2;
       padding: 10px;
       text-align: center;
     }

     table {
       border-collapse: collapse;
       width: 100%;
     }

     th, td {
       padding: 8px;
       text-align: left;
       border-bottom: 1px solid #ddd;
     }

     th {
       background-color: #4CAF50;
       color: white;
     }

    
     .pagination {
       display: inline-block;
     }

     .pagination a {
       color: black;
       float: left;
       padding: 8px 16px;
       text-decoration: none;
       border: 1px solid #ddd;
     }

     .pagination a.active {
       background-color: #4CAF50;
       color: white;
       border: 1px solid #4CAF50;
     }

     .pagination a:hover:not(.active) {
       background-color: #ddd;
     }
</style>

</head>
<body>
<!-- top nav -->
<div class="topnav" id="myTopnav">
  <h3>
    <a href="#home" class="active">Home</a>
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

<div class="con">
<?php if(!isset($_SESSION['username'])){?>
  <center><a href='user/register'>Register</a> 
            <?php }else{ ?>
              <?php }?>
       
</div>
<?php if(!isset($_SESSION['username'])){
                echo "<center><h1>Welcome Guest</h1>";
            }else{
              echo "<center><h2>We are Deliver your product in 30 minutes.</h2>";
        echo "
        <center><h1>Welcome ".$_SESSION['username']."</h1>";}?>


<?php

   // Number of records per page
   $recordsPerPage = 8;

   // Current page number
   if (isset($_GET['page'])) {
     $currentPage = $_GET['page'];
   } else {
     $currentPage = 1;
   }

   // Calculate the starting record index
   $startFrom = ($currentPage - 1) * $recordsPerPage;?>

<!-- cards -->
<div class='row'> <!-- Start the row container -->
 <?php 
  if(!isset($_GET['category'])){
    if(!isset($_GET['brands'])){
      $select_prod = "SELECT * FROM product order by rand() LIMIT $startFrom, $recordsPerPage ";
      $result_prod = mysqli_query($con, $select_prod);
      $num_of_rows=mysqli_num_rows($result_prod);

      if($num_of_rows==0){
        echo "<h2>Order not place</h2>";
      }

      while($row_data = mysqli_fetch_assoc($result_prod)){
        $product_title = $row_data['product_title'];
        $product_price = $row_data['product_price'];
        $product_id = $row_data['product_id'];
        $img = $row_data['img'];

        echo "<div class='col-md-3'>
                <div class='card '>
                  <center><img src='$img' class='card-img-top ' styele=' width: 500px;
                  height: 150px;'></center>
                  <div class='card-body '>
                    <h5 class='card-title '>$product_title</h5>
                    <p class='card-text '>₹$product_price</p>
                    <a href='index?add-to-cart=$product_id' class='add '>Add to Cart</a>
                    <a href='view.php?view=$product_title' class='view '>View More</a>

                  </div>
                </div>
              </div>";
      }
    }
  }
  ?>
</div> <!-- Close the row container -->
<?php 
   $sql = "SELECT COUNT(*) AS total FROM product";
   $result = $con->query($sql);
   $row = $result->fetch_assoc();
   $totalRecords = $row["total"];
   $totalPages = ceil($totalRecords / $recordsPerPage);

   echo "<div class='pagination'>";

   if ($totalPages > 1) {
     for ($i = 1; $i <= $totalPages; $i++) {
       if ($i == $currentPage) {
         echo "<a class='active' href='?page=$i'>$i</a> ";
       } else {
         echo "<a href='?page=$i'>$i</a> ";
       }
     }
   }

   echo "</div>";?>
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
hh
<?php include('footer.php'); ?>
                   
               </body>
</html>
