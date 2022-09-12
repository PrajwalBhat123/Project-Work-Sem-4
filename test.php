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
</head>
<body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<?php
    //error_reporting(0);
    include ('index.php');
    //echo "hello";
    require_once('authentication.php');
    if(!$_SESSION['username'])
    {
        header('location:login.php');
    }
    $username = $_SESSION['username'];
    if(isset($_POST['buyPlayer'])){
       // echo $_POST['buyPlayer'];
        $pid = $_POST['buyPlayer'];
        $sql = "select * from player where playerId = '$pid'";
        $result = mysqli_query($con,$sql);
        while($row = mysqli_fetch_assoc($result)){
           $type = $row['playertype'];
           $cost = $row['playercost'];
        }
        $sql = "select userId,wallet from user where username = '$username'";
        $result = mysqli_query($con,$sql);
        while($row = mysqli_fetch_assoc($result)){
           $wallet = $row['wallet'];
           $userId = $row['userId'];
        }
        if($wallet >= $cost){
            $idarray = array();
            $sql = "select playerId from userplayers where userId = $userId";
            $presult = mysqli_query($con,$sql);
           // echo $userId;
            if(mysqli_num_rows($presult) > 0){
                while($player = mysqli_fetch_assoc($presult)){
                    array_push($idarray,$player['playerId']);
                }
            }
            $flag = 1;
            for($i=0;$i<sizeof($idarray);$i++){
                if($pid == $idarray[$i]){
                    $flag = 0;
                }
            }
            if($flag){
                $newwallet = $wallet - $cost;
                $sql  = "update user set wallet = '$newwallet' where username = '$username'";
                $result = mysqli_query($con,$sql);
                $sql = "insert into userPlayers values($userId,$pid,$type)";
                $iresult = mysqli_query($con,$sql);
                $sql = "select * from userTeams where userId = $userId";
                $tresult = mysqli_query($con,$sql);
                $sh1 = null;
                $sh2 = null;
                $sh3 = null;
                $gk = null;
                
                while($player = mysqli_fetch_assoc($tresult)){
                    $sh1 = $player['shooter1'];
                    //echo $player['teamname'];
                    $sh2 = $player['shooter2'];
                    $sh3 = $player['shooter3'];
                    $gk = $player['goalie'];
                }
                if($type == 1){
                    if(is_null($sh1)){
                        $sql = "update userTeams set shooter1 = '$pid' where userId = $userId ";
                        $sresult = mysqli_query($con,$sql);
                        $sql = "commit";
                        $commit = mysqli_query($con,$sql);
                        if($commit){
                            echo 'commit';
                        }
                        if($sresult){
                            echo 'Entered shooter1';
                        }else{
                            echo 'Not entered';
                        }
                    }else if(is_null($sh2)){
                        $sql = "update userTeams set shooter2 = '$pid' where userId = $userId";
                        $sresult = mysqli_query($con,$sql);
                        $sql = "commit";
                        $commit = mysqli_query($con,$sql);
                        if($sresult){
                            echo 'Entered shooter2';
                        }else{
                            echo 'Not entered';
                        }
                    }else if(is_null($sh3)){
                        $sql = "update userTeams set shooter3 = '$pid' where userId = $userId";
                        $sresult = mysqli_query($con,$sql);
                        $sql = "commit";
                        $commit = mysqli_query($con,$sql);
                        if($sresult){
                            echo 'Entered shooter3';
                        }else{
                            echo 'Not entered';
                        }
                    }
                        echo "<script>alert('Player bought');</script>";
                    }else{
                        if(is_null($gk)){
                            $sql = "update userTeams set goalie = '$pid' where userId = $userId";
                            $sresult = mysqli_query($con,$sql);
                            $sql = "commit";
                            $commit = mysqli_query($con,$sql);
                            if($sresult){
                                echo 'Entered goalie';
                            }else{
                                echo 'Not entered';
                            }
                        }
                        echo "<script>alert('Player bought');</script>";
                    }    
                }else{
                    echo "<script>alert('Player already bought and is present in squad !!!')</script>";
                }
            }else{
                echo "<script>alert('Cannot buy player. Not enough money ')</script>";
            }
            unset($_POST['buyPlayer']);
        }
    ?>
    <?php
    // if(isset($_POST['upload'])){
    //     $image = $_FILES['image']['name'];
    //     $path = 'images/'.$image;

    //     move_uploaded_file($_FILES['image']['tmp_name'],$path);
    // }
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
                                    <img class="image" src="images\<?php echo $row['playerimage']?>" alt='Player image' width='50' height='50'></img>
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

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
