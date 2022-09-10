<?php

 $servername = 'localhost';
 $username = 'root';
 $password = '';
 $dbname = 'ImageTest';
 $tablename = array('Imagetable');
 $con = mysqli_connect($servername,$username,$password);

    if(!$con){
        die('Connection Falied:::'.mysql_error());
    }
    
    // if(isset($_POST['upload'])){
    //     $image = $_FILES['image']['name'];
    //     $path = 'images/'.$image;
    //     move_uploaded_file($_FILES['image']['tmp_name'],$path);
    // }
    
    
?>
