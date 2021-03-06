

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="with=device-width, initial-scale=1.0">
    <title>HELP ME!</title>
    <link rel="stylesheet" href="./css/frontPage.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Changa:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <section class="header">
        <nav>
            <a href="frontPage.php"><img src='./images/logo2.png'></a>
            <div class="nav-links" id="navLinks">
                <i class="fa fa-times" onclick="hideMenu()"></i>
                <ul>
                    <li><a href="#about_us"> ABOUT US </a></li>
                    <li><a href="#features"> FEATURES </a></li>
                    <li><a href="#reviews"> REVIEWS </a></li>
                    <li><a id="login" href="login.php"> LOG IN </a></li>
                    <li><a href="#contact"> CONTACT US</a></li>
                </ul>

            </div>
            <i class="fa fa-bars" onclick="showMenu()"></i>
        </nav>

    <div class="text-box">
        <h1>HELP OTHERS , GET PAID</h1>
        <p>"Coming together is a beginning, <br/><br/>staying together is progress,<br/><br/> and working together is success."</p>
        <p>- HENRY FORD -</p>
        <a href="#register" class="hero-btn"> SIGN IN</a>
    </div>

    </section>


<section class= "info">
    <h1 id="about_us">ABOUT US</h1>
    <p>This idea was born by a group of students from the University of EPOKA - Albania as a project idea.<br/>
       The idea took of and we arrived where we are today. This project keeps evolving until this day.<br/>
       This idea tends to make people collaborate with one another and solve problems in exhange of monetary value.</p>
    
    <div class="row">

        <div class="info-col">
            <h3>SERVICES</h3>
            <p> User can create services with its own interests and assign a price to it. Other interested users 
                can apply for the service, complete it and recieve the payment. Services can vary depending on 
                what the user needs. Services need to be completed inside a limited timeframe. Both sides 
                will need to cooperate with one another so they can get the service <b>completed</b>. </p>
        </div>

        <div class="info-col">
            <h3>JOBS</h3>
            <p> Unlike services , Jobs can hire people for the positions they offer <b>permanently</b>. 
                The job may be offered by anyone including companies or users . Users will be able to 
                see the information that the job offers , including the monthly payment or even the location.
                After applying , the user will have to wait for a response from the creator of the job.</p>
        </div>
        <div class="info-col">
            <h3>PAYMENT</h3>
            <p> There are a total of 2 ways of paying in our application : cash or (credit/debit) . The user 
                is not obliged to input his card payment information if he wants to procceed and use the app 
                with cash payment in the future. If the user wants to use credit/debit card they need to insert
                their information. Payments through cards will be automated meanwhile the cash payments will be
                completed through users.</p>
        </div>
    </div>

</section>

<section class="pics">
    <h1>PROCESS</h1>

    <div class="row">

        <div class="pics-col">
            <img src="images/create.png">
            <div class="layer">
                <h3>CREATE</h3>
            </div>
        </div>

        <div class="pics-col">
            <img src="images/apply.png">
            <div class="layer">
                <h3>APPLY</h3>
            </div>
        </div>

        <div class="pics-col">
            <img src="images/get_paid.png">
            <div class="layer">
                <h3>GET PAID</h3>
            </div>
        </div>

    </div>

</section>

<section class="features">
    <h1 id="features">FEATURES</h1>
    <p>Our website was developed with new ideas which separates us from the rest .</p>

    <div class="row">

        <div class="features-col">

            <img src="images/completed.png" style="margin-top: 14%;">
            <h3 style="margin-top: 14%;">REQUEST COMPLETION</h3>
            <p>The button Request Completion is implemented so both pairs work together in order 
               for their service to be completed . If one or another pair have a problem , they 
               need to solve it together . If they go in through a problem which is far bigger than
               they can handle then the problem goes through our other feature .
            </p>
        </div>

        <div class="features-col">
            <img src="images/security.png">
            <h3>SECURITY</h3>
            <p>When you register it is absolutely neccessary for you to input a phone number and
                email. The phone number will help us in the future in case that something which 
                is beyond our authority happens. The number gets identified and authorities with 
                higher power deal with the case.
            </p>
        </div>

        <div class="features-col">
            <img src="images/interface.png" style="margin-top: 20%;">
            <h3 style="margin-top: 16%;">INTERFACE</h3>
            <p>We made sure that our website stays simplistic and easy to use with its components.
                There is no way to get lost and every information is made clear. Even if you are 
                finding difficulty on our site , you can contact our support team which will be there
                to help you .
            </p>
        </div>

    </div>


</section>


