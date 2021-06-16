
<?php


include 'config.php';
error_reporting(0);
session_start();

if(!isset($_SESSION['firstname'] , $_SESSION['lastname'], $_SESSION['email'])){
    header("Location: login.php");
}

$email=$_SESSION['email'];

$sql = "SELECT First_Name FROM `user` WHERE Email='$email'";
$firstname = mysqli_fetch_array(mysqli_query($conn,$sql))['First_Name'];

$sql = "SELECT Last_Name FROM `user` WHERE Email='$email'";
$lastname = mysqli_fetch_array(mysqli_query($conn,$sql))['Last_Name'];

$sql = "SELECT Phone_Nr FROM `user` WHERE Email='$email'";
$phonenumber = mysqli_fetch_array(mysqli_query($conn,$sql))['Phone_Nr'];

$sql = "SELECT Password FROM `user` WHERE Email='$email'";
$password = mysqli_fetch_array(mysqli_query($conn,$sql))['Password'];

$sql = "SELECT Bio FROM `user` WHERE Email='$email'";
$bio = mysqli_fetch_array(mysqli_query($conn,$sql))['Bio'];

$sql = "SELECT ID FROM `user` WHERE Email='$email'";
$id = mysqli_fetch_array(mysqli_query($conn,$sql))['ID'];

$if_em=$email;
$if_pas=$password;

if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $password =  md5($_POST['password']);
    $confirmpassword = md5($_POST['confirmpassword']);
    $bio = $_POST['bio'];
    
    if($firstname === NULL || $lastname === NULL || $email === NULL || $phonenumber == NULL){
        echo "<script>alert('All inputs except Bio , can't be left empty.')</script>";
    }else{
        $sql = "SELECT * FROM user WHERE Email='$email' and ID<>'$id'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {
            $sql = "SELECT * FROM user WHERE Phone_Nr='$phonenumber' and ID<>'$id'";
            $result = mysqli_query($conn, $sql);
            if (!$result->num_rows > 0) {

                if ($password == $confirmpassword) {
                $sql = "UPDATE user SET First_Name='$firstname' , Last_Name='$lastname' , Email='$email' , Phone_Nr='$phonenumber' , Bio='$bio' WHERE ID='$id'";
                $result = mysqli_query($conn, $sql);
                if ($result) {

                    if($if_pas !== $password){
                        $sql = "UPDATE user SET Password='$password' WHERE ID='$id'";
                        $result = mysqli_query($conn, $sql);
                    }

                    if($if_em!==$_POST['email'] || $if_pas!==md5($_POST['password'])){

                        echo "<script>alert('Your Credentials changed . Please log in again !'); document.location='logout.php'</script>";

                    }

                    echo "<script>alert('Your Profile information got changed. Thank you !'); document.location='profileEdit.php'</script>";

                } else {
                echo "<script>alert('Woops! Something Went Wrong.')</script>";
                }

                }else{
                    echo "<script>alert('Passwords do not match !')</script>";
                }
                
                
            }else {
                echo "<script>alert('This number is already connected to our site. Please insert another number.')</script>";
              }
        }else {
            echo "<script>alert('This email is already connected to our site. Please insert another email.')</script>";
          }
        }
    }


