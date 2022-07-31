<?php 
    //session_start();
    include "index.php";
    
    include "form.php";
    $playername = $_POST['playername'];
    $playertype = $_POST['playertype'];
    $playercountry = $_POST['playercountry'];
    $playercost = $_POST['playercost'];
    $playerscore = $_POST['playerscore'];
    $playerrating = $_POST['playerrating'];
    $username = $_SESSION['$user'];
    if(empty($username)){
        echo ' Username not transfered';
        return;
    }else{
        echo $username;
    }
    $country = "select countryId from country where countryname = '$playercountry'";
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