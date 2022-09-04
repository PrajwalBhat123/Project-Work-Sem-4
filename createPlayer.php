<?php 
    //session_start();
    include "index.php";
    require_once 'authentication.php';
    include "form.php";
    //include 'buyPlayer.php';
    error_reporting(0);
    $username = $_SESSION['$user'];

    $playername = $_POST['playername'];
    $playertype = $_POST['playertype'];
    $playercountry = $_POST['playercountry'];
    $playercost = $_POST['playercost'];
    $playerscore = $_POST['playerscore'];
    $playerrating = $_POST['playerrating'];
    
   echo $_POST['buyPlayer'];
    $country = "select countryId from country where countryname = '$playercountry'";
    $countryresult = mysqli_query($con,$country);
   
    if($playertype == 'shooter'){
        $sql = "INSERT INTO SHOOTER (playername,playerrating,playercountry,playercost,playerscore) 
                values('$playername','$playerrating','$country','$playercost','$playerscore')";
        echo 'Player created';        
    }else {
        $sql = "INSERT INTO GOALIE (playername,playerrating,playercountry,playercost,playerscore) 
                values('$playername','$playerrating','$country','$playercost','$playerscore')";
        echo 'Player created';
    }
?>