if (isset($_POST['info'])) {
    $card_number = $_POST['card_number'];
    $cvv = $_POST['cvv'];
    $mm = $_POST['mm'];
    $yy = $_POST['yy'];
    
    if($card_number == NULL || $cvv == NULL || $mm === NULL || $yy == NULL){
        echo "<script>alert('Inputs can not be empty.')</script>";
    }else{
        $sql = "SELECT * FROM credit_debit WHERE Card_Number='$card_number' and ID<>'$id'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {
            
                $sql = "SELECT * FROM credit_debit WHERE ID='$id' and Card_Number is not NULL";
                $result = mysqli_query($conn, $sql);
                if ($result->num_rows > 0){

                $sql = "UPDATE credit_debit SET Card_Number='$card_number' , CVV_CV2='$cvv' , MM='$mm' , YY='$yy' WHERE ID='$id'";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                echo "<script>alert('Your Profile information got changed. Thank you !'); document.location='profileEdit.php'</script>";

                } else {
                echo "<script>alert('Woops! Something Went Wrong.')</script>";
                }
            }else{
                $sql = "INSERT INTO `credit_debit` (`ID` , `Card_Number` , `CVV_CV2` , `MM` ,`YY`) VALUES ('$id', '$card_number', '$cvv' , '$mm' ,'$yy')";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                echo "<script>alert('Your Profile information got changed. Thank you !!!'); document.location='profileEdit.php'</script>";
                }
            
            else{
                echo "<script>alert('Woops! Something Went Wrong..')</script>";
                }
            
            
            }
        }else {
            echo "<script>alert('This card is already connected to our site. Please insert another card.')</script>";
          }
        }
    }

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/profileEditStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&family=Roboto:wght@300&display=swap"
        rel="stylesheet">
    <title>Profile</title>
</head>

<body>
    <div class="container">
        <div class="leftbox">
            <nav>

            <a href="./main.php" class="tab">
                    <i class="fas fa-home"></i>
</a>

                <a onclick="tabs(0)" class="tab active">
                    <i class="fas fa-user"></i>
                </a>
                <a onclick="tabs(1)" class="tab">
                    <i class="far fa-credit-card"></i>
                </a>
            </nav>
        </div>
    
        <div class="rightbox">
        <form action="" method="POST">
            <div class="profile showtab">
                <h1>Personal Info</h1>
                <h2>First Name</h2>
                <input type="text" class="input" name="firstname" value="<?php echo $firstname; ?>" required>

                <h2>Last Name</h2>
                <input type="text" class="input" name="lastname" value="<?php echo $lastname; ?>" required>

                <h2>Email</h2>
                <input type="email" class="input" name="email" value="<?php echo $email; ?>" required>

                <h2>Phone Number</h2>
                <input type="number" class="input" name="phonenumber" value="<?php echo $phonenumber; ?>" id="phone" required>

                <h2>Change Password</h2>
                <input type="password" class="input" name="password" value="<?php echo $_POST['password']; ?>">

                <h2>Confirm Password</h2>
                <input type="password" class="input" name="confirmpassword" value="<?php echo $_POST['confirmpassword']; ?>">

                <h2>Bio</h2>
                <input type="text" class="input" name="bio" value="<?php echo $bio; ?>">
                <button class="btn" name="submit">Save Changes</button>

            </div>
        </form>


        <form action="" method="POST">
            <div class="payment showtab">
                <h1>CREDIT/DEBIT CARD</h1>
                <h2>CARD NUMBER</h2>
                <input type="number" class="input" id="num" name="card_number" value="<?php echo $card_number; ?>" min="0000000000000001" max="9999999999999999">
                <h2>CVV_CV2</h2>
                <input type="number" class="input" id="num" name="cvv" value="<?php echo $cvv; ?>" min="001" max="999" required>
                <h2>MM</h2>
                <input type="number" class="input" id="num" name="mm" value="<?php echo $mm; ?>" min="01" max="12" required>
                <h2>YY</h2>
                <input type="number" class="input" name="yy" id="num" value="<?php echo $yy; ?>" min="01" max="99" required>
                
                <button class="btn" name="info">Save Card</button>
            </div>
        </form>

        </div>

    </div>
    <script>
        const tabBtn = document.querySelectorAll(".tab");
        const tab = document.querySelectorAll(".showtab");

        function tabs(panelIndex) {
            tab.forEach(function (node) {
                node.style.display = "none";
            });
            tab[panelIndex].style.display = "block";
        }
        tabs(0)
    </script>
    <script>
        $(".tab").click(function () {
            $(this).addClass("active").siblings().removeClass("active")
        })
    </script>

        

</body>

</html>