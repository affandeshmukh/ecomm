<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <style>
        input[type=button], input[type=submit], input[type=reset] {
            background-color: rgb(255, 251, 0);
            border: none;
            color: black;
            padding: 16px 32px;
            text-decoration: none;
            margin: 4px 2px;
            cursor: pointer;
        }
    </style>
</head>
<?php
include('../includes/connect.php');
include('../function/function.php');

$username = $_SESSION['username'];

$select_user_id = "SELECT * FROM user WHERE username = '$username'";
$result_user_id = mysqli_query($con, $select_user_id);

if (mysqli_num_rows($result_user_id) > 0) {
    $row = mysqli_fetch_assoc($result_user_id);
    $user_id = $row['user_id'];
}

$get_prod = "SELECT * FROM `user` WHERE user_id = $user_id";
$result = mysqli_query($con, $get_prod);
$row = mysqli_fetch_assoc($result);
$username = $row['username'];
$user_email = $row['user_email'];
$user_address = $row['user_address'];
$user_mobile = $row['user_mobile'];
?>

<?php
if (isset($_POST['edit'])) {
    $username = $_POST['username'];
    $user_address = $_POST['user_address'];

        $update_prod = "UPDATE `user` SET username='$username', user_address='$user_address' WHERE user_id=$user_id";
        $result_update = mysqli_query($con, $update_prod);

        if ($result_update) {
            echo "<script>alert('Account update successfully');</script>";
            echo "<script>window.open('log.php', '_self');</script>";
        } else {
            echo "<script>alert('Account update failed');</script>";
        }
    
}
?>

<div class="container mt-5">
    <center>
        <h1 class="text-center">Edit Account Information</h1>
        <h3>If you update your Information then you need to log in again.</h3>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-outline w-50 m-auto">
                <h2 for="product_title" class="form-label">Username</h2>
                <input type="text" id="product_title" value="<?php echo $username ?>" name="username" class="form-control" required>
            </div>
            <div class="form-outline w-50 m-auto">
                <h2 for="product_keywords" class="form-label">Address</h2>
                <input type="text" id="product_keywords" value="<?php echo $user_address ?>" name="user_address" class="form-control" required>
            </div>           
            <input type="submit" class="btn btn-info px-3 mb-3" name="edit" value="Edit Product">
        </form>
    </center>
</div>
