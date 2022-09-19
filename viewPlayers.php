<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display List</title>

    <style>
        body{
            background-image : url('backImage.jpg');
            background-size : cover;
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
        $sql1 = '';
        $sql2 = '';
        if(isset($_POST['ratingbutton'])){
            $sql1 = "select * from player where playertype = 1 order by playerrating desc";
            $sql2 = "select * from player where playertype = 2 order by playerrating desc";
        }else if(isset($_POST['countrybutton'])){
            $sql1 = "select * from player where playertype = 1 order by playercountry";
            $sql2 = "select * from player where playertype = 2 order by playercountry";
        }else if($_POST['country']){
            $country = $_POST['country'];
            unset($_POST['country']);
            $sql = "select * from country where countryname = '$country'";
            $result = mysqli_query($con,$sql);
            if(mysqli_num_rows($result) == 0){
                echo "<script>alert('No players from the country!!');</script>";
                $sql1 = "select * from player where playertype = 1";
                $sql1 = "select * from player where playertype = 2";
            }else{
                while ($row = mysqli_fetch_assoc($result)){
                    $countid = $row['countryId'];
                }
                $sql = "select * from player where playertype = 1 and playercountry = '$countid'";
                $result1 = mysqli_query($con,$sql);
                $sql = "select * from player where playertype = 2 and playercountry = '$countid'";
                $result2 = mysqli_query($con,$sql);
                
                if(mysqli_num_rows($result1)==0){
                    echo "<script>alert('No shooters from the country!!');</script>";    
                    $sql1 = "select * from player where playertype = 1";     
                }
                if(mysqli_num_rows($result2)==0){
                    echo "<script>alert('No goalie from the country!!');</script>";
                    $sql1 = "select * from player where playertype = 2";    
                }else{
                    $sql1 = "select * from player where playertype = 1 and playercountry = '$countid'";
                    $sql2 = "select * from player where playertype = 2 and playercountry = '$countid'";
                }
            }
        }else{
            $sql1 = "select * from player where playertype = 1";
            $sql2 = "select * from player where playertype = 2";
        }

        $result = mysqli_query($con,$sql1);

    ?>
    <form method="post" action="viewPlayers.php">
            <button name="ratingbutton">
		    	<span>Rating</span>
	    	</button>
            <br>
            <button name="countrybutton">
		    	<span>Country</span>
	    	</button>
            <br>
            <input type="text" name="country" placeholder="Ex: Argentina">
            <input type="submit" value="Ok">
            <br>
    </form>     
    
    <p>Shooter</p>
    <table class="player" id="teams">
        <tr>
            <th>Slno</th>
            <th>Player</th>
            <th>Rating</th>
            <th>Score</th>
            <th>Country</th>
        </tr>
        <?php
        $slno = 1; 
        while($row = mysqli_fetch_assoc($result)){
            $sql = "select countryname from country where countryId = '$row[playercountry]'";
            $countryresult = mysqli_query($con,$sql);
            while($country = mysqli_fetch_assoc($countryresult)){
                $countryname = $country['countryname'];
            }
        ?>
        <tr>
            <td><?php echo $slno;?></td>
            <td><?php echo $row['playername'];?></td>
            <td><?php echo $row['playerrating'];?></td>
            <td><?php echo $row['playerscore'];?></td>
            <td><?php echo $countryname;?></td>
        </tr>
        <?php
            $slno++;}
        ?>
    </table>
    <?php            
        $result = mysqli_query($con,$sql2);    
    ?>
    <p id="user">GoalKeeper</p>
    <table class="player" id="usertable">
        <tr>
            <th>Slno</th>
            <th>Player</th>
            <th>Rating</th>
            <th>Score</th>
            <th>Country</th>
        </tr>
        <?php
        $slno = 1; 
        while($row = mysqli_fetch_assoc($result)){
            $sql = "select countryname from country where countryId = '$row[playercountry]'";
            $countryresult = mysqli_query($con,$sql);
            while($country = mysqli_fetch_assoc($countryresult)){
                $countryname = $country['countryname'];
            }
        ?>
        <tr>
            <td><?php echo $slno;?></td>
            <td><?php echo $row['playername'];?></td>
            <td><?php echo $row['playerrating'];?></td>
            <td><?php echo $row['playerscore'];?></td>
            <td><?php echo $countryname ;?></td>
        </tr>
        <?php
            $slno++;}
        ?>
    </table>

</body>
</html>