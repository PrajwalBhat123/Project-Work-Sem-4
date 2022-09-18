<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Player</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	
    <link href="buy_card.css" rel="stylesheet" type="text/css"/>
	<link href="buy.css" rel="stylesheet" type="text/css"/>

    <link rel="stylesheet" href="css/normalize.min.css">
    <link rel="stylesheet" href="css/main.css">

        <!-- favicon -->
    <link rel="icon" type="image/png" href="img/favicons/zee-ball-16x16.png" sizes="16x16">
    <link rel="apple-touch-icon" sizes="152x152" type="image/png" href="img/favicons/zee-ball-43x43.png" sizes="43x43">


    <script src="js/vendor/modernizr-2.6.2.min.js"></script>
   
</head>
<body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<?php
    //error_reporting(0);
    include ('index.php');
    require_once('authentication.php');
        $sql = "select * from player";
    	$result = mysqli_query($con,$sql);
			   
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10">
                <div id="demo" class="carousel slide" data-ride="carousel">

<!-- Indicators -->
                    <ul class="carousel-indicators">
                        <?php
                            $i=0;
                            //echo $i;
                            foreach($result as $row){
                                $actives = '';
                                //echo $i;
                                if($i == 0){
                                    $actives = 'active';
                                }
                                //echo $actives;
                        ?>
                        <li data-target="#demo" data-slide-to="<?php echo $i;?>" class="<?php echo $actives;?>"></li>
                        <?php $i++; }?>    
                    </ul>

<!-- The slideshow -->
                    <div class="carousel-inner" id="cardmove">
                    <?php
                            $i=0;
                            foreach($result as $row){
                                $actives = '';
                                if($i == 0){
                                    $actives = 'active';
                                }
                            
                        ?>
                        <div class="carousel-item <?php echo $actives ?>">
                            <!-- <img src="la.jpg" alt="Los Angeles"> -->
                            <div class="card p-3 py-4">
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
						                <form action="test.php" method="post">
                                            <button class="profile_button px-5" id = "<?echo $row['$playerid']?>">Select Player</button>
                                            <input type='hidden' name='buyPlayer' value="<?php echo $row['playerId'];?>">
                                        </form>
                                    </div>   
				                </div>
			                </div>
			            </div>
                        <?php $i++; }?>
                    </div>

<!-- Left and right controls -->
                    <a class="carousel-control-prev" href="#demo" data-slide="prev">
                        <span class="carousel-control-prev-icon">
                            <button> <-- </button>
                        </span>
                    </a>
                    <a class="carousel-control-next" href="#demo" data-slide="next">
                        <span class="carousel-control-next-icon">
                            <button> --> </button>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div id="zee-game">

<!-- game objects -->
<div class="goal-keeper standing" id="goal-keeper-state-1"></div>
<div class="goal-keeper left-jump" id="goal-keeper-state-2"></div>
<div class="goal-keeper right-jump" id="goal-keeper-state-3"></div>
<img id="zee-ball" src="img/zee-ball.png" width="43" height="43"/>
<canvas id="kickAnimation"></canvas>

<!-- modals -->
<div id="modal-1" class="modal">Click to fix vertical direction</div>
<div id="modal-2" class="modal">Click to fix horizontal direction</div>
<div id="modal-3" class="modal">Click to adjust power and kick</div>
<div id="modal-4" class="modal">Click to try again</div>
<div id="modal-5" class="modal">Goal!</div>
<div id="modal-6" class="modal">Go on, give it another shot</div>
<div id="modal-7" class="modal">Congrats! You won!</div>

<!-- control meters -->
<div id="vertical-direction"></div>
<div id="vertical-direction-indicator" class="small-ball one-end"></div>
<div id="horizontal-direction"></div>
<div id="horizontal-direction-indicator" class="small-ball one-end"></div>
<div id="power-level"></div>
<div id="power-level-indicator" class="small-ball one-end"></div>

