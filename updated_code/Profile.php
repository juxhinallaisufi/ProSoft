<?php


include 'config.php';
error_reporting(0);
session_start();

if(!isset($_SESSION['firstname'] , $_SESSION['lastname'], $_SESSION['email'])){
    header("Location: login.php");
}

$email=$_SESSION['email'];

$sql = "SELECT ID FROM `user` WHERE Email='$email'";
$id = mysqli_fetch_array(mysqli_query($conn,$sql))[0];

$sql = "SELECT Joined_date FROM `user` WHERE Email='$email'";
$joined = mysqli_fetch_array(mysqli_query($conn,$sql))[0];

$sql = "SELECT Phone_Nr FROM `user` WHERE Email='$email'";
$phone = mysqli_fetch_array(mysqli_query($conn,$sql))[0];

$sql = "SELECT Bio FROM `user` WHERE Email='$email'";
$bio = mysqli_fetch_array(mysqli_query($conn,$sql))[0];




  $sql = "SELECT * FROM `service` WHERE type_j_s='job' ORDER BY Time_created DESC";
  $result = mysqli_query( $conn, $sql );
  $sr = array();
  while( $row = mysqli_fetch_array( $result, MYSQLI_ASSOC ) ) {
      array_push( $sr, $row );
  }

  $sql = "SELECT * FROM `service` WHERE type_j_s='service' ORDER BY Time_created DESC";
  $result = mysqli_query( $conn, $sql );
  $srs = array();
  while( $row = mysqli_fetch_array( $result, MYSQLI_ASSOC ) ) {
      array_push( $srs, $row );
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
           

  if (isset($_POST['bond_req'])) {

    
   $bondID=$_COOKIE['bon_ID'];

      $sql = "SELECT * FROM `bonds` WHERE ID='$bondID' and requestingID='$id' ";
      $result = mysqli_query($conn, $sql);
    if (!$result) {

      $sql = "INSERT INTO `bonds` (`ID`, `requestingID`, `requested`) VALUES ('$bondID', '$id', 'YES')";
      $result = mysqli_query($conn, $sql);
    if ($result) {

      echo "<script>alert('Your request got sent!'); document.location = 'Profile.php'</script>";

        $bondID = "";

    } else {
      echo "<script>alert('Woops! Something Went Wrong.'); document.location = 'Profile.php'</script>";
    }
  }else {
    echo "<script>alert('You already have requested to bond !'); document.location = 'Profile.php'</script>";
  }
  }

  if (isset($_POST['apply'])) {

    
    $servId=$_COOKIE['servID'];
    $vers=$_COOKIE['version'];


    // echo "<script>alert('$servId')</script>";
    // echo "<script>alert('$vers')</script>";
 
       $sql = "SELECT * FROM `list_appl` WHERE ID='$id' and Service_ID='$servId' ";
       $result = mysqli_query($conn, $sql);
     if (!$result->num_rows > 0) {
       $sql = "INSERT INTO `list_appl` (`ID`, `Service_ID`, `Applied`) VALUES ('$id', '$servId', 'Yes')";
       $result = mysqli_query($conn, $sql);
     if ($result) {
 
       echo "<script>alert('Your applied for this $vers'); document.location = 'Profile.php'</script>";
 
         $servId = "";
         $vers= ""; 

     } else {
       echo "<script>alert('Woops! Something Went Wrong.'); document.location = 'Profile.php'</script>";
     }
   }else {
     echo "<script>alert('You already have already applied for this $vers !')</script>";
   }
   }

?>


<html>
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile</title>
        <link rel="stylesheet" href="./css/profile.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" >
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
            integrity="undefined" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="undefined"
            crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@500&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    </head>
    
    <body>
    
        <div class="container">
            <div class="profile-header">
                <div class="profile-img">
                    <img src="./images/User-Profile.png" width="200" alt="">
                </div>
                <div class="profile-nav-info">
                <?php echo "<h3 class='user-name'> " . $firstname .' '.  $lastname . "</h3>"; ?>
                    <div class="joined-date">
                        <spin class="joined">"JOINED : <?php echo $joined?>"</spin>
                    </div>
                </div>
                <div class="profile-option">
                    <div class="notifications">
                        <i class="fa fa-bell"></i>
                    </div>
                </div>
            </div>
            <div class="main-bd">
                <div class="left-side">
                    <div class="profile-side">
                        <div class="btn">
                        <i class="fa fa-file-image-o fa-lg"></i></div>
                        <br/>
                        <p class="mobile-no fa fa-phone">
                        <i><?php echo $phone ?></i></p>
                        <br/>
                        <p class="user-mail fa fa-envelope">
                        <i><?php echo $email ?></i></p>
                        <div class="user-id">
                            <p class="id"><?php echo $id ?></p>
                        </div>
                        <div class="user-bio">
                            <p class="bio"><?php echo $bio ?></p>
                        </div>
                        <div class="user-int">
                            <p class="interests">Interests: #money #kids #painting #DIY #art #design</p>
                        </div>
                        <div class="profile-btn">
                        <button class="chat-btn">
                            <a href="./messages.html">
                        <i class="fa fa-comment"></i>Messages   
</a>
                        </button>
                        <button class="edit-profile">
                            <a href="./profileEdit.php">
                            <i class="fa fa-edit"></i>Edit profile   
</a>
                        </button>
                        </div>
                        <div class="user-rating">
                        <h3 class="rating">4.5</h3>
                        <div class="rate">
                            <div class="stars">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                            </div>
                            <span class="no-user"> <span>123</span>
                            &nbsp;&nbsp; reviews</span>
                        </div>
                    </div>     
                </div>
            </div>
            <div class="right-side">
                <div class="nav">
                    <ul>
                        <li onclick="tabs(0)" class="tab active">Jobs</li>
                        <li onclick="tabs(1)" class="tab user-services">Services</li>
                        <li onclick="tabs(2)" class="tab cv">CV</li>
                    </ul>
                </div>
                <div class="profile-body">
                    <div class="job showtab">

                        <!-- repetition -->
                        <div id="newDivs"></div>
                        
                    </div>

                    <div class="service showtab">
                        
                        <!-- repetition -->
                        <div id="newDivser"></div>

                    </div>

                    <div class="CV showtab">
                        <h1>Your CV:</h1>
                        <br/>
                        <button class="button cv">upload CV</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
        
        <script>
            $(".nav tab").click(function() {
                $(this).addClass("active").siblings().removeClass("active");
            })
        </script>
        
        <script>

             const tabBtn = document.querySelectorAll(".tab");
            const tab = document.querySelectorAll(".showtab");
            function tabs(panelIndex) {
                tab.forEach(function(node) {
                    node.style.display = "none";
                })
                tab[panelIndex].style.display = "block";
            }
            tabs(0);
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
          '<button class="apply" id="id'+i+'" onClick="'+ bonding2(arr[i]['Service_ID'])+';'+ bonding3(arr[i]['type_j_s'])+';" name="apply">' +
          "Apply" +
          '</button>' +
          '<button class="bond" id="id'+i+'" onClick="bonding('+nam[i]['ID']+')" name="bond_req">'+"Bond Request"+
                                                                  '</button>'+
          '</div>' +
          '</div>' +
          '</div>' +
          '</div>'+
          '</form>';

          
      }


