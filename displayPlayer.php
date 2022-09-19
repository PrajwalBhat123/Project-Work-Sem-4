<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display List</title>

    <style>
        table,th,td{
            border : 1px solid;
        }
    </style>

</head>
<body>
    <?php
        error_reporting(0);
        require_once('index.php');
        require_once('authentication.php');
        if(!$_SESSION['username'])
        {
            header('location:login.php');
        }
        $username = $_SESSION['username'];
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
    <table class="player" id="teams">
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
    <a href="removeFromTeam.php">
            <button>
                Remove
            </button>
    </a>

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
        $sql = "SELECT * FROM player WHERE playerId IN (" . implode(',', $id) . ")";
        $result = mysqli_query($con,$sql);    
    ?>
    <table class="player" id="user">
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

    <a href="selectPlayer.php">
            <button>
                Insert
            </button>
    </a>
</body>
</html>