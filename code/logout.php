<?php

include 'config.php';
session_start();
session_destroy();

if(!isset($_SESSION['firstname'] , $_SESSION['lastname'], $_SESSION['email'])){
    header("Location: login.php");
}
$email=$_SESSION['email'];
$sql ="UPDATE user SET Status='Inactive' WHERE Email='$email'";
$result = mysqli_query($conn, $sql);

header("Location: login.php");
?>