<?php
include('../includes/connect.php');

if(isset($_POST['prod_sub'])){
    $product_title = $_POST['product_title'];
    $product_price = $_POST['product_price'];
    $product_keywords = $_POST['product_keywords'];
    $product_cat = $_POST['product_cat'];
    $product_brands = $_POST['product_brands']; 
    $img = $_POST['img'];  

   


    // File upload handling
    // if(isset($_FILES['img'])) {
    //     $img = $_FILES['img']['name'];
    //     $temp_img = $_FILES['img']['tmp_name'];
    //     move_uploaded_file($temp_img, "./photo/$img");
    // }

    // Check if product already exists
    $select_query = "SELECT * FROM `product` WHERE product_title='$product_title'";
    $result_select = mysqli_query($con, $select_query);
    $number = mysqli_num_rows($result_select);

    if($number > 0){
        echo "<script>alert('Product already exists')</script>";
    } else {
        // Insert new product
        $insert_query = "INSERT INTO `product` (product_title, img,category_id,brands_id,product_price, product_keywords,date,status) VALUES 
        ('$product_title', '$img','$product_cat','$product_brands', '$product_price', '$product_keywords',NOW(),true)";
        $result = mysqli_query($con, $insert_query);
        if($result){
            echo "<script>alert('Product added successfully')</script>";
            echo "<script>window.open('dashboard.php?insert','_self')</script>";

        } else {
            echo "<script>alert('Failed to add product')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic Form</title>
</head>
<body>
    <h1>Product Form</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" id="title" name="product_title" required><br><br>

        <label for="Image">Image:</label>

        <input type="text" name="img" required><br><br>
        <select name="product_cat">
    <option value="">Select Category</option>
    <?php
    $select_query="Select * from category";
    $result_cat=mysqli_query($con,$select_query);
    while($row=mysqli_fetch_assoc($result_cat)){
        $category_title=$row['category_title'];
        $category_id=$row['category_id'];
        echo "    <option value='$category_id' >$category_title</option>";
    }
?> </select>

<select name="product_brands">
    <option value="">Select Category</option>
    <?php
    $select_query="Select * from brands";
    $result_brands=mysqli_query($con,$select_query);
    while($row=mysqli_fetch_assoc($result_brands)){
        $brands_title=$row['brands_title'];
        $brands_id=$row['brands_id'];
        echo "    <option value='$brands_id' >$brands_title</option>";
    }
?> </select>
        <label for="price">Price:</label>
        <input type="number" id="price" name="product_price" step="0.01" required><br><br>
        
        <label for="keywords">Keywords:</label>
        <input type="text" id="keywords" name="product_keywords" required><br><br>
        
        <input type="submit" name="prod_sub" value="Submit">
    </form>
</body>
</html>
