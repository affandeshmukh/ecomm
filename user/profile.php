<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <style>
        .delete-account {
            color: white;
            background-color: red;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

             
/* edit */
        .edit-account {
            color: white;
            background-color: blue;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        

      
    </style><?php
    if(!isset($_SESSION['username'])){
                            echo "

                        ";
                        }else {
                            echo "";}
    
    
include('../includes/connect.php');
include('../function/function.php');
?>

</head>
<body>
<?php                   
           if(!isset($_SESSION['username'])){
                            echo "
                            <h1>Login Or Register First </h1>
                            <button><a  href='login.php'>login</a></button>
                            <button><a  href='register.php'>Register    </a></button>

                        ";
                        }else {
                            echo "
                            <div class='container'>
                <div class='box'>
            <ul></br></br>
            <a href='../index' style='margin-top:200px;'><h1>Home</h1></a>  <br>  
            <a href='my_order'><h1>My Orders</h1></a>       
   
            <link rel='stylesheet' href='profile.css'>  ";
                        }
                        ?>      
    </ul>
</div>

<?php
$username=$_SESSION['username'];
$select ="SELECT * FROM `user` where username='$username' ";
$result=mysqli_query($con,$select);
while($row_data = mysqli_fetch_assoc($result)){
    $user_id = $row_data['user_id'];
    $username = $row_data['username'];
    $user_email=$row_data['user_email'];
    $user_address=$row_data['user_address'];
    $user_mobile=$row_data['user_mobile'];
    // $product_price = $row_data['product_price'];
    // $product_id = $row_data['product_id'];
    // $img = $row_data['img'];
}            
if(!isset($_SESSION['username'])){
                 echo "
                

             ";
             }else {
             
               
             echo "
        <div class='About'>
            <ul>
                <h3>Name</h3>
                $username
            </ul>

            <ul>
            <h3>Gmail</h3>
            <li> $user_email</li>
        </ul<br>
            <ul>
                <h3>Address</h3>
                <li>$user_address</li>
            </ul>
            <ul>
            <h3>Mobile Number</h3>
            <li>$user_mobile</li>
        </ul>
        <br><a href='editaccount' class='edit-account'>Edit Account</a>
        <a href='del_account?del=$user_id' class='delete-account' onclick='return confirmDelete()'>Delete  Account</a>
        </div>
    </div>";}
    ?>
    <script>
function confirmDelete() {
    return confirm("Are you sure you want to delete this account?");
}
</script>

</body>
</html>
