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

$sql = "SELECT DISTINCT * From user,bonds Where (friends='YES' and (bonds.requestingID='$id' and bonds.ID<>'$id' and bonds.ID=user.ID )or (bonds.ID='$id' and bonds.requestingID<>'$id' and bonds.requestingID=user.ID ) )";
$result = mysqli_query( $conn, $sql );
$friend = array();
while( $row = mysqli_fetch_array( $result, MYSQLI_ASSOC ) ) {
    array_push( $sr, $friend );
}

$sql = "SELECT DISTINCT * From user,bonds Where (friends='YES' and (bonds.requestingID='$id' and bonds.ID<>'$id' and bonds.ID=user.ID )or (bonds.ID='$id' and bonds.requestingID<>'$id' and bonds.requestingID=user.ID ) )";
$nr_fi = mysqli_fetch_array(mysqli_query($conn,$sql))['ID'];

echo "<script>alert('$nr_fi')</script>";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/messagestyle.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <!-- chat menu-->
        <div class="chat-menu ">
            <div class="search-bar">

                <input type="text" placeholder="Search Bar">
            </div>
            <div class="title1">
                <h3>CONVOS</h3>
            </div>
            <div class="menu-container scrollbar1">
                <nav>
                        <!-- repetition friends -->
                        <div id="friends"></div>

                    <a onclick="tabs(1)" class="tab ">
                        <div class="client1">

                            <img src="./images/logodb.png" alt="logo" />
                            <div class="client-info">
                                <h2>"Emiljan"</h2>

                            </div>
                        </div>
                    </a>

                    <a onclick="tabs(2)" class="tab ">
                        <div class="client1">

                            <img src="./images/logodb.png" alt="logo" />
                            <div class="client-info">
                                <h2>"Ina"</h2>

                            </div>
                        </div>
                    </a>
                    <a onclick="tabs(3)" class="tab ">
                        <div class="client1">

                            <img src="./images/logodb.png" alt="logo" />
                            <div class="client-info">
                                <h2>"Irv"</h2>

                            </div>
                        </div>
                    </a>
                    
                    
                   

                </nav>
            </div>
        </div>
        <!-- chat box -->
        <div class="chat-box">
            <!-- client -->
            <div class="client">
                <img src="./images/logodb.png" alt="logo" />
                <div class="client-info">
                    <h2>"Current user"</h2>

                </div>
            </div>

            <!-- main chat section -->
            <div class="chats scrollbar2 showtab" style="display: block;">
                <div class="client-chat">Hi!</div>
                <div class="my-chat">Hi!</div>
                <div class="client-chat">How can i help you?</div>
                <div class="my-chat">How you create this chat box?</div>
                <div class="client-chat">Watch complete video for your answer.</div>
                <div id="" class="my-chat"></div>
                <div class="client-chat">Hi!</div>
                <div class="my-chat">Hi!</div>
                <div class="client-chat">How can i help you?</div>
                <div class="my-chat">How you create this chat box?</div>
                <div class="client-chat">Watch complete video for your answer.</div>
                <div id="newDivs" class="my-chat"></div>
            </div>

            <div class="chats scrollbar2 showtab" style="display: none;">
                <div class="client-chat">Hi!</div>
                <div class="my-chat">Hi!</div>
                <div class="client-chat">Hi!</div>
                <div class="my-chat">Hi!</div>
                
            </div>
            <div class="chats scrollbar2 showtab" style="display: none;">
                <div class="client-chat">Hi!</div>
                <div class="my-chat">Hi!</div>
                
            </div>

            <div class="chats scrollbar2 showtab" style="display: none;">
                <div class="client-chat">Hi!</div>
                <div class="my-chat">Hi!</div>
                <div class="client-chat">Hi!</div>
                <div class="my-chat">Hi!</div>
                <div class="client-chat">Hi!</div>
                <div class="my-chat">Hi!</div>
                
            </div>


            <!-- input field section -->
            <div class="chat-input">
                <input id="input" type="text" placeholder="Enter Message" />
                <button id="submit" class="send-btn">
                    <img src="./images/send.png" alt="send-btn">
                </button>
            </div>
        </div>

        <!-- button -->
        <div class="chat-btn">
            <img src="./images/Circle-icons-chat.svg.png" alt="chat box icon btn">
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
    <script src="./js/jquery-3.4.1.min.js"></script>
    <script src="./js/script.js"></script>

    
 <!-- SELECT DISTINCT * From user,bonds Where (friends='YES' and (bonds.requestingID='40' and bonds.ID<>'40' and bonds.ID=user.ID )or (bonds.ID='40' and bonds.requestingID<>'40' and bonds.requestingID=user.ID ) ) -->

 <script>
      
      var frien =<?php echo json_encode($friend); ?>;

      for (i = 0; i < "<?php echo $nr_fi ?>"; i++) {


        document.getElementById('friends').innerHTML +=
                                                                        '<a onclick="tabs('+i+')" class="tab active">'+
                                                                            '<div class="client1">'+

                                                                                '<img src="./images/logodb.png" alt="logo" />'+
                                                                                '<div class="client-info">'+
                                                                                    '<h2>'+
                                                                                    frien[i]['First_Name']+
                                                                                    '</h2>'+

                                                                                    '<h2>'+
                                                                                    frien[i]['Last_Name']+
                                                                                    '</h2>'+

                                                                                '</div>'+
                                                                            '</div>'+
                                                                        '</a>';
                                                                        
                                                                       

          
      }
    console.log(frien[i]['First_Name']);
    console.log(frien[i]['Last_Name']);


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


</body>

</html>