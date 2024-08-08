<?php
include('../includes/connect.php');
if(isset($_POST['insert_brands'])){
  $brands_title=$_POST['brands_title'];

  // select data fro database
  $select_query="Select * from `brands` where brands_title='$brands_title'";
  $result_select=mysqli_query($con,$select_query);
  $number=mysqli_num_rows($result_select);
  if($number>0){
    echo "<script>alert('alredy present')</script>";

}else{
  $insert_query="insert into `brands` (brands_title) values ('$brands_title')";
  $result=mysqli_query($con,$insert_query);
  if($result){
    echo "<script>alert('success')</script>";
  }
}}
?>
<h1 class="text-center">Insert Brands</h1>
<form action="" method="post" class="mb-2 ">
<div class="input-group w-90 mb-2">
  <span class="input-group-text bg-info" 
  id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
 
  <input type="text" class="col-sm-10" 
  name="brands_title" placeholder="Insert Brands" >
</div>

<div class="input-group w-10 mb-2 m-auto">

  <input type="submit" value="Insert Brands"class="bg-info border-0 p-2"
   name="insert_brands" >

</div>


</form>