<!-- scoring -->
<ul id="score-board">
  <li><img src="img/zee-ball.png" width="32" height="32"></li>
  <li><img src="img/zee-ball.png" width="32" height="32"></li>
  <li><img src="img/zee-ball.png" width="32" height="32"></li>
  <li><img src="img/zee-ball.png" width="32" height="32"></li>
  <li><img src="img/zee-ball.png" width="32" height="32"></li>
</ul>

</div>
<script src="js/vendor/pathAnimator.js"></script>
        <script>
        (function() {
	// http://paulirish.com/2011/requestanimationframe-for-smart-animating/
	// http://my.opera.com/emoller/blog/2011/12/20/requestanimationframe-for-smart-er-animating
	// requestAnimationFrame polyfill by Erik Möller. fixes from Paul Irish and Tino Zijdel
	// MIT license

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



// stopping the oscillating indicators, recording values of indicators and keeping track of goals
var verticalBallStopped = false;
var horizontalBallStopped = false;
var powerBallStopped = false;
var x1, x2, x3;
var chanceCount = 0;
// recording the direction of the jump by the player, goal or not and the end co-ordinates of the ball
var direction;
var endTop = 440;
var endLeft = 390;
var score = 0;     
// variables to store user information
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
				
                // If the current frame index is in range
                if (frameIndex < numberOfFrames - 2) {
                    // Go to the next frame
                    frameIndex += 1;
                }
                else if (frameIndex == numberOfFrames - 2) {
                    frameIndex += 1;
                    // start moving the ball
                    moveBall(el, et);
                    // make the goal keeper jump
                    keeperJump();
                }
                else if (frameIndex < numberOfFrames - 1) {
                    frameIndex += 1;
                }
                else {
                    // frameIndex = 0; // don't repeat the animation
                    isItOver = true;
                }
            }
        };
		
		that.render = function () {
		
		  // Clear the canvas
		  that.context.clearRect(0, 0, that.width, that.height);
		  
		  // Draw the animation
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
	
	// Get canvas
	canvas = document.getElementById("kickAnimation");
	canvas.width = 150;
	canvas.height = 270;
	
	// Create sprite sheet
	playerImage = new Image();	
	
	// Create sprite
	player = sprite({
		context: canvas.getContext("2d"),
		width: 300,
		height: 270,
		image: playerImage,
		numberOfFrames: 2,
		ticksPerFrame: 20
	});
	
	// Load sprite sheet
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
  var path = "M " + "390" + "," + "440" + " "+ el + "," + et; // Ml Mt Ql Qt El Et " Q " + "460" + "," + "340" + 
	  pathAnimator = new PathAnimator( path ),	// initiate a new pathAnimator object
	  objToAnimate = document.getElementById('zee-ball'),	// The object that will move along the path
	  speed = 0.5,	 		// seconds that will take going through the whole path
	  reverse = false,	// go back of forward along the path
	  startOffset = 0		// between 0% to 100%
	  
  // start animating the ball
  pathAnimator.start( speed, step, reverse, startOffset, finish);

  // make the ball smaller in size with respect to the distance from the eye please!

  function step( point, angle ){
	  // do something every "frame" with: point.x, point.y & angle
	  objToAnimate.style.cssText = "top:" + point.y + "px;" +
								  "left:" + point.x + "px;" +
								  "transform:rotate("+ angle +"deg);" +
								  "-webkit-transform:rotate("+ angle +"deg);";
  }
  
  function finish(){
	  // see if the ball has reached the goal
	  if ((endTop >= 98)&&(endTop <= 292)&&(endLeft >= 114)&&(endLeft <= 710)) {
	    if ((direction == "right")&&(endLeft < 362)) {
	      // increase the score and indicate it on the score board
	      incrementScore();
	      if (chanceCount < 4) {modalElem5.setAttribute("class","modal active");}
	      else {
	        if (score > 4) {modalElem7.setAttribute("class","modal active");}
	        else {modalElem6.innerHTML = "You scored " + score + " goal(s) out of 5. Click to try again";
	              modalElem6.setAttribute("class","modal active");}
	      }
	    }
	    else if ((direction == "left")&&(endLeft >= 362)) {
	      // increase the score and indicate it on the score board
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

// to osciallte the vertical direction indicator
function moveVerticalSmallBall() {
  var thing = document.getElementById('vertical-direction-indicator');
  if (thing.getAttribute('class') == "small-ball one-end") {
    thing.setAttribute('class','small-ball other-end');
  }
  else if (thing.getAttribute('class') == "small-ball other-end") {
    thing.setAttribute('class','small-ball one-end');
  }
}

var verticalIndicatorOscillate = window.setInterval(moveVerticalSmallBall, 320);

// to osciallte the horizontal direction indicator
function moveHorizontalSmallBall() {
  var thing = document.getElementById('horizontal-direction-indicator');
  if (thing.getAttribute('class') == "small-ball one-end") {
    thing.setAttribute('class','small-ball other-end');
  }
  else if (thing.getAttribute('class') == "small-ball other-end") {
    thing.setAttribute('class','small-ball one-end');
  }
}

var verticalIndicatorOscillate = window.setInterval(moveHorizontalSmallBall, 320);

// to osciallte the vertical direction indicator
function movePowerSmallBall() {
  var thing = document.getElementById('power-level-indicator');
  if (thing.getAttribute('class') == "small-ball one-end") {
    thing.setAttribute('class','small-ball other-end');
  }
  else if (thing.getAttribute('class') == "small-ball other-end") {
    thing.setAttribute('class','small-ball one-end');
  }
}

var powerLevelOscillate = window.setInterval(movePowerSmallBall, 320);

function refreshScene() {
  // stop the meters
  document.getElementById('vertical-direction-indicator').setAttribute('style','')
  document.getElementById('vertical-direction-indicator').setAttribute('class','small-ball one-end');
  document.getElementById('horizontal-direction-indicator').setAttribute('style','')
  document.getElementById('horizontal-direction-indicator').setAttribute('class','small-ball one-end');
  document.getElementById('power-level-indicator').setAttribute('style','')
  document.getElementById('power-level-indicator').setAttribute('class','small-ball one-end');
  verticalBallStopped = false;
  horizontalBallStopped = false;
  powerBallStopped = false;
  
  // stop the ball
  document.getElementById('zee-ball').setAttribute('style','')
  document.getElementById('zee-ball').setAttribute('class','');
  
  // clear the canvas or in other words, make the player vanish
  var contextForNow = document.getElementById('kickAnimation').getContext('2d');
  contextForNow.clearRect(0,0,150,270);
  
  // reset position of the goal keeper
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
      // fix the position of the small ball to wherever it is
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
      // fix the position of the small ball to wherever it is
      element.setAttribute("class", "small-ball");
      element.style.left = left;
      horizontalBallStopped = true;
}

function stopPowerBallAndKick() {
      // get position of the small ball
      var element = document.getElementById('power-level-indicator'),
        style = window.getComputedStyle(element),
        right = style.getPropertyValue('right');
      x3 = parseInt(right.substring(0,3), 10);
      x3 = (191-x3)/121;
      console.log(x3);
      
      // fix the position of the small ball to wherever it is
      element.setAttribute("class", "small-ball");
      element.style.right = right;
      powerBallStopped = true;
      
      // Calculate the ending position of the ball
      var Et, El, Qt, Ql;
      Et = 440 - ((0.8 + x1)/1.8)*x3*440 + 0.3*x3*((Math.abs(0.5-x2))/0.5)*440;
      var stringEt = Et.toString(10);
      El = 405 + x3*(x2-0.5)*810
      var stringEl = El.toString(10);
                      
      // ending co-ordinates of the ball
      endTop = Et;
      endLeft = El;
      
      // let the player kick the ball now!
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

// =======================================================================================================

window.onclick = function() {
  kickingProcess();
}

// all the modals to be displayed
modalElem1 = document.getElementById('modal-1');
modalElem2 = document.getElementById('modal-2');
modalElem3 = document.getElementById('modal-3');
modalElem4 = document.getElementById('modal-4');
modalElem5 = document.getElementById('modal-5');
modalElem6 = document.getElementById('modal-6');
modalElem7 = document.getElementById('modal-7');

        </script>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
