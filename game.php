<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Penalty Shootout</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="css/main.css">

        <!-- favicon -->
        <link rel="icon" type="image/png" href="img/favicons/zee-ball-16x16.png" sizes="16x16">
        <link rel="apple-touch-icon" sizes="152x152" type="image/png" href="img/favicons/zee-ball-43x43.png" sizes="43x43">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	
        <link href="buy_card.css" rel="stylesheet" type="text/css"/>
    	  <link href="buy.css" rel="stylesheet" type="text/css"/>
        <style>
          body{
            background-image : url('images/backImage.jpg');
            background-size : cover;
          }

          #movetocenter{
            position: absolute;
            top: 200px;
            width : 400px;
          }

          #moveright{
            position : absolute;
            top : 200px;
            right : 5px;
            width : 300px;
          }

          #word{
            position : absolute;
            top: 10px;
            left : 570px;
            background-color : #FBD603;
          }

          #target{
            position : absolute;
            top: 10px;
            left : 670px;
            width : 40px;
            height : 40px;
            justify-content : center;
            background-color : #ff0000;
          }
        </style>

        <script src="C:\Users\Admin\Downloads\PENALTY_SHOOTOUT_GAME_IN_JAVASCRIPT_WITH_SOURCE_CODE\PenaltyShootoutGame_JavaScript\penalty-shootout-game\js\vendor\modernizr-2.6.2.min.js"></script>
    </head>
    <?php
      error_reporting(0);
      require 'index.php';
      require_once 'authentication.php';
      
      if(!$_SESSION['username']){
        header('location:login.php');
      }
      $username = $_SESSION['username'];
      if(isset($_POST['team'])){
            $teamId = $_POST['team'];
            $_SESSION['newteam'] = $teamId;
      }
      $useTeam = $_SESSION['newteam'];
      $sql = "select * from userteams where userId = (select userId from user where username = '$username')";
      $result = mysqli_query($con,$sql);

      while($row = mysqli_fetch_assoc($result)){
            $sh1 = $row['shooter1'];
            $sh2 = $row['shooter2'];
            $sh3 = $row['shooter3'];
            $gk = $row['goalie'];
      }
      $sql = "select * from cputeams where teamId = '$useTeam'";
      $result = mysqli_query($con,$sql);
      $cpugk = 0;
      while($row = mysqli_fetch_assoc($result)){
          $cpugk = $row['goalie'];
      }
      function getTarget(){
        require 'index.php';
        require 'authentication.php';

        $username = $_SESSION['username'];
        $teamId = $_SESSION['newteam'];

        $sql = "select * from userteams where userId = (select userId from user where username = '$username')";
        $result = mysqli_query($con,$sql);
  
        while($row = mysqli_fetch_assoc($result)){
          $gk = $row['goalie'];
        }
  
        $sql = "select * from cputeams where teamId = '$teamId'";
        $result = mysqli_query($con,$sql);
          
        while($row = mysqli_fetch_assoc($result)){
            $cpush1 = $row['shooter1'];
            $cpush2 = $row['shooter2'];
            $cpush3 = $row['shooter3'];
        }
        $idarray = array($cpush1,$cpush2,$cpush3,$cpush1,$cpush2);
        $goals = array();
        $count = 0;
        for ($i=0;$i<5;$i++){
          $shooter = $idarray[$i];
          $rating = getScore($shooter);
          $gkrating = getScore($gk);
          
          if($rating > $gkrating){
            $check = $rating - $gkrating;
            if( $check > 50){
              $goals = array();
              array_push($goals,1);
            }else if($check > 30){
              $goals = array();
              array_push($goals,1);
              array_push($goals,1);
              array_push($goals,1);
              array_push($goals,0);  
            }else if($check > 10){
              $goals = array();
              array_push($goals,1);
              array_push($goals,1);
              array_push($goals,0);  
            }
            else{
              $goals = array();
              array_push($goals,1);
              array_push($goals,0); 
            }
          }else if($rating < $gkrating){
            $check = $gkrating - $rating;
            if( $check > 50){
              $goals = array();
              array_push($goals,0);
            }else if($check > 30){
              $goals = array();
              array_push($goals,0);
              array_push($goals,0);
              array_push($goals,0);
              array_push($goals,1);
            }else if($check > 10){
              $goals = array();
              array_push($goals,0);
              array_push($goals,0);
              array_push($goals,1);  
            }
            else{
              $goals = array();
              array_push($goals,1);
              array_push($goals,0);
            }
          }else{
            $goals = array();
            array_push($goals,1);
            array_push($goals,0);
          }
          $random = rand(10,200);
          $size = sizeof($goals);
          if($size == 1){
            if($goals[0] == 1){
              $count++;
            }
          }else if($size == 2){
            $new = $random % 2;
            if($goals[$new] == 1){
              $count++;
            }
          }else if($size == 3){
            $new = $random % 3;
            if($goals[$new] == 1){
              $count++;
            }
          }else if($size == 4){
            $new = $random % 4;
            if($goals[$new] == 1){
              $count++;
            }
          }
        }
        return $count;
      }
      
      $countCPUGoals = getTarget();
    
      function getScore($sh){
        require 'index.php';

        $sql = "select * from player where playerId = '$sh'";
        $result = mysqli_query($con,$sql);

        while($row = mysqli_fetch_assoc($result)){
            $gkscore = $row['playerscore'];
        }
        return $gkscore;
      }
        $gkrating = getScore($cpugk);
        $shrating = 0;
        if(isset($_POST['shooter'])){
          $shrating = getScore($_POST['shooter']);
          unset($_POST['shooter']);
       }
       $id = array($sh1,$sh2,$sh3);

       $sql = "SELECT * FROM player WHERE playerId IN (" . implode(',', $id) . ")";
       $result = mysqli_query($con,$sql);

    ?>
    <body>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
          <div id='word'>
            <p>TARGET</p> 
          </div>
          <div id='target'>
          </div>
        
          <div class="container-fluid" id="movetocenter">
        <div class="row" id='movecenter'>
            <div class="col-lg-10" id='movecenter'>
                <div id="demo" class="carousel slide" data-ride="carousel">

                    <ul class="carousel-indicators">
                        <?php
                            $i=0;
                            foreach($result as $row){
                                $actives = '';
                                if($i == 0){
                                    $actives = 'active';
                                }
                        ?>
                        <li data-target="#demo" data-slide-to="<?php echo $i;?>" class="<?php echo $actives;?>"></li>
                        <?php $i++; }?>    
                    </ul>

                    <div class="carousel-inner"id='movecenter'>
                    <?php
                            $i=0;
                            foreach($result as $row){
                                $actives = '';
                                if($i == 0){
                                    $actives = 'active';
                                }
                            
                        ?>
                        <div class="carousel-item <?php echo $actives; ?>" id='movecenter'>
                            <div class="card p-3 py-4" id='movecenter'>
				                <div class="text-center"> 
                                    <img class="image" src="images\players\<?php echo $row['playerimage']?>" alt='Player image' width='50' height='50'></img>
					                <h3 class="mt-2"><?php echo $row['playername'] ?></h3>
					                <?php 
					 		            $sql = "select type from type where typeId = '$row[playertype]'";
							            $typeresult = mysqli_query($con,$sql);
            							while($id = mysqli_fetch_assoc($typeresult)){
			        					$typename = $id['type'];
					            		}
            							$sql = "select countryname from country where countryId = '$row[playercountry]'";
			            				$countryresult = mysqli_query($con,$sql);
						            	while($country = mysqli_fetch_assoc($countryresult)){
								            $countryname = $country['countryname'];
							            }  
					                ?>
					                <span class="mt-1 clearfix"><?php echo $typename ?></span>

            					    <span class="mt-1 clearfix"><?php echo $countryname?></span>
					                <div class="row mt-3 mb-3">
						                <div class="col-md-4">
							                <h5>Cost</h5>
							                <span class="num"><?php echo $row['playercost']?></span>
						                </div>
						                <div class="col-md-4">
							                <h5>Rating</h5>
							                <span class="num"><?php echo $row['playerrating']?></span> 
						                </div>
						                <div class="col-md-4">
							                <h5>Score</h5>
							                <span class="num"><?php echo $row['playerscore']?></span>
						                </div>
					                </div>                   
						            <hr class="line">
					                <div class="profile mt-5">
						                <form action="game.php" method="post">
                                            <button class="profile_button px-5" id = "<?echo $row['$playerid']?>">Select Player</button>
                                            <input type='hidden' name='shooter' value="<?php echo $row['playerId'];?>">
                                        </form>
                                    </div>   
				                </div>
			                </div>
			            </div>
                        <?php $i++; }?>
                    </div>

                    <a class="carousel-control-prev" href="#demo" data-slide="prev">
                        <span class="carousel-control-prev-icon">
                            <button> < </button>
                        </span>
                    </a>
                    <a class="carousel-control-next" href="#demo" data-slide="next">
                        <span class="carousel-control-next-icon">
                            <button> > </button>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>

        <div id="zee-game">

          <div class="goal-keeper standing" id="goal-keeper-state-1"></div>
          <div class="goal-keeper left-jump" id="goal-keeper-state-2"></div>
          <div class="goal-keeper right-jump" id="goal-keeper-state-3"></div>
          <img id="zee-ball" src="img/zee-ball.png" width="43" height="43"/>
          <canvas id="kickAnimation"></canvas>

          <div id="modal-1" class="modal">Click to fix vertical direction</div>
          <div id="modal-2" class="modal">Click to fix horizontal direction</div>
          <div id="modal-3" class="modal">Click to adjust power and kick</div>
          <div id="modal-4" class="modal">Click to try again</div>
          <div id="modal-5" class="modal">Goal!</div>
          <div id="modal-6" class="modal">Go on, give it another shot</div>
          <div id="modal-7" class="modal">Congrats! You won!</div>

          <div id="vertical-direction"></div>
          <div id="vertical-direction-indicator" class="small-ball one-end"></div>
          <div id="horizontal-direction"></div>
          <div id="horizontal-direction-indicator" class="small-ball one-end"></div>
          <div id="power-level"></div>
          <div id="power-level-indicator" class="small-ball one-end"></div>

          <ul id="score-board">
            <li><img src="img/zee-ball.png" width="32" height="32"></li>
            <li><img src="img/zee-ball.png" width="32" height="32"></li>
            <li><img src="img/zee-ball.png" width="32" height="32"></li>
            <li><img src="img/zee-ball.png" width="32" height="32"></li>
            <li><img src="img/zee-ball.png" width="32" height="32"></li>
          </ul>

        </div>

        <?php
          $sql = "select * from player where playerId = '$cpugk'";
          $gkresult = mysqli_query($con,$sql);

          while($row = mysqli_fetch_assoc($gkresult)){
            $gkname = $row['playername'];
            $gkcost = $row['playercost'];
            $gkrating = $row['playerrating'];
            $gkscore = $row['playerscore'];
            $gkcountry = $row['playercountry'];
            $gkimage = $row['playerimage'];
          }

          $sql = "select * from country where countryId = '$gkcountry'";
          $cresult = mysqli_query($con,$sql);

          while($count = mysqli_fetch_assoc($cresult)){
            $gkcountryname = $row['countryname'];
          }
        ?>

        <div class="flex-container" id='moveright'>
		      <div class="container d-flex justify-content-center">
			      <div class="card p-3 py-4">
				      <div class="text-center"> 
              <img src='images/players/<?php echo $gkimage;?>' width = '100px'/> 
					    <h3 class="mt-2"><?php echo $gkname;?></h3>
					    <span class="mt-1 clearfix">Goalkeeper</span>

					   <span class="mt-1 clearfix"><?php echo $gkcountryname;?></span>
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
	

        <script src="js/vendor/pathAnimator.js"></script>
        <script>
          let gkscore = "<?php echo $gkrating;?>";
          let shscore = "<?php echo $shrating;?>"
          let countGoals = "<?php echo $countCPUGoals;?>";
          let target = document.getElementById('target');

          target.innerHTML = countGoals;

          console.log(gkscore,shscore,countGoals);
          let check = shscore - gkscore;                
          let result = 0;
          if(check > 0){
            if(check > 50){
              result = 1;
            }else if(check > 30){
              result = 2;
            }else if(check > 10){
              result = 3;
            }else{
              result = 4;
            }
          }else if(check < 0){
            let newCheck = gkscore - shscore;
            if(newCheck > 50){
              result = 5;
            }else if(newCheck > 30){
              result = 4;
            }else if(newCheck > 10){
              result = 3;
            }else{
              result = 4;
            }
          }
