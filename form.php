<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Player</title>
</head>
<body>
<?php
        //error_reporting(0);
        require_once('authentication.php');
        //echo $_SESSION['username'];
        if(!$_SESSION['username'])
        {
           // echo $_SESSION['username'];
            header('location:login.php');
        }
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            require_once('index.php');
            require_once('authentication.php');
            if(($_SESSION['username'])){ 
            //echo 'hi';
            //echo $_SESSION['username'];
            $user = $_SESSION['username'];
            //$_SESSION['username'] = $user;
            $playername = $_POST['playername'];
            $playertype = $_POST['playertype'];
            $playercountry = $_POST['playercountry'];
            $playercost = $_POST['playercost'];
            $playerscore = $_POST['playerscore'];
            $playerrating = $_POST['playerrating'];
            
            $countryname = "select countryId from country where countryname = '$playercountry'";
            $idresult = mysqli_query($con,$countryname);
            if(mysqli_num_rows($idresult) == 0){
                $sql = "insert into country (countryname) values($playercountry)";
                $result = mysqli_query($con,$sql);
            }
            $countryid = "select countryId from country where countryname = '$playercountry'";
            $idresult = mysqli_query($con,$countryid);
            $row = mysqli_fetch_array($idresult);
            $country = $row['countryId'];
            echo $country;
            $typeId = "select typeId from type where type = '$playertype'";
            $idresult = mysqli_query($con,$typeId);
            $rowt = mysqli_fetch_assoc($idresult);
            $type = $rowt['typeId'];
            echo $type;
            $sql = "INSERT INTO player (playername,playerrating,playercost,playerscore,playercountry,playertype) 
            values('$playername','$playerrating','$playercost','$playerscore','$country','$type')";
            $result = mysqli_query($con,$sql);
            if($result){
                echo "<script>alert('Player Created');</script>";
            }else{
                echo "<script>alert('Player Not Created !!!');</script>";
            }    
        }
    }
    ?>
    <header>
        <a href="login.php">
            <button>Logout</button>
        </a>
    </header>
    <form action="form.php" method="post">
        <div class="input-field">
            <input type="text" name="playername" placeholder="Enter name" required>
            <i class="uil uil-user"></i>
        </div>
        <div class="input-field">
            <input type="text" name="playertype" class="type" placeholder="Enter the type" required>
        </div>
        <div class="input-field">
            <input type="text" name="playercountry" class="country" placeholder="Enter the country name" required>
        </div>
        <div class="input-field">
            <input type="text" name="playercost" class="cost" placeholder="Enter the cost" required>
        </div>
        <div class="input-field">
            <input type="text" name="playerrating" class="rating" placeholder="Enter the rating" required>
        </div>
        <div class="input-field">
            <input type="text" name="playerscore" class="score" placeholder="Enter the score" required>
        </div>

        <div class="input-field button">
            <input type="submit" value="Create">
        </div>
    </form>

    
</body>
</html>