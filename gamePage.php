<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Page</title>

    <link href="buy_card.css" rel="stylesheet" type="text/css"/>
	<link href="buy.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <?php
        include 'index.php';
        require_once('authentication.php');
        
        if(!$_SESSION['username'])
        {
            header('location:login.php');
        }
        $username = $_SESSION['username'];
        
        $sql = "select * from userTeams where userId = (select userId from user where username = '$username')";
        $tresult = mysqli_query($con,$sql);
        $sh1='1';
        $sh2='2';
        $sh3='3';
        $gk='4';
    
        while($player = mysqli_fetch_assoc($tresult)){
            $sh1 = $player['shooter1'];
            $sh2 = $player['shooter2'];
            $sh3 = $player['shooter3'];
            $gk = $player['goalie'];
        }

        echo $sh1,$sh2,$sh3,$gk;
        $sql = "select * from cputeams where teamId = 1";
        $result = mysqli_query($con,$sql);

        while($player = mysqli_fetch_assoc($result)){
            $cpush1 = $player['shooter1'];
            $cpush2 = $player['shooter2'];
            $cpush3 = $player['shooter3'];
            $cpugk = $player['goalie'];
        }
        echo "CPU";
        echo $cpush1,$cpush2,$cpush3,$cpugk;
        
        function getPlayerCard(int $player){ 
            include 'index.php';
            ////echo $player;
            $sql = "select * from player where playerId = '$player'";
            $result = mysqli_query($con,$sql);
            while ($row = mysqli_fetch_assoc($result)){
                $image = $row['playerimage'];
                $name = $row['playername'];
                $countryid = $row['playercountry'];
                $type = $row['playertype'];
                $cost = $row['playercost'];
                $rating = $row['playerrating'];
                $score = $row['playerscore'];
            }
                //echo $name,$rating,$image;    
        
            $sql = "select type from type where typeId = '$type'";
            $typeresult = mysqli_query($con,$sql);
            while($id = mysqli_fetch_assoc($typeresult)){
                $typename = $id['type'];
            }
            $sql = "select countryname from country where countryId = '$countryid'";
            $countryresult = mysqli_query($con,$sql);
            while($country = mysqli_fetch_assoc($countryresult)){
                $countryname = $country['countryname'];
            }
            //echo $typename,$countryname;

            echo "
                <div class='card p-3 py-4'>
                    <div class='text-center'>

                        <img src='images\<?php echo $image;?> alt='Player image' width='50' height='50'></img>            
                        <h3 class='mt-2'>$name</h3>
                        <span class='mt-1 clearfix'>$typename</span>

                        <span class='mt-1 clearfix'>$countryname</span>
                        <div class='row mt-3 mb-3'>
                            <div class='col-md-4'>
                                <h5>Cost</h5>
                                <span class='num'>$cost</span>
                            </div>
                            <div class='col-md-4'>
                                <h5>Rating</h5>
                                <span class='num'>$rating</span> 
                            </div>
                            <div class='col-md-4'>
                                <h5>Score</h5>
                                <span class='num'>$score</span>
                            </div>
                        </div>                   
                        <hr class='line'>
                        <div class='profile mt-5'>
                            <button class='profile_button px-5'>Select Player</button>
                            <input type='hidden' name='buyPlayer' value='$player'>	
                        </div>   
                    </div>
                </div>
                ";
        }
        $usergoal = array();
        $cpugoal = array();
        function getGoal(int $shooter,$goalie,$dir){
            include 'index.php';
            //echo $player;
            $sql = "select * from player where playerId in ('$shooter','$goalie')";
            $result = mysqli_query($con,$sql);
            while ($row = mysqli_fetch_assoc($result)){
                $type = $row['playertype'];
                if($type == 1){
                    $srating = $row['playerrating'];
                    $sscore = $row['playerscore'];    
                }else if($type == 2){
                    $grating = $row['playerrating'];
                    $gscore = $row['playerscore'];
                }
            }
            if($srating > $grating){
                if($srating - $grating >=50){
                    echo "
                    <script>
                    
                    </script>"
                    //It is a goal then push 1
                    array_push($usergoal,1);
                }
            }
        }
        $count = 5;
        $user = 1;
        if(isset($_POST['play'])){
            unset($_POST['play']);
            if($user){  
                if($count == 1){
                    getPlayerCard($sh1);
                    $user = 0;
                    $count = 5;
                }
                if($count == 2){
                    getPlayerCard($sh2);
                    $count--;
                }
                if($count == 3){
                    getPlayerCard($sh3);
                    $count--;
                }
                if($count == 4){
                    getPlayerCard($sh2);
                    $count--;
                }
                if($count == 5){
                    getPlayerCard($sh1);
                    $count--;
                }
            }else{
                echo "<script>alert('Defend your score!!');</script>";
                
                if(!$user){
                    if($count == 1){
                        getPlayerCard($cpush1);
                        $count++;
                    }
                    if($count == 2){
                        getPlayerCard($cpush2);
                        $count++;
                    }
                    if($count == 3){
                        getPlayerCard($cpush3);
                        $count++;
                    }
                    if($count == 4){
                        getPlayerCard($cpush1);
                        $count++;
                    }
                    if($count == 5){
                        getPlayerCard($cpush2);
                        $count = 1;
                        $user = 1;
                    }
                }else{
                    $usergoalcount = 0;
                    $cpugoalcount = 0;
                    echo "<script>alert('Match Over');</script>";
                    for($i=0;$i<5;$i++){
                        if($usergoal[$i] == 1){
                            $usergoalcount++;    
                        }
                        if($cpugoal[$i] == 1){
                            $cpugoalcount++;    
                        }
                    }
                }
            }
        }

    ?>
    <div class="Playbutton">
    <form action="gamePage.php" method="post">
        <button class="profile_button px-5">Play</button>
        <input type='hidden' name='play'>
    </form>
    </div>
</body>
<?php?>
