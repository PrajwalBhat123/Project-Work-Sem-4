<?php
    $showAlert = false;
    $showError = false;
    $exists = false;
    //echo 'In signinauth Outside if';
    
    if($_SERVER['REQUEST_METHOD'] == "POST"){
       // echo 'In signinauth Inside if';
        include('index.php');
        $username = $_POST['username'];
        $password = $_POST['password'];
        $conpassword = $_POST['conPassword'];

        $sql = "select * from user where username = '$username'";
        $result = mysqli_query($con,$sql);
        $num = mysqli_num_rows($result);
      //  echo " $username ";
        if($num == 0){
        //    echo 'New username';
            if($password == $conpassword && !$exists){
                $hash = password_hash($password,PASSWORD_DEFAULT);
                $sql = "insert into user (username,password,wallet) values('$username','$password',1000)";
                $result = mysqli_query($con,$sql);
                if($result){
                    $showAlert = true;
                    header("Location : index.html"); 
                    echo 'Success!
                     Your account has been created and you can now login.';   
                }
            }else{
                $showError = 'Passwords do not match';
                echo 'Error ::: .$showError';
            }
        }
        if($num > 0){
            $exists = 'Username already exists';
            echo 'Sorry. $exists . Try another username';
        }
    }else{
        echo 'Not post';
    }
