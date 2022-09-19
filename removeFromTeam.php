<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove Player</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <style>         
      
    </style>
</head>
<body>
<?php
    error_reporting(0);
    require 'index.php';
    require_once('authentication.php');
    if(!$_SESSION['username'])
    {
        header('location:login.php');
    }
    $username = $_SESSION['username'];
    $sql = "select * from userTeams where userId = (select userId from user where username = '$username')";
    $iresult = mysqli_query($con,$sql);
    while($row = mysqli_fetch_assoc($iresult)){
        $sh1 = $row['shooter1'];
        $sh2 = $row['shooter2'];
        $sh3 = $row['shooter3'];
        $gk = $row['goalie'];
    }
    $noTeam = 0;
    if(is_null($sh1) && is_null($sh2) && is_null($sh3) && is_null($gk)){
        echo "<script>alert('Team is empty!!')</script>";
        $noTeam = 1;
    }
    if($noTeam){
        header('location:selectPlayer.php');
    }
    $sql = "select * from userPlayers where userId = (select userId from user where username = '$username')";
    $idresult = mysqli_query($con,$sql);
    if(isset($_POST['removePlayer'])){
        $pid = $_POST['removePlayer'];
                
        $sql = "select * from userTeams where userId = (select userId from user where username = '$username')";
        $idresult = mysqli_query($con,$sql);
        while($row = mysqli_fetch_assoc($idresult)){
            $sh1 = $row['shooter1'];
            $sh2 = $row['shooter2'];
            $sh3 = $row['shooter3'];
            $gk = $row['goalie'];
        }$sql='';
            $empty=0;        
            $value = null;
            if($sh1 == $pid){
                $sql = "update userTeams set shooter1 = null where userId = (select userId from user where username = '$username')";
                $updateresult = mysqli_query($con,$sql);
                echo "<script>alert('Shooter1');</script>";
                if(!is_null($sh2) && !is_null($sh3) && !is_null($gk)){
                    $sql = "select shooter2,shooter3,goalie from userTeams where userId = (select userId from user where username = '$username')";
                }else if(is_null($sh2) && is_null($sh3) && is_null($gk)){
                    echo "<script>alert('Team is empty!!')</script>";
                    $empty = 1;
                }else if(is_null($sh2) && is_null($sh3)){
                    $sql = "select goalie from userTeams where userId = (select userId from user where username = '$username')";    
                }else if(is_null($sh2) && is_null($gk)){
                    $sql = "select shooter3 from userTeams where userId = (select userId from user where username = '$username')";    
                }else if(is_null($sh3) && is_null($gk)){
                    $sql = "select shooter2 from userTeams where userId = (select userId from user where username = '$username')";    
                }else if(is_null($sh2)){
                    $sql = "select shooter3,goalie from userTeams where userId = (select userId from user where username = '$username')";    
                }else if(is_null($sh3)){
                    $sql = "select shooter2,goalie from userTeams where userId = (select userId from user where username = '$username')";    
                }else if(is_null($gk)){
                    $sql = "select shooter2,shooter3 from userTeams where userId = (select userId from user where username = '$username')";    
                }
            }else if($sh2 == $pid){
                $sql = "update userteams set shooter2 = null where userId = (select userId from user where username = '$username')";
                $updateresult = mysqli_query($con,$sql);
                echo "<script>alert('Shooter2');</script>";
                
                if(!is_null($sh1) && !is_null($sh3) && !is_null($gk)){
                    $sql = "select shooter1,shooter3,goalie from userTeams where userId = (select userId from user where username = '$username')";
                }else if(is_null($sh1) && is_null($sh3) && is_null($gk)){
                    echo "<script>alert('Team is empty!!')</script>";
                    $empty = 1;
                }else if(is_null($sh1) && is_null($sh3)){
                    $sql = "select goalie from userTeams where userId = (select userId from user where username = '$username')";    
                }else if(is_null($sh1) && is_null($gk)){
                    $sql = "select shooter3 from userTeams where userId = (select userId from user where username = '$username')";    
                }else if(is_null($sh3) && is_null($gk)){
                    $sql = "select shooter1 from userTeams where userId = (select userId from user where username = '$username')";    
                }else if(is_null($sh1)){
                    $sql = "select shooter3,goalie from userTeams where userId = (select userId from user where username = '$username')";    
                }else if(is_null($sh3)){
                    $sql = "select shooter1,goalie from userTeams where userId = (select userId from user where username = '$username')";    
                }else if(is_null($gk)){
                    $sql = "select shooter1,shooter3 from userTeams where userId = (select userId from user where username = '$username')";    
                }
            }else if($sh3 == $pid){
                $sql = "update userTeams set shooter3 = null where $userId = (select userId from user where username = '$username')";
                $updateresult = mysqli_query($con,$sql);
                echo "<script>alert('Shooter3');</script>";
                if(!is_null($sh2) && !is_null($sh1) && !is_null($gk)){
                    $sql = "select shooter1,shooter2,goalie from userTeams where userId = (select userId from user where username = '$username')";
                }else if(is_null($sh2) && is_null($sh1) && is_null($gk)){
                    echo "<script>alert('Team is empty!!')</script>";
                    $empty = 1;
                }else if(is_null($sh2) && is_null($sh1)){
                    $sql = "select goalie from userTeams where userId = (select userId from user where username = '$username')";    
                }else if(is_null($sh2) && is_null($gk)){
                    $sql = "select shooter1 from userTeams where userId = (select userId from user where username = '$username')";    
                }else if(is_null($sh1) && is_null($gk)){
                    $sql = "select shooter2 from userTeams where userId = (select userId from user where username = '$username')";    
                }else if(is_null($sh2)){
                    $sql = "select shooter1,goalie from userTeams where userId = (select userId from user where username = '$username')";    
                }else if(is_null($sh1)){
                    $sql = "select shooter2,goalie from userTeams where userId = (select userId from user where username = '$username')";    
                }else if(is_null($gk)){
                    $sql = "select shooter1,shooter2 from userTeams where userId = (select userId from user where username = '$username')";    
                }
            }else if($gk == $pid){
                $sql = "update userTeams set goalie = null where $userId = (select userId from user where username = '$username')";
                $updateresult = mysqli_query($con,$sql);
                echo "<script>alert('Goalie');</script>";
                if(!is_null($sh2) && !is_null($sh3) && !is_null($sh1)){
                    $sql = "select shooter1,shooter2,shooter3 from userTeams where userId = (select userId from user where username = '$username')";
                }else if(is_null($sh2) && is_null($sh3) && is_null($sh1)){
                    echo "<script>alert('Team is empty!!')</script>";
                    $empty = 1;
                }else if(is_null($sh2) && is_null($sh3)){
                    $sql = "select shooter1 from userTeams where userId = (select userId from user where username = '$username')";    
                }else if(is_null($sh2) && is_null($sh1)){
                    $sql = "select shooter3 from userTeams where userId = (select userId from user where username = '$username')";    
                }else if(is_null($sh3) && is_null($sh1)){
                    $sql = "select shooter2 from userTeams where userId = (select userId from user where username = '$username')";    
                }else if(is_null($sh2)){
                    $sql = "select shooter1,shooter3 from userTeams where userId = (select userId from user where username = '$username')";    
                }else if(is_null($sh3)){
                    $sql = "select shooter1,shooter2 from userTeams where userId = (select userId from user where username = '$username')";    
                }else if(is_null($sh1)){
                    $sql = "select shooter2,shooter3 from userTeams where userId = (select userId from user where username = '$username')";    
                }
            }
            $idresult = mysqli_query($con,$sql); 
            $unset($_POST['removePlayer']);
            if($empty){
                header('location : selectPlayer.php');
            }
        }
    $id = array();
    while($idrow = mysqli_fetch_assoc($idresult)){
        array_push($id,$idrow['playerId']);
    }
    
    $sql = "SELECT * FROM player WHERE playerId IN (" . implode(',', $id) . ")";
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
						                <form action ="removeFromTeam.php" method="post">
                                            <button class="profile_button px-5" id = "<?echo $row['$playerid']?>">Select Player</button>
                                            <input type='hidden' name='removePlayer' value="<?php echo $row['playerId'];?>">
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

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
