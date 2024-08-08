<?php 

include('../includes/connect.php');
include('../function/function.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Site</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
</head>
<body>

                   

 
    <!-- second child -->
   
    <!-- third child -->
    <div class="bg-light">
        <h3 class="text-center">Online Store</h3>
        <p class="text-center"></p>
    </div>

    <!-- fourth child -->
    
<!--  -->
<div class="row g-0">
        <div class="col-md-10">
            <!-- products -->
            
            <?php 
            
            if(!isset($_GET['category'])){
                if(!isset($_GET['brands'])){
                $select_prod = "SELECT * FROM `brands`  ";
                $result_prod = mysqli_query($con, $select_prod);
                $num_of_rows=mysqli_num_rows($result_prod);
                
                if($num_of_rows==0){
                  echo "<h2>Out of Stock</h2>";
                }
                $count = 0; // Counter to keep track of the number of cards

                echo "<div class='row g-0'>"; // Start the first row

                while($row_data = mysqli_fetch_assoc($result_prod)){
                    
                    $brands_id = $row_data['brands_id'];


                    echo "<div class='col-md-4 mb-4'>
                            <div class='card' style='width:370px;'>
                        
                                <a href='dashboard.php?edit_brands=$brands_id' class='btn btn-primary'>Edit</a>
                                <a href='dashboard.php?brand=$brands_id' class='btn btn-primary'>Delete</a>
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
            }}
            ?>
        </div>
<?php category(); ?>

<?php 
 $ip = getIPAddress();  
?>
<?php 
brand();
 ?>

        <!-- side nav -->
        <div class="col-md-2 bg-secondary p-0"> 
            <ul class="navbar-nav me-auto text-center">
                <li class="nav-item bg-info">
                    <a href="" class="nav-link text-light">Delivery Brands</a>
                </li>
                <?php 
                    $select_brand = "SELECT * FROM `brands`";
                    $result = mysqli_query($con, $select_brand);
                    while($row_data = mysqli_fetch_assoc($result)){
                        $brands_title = $row_data['brands_title'];
                        $brands_id = $row_data['brands_id'];

                        echo "<li class='nav-item'>
                                <a href='dashboard.php?brands=$brands_id' class='nav-link text-light'>
                                    $brands_title
                                </a>
                              </li>";
                    }
                ?>
            </ul>

            <!-- category display -->
            <ul class="navbar-nav me-auto text-center">
                <li class="nav-item bg-info">
                    <a href="" class="nav-link text-light">Category</a>
                </li>
                <?php 
                    $select_cat = "SELECT * FROM `category`";
                    $result_cat = mysqli_query($con, $select_cat);
                    while($row_data = mysqli_fetch_assoc($result_cat)){
                        $category_title = $row_data['category_title'];
                        $category_id = $row_data['category_id'];

                        echo "<li class='nav-item'>
                                <a href='dashboard.php?category=$category_id' class='nav-link text-light'>
                                    $category_title
                                </a>
                              </li>";
                    }
                ?>
            </ul>
        </div>
    </div>








    <?php 
            
            if(!isset($_GET['category'])){
                if(!isset($_GET['brands'])){
                $select_prod = "SELECT * FROM `category`  ";
                $result_prod = mysqli_query($con, $select_prod);
                $num_of_rows=mysqli_num_rows($result_prod);
                
                if($num_of_rows==0){
                  echo "<h2>Out of Stock</h2>";
                }
                $count = 0; // Counter to keep track of the number of cards

                echo "<div class='row g-0'>"; // Start the first row

                while($row_data = mysqli_fetch_assoc($result_prod)){
                    
                    $category_id = $row_data['category_id'];


                    echo "<div class='col-md-4 mb-4'>
                            <div class='card' style='width:370px;'>
                        
                                <a href='dashboard.php?edit_category=$category_id' class='btn btn-primary'>Edit</a>
                                <a href='dashboard.php?cat=$category_id' class='btn btn-primary'>Delete</a>
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
            }}
            ?>
        </div>









    <!-- last child -->
    <div class="bg-info text-center">
        <p>All Rights Reserved</p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
