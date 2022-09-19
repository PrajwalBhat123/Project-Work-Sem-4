<?php
    error_reporting(0);
    require 'index.php';
    require 'authentication.php';
    if(!$_SESSION['username'])
    {
        header('location:login.php');
    }
    $username = $_SESSION['username'];
    
    $sql = "select * from user where username = '$username'";
    $iresult = mysqli_query($con,$sql);
    
    while($row = mysqli_fetch_assoc($iresult)){
        $wallet = $row['wallet'];
    }
    
    $newwallet = $wallet + 500;
    
    $sql = "update user set wallet = '$newwallet' where username = '$username'";
    $result = mysqli_query($con,$sql);

    if($result){
        header('location:homeIndex.php');
    }
?>