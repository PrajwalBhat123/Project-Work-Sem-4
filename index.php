<?php

 $servername = 'localhost';
 $username = 'root';
 $password = '';
 $dbname = 'ProjectWork';
 $tablename = array('user','country','player','coach','CPUTeams','Userteams','UserPlayers','type','matches','scorecard');

 
    $con = mysqli_connect($servername,$username,$password);

    if(!$con){
        die('Connection Falied:::'.mysql_error());
    }
    // else{
    //     echo 'Conection successful';
    // }
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    if(mysqli_query($con,$sql)){
        $con = mysqli_connect($servername,$username,$password,$dbname);
        //echo 'Database created';
        //User table
        $sql = "CREATE TABLE IF NOT EXISTS $tablename[0] 
        (userId int not null auto_increment primary key,
        username varchar(20),
        password varchar(20),
        wallet int);";

        if(!mysqli_query($con,$sql)){
            echo "Error creating :: ".mysqli_error($con);
        }
        
        //Country table
        $sql = "CREATE TABLE IF NOT EXISTS $tablename[1] 
        (countryId int not null auto_increment primary key,
        countryname varchar(20));";
        
        if(!mysqli_query($con,$sql)){
            echo "Error creating :: ".mysqli_error($con);
        }
        
        //type table
        $sql = "CREATE TABLE IF NOT EXISTS $tablename[7] 
        (typeId int not null auto_increment primary key,
         type varchar(10));";
        
        if(!mysqli_query($con,$sql)){
            echo "Error creating :: " .mysqli_error($con);
        } 

        //Player table
        $sql = "CREATE TABLE IF NOT EXISTS $tablename[2] 
        (playerId int not null auto_increment primary key,
         playername varchar(20),
         playerrating real,
         playerscore real,
         playercountry int,
         playercost real,
         playertype int,
         playerimage varchar(100),
         foreign key (playercountry) references $tablename[1](countryId),
         foreign key (playertype) references $tablename[7](typeId));";

        if(!mysqli_query($con,$sql)){
            echo "Error creating :: ".mysqli_error($con);
        }
        
        //coach table
        $sql = "CREATE TABLE IF NOT EXISTS $tablename[3] 
        (coachId int not null auto_increment primary key,
         coachname varchar(20),
         coachrating real,
         coachscore int,
         coachcountry int,
         coachcost real,
         coachimage varchar(20),
         foreign key (coachcountry) references country(countryId));";

        if(!mysqli_query($con,$sql)){
            echo "Error creating :: ".mysqli_error($con);
        }

        //CPUTeams table
        $sql = "CREATE TABLE IF NOT EXISTS $tablename[4] 
        (teamId int not null auto_increment primary key,
         teamname varchar(20),
         teamdifficulty int,
         shooter1 int,
         shooter2 int,
         shooter3 int,
         goalie int,
         foreign key (shooter1) references player(playerId),
         foreign key (shooter2) references player(playerId),
         foreign key (shooter3) references player(playerId),
         foreign key (goalie) references player(playerId));";

        if(!mysqli_query($con,$sql)){
            echo "Error creating :: ".mysqli_error($con);
        }
        
        //userteams table
        $sql = "CREATE TABLE IF NOT EXISTS $tablename[5] 
        (userId int not null primary key,
         teamname varchar(20),
         shooter1 int,
         shooter2 int,
         shooter3 int,
         goalie int,
         coach int,
         foreign key (shooter1) references player(playerId),
         foreign key (shooter2) references player(playerId),
         foreign key (shooter3) references player(playerId),
         foreign key (goalie) references player(playerId),
         foreign key (coach) references coach(coachId));";

        if(!mysqli_query($con,$sql)){
            echo "Error creating :: ".mysqli_error($con);
        }
        
        //Userplayers table
        $sql = "CREATE TABLE IF NOT EXISTS $tablename[6] 
        (userId int,playerId int,type varchar(10),
        foreign key (userId) references user(userId),
        foreign key (playerId) references player(playerId));";

        if(!mysqli_query($con,$sql)){
            echo "Error creating :: ".mysqli_error($con);
        }

        //match table
        $sql = "CREATE TABLE IF NOT EXISTS $tablename[8] 
        (matchId int not null auto_increment primary key,
         userId int,
         teamId int,
         GamePlayed date,
         result int,
         foreign key (userId) references user(userId),
         foreign key (teamId) references cputeams(teamId));";

        if(!mysqli_query($con,$sql)){
            echo "Error creating :: ".mysqli_error($con);
        }

        //scorecard table
        $sql = "CREATE TABLE IF NOT EXISTS $tablename[9] 
        (cardId int not null auto_increment primary key,
         matchId int,
         userGoals int,
         CPUGoals int,
         foreign key (matchId) references matches(matchId));";
        
        if(!mysqli_query($con,$sql)){
            echo "Error creating :: ".mysqli_error($con);
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