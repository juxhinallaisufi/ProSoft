<?php

/*
$server = "localhost";
$user = "root";
$pass = "";
$database = "accounts";
*/
$conn= mysqli_connect("localhost","root","","accounts");

if (!$conn) {
    die("<script>alert('Connection Failed)</script>");
    
}
?>