(function() {

    var lastTime = 0;
    var vendors = ['ms', 'moz', 'webkit', 'o'];
    for(var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
        window.requestAnimationFrame = window[vendors[x]+'RequestAnimationFrame'];
        window.cancelAnimationFrame = window[vendors[x]+'CancelAnimationFrame'] 
                                   || window[vendors[x]+'CancelRequestAnimationFrame'];
    }
 
    if (!window.requestAnimationFrame)
        window.requestAnimationFrame = function(callback, element) {
            var currTime = new Date().getTime();
            var timeToCall = Math.max(0, 16 - (currTime - lastTime));
            var id = window.setTimeout(function() { callback(currTime + timeToCall); }, 
              timeToCall);
            lastTime = currTime + timeToCall;
            return id;
        };
 
    if (!window.cancelAnimationFrame)
        window.cancelAnimationFrame = function(id) {
            clearTimeout(id);
        };
}());



var verticalBallStopped = false;
var horizontalBallStopped = false;
var powerBallStopped = false;
var x1, x2, x3;
var chanceCount = 0;

var direction;
var endTop = 440;
var endLeft = 390;
var score = 0;     

var thisName;
var thisTel;
var thisEmail;
var thisCity;

function kick(el, et) {
  
	var player,
		playerImage,
		canvas,
		isItOver;
		
	isItOver = false;

	function gameLoop () {
	  if (isItOver == false) {
	    window.requestAnimationFrame(gameLoop);

	    player.update();
	    player.render();
	  }
	}
	
	function sprite (options) {
	
		var that = {},
			frameIndex = 0,
			tickCount = 0,
			ticksPerFrame = options.ticksPerFrame || 0,
			numberOfFrames = options.numberOfFrames || 1;
		
		that.context = options.context;
		that.width = options.width;
		that.height = options.height;
		that.image = options.image;
		
		that.update = function () {

            tickCount += 1;

            if (tickCount > ticksPerFrame) {

				    tickCount = 0;
				
                if (frameIndex < numberOfFrames - 2) {
                    frameIndex += 1;
                }
                else if (frameIndex == numberOfFrames - 2) {
                    frameIndex += 1;

                    moveBall(el, et);

                    keeperJump();
                }
                else if (frameIndex < numberOfFrames - 1) {
                    frameIndex += 1;
                }
                else {

                  isItOver = true;
                }
            }
        };
		
		that.render = function () {
		
		  that.context.clearRect(0, 0, that.width, that.height);
		  
		  that.context.drawImage(
		    that.image,
		    frameIndex * that.width / numberOfFrames,
		    0,
		    that.width / numberOfFrames,
		    that.height,
		    0,
		    0,
		    that.width / numberOfFrames,
		    that.height);
		};
		
		return that;
	}
	
  canvas = document.getElementById("kickAnimation");
	canvas.width = 150;
	canvas.height = 270;
	
	playerImage = new Image();	
	
	player = sprite({
		context: canvas.getContext("2d"),
		width: 300,
		height: 270,
		image: playerImage,
		numberOfFrames: 2,
		ticksPerFrame: 20
	});
	
	playerImage.addEventListener("load", gameLoop);
	playerImage.src = "img/slow-kick-right.png";
	
}

