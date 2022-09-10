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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display List</title>

</head>
<body>
    <?php
        $sql = "select * from userTeams where userId = (select userId from user where username = '$username')";
        $result = mysqli_query($con,$sql);
        while($id = mysqli_fetch_assoc($result)){
            $sh1 = $id['shooter1'];
            $sh2 = $id['shooter2'];
            $sh3 = $id['shooter3'];
            $gk = $id['goalie'];
        }
        $empty = 0;
        if(is_null($sh1) && is_null($sh2) && is_null($sh3) && is_null($gk)){
            echo "<script>alert('Team is empty!!');</script>";
            $empty = 1;
        }
        if($empty){
            header('location:selectPlayer.php');
        }
        $idarray = array();
        if(!is_null($sh1)){
            array_push($idarray,$sh1);
        }
        if(!is_null($sh2)){
            array_push($idarray,$sh2);
        }
        if(!is_null($sh3)){
            array_push($idarray,$sh3);
        }
        if(!is_null($gk)){
            array_push($idarray,$gk);
        }
        $sql = "SELECT * FROM player WHERE playerId IN (" . implode(',', $idarray) . ")";
	    $result = mysqli_query($con,$sql);
    ?>
    <table>
        <tr>
            <th>Slno</th>
            <th>Player</th>
            <th>Rating</th>
            <th>Score</th>
        </tr>
        <?php
        $slno = 1; 
        while($row = mysqli_fetch_assoc($result)){
        ?>
        <tr>
            <td><?php echo $slno;?></td>
            <td><?php echo $row['playername'];?></td>
            <td><?php echo $row['playerrating'];?></td>
            <td><?php echo $row['playerscore'];?></td>
        </tr>
        <?php
            $slno++;}
        ?>
    </table>

    <?php            
    
    $sql = "select playerId from userPlayers where userId = (select userId from user where username = '$username')";
	$idresult = mysqli_query($con,$sql);
    $id = array();
    $empty = 0;
    if(mysqli_num_rows($idresult) == 0){
        echo "<script>alert('No players bought !!');</script>";
        $empty = 1;
    }if($empty){
        header('location:buyPlayer.php');
    }
    while($idrow = mysqli_fetch_assoc($idresult)){
        array_push($id,$idrow['playerId']);
    }
        $sql = "SELECT * FROM player WHERE playerId IN (" . implode(',', $idarray) . ")";
        $result = mysqli_query($con,$sql);    
    ?>
    <table>
        <tr>
            <th>Slno</th>
            <th>Player</th>
            <th>Rating</th>
            <th>Score</th>
        </tr>
        <?php
        $slno = 1; 
        while($row = mysqli_fetch_assoc($result)){
        ?>
        <tr>
            <td><?php echo $slno;?></td>
            <td><?php echo $row['playername'];?></td>
            <td><?php echo $row['playerrating'];?></td>
            <td><?php echo $row['playerscore'];?></td>
        </tr>
        <?php
            $slno++;}
        ?>
    </table>

</body>
</html>