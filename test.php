<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

</head>
<body>
<?php
    error_reporting(0);
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
            if(mysqli_num_rows($presult) > 0){
                while($player = mysqli_fetch_assoc($presult)){
                    array_push($idarray,$player['playerId']);
                }
            }
            $sql = "SELECT * FROM userplayers WHERE playerId IN (" . implode(',', $idarray) . ")";
            $playerresult = mysqli_query($con,$sql);
            if(!mysqli_num_rows($playerresult)){
                $newwallet = $wallet - $cost;
                $sql  = "update user set wallet = '$newwallet' where username = '$username'";
                $result = mysqli_query($con,$sql);
                $sql = "insert into userPlayers values($userId,$pid,$type)";
                $iresult = mysqli_query($con,$sql);
                $sql = "select * from userTeams where userId = $userId";
                $tresult = mysqli_query($con,$sql);
                while($player = mysqli_fetch_assoc($tresult)){
                    $sh1 = $row['shooter1'];
                    $sh2 = $row['shooter2'];
                    $sh3 = $row['shooter3'];
                    $gk = $row['goalie'];
                }
                if($type == 1){
                    if(is_null($sh1)){
                        $sql = "insert into userTeams column(shooter1) values($pid)";
                        $sresult = mysqli_query($con,$sql);
                    }else if(is_null($sh2)){
                        $sql = "insert into userTeams column(shooter2) values($pid)";
                        $sresult = mysqli_query($con,$sql);
                    }else if(is_null($sh3)){
                        $sql = "insert into userTeams column(shooter3) values($pid)";
                        $sresult = mysqli_query($con,$sql);
                    }
                        echo "<script>alert('Player bought');</script>";
                    }else{
                        if(is_null($gk)){
                            $sql = "insert into userPlayers column(goalie) values($pid)";
                            $sresult = mysqli_query($con,$sql);
                        }
                        echo "<script>alert('Player bought');</script>";
                    }    
                }else{
                    echo "<script>alert('Player already bought and is present in squad !!!')</script>";
                }
            }else{
                echo "<script>alert('Cannot buy player. Not enough money ')</script>";
            }
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
                    <div class="carousel-inner">
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
                        <span class="carousel-control-prev-icon">Prev</span>
                    </a>
                    <a class="carousel-control-next" href="#demo" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
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
