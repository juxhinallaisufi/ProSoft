<?php 

include 'config.php';

session_start();

error_reporting(0);

if(isset($_SESSION['firstname'] , $_SESSION['lastname'],$_SESSION['email'])) {
    header("Location: main.php");
}

$sql = "SELECT Status FROM `user` WHERE Email='$email'";
$status = mysqli_fetch_array(mysqli_query($conn,$sql))['Status'];

if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = md5($_POST['password']);

	$sql ="SELECT * FROM user WHERE Email='$email' AND Password='$password'";
	$result = mysqli_query($conn, $sql);
	if($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
        $sql ="UPDATE user SET Status='Active' WHERE Email='$email'";
	    $result = mysqli_query($conn, $sql);
		$_SESSION['firstname'] = $row['First_Name'];
        $_SESSION['lastname'] = $row['Last_Name'];
        $_SESSION['email'] = $row['Email'];
		header("Location: main.php");
	} else {
		echo "<script>alert('Woops! Email or Password is Wrong.')</script>";
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/loginStyle.css">
    <title>Login</title>
</head>
<body>
    <form method="POST" action="">

    <div class="login-box">
        <h1>Login</h1>
        
        <div class="textbox">
            <i class="fas fa-user"></i>
            <input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
        </div>

        <div class="textbox">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>">
        </div>
        <label><a href="frontPage.php">Don't have an account? Register now!</a></label>
        <button  name="submit" class="btn" >LOG IN</button>
    </div>
</form>
</body>
</html>
