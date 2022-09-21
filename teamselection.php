<?php
    error_reporting(0);
    require_once('index.php');
    require_once('authentication.php');
    if(!$_SESSION['username'])
    {
        header('location:login.php');
    }
        $username = $_SESSION['username'];
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
        if($wallet > $difficulty*100){
            $newWallet = $wallet - $difficulty*100;
            $sql = "update user set wallet = '$newWallet' where userId = (select userId from user where username = '$username')";
            $result = mysqli_query($con,$sql);

        }else{
            header('location:homeindex.php');
            echo "<script>alert('Less amount');</script>";
        }

    $sql = "select * from cputeams";
    $result = mysqli_query($con,$sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Selection</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	
    <style>
        body{
            background : linear-gradient(90deg,#06beb6 , #48b1bf);
            background-size : cover;
        }
        .btn{
            border: #211f22;
        }
        .space{
            padding: 20px;
        }
        .input{
            padding:5px;
            width: fit-content;
        }
    </style>
</head>
<body>

<div class="container-fluid">
  <div class="row ">
    <div class="col-md-4">
      <table class="table table-dark" id="teams">
      <tr>
        <th>Slno</th>
        <th>Player</th>
        <th>Difficulty</th>
        <th>Shooter1</th>
        <th>Shooter2</th>
        <th>Shooter3</th>
        <th>GoalKeeper</th>
        <th>Select</th>
    </tr>
    <?php
        $slno = 1; 
        while($row = mysqli_fetch_assoc($result)){
    ?>
    <tr>
        <td><?php echo $slno;?></td>
        <td><?php echo $row['teamname'];?></td>
        <td><?php echo $row['teamdifficulty'];?></td>
        <td><?php echo $row['shooter1'];?></td>
        <td><?php echo $row['shooter2'];?></td>
        <td><?php echo $row['shooter3'];?></td>
        <td><?php echo $row['goalie'];?></td>
        <td>
            <form action="game.php" method="post">
                <button class="profile_button px-5" id = "<?echo $row['teamId']?>">Select Team</button>
                <input type='hidden' name='team' value="<?php echo $row['teamId'];?>">
            </form>        
        </td>    
    </tr>
    <?php
            $slno++;}
        ?>
        </table>
    </div>
    </body>
</html>
