<?php
    session_start();
    include "index.php";
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['user'];
    $password = $_POST['pass'];
    $username = stripcslashes($username);
    $password = stripcslashes($password);
    $username = mysqli_real_escape_string($con,$username);
    $password = mysqli_real_escape_string($con,$password);
    
    $sql = "select * from user where username = '$username' and password = '$password'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    echo $username, $password;

    if($count == 1){
        $_SESSION['username'] = $username;
        header('location:form.php');
    }   // echo "Login Successful";
    //else{
    //     echo 'Something went wrong!! Try again';
    //     //header('location:index.html');
    // }

    if(isset($_SESSION['username'])){
        echo 'Session is active';
    }else{
        echo 'Session is not active'; 
    }
    }