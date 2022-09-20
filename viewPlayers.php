<?php
    // //Sort based on rating
    // $sql = "select * from player where playerId in (select playerId from userPlayers 
    // where userId = (select userId from user where username = '$username')) order by playerrating";
    // $result = mysqli_query($con,$sql);

    // //Specific country;
    // $country = $_POST['country'];
    // $sql = "select * from country where countryname = '$country'";
    // $countryresult = mysqli_query($con,$sql);
    // while($row = mysqli_fetch_assoc($countryresult)){
    //     $countid = $row['countryId'];
    // }
    // $sql = "select * from player where playerId in (select playerId from userPlayers 
    // where userId = (select userId from user where username = '$username')) and playercountry = '$countid'";
    
    // //Sort based on country
    // $sql = "select * from player where playerId in (select playerId from userPlayers 
    // where userId = (select userId from user where username = '$username')) order by playercountry";
    // $result = mysqli_query($con,$sql);
    
    // //Only shooter display
    // $sql = "select * from player where playerId in (select playerId from userPlayers 
    // where userId = (select userId from user where username = '$username')) and type = 1";
    // $result = mysqli_query($con,$sql);
    
    // //Only GoalKeeper
    // $sql = "select * from player where playerId in (select playerId from userPlayers 
    // where userId = (select userId from user where username = '$username')) and type = 2";
    // $result = mysqli_query($con,$sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	
    <title>Display List</title>

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
    <?php
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
    
  <div class="container-fluid">
  <div class="row ">
    <div class="col-md-4">
      <h4>Shooter</h4>
     <table class="table table-dark" id="teams">
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
        
   
   </div>
    <div class="col-md-4">
    <?php            
        $result = mysqli_query($con,$sql2);    
    ?>
        <h4>GoalKeeper</h4>
        <table class="table table-dark" id="usertable">
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
    </div>
 </div>
  </div>

  

  <form method="post" action="viewPlayers.php">
  
    <div class="row">
        <span class="space"></span>
    <button name="ratingbutton" class="btn btn-danger" >
		    	<span>Rating</span>
	    	</button>
            <span class="space"> </span>
            <button name="countrybutton" class="btn btn-danger" >
		    	<span >Country</span>
	    	</button>
    </div>

            <br>
            <br>
            <span class="space">
            <label for="searchBar">Search For a Country</label>
            <span class="input">
            <input type="text" name="country" placeholder="Ex: Argentina" id="searchBar" >
            <button type = "submit" class="btn btn-primary">OK</button>
            </span>
            
            </span>
            <br>
    </form>

       
</body>
</html>