<?php
// Ensure the database connection is established
// Example: $con = mysqli_connect("localhost", "username", "password", "database");

if(isset($_GET['edit_brands'])){
    $id = $_GET['edit_brands'];
    // echo $id;
    $get_prod = "SELECT * FROM `brands` WHERE brands_id = $id";
    $result = mysqli_query($con, $get_prod);
    $row = mysqli_fetch_assoc($result);
    $brands_title = $row['brands_title'];
   
}   
?>
<?php
if(isset($_POST['edit'])){
    $brands_title = $_POST['brands_title'];   
  

    $update_prod = "UPDATE `brands` SET brands_title='$brands_title' WHERE brands_id=$id";
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
            <input type="text" id="product_title" value="<?php echo $brands_title ?>" name="brands_title" class="form-control" required>
        </div>
        
        <input type="submit" class="btn btn-info px-3 mb-3" name="edit" value="Edit Product">
    </form>
</div>

<!-- this is for category and above for brans -->