function keeperJump() {
                    var randomBinary = Math.floor(Math.random()*2);
                    var someTimeAfter = window.setTimeout(function() {
                      if ((randomBinary == 0) && (x3 >= 0.55)) {
                    document.getElementById('goal-keeper-state-1').style.display = "none";
                        document.getElementById('goal-keeper-state-2').style.display = "block";
                        direction = "left";
                      }
                      else if ((randomBinary == 1) && (x3 >= 0.55)) {
                    document.getElementById('goal-keeper-state-1').style.display = "none";
                        document.getElementById('goal-keeper-state-3').style.display = "block";
                        direction = "right";
                      }
                    }, 0);
}

function moveBall(el, et) {
  var path = "M " + "390" + "," + "440" + " "+ el + "," + et;  
	  pathAnimator = new PathAnimator( path ),	
    objToAnimate = document.getElementById('zee-ball'),	
	  speed = 0.5,	 		
	  reverse = false,	
	  startOffset = 0		
	  
  pathAnimator.start( speed, step, reverse, startOffset, finish);


  function step( point, angle ){
	  objToAnimate.style.cssText = "top:" + point.y + "px;" +
								  "left:" + point.x + "px;" +
								  "transform:rotate("+ angle +"deg);" +
								  "-webkit-transform:rotate("+ angle +"deg);";
  }
  
  function finish(){
	  if ((endTop >= 98)&&(endTop <= 292)&&(endLeft >= 114)&&(endLeft <= 710)) {
	    if ((direction == "right")&&(endLeft < 362)) {
	      incrementScore();
	      if (chanceCount < 4) {modalElem5.setAttribute("class","modal active");}
	      else {
	        if (score > countGoals) {modalElem7.setAttribute("class","modal active");
            alert('You won !!!');
            if(confirm('You won !!!')){
              window.location.href = 'win.php';
            }else{
              window.location.href = 'win.php';
            }
          }
	        else {modalElem6.innerHTML = "You scored " + score + " goal(s) out of 5.";
                alert('You Lost !!!');
                if(confirm('You lost !!!')){
                  window.location.href = 'homeindex.php';
                }else{
                  window.location.href = 'homeindex.php';
                }  
              }
	      }
	    }
	    else if ((direction == "left")&&(endLeft >= 362)) {
	      incrementScore();
	      if (chanceCount < 4) {modalElem5.setAttribute("class","modal active");}
	      else {
	        if (score > 4) {modalElem7.setAttribute("class","modal active");}
	        else {modalElem6.innerHTML = "You scored " + score + " goal(s) out of 5. Click to try again";
	              modalElem6.setAttribute("class","modal active");}
	      }
	    }
	    else {
	      if (chanceCount < 4) {modalElem4.setAttribute("class","modal active");}
	      else {
	        modalElem6.innerHTML = "You scored " + score + " goal(s) out of 5. Click to try again";
	        modalElem6.setAttribute("class","modal active");
	      }
	    }
	  }
	  else {
	      if (chanceCount < 4) {modalElem4.setAttribute("class","modal active");}
	      else {
	        modalElem6.innerHTML = "You scored " + score + " goal(s) out of 5. Click to try again";
	        modalElem6.setAttribute("class","modal active");
	      }
	  }
  }
}

