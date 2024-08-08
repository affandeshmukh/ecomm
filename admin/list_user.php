<?php
include('../includes/connect.php');

$select="Select * from `user`";
$query=mysqli_query($con,$select);
while($row = mysqli_fetch_assoc($query)){
$user_id=$row['user_id'];
$username=$row['username'];
$mail=$row['user_email'];
$password=$row['user_password'];
$address=$row['user_address'];
$mobile=$row['user_mobile'];
$colony=$row['colony'];




echo $user_id; 
    echo $username;
    echo $mail; 
    echo $password; 
    echo $address ;
    echo $mobile;
    echo $colony;


 }

?>