function bonding2(ser){
    
    console.log(ser);

    document.cookie = 'servID='+ser+'';

}

function bonding3(ver){

  document.cookie = 'version='+ver+'';
}

// '+ bonding2(arr[i]['Service_ID'])+';'+ bonding3(arr[i]['type_j_s'])+';

function bonding(hey){
            document.cookie = 'bondID='+hey+'';
}

    </script>


<script>
      
      var arr =<?php echo json_encode($srs); ?>;
      var nam =<?php echo json_encode($name); ?>;

      for (i = 0; i < "<?php echo $j ?>"; i++) {


        document.getElementById('newDivser').innerHTML +=
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
          '<button class="apply" id="id'+i+'" onClick="'+ bonding2(arr[i]['Service_ID'])+';'+ bonding3(arr[i]['type_j_s'])+';" name="apply">' +
          "Apply" +
          '</button>' +
          '<button class="bond" id="id'+i+'" onClick="bonding('+nam[i]['ID']+')" name="bond_req">'+"Bond Request"+
                                                                  '</button>'+
          '</div>' +
          '</div>' +
          '</div>' +
          '</div>'+
          '</form>';

          
      }


function bonding2(ser){
    
    console.log(ser);

    document.cookie = 'servID='+ser+'';

}

function bonding3(ver){

  document.cookie = 'version='+ver+'';
}

// '+ bonding2(arr[i]['Service_ID'])+';'+ bonding3(arr[i]['type_j_s'])+';

function bonding(hey){
            document.cookie = 'bondID='+hey+'';
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


    </body>
</html>