function moveVerticalSmallBall() {
  var thing = document.getElementById('vertical-direction-indicator');
  if (thing.getAttribute('class') == "small-ball one-end") {
    thing.setAttribute('class','small-ball other-end');
  }
  else if (thing.getAttribute('class') == "small-ball other-end") {
    thing.setAttribute('class','small-ball one-end');
  }
}
  var verticalIndicatorOscillate;
  if(result == 1){
    verticalIndicatorOscillate = window.setInterval(moveVerticalSmallBall, 1000);
  }else if(result == 2){
    verticalIndicatorOscillate = window.setInterval(moveVerticalSmallBall, 500);
  }else if(result == 3){
    verticalIndicatorOscillate = window.setInterval(moveVerticalSmallBall, 300);
  }else if(result == 4){
    verticalIndicatorOscillate = window.setInterval(moveVerticalSmallBall, 200);
  }else if(result == 5){
    verticalIndicatorOscillate = window.setInterval(moveVerticalSmallBall, 500);
  }

function moveHorizontalSmallBall() {
  var thing = document.getElementById('horizontal-direction-indicator');
  if (thing.getAttribute('class') == "small-ball one-end") {
    thing.setAttribute('class','small-ball other-end');
  }
  else if (thing.getAttribute('class') == "small-ball other-end") {
    thing.setAttribute('class','small-ball one-end');
  }
}
var horizontalIndicatorOscillate;
if(result == 1){
    horizontalIndicatorOscillate = window.setInterval(moveHorizontalSmallBall, 1000);
  }else if(result == 2){
    horizontalIndicatorOscillate = window.setInterval(moveHorizontalSmallBall, 500);
  }else if(result == 3){
    horizontalIndicatorOscillate = window.setInterval(moveHorizontalSmallBall, 300);
  }else if(result == 4){
    horizontalIndicatorOscillate = window.setInterval(moveHorizontalSmallBall, 200);
  }else if(result == 5){
    horizontalIndicatorOscillate = window.setInterval(moveHorizontalSmallBall, 500);
  }

