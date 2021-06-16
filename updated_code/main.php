<?php


include 'config.php';
error_reporting(0);
session_start();

if(!isset($_SESSION['firstname'] , $_SESSION['lastname'], $_SESSION['email'])){
    header("Location: login.php");
}

$email=$_SESSION['email'];

$sql = "SELECT ID FROM `user` WHERE Email='$email'";
$id = mysqli_fetch_array(mysqli_query($conn,$sql))['ID'];

$sql = "SELECT * FROM `service`ORDER BY Time_created DESC";
$result = mysqli_query( $conn, $sql );
$sr = array();
while( $row = mysqli_fetch_array( $result, MYSQLI_ASSOC ) ) {
    array_push( $sr, $row );
}


$sql = "SELECT user.ID,`Service_ID`,`First_Name`,`Last_Name`FROM `user`,`service` WHERE user.ID=service.ID ORDER BY Time_created DESC";
$result = mysqli_query( $conn, $sql );
$name = array();
while( $row = mysqli_fetch_array( $result, MYSQLI_ASSOC ) ) {
    array_push( $name, $row );
}

$sql = "SELECT user.ID,`Bio`,`First_Name`,`Last_Name`FROM `user`,`bonds` WHERE ((bonds.ID='$id' and accepted='NO')or(bonds.requestingID='$id' and requested='NO')) and user.ID<>'$id' ";
$result = mysqli_query( $conn, $sql );
$bonds = array();
while( $row = mysqli_fetch_array( $result, MYSQLI_ASSOC ) ) {
    array_push( $bonds, $row );
}

$sql = "SELECT Count(ID) FROM `user`";
$i = mysqli_fetch_array(mysqli_query($conn,$sql))[0];

$sql = "SELECT Count(Service_ID) FROM `service`";
$j = mysqli_fetch_array(mysqli_query($conn,$sql))[0];

$sql = "SELECT First_Name FROM `user` WHERE Email='$email'";
$firstname = mysqli_fetch_array(mysqli_query($conn,$sql))['First_Name'];

$sql = "SELECT Last_Name FROM `user` WHERE Email='$email'";
$lastname = mysqli_fetch_array(mysqli_query($conn,$sql))['Last_Name'];
           

$sql = "SELECT * FROM bonds where ID='$id' or requestingID='$id'";
$result = mysqli_query($conn, $sql);
if (!$result->num_rows > 0){
  $sql = "INSERT INTO `bonds` (`requested`, `accepted`, `friends`, `ID`, `requestingID`) VALUES ('NO', 'NO', 'NO', '$id', NULL)";
  $result = mysqli_query($conn, $sql);
  if (!$result->num_rows > 0){
    echo "<script>alert('Your profile is now public for people to add as friend :)'); document.location = 'main.php'</script>";

  }else {
    echo "<script>alert('An error has occurred :)'); document.location = 'main.php'</script>";
  }
}


if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $price = $_POST['price'];
    $type_j_s = $_POST['type_j_s'];
    $type_cash_cd = $_POST['type_cash_cd'];
   
    $sql = "INSERT INTO `service` (`Description`, `Location`, `Report`, `Service_ID`, `Titles`, `Time_created`, `Time_ended`, `Price`, `ID`, `takerID`, `type_j_s`, `type_cash_cd`) VALUES ('$description', '$location', NULL, NULL, '$title',current_time(), NULL, '$price', '$id', NULL, '$type_j_s', '$type_cash_cd')";
  
      $result = mysqli_query($conn, $sql);
    if ($result) {

      echo "<script>alert('Your $type_j_s got posted . Thank you !'); document.location = 'main.php'</script>";

        $title = "";
        $description = "";
        $location = "";
        $price = "";
        $type_j_s = "";
        $type_cash_cd = "";
        
      

    } else {
      echo "<script>alert('Woops! Something Went Wrong.')</script>";
    }
  }



  if (isset($_POST['bond_req'])) {

    
   $bondID=$_COOKIE['bondID'];
   

      $sql = "SELECT * FROM `bonds` WHERE ID='$bondID' and requestingID='$id' ";
      $result = mysqli_query($conn, $sql);
    if (!$result->num_rows > 0) {

      $sql = "INSERT INTO `bonds` (`ID`, `requestingID`, `requested`) VALUES ('$bondID', '$id', 'YES')";
      $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {

      echo "<script>alert('Your request got sent!'); document.location = 'main.php'</script>";

        $bondID = "";
    
    } else {
      echo "<script>alert('Woops! Something Went Wrong.'); document.location = 'main.php'</script>";
    }
  }else {
    echo "<script>alert('You already have requested to bond !'); document.location = 'main.php'</script>";
  }
  }

  if (isset($_POST['apply'])) {

    
    $vers=$_COOKIE['version'];
    $serveId=$_COOKIE['servID'];

    // echo "<script>alert('$servId')</script>";
    // echo "<script>alert('$vers')</script>";
 
       $sql = "SELECT * FROM `list_appl` WHERE ID='$id' and Service_ID='$serveId' ";
       $result = mysqli_query($conn, $sql);
     if (!$result->num_rows > 0) {
       $sql = "INSERT INTO `list_appl` (`ID`, `Service_ID`, `Applied`) VALUES ('$id', '$serveId', 'Yes')";
       $result = mysqli_query($conn, $sql);

     if ($result->num_rows > 0) {
 
       echo "<script>alert('Your applied for this $vers'); document.location = 'main.php'</script>";

     } else {
       echo "<script>alert('Woops! Something Went Wrong.'); document.location = 'main.php'</script>";
     }
   }else {
     echo "<script>alert('You already have already applied for this $vers !')</script>";
   }
   }





