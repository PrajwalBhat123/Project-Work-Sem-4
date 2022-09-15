<?php
    $showAlert = false;
    $showError = false;
    $exists = false;
    //echo 'In signinauth Outside if';
    
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        include('index.php');
        $username = $_POST['username'];
        $password = $_POST['password'];
        $conpassword = $_POST['conPassword'];

        $sql = "select * from user where username = '$username'";
        $result = mysqli_query($con,$sql);
        $num = mysqli_num_rows($result);
        if($num == 0){
            if($password == $conpassword && !$exists){
                $hash = password_hash($password,PASSWORD_DEFAULT);
                $sql = "insert into user (username,password,wallet) values('$username','$password',10000)";
                $result = mysqli_query($con,$sql);
                if($result){
                    $showAlert = true;

                    $sql = "select * from user where username = '$username'";
                    $result = mysqli_query($con,$sql);
                    while ($row = mysqli_fetch_assoc($result)){
                        $userId = $row['userId'];
                    }
                    $sql = "insert into userteams (userId,teamname) values('$userId','$username')";
                    $result = mysqli_query($con,$sql);
                    if($result){
                        echo "<script>alert('Success!
                        Your account has been created and you can now login.');</script>";   
                        header("location : login.php"); 
                    }
                }
            }else{
                $showError = 'Passwords do not match';
                echo "<script>alert('Error ::: .$showError');</script>";
            }
        }
        if($num > 0){
            $exists = 'Username already exists';
            echo 'Sorry. $exists . Try another username';
        }
    }else{
        echo 'Not post';
    }
