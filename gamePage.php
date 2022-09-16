<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" type="text/css" href="gamestyle.css">
    <link href="buy_card.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>FOOTBALL GAME</title>
    <style>
        .goalkeeper{
            margin-bottom : 20px;
            margin-right : 20px;
        }
    </style>
</head>
<body>
    <?php
        require 'teamselction.php';
        require 'index.php';
        require_once 'authentication.php';
        if(isset($_SESSION['team'])){
            $teamId = $_SESSION['team'];
        }
        $_SESSION['newteam'] = $teamId;
        if(!$_SESSION['username']){
            header('location:login.php');
        }
        $username = $_SESSION['username'];

        $sql = "select * from userteams where userId = (select userId from user where username = '$username')";
        $result = mysqli_query($con,$sql);
        
        while($row = mysqli_fetch_assoc($result)){
            $sh1 = $row['shooter1'];
            $sh2 = $row['shooter2'];
            $sh3 = $row['shooter3'];
        }

        $sql = "select * from player where playerId = '$sh1'";
        $result = mysqli_query($con,$sql);
        while($row = mysqli_fetch_assoc($result)){
            $name1 = $row['playername'];
            $cost1 = $row['playercost'];
            $rating1 = $row['playerrating'];
            $score1 = $row['playerscore'];
            $countryId1 = $row['playercountry'];
            $image1 = $row['playerimage'];
        }

        $sql = "select * from country where countryId = '$countryId1'";
        $result = mysqli_query($con,$sql);
        while($row = mysqli_fetch_assoc($result)){
            $country1 = $row['countryname'];
        }

        $sql = "select * from player where playerId = '$sh2'";
        $result = mysqli_query($con,$sql);
        while($row = mysqli_fetch_assoc($result)){
            $name2 = $row['playername'];
            $cost2 = $row['playercost'];
            $rating2 = $row['playerrating'];
            $score2 = $row['playerscore'];
            $countryId2 = $row['playercountry'];
            $image2 = $row['playerimage'];
        }

        $sql = "select * from country where countryId = '$countryId2'";
        $result = mysqli_query($con,$sql);
        while($row = mysqli_fetch_assoc($result)){
            $country2 = $row['countryname'];
        }

        $sql = "select * from player where playerId = '$sh3'";
        $result = mysqli_query($con,$sql);
        while($row = mysqli_fetch_assoc($result)){
            $name3 = $row['playername'];
            $cost3 = $row['playercost'];
            $rating3 = $row['playerrating'];
            $score3 = $row['playerscore'];
            $countryId3 = $row['playercountry'];
            $image3 = $row['playerimage'];
        }

        $sql = "select * from country where countryId = '$countryId3'";
        $result = mysqli_query($con,$sql);
        while($row = mysqli_fetch_assoc($result)){
            $country3 = $row['countryname'];
        }

        echo $teamId;
        $sql = "select * from cputeams where teamId = '$teamId'";
        $result = mysqli_query($con,$sql);
        
        while($row = mysqli_fetch_assoc($result)){
            $gk = $row['goalie'];
        }

        $sql = "select * from player where playerId = '$gk'";
        $result = mysqli_query($con,$sql);

        while($row = mysqli_fetch_assoc($result)){
            $gkname = $row['playername'];
            $gkcost = $row['playercost'];
            $gkrating = $row['playerrating'];
            $gkscore = $row['playerscore'];
            $gkcountryId = $row['playercountry'];
            $gkimage = $row['playerimage'];
            //echo $gkname,$gkcost,$gkrating,$gkscore;
        }
        $sql = "select * from country where countryId = '$gkcountryId'";
        $result = mysqli_query($con,$sql);
        while($row = mysqli_fetch_assoc($result)){
            $gkcountry = $row['countryname'];
        }
        

        if(isset($_POST['shooter1'])){
            // getPlayerCard($sh1);
             $rating = $rating1;
             $score = $score1;
             unset($_POST['shooter1']);
         }
         if(isset($_POST['shooter2'])){
            // getPlayerCard($sh2);
            $rating = $rating1;
            $score = $score1;
            unset($_POST['shooter2']);
         }
         if(!isset($_POST['shooter3'])){
             //getPlayerCard($sh3);
             $rating = $rating1;
             $score = $score1;
             unset($_POST['shooter3']);
         }
 
    ?> 
    <img class ="ground" src="https://us.123rf.com/450wm/sarawuth702/sarawuth7021604/sarawuth702160400005/55087377-soccer-goal.jpg?ver=6" alt="">
    <img src="goalkeeper.png" class="i2" id = "b2" alt="">
    <button id = "b1" class = "ball" onclick="goal()"> <img class = "i1" src="football.png" alt=""> </button>

    <div class = "controlgoal">
        <button class = "control" onclick ="LeftTop()">Left-Top</button>
        <button class = "control" onclick ="CenterTop()">Center-Top</button>
        <button class = "control" onclick ="RightTop()">Right-Top</button><br>
        <button class = "control" onclick ="LeftMiddle()">Left-Middle</button>
        <button class = "control" onclick ="CenterMiddle()">Center-Middle</button>
        <button class = "control" onclick ="RightMiddle()">Right-Middle</button><br>
        <button class = "control" onclick ="LeftBottom()">Left-Bottom</button>
        <button class = "control" onclick ="CenterBottom()">Center-Bottom</button>
        <button class = "control" onclick ="RightBottom()">Right-Bottom</button><br>
        <h1>SCORE BOARD : <span id="Score">0</span></h1>
        <form action="gamePage.php" method="post">
            <button class="profile_button px-5" id = "<?echo $sh1?>" onClick = "selectshooter1()"><?php echo $name1;?></button>
            <input type='hidden' name='shooter1' value="<?php echo $sh1;?>">
            <button class="profile_button px-5" id = "<?echo $sh2?>" onClick = "selectshooter2()"><?php echo $name2;?></button>
            <input type='hidden' name='shooter2' value="<?php echo $sh2;?>">
            <button class="profile_button px-5" id = "<?echo $sh3?>" onClick = "selectshooter3()"><?php echo $name3;?></button>
            <input type='hidden' name='shooter3' value="<?php echo $sh3;?>">
        </form>
    </div>
    <div class = "right">
        <h1 id="GoalDone1"></h1>
    </div>
    <div class = "left">
        <h1 id="GoalDone2"></h1>
    </div>

    <?php
    ?>
    
    <div class='scorer' id='shooter1'>
        <div class='container d-flex justify-content-center'>
            <div class='card p-3 py-4'>
                <div class='text-center'>
                    <img src='images/players/<?php echo $image1;?>' width="20px" height="30px" /> 
                    <h3 class='mt-2'> <?php echo $name1; ?> </h3>
                    <span class='mt-1 clearfix'> Shooter </span>
                    <span class='mt-1 clearfix'> <?php echo $country1; ?> </span>
                    <div class='row mt-3 mb-3'>
                        <div class='col-md-4'>
                            <h5>Cost</h5>
                            <span class='num'><?php echo $cost1; ?></span>
                        </div>
                        <div class='col-md-4'>
                            <h5>Rating</h5>
                            <span class='num'><?php echo $rating1; ?></span>
                        </div>
                        <div class='col-md-4'>
                            <h5>Score</h5>
                            <span class='num'><?php echo $score1; ?> </span>
                        </div>
                    </div>
                    <hr class='line'>  
                </div>
            </div>           
        </div> 
    </div>
    
    
    <div class='scorer' id='shooter2'>
        <div class='container d-flex justify-content-center'>
            <div class='card p-3 py-4'>
                <div class='text-center'>
                    <img src='images/players/<?php echo $image2;?>' width="20px" height="30px"/> 
                    <h3 class='mt-2'> <?php echo $name2; ?> </h3>
                    <span class='mt-1 clearfix'> Shooter </span>
                    <span class='mt-1 clearfix'> <?php echo $country2; ?> </span>
                    <div class='row mt-3 mb-3'>
                        <div class='col-md-4'>
                            <h5>Cost</h5>
                            <span class='num'><?php echo $cost2; ?></span>
                        </div>
                        <div class='col-md-4'>
                            <h5>Rating</h5>
                            <span class='num'><?php echo $rating2; ?></span>
                        </div>
                        <div class='col-md-4'>
                            <h5>Score</h5>
                            <span class='num'><?php echo $score2; ?> </span>
                        </div>
                    </div>
                    <hr class='line'>  
                </div>
            </div>           
        </div> 
    </div>
    
    <div class='scorer' id='shooter3'>
        <div class='container d-flex justify-content-center'>
            <div class='card p-3 py-4'>
                <div class='text-center'>
                    <img src='images/players/<?php echo $image3;?>' width="20px" height="30px"/> 
                    <h3 class='mt-2'> <?php echo $name3; ?> </h3>
                    <span class='mt-1 clearfix'> Shooter </span>
                    <span class='mt-1 clearfix'> <?php echo $country3; ?> </span>
                    <div class='row mt-3 mb-3'>
                        <div class='col-md-4'>
                            <h5>Cost</h5>
                            <span class='num'><?php echo $cost3; ?></span>
                        </div>
                        <div class='col-md-4'>
                            <h5>Rating</h5>
                            <span class='num'><?php echo $rating3; ?></span>
                        </div>
                        <div class='col-md-4'>
                            <h5>Score</h5>
                            <span class='num'><?php echo $score3; ?> </span>
                        </div>
                    </div>
                    <hr class='line'>  
                </div>
            </div>           
        </div> 
    </div>
       
    <div class="goalkeeper">
        <div class="container d-flex justify-content-center">
            <div class="card p-3 py-4">
                <div class="text-center"> 
                    <img src="images/players/<?php echo $gkimage;?>" />
                    <h3 class="mt-2"><?php echo $gkname;?></h3>
                    <span class="mt-1 clearfix">GoalKeeper</span>
                    <span class="mt-1 clearfix"><?php echo $gkcountry;?></span>
                    <div class="row mt-3 mb-3">
                        <div class="col-md-4">
                            <h5>Cost</h5>
                            <span class="num"><?php echo $gkcost;?></span>
                        </div>
                        <div class="col-md-4">
                            <h5>Rating</h5>
                            <span class="num"><?php echo $gkrating;?></span>
                        </div>
                        <div class="col-md-4">
                            <h5>Score</h5>
                            <span class="num"><?php echo $gkscore;?></span>
                        </div>
                    </div>
                    <hr class="line">      
                </div>
            </div>   
        </div> 
    </div>
    
    <script src="gamescript.js"></script>

</body>
</html>