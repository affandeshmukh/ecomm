<?php 
@session_start();
?>
<?php 
            function category(){
              global $con;
            if(isset($_GET['category'])){
              $category_id=$_GET['category'];
                $select_prod = "SELECT * FROM `product` where category_id='$category_id'";
                $result_prod = mysqli_query($con, $select_prod);

                $num_of_rows=mysqli_num_rows($result_prod);
                
                if($num_of_rows==0){
                  echo "<h2>Out of Stock</h2>";
                }
                $count = 0; // Counter to keep track of the number of cards

                echo "<div class='row g-0'>"; // Start the first row

                while($row_data = mysqli_fetch_assoc($result_prod)){
                    $product_title = $row_data['product_title'];
                    $product_price = $row_data['product_price'];
                    $product_id = $row_data['product_id'];
                    $img = $row_data['img'];


                    echo "<div class='col-md-4 mb-4'>
                            <div class='card' style='width:370px;'><center>
                              <img src='admin/photo/$img' class='card-image' style='width:50%; height:50%;' alt='...'></center>
                              <div class='card-body'><center>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_price</p>
                                <a href='#' class='btn btn-primary'>Add to Cart</a>
                                <a href='#' class='btn btn-primary'>View More</a></center>
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


            function brand(){
              global $con;
            if(isset($_GET['brands'])){
              $brands_id=$_GET['brands'];
                $select_prod = "SELECT * FROM `product` where brands_id='$brands_id'";
                $result_prod = mysqli_query($con, $select_prod);
                $num_of_rows=mysqli_num_rows($result_prod);
                                
                if($num_of_rows==0){
                  echo "<h2>Out of Stock</h2>";
                }
                $count = 0; // Counter to keep track of the number of cards

                echo "<div class='row g-0'>"; // Start the first row

                while($row_data = mysqli_fetch_assoc($result_prod)){
                    $product_title = $row_data['product_title'];
                    $product_price = $row_data['product_price'];
                    $product_id = $row_data['product_id'];
                    $img = $row_data['img'];


                    echo "<div class='col-md-4 mb-4'>
                            <div class='card' style='width:370px;'><center>
                              <img src='admin/photo/$img' class='card-image' style='width:50%; height:50%;' alt='...'></center>
                              <div class='card-body'><center>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_price</p>
                                <a href='#' class='btn btn-primary'>Add to Cart</a>
                                <a href='#' class='btn btn-primary'>View More</a></center>
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
            function getIPAddress() {  
              //whether ip is from the share internet  
               if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                          $ip = $_SERVER['HTTP_CLIENT_IP'];  
                  }  
              //whether ip is from the proxy  
              elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                          $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
               }  
          //whether ip is from the remote address  
              else{  
                       $ip = $_SERVER['REMOTE_ADDR'];  
               }  
               return $ip;  
          }  

          // $ip = getIPAddress();  

          // cart function
          function cart(){
            global $con;
        
            if(isset($_GET['add-to-cart'])) {   
               $get_ip_add = getIPAddress();
                $get_product_id = $_GET['add-to-cart'];
        
                // Fetch the product title 
                $select_product = "SELECT * FROM product WHERE product_id = $get_product_id";
                $result_product = mysqli_query($con, $select_product);
        
                if(mysqli_num_rows($result_product) > 0){
                    $row = mysqli_fetch_assoc($result_product);
                    $product_title = $row['product_title'];
                    $img= $row['img'];

        
                    $select_query = "SELECT * FROM `cart_info` WHERE ip_address='$get_ip_add' AND product_id=$get_product_id";
                    $result_query = mysqli_query($con, $select_query);
                    $num_of_rows = mysqli_num_rows($result_query);
        
                    if ($num_of_rows > 0) {
                        echo "<script>alert('This item is already in the cart')</script>";
                        echo "<script>window.open('index.php','_self')</script>";
                    } else {
                        $insert_query = "INSERT INTO `cart_info` (product_id, quantity, ip_address, product_title,img)
                                         VALUES ($get_product_id, 1, '$get_ip_add', '$product_title','$img')";
                        $result_query = mysqli_query($con, $insert_query);
        
                        if ($result_query) {
                            echo "<script>alert('Item is added to cart')</script>";
                        } else {
                            echo "<script>alert('Failed to add item to cart')</script>";
                        }
                        echo "<script>window.open('index.php','_self')</script>";
                    }
                } else {
                    echo "<script>alert('Product not found')</script>";
                    echo "<script>window.open('index.php','_self')</script>";
                }
            }
        }
        

          function cart_item(){
            if (isset($_GET['add-to-cart'])) {
              global $con;
                // Assuming getIPAddress() is defined somewhere else
                $get_ip_add = getIPAddress();
                $get_product_id = $_GET['add-to-cart'];
                $select_query = "SELECT * FROM `cart_info` WHERE ip_address='$get_ip_add' ";
                $result_query = mysqli_query($con, $select_query);
                $count_cart_item = mysqli_num_rows($result_query);
            }else {
                  global $con;
                  // Assuming getIPAddress() is defined somewhere else
                  $get_ip_add = getIPAddress();
                  $select_query = "SELECT * FROM `cart_info` WHERE ip_address='$get_ip_add' ";
                  $result_query = mysqli_query($con, $select_query);
                  $count_cart_item = mysqli_num_rows($result_query);
                }
                echo $count_cart_item;
              }


  //  function total_cart_price()
  //   {
  //     global $con;
  //     $get_ip_add = getIPAddress();
  //     $total=0;
  //     $select_query = "SELECT * FROM `cart_info` WHERE ip_address='$get_ip_add' ";
  //     $result_query = mysqli_query($con, $select_query);
  //     while($row=mysqli_fetch_array($result_query)){
  //       $product_id = $row[ 'product_id'];
  //       $select_product= "SELECT * FROM `product` WHERE product_id='$product_id'";
  //       $result_product = mysqli_query($con, $select_product);
  //       while($row_price=mysqli_fetch_array($result_product)){
  //         $product_price=array($row_price['product_price']);
  //         $product_values=array_sum($product_price);
  //         $total+=$product_values;
  //     }
  //   }
  //   echo $total;}

  
  function total_cart_price(){
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
              $quantity = $row['quantity']; // Assuming you have 'quantity' field in cart_info

              $product_total = $product_price * $quantity;
              $total += $product_total;

          }}}  echo $total; }
      # code...
            ?>