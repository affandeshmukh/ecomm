<?php 
include('../includes/connect.php');
include('../function/function.php');
@session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>payment</title>
   <style>
a:link, a:visited {
  background-color: rgb(198, 212, 0);
  color: white;
  padding: 14px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  border:round;
}

a:hover, a:active {
  background-color: rgb(198, 212, 0);
    border:round;

}
</style>
</head>
<?php 

$user_ip = getIPAddress();
$get_user="Select * from `user` where user_ip='$user_ip'";
$result=mysqli_query($con,$get_user);
$run_query=mysqli_fetch_array($result);
// $user_id=$run_query['user_id'];

$username = $_SESSION['username'];

$select_user_id = "SELECT * FROM user WHERE username = '$username'";
                $result_user_id = mysqli_query($con, $select_user_id);

                if(mysqli_num_rows($result_user_id) > 0){
                    $row = mysqli_fetch_assoc($result_user_id);
                    $user_id = $row['user_id'];
                    $user_add = $row['user_address'];

                  }

?>
<body>
<center>
<h1> Your Payment Method</h1>
    <div class="container">
        <div class="text-center text-info">
            <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-6">
                <!-- <a href="https://paytm.com" target="_blank">Pay online</a> -->
            </div></div>
            <div class="col-md-6">
               <center> <a href="order?user_id=<?php echo $user_id?>">
                <h2 >Pay on Delivery</h2>    </a></center>
               
            </div>
            <div class="col-md-6">
               <center> <a href="online.php">
                <h2 >Pay online </h2>    </a></center>
               
            </div>
        </div>
    </div>
</body>
</html>