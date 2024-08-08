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
    <title>Document</title>
    <link rel="stylesheet" href="reg.css">
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
<h2>Login</h2>
<div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="user_password" required>
            </div>
            
            <div class="form-group">
                <button type="submit" name="login">Submit</button>
            </div>    
            <h2>Create an account <a href="register.php">Register</a></h2>
    </form>
</body>
</html>
<?php
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];


    // Query to select user by username
    $select_query = "SELECT id,password FROM `boys` ";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);

    // cart items
    if($row_count > 0){
        $_SESSION['id']=$id;
        // Directly compare the input password with the stored password
        if($password == $row_data['password']){
            if($row_count==1 ){
                $_SESSION['id']=$id;
                echo "<script>alert('Login successful');</script>";
                echo "<script>window.open('profile.php','_self')</script>";
            } 
        } else {
            echo "<script>alert('Invalid password');</script>";
        }
    } else {
        echo "<script>alert('Invalid username');</script>";
    }
}
?>