?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
    integrity="undefined" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="undefined"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./css/mainStyle.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@500&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link
    href="https://fonts.googleapis.com/css2?family=Changa:wght@500&family=Lobster&family=Mukta:wght@300&display=swap"
    rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <title>Main Page</title>
</head>

<body style="background-color: #deedf0;">
  <section id="header">
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container-fluid">
        <span class="navbar-text">
          <?php echo "<h1>Welcome " . $firstname .' '.  $lastname . "</h1>"; ?>
        </span>
        <div class="collapse navbar-collapse" id="navbarNav">
          <div class="center_btns">
            <button class="jobs-btn" name="jobs">Jobs</button>
            <button class="services-btn" name="serve">Services</button>
          </div>
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <button class="logout">
                <a class="nav-link active" aria-current="page" href="logout.php">Log Out</a>
              </button>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </section>
  <div class="layout">
    <div class="layout__left-sidebar">
      <div class="sidebar-menu">
        <a href="main.php"><h1 class="brand">HelpMe</h1></a>
        <div class="sidebar-menu__item">
          <a href="./profile.php">
            <img src="./svg/user.svg" class="sidebar-menu__item-icon">
            Profile
          </a>
        </div>
        <div class="sidebar-menu__item">
        <a href="./message.html">
          <img src="./svg/messages.svg" class="sidebar-menu__item-icon">
          Messages
      </a>
        </div>
        <a href="./notifications.html">
        <div class="sidebar-menu__item">
          <img src="./svg/envelope.svg" class="sidebar-menu__item-icon">
          Notifications
  </a>
        </div>
        <a href="./history.html">
        <div class="sidebar-menu__item">
          <img src="./svg/History.svg" class="sidebar-menu__item-icon">
          History
  </a>
        </div>
        <div class="sidebar-menu__item">
          <button class="create" id="create">
            <img src="./svg/add.svg" class="sidebar-menu__item-icon" id="add">
            Create
          </button>

        </div>
      </div>
    </div>
    <div class="layout__main">

      <!-- repetition -->
      <div id="newDivs"></div>


    </div>
    <div class="layout__right-sidebar-container">
      <div class="layout__right-sidebar">
        <div class="bonding-time">
          <div class="bonding-time__heading">
            <h2>Bonding Time</h2>
          </div>

          <!-- repetition -->
          <div id="newdivBond">  

          </div>
        </div>

      </div>

    </div>


    <div id="myModal" class="modal">

      <div class="container">


        <form action="" method="POST" class="log login-email">
          <div>
            <p class="login-text" style="font-size: 2rem; font-weight: 500;">Create <span class="close">&times;</span>
            </p>
          </div>
          <div class="input-group">
            <input type="text" placeholder="Title" name="title" value="<?php echo $title; ?>" required>
          </div>

          <div class="input-group">
            <textarea rows="4" cols="50" placeholder="Description" name="description"
              value="<?php echo $description; ?>" required></textarea>
          </div>
          <div class="input-group">
            <input type="text" placeholder="Location" name="location" value="<?php echo $location; ?>" required>
          </div>

          <div class="input-group">
            <input type="number" placeholder="Price" name="price" id="price" value="<?php echo $price; ?>" required>
          </div>

          <div class="input-group">

            <select name="type_j_s" id="type" value="<?php echo $type_j_s; ?>" required>
              <option value="job">Job</option>
              <option value="service">Service</option>
            </select>
          </div>

          <div class="input-group">

            <select name="type_cash_cd" id="type" value="<?php echo $type_cash_cd; ?>" required>
              <option value="cash">Cash</option>
              <option value="cd">Credit/Debit</option>
            </select>
          </div>
          <div class="input-group">
            <button name="submit" id="submit" class="btn">Create</button>
          </div>
        </form>

      </div>

    </div>

    <script>
      // Get the modal
      var modal = document.getElementById("myModal");

      // Get the button that opens the modal
      var btn = document.getElementById("create");

      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("close")[0];

      // When the user clicks the button, open the modal 
      btn.onclick = function () {
        modal.style.display = "block";
      }

      // When the user clicks on <span> (x), close the modal
      span.onclick = function () {
        modal.style.display = "none";
      }

      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function (event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      }
    </script>

    <script>
      
      var arr =<?php echo json_encode($sr); ?>;
      var nam =<?php echo json_encode($name); ?>;

      for (i = 0; i < "<?php echo $j ?>"; i++) {


        document.getElementById('newDivs').innerHTML +=
          '<form action="" method="POST">'+
          '<div class="posts">' +
          '<img src="./images/av.png" class="posts__author-logo">' +
          '<div class="posts__main">' +
          '<div class="posts__header">' +
          '<div class="posts__author-title">' +
          arr[i]['Titles'] +
          '</div>' +
          '<div class="posts__author-name">' +
          nam[i]['First_Name'] + " " + nam[i]['Last_Name'] +
          '</div>' +
          '<div class="posts__author-name">' +
          arr[i]['type_j_s'] +
          '</div>' +
          '<div class="posts__author-time">' +
          arr[i]['Time_created'] +
          '</div>' +
          '<hr>' +
          '<div class="posts__content">' +
          arr[i]['Description'] +
          '</div>' +
          '<hr>' +
          '<div class="posts__price">' +
          arr[i]['Price'] + " " + "$" +
          '</div>' +
          '<div class="posts__location">' +
          arr[i]['Location'] +
          '</div>' +
          '<div class="posts__buttons">' +
          '<button class="apply" id="id'+i+'" onClick="typ('+arr[i]['type_j_s']+');servic('+arr[i]['Service_ID']+');" name="apply">' +
          "Apply"+'</button>' +
          '<button class="bond" id="id'+i+'" onClick="bonding('+nam[i]['ID']+')" name="bond_req">'+"Bond Request"+
                                                                  '</button>'+
          '</div>' +
          '</div>' +
          '</div>' +
          '</div>'+
          '</form>';

      }




