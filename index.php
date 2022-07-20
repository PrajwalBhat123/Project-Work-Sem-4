<?php

 $servername = 'localhost';
 $username = 'root';
 $password = '';
 $dbname = 'ProjectWork';
 $tablename = array('user','country','shooter','Goalie','Coach','CPUTeams','Userteams');

 
    $con = mysqli_connect($servername,$username,$password);

    if(!$con){
        die('Connection Falied:::'.mysql_error());
    }
    else{
        echo 'Conection successful';
    }
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    if(mysqli_query($con,$sql)){
        $con = mysqli_connect($servername,$username,$password,$dbname);
        echo 'Database created';
        $sql = "CREATE TABLE IF NOT EXISTS $tablename[0]
        (userId int not null auto_increment primary key,
        username varchar(20),
        password varchar(20),
        wallet int);";

        if(!mysqli_query($con,$sql)){
            echo "Error creating :: ".mysqli_error($con);
        }
        else{
            echo "Table '$tablename[0]' created";
        }
        
        $sql = "CREATE TABLE IF NOT EXISTS $tablename[1] 
        (countryId int not null auto_increment primary key,
        countryname varchar(20));";
        
        if(!mysqli_query($con,$sql)){
            echo "Error creating :: ".mysqli_error($con);
        }
        else{
            echo "Table '$tablename[1]' created";
        }
        
        $sql = "CREATE TABLE IF NOT EXISTS $tablename[2] 
        (playerId int not null auto_increment primary key,
         playername varchar(20),
         playerrating real,
         playerscore real,
         playercost real);";

        if(!mysqli_query($con,$sql)){
            echo "Error creating :: ".mysqli_error($con);
        }
        else{
            echo "Table '$tablename[2]' created";
        }

        $sql = "CREATE TABLE IF NOT EXISTS $tablename[3] 
        (playerId int not null auto_increment primary key,
         playername varchar(20),
         playerrating real,
         playerscore real,
         playercost real);";

        if(!mysqli_query($con,$sql)){
            echo "Error creating :: ".mysqli_error($con);
        }
        else{
            echo "Table '$tablename[3]' created";
        }

    }
    else{
        return false;
    }



/*public function getData() {
    $sql = "Select * from this->tablename";
    $result = mysqli_query($this->con,$sql);
    if(mysqli_num_rows($result)>0){
        return $result;
    }
}*/