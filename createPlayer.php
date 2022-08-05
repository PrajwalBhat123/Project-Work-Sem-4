<?php 
    //session_start();
    include "index.php";
    include "form.php";
    $username = $_SESSION['$user'];
    if(empty($username)){
        echo ' Username not transfered';
        return;
    }
    $playername = $_POST['playername'];
    $playertype = $_POST['playertype'];
    $playercountry = $_POST['playercountry'];
    $playercost = $_POST['playercost'];
    $playerscore = $_POST['playerscore'];
    $playerrating = $_POST['playerrating'];
    else{
        echo $username;
    }
    $country = "select countryId from country where countryname = '$playercountry'";
    $countryresult = mysqli_query($con,$country);

    echo $country;
    if($playertype == 'shooter'){
        $sql = "INSERT INTO SHOOTER (playername,playerrating,playercountry,playercost,playerscore) 
                values('$playername','$playerrating','$country','$playercost','$playerscore')";
        echo 'Player created';        
    }else {
        $sql = "INSERT INTO GOALIE (playername,playerrating,playercountry,playercost,playerscore) 
                values('$playername','$playerrating','$country','$playercost','$playerscore')";
        echo 'Player created';
    }