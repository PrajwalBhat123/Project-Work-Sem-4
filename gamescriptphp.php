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
</head>
<body>
    <?php
        include 'index.php';
        require_once 'authentication.php';

        if(!$_SESSION['username']){
            header('location:login.php');
        }
        $username = $_SESSION['username'];
        $sql = "select * from userteams where userId = (select userId from user where username = '$username')";
        $result = mysqli_query($con,$sql);
        
        while($player = mysqli_fetch_assoc($result)){
            $sh1 = $row['shooter1'];
            $sh2 = $row['shooter2'];
            $sh3 = $row['shooter3'];
            $gk = $row['goalie'];
        }
        $count = 5;
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
        <button class = "control" onclick ="test(<?php echo $count--;?>)">Test</button><br>
    </div>
    <div class = "right">
        <h1 id="GoalDone1"></h1>

   
     
    </div>
    <div class = "left">
        <h1 id="GoalDone2"></h1>
    </div>

    <div class="scorer">
        <div class="container d-flex justify-content-center">
            <div class="card p-3 py-4">
               <div class="text-center"> 
                   <h3 class="mt-2">Messi</h3>
                   <span class="mt-1 clearfix">Scorer</span>
                   <span class="mt-1 clearfix">Argentina</span>
                   <div class="row mt-3 mb-3">
                   
                     <div class="col-md-4">
                       <h5>Cost</h5>
                       <span class="num">10</span>
                     </div>
                     <div class="col-md-4">
                     <h5>Rating</h5>
                       <span class="num">10</span>
                     </div>
                     <div class="col-md-4">
                     <h5>Score</h5>
                       <span class="num">10</span>
                     </div>
                   
                   </div>
                   
                   <hr class="line">
                   
                      
               </div>
           </div>
       
       
       
       </div> 
    </div>


    <div class="goalkeeper">
        <div class="container d-flex justify-content-center">
            <div class="card p-3 py-4">
               <div class="text-center"> 
                   <h3 class="mt-2">Emiliano</h3>
                   <span class="mt-1 clearfix">GoalKeeper</span>
                   <span class="mt-1 clearfix">Argentina</span>
                   <div class="row mt-3 mb-3">
                   
                     <div class="col-md-4">
                       <h5>Cost</h5>
                       <span class="num">10</span>
                     </div>
                     <div class="col-md-4">
                     <h5>Rating</h5>
                       <span class="num">10</span>
                     </div>
                     <div class="col-md-4">
                     <h5>Score</h5>
                       <span class="num">10</span>
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