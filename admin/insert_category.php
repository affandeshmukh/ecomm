<?php
include('../includes/connect.php');
if(isset($_POST['insert_cat'])){
  $category_title=$_POST['cat_title'];


  $select_query="Select * from `category` where category_title='$category_title'";
  $result_select=mysqli_query($con,$select_query);
  $number=mysqli_num_rows($result_select);
  if($number>0){
    echo "<script>alert('alredy present')</script>";

}else{

  $insert_query="insert into `category` (category_title) values ('$category_title')";
  $result=mysqli_query($con,$insert_query);
  if($result){
    echo "<script>alert('success')</script>";
  }}
}
?>
<h1 class="text-center">Insert Category</h1>
<form action="" method="post" class="mb-2">
<div class="input-group w-90 mb-2">
  <span class="input-group-text bg-info" 
  id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
 
  <input type="text" class="form-control" 
  name="cat_title" placeholder="Insert category">
</div>

<div class="input-group w-10 mb-2">

  <input type="submit" value="Insert Category"class="bg-info border-0 p-2"
   name="insert_cat" >

</div>


</form>