function movePowerSmallBall() {
  var thing = document.getElementById('power-level-indicator');
  if (thing.getAttribute('class') == "small-ball one-end") {
    thing.setAttribute('class','small-ball other-end');
  }
  else if (thing.getAttribute('class') == "small-ball other-end") {
    thing.setAttribute('class','small-ball one-end');
  }
}

var powerLevelOscillate; 
if(result == 1){
    powerLevelOscillate = window.setInterval(movePowerSmallBall, 1000);
  }else if(result == 2){
    powerLevelOscillate = window.setInterval(movePowerSmallBall, 500);
  }else if(result == 3){
    powerLevelOscillate = window.setInterval(movePowerSmallBall, 300);
  }else if(result == 4){
    powerLevelOscillate = window.setInterval(movePowerSmallBall, 200);
  }else if(result == 5){
    powerLevelOscillate = window.setInterval(movePowerSmallBall, 500);
  }
function refreshScene() {
  document.getElementById('vertical-direction-indicator').setAttribute('style','')
  document.getElementById('vertical-direction-indicator').setAttribute('class','small-ball one-end');
  document.getElementById('horizontal-direction-indicator').setAttribute('style','')
  document.getElementById('horizontal-direction-indicator').setAttribute('class','small-ball one-end');
  document.getElementById('power-level-indicator').setAttribute('style','')
  document.getElementById('power-level-indicator').setAttribute('class','small-ball one-end');
  verticalBallStopped = false;
  horizontalBallStopped = false;
  powerBallStopped = false;
  
  document.getElementById('zee-ball').setAttribute('style','')
  document.getElementById('zee-ball').setAttribute('class','');
  
  var contextForNow = document.getElementById('kickAnimation').getContext('2d');
  contextForNow.clearRect(0,0,150,270);
  
  document.getElementById('goal-keeper-state-2').style.display = "none";
  document.getElementById('goal-keeper-state-3').style.display = "none";
  document.getElementById('goal-keeper-state-1').style.display = "block";
}

