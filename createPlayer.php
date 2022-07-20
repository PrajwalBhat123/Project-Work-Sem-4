<?php 
    include('index.php');
    include('authentication.php');
    $playername = $_POST['playername'];
    $playertype = $_POST['playertype'];
    $playercountry = $_POST['playercountry'];
    $playercost = $_POST['playercost'];
    $playerscore = $_POST['playerscore'];
    $playerrating = $_POST['playerrating'];
    $playerUser = $_POST['user'];
    echo '$playerUser';
    if($playername != null && $playertype != null && $playercost != null){
        echo $playername , $playertype , $playercost;
    }