<?php
// Ensure the database connection is established
// Example: $con = mysqli_connect("localhost", "username", "password", "database");

if(isset($_GET['edit_prod'])){
    $id = $_GET['edit_prod'];
    echo $id;
    $get_prod = "SELECT * FROM `product` WHERE product_id = $id";
    $result = mysqli_query($con, $get_prod);
    $row = mysqli_fetch_assoc($result);
    $product_title = $row['product_title'];
    $img = $row['img'];
    $product_price = $row['product_price'];
    $product_keywords = $row['product_keywords'];
}   
?>

<?php 
$prod = "SELECT * FROM `category`";
$result_cat = mysqli_query($con, $prod);
$category_options = '';
while($row_cat = mysqli_fetch_assoc($result_cat)) {
    $category_id = $row_cat['category_id'];
    $category_title = $row_cat['category_title'];
    $category_options .= "<option value='$category_id'>$category_title</option>";
}
?>

<?php
if(isset($_POST['edit'])){
    $product_title = $_POST['product_title'];   
    $product_price = $_POST['product_price'];
    $product_keywords = $_POST['product_keywords'];
    $img = $row['img'];

    if(isset($_FILES['img']['name']) && $_FILES['img']['name'] != '') {
        $img = $_FILES['img']['name'];
        $temp_img = $_FILES['img']['tmp_name'];
        move_uploaded_file($temp_img, "photo/$img");
    }

    $update_prod = "UPDATE `product` SET product_title='$product_title', 
    img='$img', product_price='$product_price', 
    product_keywords='$product_keywords', date=NOW() WHERE product_id=$id";
    $result_update = mysqli_query($con, $update_prod);
    if($result_update){
        echo "<script>alert('Product Updated successfully')</script>";
        echo "<script>window.open('dashboard.php','_self')</script>";
    } else {
        echo "<script>alert('Product Update failed')</script>";
    }
}
?>

<div class="container mt-5">
    <h1 class="text-center">Edit Product</h1>
    <form action="" method="post" enctype="multipart/form-data">

        <!-- title -->
        <div class="form-outline w-50 m-auto">
            <label for="product_title" class="form-label">Product Title</label>
            <input type="text" id="product_title" value="<?php echo $product_title ?>" name="product_title" class="form-control" required>
        </div>
        <!-- image -->
        <div class="form-outline w-50 m-auto">
            <label for="img" class="form-label">Image</label>
            <input type="file" id="img" name="img" class="form-control">
        </div>
        <!-- category -->
        <div class="form-outline w-50 m-auto">
            <label for="category_id" class="form-label">Category</label>
            <select id="category_id" name="category_id" class="form-control">
                <?php echo $category_options; ?>
            </select>
        </div>
        <!-- price -->
        <div class="form-outline w-50 m-auto">
            <label for="product_price" class="form-label">Price</label>
            <input type="text" id="product_price" value="<?php echo $product_price ?>" name="product_price" class="form-control" required>
        </div>
        <!-- keywords -->
        <div class="form-outline w-50 m-auto">
            <label for="product_keywords" class="form-label">Product Keywords</label>
            <input type="text" id="product_keywords" value="<?php echo $product_keywords ?>" name="product_keywords" class="form-control" required>
        </div>
        <input type="submit" class="btn btn-info px-3 mb-3" name="edit" value="Edit Product">
    </form>
</div>
