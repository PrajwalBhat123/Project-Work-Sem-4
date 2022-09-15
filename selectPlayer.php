<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Player</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	
    <link href="buy_card.css" rel="stylesheet" type="text/css"/>
	<link href="buy.css" rel="stylesheet" type="text/css"/>
    <style>         
      
    </style>
</head>
<body>    
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
    $sql = "select * from userPlayers where userId = (select userId from user where username = '$username')";
    $res = mysqli_query($con,$sql);
    $empty = 0;
    if(mysqli_num_rows($res) == 0){
        echo "<script>alert('No Players bought !!')</script>";
        $empty = 1;
    }
    if($empty){
        header('location:buyPlayer.php');
    }
    if(isset($_POST['selectPlayer'])){
        //echo $_POST['selectPlayer'];
        $pid = $_POST['selectPlayer'];
        
        $sql = "select * from player where playerId = $pid";
        $tresult = mysqli_query($con,$sql);
        while($row = mysqli_fetch_assoc($tresult)){
            $type = $row['playertype'];    
        }
        $sql = "select * from userTeams where userId = (select userId from user where username = '$username')";
        $idresult = mysqli_query($con,$sql);
        
        $sql = "select * from userTeams where userId = (select userId from user where username = '$username')";
        $tresult = mysqli_query($con,$sql);
        while($row = mysqli_fetch_assoc($tresult)){
            $sh1 = $row['shooter1'];
            $sh2 = $row['shooter2'];
            $sh3 = $row['shooter3'];
            $gk = $row['goalie'];
        }

        //$value = null;
        if($sh1 == $pid || $sh2 == $pid || $sh3 == $pid || $gk == $pid){
            echo "<script>alert('Selected Player is already present in the team!!!')</script>";    
        }else if(!is_null($sh1) && !is_null($sh2) && !is_null($sh3) && !is_null($gk)){
            echo "<script>alert('Team is Full . Remove Player from team !!!');</script>";        
        }
        $shooter=0;
        $goalie = 0;
        if($type == 1){
            if(is_null($sh1)){
                $sql = "update userTeams set shooter1 = $pid where userId = (select userId from user where username = '$username')";
                $updateresult = mysqli_query($con,$sql);
            }else if(is_null($sh2)){
                $sql = "update userTeams set shooter2 = $pid where userId = (select userId from user where username = '$username')";
                $updateresult = mysqli_query($con,$sql);
            }else if(is_null($sh3)){
                $sql = "update userteams set shooter3 = $pid where userId = (select userId from user where username = '$username')";
                $updateresult = mysqli_query($con,$sql);
            }else{
                echo "<script>alert('Shooters are filled in !!');</script>";
                $shooter = 1;
            }
            if($shooter){
                header('location:removFromTeam.php');
            }
        }else if($type == 2){
            if(is_null($gk)){
                $sql = "update userTeams set goalie = $pid where userId = (select userId from user where username = '$username')";
                $updateresult = mysqli_query($con,$sql);
            }else{
                echo "<script>alert('Goaile is filled in !!');</script>";
                $goalie = 1;    
            }    
            if($goalie){
                header('location:removFromTeam.php');
            }
        }
        unset($_POST['selectPlayer']);
    }
    // if(isset($_POST['upload'])){
    //     $image = $_FILES['image']['name'];
    //     $path = 'images/'.$image;

    //     move_uploaded_file($_FILES['image']['tmp_name'],$path);
    // }
    
    $sql = "select * from userPlayers where userId = (select userId from user where username = '$username')";
    $idresult = mysqli_query($con,$sql);
            
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
						                <form action="selectPlayer.php" method="post">
                                            <button class="profile_button px-5" id = "<?echo $row['$playerid']?>">Select Player</button>
                                            <input type='hidden' name='selectPlayer' value="<?php echo $row['playerId'];?>">
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
