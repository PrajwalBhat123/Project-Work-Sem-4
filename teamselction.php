<?php
    require_once('index.php');
    require_once('authentication.php');
    if(!$_SESSION['username'])
    {
        header('location:login.php');
    }
   // echo $_POST['team'];
    if(isset($_POST['team'])){

        $username = $_SESSION['username'];
        // echo $_POST['team'];
        $teamId = $_POST['team'];
        $sql = "select * from user where username = '$username'";
        $iresult = mysqli_query($con,$sql);
    
        while($row = mysqli_fetch_assoc($iresult)){
            $wallet = $row['wallet'];
        }
    
        $sql = "select * from cputeams where teamId = '$teamId'";
        $tresult = mysqli_query($con,$sql);
        while($row = mysqli_fetch_assoc($tresult)){
            $difficulty = $row['teamdifficulty'];
            $team = $row['teamname'];
            $gk = $row['goalie'];
        }
        $checkvalue = $difficulty*100;
        if($wallet > $checkvalue){

            $newWallet = $wallet - $checkvalue;
            $sql = "update user set wallet = '$newWallet' where userId = (select userId from user where username = '$username')";
            $result = mysqli_query($con,$sql);

        }else{
            header('location:homeindex.php');
            echo "<script>alert('Less amount');</script>";
        }
        unset($_POST['team']);
    }

    $sql = "select * from cputeams";
    $result = mysqli_query($con,$sql);
?>

<table class="player" id="teams">
    <tr>
        <th>Slno</th>
        <th>Player</th>
        <th>Difficulty</th>
        <th>Score</th>
    </tr>
    <?php
        $slno = 1; 
        while($row = mysqli_fetch_assoc($result)){
    ?>
    <tr>
        <td><?php echo $slno;?></td>
        <td><?php echo $row['teamname'];?></td>
        <td><?php echo $row['teamdifficulty'];?></td>
        <td>
            <form action="gamepage.php" method="post">
                <button class="profile_button px-5" id = "<?echo $row['teamId']?>">Select Team</button>
                <input type='hidden' name='team' value="<?php echo $row['teamId'];?>">
            </form>        
        </td>    
    </tr>
    <?php
        $slno++;}
    ?>
    </table>
    