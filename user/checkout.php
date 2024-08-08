<?php
session_start();
if(!isset($_SESSION['username'])){
    include('login.php');

}else{
    include('payment.php');
}

?>