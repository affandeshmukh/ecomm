<?php

if(isset($_GET['del'])){
    $del_id=$_GET['del'];

    $del_prod="Delete from `product` where product_id=$del_id";
    $result=mysqli_query($con,$del_prod);
    if($result){
        echo "<script>alert('Product Delete successfully')</script>";
        echo "<script>window.open('dashboard.php','_self')</script>"; 
    }
}
?>
<?php

if(isset($_GET['brand'])){
    $del_brand=$_GET['brand'];

    $del_brand="Delete from `brands` where brands_id=$del_brand";
    $result=mysqli_query($con,$del_brand);
    if($result){
        echo "<script>alert('Product Delete successfully')</script>";
        echo "<script>window.open('dashboard.php','_self')</script>"; 
    }
}
?>
<?php

if(isset($_GET['cat'])){
    $cat_id=$_GET['cat'];

    $del_cat="Delete from `category` where category_id=$cat_id";
    $result=mysqli_query($con,$del_cat);
    if($result){
        echo "<script>alert('Product Delete successfully')</script>";
        echo "<script>window.open('dashboard.php','_self')</script>"; 
    }
}
?>