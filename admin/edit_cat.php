<?php
// Ensure the database connection is established
// Example: $con = mysqli_connect("localhost", "username", "password", "database");

if(isset($_GET['edit_category'])){
    $idd = $_GET['edit_category'];
    echo $idd;
    $get_prod = "SELECT * FROM `category` WHERE category_id = $idd";
    $result = mysqli_query($con, $get_prod);
    $row = mysqli_fetch_assoc($result);
    $category_title= $row['category_title'];
   
}   
?>
<?php
if(isset($_POST['edit'])){
    $category_title = $_POST['category_title'];   
  

    $update_prod = "UPDATE `category` SET category_title='$category_title' WHERE category_id=$idd";
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
            <input type="text" id="product_title" value="<?php echo $category_title ?>" name="category_title" class="form-control" required>
        </div>
        
        <input type="submit" class="btn btn-info px-3 mb-3" name="edit" value="Edit Product">
    </form>
</div>