function stopVerticalBall() {
      var element = document.getElementById('vertical-direction-indicator'),
        style = window.getComputedStyle(element),
        top = style.getPropertyValue('top');
      x1 = parseInt(top.substring(0,3), 10);
      x1 = (459-x1)/117;
      console.log(x1);
      element.setAttribute("class", "small-ball");
      element.style.top = top;
      verticalBallStopped = true;
}

function stopHorizontalBall() {
      var element = document.getElementById('horizontal-direction-indicator'),
        style = window.getComputedStyle(element),
        left = style.getPropertyValue('left');
      x2 = parseInt(left.substring(0,3), 10);
      x2 = (x2-60)/119;
      console.log(x2);
      element.setAttribute("class", "small-ball");
      element.style.left = left;
      horizontalBallStopped = true;
}

function stopPowerBallAndKick() {
      var element = document.getElementById('power-level-indicator'),
        style = window.getComputedStyle(element),
        right = style.getPropertyValue('right');
      x3 = parseInt(right.substring(0,3), 10);
      x3 = (191-x3)/121;
      console.log(x3);
      
      element.setAttribute("class", "small-ball");
      element.style.right = right;
      powerBallStopped = true;
      
      var Et, El, Qt, Ql;
      Et = 440 - ((0.8 + x1)/1.8)*x3*440 + 0.3*x3*((Math.abs(0.5-x2))/0.5)*440;
      var stringEt = Et.toString(10);
      El = 405 + x3*(x2-0.5)*810
      var stringEl = El.toString(10);
                      
      endTop = Et;
      endLeft = El;
      
      console.log(stringEl + " " + stringEt);
      kick(stringEl, stringEt)
}