// '+ bonding2(arr[i]['Service_ID'])+';'+ bonding3(arr[i]['type_j_s'])+';

function bonding(hey){
            document.cookie = 'bondID='+hey;
}

function servic(ser){


  console.log(ser);

document.cookie = 'servID='+ser;

}

function typ(ver){

document.cookie = 'version='+ver;
}



    </script>





    <script type="text/javascript" action="">

      function myFunction() {
        document.getElementById("buttn").innerHTML = "Bond Request";
      }

      var bond =<?php echo json_encode($bonds); ?>;

      var range = 5;

      var outputCount =<?php echo json_encode($i); ?>;

      function randomUniqueNum(range, outputCount) {

        let arr = []
        for (let i = 0; i < range; i++) {
          arr.push(i)
        }

        let result = [];

        for (let i = 1; i <= outputCount; i++) {
          const random = Math.floor(Math.random() * (range - i));
          result.push(arr[random]);
          arr[random] = arr[range - i];
        }

        return result;
      }

      var result = randomUniqueNum(range, outputCount);


      for (j = 0; j < 5; j++) {

        document.getElementById('newdivBond').innerHTML +=        '<form action="" method="POST">'+
                                                                    '<div class="bonding-time__block">' +
                                                              '<div class="bonding-time__meta-information">'+
                                                                '<img src="./images/av.png" class="posts__author-logo">'+
                                                                bond[result[j]]['First_Name']+" "+ bond[result[j]]['Last_Name']+
                                                                '</div>'+


                                                              '<div class="bonding-time__name">'+
                                                                bond[result[j]]['Bio'] +
                                                                '</div>'+


                                                              '<div class="bonding-time__meta-information">'+

                                                                '<button class="bond2" id="id'+j+'" onClick="bonding('+bond[result[j]]['ID']+')" name="bond_req">'+"Bond Request"+
                                                                  '</button>'+

                                                                '</div>'+
                                                                '</input>'+
                                                              '</div>' +
                                                              
                                                             '</form>' ;                                  
                                                             

  }

function bonding(hey){
            document.cookie = 'bondID='+hey+'';
}


  </script>

</body>

</html>