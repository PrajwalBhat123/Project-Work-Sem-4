<?php
    require_once('index.php');
    require_once('authentication.php')
    if(!$_SESSION['username'])
    {
        header('location:login.php');
    }
    $username = $_SESSION['username'];
    //Sort based on rating
    $sql = "select * from player where playerId in (select playerId from userPlayers 
    where userId = (select userId from user where username = '$username')) order by playerrating";
    $result = mysqli_query($con,$sql);

    //Specific country;
    $country = $_POST['country'];
    $sql = "select * from country where countryname = '$country'";
    $countryresult = mysqli_query($con,$sql);
    while($row = mysqli_fetch_assoc($countryresult)){
        $countid = $row['countryId'];
    }
    $sql = "select * from player where playerId in (select playerId from userPlayers 
    where userId = (select userId from user where username = '$username')) and playercountry = '$countid'";
    
    //Sort based on country
    $sql = "select * from player where playerId in (select playerId from userPlayers 
    where userId = (select userId from user where username = '$username')) order by playercountry";
    $result = mysqli_query($con,$sql);
    
    //Only shooter display
    $sql = "select * from player where playerId in (select playerId from userPlayers 
    where userId = (select userId from user where username = '$username')) and type = 1";
    $result = mysqli_query($con,$sql);
    
    //Only GoalKeeper
    $sql = "select * from player where playerId in (select playerId from userPlayers 
    where userId = (select userId from user where username = '$username')) and type = 2";
    $result = mysqli_query($con,$sql);
?>