function kickingProcess() {
    if ((verticalBallStopped == false) && (horizontalBallStopped == false) && (powerBallStopped == false)) {
      stopVerticalBall();
    }
    else if ((verticalBallStopped == true) && (horizontalBallStopped == false) && (powerBallStopped == false)) {
      stopHorizontalBall();
    }
    else if ((verticalBallStopped == true) && (horizontalBallStopped == true) && (powerBallStopped == false)) {
      stopPowerBallAndKick();
    }
    else if ((verticalBallStopped == true) && (horizontalBallStopped == true) && (powerBallStopped == true)) {
      if (chanceCount < 4) {
        chanceCount += 1;
      }
      else {
        chanceCount = 0;
        score = 0;
        document.getElementById('score-board').getElementsByTagName('li')[0].setAttribute('class', '');
        document.getElementById('score-board').getElementsByTagName('li')[1].setAttribute('class', '');
        document.getElementById('score-board').getElementsByTagName('li')[2].setAttribute('class', '');
        document.getElementById('score-board').getElementsByTagName('li')[3].setAttribute('class', '');
        document.getElementById('score-board').getElementsByTagName('li')[4].setAttribute('class', '');
      }
      modalElem4.setAttribute("class","modal");
      modalElem5.setAttribute("class","modal");
      modalElem6.setAttribute('class','modal');
      modalElem7.setAttribute('class','modal');
      refreshScene();
    }
}

function incrementScore() {
  if ((chanceCount == 0)) {
      document.getElementById('score-board').getElementsByTagName('li')[0].setAttribute('class', 'scored');
      score += 1;
  }
  else if ((chanceCount == 1)) {
      document.getElementById('score-board').getElementsByTagName('li')[1].setAttribute('class', 'scored');
      score += 1;
  }
  else if ((chanceCount == 2)) {
      document.getElementById('score-board').getElementsByTagName('li')[2].setAttribute('class', 'scored');
      score += 1;
  }
  else if ((chanceCount == 3)) {
      document.getElementById('score-board').getElementsByTagName('li')[3].setAttribute('class', 'scored');
      score += 1;
  }
  else if ((chanceCount == 4)) {
      document.getElementById('score-board').getElementsByTagName('li')[4].setAttribute('class', 'scored');
      score += 1;
  }
}


window.onclick = function() {
  kickingProcess();
}

modalElem1 = document.getElementById('modal-1');
modalElem2 = document.getElementById('modal-2');
modalElem3 = document.getElementById('modal-3');
modalElem4 = document.getElementById('modal-4');
modalElem5 = document.getElementById('modal-5');
modalElem6 = document.getElementById('modal-6');
modalElem7 = document.getElementById('modal-7');

        </script>

    </body>
</html>
