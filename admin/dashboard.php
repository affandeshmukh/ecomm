<?php
include('../includes/connect.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
  body {
  font-family: "Lato", sans-serif;
}

.sidenav {
  height: 100%;
  width: 160px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  padding-top: 20px;
}

.sidenav a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.main {
  margin-left: 160px; /* Same as the width of the sidenav */
  font-size: 28px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
    </style>
  </head>
    <body>
      <div class="sidenav">
        <a href="dashboard.php?insert">Insert Products</a>
        <a href="dashboard.php?list">View Products</a>
        <a href="dashboard.php?orders">All Orders</a>
        <a href="#">insert category</a>
        <a href="#">insert brands</a>
        <a href="../shipping/index.php">Parcel Boys</a>
        <a href="logout.php">logout</a>

      </div>
      <div class="main">
      
<?php if(!isset($_SESSION['name'])){
                echo "<h1>Welcome Guest</h1>";
                echo "<a href='index.php'>Login</a>";
            }else{
        echo "
        <center><h1>Welcome ".$_SESSION['name']."</h1>";
            
           
        if(isset($_GET['insert_category'])){
            include('insert_category.php');
        }
        if(isset($_GET['insert_brands'])){
            include('insert_brands.php');
        }
        if(isset($_GET['orders'])){
          include('order.php');
      }
        if(isset($_GET['list'])){
            include('listed.php');
        }
        if(isset($_GET['edit_prod'])){
            include('edit.php');
        }
        if(isset($_GET['edit_brands'])){
            include('edit_brands.php');
        }
        if(isset($_GET['edit_category'])){
            include('edit_cat.php');
        }
        
        if(isset($_GET['insert'])){
            include('insert_product.php');
        }
        if(isset($_GET['del'])){
            include('delete.php');
        }
        if(isset($_GET['cat'])){
            include('delete.php');
        }
        if(isset($_GET['brand'])){
            include('delete.php');
        }}
    ?></div>
  </body>
</html>