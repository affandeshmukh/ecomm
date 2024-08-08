<?php 
include('../includes/connect.php');
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta username="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="reg.css">
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
<h2>Login</h2>
<div class="form-group">
                <label for="username">username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <div class="form-group">
                <button type="submit" name="login">Submit</button>
            </div>    
            <h2>Create an account <a href="register.php">Register</a></h2>
    </form>
</body>
</html>

<?php
// login.php


// Assuming you are using POST method for login form submission
$username = $_POST['username']??'';
$password = $_POST['password']??'';

// Prepare and execute the query to check credentials
$stmt = $con->prepare("SELECT  id, password FROM boys WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($user_id, $stored_password);
    $stmt->fetch();

    // Verify password
    if ($password === $stored_password) {
        // Password is correct, set session variable and redirect
        $_SESSION['id'] = $user_id;

        // Redirect based on user ID
        header("Location: " . $user_id . ".php");
        exit();
    } else {
        echo "Invalid password.";
    }
} else {
    echo "No user found with that username.";
}

$stmt->close();
$con->close();
?>