<section class="feedbacks">
    <h3 id="reviews">REVIEWS</h3>
    <p>We accept advice and criticism in order to put all that feedback into a better website and interface :)</p>

       <div class="row">

            <div class="feedback-col">
                <img src="images/review1.jpg">
                <div>
                    <p>Melina_123</p>
                    <h3>I created a service beacause I was in a really big rush and I could not find the 
                        time to finish my grocerie shopping. I was really surprised to see that many people
                        applied to complete my service. I picked one and the service was completed almost 
                        imidiately. I even gave a tip to the guy. Thank u for this amazing website.
                    </h3>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-o"></i>
                </div>
            </div>

            <div class="feedback-col">
                <img src="images/review2.jpg">
                <div>
                    <p>William_not_shakespeare</p>
                    <h3>I was in despreate need of money until I found this website which 
                        one of my friends recomended to me. I was surprised to know that 
                        soooo many people needed services to be completed. I took one then
                         another , then another and  now i found a really good way to earn
                         some income. Thank you !
                    </h3>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half-o"></i>
                </div>
            </div>
 
        </div>

</section>


<?php 

include 'config.php';

error_reporting(0);

session_start();

if(isset($_SESSION['firstname'],$_SESSION['lastname'] ,$_SESSION['email'])){
    header("Location: login.php");
}

if (isset($_POST['submit'])) {
	$firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
	$email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
	$password = md5($_POST['password']);
	$confirmpassword = md5($_POST['confirmpassword']);

	if ($password == $confirmpassword) {
		$sql = "SELECT * FROM user WHERE Email='$email'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {
            $sql = "SELECT * FROM user WHERE Phone_Nr='$phonenumber'";
            $result = mysqli_query($conn, $sql);
            if (!$result->num_rows > 0) {

            
			$sql = "INSERT INTO `user` (`Last_Name`, `First_Name`, `Email`, `Phone_Nr`, `ID`, `Password`, `Status`, `Bio`, `Joined_date`) VALUES ( '$lastname','$firstname','$email','$phonenumber',NULL,'$password' ,'Inactive',NULL, current_time())";
			$result = mysqli_query($conn, $sql);
			if ($result) {
				echo "<script>alert('Wow! User Registration Completed.')</script>";
				$firstname = "";
				$lastname = "";
                $email = "";
                $phonenumber = "";
				$_POST['password'] = "";
				$_POST['confirmpassword'] = "";
			} else {
				echo "<script>alert('Woops! Something Went Wrong.')</script>";
                $firstname = "";
				$lastname = "";
                $email = "";
                $phonenumber = "";
				$_POST['password'] = "";
				$_POST['confirmpassword'] = "";
			}
        } else {
			echo "<script>alert('Woops! Phone number already exists')</script>";
		}

		} else {
			echo "<script>alert('Woops! Email Already Exists.')</script>";
		}
		
	} else {
		echo "<script>alert('Password Not Matched.')</script>";
	}
}

?>
<div class="container">
    <form action="" method="POST" id="register" class="login-email">


        <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>

        <div class="input-group">
            <input type="text" placeholder="First Name" name="firstname" value="<?php echo $firstname; ?>" required>
        </div>

        <div class="input-group">
            <input type="text" placeholder="Last Name" name="lastname" value="<?php echo $lastname; ?>" required>
        </div>

        <div class="input-group">
            <input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
        </div>

          <div class="input-group">
            <input type="number" placeholder="Phone Number" name="phonenumber" value="<?php echo $phonenumber; ?>" required>
        </div>

        <div class="input-group">
            <input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
        </div>

        <div class="input-group">
            <input type="password" placeholder="Confirm Password" name="confirmpassword" value="<?php echo $_POST['confirmpassword']; ?>" required>
        </div>

        <div class="input-group">
            <button name="submit" class="btn">Register</button>
        </div>

        <p class="login-register-text">Have an account? <a href="login.php">Login Here</a>.</p>

    </form>
</div> 

<section class="footer">
    <h4 id="contact">CONTACT US</h4>

    <div class="icons">
        <i class="fa fa-3x fa-facebook"></i>
        <i class="fa fa-3x fa-twitter"></i>
        <i class="fa fa-3x fa-instagram"></i>
        <i class="fa fa-3x fa-linkedin"></i>
    </div>
    <p>Made  with  <i class="fa fa-heart-o"></i> from Epoka Students </p>

</section>


<!-- Toggle menu -->

<script>

    var navLinks = document.getElementById("navLinks");

    function showMenu(){
        navLinks.style.right = "0";
    }

    function hideMenu(){
        navLinks.style.right = "-200px";
    }

</script>



</body>
</html>